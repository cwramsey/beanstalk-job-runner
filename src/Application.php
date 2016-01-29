<?php

namespace BeanstalkJobRunner;


use BeanstalkJobRunner\JobProcessor;
use BetterIni\Ini;
use Pheanstalk\Pheanstalk;

class Application
{

    protected $config;
    protected $logger;
    protected $beanstalk;

    public function __construct(Ini $config)
    {
        $this->config = $config;
    }

    public function run(JobProcessor $job_processor)
    {
        $this->beanstalk = new Pheanstalk($this->config->get('beanstalk.url'));

        while ($beanstalk_job = $this->beanstalk->watch($this->config->get('beanstalk.tube'))->reserve()) {

            $decoded_job = json_decode($beanstalk_job->getData());

            if (!isset($decoded_job->retries) || $decoded_job->retries <= $this->config->get('app.max_retries')) {
                $job_processor->execute($decoded_job);
            } else if ($decoded_job->retries > $this->config->get('app.max_retries')) {
                throw new MaxRetryException;
            }

            if (!$this->config->get('debug.debug')) {
                $this->beanstalk->delete($beanstalk_job);
            }
        }
    }

}
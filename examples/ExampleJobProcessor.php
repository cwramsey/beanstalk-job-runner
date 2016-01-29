<?php

class ExampleJobProcessor extends BeanstalkJobRunner\JobProcessor
{

    protected $logger;

    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    /**
     * The execute function handles the logic for whatever you need to do.
     * Here I'm simply moving a file from one location to another, but it can
     * be literally anything.
     *
     * @param object $job_details
     *
     * @return void
     */
    public function execute($job_details)
    {
        $this->logger->info("Processing Job", $job_details);

        rename($job_details->current_file_loc, $job_details->new_file_loc);
    }
}

$config = new \BetterIni\Ini(__DIR__ . '/../');

$app = new \BeanstalkJobRunner\Application($config);
$app->run();
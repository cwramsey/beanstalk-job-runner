<?php

namespace BeanstalkJobRunner;

abstract class JobProcessor
{
    protected $job_details;

    public function __construct()
    {

    }

    /**
     * @param object $job_details An object containing your job details
     *
     * @return boid
     */
    abstract public function execute($job_details);
}
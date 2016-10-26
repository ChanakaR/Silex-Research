<?php

/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-10-24
 * Time: 9:25 PM
 */
namespace plugins\JobPlugin\Controllers;

use plugins\JobPlugin\Models\Job;
use Silex\Application;

class JobController
{
    private $job;
    public function __construct()
    {
        $this->job = new Job();
    }

    public function getJobs(Application $app){
        $jobs = $this->job->getAll($app);
        return $app->json($jobs);
    }

    public function getJobById($id,Application $app){
        $job = $this->job->getJobById($app,$id);
        return $app->json($job);
    }
}
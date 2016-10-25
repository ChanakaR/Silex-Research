<?php

/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-10-24
 * Time: 9:25 PM
 */
namespace plugins\JobPlugin\Provider;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;

class JobControllerProvider implements ControllerProviderInterface
{

    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $jobs = $app["controllers_factory"];

        $jobs->get("/",'\plugins\JobPlugin\Controllers\JobController::getJobs');

        $jobs->get("/{id}",'\plugins\JobPlugin\Controllers\JobController::getJobById')
            ->assert('id','\d+');

        return $jobs;
    }
}
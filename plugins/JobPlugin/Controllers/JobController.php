<?php

/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-10-24
 * Time: 9:25 PM
 */
namespace plugins\JobPlugin\Controllers;

use Silex\Application;

class JobController
{
    public function getJobs(Application $app){
        $query = "select * from job";
        $employees = $app['db']->fetchAll($query);

        return $app->json($employees);
    }

    public function getJobById($id,Application $app){
        $query = "select * from job where id = $id";
        $employee = $app['db']->fetchAll($query);

        return $app->json($employee);
    }
}
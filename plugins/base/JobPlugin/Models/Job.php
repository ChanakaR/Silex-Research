<?php

/**
 * Created by PhpStorm.
 * User: chanaka
 * Date: 10/26/16
 * Time: 3:15 PM
 */
namespace plugins\base\JobPlugin\Models;

use Silex\Application;

class Job
{
    public function getAll(Application $app){
        $query = "select * from job";
        $result = $app['db']->fetchAll($query);
        return $result;
    }

    public function getJobById(Application $app,$id){
        $query = "select * from job where id = ?";
        $result = $app['db']->fetchAssoc($query,array((int)$id));
        return $result;
    }

    public function updateEmployee(){

    }

    public function addJob(){

    }

    public function deleteJob(){

    }
}
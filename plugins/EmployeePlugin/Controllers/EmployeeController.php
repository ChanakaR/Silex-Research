<?php

/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-10-24
 * Time: 6:42 PM
 */
namespace plugins\EmployeePlugin\Controllers;

use Silex\Application;

class EmployeeController
{
    public function getEmployees(Application $app){
        $query = "select a.*,b.title,b.salary from employee a inner join job b on a.job_id = b.id";
        $employees = $app['db']->fetchAll($query);

        return $app->json($employees);
    }

    public function getEmployeeById($id,Application $app){
        $query = "select a.*,b.title,b.salary from employee a inner join job b on a.job_id = b.id where a.id = $id";
        $employee = $app['db']->fetchAll($query);

        return $app->json($employee);
    }
}
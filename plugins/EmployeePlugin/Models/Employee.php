<?php

/**
 * Created by PhpStorm.
 * User: chanaka
 * Date: 10/26/16
 * Time: 12:43 PM
 */

namespace plugins\EmployeePlugin\Models;

use Silex\Application;

class Employee
{

    public function getAll(Application $app){
        $sql = "select a.*,b.title,b.salary from employee a inner join job b on a.job_id = b.id";
        $results = $app['db']->fetchAll($sql);
        return $results;
    }

    public function getEmployeeById(Application $app,$id){
        $sql = "select a.*,b.title,b.salary from employee a inner join job b on a.job_id = b.id where a.id = ?";
        $employee = $app['db']->fetchAssoc($sql,array((int)$id));
        return $employee;
    }

    public function addEmployee(Application $app,$parameters){
        $app['db']->insert('employee',$parameters);
    }

    public function deleteEmployee(Application $app,$id){
        $app['db']->delete('employee', array('id' => $id));
    }

    public function updateEmployee(Application $app,$id,$parameters){
        $app['db']->update('employee',$parameters,array('id'=>$id));
    }
}
<?php

/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-10-24
 * Time: 6:42 PM
 */
namespace plugins\EmployeePlugin\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class EmployeeController
{
    public function getEmployees(Application $app){
        $sql = "select a.*,b.title,b.salary from employee a inner join job b on a.job_id = b.id";
        $employees = $app['db']->fetchAll($sql);

        return $app->json($employees);
    }

    public function getEmployeeById($id,Application $app){
        $sql = "select a.*,b.title,b.salary from employee a inner join job b on a.job_id = b.id where a.id = ?";
        $employee = $app['db']->fetchAssoc($sql,array((int)$id));

        return $app->json($employee);
    }

    public function setEmployee(Request $request,Application $app){
        $emp_id = $request->get('employee_id');
        $first_name = $request->get('first_name');
        $last_name = $request->get('last_name');
        $contact_no = $request->get('contact_no');
        $address = $request->get('address');
        $job_id = $request->get('job_id');

        $params = array(
            'employee_id'=>$emp_id,
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'contact_no'=>$contact_no,
            'address'=>$address,
            'job_id'=>(int)$job_id
        );

        $app['db']->insert('employee',$params);

        $app['monolog']->addInfo(sprintf("New Employee is created"));
        $message = "New Epmloyee is inserted successfully";

        return $app->json($message);
    }

    public function removeEmployee($id,Request $request,Application $app){

//        $id = $request->get('id');

        $app['db']->delete('employee', array('id' => $id));
        $message = "Employee id $id deleted successfully";
        return $app->json($message);
    }

    public function updateEmployee($id,Request $request,Application $app){
        $emp_id = $request->get('employee_id');
        $first_name = $request->get('first_name');
        $last_name = $request->get('last_name');
        $contact_no = $request->get('contact_no');
        $address = $request->get('address');
        $job_id = $request->get('job_id');

        $params = array(
            'employee_id'=>$emp_id,
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'contact_no'=>$contact_no,
            'address'=>$address,
            'job_id'=>(int)$job_id
        );

        $app['db']->update('employee',$params,array('id'=>$id));

        $message = "Epmloyee $id is updated successfully";

        return $app->json($message);
    }

}
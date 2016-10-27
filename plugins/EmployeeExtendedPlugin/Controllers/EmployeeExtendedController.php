<?php

/**
 * Created by PhpStorm.
 * User: chanaka
 * Date: 10/27/16
 * Time: 9:10 PM
 */

namespace plugins\EmployeeExtendedPlugin\Controllers;

use app\events\EmployeeEvent;
use plugins\EmployeePlugin\Controllers\EmployeeController;
use Symfony\Component\HttpFoundation\Request;
use Silex\Application;


class EmployeeExtendedController extends EmployeeController
{
    public function setEmployee(Request $request,Application $app){
        $emp_id = $request->get('employee_id');
        $first_name = $request->get('first_name');
        $last_name = $request->get('last_name');
        $contact_no = $request->get('contact_no');
        $address = $request->get('address');
        $job_id = $request->get('job_id');
        $b_day = $request->get('dob');              //  newly added field

        $params = array(
            'employee_id'=>$emp_id,
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'contact_no'=>$contact_no,
            'address'=>$address,
            'job_id'=>(int)$job_id,
            'date_of_birth' => $b_day
        );

        $this->employee->addEmployee($app,$params);
        $message = "New Epmloyee is inserted successfully";

        $employee_event = new EmployeeEvent();
        $employee_event->setInsertInformation($params);

        $app['dispatcher']->dispatch(EmployeeEvent::NAME,$employee_event);

        return $app->json($message);
    }

    public function updateEmployee($id,Request $request,Application $app){
        $emp_id = $request->get('employee_id');
        $first_name = $request->get('first_name');
        $last_name = $request->get('last_name');
        $contact_no = $request->get('contact_no');
        $address = $request->get('address');
        $job_id = $request->get('job_id');
        $b_day = $request->get('dob');              //  newly added field

        $params = array(
            'employee_id'=>$emp_id,
            'first_name'=>$first_name,
            'last_name'=>$last_name,
            'contact_no'=>$contact_no,
            'address'=>$address,
            'job_id'=>(int)$job_id,
            'date_of_birth' => $b_day
        );

        $this->employee->updateEmployee($app,$id,$params);

        $message = "Epmloyee $id is updated successfully";

        return $app->json($message);
    }
}
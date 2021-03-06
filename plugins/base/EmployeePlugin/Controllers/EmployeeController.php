<?php

/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-10-24
 * Time: 6:42 PM
 */
namespace plugins\base\EmployeePlugin\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use plugins\base\EmployeePlugin\Models\Employee;
use app\events\EmployeeEvent;

class EmployeeController
{
    protected $employee;

    public function __construct()
    {
        $this->employee = new Employee();
    }

    public function getEmployees(Application $app){
        $employees = $this->employee->getAll($app);
        $employees['time'] = 'time_stamp';
        return $app->json($employees);
    }

    public function getEmployeeById($id,Application $app){
        $employee_result = $this->employee->getEmployeeById($app,$id);
        return $app->json($employee_result);
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

        $this->employee->addEmployee($app,$params);
        $message = "New Epmloyee is inserted successfully";

        $employee_event = new EmployeeEvent();
        $employee_event->setInsertInformation($params);

        $app['dispatcher']->dispatch(EmployeeEvent::NAME,$employee_event);

        return $app->json($message);
    }

    public function removeEmployee($id,Application $app){
        $this->employee->deleteEmployee($app,$id);
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


        $this->employee->updateEmployee($app,$id,$params);

        $message = "Epmloyee $id is updated successfully";

        return $app->json($message);
    }

    public function getEmployeeCount(Application $app){
//        $count =  $this->employee->getCount($app);
        $count =  "I am base controller";
        return $app->json($count);
    }
}
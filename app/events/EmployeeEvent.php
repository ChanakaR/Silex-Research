<?php

/**
 * Created by PhpStorm.
 * User: chanaka
 * Date: 10/27/16
 * Time: 4:55 PM
 */

namespace app\events;

use Symfony\Component\EventDispatcher\Event;

class EmployeeEvent extends Event
{

    const NAME = 'Employee.Inserted';

    private $param_array;

    public function getEmployeeInsertedNotification(){
        return "New employee is created , Employee ID : " .$this->param_array['employee_id'];
    }

    public function setInsertInformation(Array $param_array){
        $this->param_array = $param_array;
    }

}
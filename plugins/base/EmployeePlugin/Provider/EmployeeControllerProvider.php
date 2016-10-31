<?php

/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-10-24
 * Time: 6:40 PM
 */
namespace plugins\base\EmployeePlugin\Provider;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

class EmployeeControllerProvider implements ControllerProviderInterface
{

    /**
     * Returns routes to connect to the given application.
     *
     * @param \Silex\Application $app An Application instance
     *
     * @return \Silex\ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $employees = $app["controllers_factory"];

        $employees->get("/",'\plugins\base\EmployeePlugin\Controllers\EmployeeController::getEmployees')
        ->after(function (){
            echo "I am a after middleware for employee route";
        });
        $employees->get("/count",'\plugins\base\EmployeePlugin\Controllers\EmployeeController::getEmployeeCount');

        $employees->get("/{id}",'\plugins\base\EmployeePlugin\Controllers\EmployeeController::getEmployeeById')
            ->assert('id','\d+');

        $employees->post("/",'\plugins\base\EmployeePlugin\Controllers\EmployeeController::setEmployee');

        $employees->delete("/{id}",'\plugins\base\EmployeePlugin\Controllers\EmployeeController::removeEmployee')
            ->assert('id','\d+');

        $employees->put("/{id}",'\plugins\base\EmployeePlugin\Controllers\EmployeeController::updateEmployee')
            ->assert('id','\d+');

        return $employees;
    }
}
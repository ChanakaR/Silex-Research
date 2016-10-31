<?php

/**
 * Created by PhpStorm.
 * User: chanaka
 * Date: 10/27/16
 * Time: 9:09 PM
 */
namespace plugins\custom\EmployeePlugin\Provider;

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

        $employees->get("/",'\plugins\custom\EmployeePlugin\Controllers\EmployeeExtendedController::getEmployees');
        $employees->get("/count",'\plugins\EmployeePlugin\Controllers\EmployeeExtendedController::getEmployeeCount');

        $employees->get("/{id}",'\plugins\custom\EmployeePlugin\Controllers\EmployeeExtendedController::getEmployeeById')
            ->assert('id','\d+');

        $employees->post("/",'\plugins\custom\EmployeePlugin\Controllers\EmployeeExtendedController::setEmployee');

        $employees->delete("/{id}",'\plugins\custom\EmployeePlugin\Controllers\EmployeeExtendedController::removeEmployee')
            ->assert('id','\d+');

        $employees->put("/{id}",'\plugins\custom\EmployeePlugin\Controllers\EmployeeExtendedController::updateEmployee')
            ->assert('id','\d+');

        return $employees;
    }
}
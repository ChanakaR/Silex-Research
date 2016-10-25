<?php

/**
 * Created by PhpStorm.
 * User: bmCSoft
 * Date: 2016-10-24
 * Time: 6:40 PM
 */
namespace plugins\EmployeePlugin\Provider;

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

        $employees->get("/",'\plugins\EmployeePlugin\Controllers\EmployeeController::getEmployees');

        $employees->get("/{id}",'\plugins\EmployeePlugin\Controllers\EmployeeController::getEmployeeById')
            ->assert('id','\d+');

        return $employees;
    }
}
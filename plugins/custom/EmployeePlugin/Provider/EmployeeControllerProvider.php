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

class EmployeeControllerProvider extends \plugins\base\EmployeePlugin\Provider\EmployeeControllerProvider
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
//        $employees = $app["controllers_factory"];

        $this->setRouteGroup($app);

        $this->employees->get("/count",'\plugins\custom\EmployeePlugin\Controllers\EmployeeExtendedController::getEmployeeCount');
        $this->employees->post("/",'\plugins\custom\EmployeePlugin\Controllers\EmployeeExtendedController::setEmployee');
        $this->employees->put("/{id}",'\plugins\custom\EmployeePlugin\Controllers\EmployeeExtendedController::updateEmployee')
            ->assert('id','\d+');

        $this->setRoutes();

        return $this->employees;
    }
}

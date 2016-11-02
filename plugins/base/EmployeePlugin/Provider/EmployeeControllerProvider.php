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

    protected $employees;
    /**
     * Returns routes to connect to the given application.
     *
     * @param \Silex\Application $app An Application instance
     *
     * @return \Silex\ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $this->setRouteGroup($app);
        $this->setRoutes();
        return $this->employees;
    }

    protected function setRouteGroup($app){
        $this->employees=$app["controllers_factory"];
    }

    protected function setRoutes(){
        $this->employees->get("/",'\plugins\base\EmployeePlugin\Controllers\EmployeeController::getEmployees')
            ->after(function (){
                echo "I am a after middleware for employee route";
            });
        $this->employees->get("/count",'\plugins\base\EmployeePlugin\Controllers\EmployeeController::getEmployeeCount');

        $this->employees->get("/{id}",'\plugins\base\EmployeePlugin\Controllers\EmployeeController::getEmployeeById')
            ->assert('id','\d+');

        $this->employees->post("/",'\plugins\base\EmployeePlugin\Controllers\EmployeeController::setEmployee');

        $this->employees->delete("/{id}",'\plugins\base\EmployeePlugin\Controllers\EmployeeController::removeEmployee')
            ->assert('id','\d+');

        $this->employees->put("/{id}",'\plugins\base\EmployeePlugin\Controllers\EmployeeController::updateEmployee')
            ->assert('id','\d+');
    }
}
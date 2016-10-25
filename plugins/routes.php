<?php
/**
 * Created by PhpStorm.
 * User: chanaka
 * Date: 10/25/16
 * Time: 8:37 AM
 */

$app->mount("/employees", new plugins\EmployeePlugin\Provider\EmployeeControllerProvider());
$app->mount("/jobs", new plugins\JobPlugin\Provider\JobControllerProvider());
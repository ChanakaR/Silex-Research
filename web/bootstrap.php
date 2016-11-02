<?php
/**
 * Created by PhpStorm.
 * User: chanaka
 * Date: 10/27/16
 * Time: 10:59 AM
 */

require_once __DIR__.'/../vendor/autoload.php';

use Knp\Provider\ConsoleServiceProvider;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use plugins\RouteMounter;

$app = new Silex\Application();

$app->register(new Silex\Provider\DoctrineServiceProvider(),array(
    'db.options' => array(
        'driver' => 'pdo_mysql',
        'host' => '127.0.0.1',
        'dbname' => 'research_demo',
        'user' => 'root',
        'password' => '1234',
        'charset' => 'utf8',
    )
));

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/development.log',
));

$app->register(new ConsoleServiceProvider(),array(
    'console.name' => 'ConsoleApp',
    'console.version'           => '1.0.0',
    'console.project_directory' => __DIR__.'/..'
));

$routeMounter = new RouteMounter();
$routeMounter->mount($app);

$app->on('Employee.Inserted',function (Event $event) use ($app){
    $app['monolog']->addInfo(sprintf($event->getEmployeeInsertedNotification()));
});



/*
 *  Application middleware
 */

$app->get('/testmiddleware',function(){
    return "I am the response<br>";
})
->before(function (){
    echo "I am the before routing middleware<br>";

})
->after(function (){
    echo "I am the after routing middleware<br>";
});



//$app->before(function (){
//    echo "I am the BEFORE APPLICATION MIDDLEWARE<br>";
//});
//
//$app->after(function (){
//    echo "I am the AFTER APPLICATION MIDDLEWARE<br>";
//});
//
//$app->finish(function (){
//    echo "I am the FINISH APPLICATION MIDDLEWARE<br>";
//});


return $app;
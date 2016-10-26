<?php

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

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

\plugins\RouteMounter::mount($app);

$app->run();






















//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpKernel\HttpKernelInterface;
//
//
//$app = new Silex\Application();
//
//$app['debug'] = true;
//
//$app->register(new Silex\Provider\MonologServiceProvider(), array(
//    'monolog.logfile' => __DIR__.'/development.log',
//));
//
//$newsCollection = array(
//    1 => array(
//        'date'      => '2011-03-29',
//        'author'    => 'Broody',
//        'title'     => 'Title for News 1',
//        'body'      => 'some text description for the news. This is the news body.',
//    ),
//    2 => array(
//        'date'      => '2011-06-20',
//        'author'    => 'Babara',
//        'title'     => 'Title for News 2',
//        'body'      => 'some text description for the news. This is the news body.',
//    ),
//    3 => array(
//        'date'      => '2011-10-19',
//        'author'    => 'Jakson',
//        'title'     => 'Title for News 3',
//        'body'      => 'some text description for the news. This is the news body.',
//    )
//);
//
//$app->get('/news', function () use ($app,$newsCollection){
//    $output = '';
//    foreach ($newsCollection as $news) {
//        $output .= "<h1 style='color: #4e342e;'>{$news['title']}</h1>";
//        $output .= "<p>{$news['body']}<br>Author : {$news['author']}</p>";
//    }
//    return $output;
//});
//
//$app->get('/news/{id}', function(Silex\Application $app, $id) use ($newsCollection){
//    if(!isset($newsCollection[$id])){
//
//        $app['monolog']->addInfo(sprintf("The Requested post (id : %d) is not found.",$id));
//
//        $res = new \Symfony\Component\HttpFoundation\Response();
//        $res->setContent("Post id is invalid");
//        $res->setStatusCode(404);
//
//        return $res;
//
////        $app->abort(404,"Post id is invalid");
//    }
//
//    $news = $newsCollection[$id];
//    return  "<h1 style='color: #4e342e;'>{$news['title']}</h1>".
//    "<p>{$news['body']}</p>";
//});
//
//
//$app->get('/blog','MyControllers\EmployeeController::showAll');
//$app->get('/blog/{id}','MyControllers\BlogController::showById');
//
//
//
///*
// * HTTP method supportability
// */
//
//$app->post('/httpmethodstest',function (Request $request){
//    print_r($request);
//    print_r($request->get('message'));
//    return 'This is a POST request. Your message is ';
//});
//
//$app->put('/httpmethodstest',function(){
//    return 'This is a PUT request';
//});
//
//$app->delete('/httpmethodstest',function(){
//    return 'This is a DELETE request';
//});
//
//$app->patch('/httpmethodstest',function(){
//    return 'This is a PATCH request';
//});
//
//
///*
// * parameter conversion
// *
// */
//
//class Student{
//    private $name = "";
//    private $age = "";
//
//    public function getName(){
//        return $this->name;
//    }
//
//    public function getAge(){
//        return $this->age;
//    }
//
//    public function setName($name){
//        $this->name = $name;
//    }
//
//    public function setAge($age){
//        $this->age = $age;
//    }
//}
//
//
//
//$studentProvider = function ($student) {
//
//    $st = new Student();
//
//    if($student == "1"){
//        $st->setName("Bob");
//        $st->setAge(24);
//    }
//    elseif ($student == "2"){
//        $st->setName("Alice");
//        $st->setAge(28);
//    }
//    else{
//        $st->setName("No name");
//        $st->setAge(0);
//    }
//    return $st;
//};
//
//$app->get('/students/{student}',function(Student $student) {
//
//    $output = "<p>Name : {$student->getName()}</p>";
//    $output .= "<p>Age : {$student->getAge()}</p>";
//    return $output;
//})
//->convert('student',$studentProvider);
//
//
///*
// *
// * limits routes to specific HTTP methods
// *
// */
//
//$app->match('/onlypost',function(){
//    return 'this url valid only for post methods';
//})
//    ->method('POST');
//
//$app->match('/onlydeleteandput',function(){
//    return 'this url valid only for put and patch methods';
//})
//    ->method('PUT|PATCH');
//
///*
// *  Application middleware and Route middleware
// *
// */
//
//$app->get('/testmiddleware',function(){
//    return "I am the response<br>";
//})
//->before(function (){
//    echo "I am the before routing middleware<br>";
//
//})
//->after(function (){
//    echo "I am the after routing middleware<br>";
//});
//
//
////
////$app->before(function (){
////    echo "I am the BEFORE APPLICATION MIDDLEWARE<br>";
////});
////
////$app->after(function (){
////    echo "I am the AFTER APPLICATION MIDDLEWARE<br>";
////});
////
////$app->finish(function (){
////    echo "I am the FINISH APPLICATION MIDDLEWARE<br>";
////});
//
//$app->run();
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
////$app->get('/blog', function () use ($app,$blogPosts){
//////    return $app->redirect('blog/1');
////
//////    $subRequest = Request::create('/news');
//////    $response = $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST, false);
//////    return $response;
////
////    $output = '';
////    foreach ($blogPosts as $post) {
////        $output .= "<h1>{$post['title']}</h1>";
////        $output .= "<p>{$post['body']}<br>Author : {$post['author']}</p>";
////    }
////    return $output;
////});
//

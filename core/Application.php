<?php
namespace app\core;

class Application{

    public Router $router;
    public Request $request;
    public static string $rootPath;
    public static Application $app;
    public Controller $controller;

    public function __construct($rootPath){

        self::$app=$this;
        self::$rootPath=$rootPath;
        $this->router=new Router(new Request(),new Response());
        $this->controller=new Controller();
    }

    public function run(){
       echo $this->router->resolve();
    }

}
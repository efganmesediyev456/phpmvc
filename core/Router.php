<?php

namespace app\core;

class Router{

    public Request $request;
    public Response $response;
    public function __construct(Request $request)
    {
        $this->request=new Request();
        $this->response=new Response();
    }
    public array $array=[];
    public function get($path,$callback){
        $this->array['get'][$path]=$callback;
    }

    public function post($path,$callback){
        $this->array['post'][$path]=$callback;
    }

    public function resolve(){
        
        $path=$this->request->getPath();
        $request=$this->request->getRequest();
        
        $callback=$this->array[$request][$path] ?? false;
        if($callback==false){
            $this->response->setStatusCode("404");
            return $this->renderContent();
            exit;

        }
        if(is_string($callback)){
            return $this->renderView($callback);
        }
        if(is_array($callback)){
           
            Application::$app->controller=new $callback[0]();
            $callback[0]=Application::$app->controller;
        }
       
       return call_user_func($callback,$this->request);
       
    }
    public function renderView($view,array $params=[]){
        $layout=Application::$app->controller->layout;
        $layout=$this->renderLayout($layout);
        $onlyView=$this->onlyview($view,$params);
        
        return str_replace("{{content}}",$onlyView,$layout);
    }
    public function renderContent(){
        $layout=Application::$app->controller->layout;
        $layout=$this->renderLayout($layout);
        $onlyView=$this->onlyview('_404');
        
        return str_replace("{{content}}",$onlyView,$layout);
    }

    public function renderLayout($view){
        ob_start();
        include_once Application::$rootPath."/views/layouts/$view.php";
        return ob_get_clean();

    }
    public function onlyview($view, array $params=[]){
       
        if(count($params)>0){

            foreach($params as $key=>$value){
                $$key=$value;
            }
        }
        
        ob_start();
        include_once Application::$rootPath."/views/$view.php";
        return ob_get_clean();

    }
}

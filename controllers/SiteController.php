<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller {

    public function  home(){
       
        $params=["name"=>"efgan","age"=>45];
        return $this->render("home",$params);
    }
    public function login(){
        $this->setLayout("auth");
        return $this->render("login");
    }
    public function postLogin(Request $request){
        $data=$request->getAll();
        var_dump($data);
    }

}
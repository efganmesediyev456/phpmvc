<?php
namespace app\core;

class Request {


        public function getPath(){
            $path=$_SERVER["REQUEST_URI"] ?? '/';
            $position=strpos($path,'?');
           
            if($position==false){
                return $path;
            }
           
            $path=substr($path,0,$position);
            return $path;
        }
        public function getRequest(){
            return strtolower($_SERVER["REQUEST_METHOD"]);
        }

        public function getAll(){
            $data=[];
            if($this->getRequest()=="get"){
                foreach($_GET as $key=>$val){
                    $data[$key]=$val;
                }
            }
            if($this->getRequest()=="post"){
                foreach($_POST as $key=>$val){
                    $data[$key]=$val;
                }
            }
            return $data;
        }

}
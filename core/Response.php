<?php

namespace app\core;
class Response{


        public function setStatusCode(int $int){
           http_response_code($int);
        }

}
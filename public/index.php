<?php

require __DIR__.'/../vendor/autoload.php';

use app\controllers\SiteController;
use app\core\Application;

$app=new Application(dirname(__DIR__));

$app->router->get("/",[SiteController::class,"home"]);
$app->router->get("/login",[SiteController::class,"login"]);
$app->router->post("/login",[SiteController::class,"postLogin"]);


$app->router->get("/contact","contact");

$app->run();
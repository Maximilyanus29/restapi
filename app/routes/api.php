<?php
/**@var $router \app\kernel\Router*/

$router->addRoute("GET", "api/get-time/{method}", function ($method){
	var_dump($method);die;
});
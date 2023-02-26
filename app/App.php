<?php
namespace app;

use app\kernel\Router;

class App extends ConsoleApp
{
	public function run()
	{
		parent::run();
		$router=new Router();
		require_once "routes/api.php";
		$router->handle();
	}

}
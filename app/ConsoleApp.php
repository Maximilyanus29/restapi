<?php
namespace app;

use app\kernel\Router;

class ConsoleApp
{
	public function run()
	{
		$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
		$dotenv->load();
	}

}
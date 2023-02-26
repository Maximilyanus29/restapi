<?php
namespace app\kernel;

class Router
{
	private array $routes=[];
	public function addRoute(string $method, string $url_template, $handle): void
	{
		$this->routes[]=[
			"method"=>$method,
			"url_template"=>$url_template,
			"handle"=>$handle,
		];
	}

	public function handle()
	{
		foreach ($this->routes as $route){
			if ($route["method"]==$_SERVER["REQUEST_METHOD"] && $this->validate_url_template($route["url_template"])){
				$arguments=$this->get_arguments($route["url_template"]);
				$handler=$route["handle"];
				if (is_array($handler)){
					$controller=new $handler[0];
					$controller->{$handler[1]}(...$arguments);
				}else{
					$handler(...$arguments);
				}
			}
			return;
		}
	}

	private function get_arguments(string $url_template): array
	{
		$url_template_splitted=explode("/", $url_template);
		$current_url_splitted=explode("/", $_SERVER["REQUEST_URI"]);
		array_shift($current_url_splitted);
		$result=[];
		if ($url_template_splitted){
			foreach ($url_template_splitted as $key=>$template){
				if (preg_match("(\{(\w+)\})", $template)){
					$result[]=$current_url_splitted[$key];
				}
			}
		}
		return $result;
	}

	private function validate_url_template(string $url_template)
	{
		$url_template=preg_replace("(\{\w+\})", "(\w+)", $url_template);
		return preg_match("%".$url_template."%", $_SERVER["REQUEST_URI"]);
	}




}
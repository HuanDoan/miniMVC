<?php
	use app\Cores\Registry;

	/**
	* 
	*/
	class Routes
	{
		private static $route = [];
		private $baseURL;
		
		function __construct($baseURL)
		{
			$this->baseURL = $baseURL;
		}

		private function getURI(){
			$base_url = $this->baseURL;
			$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
			$url = str_replace($base_url, '', $url);
			return $url === '' || empty($url) ? '/' : $url;
		}

		private function getReqMethod(){
			$method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
			return $method;
		}

		private static function addRoute($med, $url, $act){
			self::$route[] = [$med, $url, $act];
		}

		public static function get($url, $act){
			self::addRoute('GET', $url, $act);
		}

		public static function post($url, $act){
			self::addRoute('POST', $url, $act);
		}

		public static function any($url, $act){
			self::addRoute('GET|POST', $url, $act);
		}

		function mapping(){
			$check  = false;
			$reqURL = $this->getURI();
			$reqMed = $this->getReqMethod();
			$routes = self::$route;
			$params= [];

			foreach ($routes as $r) {
				list($method, $url, $action) = $r;

				if (strpos($method, $reqMed) === FALSE){
					continue;
				}

				if ($url === '*') {
					$check = true;
				}
				elseif(strpos($url, '{') === FALSE){
					if (strcmp(strtolower($url), strtolower($reqURL)) === 0) {
						$check = true;
					}
					else{
						continue;
					}
				}
				elseif (strpos($url, '}') === FALSE) {
					continue;
				}
				else{
					$routeParam = explode('/', $url);
					$reqParam   = explode('/', $reqURL);

					if (count($routeParam) !== count($reqParam)) {
						continue;
					}

					foreach ($routeParam as $k => $rp) {
						if (preg_match('/^{\w+}$/', $rp)) {
							$params[] = $reqParam[$k];
						}
					}

					$check = true;
				}

				if ($check === true) {
					if ( is_callable($action)) {
						call_user_func_array($action, $params);
					}
					elseif(is_string($action)){
						$this->compileRoute($action,$params);
					}
					return;
				}
				else{
					continue;
				}
			}
			return;
		}

		private function compileRoute($action, $params){
			if (count(explode('@', $action)) !== 2) {
				die('Routes error');
			}
			$className = explode('@', $action)[0];
			$methodName = explode('@', $action)[1];

			$classFullName = 'app\\Controllers\\'.$className;


			if (class_exists($classFullName)) {

				Registry::getInstance()->controller = $className;
				
				$object = new $classFullName;

				if (method_exists($classFullName, $methodName)) {
					Registry::getInstance()->methodName = $methodName;
					call_user_func_array([$object, $methodName], $params);

				}
				else{
					die('Method '.$methodName.' not found!');
				}
			}
			else{
				die($classFullName.' not found!');
			}
		}

		function run(){
			$this->mapping();
		}
	}
?>
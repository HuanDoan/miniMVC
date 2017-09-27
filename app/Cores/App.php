<?php

	
	require_once(dirname(__FILE__).'/Autoload.php');

	use app\Cores\Registry;


	/**
	* 
	*/
	class App
	{
		private $routes;
		private static $curr_controller;
		private static $action;
		
		function __construct($config)
		{
			new Autoload($config['ROOT_DIR']);
			$this->routes = new Routes($config['BASE_URL']);
			Registry::getInstance()->config = $config;
			
		}

		public function Run(){
			$this->routes->run();
		}
	}
?>
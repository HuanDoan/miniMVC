<?php
	namespace app\Cores;

	/**
	* 
	*/
	class Registry
	{
		private static $instance;
		private $storage;


		private function __construct()
		{
			
		}

		public static function getInstance(){
			if (!isset(self::$instance)) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		public function __set($name, $value){
			if (!isset($this->storage[$name])) {
				$this->storage[$name] = $value;
			}
			else{
				die("Cannot set value to {$name}, {$name} already existed");
			}
		}

		public function __get($name){
			if (isset($this->storage[$name])) {
				return $this->storage[$name];
			}
			else{
				return null;
			}
		}
	}

?>
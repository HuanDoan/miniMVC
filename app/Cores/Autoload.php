<?php
	/**
	* 
	*/
	class Autoload
	{
		private $root_dir;
		
		function __construct($rootDir)
		{
			$this->root_dir = $rootDir;
			spl_autoload_register([$this, 'autoload']);
			$this->autoLoadFiles();
		}

		private function autoload($class){
			$tmp = explode('\\', $class);
			$className = end($tmp);
			$pathName  = str_replace($className, '', $class);

			$file_path = $this->root_dir.'\\'.$pathName.$className.'.php';

			if (file_exists($file_path)) {
				require_once($file_path);
			}
		}

		private function autoLoadFiles(){
			foreach ($this->defaultFilesLoad() as $file) {
				require_once($this->root_dir.'/'.$file);
			}
		}

		private function defaultFilesLoad(){
			return [
				'app/Cores/Routes.php',
				'app/routers.php'
			];
		}
	}
?>
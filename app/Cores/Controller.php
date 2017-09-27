<?php
	namespace app\Cores;

	use \App;
	use app\Cores\Registry;

	/**
	* 
	*/
	class Controller
	{
		
		private $layout = null;
		private $config;

		function __construct()
		{
			$this->config = Registry::getInstance()->config;
			$this->layout = $this->config['default_layout'];
		}

		public function setDefaultLayout($layout){
			$this->layout = $layout;
		}

		public function redirect($url, $isEnd = true, $responseCode = 302){
			header('Location:'.$url, true, $responseCode);
			if ($isEnd === true) {
				die();
			}
		}

		public function render($view, $data=null){
			$root_dir      = $this->config['ROOT_DIR'];
			$__ViewContent = $this->getViewContent($view, $data);

			if ($this->layout !== null) {
				$layout_path   = $root_dir.'/'.'app/Views/'.$this->layout.'.php';

				if (file_exists($layout_path)) {
					require($layout_path);
				}
				else{
					die('Views '.$this->layout.' not found');
				}
			}
		}

		public function getViewContent($view, $data=null){
			$controller  = Registry::getInstance()->controller;
			$folderViews = strtolower(str_replace('Controller', '', $controller));
			$root_dir    = $this->config['ROOT_DIR'];

			if (is_array($data)) {
				extract($data, EXTR_PREFIX_SAME, "kangfrwk");
			}
			else{
				$data = $data;
			}

			$view_path 	 = $root_dir.'/'.'app/Views/'.$folderViews.'/'.$view.'.php';

			if (file_exists($view_path)) {
				ob_start();
				
				require($view_path);

				return ob_get_clean();
			}
		}

		public function renderPartial($view, $data=null){
			$root_dir    = $this->config['ROOT_DIR'];


			if (is_array($data)) {
				extract($data, EXTR_PREFIX_SAME, "kangfrwk");
			}
			else{
				$data = $data;
			}

			$view_path 	 = $root_dir.'/'.'app/Views/'.$view.'.php';

			if (file_exists($view_path)) {
				require($view_path);
			}
		}
	}
?>
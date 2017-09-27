<?php
	namespace app\Controllers;

	use app\Cores\Controller;
	use \App;

	/**
	* 
	*/
	class HomeController extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function index(){
			$this->render('index', [
				'Name' => 'Huan',
				'Age'  => '21'
			]);
		}
	}
?>
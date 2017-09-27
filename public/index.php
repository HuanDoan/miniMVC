<?php

	require_once(dirname(__FILE__).'/../app/Cores/App.php');
	$config = require_once(dirname(__FILE__).'/../config/config.php');
	
	// App::setConfig($config);


	$app = new App($config);
	$app->Run();

?>
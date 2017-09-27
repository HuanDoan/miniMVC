<?php 

	use app\Cores\Controller;

	Routes::get('/', function() {
	    $ct = new Controller;
	    $ct->render('index', [
	    	'title' => 'Content',
	    	'content' => 'This is content'
	    ]);

	});

	Routes::get('/home/abc', 'HomeController@index');

	Routes::get('*', function() {
	    echo "<h1>404 Not Found</h1>";
	});
?>
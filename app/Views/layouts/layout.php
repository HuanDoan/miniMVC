<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Test MVC Framework</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="asset/css/bootstrap.min.css" >

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<h1 class="text-center">Hello World</h1>

		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-4">
					<?= $this->renderPartial('layouts/sidebar', ['title' => 'Side bar']); ?>
					
				</div>
				<div class="col-xs-12 col-md-8">
					<?= $__ViewContent ?>
				</div>
			</div>
		</div>

		<!-- jQuery -->
		<script src="asset/js/jquery-3.2.1.min.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="asset/js/bootstrap.min.js"></script>
	</body>
</html>
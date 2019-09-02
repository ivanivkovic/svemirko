<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $title ?></title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>
		<link rel="stylesheet" href="<?php echo BASE_PATH ?>src/jquery-ui/jquery-ui.min.css"/>

	</head>
	<body>
		
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		
			<a class="navbar-brand" href="https://www.youtube.com/watch?v=graOFuZEFs0" target="_blank">svemirko</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left:10px">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item <?php echo $controller == 'arrivals' ? 'active' : ''?>">
						<a class="nav-link" href="<?php echo BASE_PATH; ?>arrivals">Arrivals <span class="sr-only">(current)</span></a>
					</li>

					<li class="nav-item <?php echo $controller == 'shiptypes' ? 'active' : ''?>">
						<a class="nav-link" href="<?php echo BASE_PATH; ?>shiptypes">Ship Type Management <span class="sr-only">(current)</span></a>
					</li>
				</ul>
				
				<div class="my-2 my-lg-0">
				
					<ul class="navbar-nav mr-auto" style="margin-left:20px !important;">
						<li class="nav-item">
							<a class="nav-link" href="<?php echo BASE_PATH; ?>logout">Logout</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		
		<div class="container mt-4">
			
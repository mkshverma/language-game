<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<title><?=isset($tite)?$tite:'Home';?></title>
	<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css');?>">
	<style type="text/css">
		.btn-crossed{
			text-decoration: line-through;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav menu__list">
					<li class="active menu__item "><a class="menu__link" href="#">Home <span class="sr-only">(current)</span></a></li>
					<li class=" menu__item"><a class="menu__link" href="#">About</a></li>
					<li class=" menu__item"><a class="menu__link" href="#">Contact</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<?=$body;?>
	</div>
	<script src="<?=base_url('assets/js/jquery.min.js');?>"></script>
	<script src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
</body>
</html>
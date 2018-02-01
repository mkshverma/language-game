<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?=isset($tite)?$tite:'Home';?></title>
	<link rel="stylesheet" href="<?=base_url('assets/css/bootstrap.min.css');?>">
	<link rel="stylesheet" href="<?=base_url('assets/css/style.css');?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
	<script>
		var base_url = '<?=base_url();?>';
	</script>
	<script src="<?=base_url('assets/js/jquery.min.js');?>"></script>
	<script src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
	<script src="<?=base_url('assets/js/script.js');?>"></script>
</body>
</html>
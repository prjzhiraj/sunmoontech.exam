<!DOCTYPE html>
<html>
<head>
	<title><?= $title; ?></title>
</head>
<header>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="<?= base_url('assets/font-awesome-4.7.0/css/font-awesome.min.css') ?>">
</header>
<?php if($this->session->userdata('user_id')){ ?>
	<nav class="navbar welcome_nav sticky-top navbar-dark bg-dark">
		<div class="container-fluid">
			<span class="navbar-brand">Welcome <?= $this->session->userdata('fullname'); ?></span>
			<span class="navbar-text">
				<a class="nav-link" href="<?= base_url('index.php/logout'); ?>" onclick="logoutmodal()">Log out</a>
			</span>
		</div>
	</nav>
<?php }?>
<nav class="navbar main_nav navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?= base_url(); ?>"><img src="<?= base_url('assets/logo.png'); ?>"/></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">

					<a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">Home</a>

				</li>
				
				<?php if($this->session->userdata('user_id')){ ?>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('index.php/mylyrics'); ?>">My Lyrics</a>
					</li>


				<?php }else{ ?>
					<li class="nav-item">
						<a class="nav-link" href="#" onclick="loginModal()">Log in</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#" onclick="registerModal()">Sign up</a>
					</li>
				<?php }?>

				
			</ul>
			<form class="d-flex" action="<?= base_url('/index.php/search'); ?>" method="get">
				<input class="form-control me-2" type="search" placeholder="Search Lyrics" name="search" aria-label="Search">
				<input type="hidden" name="page" value="0">
				<button class="btn btn-outline-success" type="submit">Search</button>
			</form>
		</div>
	</div>
</nav>

<body>
<?php if (uri_string() != ''){ // title header ?>
<div class="container-fluid title-con">
	<div class="row section-1">
		<div class="col-sm-12">
			<h1><?= $sect_title; ?></h1>
		</div>
	</div>
</div>
<?php } ?>
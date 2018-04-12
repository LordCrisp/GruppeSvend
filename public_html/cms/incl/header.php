<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#2D2D2D" id="theme_color">
	<title>Admin | Fashion Online</title>

	<!-- Custom stylesheet -->
	<link rel="stylesheet" href="https://cdn.rawgit.com/SanderSalamander/md-admin/master/css/master.css">
	<link rel="stylesheet" href="/cms/assets/css/master.css">
	<!-- Google fonts -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Favicon -->
	<link rel="icon" href="favicon.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
	<!-- jQuery -->
	<script
	src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	crossorigin="anonymous"></script>
</head>

<!-- Body (start) -->
<body>
<!-- Header (start) -->
<div id="sidebarToggle" style="display:none"></div>
<div id="overlay" style="display: none"></div>
<nav class="header__sidebar" id="sidebar">
	<div class="header__title">
		<h1 class="header__brand">CMS</h1>
	</div>
	<ul class="header__list">
		<li><a href="index.php"><i class="material-icons">home</i><span>Home</span></a></li>
	<?php if ($auth->auth_role == 'admin') : ?>
		<li><a href="/cms/products.php"><i class="material-icons">shopping_basket</i><span>Products</span></a></li>
	<?php elseif ($auth->auto_role == 'retailer') : ?>
		<li><a href="/cms/retail_adress.php"><i class="material-icons">pin_drop</i><span>Change address</span></a></li>
	<?php endif; ?>
	</ul>
	<ul class="header__list">
		<li><a href="?action=logout"><i class="material-icons" style="transform:rotate(180deg)">exit_to_app</i><span>Log out</span></a></li>
	</ul>
</nav>
<header class="header__top--fixed header--style-primary" id="appBar">
</header>

	<!-- <?php if ($auth->auth_role == 'admin') : ?>
		<a href="/cms/products.php">products</a>
	<?php elseif ($auth->auth_role == 'retailer') : ?>
		<a href="/cms/retail_adress.php">Change address</a>
	<?php endif; ?>
	<a href="?action=logout">Logout</a> -->
<!-- Header (end) -->

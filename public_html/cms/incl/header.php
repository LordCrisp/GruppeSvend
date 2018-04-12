<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#2D2D2D" id="theme_color">
	<title>Admin | Fashion Online</title>
	<!-- Custom stylesheet -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/css/master.css">
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
<body class="admin__body">
<!-- Header (start) -->
<header>
	<a href="/cms/index.php">Dashboard</a>
	<?php if ($auth->auth_role == 'admin') {
		echo "<a href='/cms/products.php'>Products</a>";
		}
        if ($auth->auth_role == 'retailer' || 'admin') {
		echo "<a href='/cms/retail_address.php'>Change address</a>";
	    }?>

	<a href="?action=logout">Logout</a>
</header>
<!-- Header (end) -->

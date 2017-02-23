<?php 
	@session_start(); 
	include 'connection.php';
	include 'Entity/User.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php?page=home">Web Application</a>
				</div>
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php?page=home">Home</a></li>
					<?php 
					    if(isset($_SESSION['name'])){
					?>
					<li><a href="logout.php">Logout</a></li>
					<?php       
					    } else { 
					?>
					<li><a href="index.php?page=login">Login</a></li>
					<li><a href="index.php?page=register">Register</a></li>
					<?php } ?>
				</ul>
				<form method="post" action="index.php?page=search" class="navbar-form navbar-right">
					<div class="input-group">
						<input type="text" class="form-control" name='search_term' placeholder="Search">
						<div class="input-group-btn">
							<button class="btn btn-default" type="submit">
							<i class="glyphicon glyphicon-search"></i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</nav>
		<div class="content">
			<div class="row">
			    <div class="col-md-4 col-md-offset-4">
			<?php 
				isset($_REQUEST['page']) ? $page=$_REQUEST['page'] : $page='home';
				switch ($page) {
					case 'login':
						include('login.php');
						break;

					case 'register':
						include('register.php');
						break;	

					case 'search':
						include('search_results.php');
						break;	

					default:
						# code...
						break;
				}
			?>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</body>
</html>
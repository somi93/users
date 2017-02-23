<?php 
	@session_start();
	include 'Entity/User.php';
	$user = new User();
	$user->logout();
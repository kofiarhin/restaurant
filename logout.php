<?php 

	include "core/init.php";

	$user = new User;

	$user->logout();

	redirect::to('index.php');
<?php 
	
	include "header.php";
 ?>



 <?php 

 	if(!$user->has_permission('admin')) {

 		redirect::to('index.php');
 	}


 	$food = new food;

 	$orders = $food->get_orders();


 	var_dump($orders);

 	?> 


	
<?php 
	
	include "header.php";

 ?>


 <?php 


 		if(!$item = input::get('food')) {

 			redirect::to('index.php');



 		}


 		if(!$user->logged_in()) {


 			echo "<p class='error'>you need to <a href='login.php'>login</a> or  <a href='register.php'>register</a> to place order </p>";
 		} else {


 				 		if(input::exist()) {

 				 			$food = new Food();

 				 			$fields = array(

 				 				'user_id' => input::get('user_id'),
 				 				'item_id' => input::get('item_id'),
 				 				'order_date' => date('Y-m-d H:i:s'),
 				 				'status' => 0


 				 			);


 				 			$order = $food->order($fields);

 				 			if($order) {

 				 				redirect::to('index.php');
 				 			}



 				 		}

 				 		$food = new Food($item);

 				 		echo "<div class='wrapper'>";
 				 					echo "<form class='food' action='' method='post'>";
 					 					echo "<img src='uploads/".$food->data()->poster."'>";
 					 					echo "<p class='name'>".$food->data()->name."</p>";
 					 					echo "<p class='price'>GH₵ ".$food->data()->price."</p>";
 					 					echo "<input type='hidden' name='user_id' value ='".$user->data()->id."'>";
 					 					echo "<input type='hidden' name='item_id' value ='".$food->data()->id."'>";
 					 					echo "<button type='submit' name='submit'>Order</button>";
 				 					echo "</form>";
 				 		echo "</div>";


 		}


 		


  ?>
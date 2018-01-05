<?php 

	include "header.php";

 ?>


	<?php 

			if(!$user->has_permission('admin')) {

				redirect::to('index.php');
			}


			if(!$user->logged_in()) {

				redirect::to('index.php');
			}


			if(session::exist('food')) {

				echo "<p class='success'>".session::flash('food')."</p>";
			}


			$food = new food;

			if(input::exist()) {


				$fields = array(

					'name' => input::get('name'),
					'price' => input::get('price'),
					'poster' => file::upload(input::get('file')),
					'category' => input::get('category')

				);



				$new_food = $food->create_food($fields);

				if($new_food) {


					redirect::to('index.php');
				} else {

					echo "there was a problem adding item to menu";
				}


			}


	 ?>


	 <?php 

	 	$categories = $food->get_category();

	  ?>

	 <form action='' method='post' enctype='multipart/form-data'>
	 	<input type='text' name='name' placeholder='Name'>
	 	<input type='number' name='price' placeholder='Price'>

		<select name="category">
			<?php 

				foreach($categories as $category) {

					echo "<option value ='".$category->id."'>".$category->name."</option>";
				}

			 ?>
		</select>
	 	<input type='file' name='file'>
	 	<button name='submit' type='submit'>Submit</button>
	 </form>
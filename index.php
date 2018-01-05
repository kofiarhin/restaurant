<?php 

include "header.php";

?>	

					<?php 


						if(session::exist('order')) {

							echo "<p class='success'>".session::flash('order')."</p>";
						}

					 ?>

					<div class="wrapper">


						<?php 




						$food = new Food;

						$foods = $food->get_food();

						if($foods) {


							foreach($foods as $food) {

								$image = "uploads/".$food->poster;

								echo "<a href='item.php?food=".$food->id."' class='item'style='background-image: url(".$image.")'></a>";


							}

						} else {

							echo "<p class='message'>There are no items in menu</p>";
						}

						

	?>
				</div>
</body>
</html>	
<?php 

	include "core/init.php";

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Practice 1</title>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>

	<header>
		<div class="container">
			<div class="logo">Logo</div>

			<nav>
				<a href="index.php">Home</a>

				<?php 

					$user = new user;

					if($user->logged_in()) {

						echo "<a href='profile.php'>".$user->data()->username."</a>";

						if($user->has_permission('admin')) {

							echo "<a href='dashboard.php'>Dasboard</a>";
							echo "<a href='orders.php'>Orders</a>";
						} 

						echo "<a href='logout.php'>logout</a>";
					} else {

						echo "<a href='login.php'>login</a>";
						echo "<a href='register.php'>Register</a>";
					}


				 ?>
			</nav>
		</div>
	</header>


	<?php 

	 ?>
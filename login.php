<?php 

	include "header.php";

 ?>	
	<?php 
	

		if(session::exist('home')) {

			echo "<p class='success'>".session::flash('home')."<p>";
		}


		if(input::exist()) {

			$user = new User;

			$login = $user->login(input::get('username'), input::get("password"));

			if($login) {

				redirect::to('index.php');
			} else {

				echo "There was a problem loggin user in";
			}


		}

	 ?>


	 <form action='' method='post'>
	 	<input type='text' name='username' placeholder='Username'>
	 	<input type='text' name='password' placeholder='Password'>
	 	<button type='submit' name='submit'>Login</button>
	 </form>




</body>
</html>
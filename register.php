	<?php 

		include "header.php";

	 ?>

	<?php 




		if(input::exist()) {
			

			$salt = hash::salt(32);

			$password = hash::make(input::get('password'), $salt);

			$fields = array(

				'name' => input::get('name'),
				'username' => input::get('username'),
				'password' => $password,
				'salt' => $salt,
				'joined' => date('Y-m-d H:i:s'),
				'category' => 1

			);



			$account = $user->create($fields);

			if($account) {

				redirect::to('login.php');
			} else {

				echo "<p class='error'>there was a problem creating account</p>";
			}



		}

	 ?>

	 <form action='' method='post'>
	 	<input type='text' name='name' placeholder="Name" autofocus>
	 	<input type='text' name='username' placeholder='Userame'>
	 	<input type='passwrod' name='password' placeholder='Password'>
	 	<button name='submit' type='submit'>submit</button>
	 </form>
	
</body>
</html>
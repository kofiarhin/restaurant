<?php 

	class File {


		public static function upload($file) {

			$file_tmp_name = $file['tmp_name'];
			$file_error = $file['error'];
			$file_new_name = uniqid().".jpg";

			$destination = 'uploads/'.$file_new_name;

			if($file_error == 0) {
				
				if(move_uploaded_file($file_tmp_name, $destination)) {

					return $file_new_name;
				}
			}


			return "default.jpg";

			
		}


	}
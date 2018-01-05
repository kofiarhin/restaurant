<?php 

 	class User {


 		private $db = null,
				$session_name,
				$logged_in = false,
 				$data = array();
 		

 		public function __construct($user = null)  {

 			$this->db = db::get_instance();

 			$this->session_name = config::get('session/session_name');

 			if(!$user) {

 				if(session::exist($this->session_name)) {

 					$user = session::get($this->session_name);

 					if($this->find($user)) {

 						$this->logged_in = true;
 					}
 				} 
 			}


 		}



 		public function create($fields) {

 			$user = $this->find(input::get('username'));

 			if(!$user) {

 				if($this->db->insert('users', $fields)) {
 					
 					session::put("home", "Your account ".input::get('username')." was successfully created");
 					return true;
 				}
 			}


 			return false;
 		}


 		public function find($user = null) {

 			$field = (is_numeric($user)) ? 'id' : 'username';

 			$user = $this->db->get('users', array($field, '=', $user));

 			if($user->count()) {

 				$this->data = $user->first();
 				return true;
 			}

 			return false;
 		}


 		public function login($username, $password) {

 			$user = $this->find($username);

 			if($user) {

 				if($this->data()->password === hash::make($password, $this->data()->salt)) {

 					session::put($this->session_name, $this->data()->id);

 					return true;
 				}
 			}

 			return false;
 		}


 		public function data() {

 			return $this->data;
 		}

 		public function logged_in() {

 			return $this->logged_in;
 		}


 		public function logout() {

 			session::delete($this->session_name);
 		}

 		public function has_permission($key) {

 			$groups = $this->db->get('user_groups', array('id', '=', $this->data()->category));


 			if($groups->count()) {

 				$permissions = json_decode($groups->first()->permissions, true);

 				if($permissions[$key] == true) {

 					return true;
 				}
 				
 			}


 			return false;


 		}

 	}
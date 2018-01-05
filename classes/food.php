<?php 

	class Food {

		private $db = null,
				$data = array();

		public function __construct($food = null) {

			$this->db = db::get_instance();


			if($food) {

				$this->find($food);
			}

		}


		public function get_food() {

			$foods = $this->db->get('foods');

			if($foods->count()) {

				return $foods->result();
			}
		}


		public function get_category() {

			$categories = $this->db->get('food_groups');

			if($categories->count()) {

				return $categories->result();
			}

			return false;


		}


		public function find($food = null) {

			$field = (is_numeric($food)) ? 'id' : 'name';
			$food = $this->db->get('foods', array($field, '=', $food));

			if($food->count()) {

				$this->data = $food->first();

				return true;
			}

			return false;

		}

		public function create_food($fields) {

				$food = $this->find(input::get('name'));

				if(!$food) {

					if($this->db->insert('foods', $fields)) {

						return true;
					}
				}

				return false;
		}


		public function order($fields) {

			$order = $this->db->insert('orders', $fields);

			if($order) {
				session::flash("order", "You have successfully placed your order");
				return true;
			}

			return false;
		}
		

		public function data() {

			return $this->data;
		}


		public function get_orders() {

			$sql = "select users.name, 
					users.id, 
					foods.name as food_name 
					from orders 
					join users 
					on orders.user_id = users.id 
					left join foods 
					on orders.item_id = foods.id where orders.status = 0";

			$orders = $this->db->query($sql);

			if($orders->count()) {


				//var_dump($orders);

				return $orders->result();
			}


			return false;


		}

	}
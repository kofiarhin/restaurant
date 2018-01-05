<?php 

	class Db {


		private static $instance = null;

		private $pdo, $stmt, $result, $error = false, $count = 0;




		private function __construct() {

			$this->pdo = new PDO('mysql:host=localhost;dbname=restaurant', 'root', '');


		}

		

		public static function get_instance() {

			if(!isset(self::$instance)) {

				self::$instance = new Db;
			}


			return self::$instance;
			
		}


		public function query($sql, $fields = array()) {

			$this->error = false;

			if($this->stmt = $this->pdo->prepare($sql)) {


				if($fields) {
					//bind parameters to query
					$counter = 1;
					
					foreach($fields as $field) {
						$this->stmt->bindValue($counter, $field);
						$counter+=1;
					}	
				}


				if($this->stmt->execute()) {

					$this->result = $this->stmt->fetchAll(PDO::FETCH_OBJ);
					$this->count = $this->stmt->rowCount();
				}
			}


			return $this;
		}


		public function get($table, $where = array()) {

			$sql = "select * from {$table}";

			if($where && count($where) === 3) {

				$field = $where[0];
				$condition = $where[1];
				$value = $where[2];

				$sql .=" where {$field} {$condition} ?";

				if(!$this->query($sql, array($value))->error()) {

					return $this;
				}

			} else if(!$where) {

				if(!$this->query($sql)->error()) {

					return $this;
				}

			}

			return false;
		}


		public function insert($table, $fields) {

			$columns = implode(", ", array_keys($fields));
			$marks = "";
			$counter = 1;

			foreach($fields as $field) {

				$marks .="?";

				if($counter < count($fields)) {

					$marks .=", ";
				}

				$counter ++;
			}

			$sql = "insert into {$table} ({$columns}) values ({$marks})";

			if(!$this->query($sql, $fields)->error()) {

				return true;
			}

			return false;
		}


		public function update($table, $fields, $id) {

			$set ="";
			$counter = 1;

			foreach($fields as $field => $field_value) {

					$set .="{$field} = ?";

					if($counter < count($fields)) {

						$set .=", ";
					}

					$counter+=1;

			}

			$sql = "update {$table} set {$set} where id = $id";

			if(!$this->query($sql, $fields)->error()) {

				echo "account update";

				return true;
			}

			return false;
		}
		//general getters

		public function error() {

			return $this->error;
		}


		public function result() {

			return $this->result;
		}


		public function first() {

			return $this->result[0];
		}

		public function count() {

			return $this->count;
		}
	}
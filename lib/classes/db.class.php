<?php

	class Database {
		
		public $db_host;
		public $db_username;
		public $db_password;
		public $database;
		public $table;
		public $result_as_object;
		public $error;
		public $supress;
		public $query;
		
		private $last_row;
		private $last_result;
		public $result_count;
				
		protected static $link;
		
		static public function init() {
			
			return new Database(DB_USER, DB_PASSWORD, DB_HOST, DB_NAME);
		
		}
		
		public function __construct($username, $password, $host, $database){
			
			$this->db_password = $password;
			$this->db_host = $host;
			$this->db_username = $username;
			$this->database = $database;
			
			self::$link = mysql_pconnect($this->db_host, $this->db_username, $this->db_password);
			
			if(self::$link){
			
				$result = mysql_select_db($this->database, self::$link);
				
			}else {
			
				$this->displayError("Fatal Error: Could not select the database.");
				
			}
			return $this;
		}	
				
		protected function query($qstring){

			$this->last_result = mysql_query($qstring, self::$link);
			
			//echo "<!--{$qstring}:".mysql_error()."-->";
			
			$this->result_count = mysql_num_rows($this->last_result);
			
			$this->last_row = mysql_fetch_assoc($this->last_result);
			
			$this->query = $qstring;

			if(!$this->last_row){
			
				//$this->displayError("\nError: Could not query the database.", $qstring);
				
			}		
					
		}
		
		public function numresults($qstring){

			//$this->query($q);
			
			return mysql_num_rows($this->last_result);
		
		}
		
		protected function as_array(){
			
			$array[] = $this->last_row;
			
			if($this->last_result){
				
				while($row = mysql_fetch_assoc($this->last_result)){
					
					$array[] = $row;
					
				}
				
				return $array;
				
				mysql_free_result($this->last_result);
		
			}else {
				
				if(!$this->supress){
				
					$this->displayError("Warning: Query string was empty.");
					
				}
			
			}
			
		}
		
		public function query_as_array($q){
		
			$this->query($q);
			return $this->as_array();
			//should close the conn here
		
		}
		
		//alt cuz I'm too lazy to write "query_as_array" every time...
		
		public function q($q){
		
			$this->query($q);
			return $this->as_array();
			//should close the conn here
		
		}
		
		public function insert($qstring){
		
			if(!mysql_query($qstring)){
				
				if(!$this->supress){
					
					$this->displayError("Warning: Query string was empty.", $qstring);
					
				}
				
			}
		
		}
		
		public function update($qstring){
		
			if(!mysql_query($qstring)){
				
				if(!$this->supress){
				
					$this->displayError("Warning: Query string was empty.", $qstring);
					
				}
				
			}
		
		}
		
		public function delete($qstring){
		
			if(!mysql_query($qstring)){
				
				if(!$this->supress){
				
					$this->displayError("Warning: Query string was empty.", $qstring);
					
				}
				
			}
		
		}
		
		public function as_obj($result){
			
			if(!empty($result)){
			
				$this->mysql_fetch_object($result);
		
			}else {
			
				$this->displayError("Warning: Query string was empty.");
			
			}
			
		}
		
		private function displayError($message = false, $query = false){
		
			if($message){
				
				$message ."<br />";
				echo $query;
					
					if(!$this->last_row){
					
						$message .= "<p>Query: ". stripslashes($query) ."<p>";
					
					}
				
				echo $message;
				
			}else {
			
				die("Fatal Error: Could not connect to the database.");
				
			}
		
		}
		
		private function sqlError($query){
		
			$this->error = $query;
		
		}
		
	}

?>
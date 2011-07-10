<?php


	class Storage {
	
		protected static $db;
		
		public function __construct(){
			
			$this->db = Database::init();
			
			session_name('PHP_SESS_ID');
			session_start();
		
		}
		
		public function set($key, $value){
		
			$_SESSION[$key] = $value;
		
		}
		
		public function setall($array){
		
			if(is_array($array)){
			
				foreach($array as $key => $value){
					
					foreach($value as $k => $v){
					
						$_SESSION[$k] = $v;
					
					}
				
				}
				
			}
			
		}
		
		public function get($key = false){
			
			if($key){
			
				return $_SESSION[$key];
			
			}else {
			
				return false;
			
			}
		
		}
		
		public function kill($key){
		
			unset($_SESSION[$key]);
		
		}
		
		public function session_defaults(){
			
			//global $user;
			
			$loadsettings = $this->db->q("SELECT setting_slug, setting_value FROM trkr_settings");
			
			//could just do setall($loadsettings) instead
					
			foreach($loadsettings as $s){
			
				$this->set($s['setting_slug'], $s['setting_value']);
				
			}
			
			//$this->set("user_theme", $user->GetLastLoggedInTheme());
		
		}
		
		public function destroy(){
			
			session_regenerate_id();
			session_destroy();
		
		}
		
		public function debug(){
		
			print_r($_SESSION);
		
		}
		
		public function init(){
		
			return new Storage;
		
		}
	
	}

?>
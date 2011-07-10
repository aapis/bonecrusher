<?php
	
	class User {
		
		public $db_name;
		public $storage;
		
		private $name;
		private $id;
		private $email;
		private $group;
		private $last_visit;
		private $theme;
		
		protected $db;
		
		public function __construct(){
			
			global $site;
			
			$this->db = Database::init();
			$this->storage = Storage::init();
			
			//set user vars
			
			$this->name = $this->storage->get("user_name");
			$this->id = $this->storage->get("user_id");
			$this->email = $this->storage->get("user_email");
			$this->group = $this->storage->get("user_group");
			$this->last_visit = $this->storage->get("user_last_visit");
			$this->theme = $this->storage->get("user_theme");
			
		}
		
		/*	Start unified getter and setter functions */
		
		public function name($value = null){
			if (is_null($value)){
				return $this->name;
			} else {
				//Some sort of validation logic goes here
				$this->name = $value;
			}
		}
		
		public function id($value = null){
			if (is_null($value)){
				return $this->id;
			} else {
				//Some sort of validation logic goes here
				$this->id = $value;
			}	
		}
		
		public function email($value = null){
			if (is_null($value)){
				return $this->email;
			} else {
				//Some sort of validation logic goes here
				$this->email = $value;
			}
		}
		
		public function group($value = null){
			if (is_null($value)){
				return $this->group;
			} else {
				//Some sort of validation logic goes here
				$this->group = $value;
			}
		}
		
		public function last_visit($value = null){
			if(is_null($value)){
				return $this->last_visit;
			} else {
				//Some sort of validation logic goes here
				$this->last_visit = $value;
			}
		}
		
		public function theme($value = null){
			if(is_null($value)){
				return $this->theme;
			} else {
				//Some sort of validation logic goes here
				$this->theme = $value;
			}
		}
		
		/*	End getter and setter functions	*/
		
		
		public function test(){
		
			$this->storage->debug();
		
		}
		
		public function is_admin(){
			
			$id = $this->storage->get('user_id');
		
			$userInfo = $this->db->query_as_array("SELECT user_group FROM ". $this->db_name ."_users WHERE user_id = ". $id);
			
			if($userInfo[0]['user_group'] == 1){
			
				return TRUE;
			
			}else {
			
				return FALSE;
			
			}
		
		}
		
		public function is_mod(){
			
			$id = $this->storage->get('user_id');
		
			$userInfo = $this->db->query_as_array("SELECT user_group FROM ". $this->db_name ."_users WHERE user_id = ". $id);
			
			if($userInfo[0]['user_group'] == 2){
			
				return TRUE;
			
			}else {
			
				return FALSE;
			
			}
		
		}
		
		public function logged(){
		
			if($this->storage->get('user_id') && $this->storage->get('user_email')){
			
				return TRUE;
			
			}else {
			
				return FALSE;
			
			}
		
		}
		
		public function LoginInterface(){
		
			if($_GET['do'] != "register"){
			
				if(isset($_POST['cannonball'])){
				
					return $this->login();
				
				}else {
					
					if($_GET['msg'] == "success"){
					
						$this->DisplayError("Registration was successful.  Login below.", "Success");
					
					}
					
					echo "<p>Javascript must be enabled.</p>";
					
					echo "<form method='post' action=''>";
						
						echo "<input type='text' name='email' id='email' placeholder='Email' />";
						echo "<input type='password' name='pass' id='pass' placeholder='Password' /><br />";
						echo "<input type='submit' name='cannonball' value='Login' id='post' />";
						
					echo "</form>";
				
				}
				
			}elseif($_GET['do'] == "register"){
			
				return $this->RegistrationInterface();
			
			}elseif($_GET['do'] == "login"){
			
				return $this->LoginInterface();
			
			}else {
			
				return $this->DisplayError("Invalid action.", "Error", true);
			
			}
		
		}
		
		private function login(){
			
			global $site;
			
			$e = Securitizor::Stripper($_POST['email']);
			$p = Securitizor::Stripper($_POST['pass']);
			
			if(!empty($e) && !empty($p)){
			
				$q = $this->db->query_as_array("SELECT user_name, user_email, user_id, user_group, user_last_visit, user_theme FROM ". $this->db_name ."_users WHERE (user_email = '$e' AND user_password = SHA1('$p'))");
				
				if(count($q[0]) > 1){
					
					if(is_null($q[0]['user_theme'])){
					
						$this->db->update("UPDATE trkr_users SET user_theme = ". $site->theme ." WHERE user_id = ". $q[0]['user_id']);
						$this->storage->set("user_theme", $site->theme);
					
					}
					
					$this->storage->setall($q);
					
					$loadsettings = $this->db->q("SELECT setting_slug, setting_value FROM trkr_settings");
					
					foreach($loadsettings as $s){
					
						$this->storage->set($s['setting_slug'], $s['setting_value']);
						
					}
					
					header("Location:content.php");
				
				}else{
				
					$this->DisplayError("Invalid login credentials");
				
				}
				
			}else {
			
				$this->DisplayError("Invalid login credentials.");
			
			}
				
		
		}
		
		public function logout(){
		
			global $site, $user;
			
			$q = $this->db->insert("UPDATE ". $this->db_name ."_users SET user_last_visit = ". time() ." WHERE user_id = ". $user->storage->get("user_id"));
			
			$this->storage->destroy();
			
			$this->redirect();
			
		}
		
		private function redirect($do = false){
			
			//just temporary so theme resets to the user's logged in theme after logout
			
			if(!$do){
			
				header("Location:dashboard/admin.php?do=r");
				
			}else {
			
				header("Location:". $site->url);
			
			}
		
		}
		
		private function RegistrationInterface(){
		
			if($this->storage->get("registration")){
				
				echo "<p><em class='inactive'>Please enter your desired login details.</em></p>";
				
				echo "<form method='post' action=''>";
					echo "<table width='100%' cellspacing='0' cellpadding='0' border='0'>";
					
					echo "<tr>";
						echo "<td width='140' align='right'><label for='user_name'>Username: </label></td>";
						echo "<td align='left'><input type='text' name='user_name' id='user_name' /></td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td width='140' align='right'><label for='user_email'>Email: </label></td>";
						echo "<td align='left'><input type='text' name='user_email' id='user_email' /></td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td width='140' align='right'><label for='user_password'>Password: </label></td>";
						echo "<td align='left'><input type='password' name='user_password' id='user_password' /></td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td width='140' align='right'><label for='conf_password'>Confirm Password: </label></td>";
						echo "<td align='left'><input type='password' name='conf_password' id='conf_password' /></td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td></td>";
						echo "<td>&nbsp;</td>";
					echo "</tr>";
					echo "<tr>";
						echo "<td></td>";
						echo "<td><input type='submit' value='Register' name='submit' id='post' /></td>";
						echo "<input type='hidden' name='giveupthe' value='grudge' />";
					echo "</tr>";
					
					echo "</table>";
				echo "</form>";
				
			}else {
			
				return $this->DisplayError("Registrations are currently disabled by the administrator(s).");
			
			}
		
		}
				
		public function UserRegistration($username, $password, $conf_password, $email){
		
			if(empty($username) || empty($password) || empty($conf_password) || empty($email)){
				
				$this->DisplayError("Please fill out all required fields.");
				
			}else if($password != $conf_password){
			
				$this->DisplayError("Your passwords do not match.  Please try again.");
			
			}else {
				
				if($this->Validate($username, "user_name") && $this->Validate($email, "user_email")){
					
					$password = sha1($password);
					
					$register = $this->db->insert("INSERT INTO trkr_users(user_name, user_email, user_password, user_theme, user_group, user_last_visit) VALUES('". $username ."', '". $email ."', '". $password ."', '". $this->storage->get("defaulttheme") ."', '3', '". time() ."')");
					
					header("Location:index.php?do=login&msg=success");
				
				}
			
			}
		
		}
		
		private function Validate($input, $table){
		
			$user = $this->db->q("SELECT ". $table ." FROM trkr_users WHERE ". $table ." = '". Securitizor::Stripper($input) ."'");
			
			if(!empty($user[0])){
			
				return FALSE;
			
			}else {
			
				return TRUE;
			
			}
		
		}

		public function GetLastLoggedInTheme(){
		
			$u = $this->db->q("SELECT user_theme FROM trkr_users WHERE user_last_visit  IN(SELECT MAX(user_last_visit) as max FROM trkr_users)");
			
			return $u[0]['user_theme'];
		
		}
		
		// Generic error message
		// returns STRING
		
		public function DisplayError($message, $title = "Error", $die = false){
		
			if(isset($message)){
				
				if(!$die){
					
					echo "<li class='item header'>". $title ."</li><li class='item'>". $message ."</li>";
				
				}else{
				
					die("<li class='item header'>". $title ."</li><li class='item'>". $message ."</li>");
				
				}
				
			}else {
				
				if($die){
				
					echo "<li class='item header'>". $title ."</li><li class='item'>No items available</li>";
				
				}else{
				
					die("<li class='item header'>". $title ."</li><li class='item'>No items available</li>");
				
				}
				
			}
		
		}
	
	}

?>
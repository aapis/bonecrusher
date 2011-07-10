<?php


/*				DEVELOPMENT NOTES				

	Apr 30th, 9:00AM	KJS - Optimizing file source
	Apr 29th, 4:14PM	KJS - This is the tracker class before transitioning to list elements for the rendering of content

*/
	class Tracker {
	
		// vars
		
		public $name;
		public $description;
		public $copyyear;
		public $meta;
		public $url;
		public $theme;
		public $homedir;
		
		private $types;
		
		protected static $db;
		
		// methods
		
		
		// Construct
		
		public function __construct(){
			
			$this->db = Database::init();
			$this->db->supress = 0;
			$this->storage = Storage::init();
			
		}
		
		// Load and display all the bugs
		// returns HTML
		
		public function DisplayAllBugs(){
		
			if(!isset($_GET['completed'])){
			
				$query = "SELECT * FROM trkr_bugs WHERE bug_status != 'complete' && bug_con = 1";
			
			}else {
			
				$query = "SELECT * FROM trkr_bugs WHERE bug_con = 1";
			
			}
			
			if(isset($_GET['user'])){
			
				$query .= " AND bug_assignee = ". Securitizor::Stripper($_GET['user']);
						
			}
			
			if(isset($_GET['level'])){
			
				$query .= " AND bug_level = ". Securitizor::Stripper($_GET['level']);
			
			}
			
			if(isset($_GET['group'])){
			
				$query .= " AND bug_group = ". Securitizor::Stripper($_GET['group']);
							
			}
						
			$groups = $this->db->query_as_array("SELECT group_id, group_name FROM trkr_groups");
			
			echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";	
				
			$i = 1;
				
				foreach($groups as $group){
						
					$items = $this->db->query_as_array($query. " AND bug_group = ". $group['group_id'] ." ORDER BY bug_id DESC");
					
					if($this->db->result_count != 0){
					
						echo "<tr>";
							echo "<td colspan='4' class='item header'><a href='". $this->url ."group/". $group['group_id'] ."/'>". $group['group_name'] ."</a></td>\n";
						echo "</tr>\n";
						
						foreach($items as $item){
							$class = ($i++ % 2) ? "r1" : "r2";
							
							echo "<tr>\n";
							
								echo "<td class='item ". $class ."'>#". $item['bug_id'] .".  <a href='". $this->url ."bug/". $item['bug_id'] ."/'>". $this->TruncateOutput($item['bug_summary'], 70) ."</a></td>\n";
								echo "<td width='200' class='item user ". $class ."' align='right'>". $this->GetName($item['bug_assignee']) ."</td>\n";
								echo "<td width='100' class='item ". $class ." ". $this->BugStatus($item['bug_status']) ."' align='center'>". ucwords($item['bug_status']) ."</td>\n";
								
							echo "</tr>\n";
							
							//$i++;	//KJS - Can post increment in one operation, combined with the $i % mod line above
							
						}
					
					}
						
				}
				
				echo "</table>";
		
		}
		
		// Load and display all info for the selected bug
		// returns HTML
		
		public function DisplayUniqueBug(){
			
			global $user;
			
			$bugs = $this->db->query_as_array("SELECT * FROM trkr_bugs WHERE bug_id = ". Securitizor::Stripper($_GET['bug']));
				
				if($bugs[0]['bug_status'] == "review" || $bugs[0]['bug_status'] === "complete"){
					
					echo "<li class='item header'>Bug #". $bugs[0]['bug_id'] ."<span class='status nopad ". $this->BugStatus($bugs[0]['bug_status']) ."'>". ucwords($bugs[0]['bug_status']) ."</span></li>";
						
				}else {
					
					if($bugs[0]['bug_assignee'] == $user->id()){
					
						echo "<li class='item header'>Bug #". $bugs[0]['bug_id'] ."<span class='status nopad ". $this->BugStatus($bugs[0]['bug_status']) ."'><a href='". $this->url ."bug.php?b=". $bugs[0]['bug_id'] ."'>Review</a></span><span class='status nopad ". $this->BugStatus($bugs[0]['bug_status']) ."'>". ucwords($bugs[0]['bug_status']) ."</span></li>";
					
					}else {
					
						echo "<li class='item header'>Bug #". $bugs[0]['bug_id'] ."<span class='status nopad ". $this->BugStatus($bugs[0]['bug_status']) ."'>". ucwords($bugs[0]['bug_status']) ."</span></li>";
					
					}
					
				}
				
				echo "<li class='item'>Level: ". $bugs[0]['bug_level'] ."</li>";
				echo "<li class='item'>". $this->GetName($bugs[0]['bug_assignee']) ."</li>";
				
				if(!is_null($bugs[0]['bug_submitter'])){	
					echo "<li class='item'>Submitted by ". $this->GetName($bugs[0]['bug_submitter'], false) ."</li>";
				}
				
				echo "<li class='item'>Group: ". $this->GroupName($bugs[0]['bug_group']) ."</li>";
				
				if($bugs[0]['bug_phours'] != 0){
					echo "<li class='item'>Projected Hours: ". $bugs[0]['bug_phours'] ."</li>";
				}
				
				if(!is_null($bugs[0]['bug_ahours'])){
					echo "<li class='item'>Actual Hours: ". $bugs[0]['bug_ahours'] ."<span class='status'><a href='#'>Add Hours</a></span></li>";
				}
				
				echo "<li class='item'><strong>". $bugs[0]['bug_summary'] ."</strong></li>";
				
				$this->LoadComments($bugs[0]['bug_id']);
		
		}
				
		// Load and display all bugs with overhead
		// returns HTML
		
		private function DisplayDelayedBugs(){
			
			if(!isset($_GET['type'])){
						
				die("Invalid type");
			
			}elseif($_GET['type'] == "delayed") {
				
				$delayed = $this->db->query_as_array("SELECT * FROM trkr_bugs WHERE bug_phours < bug_ahours AND bug_status != 'complete'");
				
				if(count($delayed) > 1){
					
					$i = 1;
					
					$query = "SELECT * FROM trkr_bugs WHERE bug_phours < bug_ahours AND bug_status != 'complete'";
								
					$groups = $this->db->query_as_array("SELECT group_id, group_name FROM trkr_groups");
					
					echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
					
						foreach($groups as $group){
							
							$items = $this->db->query_as_array($query. " AND bug_group = ". $group['group_id'] ." ORDER BY bug_id DESC");
							
							if($this->db->result_count != 0){
							
								echo "<tr>";
									echo "<td colspan='4' class='item header'>". $group['group_name'] ."<span class='status totaloverhead'>Total Overhead: <strong>". $this->GroupOverhead($group['group_id']) ."</strong> hours</span></td>\n";
								echo "</tr>\n";
								
								foreach($items as $item){
								
									$class = ($i++ % 2) ? "r1" : "r2";
									$hours = $item['bug_ahours'] - $item['bug_phours'];
									
									echo "<tr>\n";
									
										echo "<td class='item ". $class ."'>#". $item['bug_id'] .".  <a href='". $this->url ."bug/". $item['bug_id'] ."/'>". $this->TruncateOutput($item['bug_summary'], 70) ."</a></td>\n";
										echo "<td width='200' class='item user ". $class ."' align='right'>". $this->GetName($item['bug_assignee']) ."</td>\n";
										echo "<td width='100' class='item ". $class ." ". $this->BugStatus($item['bug_status']) ."' align='center'>". ucwords($item['bug_status']) ."</td>\n";
										echo "<td width='150' class='item totaloverhead ". $class ."' align='center'>Overhead: ". $hours ." hours</td>\n";
										
									echo "</tr>\n";									
								}
							
							}
							
					}
					
					echo "</table>";
					
				}else {
				
					$this->DisplayError("There are no delayed tasks.");
				
				}
				
			}elseif($_GET['type'] == "assign"){
			
				//stuff here
			
			}
		
		}
		
		private function DisplayUserSubmittedBugs(){
			
			if($_GET['type'] == "usersubbugs") {
			
				if($_GET['do'] == "return"){
				
					echo "<table border='0' cellspacing='0' cellpadding='0' width='100%'>";
						
						echo "<tr>";
							echo "<td class='item header' colspan='4'>Task updated</td>";
						echo "</tr>";
						echo "<tr>";
							echo "<td class='item' colspan='4'>New status set for task #". $_GET['id'] ."</td>";
						echo "</tr>";
						
					echo "</table>";
					
					echo "<br />";
				
				}
				
				$delayed = $this->db->query_as_array("SELECT * FROM trkr_bugs WHERE bug_con = 0 AND bug_status != 'complete'");
				
				if(count($delayed[0]) > 1){
				
					$i = 1;
			
					$query = "SELECT * FROM trkr_bugs WHERE bug_con = 0 AND bug_status != 'complete'";
								
					$groups = $this->db->query_as_array("SELECT group_id, group_name FROM trkr_groups");
					
					echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
					
						foreach($groups as $group){
							
							$items = $this->db->query_as_array($query. " AND bug_group = ". $group['group_id'] ." ORDER BY bug_id DESC");
							
							if($this->db->result_count != 0){
							
								echo "<tr>";
									echo "<td colspan='4' class='item header'><a href='". $this->url ."group/". $group['group_id'] ."/'>". $group['group_name'] ."</a></td>\n";
								echo "</tr>\n";
								
								foreach($items as $item){
								
									$class = ($i++ % 2) ? "r1" : "r2";
									$hours = $item['bug_ahours'] - $item['bug_phours'];
									
									echo "<tr>\n";
									
										echo "<td class='item ". $class ."'>#". $item['bug_id'] .".  <a href='". $this->url ."bug/". $item['bug_id'] ."/'>". $this->TruncateOutput($item['bug_summary'], 70) ."</a></td>\n";
										echo "<td class='item ". $class ."' width='120' align='right'><label for='approve". $item['bug_id'] ."'>Approve </label><input type='checkbox' onclick='ChangeTaskStatus(". $item['bug_id'] .", this.value);'  name='theme_status' id='approve". $item['bug_id'] ."' /></td>";
										echo "<td class='item ". $class ."' width='20'><a href='". $this->url ."dashboard/admin.php?type=usersubbugs&del=". $item['bug_id'] ."' onclick='return confirm(\"Are you sure you want to delete bug #". $item['bug_id'] ."?\");'><img src='". $this->url . "images/cross.png' title='Delete' /></a></td>";
										
									echo "</tr>\n";
								}
							
							}
							
					}
					
					echo "</table>";
					
				}else {
				
					$this->DisplayError("There are no user submitted tasks waiting for approval.");
				
				}
				
			}elseif($_GET['type'] == "assign"){
			
				//stuff here
			
			}
		
		}
		
		private function DisplaySettings(){
		
			$i = 1;
			
			$setting_groups = array(array("name" => "site", "id" => 1), array("name" => "users", "id" => 2));
			
			echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
				
				foreach($setting_groups as $group){
					
					$settings = $this->db->q("SELECT * FROM trkr_settings WHERE setting_group = ". $group['id']);
					
					if(count($settings[0]) > 1){
						
						echo "<tr>";
							echo "<td colspan='5' class='item header'>". $group['name'] ."</td>\n";
						echo "</tr>\n";
						
						foreach($settings as $setting){
						
							$class = ($i++ % 2) ? "r1" : "r2";
							
							echo "<tr>";
								echo "<td class='item ". $class ."'>". ucwords($setting['setting_name']) ."</td>";
								//echo "<td class='item'>". $setting['setting_slug'] ."</td>";
								
								if($setting['setting_slug'] == "defaulttheme"){
									
									echo "<td class='item ". $class ."' align='right'><a href='../css/". $this->ParseTheme($setting['setting_value']) ."' target='_blank'>". str_replace(".css", "", ucwords($this->ParseTheme($setting['setting_value']))) ."</a></td>";
									
								}else {
									
									if($setting['setting_value'] == 1){
									
										$bool = "Enabled";
									
									}elseif($setting['setting_value'] == 0){
									
										$bool = "Disabled";
									
									}else {
									
										$bool = $setting['setting_value'];
									
									}
									
									echo "<td class='item ". $class ."' align='right'>". $bool ."</td>";
								
								}
								
								//echo "<td class='item'>". $setting['setting_id'] ."</td>";
								
							echo "</tr>";
													
						}
						
					}
					
				}
				
				
				
			echo "</table>";
		
		}
			
		private function ModerateTasks(){
			
			if(!isset($_GET['type'])){
						
				die("Invalid type");
			
			}elseif($_GET['type'] == "modbugs") {
				
				$delayed = $this->db->query_as_array("SELECT * FROM trkr_bugs WHERE bug_status != 'complete'");
				
				if(count($delayed[0]) > 1){
					
					$i = 1;
					
					$query = "SELECT * FROM trkr_bugs WHERE bug_status != 'complete'";
								
					$groups = $this->db->query_as_array("SELECT group_id, group_name FROM trkr_groups");
					
					echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";	
					
					foreach($groups as $group){
							
						$items = $this->db->query_as_array($query. " AND bug_group = ". $group['group_id'] ." ORDER BY bug_id DESC");
						
						if($this->db->result_count != 0){
							
							echo "<tr>";
								echo "<td colspan='5' class='item header'>". $group['group_name'] ."</td>\n";
							echo "</tr>\n";
							
							foreach($items as $item){
								
								$class = ($i++ % 2) ? "r1" : "r2";
								$hours = $item['bug_ahours'] - $item['bug_phours'];
								
								echo "<tr>\n";
								
									echo "<td class='item ". $class ."'>#". $item['bug_id'] .".  <a href='". $this->url ."bug/". $item['bug_id'] ."/'>". $this->TruncateOutput($item['bug_summary'], 50) ."</a></td>\n";
									echo "<td width='200' class='item user ". $class ."' align='right'>". $this->GetName($item['bug_assignee']) ."</td>\n";
									echo "<td width='100' class='item ". $class ." ". $this->BugStatus($item['bug_status']) ."' align='center'>". ucwords($item['bug_status']) ."</td>\n";
									echo "<td width='20' class='item totaloverhead ". $class ."' align='right'><a href='". $this->url ."dashboard/mod.php?type=modbugs&del=". $item['bug_id'] ."' onclick='return confirm(\"Are you sure you want to delete bug #". $item['bug_id'] ."?\");' class='btn'><img title='Delete' style='position: relative; top: 3px;' src='", $this->url ,"images/cross.png' alt='delete'/></a></td>\n";
									echo "<td width='30' class='item totaloverhead ". $class ."' align='left'><a href='", $this->url ,"dashboard/content.php?type=bug&id=". $item['bug_id'] ."' class='btn'><img src='", $this->url ,"images/comment_edit.png' title='Edit' alt='edit'/></a></td>\n";
									
								echo "</tr>\n";
							}
						
						}
							
					}
					
					echo "</table>";
					
				}else {
				
					$this->DisplayError("There are no delayed tasks.");
				
				}
				
			}
		
		}
		
		public function ModerateUsers(){
			
			global $user;
			
			if($user->is_admin()){
			
				if(!isset($_GET['id'])){
					
					$groups = $this->db->q("SELECT * FROM trkr_usergroup");
					
					$i = 1;
					
					echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
					
					foreach($groups as $group){
						
						echo "<tr>";
							echo "<td class='item header'>". $group['ugroup_name'] ."</td>\n";
							echo "<td class='item header' align='right'>Email</td>";
							echo "<td class='item header'>Completed</td>";
							echo "<td colspan='2' class='item header'></td>";
						echo "</tr>\n";
						
						$users = $this->db->q("SELECT user_name, user_id, user_email, user_bug_count FROM trkr_users WHERE user_group = ". $group['ugroup_id']);
						
						if(!empty($users[0])){
							
							foreach($users as $u){
							
								$class = ($i++ % 2) ? "r1" : "r2";
							
								echo "<tr>\n";
									
									echo "<td class='item ". $class ."'>#". $u['user_id'] . ". <strong>". $u['user_name'] ."</strong></td>";
									echo "<td class='item ". $class ."' width='200' align='right'>". $u['user_email'] ."</td>";
									
									if(!is_null($u['user_bug_count'])){
									
										echo "<td class='item ". $class ."' width='30' align='center'>". $u['user_bug_count'] ."</td>";
										
									}else {
									
										echo "<td class='item ". $class ."' width='30' align='center'>0</td>";
									
									}
									
									echo "<td width='20' class='item totaloverhead ". $class ." del' align='left'><a href='". $this->url ."dashboard/mod.php?type=modusers&del=". $u['user_id'] ."' onclick='return confirm(\"Are you sure you want to delete user #". $u['user_id'] ."?\");' class='btn'><img title='Delete' src='", $this->url ,"images/cross.png' alt='delete'/></a></td>\n";
									echo "<td width='20' class='item totaloverhead ". $class ."' align='right'><a href='", $this->url ,"dashboard/mod.php?type=modusers&id=". $u['user_id'] ."'><img src='", $this->url ,"images/comment_edit.png' title='Edit' alt='edit' class='btn'/></a></td>\n";
								
								echo "</tr>";							
							}
						
						}else {
						
							echo "<td class='item r1' colspan='5'>No users found.</td>";
						
						}
					
					}
					
					echo "</table>";
				
				}else {
				
					if(is_numeric($_GET['id'])){
						
						$u = $this->db->q("SELECT * FROM trkr_users WHERE user_id = ". intval($_GET['id']));
						$groups = $this->db->q("SELECT * FROM trkr_usergroup");
						
						echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
							echo "<form method='post' action=''>";
							
								echo "<tr>\n";
									echo "<td class='item header'>Edit User Information</td>";
									echo "<td class='item header'></td>";
								echo "</tr>\n";
								echo "<tr>\n";
									echo "<td class='item'>User: <input type='text' name='user_name' value='". $u[0]['user_name'] ."' /></td>";
									echo "<td class='item'></td>";
								echo "</tr>\n";
								echo "<tr>\n";
									echo "<td class='item'>Group: <select name='user_group'>";
										
										foreach($groups as $group){
											
											if($group['ugroup_id'] == $u[0]['user_group']){
											
												echo "<option value='". $group['ugroup_id'] ."' selected='selected'>". ucwords($group['ugroup_name']) ."</option>";
											
											}else {
											
												echo "<option value='". $group['ugroup_id'] ."'>". ucwords($group['ugroup_name']) ."</option>";
											
											}
										
										}
									echo "</select></td>";
									echo "<td class='item'></td>";
								echo "</tr>\n";
								echo "<tr>\n";
									echo "<td class='item'>Email: <input type='text' name='user_email' value='". $u[0]['user_email'] ."' /></td>";
									echo "<td class='item'></td>";
								echo "</tr>\n";
								
								if($u[0]['user_group'] == 1){
								
									echo "<tr>\n";
										echo "<td class='item'>Colour (comments): #<input type='text' name='user_colour' value='". $u[0]['user_colour'] ."' /></td>";
										echo "<td class='item'></td>";
									echo "</tr>\n";
									
								}
								echo "<tr>\n";
									echo "<td class='item'>Theme: <select name='user_theme'>";
										
										$themes = $this->db->q("SELECT * FROM trkr_themes WHERE theme_status = 1");
										
										echo "<option>Select...</option>";
										
										foreach($themes as $theme){
											
											if($user->theme() == $theme['theme_id']){
												
												echo "<option value='". $theme['theme_id'] ."' selected='selected'>". $theme['theme_name'] ."</option>";
												
											}else {
											
												echo "<option value='". $theme['theme_id'] ."'>". $theme['theme_name'] ."</option>";
											
											}
											
											
										
										}
										
									echo "</select></td>";
									echo "<td class='item'></td>";
								echo "</tr>\n";
								echo "<tr>\n";
									echo "<td class='item'><input type='submit' name='grinfucked' value='Edit User' id='post'/></td>";
									echo "<td class='item' align='right'><a href='mod.php?type=modusers' class='btn'>Cancel</a></td>";
								echo "</tr>\n";
							
							echo "</form>";
						echo "</table>";
						echo "<p>Comment preview:</p>";
						echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
							echo "<tr>";
							
								if($u[0]['user_group'] < 3){
									
									echo "<td class='item header nocaps nobg' style='background-color: #". $u[0]['user_colour'] .";'><img src='". $this->url ."images/Security.png' class='adminpostimg' title='Site Administrator' /><span class='admintxtwrap'>". $u[0]['user_name'] ."</span></td>";
									echo "<td align='right' class='header item nobg' style='background-color: #". $u[0]['user_colour'] .";'>". date("m/j/y g:iA", time()) ." #1</td>";
								
								}else {
								
									echo "<td class='item header nocaps'>". $u[0]['user_name'] ."</td>";
									echo "<td align='right' class='header item'>". date("m/j/y g:iA", time()) ." #1</td>";
								
								}
								
							echo "</tr>";
							echo "<tr>";
								echo "<td class='item' colspan='3'>I am a demo comment.</td>";
							echo "</tr>";
						echo "</table>";
						
					}
				
				}
			
			}
		
		}
		
		public function ModerateUserGroups(){
		
			//return $this->DisplayError("This feature doesn't do anything yet: ". $_GET['type']);
			
			if(!isset($_GET['id'])){
			
				$ugroups = $this->db->q("SELECT * FROM trkr_usergroup ORDER BY ugroup_id");
				
				echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
					
					echo "<tr>";
						echo "<td class='item header' colspan='3'>Groups</td>\n";
					echo "</tr>\n";
					
					$i = 1;
					
					foreach($ugroups as $project){
					
						$class = ($i++ % 2) ? "r1" : "r2";

					
						echo "<tr>\n";
							echo "<td class='item ". $class ."'>". ucwords($project['ugroup_name']) ."</td>\n";
							
							if($project['ugroup_id'] != 1){
								
								echo "<td width='20' class='item totaloverhead del ". $class ."' align='center'><a href='". $this->url ."dashboard/mod.php?type=modusergroups&del=". $project['ugroup_id'] ."' onclick='return confirm(\"Are you sure you want to delete user #". $project['ugroup_id'] ."?\");' class='btn'><img title='Delete' src='", $this->url ,"images/cross.png' alt='delete'/></a></td>\n";
								echo "<td width='20' class='item totaloverhead ". $class ."' align='center'><a href='", $this->url ,"dashboard/mod.php?type=modusergroups&id=". $project['ugroup_id'] ."'><img src='", $this->url ,"images/comment_edit.png' title='Edit' alt='edit' class='btn'/></a></td>\n";
								
							}
							
						echo "</tr>\n";					
					}
					
				echo "</table>";
			
			}else {
			
				header("Location:content.php?type=usergroup&id=". $_GET['id']);
			
			}
		
		}
		
		public function ModerateProjects(){
		
			if(!isset($_GET['id'])){
			
				$projects = $this->db->q("SELECT * FROM trkr_groups ORDER BY group_id");
				
				echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
					
					echo "<tr>";
						echo "<td class='item header' colspan='3'>Groups</td>\n";
					echo "</tr>\n";
					
					$i = 1;
					
					foreach($projects as $project){
					
						$class = ($i++ % 2) ? "r1" : "r2";
					
						echo "<tr>\n";
							echo "<td class='item ". $class ."'>". ucwords($project['group_name']) ."</td>\n";
							echo "<td width='20' class='item totaloverhead ". $class ."' align='center'><a class='btn' href='". $this->url ."dashboard/mod.php?type=modprojects&del=". $project['group_id'] ."' onclick='return confirm(\"Are you sure you want to delete user #". $project['group_id'] ."?\");'><img title='Delete' src='", $this->url ,"images/cross.png' alt='delete' class='imgbump' /></a></td>\n";
							echo "<td width='40' class='item totaloverhead ". $class ."' align='center'><a class='btn' href='", $this->url ,"dashboard/mod.php?type=modprojects&id=". $project['group_id'] ."'><img src='", $this->url ,"images/comment_edit.png' title='Edit' alt='edit' class='imgbump' /></a></td>\n";
						echo "</tr>\n";
											
					}
					
				echo "</table>";
			
			}else {
			
				header("Location:content.php?type=group&id=". $_GET['id']);
			
			}
		
		}
		
		public function ModerateComments(){
		
			if(!isset($_GET['id'])){
				
				$bugs = $this->db->q("SELECT * FROM trkr_bugs WHERE bug_status != 'complete' ORDER BY bug_id DESC");
				
				echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
				
				$i = 1;
				
					foreach($bugs as $bug){
						
						$comments = $this->db->q("SELECT * FROM trkr_comments WHERE comment_bid = ". $bug['bug_id']);
			
						if(!empty($comments[0])){
						
							echo "<tr>";
								echo "<td class='item header' colspan='4'><a href='". $this->url ."bug/". $bug['bug_id'] ."/'>#". $bug['bug_id'] .". ". $this->TruncateOutput($bug['bug_summary'], 90) ."</a></td>\n";
							echo "</tr>\n";
													
							foreach($comments as $comment){
							
								$class = ($i++ % 2) ? "r1" : "r2";
												
								echo "<tr>\n";
									echo "<td class='item ". $class ."'>#". $comment['comment_id'] .". ". $this->TruncateOutput($comment['comment_content'], 90) ."</td>\n";
									echo "<td class='item ". $class ."' width='50'>". $this->GetName($comment['comment_uid'], false) ."</td>";
									echo "<td width='40' class='item totaloverhead del ". $class ."' align='right'><a href='". $this->url ."dashboard/mod.php?type=modcomments&del=". $comment['comment_id'] ."' onclick='return confirm(\"Are you sure you want to delete comment #". $comment['comment_id'] ."?\");' class='btn'><img title='Delete' src='", $this->url ,"images/cross.png' alt='delete'/></a></td>\n";
									//echo "<td width='20' class='item totaloverhead ". $class ."' align='center'><a href='", $this->url ,"dashboard/mod.php?type=modcomments&id=". $comment['comment_id'] ."'><img src='", $this->url ,"images/comment_edit.png' title='Edit' alt='edit'/></a></td>\n";
								echo "</tr>\n";
																
							}
							
						}
					
					}
					
				echo "</table>";
			
			}else {
			
				
			
			}
		
		}
		
		// Group overhead totals
		// returns INT
		
		private function GroupOverhead($group){
		
			$ovh = $this->db->query_as_array("SELECT SUM(bug_ahours - bug_phours) as overhead FROM trkr_bugs WHERE bug_phours < bug_ahours AND bug_status != 'complete' AND bug_group = ". $group);
			
			return $ovh[0]['overhead'];
		
		}
		
		// Total overhead
		// returns INT
		
		private function TotalOverhead(){
		
			$ovh = $this->db->query_as_array("SELECT SUM(bug_ahours - bug_phours) as overhead FROM trkr_bugs WHERE bug_phours < bug_ahours AND bug_status != 'complete'");
			
			return $ovh[0]['overhead'];
		
		}
		
		// Turn a group id into a group name
		//returns STRING
		
		public function GroupName($id){
		
			$group = $this->db->query_as_array("SELECT group_name FROM trkr_groups WHERE group_id = ". $id);
			
			return ucwords($group[0]['group_name']);
		
		}
		
		public function UserGroupName($id){
		
			$group = $this->db->query_as_array("SELECT ugroup_name FROM trkr_usergroup WHERE ugroup_id = ". $id);
			
			return ucwords($group[0]['ugroup_name']);
		
		}
		
		// Turns user_id into user name
		// returns STRING
		
		public function GetName($ue, $formatting = true){
		
			$u = $this->db->query_as_array("SELECT user_name FROM trkr_users WHERE user_id = ". $ue);
			
			if($formatting){
				
				if(!empty($u[0])){
					
					return "Assigned to <a href='". $this->url ."user/". $ue ."/'>". $u[0]['user_name'] ."</a>";
					
				}else {
				
					return "Unassigned";
				
				}
				
			}else {
			
				return $u[0]['user_name'];
			
			}
					
		}
		
		private function GetColour($user){
		
			$colour = $this->db->query_as_array("SELECT user_colour FROM trkr_users WHERE user_id = ". $user);
			
			return $colour[0]['user_colour'];
		
		}
		
		// Checks the status of the bug, changes container class accordingly
		// returns STRING
		
		private function BugStatus($bug){
		
			switch($bug){
			
				case "complete":
					return "green";
				break;
				
				case "incomplete":
					return "red";
				break;
				
				case "in progress":
					return "yellow";
				break;
				
				case "review":
					return "purple";
				break;
				
				default: 
					return "green";
				break;
			
			}
		
		}
		
		// Loads generic content
		// returns HTML
		
		public function GenericContent(){
		
			global $user;

			echo "<li class='item header'>Welcome back to ". $this->name .", <span class='nocaps'>". $user->name() ."</span></li>\n";
			echo "<li class='item'>Last visit on ". date("m/j/y g:iA", $user->last_visit()) ."</li>";
			echo "<li class='item'><strong>New</strong> to create new content, <strong>Moderate</strong> to edit existing content, and <strong>Administrate</strong> to view reports and manage existing tasks.";
			
			$this->IconList();
		
		}
		
		private function IconList(){
			
			global $user;
			
			if($user->is_admin()){
				
				$query = "SELECT * FROM trkr_types";
				
			}elseif($user->is_mod()){
			
				$query = "SELECT * FROM trkr_types WHERE type_page = 'mod' OR type_page = 'messages'";
			
			}else{
			
				$query = "SELECT * FROM trkr_types WHERE type_page != 'admin' AND type_page != 'mod'";
			
			}
			
			$this->types = $this->db->q($query);
		
			echo "<div id='sectionlinks'>";
				echo "<div id='links'>";
					
					foreach($this->types as $type){
					
						echo "<a class='button' href='". $type['type_page'] .".php?type=". $type['type_name'] ."' id='". $type['type_name'] ."'>";
						echo "<span>". $type['type_output_name'] ."</span></a>";
						
					}
			
				echo "</div>";		
			echo "</div>"; 
			
			echo "<div class='clear'></div>";
		
		}
		
		// Loads and displays reports for admins
		// returns HTML
		
		public function DisplayReport(){
		
			$bug = $this->db->query_as_array("SELECT COUNT(bug_id) as count FROM trkr_bugs");
			
				echo "<li class='item header'>Task Stats</li>";
				echo "<li class='item'>Total Tasks: <strong>". $bug[0]['count'] ."</strong> (". $this->UserBugStatus("complete") ." completed, ". $this->UserBugStatus("in progress") ." in progress and ". $this->UserBugStatus("incomplete") ." incomplete)</li>";
				echo "<li class='item'>MVD: ". $this->RankMostCompleted() ."</li>";
				
				if(!is_null($this->TotalOverhead())){
					
					echo "<li class='item'>Total amount of overhead: <strong>". $this->TotalOverhead() ."</strong><a class='floatright' href='admin.php?type=delayed'>Details</a></li>";
					
				}
				
		
		}
		
		// Loads the task assignment interface
		// returns HTML
		
		public function AssignTasks(){
		
			$unassigned_tasks = $this->db->query_as_array("SELECT COUNT(bug_id) as count FROM trkr_bugs WHERE bug_assignee = 0 AND bug_status != 'complete'");
			
			if($unassigned_tasks[0]['count'] > 0){
				
				$i = 1;
						
				$groups = $this->db->query_as_array("SELECT group_id, group_name FROM trkr_groups");
				
					foreach($groups as $group){
					
						$items = $this->db->query_as_array("SELECT * FROM trkr_bugs WHERE bug_assignee = 0 AND bug_status != 'complete' AND bug_group = ". $group['group_id'] ." ORDER BY bug_id DESC");
						
							if($this->db->result_count != 0){
							
								echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";	
							
									echo "<tr>";
										echo "<td colspan='4' class='item header'>". $group['group_name'] ."</td>\n";
									echo "</tr>\n";
								
								foreach($items as $item){
									
									$class = ($i++ % 2) ? "r1" : "r2";
									$hours = $item['bug_ahours'] - $item['bug_phours'];
									
									echo "<tr>\n";
									
										echo "<td class='item ". $class ."'>#". $item['bug_id'] .".  <a href='". $this->url ."bug/". $item['bug_id'] ."/'>". $this->TruncateOutput($item['bug_summary'], 70) ."</a></td>\n";
										echo "<td width='200' class='item user ". $class ."' align='right'>Assign to: ". $this->UserList($item['bug_id']) ."</td>\n";
										echo "<td width='100' class='item ". $class ." ". $this->BugStatus($item['bug_status']) ."' align='center'>". ucwords($item['bug_status']) ."</td>\n";
										
									echo "</tr>\n";									
								}
							
							}
								
						}
						
					echo "</table>";
				
				}else {
				
					$this->DisplayError("There are currently no unassigned tasks.");
				
				}
		
		}
		
		// Displays completed tasks
		// returns HTML
		
		public function DisplayCompletedTasks(){
		
			$unassigned_tasks = $this->db->query_as_array("SELECT COUNT(bug_id) as count FROM trkr_bugs WHERE bug_status = 'complete'");
			
			if($unassigned_tasks[0]['count'] > 0){
				
				$i = 1;
					
				$groups = $this->db->query_as_array("SELECT group_id, group_name FROM trkr_groups");
				
					foreach($groups as $group){
					
						$items = $this->db->query_as_array("SELECT * FROM trkr_bugs WHERE bug_status = 'complete' AND bug_group = ". $group['group_id'] ." ORDER BY bug_id DESC");
						
							if($this->db->result_count != 0){
							
								echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";	
							
									echo "<tr>";
										echo "<td colspan='4' class='item header'>". $group['group_name'] ."</td>\n";
									echo "</tr>\n";
								
								foreach($items as $item){
								
									$class = ($i++ % 2) ? "r1" : "r2";
								
									$hours = $item['bug_ahours'] - $item['bug_phours'];
									
									echo "<tr>\n";
									
										echo "<td class='item ". $class ."'>#". $item['bug_id'] .".  <a href='". $this->url ."bug/". $item['bug_id'] ."/'>". $this->TruncateOutput($item['bug_summary'], 70) ."</a></td>\n";
										echo "<td width='100' class='item ". $class ." ". $this->BugStatus($item['bug_status']) ."' align='center'>". ucwords($item['bug_status']) ."</td>\n";
										
									echo "</tr>\n";									
								}
							
							}
								
						}
						
					echo "</table>";
				
				}else {
				
					$this->DisplayError("No tasks have been completed yet.");
				
				}
		
		}
		
		public function DisplayReviewable(){
			
			if(!isset($_GET['do'])){
				
				$_GET['do'] = "review";
			
			}
			
			$unassigned_tasks = $this->db->query_as_array("SELECT COUNT(bug_id) as count FROM trkr_bugs WHERE bug_status = '". Securitizor::Stripper($_GET['do']) ."'");
			
			if($unassigned_tasks[0]['count'] > 0){
					
				$i = 1;
				
				$groups = $this->db->query_as_array("SELECT group_id, group_name FROM trkr_groups");
				
					foreach($groups as $group){
					
						$items = $this->db->query_as_array("SELECT * FROM trkr_bugs WHERE bug_status = '". Securitizor::Stripper($_GET['do']) ."' AND bug_group = ". $group['group_id'] ." ORDER BY bug_id DESC");
						
							if($this->db->result_count != 0){
							
								echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";	
							
									echo "<tr>";
										echo "<td colspan='4' class='item header'>". $group['group_name'] ."</td>\n";
									echo "</tr>\n";
								
								foreach($items as $item){
									
									$class = ($i++ % 2) ? "r1" : "r2";
									$hours = $item['bug_ahours'] - $item['bug_phours'];
									
									echo "<tr>\n";
									
										echo "<td class='item ". $class ."'>#". $item['bug_id'] .".  <a href='". $this->url ."bug/". $item['bug_id'] ."/'>". $this->TruncateOutput($item['bug_summary'], 60) ."</a></td>\n";
										
										if($_GET['do'] != "complete"){
											
											echo "<td width='200' class='item user ". $class ."' align='right'>Set status: ". $this->StatusList($item['bug_id']) ."</td>\n";
											
										}
										
										echo "<td width='100' class='item ". $class ." ". $this->BugStatus($item['bug_status']) ."' align='center'>". ucwords($item['bug_status']) ."</td>\n";
										
									echo "</tr>\n";
																		
								}
							
							}
								
						}
						
					echo "</table>";
				
				}else {
				
					$this->DisplayError("There are no tasks for review.");
				
				}
		
		}
		
		// Modifies output based on query string
		// returns HTML
		
		public function ModLoad(){
			
			global $user;
			
			if(isset($_GET['type'])){
			
				switch($_GET['type']){
					 		
			 		case "delayed":	
			 			return $this->DisplayDelayedBugs(); 
			 		break;
			 		
			 		case "report":
			 			return $this->DisplayReport();
			 		break;
			 		
			 		case "assign":
			 			return $this->AssignTasks();
			 		break;
			 		
			 		case "completed":
			 			return $this->DisplayCompletedTasks();
			 		break;
			 		
			 		case "status":
			 			return $this->DisplayReviewable();
			 		break;
			 		
			 		case "modbugs":
			 			return $this->ModerateTasks();
			 		break;
			 		
			 		case "modprojects":
			 			return $this->ModerateProjects();
			 		break;
			 		
			 		case "modusers":
			 			return $this->ModerateUsers();
			 		break;
			 		
			 		case "modusergroups":
			 			return $this->ModerateUserGroups();
			 		break;
			 		
			 		case "modcomments":
			 			return $this->ModerateComments();
			 		break;
			 		
			 		case "newmessages":
			 			return MessageCenter::NewMessages();
			 		break;
			 		
			 		case "savedmessages":
			 			return MessageCenter::SavedMessages();
			 		break;
			 		
			 		case "directmessages":
			 			return MessageCenter::DirectMessages();
			 		break;
			 		
			 		case "themes":
			 			return $this->ManageThemes();
			 		break;
			 		
			 		case "editprofile":
			 			return $this->EditProfile();
			 		break;
			 		
			 		case "usersubbugs":
			 			return $this->DisplayUserSubmittedBugs();
			 		break;
			 		
			 		case "settings":
			 			return $this->DisplaySettings();
			 		break;
			 		
			 		default:
			 			return $this->GenericContent();
			 		break;
			 		
			 	}
			 	
			 }else {
			 
			 	$this->GenericContent();
			 
			 }
			 
			 if($_GET['do']){
			 
			 	switch($_GET['do']){
			 	
			 		case "logout":
			 			$user->logout();
			 		break;
			 		
			 		//temporary hack so changing themes changes the theme instantly, look for a better solution than 2 page reloads...
			 		case "r":
			 			$user->redirect(true);
			 		break;
			 		
			 		//case "register":
			 			//return $user->RegistrationInterface();
			 		//break;
			 	
			 	}
			 
			 }
		
		}
		
		// Modifies public content output
		// returns HTML
		
		public function LoadContent(){
		
			global $user;
			
			if(isset($_GET['user'])){
			
				$this->DisplayUserStats();	
				
			}
			
			switch($_GET['do']){
			
				case "search":
					return $this->DisplaySearchResults();
				break;
				
				case "logout":
					return $user->logout();
				break;
				
				default:
					return $this->DisplayAllBugs();
				break;
			
			}
			
		}
		
		// Loads and displays comments on the selected bug
		// returns HTML
		
		private function LoadComments($id){
			
			global $user;
			
			$comments = $this->db->query_as_array("SELECT * FROM trkr_comments WHERE comment_bid = ". $id ." AND comment_bid IS NOT NULL ORDER BY comment_time ASC");
			
			echo "<br />";
			
			if(count($comments[0]) > 1){
				
				$i = 1;
				
				echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
				
				foreach($comments as $comment){
					
					if($this->GetUserLevel($comment['comment_uid']) < 3){
						
						echo "<tr>";
							echo "<td colspan='5' class='item header nocaps nobg' style='background-color: #". $this->GetColour($comment['comment_uid']) .";'><img src='". $this->url ."images/Security.png' class='adminpostimg' title='Site Administrator' /><span class='admintxtwrap'>". $this->GetName($comment['comment_uid'], false) ."</span><span class='date'>". date("m/j/y g:iA", $comment['comment_time']) ." #". $i ."</span></td>";
						echo "</tr>";
						echo "<tr>";
						
					}else {
					
						echo "<tr>";
							echo "<td colspan='4' class='item header nocaps'>". $this->GetName($comment['comment_uid'], false) ."</td>";
							echo "<td align='right' class='header item' width='150'>". date("m/j/y g:iA", $comment['comment_time']) ." #". $i ."</td>";
						echo "</tr>";
						echo "<tr>";
					
					}
					
					if($user->logged() && ($user->is_admin() || $user->is_mod())){
						
						echo "<td colspan='4' class='item'>". $comment['comment_content'] ."</td>"; 
						echo "<td class='item' align='right'><a href='". $this->url ."dashboard/mod.php?type=modcomments&del=". $comment['comment_id'] ."' onclick='return confirm(\"Are you sure you want to delete comment #". $comment['comment_id'] ."?\");' class='floatright'><img src='". $this->url ."images/Delete.png' class='adminpostimg' /></a></td>";
						
					}else {
					
						echo "<td colspan='5' class='item'>". $comment['comment_content'] ."</td>";
					
					}
						
					echo "</tr>";
					
					$i++;
					
				}
				
				echo "</table>";
			
			}else {
			
				$this->DisplayError("This issue has no comments.  Add one below.", "Whoops!");
			
			}
			
			echo "<br />";
			
			if($user->logged() && $this->PostAcceptsComments($id)){
			
				echo "<form method='post' action=''>";
					
					echo "<div for='comment' class='header' style='padding: 10px 15px; margin-bottom: -1px;'>Add Your Comment</div>";
					echo "<textarea id='comment' name='comment' placeholder='U COMMENT PLZ' class='comment'></textarea><br />";
					echo "<input type='hidden' name='bid' value='". $id ."' />";
					
					$nonceSHA = sha1(time()."saltychunkoftuna38293".mt_rand());
					$nonceIntegrityCheck = sha1($nonceSHA."mildflavouredtunaloaf"); //Use more secure salt to prevent form injection
					
					echo "<input type='hidden' name='nonce' value='{$nonceSHA}' />";
					echo "<input type='hidden' name='inonce' value='{$nonceIntegrityCheck}' />";
					echo "<input type='submit' value='Post Comment' id='post' class='floatright' />";
					echo "<div class='clear'></div>";
				echo "</form>";
			
			}elseif(!$this->PostAcceptsComments($id)){
			
				return $this->DisplayError("Completed tasks cannot be commented on.", "Comments disabled");
			
			}
		
		}
		
		private function PostAcceptsComments($id){
		
			$status = $this->db->q("SELECT bug_status FROM trkr_bugs WHERE bug_id = ". $id);
			
			return ($status[0]['bug_status'] !== "complete");
		}
		
		public function LinkParser($str){
		
			//Courtesy of https://gist.github.com/942112
		
			$pattern = "/(#)([0-9]+)/";
			$replace = "<a href='". $this->url ."bug/$2/'>#$2</a>";
			return preg_replace($pattern, $replace, $str);
		
		}
		
		// Modifies string length
		// returns STRING
		
		public function TruncateOutput($text, $limit = 80, $ending = '...'){
		
			if (strlen($text) > $limit) {
			
				$text = strip_tags($text);
				$text = substr($text, 0, $limit);
				$text = substr($text, 0, -(strlen(strrchr($text, ' '))));
				$text = $text . $ending;
				
			}
	
			return $text;
		
		}
		
		// Generates the list of groups in a <select> menu
		// returns HTML
		
		public function GroupList(){
		
			$groups = $this->db->query_as_array("SELECT group_id, group_name FROM trkr_groups");
			
			if(count($groups) > 1){
			
					echo "\n\t\t<select onchange='changeGroup(this);'>\n";
					
						echo "\t\t\t<option value='0'>All Groups</option>\n";
						
						foreach($groups as $group){
							
							echo "\t\t\t<option value='". $group['group_id'] ."'>". ucwords($group['group_name']) ."</option>\n";
							
						}
					
					echo "\t\t</select>\n";
					
					return $list;
			
			}
			
		}
		
		// Generates the user list
		// returns HTML
		
		public function UserList($id = false){
			
			$usergroups = $this->db->q("SELECT * FROM trkr_usergroup");
			
			//$users = $this->db->query_as_array("SELECT user_name, user_id FROM trkr_users WHERE user_group < 3");
			
			//if(count($users) > 0){
				
				if(!$id){
				
					$list = "\n\t\t<select onchange='assignUser(this);'>\n";
				
				}else {
				
					$list = "\n\t\t<select onchange='assignUser(this, ". $id .");'>\n";
				
				}
				
					$list .= "\t\t\t<option>Choose...</option>";
					
					foreach($usergroups as $g){
					
						$users = $this->db->q("SELECT user_name, user_id FROM trkr_users WHERE user_group = ". $g['ugroup_id']);
						
						if(count($users[0]) > 1){
							
							$list .= "\t\t\t<option disabled='disabled'>". ucwords($g['ugroup_name']) ."</option>";
							
							foreach($users as $u){
							
								$list .= "\t\t\t<option value='". $u['user_id'] ."'>". $u['user_name'] ."</option>\n";
								
							}
							
						}
						
					}
				
				$list .= "\t\t</select>\n";
			
				return $list;
				
			//}
			
		}
		
		// Generates the list of possible bug statuses
		// returns HTML
		
		public function StatusList($id){
				
			$list = "\n\t\t<select onchange='modifyStatus(this, ". $id .");'>\n";
				
				$list .= "\t\t\t<option value='complete'>Choose...</option>";
				$list .= "\t\t\t<option value='complete'>Complete</option>";
				$list .= "\t\t\t<option value='incomplete'>Incomplete</option>";
				$list .= "\t\t\t<option value='in progress'>In Progress</option>";
				$list .= "\t\t\t<option value='review'>Review</option>";
				
			$list .= "\t\t</select>\n";
		
			return $list;
			
		}
		
		// Calculates and displays basic user stats
		// returns HTML
		
		public function DisplayUserStats(){
		
			echo "<div class='quickstats'>\n<p class='item header'>User Stats</p>";
				echo "<p>User has completed ". $this->UserBugStatus("complete") .", has ". $this->UserBugStatus("in progress") ." in progress and has ". $this->UserBugStatus("incomplete") ." left to complete.  They rank ". $this->UserRank() . " out of ". $this->TotalUsers() ."</p>";
			echo "</div>";
			echo "<br />";
			echo "<div class='item header'><img src='". $this->url ."images/bug.png' /> Assigned Bugs</div>";
		
		}
		
		// Calculates how many bugs one has contributed to
		// returns STRING
		
		private function UserBugStatus($status){
		
			if(isset($_GET['user'])){
				
				$bugs = $this->db->query_as_array("SELECT bug_id FROM trkr_bugs WHERE bug_assignee = ". Securitizor::Stripper($_GET['user']) ." AND bug_status = '". $status ."'");
			
			}else {
			
				$bugs = $this->db->query_as_array("SELECT bug_id FROM trkr_bugs WHERE bug_status = '". $status ."'");
			
			}
			
			if(count($bugs) == 1){
				
				return "<strong>". count($bugs) . "</strong> task";
			
			}elseif(count($bugs) == 0){
			
				return "<strong>0</strong> tasks";
			
			}elseif(count($bugs) > 1){
			
				return "<strong>". count($bugs) ."</strong> tasks";
			
			}
		
		}
		
		// Determines how each user is ranked against the rest of the members
		// returns INT
		
		private function UserRank(){
		
			//$bugs = $this->db->query_as_array("SELECT bug_id FROM trkr_bugs WHERE bug_assignee = ". Securitizor::Stripper($_GET['user']) ." AND bug_status = '". $status ."'");
			
			return "<strong>X</strong>";
		
		}
		
		private function RankMostCompleted(){
		
			$bug_count = $this->db->query_as_array("SELECT user_name, MAX(user_bug_count) AS count FROM trkr_users GROUP BY user_id LIMIT 1");
			
			return $bug_count[0]['user_name']. " with ". $bug_count[0]['count'] ." completed.";
			
		}
		
		// Counts all the users in the database
		// returns STRING
		
		private function TotalUsers(){
		
			$users = $this->db->query_as_array("SELECT COUNT(user_id) as count FROM trkr_users");
			
			return "<strong>". $users[0]['count'] ."</strong>";
		
		}
		
		public function ProcessRequest(){
		
			global $user;
		
			if(isset($_GET['u']) && isset($_GET['s']) && isset($_GET['i'])){
				
				$u = Securitizor::Stripper($_GET['u']);
				$id = Securitizor::Stripper($_GET['i']);
				
				$this->db->insert("UPDATE trkr_bugs SET bug_assignee = ". $u .", bug_status = 'in progress' WHERE bug_id = ". $id);
				
				header("Location:mod.php?type=assign");
				
			}elseif(isset($_GET['b'])){
			
				if(is_numeric($_GET['b'])){
				
					$id = Securitizor::Stripper($_GET['b']);
					
					$this->db->insert("UPDATE trkr_bugs SET bug_status = 'review' WHERE bug_id = ". $id);
					
					//mail stuff here
					
					header("Location:". $this->url ."bug/". $id ."/");
					
				}
			
			}elseif(isset($_GET['a']) && isset($_GET['c'])){
			
				if(is_numeric($_GET['c']) && $_GET['type'] == "review"){
				
					$id = Securitizor::Stripper($_GET['c']);
					$status = Securitizor::Stripper($_GET['a']);
					
					$this->db->insert("UPDATE trkr_bugs SET bug_status = '". $status ."' WHERE bug_id = ". $id);
					
					if($status == "complete"){
					
						header("Location:admin.php?type=completed");
					
					}else {
					
						header("Location:admin.php?type=status&do=". $status);
						
					}
				
				}
			
			}elseif(isset($_POST['bid'])){
				
				//comments
				
				if(is_numeric($_POST['bid'])){
				
					$id = Securitizor::Stripper($_POST['bid']);
					
					//$comment = $this->CommentParser($_POST['comment']);
					$bbcode = new BBCode;
					$bbcode->SetSmileyURL($this->url ."images/smileys");
					
					$comment = Securitizor::Stripper($bbcode->Parse($_POST['comment']));
					
					//First ensure that this is the first posting of this message
					//Check integrity of nonce before querying the DB, to avoid malicious or senseless hits
					
					//NOTE: nonce isn't inserted into the DB?
					
					$passesCheck = true;
					
					$passesCheck = isset($_POST['nonce']) && isset($_POST['inonce']);
					$passesCheck = $passesCheck ? (sha1($_POST['nonce']."mildflavouredtunaloaf") == $_POST['inonce']) : false;
					
					if ($passesCheck){
						$this->db->insert("INSERT IGNORE INTO trkr_comments(comment_uid, comment_bid, comment_content, comment_time, comment_nonce) VALUES(
								'". $user->id() ."',
								'". $id ."',
								'". $comment ."',
								'". time() ."','"
								.$_POST['nonce']."')");
					}
					
					//die($this->db->query);
					//header("Location:". $this->url ."bug/". $id ."/");
				
				}
			
			}elseif(isset($_GET['del']) && is_numeric($_GET['del'])){
			
				if($user->is_admin()){
					
					if($_GET['type'] == "modbugs"){
					
						$validate = $this->db->q("SELECT COUNT(bug_id) as count FROM trkr_bugs WHERE bug_id = ". $_GET['del']);
						
						if($validate[0]['count'] == 1){
					
							$this->db->delete("DELETE FROM trkr_bugs WHERE bug_id = ". $_GET['del']);
							
						}else {
						
							$this->DisplayError("Task could not be found in the database.");
						
						}
						
					}elseif($_GET['type'] == "modusers"){
					
						$validate = $this->db->q("SELECT COUNT(user_id) as count FROM trkr_users WHERE user_id = ". $_GET['del']);
						
						if($validate[0]['count'] == 1){
					
							$this->db->delete("DELETE FROM trkr_users WHERE user_id = ". $_GET['del']);
							
						}else {
						
							$this->DisplayError("Task could not be found in the database.");
						
						}
					
					}elseif($_GET['type'] == "modprojects"){
					
						$validate = $this->db->q("SELECT COUNT(bug_id) as count FROM trkr_groups WHERE group_id = ". $_GET['del']);
						
						if($validate[0]['count'] == 1){
					
							$this->db->delete("DELETE FROM trkr_groups WHERE group_id = ". $_GET['del']);
							
						}else {
						
							$this->DisplayError("Task could not be found in the database.");
						
						}
					
					}elseif($_GET['type'] == "modcomments"){
					
						$validate = $this->db->q("SELECT COUNT(comment_id) as count FROM trkr_comments WHERE comment_id = ". $_GET['del']);
						
						if($validate[0]['count'] == 1){
					
							$this->db->delete("DELETE FROM trkr_comments WHERE comment_id = ". $_GET['del']);
							
						}else {
						
							$this->DisplayError("Comment could not be found in the database.");
						
						}
					
					}elseif($_GET['type'] == "themes"){
					
						$validate = $this->db->q("SELECT COUNT(theme_id) as count FROM trkr_themes WHERE theme_id = ". $_GET['del']);
						
						if($validate[0]['count'] == 1){
						
							unlink("../css/". $this->ParseTheme($_GET['del']));
							
							$this->db->delete("DELETE FROM trkr_themes WHERE theme_id = ". $_GET['del']);
							
						}else {
						
							$this->DisplayError("Comment could not be found in the database.");
						
						}
					
					}elseif($_GET['type'] == "usersubbugs"){
					
						$validate = $this->db->q("SELECT COUNT(bug_id) as count FROM trkr_bugs WHERE bug_id = ". $_GET['del']);
						
						if($validate[0]['count'] == 1){
							
							$this->db->delete("DELETE FROM trkr_bugs WHERE bug_id = ". $_GET['del']);
							
						}else {
						
							$this->DisplayError("Comment could not be found in the database.");
						
						}
					
					}elseif($_GET['type'] == "modusergroups"){
					
						$validate = $this->db->q("SELECT COUNT(ugroup_id) as count FROM trkr_usergroup WHERE ugroup_id = ". $_GET['del']);
						
						if($validate[0]['count'] == 1){
							
							$this->db->delete("DELETE FROM trkr_usergroup WHERE ugroup_id = ". $_GET['del']);
							
						}else {
						
							$this->DisplayError("Comment could not be found in the database.");
						
						}
					
					}
				
				}else {
				
					$this->DisplayError("You are not permitted to perform that action.");
				
				}
			
			}elseif(($_GET['type'] == "modusers" || $_GET['type'] == "editprofile" || $this->GetPageName("23") == "profile.php") && isset($_POST['grinfucked'])){
				
				$query = "UPDATE trkr_users SET ";
				
				if(!empty($_POST['user_name'])){
					
					if($_GET['type'] == "editprofile" || $this->GetPageName("23") == "profile.php"){
						
						$this->storage->set("user_name", $_POST['user_name']);
						
					}
					
					$query .= "user_name = '". Securitizor::Stripper($_POST['user_name']) ."', ";
					
				}
				
				if(!empty($_POST['user_email'])){
					
					if($_GET['type'] == "editprofile" || $this->GetPageName("23") == "profile.php"){
						
						$this->storage->set("user_email", $_POST['user_email']);
						
					}
					
					$query .= "user_email = '". Securitizor::Stripper($_POST['user_email']) ."', ";
					
				}
				
				if($this->GetUserLevel($_GET['id']) == 2){
					
					$query .= "user_colour = 'fb7878', ";
				
				}elseif(!empty($_POST['user_colour'])){
				
					$query .= "user_colour = '". Securitizor::Stripper($_POST['user_colour']) ."', ";
				
				}
				
				$this->storage->set("user_theme", $_POST['user_theme']);
				$query .= "user_theme = '". Securitizor::Stripper($_POST['user_theme']). "', ";
				
				if(!empty($_POST['user_group'])){
					
					$query .= "user_group = '". $_POST['user_group'] ."' ";
					
				}
				
				$this->db->update($query ." WHERE user_id = ". $_GET['id']);
				
				if($_GET['type'] == "modusers"){
					
					header("Location:". $this->url ."dashboard/mod.php?type=modusers&id=". $_GET['id']);
					
				}elseif($_GET['type'] == "editprofile" || $this->GetPageName("23") == "profile.php"){
				
					header("Location:". $this->url ."dashboard/profile.php");
				
				}
				
			}elseif($_GET['type'] == "themes" && isset($_GET['status'])){
			
				$this->db->update("UPDATE trkr_themes SET theme_status = ". $_GET['status'] ." WHERE theme_id = ". $_GET['id']);
				
				header("Location:". $this->url ."dashboard/admin.php?type=themes&do=return&id=". $_GET['id']);
			
			}elseif($_GET['type'] == "usersubbugs" && isset($_GET['status'])){
			
				$this->db->update("UPDATE trkr_bugs SET bug_con = ". intval($_GET['status']) ." WHERE bug_id = ". intval($_GET['id']));
				
				header("Location:". $this->url ."dashboard/admin.php?type=usersubbugs&do=return&id=". $_GET['id']);
			
			}elseif($_GET['do'] == "register" && $_POST['submit'] && $_POST['giveupthe'] == "grudge"){
			
				$user->UserRegistration($_POST['user_name'], $_POST['user_password'], $_POST['conf_password'], $_POST['user_email']);
			
			}elseif(isset($_POST['query'])){
			
				header("Location:". $this->url ."search/". Securitizor::Urlitizer($_POST['q']) ."/");
				
			}
			
		}
		
		public function ParseTheme($id){
		
			$theme = $this->db->q("SELECT theme_name FROM trkr_themes WHERE theme_id = ". $id);
				
			return $theme[0]['theme_name'];
						
		}
		
		private function ManageThemes(){
			
			$themes = $this->db->q("SELECT * FROM trkr_themes");
			
			$i = 1;
			
			if($_GET['do'] == "return"){
				
				$this->DisplayError("New status set for ". $this->ParseTheme($_GET['id']) ."", "Theme Updated");
				
				echo "<br />";
			
			}
			
			echo "<table border='0' cellspacing='0' cellpadding='0' width='100%'>";
				
				echo "<tr>";
					echo "<td class='item header' colspan='4'>Themes</td>";
				echo "</tr>";
				
				foreach($themes as $theme){
				
					$class = ($i++ % 2) ? "r1" : "r2";
					
					echo "<tr>";
						if($theme['theme_status'] == 0){
						
							echo "<td class='item ". $class ."'><em class='inactive'>". str_replace(".css", "", ucwords($theme['theme_name'])) ."</em></td>";
							echo "<td class='item ". $class ."' align='right'><a href='". $this->url . $theme['theme_path'] . $theme['theme_name'] ."' target='_blank'><em>". $theme['theme_path'] . $theme['theme_name'] ."</em></a></td>";
							
						}else {
						
							echo "<td class='item ". $class ."'>". str_replace(".css", "", ucwords($theme['theme_name'])) ."</td>";
							echo "<td class='item ". $class ."' align='right'><a href='". $this->url . $theme['theme_path'] . $theme['theme_name'] ."' target='_blank' class='lightlink'>". $theme['theme_path'] . $theme['theme_name'] ."</a></td>";
						
						}
						if($theme['theme_status'] == 1){
						
							echo "<td class='item ". $class ."' width='20' align='right'><input type='checkbox' onclick='ChangeThemeStatus(". $theme['theme_id'] .", this.value);'  name='theme_status' checked='checked' /></td>";
							
						}else {
						
							echo "<td class='item ". $class ."' width='20' align='right'><input type='checkbox' onclick='ChangeThemeStatus(". $theme['theme_id'] .", this.value);'  name='theme_status' /></td>";
						
						}
						
						echo "<td class='item ". $class ."' width='20'><a href='". $this->url ."dashboard/admin.php?type=themes&del=". $theme['theme_id'] ."'><img src='". $this->url . "images/cross.png' title='Delete' class='btn' /></a></td>";
						
					echo "</tr>";
										
				}
				
				$this->LoadTheme();
				
			echo "</table>";
			
			
			 
		}
		
		private function LoadTheme(){
			
			echo "<tr>";
				echo "<td class='item r2' colspan='4'><form method='post' action='". $_SERVER['PHP_SELF'] . "?type=themes&do=load' enctype='multipart/form-data'>";
					echo "<label for='theme'>Add Theme: </label><input type='file' name='theme' id='theme' />";
					echo "<input type='submit' value='Add' class='btn' />";
				echo "</form></td>";
			echo "</tr>";
			
			if(isset($_GET['do']) && $_GET['do'] == "load"){
			
				$upload = $this->UploadCSSFile($_FILES['theme']['name']);
				
				if($upload){
				
					$this->db->insert("INSERT INTO trkr_themes(theme_name, theme_path) VALUES ('". $_FILES['theme']['name'] ."', 'css/')");
					
					header("Location:admin.php?type=themes");
				
				}else {
				
					$this->DisplayError("File could not be uploaded.");
				
				}
			
			}
			
		
		}
		
		private function UploadCSSFile($filename){
		
			$dir = "../css/";
			$target = $dir . $filename;
			
			if(!file_exists($target) && ($_FILES['theme']['type'] == "text/css")){
			
				if(move_uploaded_file($_FILES['theme']['tmp_name'], $target)){
				
					$this->DisplayError("File uploaded successfully.", "Success");
					
					return TRUE;
					
				}
			
			}
				
			return FALSE;
		}
		
		private function CommentParser($comment){
		
			$comment = Securitizor::HTMLParser($comment);
			$comment = Securitizor::Stripper($this->LinkParser($comment));
			
			return $comment;
			//die($comment);
		
		}
		
		private function EditProfile(){
		
			global $user;
		
			$u = $this->db->q("SELECT * FROM trkr_users WHERE user_id = ". $user->id());
			$groups = $this->db->q("SELECT * FROM trkr_usergroup");
			
			echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
				echo "<form method='post' action=''>";
				
					echo "<tr>\n";
						echo "<td class='item header'>Edit User Information</td>";
						echo "<td class='item header'></td>";
					echo "</tr>\n";
					echo "<tr>\n";
						echo "<td class='item' colspan='2'><label for='user_email'>Email: </label><input type='text' id='user_email' name='user_email' value='". $u[0]['user_email'] ."' /></td>";
					echo "</tr>\n";
					
					if($u[0]['user_group'] == 1){
					
						echo "<tr>\n";
							echo "<td class='item' colspan='2'><label for='user_colour'>Colour (comments): </label><input type='text' name='user_colour' id='user_colour' value='". $u[0]['user_colour'] ."' /></td>";
						echo "</tr>\n";
						
					}
					echo "<tr>\n";
						echo "<td class='item'><label for='user_theme'>Theme: </label><select name='user_theme' id='user_theme'>";
							
							$themes = $this->db->q("SELECT * FROM trkr_themes WHERE theme_status = 1");
							
							echo "<option>Select...</option>";
							
							foreach($themes as $theme){
								
								if($user->theme() == $theme['theme_id']){
									
									echo "<option value='". $theme['theme_id'] ."' selected='selected'>". str_replace(".css", "", ucwords($theme['theme_name'])) ."</option>";
									
								}else {
								
									echo "<option value='". $theme['theme_id'] ."'>". str_replace(".css", "", ucwords($theme['theme_name'])) ."</option>";
								
								}
							
							}
							
						echo "</select></td>";
						echo "<td class='item'></td>";
					echo "</tr>\n";
					echo "<tr>\n";
						echo "<td class='item'><input type='submit' name='grinfucked' value='Update Information' class='btn' /></td>";
						echo "<td class='item' align='right'><a href='content.php' class='btn'>Cancel</a></td>";
					echo "</tr>\n";
				
				echo "</form>";
			echo "</table>";
			echo "<p>Comment preview:</p>";
			echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
				echo "<tr>";
				
					if($u[0]['user_group'] < 3){
						
						echo "<td class='item header nocaps nobg' style='background-color: #". $u[0]['user_colour'] .";'><img src='". $this->url ."images/Security.png' class='adminpostimg' title='Site Administrator' /><span class='admintxtwrap'>". $u[0]['user_name'] ."</span></td>";
						echo "<td align='right' class='header item nobg' style='background-color: #". $u[0]['user_colour'] .";'>". date("m/j/y g:iA", time()) ." #1</td>";
					
					}else {
					
						echo "<td class='item header nocaps'>". $u[0]['user_name'] ."</td>";
						echo "<td align='right' class='header item'>". date("m/j/y g:iA", time()) ." #1</td>";
					
					}
					
				echo "</tr>";
				echo "<tr>";
					echo "<td class='item' colspan='3'>I am a demo comment.</td>";
				echo "</tr>";
			echo "</table>";
			
		
		}
		
		// Displays the name of the file
		// returns STRING
		
		public function GetPageName($limit = false){
		
			if(!$limit){
				
				return substr($_SERVER['PHP_SELF'], 13);
			
			}else {
			
				return substr($_SERVER['PHP_SELF'], $limit);
			
			}
		
		}
		
		public function GetUserLevel($id){
		
			$u = $this->db->q("SELECT user_group FROM trkr_users WHERE user_id = ". $id);
			
			return $u[0]['user_group'];
		
		}
		
		// Displays the search bar
		// returns HTML
		
		public function DisplaySearch($enabled = true){
			
			if(!$enabled){
				
				echo "<form method='post' action='' id='search' name='searchform'>\n<input type='text' size='20' name='q' placeholder='Search is disabled' disabled='disabled' /><br />\n<input type='submit' disabled='disabled' id='submit' name='query' value='Search' /></form>\n<div class='clear'></div>\n";
				
			}else {
			
				echo "<form method='post' action='search/' id='search' name='searchform'>\n<input type='text' size='20' name='q' /><br />\n<input type='submit' onclick='search();' id='submit' name='query' value='Search' /></form>\n<div class='clear'></div>\n";
			
			}
		
		}
		
		// Displays search results
		// returns HTML
		
		public function DisplaySearchResults(){
		
			if(!is_numeric($_GET['q'])){
				
				$this->DisplayError("This isn't working yet, sorry.", "Search Error", true);
				
				$results = $this->db->query_as_array("SELECT * FROM trkr_bugs WHERE bug_summary LIKE '%". Securitizor::Urlitizer($_GET['q']) ."%' AND bug_status != 'complete'");
				$results_title = "Results for '". Securitizor::Urlitizer($_GET['q']) ."'";
			
			}else {
			
				$results = $this->db->query_as_array("SELECT * FROM trkr_bugs WHERE bug_id = ". Securitizor::Stripper($_GET['q']) ."");
				$results_title = "Results for bug #". $_GET['q'] ."";
				
			}
		
			echo "<table border='0' cellspacing='0' cellpadding='0' width='960'>";
				echo "<tr>";
					echo "<td colspan='4' class='item header'>". $results_title ."</td>\n";
				echo "</tr>\n";
				echo "<tr>";
					
					foreach($results as $item){
					
						echo "<tr>\n";
								
							echo "<td class='item'>#". $item['bug_id'] .".  <a href='". $this->url ."bug/". $item['bug_id'] ."/'>". $this->TruncateOutput($item['bug_summary'], 70) ."</a></td>\n";
							echo "<td width='200' class='item user' align='right'>". $this->GetName($item['bug_assignee']) ."</td>\n";
							echo "<td width='100' class='item ". $this->BugStatus($item['bug_status']) ."' align='center'>". ucwords($item['bug_status']) ."</td>\n";
							
						echo "</tr>\n";

					}
					
			echo "</table>";
		
		}
		
		// Displays the page title based on input
		// returns STRING
		
		public function DisplayPageTitle(){
		
			if($_GET){
			
				if(isset($_GET['level'])){
				
					return $this->name ." | Level ". $_GET['level'] ." bugs";
				
				}
				
				if(isset($_GET['user'])){
				
					return $this->name ." | Bugs assigned to ". $this->GetName($_GET['user'], false);
				
				}
				
				if(isset($_GET['completed'])){
				
					return $this->name ." | All Bugs";
				
				}
				
				if(isset($_GET['group'])){
				
					return $this->name ." | ". $this->GroupName($_GET['group']) ." bugs";
				
				}
				
				if($this->GetPageName() == "bug.php"){
				
					return $this->name ." | Bug #". $_GET['bug'];
				
				}
				
				if($this->GetPageName("23") == "content.php"){
				
					return $this->name ." | New ". $_GET['type'];
				
				}
				
				if($this->GetPageName("23") == "mod.php"){
				
					return $this->name ." | Moderate";
				
				}
				
				if($this->GetPageName("23") == "admin.php"){
				
					return $this->name ." | Administrate";
				
				}
				
				if($this->GetPageName("23") == "messages.php"){
				
					return $this->name ." | Messages";
				
				}
				
			}else {
				
				return $this->name;
				
			}
			
		}
		
		// Displays the footer and copyright info
		// returns STRING
		
		public function DisplayFooter(){
		
			echo "<p class='ftext'>&copy; ". date("Y") ." ". $this->name ." <span class='status'><a href='http://www.ryanpriebe.com/' target='_blank'>ryanpriebe.com</a></span>";
			
		}
		
		public function UpdateUserCompletedBugs(){
		
			global $user;
			
			if($user->logged()){
			
				$u = $this->db->q("SELECT COUNT(bug_id) AS count FROM trkr_bugs WHERE bug_assignee = ". $user->id() ." AND bug_status = 'complete'");
				
				$update = $this->db->insert("UPDATE trkr_users SET user_bug_count = ". $u[0]['count'] ." WHERE user_id = ". $user->id());
				
			}
		
		}
		
		private function BuildAdminEmailList(){
		
			$emails = $this->db->query_as_array("SELECT user_email FROM trkr_users WHERE user_group = 1");
			
			foreach($emails as $email){
				
				$array[] = $email['user_email'];
				
			}
			
			return $array;
		
		}
		
		// Generic error message
		// returns STRING
		
		public function DisplayError($message, $title = "Error", $die = false){
				
			switch($title){
			
				case "Error":
				case "Comments disabled":
					$error_class = "error-red";
					$title_error_class = "red";
				break;
			
			}
			
			if(isset($message)){
				
				if(!$die){
					
					echo "<li class='item header ". $title_error_class ."'>". $title ."</li><li class='item ". $error_class ."'>". $message ."</li>";
				
				}else{
				
					die("<li class='item header ". $title_error_class ."'>". $title ."</li><li class='item ". $error_class ."'>". $message ."</li>");
				
				}
				
			}else {
				
				if($die){
				
					echo "<li class='item header ". $title_error_class ."'>". $title ."</li><li class='item ". $error_class ."'>No items available</li>";
				
				}else{
				
					die("<li class='item header ". $title_error_class ."'>". $title ."</li><li class='item ". $error_class ."'>No items available</li>");
				
				}
				
			}
		
		}
	
	
	}

?>
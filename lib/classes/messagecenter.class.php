<?php

	class MessageCenter extends Tracker {
	
		//vars
		
			protected static $db;
		
		//methods
			
			public function __construct(){
				
				$this->db = parent::$db;
			
			}
			
			private function GetCommentPosterInfo($what, $comment){
				
				$comment_info = $this->db->q("SELECT ". $what ." FROM trkr_comments WHERE comment_rid = ". $comment);
				
				return $comment_info[0][$what];
			
			}
			
			public function NewMessages(){
				
				global $user;
				
				//parent::DisplayError("This doesn't do anything yet", "Feature in development - <span class='nocaps'>". $_GET['type'] ."</span>");
				
				$i = 1;
				
				$rids = $this->db->q("SELECT * FROM trkr_comments");
				
				foreach($rids as $comment_reply){
				
					if(!is_null($comment_reply['comment_rid'])){
					
						if($user->id == MessageCenter::GetCommentPosterInfo("comment_uid", $comment_reply['comment_rid'])){
						
							$comments = $this->db->q("SELECT * FROM trkr_comments WHERE comment_id = ". $comment_reply['comment_rid']);
							
							echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";	
								
								foreach($comments as $com){
								
									$class = ($i++ % 2) ? "r1" : "r2";
								
									echo "<tr>\n";
										echo "<td colspan='2' class='item header ". $class ."'>Reply to comment #". $com['comment_id'] ." | ". $com['comment_content'] ."</td>\n";
									echo "</tr>\n";
									echo "<tr>\n";
										echo "<td class='item ". $class ."' width='100' align='center'>". parent::GetName($com['comment_uid'], false) ."</td>";
										echo "<td colspan='2' class='item ". $class ."'>". $com['comment_content'] ."</td>\n";
									echo "</tr>\n";
																		
								}
						
							echo "</table>";
					
						}
						
					}
				
				}
				
			}
			
			public function SavedMessages(){
			
				global $user;
				
				parent::DisplayError("This doesn't do anything yet", "Feature in development - <span class='nocaps'>". $_GET['type'] ."</span>");
			
			}
			
			public function DirectMessages(){
			
				parent::DisplayError("This doesn't do anything yet", "Feature in development - <span class='nocaps'>". $_GET['type'] ."</span>");
			
			}
			
			public function DeleteMessage($id){
			
				
			
			}
			
			public function SaveMessage($id){
			
			
			
			}
			
			//get who posted the comment by the comment's id
			
			private function GetCommentPoster($id){
			
				
			
			}
	
	}

?>
<?php

	class Securitizor extends User{
	
		//vars
			
			
		//methods
		
			public function Stripper($str){
			
				if(get_magic_quotes_gpc()){
				
					return $str;
				
				}else {
				
					return mysql_real_escape_string($str);
				
				}
			
			}
			
			public function Urlitizer($str){
			
				$values = array(' ', '%20', '.');
				$bad_values = array('!', '?', '&', '$', '@', '#', '%', '*', '^', ':');
				$str = str_replace($values, "-", strtolower($str));
				$str = str_replace($bad_values, "", $str);
				return $str;
			
			}
			
			public function HTMLParser($str){
			
				$pattern = "/(<\/?)(\w+)([^>]*>)/e";
				$replacement = "highlight_string('\\1\\2\\3', true)";
				
				return preg_replace($pattern, $replacement, $str);
			
			}
	
	}

?>
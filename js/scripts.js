//Bug Tracker scripts file
//Version 1.0 | 1/31/2011

	function changeGroup(v){
	
		window.location = "http://labs.ryanpriebe.com/bonecrusher/group/" + v.value + "/";
	
	}
	
	function assignUser(u, i){
	
		window.location = "http://labs.ryanpriebe.com/bonecrusher/dashboard/admin.php?type=assign&s=1&u=" + u.value + "&i=" + i;
	
	}
	
	function search(s){
		
		if(s != ""){
			
			window.location = "http://labs.ryanpriebe.com/bonecrusher/search/" + s + "/";
			
		}else {
		
			alert("Please enter a search term");
		
		}
	
	}
	
	function modifyStatus(a, c){
		
		window.location = "http://labs.ryanpriebe.com/bonecrusher/dashboard/admin.php?type=review&c=" + c + "&a=" + a.value;
	
	}
	
	function ChangeThemeStatus(id, status){
	
		if(status == "on"){
		
			window.location = "http://labs.ryanpriebe.com/bonecrusher/dashboard/admin.php?type=themes&status=1&id=" + id;
			
		}else if(status == ""){
		
			window.location = "http://labs.ryanpriebe.com/bonecrusher/dashboard/admin.php?type=themes&status=0&id=" + id;
		
		}
	
	}
	
	function ChangeTaskStatus(id){
		
		window.location = "http://labs.ryanpriebe.com/bonecrusher/dashboard/admin.php?type=usersubbugs&status=1&id=" + id;
			
	}
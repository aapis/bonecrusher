//This is the Beta definition of a jQuery based ping prototype...
//this will move to where-ever the current user is hovering over the table element, and present itself...

//jQuery on DOM ready...
$(function(){
	//Create the floating row utility div
	var utilityDiv = $("<div class='ping-panel'>");
	utilityDiv.text("Example Text Here");
	$("#bug-list").find('.project-task').each(function(index){
		var jqitem = $(this);
		jqitem.bind("showping",function(){
			$(this).animate({
			    opacity: 0.25,
			    "background-color":"blue",
			  }, 1000, function() {
			    $(this).trigger("showpingrev");
			});
		});
		
		jqitem.bind("showpingrev",function(){
			$(this).animate({
			    opacity: 1,
			    "background-color":"blue",
			  }, 1000, function() {
			    $(this).trigger("showping");
			});
		});
		
		if(jqitem.attr('bk-data-pinged')==1){
			console.log("Found Target\n");
			jqitem.trigger("showping");
		}
		//	jqitem.append(utilityDiv);
		//}
	});
});
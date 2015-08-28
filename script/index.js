$(document).ready(function() {
    
    $("#test").click(function(){
    	
    	var subjectList = ["Matric", "Inter"];
    	var gradeList = [4.5, 2.5];
    	var background = "General";
    	
    	$.ajax({
    		method : "POST",
    		data : {
    			subjectList : subjectList,
    			gradeList : gradeList,
    			background : background
    		},
			url: "api/showAvailableVersityUnit.php",
			dataType: "json"
		}).done(function(data) {
			console.log(data)
		})
    });
});
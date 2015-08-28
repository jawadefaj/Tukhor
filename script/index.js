$(document).ready(function() {
    
    $("#search").click(function(){
    	
    	var subjectList = ["Math_O", "Physics_O", "Chemistry_O", "English_O"];
    	var gradeList = [4.5, 2.5, 2.5, 3.5];
    	var background = "English";
    	
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

    $("#addReq").click(function(){
        
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
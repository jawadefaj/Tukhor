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

    $("#addLogicAddMin").click(function(){
        
        var versity = "Dum Versity";
        var unit = "Dum Unit";
        var background = "General";
        var subjectList = ["Matric", "Inter"];
        var minimumValue = 5.5;
        var logicType = "addMinimum";
        
        $.ajax({
            method : "POST",
            data : {
                versity : versity,
                unit : unit,
                background : background,
                subjectList : subjectList,
                minimumValue : minimumValue,
                logicType : logicType
            },
            url: "api/addLogic.php",
            dataType: "json"
        }).done(function(data) {
            console.log(data)
        })
    });

    $("#addLogicLeastSubCount").click(function(){
        
        var versity = "Dum Versity";
        var unit = "Dum Unit";
        var background = "General";
        var subjectList = ["Math_O", "Physics_O", "Chemistry_O", "English_O"];
        var minimumCount = 4;
        var logicType = "leastSubCount";

        $.ajax({
            method : "POST",
            data : {
                versity : versity,
                unit : unit,
                background : background,
                subjectList : subjectList,
                minimumCount : minimumCount,
                logicType : logicType
            },
            url: "api/addLogic.php",
            dataType: "json"
        }).done(function(data) {
            console.log(data)
        })
    });

    $("#addLogicLeastSubLeastGrade").click(function(){
        
        var versity = "Dum Versity";
        var unit = "Dum Unit";
        var background = "General";
        var subjectList = ["Math", "Physics", "Chemistry", "English"];
        var minimumCount = 3;
        var minimumGrade = 5;
        var logicType = "leastSubLeastGrade";

        $.ajax({
            method : "POST",
            data : {
                versity : versity,
                unit : unit,
                background : background,
                subjectList : subjectList,
                minimumCount : minimumCount,
                minimumGrade : minimumGrade,
                logicType : logicType
            },
            url: "api/addLogic.php",
            dataType: "json"
        }).done(function(data) {
            console.log(data)
        })
    });

    $("#addLogicMaxSubLeastGrade").click(function(){
        
        var versity = "BUET";
        var unit = "Engg";
        var background = "General";
        var subjectList = ["Math", "Physics", "Chemistry", "English"];
        var maxCount = 2;
        var minimumGrade = 3;
        var logicType = "maxSubLeastGrade";

        $.ajax({
            method : "POST",
            data : {
                versity : versity,
                unit : unit,
                background : background,
                subjectList : subjectList,
                maxCount : maxCount,
                minimumGrade : minimumGrade,
                logicType : logicType
            },
            url: "api/addLogic.php",
            dataType: "json"
        }).done(function(data) {
            console.log(data)
        })
    });

    $("#addLogicMinLogic").click(function(){
        
        var versity = "BUET";
        var unit = "Engg";
        var background = "General";
        var subject = "Math";
        var minimumGrade = 6;
        var logicType = "minLogic";

        $.ajax({
            method : "POST",
            data : {
                versity : versity,
                unit : unit,
                background : background,
                subject : subject,
                minimumGrade : minimumGrade,
                logicType : logicType
            },
            url: "api/addLogic.php",
            dataType: "json"
        }).done(function(data) {
            console.log(data)
        })
    });
});
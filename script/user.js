$(document).ready(function() {
    
    var subjectList = [];
    var gradeList = [];

    function reloadSubjectList() {
        $("#subjectList #theList").remove();
        if (subjectList.length>0) {
            var listHTML = '';
            listHTML += '<div id="theList">Subject/Exam List: '
            for(var i=0; i<subjectList.length-1; i++) {
                listHTML += subjectList[i] + ' (' + gradeList[i] + '), ';
            }
            listHTML += subjectList[i] + ' (' + gradeList[i] + ')';
            listHTML += '</div>';
            $("#subjectList").append(listHTML);
        }
    }

    $("#loadSubjects").click(function() {
        subjectList = [];
        gradeList = [];
        reloadSubjectList();
        var divHTML = '';
        $.ajax({
            method : "POST",
            data : {background : $("#backgroundSelect").val()},
            url : "api/getSubjectList.php",
            dataType : "json"
        }).done(function(data) {
            if (data['success']) {
                divHTML += '<div id="subjectList"><div id="theList"></div></div><br/>'
                divHTML += 'Subject/Exam: <select id="subjectSelect">';
                for (var i=0; i<data['subjectList'].length; i++) {
                    if (data['subjectList'][i]['subject'].substring(data['subjectList'][i]['subject'].length-4) != "Pass") {
                        divHTML += '<option value="'+data['subjectList'][i]['subject']+'">'+data['subjectList'][i]['subject']+'</option>';
                    }
                }
                divHTML += '<option value="other">Other</option>';
                divHTML += '</select> Other Subject: <input type="text" id="subjectName"/>';
                divHTML += 'Grade: <input type="number" id="grade"/><br/><br/>';
                divHTML += '<button id="addSubject">Add Subject</button><br/><br/>';
                divHTML += '<button id="submitButton">Search Versities</button>'
                $("#subjects").append(divHTML);
            }
            else {
                alert("Something went wrong");
            }
        });
    });
    
    $(document).on("click", "#addSubject", function() {
        if ($("#subjectSelect").val() == "other" && $("#subjectName").val() == "") {
            alert("Enter Subject!");
        }
        if ($("#grade").val() == "") {
            alert("Enter Grade!");
        }
        else {
            subjectList.push($("#subjectSelect").val() == "other" ? $("#subjectName").val() : $("#subjectSelect").val());
            gradeList.push($("#grade").val());
            reloadSubjectList();
        }
    });

    $(document).on("click", "#submitButton", function() {
        
        if ($("#yearSSC").val() == "" || $("#yearHSC").val() == "") {
            alert("Enter Passing year!");
        }
        
        else {
            var background = $("#backgroundSelect").val();
            if (background == "English") {
                subjectList.push("OPass");
                subjectList.push("APass");
            }
            else {
                subjectList.push("SSCPass");
                subjectList.push("HSCPass");
            }

            gradeList.push($("#yearSSC").val());
            gradeList.push($("#yearHSC").val());

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
                if (data['success'] == false) {
                    alert("Something went wrong");
                }
                else {
                    $("#versities #theVersityList").remove();
                    divHTML = '<div  id="theVersityList">The available versities:<br/>';
                    for(var i=0; i<data['versities'].length; i++) {
                        divHTML += data['versities'][i]['versity']+' '+data['versities'][i]['unit']+'<br/>';
                    }
                    divHTML = '</div>';
                    $("#versities").append(divHTML);
                }
            });
        }
    });

});

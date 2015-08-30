$(document).ready(function() {
    
    var subjectList = [];

    $.ajax({
        url : "api/getVersityName.php",
        dataType : "json"
    }).done(function(data) {
        for(var i=0; i<data['versities'].length; i++) {
            $("#versitySelect").append('<option value="'+data['versities'][i]['versity']+'">'+data['versities'][i]['versity']+'</option>');
        }
        $("#versitySelect").append('<option value="other">Other</option>');
        loadUnit();
    });

    $("#versitySelect").change(function(){
        loadUnit();
    });

    $("#versityName").change(function(){
        loadUnit();
    });

    function loadUnit() {
        versity = $("#versitySelect").val();
        if (versity == "other") {
            versity = $("#versityName").val();
        }
        $.ajax({
            method : "POST",
            data : {versity : versity},
            url : "api/getUnitName.php",
            dataType : "json"
        }).done(function(data) {
            $("#unitSelect option").remove();
            for(var i=0; i<data['units'].length; i++) {
                $("#unitSelect").append('<option value="'+data['units'][i]['unit']+'">'+data['units'][i]['unit']+'</option>');
            }
            $("#unitSelect").append('<option value="other">Other</option>');
        });
    }

    function reloadSubjectList() {
        $("#subjectList #theList").remove();
        if (subjectList.length>0) {
            var listHTML = '';
            listHTML += '<div id="theList">Subject/Exam List: '
            for(var i=0; i<subjectList.length-1; i++) {
                listHTML += subjectList[i] + ', ';
            }
            listHTML += subjectList[i];
            listHTML += '</div>';
            $("#subjectList").append(listHTML);
        }
    }

    $("#loadDetails").click(function() {
        
        subjectList = [];
        reloadSubjectList();
        $("#details #tempDiv").remove();
        var divHTML = '';
        divHTML += '<div id="tempDiv">';

        switch($("#logicSelect").val()) {
        case "minimumYear":
            divHTML += 'Exam: <select id="exam">';
            divHTML += '<option value="APass">A level</option>';
            divHTML += '<option value="OPass">O level</option>';
            divHTML += '<option value="SSCPass">SSC/Equivalent</option>';
            divHTML += '<option value="HSCPass">HSC/Equivalent</option>';
            divHTML += '</select>';
            divHTML += ' Year: <input type="number" id="year"/><br/><br/>';
            divHTML += '<button id="submitButton">Add Requirement</button>'
            divHTML += '</div>';
            $("#details").append(divHTML);
            break;
        case "addMinimum":
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
                    divHTML += '</select> Other Subject: <input type="text" id="subjectName"/> <button id="addSubject">Add Subject</button><br/><br/>';
                    divHTML += 'Minimum grade summation: <input type="number" id="minimumGrade"/><br/><br/>'
                    divHTML += '<button id="submitButton">Add Requirement</button>'
                    divHTML += '</div>';
                    $("#details").append(divHTML);
                }
                else {
                    alert("Something went wrong");
                }
            });
            break;
        case "leastSubCount":
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
                    divHTML += '</select> Other Subject: <input type="text" id="subjectName"/> <button id="addSubject">Add Subject</button><br/><br/>';
                    divHTML += 'Minimum number of subject required among the selected subjects: <input type="number" id="minimumCount"/><br/><br/>'
                    divHTML += '<button id="submitButton">Add Requirement</button>'
                    divHTML += '</div>';
                    $("#details").append(divHTML);
                }
                else {
                    alert("Something went wrong");
                }
            });
            break;
        case "leastSubLeastGrade":
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
                    divHTML += '</select> Other Subject: <input type="text" id="subjectName"/> <button id="addSubject">Add Subject</button><br/><br/>';
                    divHTML += 'Minimum grade required: <input type="number" id="minimumGrade"/><br/><br/>'
                    divHTML += 'Minimum number of subject with selected grade required among the selected subjects: <input type="number" id="minimumCount"/><br/><br/>'
                    divHTML += '<button id="submitButton">Add Requirement</button>'
                    divHTML += '</div>';
                    $("#details").append(divHTML);
                }
                else {
                    alert("Something went wrong");
                }
            });
            break;
        case "maxSubLeastGrade":
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
                    divHTML += '</select> Other Subject: <input type="text" id="subjectName"/> <button id="addSubject">Add Subject</button><br/><br/>';
                    divHTML += 'Grade lower bound: <input type="number" id="minimumGrade"/><br/><br/>'
                    divHTML += 'Maximum number of subject allowed with selected grade among the selected subjects: <input type="number" id="maximumCount"/><br/><br/>'
                    divHTML += '<button id="submitButton">Add Requirement</button>'
                    divHTML += '</div>';
                    $("#details").append(divHTML);
                }
                else {
                    alert("Something went wrong");
                }
            });
            break;
        case "minLogic":
            $.ajax({
                method : "POST",
                data : {background : $("#backgroundSelect").val()},
                url : "api/getSubjectList.php",
                dataType : "json"
            }).done(function(data) {
                if (data['success']) {
                    divHTML += 'Subject/Exam: <select id="subjectSelect">';
                    for (var i=0; i<data['subjectList'].length; i++) {
                        if (data['subjectList'][i]['subject'].substring(data['subjectList'][i]['subject'].length-4) != "Pass") {
                            divHTML += '<option value="'+data['subjectList'][i]['subject']+'">'+data['subjectList'][i]['subject']+'</option>';
                        }
                    }
                    divHTML += '<option value="other">Other</option>';
                    divHTML += '</select> Other Subject: <input type="text" id="subjectName"/><br/><br/>';
                    divHTML += 'Grade lower bound: <input type="number" id="minimumGrade"/><br/><br/>'
                    divHTML += '<button id="submitButton">Add Requirement</button>'
                    divHTML += '</div>';
                    $("#details").append(divHTML);
                }
                else {
                    alert("Something went wrong");
                }
            });
            $("#details").append(divHTML);
            break;
        }

    });
    
    $(document).on("click", "#addSubject", function() {
        if ($("#subjectSelect").val() == "other" && $("#subjectName").val() == "") {
            alert("Enter Subject!");
        }
        else {
            subjectList.push($("#subjectSelect").val() == "other" ? $("#subjectName").val() : $("#subjectSelect").val());
            reloadSubjectList();
        }
    });

    $(document).on("click", "#submitButton", function() {
        if ($("#versitySelect").val() == "other" && $("#versityName").val() == "") {
            alert("Enter versity name!");
        }
        else if ($("#unitSelect").val() == "other" && $("#unitName").val() == "") {
            alert("Enter unit name!");
        }
        else {
            switch ($("#logicSelect").val()) {
            case "minimumYear":
                if ($("#year").val() == "") {
                    alert("Enter year!");
                }
                else {
                    var versity = $("#versitySelect").val() == "other" ? $("#versityName").val() : $("#versitySelect").val();
                    var unit = $("#unitSelect").val() == "other" ? $("#unitName").val() : $("#unitSelect").val();
                    var background = $("#backgroundSelect").val();
                    var subject = $("#exam").val();
                    var minimumGrade = $("#year").val();
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
                        if (data['success'] == false) {
                            alert("Something went wrong");
                        }
                        else {
                            alert("Requirement added successfully!")
                        }
                    });
                }
                break;
            case "addMinimum":
                if (subjectList.length == 0) {
                    alert("Add subject or exam!");
                }
                else if ($("#minimumGrade").val() == "") {
                    alert("Enter Minimum Grade!");
                }
                else {
                    var versity = $("#versitySelect").val() == "other" ? $("#versityName").val() : $("#versitySelect").val();
                    var unit = $("#unitSelect").val() == "other" ? $("#unitName").val() : $("#unitSelect").val();
                    var background = $("#backgroundSelect").val();
                    var minimumValue = $("#minimumGrade").val();
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
                        if (data['success'] == false) {
                            alert("Something went wrong");
                        }
                        else {
                            alert("Requirement added successfully!")
                        }
                    });
                }
                break;
            case "leastSubCount":
                if (subjectList.length == 0) {
                    alert("Add subject or exam!");
                }
                else if ($("#minimumCount").val() == "") {
                    alert("Enter Minimum Count!");
                }
                else {
                    var versity = $("#versitySelect").val() == "other" ? $("#versityName").val() : $("#versitySelect").val();
                    var unit = $("#unitSelect").val() == "other" ? $("#unitName").val() : $("#unitSelect").val();
                    var background = $("#backgroundSelect").val();
                    var minimumCount = $("#minimumCount").val();
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
                        if (data['success'] == false) {
                            alert("Something went wrong");
                        }
                        else {
                            alert("Requirement added successfully!")
                        }
                    });
                }
                break;
            case "leastSubLeastGrade":
                if (subjectList.length == 0) {
                    alert("Add subject or exam!");
                }
                else if ($("#minimumCount").val() == "") {
                    alert("Enter Minimum Count!");
                }
                else if ($("#minimumCount").val() > subjectList.length) {
                    alert("Minimum count too high!");
                }
                else if ($("#minimumGrade").val() == "") {
                    alert("Enter Minimum Grade!");
                }
                else {
                    var versity = $("#versitySelect").val() == "other" ? $("#versityName").val() : $("#versitySelect").val();
                    var unit = $("#unitSelect").val() == "other" ? $("#unitName").val() : $("#unitSelect").val();
                    var background = $("#backgroundSelect").val();
                    var minimumCount = $("#minimumCount").val();
                    var minimumGrade = $("#minimumGrade").val();
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
                        if (data['success'] == false) {
                            alert("Something went wrong");
                        }
                        else {
                            alert("Requirement added successfully!")
                        }
                    });
                }
                break;
            case "maxSubLeastGrade":
                if (subjectList.length == 0) {
                    alert("Add subject or exam!");
                }
                else if ($("#maximumCount").val() == "") {
                    alert("Enter Maximum Count!");
                }
                else if ($("#maximumCount").val() > subjectList.length) {
                    alert("Maximum count too high!");
                }
                else if ($("#minimumGrade").val() == "") {
                    alert("Enter Minimum Grade!");
                }
                else {
                    var versity = $("#versitySelect").val() == "other" ? $("#versityName").val() : $("#versitySelect").val();
                    var unit = $("#unitSelect").val() == "other" ? $("#unitName").val() : $("#unitSelect").val();
                    var background = $("#backgroundSelect").val();
                    var maxCount = $("#maximumCount").val();
                    var minimumGrade = $("#minimumGrade").val();
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
                        if (data['success'] == false) {
                            alert("Something went wrong");
                        }
                        else {
                            alert("Requirement added successfully!")
                        }
                    });
                }
                break;
            case "minLogic":
                if ($("#subjectSelect").val() == "other" && $("#subjectName").val() == "") {
                    alert("Enter Subject!");
                }
                else if ($("#minimumGrade").val() == "") {
                    alert("Enter Minimum Grade!");
                }
                else {
                    var versity = $("#versitySelect").val() == "other" ? $("#versityName").val() : $("#versitySelect").val();
                    var unit = $("#unitSelect").val() == "other" ? $("#unitName").val() : $("#unitSelect").val();
                    var background = $("#backgroundSelect").val();
                    var subject = $("#subjectSelect").val() == "other" ? $("#subjectName").val() : $("#subjectSelect").val();
                    var minimumGrade = $("#minimumGrade").val();
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
                        if (data['success'] == false) {
                            alert("Something went wrong");
                        }
                        else {
                            alert("Requirement added successfully!")
                        }
                    });
                }
                break;
            }
        }
    });

});


$(document).ready(function() {
    
    $.ajax({
        url : "api/getVersityName.php",
        dataType : "json"
    }).done(function(data) {
        console.log(data);
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
            console.log(data);
            $("#unitSelect option").remove();
            for(var i=0; i<data['units'].length; i++) {
                $("#unitSelect").append('<option value="'+data['units'][i]['unit']+'">'+data['units'][i]['unit']+'</option>');
            }
            $("#unitSelect").append('<option value="other">Other</option>');
        });
    }

});
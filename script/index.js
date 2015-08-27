$(document).ready(function() {
    
    $("#test").click(function(){
    	console.log("test");
    	$.ajax({
			url: "api/showAllVeristyName.php",
			dataType: "json"
		}).done(function(data) {
			console.log(data)
		})
    });
});
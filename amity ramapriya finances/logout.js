function logout(){
	$.ajax({
		url: "logout.php",
		type: "POST",
	});
	window.location = "window.location='index.php";
}
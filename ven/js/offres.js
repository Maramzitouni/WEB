$(document).ready(function(){

	offre();
	//cat() is a funtion fetching category record from database whenever page is load

	//product() is a funtion fetching product record from database whenever page is load
		function offre(){
		$.ajax({
			url	:	"action1.php",
			method:	"POST",
			data	:	{getOffres:1},
			success	:	function(data){
				$("#get_offres").html(data);
			}
		})
	}
})

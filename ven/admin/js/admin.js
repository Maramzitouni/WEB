$(document).ready(function(){

	getAdmins();

	function getAdmins(){
		$.ajax({
			url : '../admin/classes/Admin.php',
			method : 'POST',
			data : {GET_ADMIN:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);

				if (resp.status == 202) {
					var adminHTML = '';

					$.each(resp.message, function(index, value){
						adminHTML += '<tr>'+
										'<td>#</td>'+
										'<td>'+ value.first_name +'</td>'+
										'<td>'+ value.email +'</td>'+
										'<td>'+ value.status +'</td>'+
										'<td><a aid="'+value.id+'" class="btn btn-sm btn-danger delete-admin"><i class="fas fa-trash-alt"></i></a></td>'+
									'</tr>';
					});

					$("#admin_list").html(adminHTML);

				}else if(resp.status == 303){
					$("#admin_list").html(resp.message);
				}





			}
		})

	}

	$(".add-brand").on("click", function(){

		alert();

	});





	$(document.body).on('click', '.delete-admin', function(){

		var aid = $(this).attr('aid');

		if (confirm("Supprimer l'utilisateur?")) {
			$.ajax({
				url : '../admin/classes/Products.php',
				method : 'POST',
				data : {DELETE_ADMIN:1, aid:aid},
				success : function(response){
					var resp = $.parseJSON(response);
					if (resp.status == 202) {
						alert(resp.message);
						getAdmins();
					}else if(resp.status == 303){
						alert(resp.message);
					}
				}
			});
		}else{
			alert('Cancelled');
		}



	});











});

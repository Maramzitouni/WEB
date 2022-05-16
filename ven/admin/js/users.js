$(document).ready(function(){

	getUsers();

	function getUsers(){
		$.ajax({
			url : '../admin/classes/Users.php',
			method : 'POST',
			data : {GET_USER:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);

				if (resp.status == 202) {
					var userHTML = '';

					$.each(resp.message, function(index, value){
						userHTML += '<tr>'+
										'<td>#</td>'+
										'<td>'+ value.first_name +'</td>'+
										'<td>'+ value.email +'</td>'+
										'<td>'+ value.entreprise +'</td>'+
										'<td>'+ value.status+'</td>'+
										'<td><a aid="'+value.id+'" class="btn btn-sm btn-danger delete-user"><i class="fas fa-trash-alt"></i></a></td>'+
										 (value.status==1?'<td><a vid="'+value.id+'" class="btn btn-sm btn-success valide-user"><i class="fa-solid fa-check"></i></a></td>':"")+
									'</tr>';
					});

					$("#user_list").html(userHTML);

				}else if(resp.status == 303){
					$("#user_list").html(resp.message);
				}





			}
		})

	}

	$(".add-user").on("click", function(){

		alert();

	});





	$(document.body).on('click', '.delete-user', function(){

		var aid = $(this).attr('aid');

		if (confirm("Supprimer l'utilisateur?")) {
			$.ajax({
				url : '../admin/classes/Users.php',
				method : 'POST',
				data : {DELETE_USER:1, aid:aid},
				success : function(response){
					var resp = $.parseJSON(response);
					if (resp.status == 202) {
						alert(resp.message);
						getUsers();
					}else if(resp.status == 303){
						alert(resp.message);
					}
				}
			});
		}else{
			alert('Cancelled');
		}



	});


		$(document.body).on('click', '.valide-user', function(){

			var vid = $(this).attr('vid');

			if (confirm("Valider l'utilisateur?")) {
				$.ajax({
					url : '../admin/classes/Users.php',
					method : 'POST',
					data : {VALIDE_USER:1, vid:vid},
					success : function(response){
						var resp = $.parseJSON(response);
						if (resp.status == 202) {
							alert(resp.message);
							getUsers();
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

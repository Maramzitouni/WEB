$(document).ready(function(){

	getClients();

	function getClients(){

		$.ajax({
			url : '../admin/classes/Clients.php',
			method : 'POST',
			data : {GET_CLIENTS:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);


					var cliHTML = '';
					console.log(response);

					$.each(resp.message, function(index, value){
						cliHTML += '<tr>'+
						        '<td></td>'+
										'<td>'+ value.first_name +'</td>'+
										'<td>'+ value.email +'</td>'+
										'<td>'+ value.status +'</td>'+
										'<td><a aid="'+value.id+'" class="btn btn-sm btn-danger delete-client"><i class="fas fa-trash-alt"></i></a></td>'+
									'</tr>';
					});


					$("#client_list").html(cliHTML);
				}

		});

	}

	$(".add-client").on("click", function(){

		$.ajax({
			url : '../admin/classes/Clients.php',
			method : 'POST',
			data : $("#add-client-form").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getClients();
					$("#add_client_modal").modal('hide');
					alert(resp.message);
				}else if(resp.status == 303){
					alert(resp.message);
				}

			}
		})

	});


	

	$(document.body).on("click", ".edit-client", function(){

		var cli = $.parseJSON($.trim($(this).children("span").html()));
		console.log(cli);
		$("input[name='e_cat_title']").val(cli.email);
		$("input[name='cat_id']").val(cli.id);

		$("#edit_category_modal").modal('show');



	});
	$(".edit-client-btn").on('click', function(){

		$.ajax({
			url : '../admin/classes/Clients.php',
			method : 'POST',
			data : $("#edit-client-form").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getCategories();
					alert(resp.message);
				}else if(resp.status == 303){
					alert(resp.message);
				}
				$("#edit_client_modal").modal('hide');
			}
		});

	});







	$(document.body).on('click', '.delete-client', function(){

		var aid = $(this).attr('aid');

		if (confirm("Supprimer l'utilisateur?")) {
			$.ajax({
				url : '../admin/classes/Clients.php',
				method : 'POST',
				data : {DELETE_CLIENT:1, aid:aid},
				success : function(response){
					var resp = $.parseJSON(response);
					if (resp.status == 202) {
						alert(resp.message);
						getClients();
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

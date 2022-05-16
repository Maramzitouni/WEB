$(document).ready(function(){

	getCompagnies();

	function getCompagnies(){
		$.ajax({
			url : '../admin/classes/Products.php',
			method : 'POST',
			data : {GET_COMPAGNIES:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);

				var comHTML = '';
				console.log(response);

				$.each(resp.message, function(index, value){
					comHTML += '<tr>'+
									'<td></td>'+
									'<td>'+ value.name +'</td>'+
									'<td>'+ value.companyemail+'</td>'+
									'<td>'+ value.CA+'</td>'+
									'<td>'+ value.address+'</td>'+
									'<td>'+ value.status+'</td>'+
									'<td><a class="btn btn-sm btn-info edit-compagnie"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a oid="'+value.id+'" class="btn btn-sm btn-danger delete-compagnie"><i class="fas fa-trash-alt"></i></a></td>'+
									(value.status==1?'<td><a gid="'+value.id+'" class="btn btn-sm btn-success valide-compagnie"><i class="fa-solid fa-check"></i></a></td>':"")+
							 '</tr>';
				});

				$("#compagnie_list").html(comHTML);

			}
		});

	}

	$(".add-compagnie").on("click", function(){

		$.ajax({
			url : '../admin/classes/Products.php',
			method : 'POST',
			data : $("#add-compagnie-form").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getCompagnies();
					$("#add_compagnie_modal").modal('hide');
					alert(resp.message);
				}else if(resp.status == 303){
					alert(resp.message);
				}

			}
		})

	});

	$(document.body).on("click", ".edit-compagnie", function(){

		var com = $.parseJSON($.trim($(this).children("span").html()));
		console.log(com);
		$("input[name='e_com_title']").val(com.name);
		$("input[name='com_id']").val(com.id);

		$("#edit_compagnie_modal").modal('show');



	});

	$(".edit-compagnie-btn").on('click', function(){

		$.ajax({
			url : '../admin/classes/Products.php',
			method : 'POST',
			data : $("#edit-compagnie-form").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getCompagnies();
					alert(resp.message);
				}else if(resp.status == 303){
					alert(resp.message);
				}
				$("#edit_compagnie_modal").modal('hide');
			}
		});

	});

	$(document.body).on('click', '.delete-compagnie', function(){

		var oid = $(this).attr('oid');

		if (confirm("Supprimer l'entreprise?")) {
			$.ajax({
				url : '../admin/classes/Products.php',
				method : 'POST',
				data : {DELETE_COMPAGNIE:1, oid:oid},
				success : function(response){
					var resp = $.parseJSON(response);
					if (resp.status == 202) {
						alert(resp.message);
						getCompagnies();
					}else if(resp.status == 303){
						alert(resp.message);
					}
				}
			});
		}else{
			alert('Cancelled');
		}



	});
	$(document.body).on('click', '.valide-compagnie', function(){

		var gid = $(this).attr('gid');

		if (confirm("Valider l'entreprise?")) {
			$.ajax({
				url : '../admin/classes/Products.php',
				method : 'POST',
				data : {VALIDE_COMPAGNIE:1, gid:gid},
				success : function(response){
					var resp = $.parseJSON(response);
					if (resp.status == 202) {
						alert(resp.message);
						getCompagnies();
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

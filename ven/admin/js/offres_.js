$(document).ready(function(){

	getOffres();

	function getOffres(){
		$.ajax({
			url : '../admin/classes/offre_.php',
			method : 'POST',
			data : {GET_OFFRES:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);

				var offHTML = '';
				console.log(response);

				$.each(resp.message, function(index, value){
					offHTML += '<tr>'+
									'<td></td>'+
									'<td>'+ value.nom +'</td>'+
                  '<td>'+ value.description +'</td>'+
                  '<td>'+ value.prix +'</td>'+
                  '<td><img width="60" height="60" src="../product_images/'+value.image+'"></td>'+
									'<td><a class="btn btn-sm btn-info edit-offre"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a fid="'+value.id_produit+'" class="btn btn-sm btn-danger delete-offre"><i class="fas fa-trash-alt"></i></a></td>'+
								'</tr>';
				});

				$("#offre_list").html(offHTML);

			}
		});

	}

	$(".add-offre").on("click", function(){

		$.ajax({
			url : '../admin/classes/offre_.php',
			method : 'POST',
			data : $("#add-offre-form").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getOffres();
					$("#add_offre_modal").modal('hide');
					alert(resp.message);
				}else if(resp.status == 303){
					alert(resp.message);
				}

			}
		})

	});

	$(document.body).on("click", ".edit-offre", function(){

		var off = $.parseJSON($.trim($(this).children("span").html()));
		console.log(off);
		$("input[name='e_off_title']").val(off.nom);
		$("input[name='off_id']").val(off.id_produit);

		$("#edit_offre_modal").modal('show');



	});

	$(".edit-offre-btn").on('click', function(){

		$.ajax({
			url : '../admin/classes/offre_.php',
			method : 'POST',
			data : $("#edit-offre-form").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getOffres();
					alert(resp.message);
				}else if(resp.status == 303){
					alert(resp.message);
				}
				$("#edit_offre_modal").modal('hide');
			}
		});

	});

	$(document.body).on('click', '.delete-offre', function(){

		var fid = $(this).attr('fid');

		if (confirm("Supprimer l'offre?")) {
			$.ajax({
				url : '../admin/classes/offre_.php',
				method : 'POST',
				data : {DELETE_OFFRE:1, fid:fid},
				success : function(response){
					var resp = $.parseJSON(response);
					if (resp.status == 202) {
						alert(resp.message);
						getOffres();
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

$(document).ready(function(){

	getCoupons();

	function getCoupons(){
		$.ajax({
			url : '../admin/classes/offre_.php',
			method : 'POST',
			data : {GET_COUPONS:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);

				var offHTML = '';
				console.log(response);

				$.each(resp.message, function(index, value){
					offHTML += '<tr>'+
									'<td></td>'+
									'<td>'+ value.coupon_code +'</td>'+
                  '<td>'+ value.discount +'</td>'+
                  '<td>'+ value.status +'</td>'+
									'<td>'+ value.product_title +'</td>'+
                  //'<td><img width="60" height="60" src="../product_images/'+value.image+'"></td>'+
									'<td><a class="btn btn-sm btn-info edit-oupon"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a fid="'+value.coupon_id+'" class="btn btn-sm btn-danger delete-oupon"><i class="fas fa-trash-alt"></i></a></td>'+
								'</tr>';
				});

				$("#coupon_list").html(offHTML);

			}


			var catSelectHTML = '<option value="">Select Produits</option>';
			$.each(resp.message.produits, function(index, value){

				catSelectHTML += '<option value="'+ value.product_id +'">'+ value.product_title +'</option>';

			});
					$(".category_list").html(catSelectHTML);



		});

	}

	$(".add-coupon").on("click", function(){

		$.ajax({
			url : '../admin/classes/offre_.php',
			method : 'POST',
			data : $("#add-coupon-form").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getCoupons();
					$("#add_coupon_modal").modal('hide');
					alert(resp.message);
				}else if(resp.status == 303){
					alert(resp.message);
				}

			}
		})

	});

	$(document.body).on("click", ".edit-coupon", function(){

		var off = $.parseJSON($.trim($(this).children("span").html()));
		console.log(off);
		$("input[name='e_off_title']").val(off.nom);
		$("input[name='off_id']").val(off.id_produit);

		$("#edit_coupon_modal").modal('show');



	});

	$(".edit-coupon-btn").on('click', function(){

		$.ajax({
			url : '../admin/classes/offre_.php',
			method : 'POST',
			data : $("#edit-coupon-form").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getCoupons();
					alert(resp.message);
				}else if(resp.status == 303){
					alert(resp.message);
				}
				$("#edit_coupon_modal").modal('hide');
			}
		});

	});

	$(document.body).on('click', '.delete-coupon', function(){

		var fid = $(this).attr('fid');

		if (confirm("Supprimer l'coupon?")) {
			$.ajax({
				url : '../admin/classes/offre_.php',
				method : 'POST',
				data : {DELETE_oupon:1, fid:fid},
				success : function(response){
					var resp = $.parseJSON(response);
					if (resp.status == 202) {
						alert(resp.message);
						getCoupons();
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

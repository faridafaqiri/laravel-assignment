$(document).ready(function(){
	$('.hidden').hide();
	var zone_id = $('#zone_id').val();
	var province_id = $('#province_id').val();
	var provincial_zone_id = $('#provincial_zone_id').val();
	$('#province_id').prop('disabled',true);
	$('#provincial_zone_id').prop('disabled',true);

	$('#zone_id').on('change',function(){
		zone_id = $(this).val();
		if($(this).val()=="all"){
			$('#province_id').prop('disabled',true);
			$('#provincial_zone_id').prop('disabled',true);
		}else{
			$.ajax({
				method: "",
				url: "/get-province-ajax",
				data: {zone_id:zone_id},
				dataType: 'json',
				success: function(data){
					if(data.length>0){
						$('#province_id').prop('disabled',false);
						var province_content='<option value="all">همه ولایت ها</option>';
						for(var i=0;i<data.length;i++){
							province_content=province_content+'<option value="'+data[i].id+'">'+data[i].name+'</option>';
							$('#province_id').html(province_content);
						}
					}else{
						$('#province_id').prop('disabled',true);
						var province_content='<option value="all">همه ولایت ها</option>';
						$('#province_id').html(province_content);
					}
				}
			});
		}
	});
	$('#province_id').on('change',function(){
		province_id = $(this).val();
		if($(this).val()=="all"){
			$('#provincial_zone_id').prop('disabled',true);
		}else{
			$.ajax({
				method: "",
				url: "/get-provincial-zone-ajax",
				data: {province_id:province_id},
				dataType: 'json',
				success: function(data){
					if(data.length>0){
						$('#provincial_zone_id').prop('disabled',false);
						var provincial_zone_content='<option value="all">همه زون های ولایتی</option>';
						for(var i=0;i<data.length;i++){
							provincial_zone_content=provincial_zone_content+'<option value="'+data[i].id+'">'+data[i].name+'</option>';
							$('#provincial_zone_id').html(provincial_zone_content);
						}
					}else{
						$('#provincial_zone_id').prop('disabled',true);
						var province_content='<option value="all">همه زون های ولایتی</option>';
						$('#provincial_zone_id').html(province_content);
					}
				}
			});
		}
	});


	$('#date_type').on('change',function(){
		var date_type=$(this).val();
		if(date_type=="yearly"){
			$('#year_type_div').show(200);
			$('#six_mont_type_div').hide();
			$('#quarter_div').hide();
			$('#month_id_div').hide();
			$('.date_range_div').hide();
		}
		else if(date_type=="six_monthly"){
			$('#year_type_div').show(200);
			$('#six_mont_type_div').show(200);
			$('#quarter_div').hide();
			$('#month_id_div').hide();
			$('.date_range_div').hide();
		}
		else if(date_type=="quarterly"){
			$('#year_type_div').show(200);
			$('#six_mont_type_div').hide();
			$('#quarter_div').show(200);
			$('#month_id_div').hide();
			$('.date_range_div').hide();
		}
		else if(date_type=="monthly"){
			$('#year_type_div').show(200);
			$('#six_mont_type_div').hide();
			$('#quarter_div').hide();
			$('#month_id_div').show(200);
			$('.date_range_div').hide();
		}
		else if(date_type=="rangly"){
			$('#year_type_div').hide();
			$('#six_mont_type_div').hide();
			$('#quarter_div').hide();
			$('#month_id_div').hide();
			$('.date_range_div').show(200);
		}
		else{
		    return 0;

		}
	});


});

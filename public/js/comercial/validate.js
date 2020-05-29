
function validate(){
	error = 0;
	$(".needs-validation .required").each(function(index, el){
		if($(this).val() === ""){
			$(el).next('.invalid-feedback').css({'display': 'block'});
			
			error++
			
		}else{
			$(el).next('.invalid-feedback').css({'display': 'none'});
			
			if(error > 0){
				error--;
			}
			
		};
	});
	return error;	

}
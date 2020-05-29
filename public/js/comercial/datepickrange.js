	$("#DTAnaliseCompra").daterangepicker(
	{
		ranges   : {
          
          'Último Trimestre' :[moment().subtract(3, 'month'),moment()],
          'Último Semestre'  : [moment().subtract(6, 'month'), moment()],
          'Último Ano'   : [moment().subtract(12, 'month'), moment()],      
        },
        showCustomRangeLabel:false,
        alwaysShowCalendars:false,
        opens:  'right',
        
	},
  function(start, end){
   
  }
	);



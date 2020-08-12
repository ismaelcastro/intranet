	$("#DTAnaliseCompra").daterangepicker(
	{
    "locale": {
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancel",
        "fromLabel": "De",
        "toLabel": "Para",
        "customRangeLabel": "Custom",
        "weekLabel": "W",
        "daysOfWeek": [
            "Seg",
            "Ter",
            "Qua",
            "Qui",
            "Sex",
            "Sab",
            "Dom"
        ],
        "monthNames": [
            "Janeiro",
            "Fevereiro",
            "Março",
            "Abril",
            "Maio",
            "Junho",
            "Julho",
            "Agosto",
            "Setembro",
            "Outubro",
            "Novembro",
            "Dezembro"
        ],
        "firstDay": 1
    },
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



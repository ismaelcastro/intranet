
	$("#teste").daterangepicker(
	{
		ranges   : {
          'Hoje'       : [moment(), moment()],
          'Este Mês'  : [moment().startOf('month'), moment().endOf('month')],
          'Últimos 30 dias'   : [moment().subtract(29, 'days'), moment()],      
          'Mês passado'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        showCustomRangeLabel:false,

	},

	function(start, end){
		$('#dtInicial').val(start.format('DD/MM/YYYY'));
		$('#dtFinal').val(end.format('DD/MM/YYYY'));
	}
	);

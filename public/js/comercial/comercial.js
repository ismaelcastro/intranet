$(document).ready(function(){
	var line = new Morris.Line({
		element 		 : 'faturamento',
		resize			 : true,
		data 			 :[
			{y: '2019-04-30', proel: 2000, sh: 3000, rep: 4000},
        	{y: '2019-05-30', proel: 3000, sh: 2000, rep: 7000},
        	{y: '2019-06-30', proel: 4000, sh: 4000, rep: 9000},
		],
		xkey			 :'y',
		ykeys 			 :['proel', 'sh', 'rep'],
		labels			 : ['Proel', 'SH', 'Repre'],
		lineColors 		 : ['#0288D1', '#00695C', '#FF8F00'],
		lineWidth  		 : 2,
		hideHover        : 'auto',
		gridTextColor    : '#fff',
		gridLineColor    : '#efefef',
		xLabels 		 : 'month',
		xLabelFormat	 : function(x){
			var IndexToMonth = [ "Janeiro", "Fevereiro", "Mar", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro" ];
			var month = IndexToMonth[ x.getMonth() ];
			return month;

		},
    	
    	
    	
    	
    	
	});

	$('.knob').knob();

  


  //faturamento

	/*var line = new Morris.Line({
      element: 'faturamento',
      resize: true,
      data: [
        {y: '2011 Q1', item1: 2666},
        {y: '2011 Q2', item1: 2778},
        {y: '2011 Q3', item1: 4912},
        {y: '2011 Q4', item1: 3767},
        {y: '2012 Q1', item1: 6810},
        {y: '2012 Q2', item1: 5670},
        {y: '2012 Q3', item1: 4820},
        {y: '2012 Q4', item1: 15073},
        {y: '2013 Q1', item1: 10687},
        {y: '2013 Q2', item1: 8432}
      ],
      xkey: 'y',
      ykeys: ['item1'],
      labels: ['Item 1'],
      lineColors: ['#3c8dbc'],
      hideHover: 'auto'
    });

	line.redraw();*/

	line.redraw();
});
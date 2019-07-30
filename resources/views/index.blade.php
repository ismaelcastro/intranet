@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Dashboard</h1>
@stop
@section('content')

	<h2 class="page-header">Informativos</h2>
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-warning"></i>
					<h3 class="box-title">Avisos Importantes</h3>
				</div>
				<div class="box-body">
					
						
					<div class="alert alert-danger alert-dismissible">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <h4><i class="icon fa fa-warning"></i> Atualização do Callisto</h4>
		                Atualização do Callisto acontecerá as 16h30min, durante a atualização o sitema poderá apresentar instabilidade!
	  				</div>
	  				<div class="alert alert-warning alert-dismissible">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                <h4><i class="icon fa fa-warning"></i> Other fake warning</h4>
		                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
	  				</div>
						
					
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Aniversariantes do Mês</h3>
				</div>
				<div class="box-body">
					<div class="row">
						
							
						<!-- widget -->

						<!-- end widget -->
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<h2 class="page-header">Departamento Pessoal</h2>
    <div class="row">	
		<div class="col-md-6">
			<small>Calendário de Férias</small>	
			<div class="box box-primary">	
				<div class="box box-body no-padding">	
						<div id="calendar"></div>
				</div>
			</div>
		</div>
    </div>
@stop
@push('css')
	<link rel="stylesheet" href="{{ URL::asset('plugins/fullcalendar/dist/fullcalendar.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('plugins/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">
@endpush
@push('js')
	<script src="{{ URL::asset('plugins/moment/moment.js') }}"></script>
	<script src="{{ URL::asset('plugins/fullcalendar/dist/fullcalendar.min.js')}}"></script>
	<script>
		var date = new Date()
    	var d    = date.getDate(),
        	m    = date.getMonth(),
        	y    = date.getFullYear()


        $.getJSON("{{url('events')}}", function(data){
        	// alert(JSON.stringify(data));
        	$('#calendar').fullCalendar({
				header    : {
	        		left  : 'prev,next today',
	        		center: 'title',
	        		right : 'month,agendaWeek,agendaDay'
	      		},
	      		buttonText:{
	      			today:"Hoje",
	      			month:"Mês",
	      			week:"Semana",
	      			day:"Dia",
	      		},
	      		events: data,
	      		displayEventTime:false,
			});

        });
			



	</script>
@endpush
@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Dashboard</h1>
@stop
@section('content')
    <div class="row">	
		<div class="col-md-6">	
			<div class="box box-primary">	
				<div class="box box-body no-padding">	
						<div id="calendar">	
						</div>
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
      		events: [
      			{
      				title: "Férias Ismael Castro",
      				start: "2019-07-30",
      				end:"2019-08-29",
      				backgroundColor: "#f39c12",
      				boderColor: "#f39c12",
      			},

      		],
      		displayEventTime:false,
		});
	</script>
@endpush
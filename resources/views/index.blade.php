@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Dashboard</h1>
@stop
@section('content')
    <div class="row">	
		<div class="col-md-9">	
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
		$('#calendar').fullCalendar({
			header    : {
        		left  : 'prev,next today',
        		center: 'title',
        		right : 'month,agendaWeek,agendaDay'
      		},
		});
	</script>
@endpush
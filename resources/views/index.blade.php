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
						<div id="calendar"></div>
				</div>
			</div>
		</div>
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
	

	<h2 class="page-header">Qualidade</h2>
	
	<div class="row">		
		<div class="col-md-8">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">Últimos planos de ação abertos</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<table id="actionplans" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Desc.</th>
										<th>Data de abertura</th>
										<th>Status</th>
										<th>Tipo de ação</th>
									</tr>
								</thead>
							</table>
						</div>
						
					</div>
				</div>
				<div class="box-footer clearfix">
					<a href="" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#new-actionplan">Inserir novo P.A</a>
					<a href="" class="btn btn-sm btn-default btn-flat pull-right">Ver todos</a>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="new-actionplan">
		<div class="modal-dialog">
			<div class="modal-content">
				{!! form_start($form) !!}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  	<span aria-hidden="true">&times;</span></button>
                	<h4 class="modal-title">Novo plano de ação</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							{!! form_row($form->label) !!}
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							{!! form_row($form->typeAction) !!}
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							{!! form_row($form->source) !!}
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					{!! form_row($form->submit) !!}
				</div>
				{!! form_end($form, $renderRest = false) !!}
			</div>
		</div>
	</div>
    
@stop
@push('css')
	<link rel="stylesheet" href="{{ URL::asset('plugins/fullcalendar/dist/fullcalendar.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('plugins/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush
@push('js')
	<script src="{{ URL::asset('plugins/moment/moment.js') }}"></script>
	<script src="{{ URL::asset('plugins/fullcalendar/dist/fullcalendar.min.js')}}"></script>
	<script src="{{ URL::asset('plugins/fullcalendar/dist/locale/pt-br.js')}}"></script>
	<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
	
	<script>
		var date = new Date()
    	var d    = date.getDate(),
        	m    = date.getMonth(),
        	y    = date.getFullYear()


        $.getJSON("{{url('events')}}", function(data){
        	// alert(JSON.stringify(data));
        	$('#calendar').fullCalendar({
        		lang: 'pt-br' ,
        		viewRender: function(view, element){
					dateCalendar = $('#calendar').fullCalendar('getDate');
					dateCalendar.month();
					alert(view.intervalStart.format());
				},
        		customButtons:{
	      			filterFerias:{
	      				text:'Férias',
	      				click: function(){
	      					$('#calendar').fullCalendar('removeEvents');
	      					eventAjax('Ferias');
	      					
	      				}
	      			},
	      			filterFiscal:{
	      				text:'Calendário Fiscal',
	      				click: function(){

	      				}
	      			}
	      		},
	      		footer:{
	      			left:'filterFerias',
	      		},
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
	<script>
		$(document).ready(function(){
			$('#actionplans').DataTable({
				processing:true,
				serverSide:true,
				ajax:'{{url('actionplans/datatables')}}',
				columns:[
					{data: 'label', name: 'label'},
					{data: 'openingDate', name:'openingDate'},
					{data: 'status', name: 'status'},
					{data: 'typeAction', name: 'typeAction'}
				],
				"language": {
                	"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            	}


			});

		});
	</script>
	<script src="{{URL::asset('js/fullcalendar/fullcalendarController.js')}}"></script>
@endpush
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
					<i class="fa fa-fw fa-file-text-o"></i>
					<h3 class="box-title">Emitir Relatórios</h3>
				</div>
				<div class="box-body">
					<div class="col-md-3">
						<button class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-default">
						Emitir F212
						</button>
					</div>
					
				</div>
			</div>
			<!-- Avisos 
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
			-->
		</div>
		<div class="col-md-6">

			<!-- Birthday 
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Aniversariantes do Mês</h3>
				</div>
				<div class="box-body">
					<div class="row">
						
							
						
						
					</div>
				</div>
			</div>
			-->
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

	<div class="modal fade" id="modal-default">
    	<div class="modal-dialog">
        	<div class="modal-content">
            	<div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                  <span aria-hidden="true">&times;</span></button>
                	<h4 class="modal-title">Emitir F212</h4>
              	</div>
				<form action="{{url('f212')}}" method="GET" id="f212">
	              <div class="modal-body">
	            		
	            		

					<div class="row">
	            		<div class="col-md-6">
	            				<div class="form-group">
	            					<label>Filial:</label>
                					<select class="form-control select2" name="filial" id='filial' 
                					data-placeholder="Escolha uma Filial:"
                        			style="width: 100%;">
					                  <option value="0">Proel Comércio</option>
					                  <option value="1">SH Hospitalar</option>
					                  <option value="2">Proel Representações</option>
					                  <option value="3">Select</option>
                  
                					</select>
	            				</div>
	            		</div>
	            		<div class="col-md-6">
	            				<div class="form-group">
	            					<label>Baixar em:</label>
                					<select class="form-control select2" name="ext" id='ext' data-placeholder="Baixar em:"
                        			style="width: 100%;">
					                  <option value="EXCEL">Excel</option>
					                  <option value="PDF">PDF</option>
                  
                					</select>
	            				</div>
	            		</div>
	            	</div>

					<div class="row">
            			<div class="col-md-6">
            				<div class="form-group">
            					<label for="">Data Inicial</label>
            					<input  class="form-control datepicker" name="dtInicial" id="dtInicial" required placeholder="Data Inicial" value="">
            				</div>
            			</div>
            			<div class="col-md-6">
            				<div class="form-group">
            					<label for="">Data Final</label>
            					<input class="form-control datepicker" name="dtFinal" id="dtFinal" required placeholder="Data Final">
            				</div>
            			</div>
	            			
	            	</div>


	            	    
	              </div>
	              <div class="modal-footer">
	                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
	                <input type="submit" id="download" class="btn btn-primary" value="Download">                	
	            	
	              </div>
	              </form>
            </div>
            <!-- /.modal-content -->
        </div>
          <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="download">
    	
    </div>
@stop
@push('css')
	<link rel="stylesheet" href="{{ URL::asset('plugins/fullcalendar/dist/fullcalendar.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('plugins/fullcalendar/dist/fullcalendar.print.min.css') }}" media="print">
	<link rel="stylesheet" href="{{ URL::asset('css/fullcalendar/customFullcalendar.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('plugins/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
	<style>
		span.select2-container{
			width: 100% !important;
		}
	</style>

@endpush
@push('js')
	<script src="{{ URL::asset('plugins/moment/moment.js') }}"></script>
	<script src="{{ URL::asset('plugins/fullcalendar/dist/fullcalendar.min.js')}}"></script>
	<script src="{{ URL::asset('plugins/fullcalendar/dist/locale/pt-br.js')}}"></script>
	<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
	<script src="{{ URL::asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
	<script src="{{ URL::asset('plugins/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
	<script src="{{ URL::asset('plugins/bower_components/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js') }}"></script>
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
	<script>
		var date = new Date()
    	var d    = date.getDate(),
        	m    = date.getMonth(),
        	y    = date.getFullYear();


        $(document).ready(function(){
		

	    	// alert(JSON.stringify(data));
	    	$('#calendar').fullCalendar({
	    		lang: 'pt-br' ,
	    		viewRender: function(view, element){
					dateCalendar = $('#calendar').fullCalendar('getDate');
					year = dateCalendar.year();
					month = dateCalendar.month() + 1;
					monthStart = view.intervalStart.format();
					monthEnd = view.intervalEnd.format();

					getEventsmonthly(monthStart, monthEnd, month, year);
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
	      		eventMouseover: function(event, jsEvent, view){
	      			$(this).addClass('eventMouseover');
	      		},
	      		eventMouseout: function(event, jsEvent, view){
	      			$(this).removeClass('eventMouseover');
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
	      		displayEventTime:false,
			});

			$('.select2').select2();



        });
			
        


	</script>
	<script>
		
		function getEventsmonthly(start, end){
			$.ajax({
				url:"{{url('events')}}",
				type:'JSON',
				method:'GET',

				data:{start:start, end: end, month:month, year: year},
				success: function(events){
					$('#calendar').fullCalendar('removeEvents')
					$('#calendar').fullCalendar('renderEvents', JSON.parse(events));			
					
				},
			});
		}

		
		$(".datepicker").datepicker({	
			language: 'pt-BR',	
			autoclose: true,
			
		});
		

		var date = new Date();
		var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
		var lastDay = new Date(date.getFullYear(), date.getMonth()+1, 0);
		$('#dtInicial').val(firstDay.toLocaleDateString("pt-BR"));
		$('#dtFinal').val(lastDay.toLocaleDateString("pt-BR"));
		
	</script>
	
	<script src="{{URL::asset('js/fullcalendar/fullcalendarController.js')}}"></script>
	
@endpush


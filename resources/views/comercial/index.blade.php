@extends('adminlte::page')
@section('title', 'Resumo de ações comerciais')
@section('content_header')
    <h1>Comercial</h1>
@stop
@section('content')
	<h2 class="page-header">Faturamento/Financeiro</h2>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-solid bg-teal-gradient">
				<div class="box-header">
					<i class="fa fa-th"></i>
					<h3 class="box-title">Faturamento</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                		</button>
                		<button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                		</button>
					</div>
				</div>
				<div class="box-body border-radius-none">
					<div class="chart" id="faturamento" style="height: 250px;"></div>
				</div>
				<div class="box-footer no-border">
					<h5 class="box-title" style="color:black">Faturamento Hoje</h5>
					<div class="row">
						<div class="col-sm-3 col-xs-6">
							<div class="description-block border-right">
								<h5 class="description-header text-dark">
									R$ {{ number_format($arr_faturamento->faturamentoProel,2)}}
								</h5>
								<span class="description-text text-dark">Proel Hospitalar</span>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">
							<div class="description-block border-rigth">
								<h5 class="description-header text-dark">
									R$ {{ number_format($arr_faturamento->faturamentoSH,2)}}
								</h5>
								<span class="description-text text-dark">SH Hospitalar</span>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">
							<div class="description-block border-rigth">
								<h5 class="description-header text-dark">
									R$ {{ number_format($arr_faturamento->faturamentoRep,2)}}
								</h5>
								<span class="description-text text-dark">Proel Repre.</span>
							</div>
						</div>
						<div class="col-sm-3 col-xs-6">
							<div class="description-block border-rigth">
								<h5 class="description-header text-dark">
									R$ {{ number_format($arr_faturamento->faturamentoSelect,2)}}
								</h5>
								<span class="description-text text-dark">Select</span>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="info-box">
	            <span class="info-box-icon bg-green"><i class="fa fa-fw fa-dollar"></i></span>

	            <div class="info-box-content">
	             	<span class="info-box-text">Faturamento do Grupo</span>
	             	<span class="info-box-number">R$ {{number_format($total, 2)}}</span>
	            </div>
	            <!-- /.info-box-content -->
          	</div>
		</div>
	</div>
	<h2 class="page-header">Ações Comerciais</h2>
	<div class="row">
		<div class="col-md-8">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">Registro de Visitas</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-6">							
							<input type="text" class="datepicker" placeholder="Data Inicial">							 
						</div>
						<div class="col-xs-6">							
							<input type="text" class="datepicker" placeholder="Data Final">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="bg-white">
								
								<div class="table-responsive">
									<table id="visitas" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Cliente</th>
												<th>Número de visitas</th>
											</tr>
										</thead>
										
									</table>
								</div>
							</div>
						</div>
					</div>				
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
	
@stop
@push('css')
	
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
	<style>
		.bg-white{
			background: #fff;

		}
		.datepicker-modal{
			max-height: 349px !important;
		}
		.text-dark{
			color: #000 !important;
		}
	
	</style>
	<link rel="stylesheet" href="{{url('plugins/bower_components/morrisjs/morris.css')}}">
	<link rel="stylesheet" href="{{url('plugins/materialize/css/materialize.min.css')}}">
	
@endpush

@push('js')
	<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
	
	
	<script>
		$(document).ready(function(){
			// $('body').bind('contextmenu', function(e){
			// 	return false;	
			// });
			

			$('#visitas').DataTable({
				processing:true,
				serverSide:true,
				ajax:'{{url('teste')}}',
				columns:[
					{data: 'cliente', name: 'cliente'},
					{data: 'qtdV', name:'qtdV'},
					
				],
				"language": {
                	"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            	},

			});

			$('.datepicker').datepicker({
				format: 'dd/mm/yyyy',
			});
			
		});	
	</script>	
	<script src="{{url('plugins/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
	<script src="{{url('plugins/materialize/js/materialize.min.js')}}"></script>
	@include('sweetalert::alert')
@endpush

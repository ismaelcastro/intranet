@extends('adminlte::page')
@section('title', 'Resumo de ações comerciais')
@section('content_header')
    <h1>Comercial</h1>
@stop
@section('content')
	<h2 class="page-header">Faturamento/Financeiro</h2>
	<div class="row">
		<div class="col-md-8">
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
						<div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
							<input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">
                         <div class="knob-label">Proel Hospitalar</div>
						</div>
						<div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
							<input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">
                         <div class="knob-label">SH</div>
						</div>
						<div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
							<input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">
                         <div class="knob-label">Proel Rep.</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<h2 class="page-header">Ações Comerciais</h2>
	<div class="row">
		<div class="col-md-6">
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">Registro de Visitas</h3>
				</div>
				<div class="box-body">
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
	
	</style>
	<link rel="stylesheet" href="{{url('plugins/bower_components/morrisjs/morris.css')}}">
	
@endpush

@push('js')
	<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
	
	
	<script>
		$(document).ready(function(){
			$('body').bind('contextmenu', function(e){
				return false;	
			});
			

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
			
		});	
	</script>	
	<script src="{{url('plugins/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
	@include('sweetalert::alert')
@endpush

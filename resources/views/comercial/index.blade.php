@extends('adminlte::page')
@section('title', 'Resumo de ações comerciais')
@section('content_header')
    <h1>Comercial</h1>
@stop
@section('content')
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
	@include('sweetalert::alert')
@endpush

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
										<tbody>
											
										</tbody>
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
			$.ajax({
				url: 'http://localhost/callistoapi/public/api/visitasComerciais',
				type:'JSON',
				method:'GET',
				success: function(data){
					$.each(data, function(index, el) {
						
						link = "visitacliente/"+el.idCliente;
						visitaTotal = el.qtdV;	
						html = '<tr> <td><a href="'+link+'">'+el.cliente+'</a></td> <td><span class="badge bg-light-blue">'+visitaTotal+'</span></td> </tr>';
						$('table#visitas tbody').append(html);
					});		
					
				},
			})
			
		});	
	</script>	
	@include('sweetalert::alert')
@endpush

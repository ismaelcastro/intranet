@extends('adminlte::page')
@section('title', 'Planos de Ação')
@section('content_header')
    <h1><small>Ações abertas para o plano de ação</small> {{$PAname}}</h1>
@stop
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class="box box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="bg-white">
								<div class="table-responsive">
									<table id="actions" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>ID</th>
												<th>Desc.</th>
												<th>Previsão para conclusão</th>
												<th>Data de conclusão</th>
												<th>Encerrado no prazo ?</th>
												<th>Data para verificação</th>
												<th>Eficaz ?</th>
												<th>Necessidade de nova abertura ?</th>
												<th>Nº do novo plano</th>
												<th>Ecerrar</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>				
					
				</div>
				<div class="box-footer clearfix">
					<a href="" class="btn btn-sm btn-info btn-flat pull-left" data-toggle="modal" data-target="#new-action">Inserir nova ação</a>
				</div>
			</div>
			
		</div>
		
	</div>
	<!-- modal new action -->
	<div class="modal fade" id="new-action">
		<div class="modal-dialog">
			{!! form_start($form) !!}
			{!! form_row($form->actionplans_id) !!}
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  	<span aria-hidden="true">&times;</span></button>
                	<h4 class="modal-title">Nova Ação</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">{!! form_row($form->label) !!}</div>
						<div class="col-md-6">{!! form_row($form->DTprevEnd) !!}</div>
					</div>
					
				</div>
				<div class="modal-footer">
                	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                	{!! form_row($form->submit) !!}
              	</div>
			</div>
			{!! form_end($form, $renderRest = false) !!}
		</div>
	</div>
	<!-- end -->
	
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
			$('#actions').DataTable({
				processing:true,
				serverSide:true,
				ajax:'{{url("actions/datatables", [$id])}}',
				columns:[
					{data: 'id', name: 'id'},
					{data: 'label', name: 'label'},
					{data: 'DTprevEnd', name: 'DTprevEnd'},
					{data: 'DTend', name: 'DTend'},
					{data: 'deadline', name:'deadline'},
					{data: 'DTverify', name:'DTverify'},
					{data: 'effective', name:'effective'},
					{data: 'duplicate', name:'duplicate'},
					{data: 'beforeaction', name:'beforeaction'},
					{data: 'action', name:'action'},
					
				],
				"language": {
                	"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            	}

			});

		});
	</script>
	<script>
		$(document).ready(function(){
			$('body').bind('contextmenu', function(e){
				return false;	
			});

			
		});	
	</script>	
	@include('sweetalert::alert')
@endpush

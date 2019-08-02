@extends('adminlte::page')
@section('title', 'Planos de Ação')
@section('content_header')
    <h1><small>Ações abertas para o plano de ação</small> Melhoria do processo de treinamento</h1>
@stop
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box box-body no-padding">	
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Desc.</th>
									<th>Previsão para conclusão</th>
									<th>Data de conclusão</th>
									<th>Encerrado no prazo ?</th>
									<th>Data para verificação</th>
									<th>Eficaz ?</th>
									<th>Necessidade de nova abertura ?</th>
									<th>Nº do novo plano</th>
								</tr>
							</thead>
						</table>
					</div>	
				</div>
			</div>
		</div>
	</div>
@stop
@push('css')
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush

@push('js')
	<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
	<script>
		
	</script>
@endpush

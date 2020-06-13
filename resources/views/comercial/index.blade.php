@extends('adminlte::page')
@section('title', 'Resumo de ações comerciais')
@section('content_header')
    <h1>Comercial</h1>
@stop
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box box-solid">
				<div class="box-header">
					<i class="fa fa-th"></i>
					<h3 class="box-title">Sugestão de Compra</h3>
				</div>
				<form class="needs-validation">
					<div class="box-body">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<div class="input-group">
						                <button type="button" class="btn btn-default pull-right" id="DTAnaliseCompra">
						                    <span>
						                    	<i class="fa fa-calendar"></i> Escolha um Período
						                    </span>
						                    <i class="fa fa-caret-down"></i>
						                </button>
					                </div>
				            	</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="col-sm-5 control-label">Centro de Custo</label>
									<div class="col-sm-7">
										<select id="centroCusto" class="form-control">
											<option value="-1">Ambos</option>
											<option value="3">Assistência Técnica</option>
											<option value="4">Comercial</option>
										</select>
									</div>
									
								</div>
							</div>
						</div>
						<div class="row">						
							<div class="col-md-3">
								<div class="form-group">
									<label for="diasReposicao" class="col-sm-4 control-label">Dias de Reposição</label>
									<div class="col-sm-8">
										<input type="number" class="form-control required" id="diasReposicao" placeholder="Ex.: 30">
										<div class="invalid-feedback">Ops! Este campo precisa ser preenchido.</div>	
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="prazoEntrega" class="col-sm-4 control-label">Prazo Entrega</label>
									<div class="col-sm-8">
										<input type="number" class="form-control required" id="prazoEntrega" placeholder="Ex.: 30" >	
										<div class="invalid-feedback">Ops! Este campo precisa ser preenchido.</div>	
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<button id="submitT" type="submit" class="btn btn-primary">Consultar</button>
								</div>
							</div>
							<div class="col-md-3 text-right">
								<div class="form-group">
									
									<div class="btn-group">
					                  <button type="button" class="btn btn-info">Exibir</button>
					                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
					                    <span class="caret"></span>
					                    <span class="sr-only">Toggle Dropdown</span>
					                  </button>
					                  <ul class="dropdown-menu collunm-list" role="menu">
					                    
					                  </ul>
					                </div>
						            
					            </div>
							</div>
							
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table id="analiseCompras" class="table table-bordered table-striped">
										<thead>
											<th>Cod.</th>
											<th>Cod. Alternativo</th>
											<th>Nome do Produto</th>
											<th>UND</th>
											<th>Qtd. Total Saída</th>
											<th>Valor Total Saída</th>
											<th>Saída Média Mensal</th>
											<th>Estoque Mínimo</th>
											<th>Saldo Atual</th>
											<th>Disponível</th>
											<th>Dias de Cobertura</th>
											<th>Sugestão de Compra</th>
											<th>Data para Próxima Compra</th>
											<th>Classificação ABC %</th>
											<th>Fornecedor</th>
											<th>Custo Unitário Última Compra</th>
											<th>Qtd. Última Compra</th>	
											<th>Data Última Compra</th>
											<th>NF Última Compra</th>
											<th>Valor Total da NF</th>						
										</thead>	
									</table>
									
								</div>							

							</div>
						</div>
					</div>
					<div class="box-footer no-border">
				</form>
					
				</div>
			</div>
		</div>
	</div>
	
@stop
@push('css')
	
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.dataTables.min.css">
	<link rel="stylesheet" href="{{url('plugins/bower_components/morrisjs/morris.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('plugins/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('css/comercial/table.css')}}">
	<style type="text/css">
		.collunm-list{
			left: -150px !important;
			max-height: 300px;
			overflow-y: scroll;
		}

		
		.invalid-feedback{
			display: none;
			color: #dd4b39;
		}
		.MyColumn{
			background: whitesmoke ;
		}
	</style>	
@endpush

@push('js')
	<script src="{{ URL::asset('plugins/moment/moment.js') }}"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js"></script>
	<script src="{{ URL::asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	<!-- bootstrap datepicker -->
	<script src="{{ URL::asset('plugins/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
	<script src="{{ URL::asset('plugins/bower_components/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js') }}"></script>
	<script src="{{ URL::asset('js/comercial/datepickrange.js')}}"></script>
	<script src="{{ URL::asset('js/comercial/validate.js')}}"></script>
	<script>
		$("#submitT").on('click', function(e){
				e.preventDefault();
				var startDate = $("#DTAnaliseCompra").data('daterangepicker').startDate.format('YYYY-MM-DD');
				var endDate   = $("#DTAnaliseCompra").data('daterangepicker').endDate.format('YYYY-MM-DD');

				validate()
				if($.fn.dataTable.isDataTable('#analiseCompras'))
				{
					$('#analiseCompras').DataTable().clear().destroy();
				}

				if(!validate()){


					var table = $('#analiseCompras').DataTable({
					dom: 'lBfrtip',
					"lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
					retrieve: true,
					destroy: true,				
					processing:true,
					serverSide:false,
					ajax:{
						'url':'{{url('comercial/sugestaoCompra')}}',
						'contentType': 'application/json',
						'type': "get",
						'data' : 
							{
							"cdFilial": 0,
							"dtInicial": startDate,
							"dtFinal": endDate,
							"prazoEntrega": $("#prazoEntrega").val(),
							"centroCusto" : $("#centroCusto").val(),
							"diasReposicao" : $("#diasReposicao").val()
							}

						},
						columns:[
							{data: 'codp', name: 'codp', visible: false},
							{data: 'codigoAlternativo', name:'codigoAlternativo'},
							{data: 'nmProduto', name:'nmProduto'},
							{data: 'nmUnidade', name: 'nmUnidade', visible: false},
							{data: 'qtMovSaida', name: 'qtMovSaida'},
							{data: 'vlMovSaida', name: 'vlMovSaida', visible: false},
							{data: 'SaidaMediaMensal', name: 'SaidaMediaMensal'}, 
							{data: 'EstoqueMinimo', name: 'EstoqueMinimo'}, 
							{data: 'SaldoAtual', name: 'SaldoAtual', visible: false},
							{data: 'EstAtual', name: 'EstAtual'}, 
							{data: 'diasCoberturaAtual', name: 'diasCoberturaAtual'}, 
							{data: 'Sugestao', name: 'Sugestao', className: 'MyColumn'}, 
							{data: 'dtProximaCompra', name: 'dtProximaCompra',}, 
							{data: 'ABC', name: 'ABC', visible: false}, 
							{data: 'Fornecedor', name: 'Fornecedor'}, 
							{data: 'ValorUltimaCompra', name: 'ValorUltimaCompra'}, 
							{data: 'qtdUltimaCompra', name: 'qtdUltimaCompra'}, 
							{data: 'dtUltimaCompra', name: 'dtUltimaCompra', visible: false}, 
							{data: 'NF', name: 'NF', visible: false}, 
							{data: 'vlTotalNF', name: 'vlTotalNF', visible: false},					

					
						],

						"language": {
                			"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            			},
            			"order" : [[13, "desc"]],
            			buttons: [
            				'copyHtml5',
            				{
            					extend:'excelHtml5',
            					title: 'Suguestão de Compras'
            				},
            		
            				'csvHtml5',
            				{
            					extend: 'pdfHtml5',
            					title: 'Suguestão de Compras',
                				orientation: 'landscape',
                				pageSize: 'A3'
            				}
        				]



					});


				}	
					

				$("#analiseCompras thead th").each(function(index){

					var visible = table.column(index).visible() === true ? "checked" : ""; 
					var html = '<li><a href="#"><label><input class="toggle-vis" '+visible+' data-column='+index+' type="checkbox" class="flat-red">'+$(this).text()+'</label></a></li>';
					$(".collunm-list").append(html);
					});				

				$(".collunm-list li .toggle-vis").on('click', function(e){
				

					var column = table.column($(this).attr('data-column'));
					column.visible( !column.visible() );

				});
				
			
			});
	</script>
	@include('sweetalert::alert')
@endpush

@extends('adminlte::page')
@section('title', 'Financeiro Recebimetos - F212')
@section('content_header')
    <h1>Financeiro</h1>
@stop
@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header">
                    <i class="fa fa-th"></i>
                    <h3 class="box-title">Financeiro Recebimetos - F212</h3>
                </div>

                <div class="box-body">
                    <form action="">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <label class="col-sm-3 control-label">Filial</label>
                                    <div class="col-sm-8">
                                        <select id="filial" class="form-control">
                                            <option value="0">Proel Comercio e Serviço</option>
                                            <option value="3">SELECT BR</option>
                                            <option value="1">SH Hospitalar</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-sm-3 control-label">Data Inicial</label>
                                    <div class="col-sm-8">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker" id="dtInicial" autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-sm-3 control-label">Data Final</label>
                                    <div class="col-sm-8">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right datepicker" id="dtFinal" autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="container">
                                <div class="form-group">
                                    <div class="col-md-1">
                                        <button id="submitrel" class="btn btn-primary">Consultar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="content">
                        <div class="row">
						    <div class="col-md-3 text-right pull-right">
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
                                    <table id="report" class="table table-bordered table-striped">
                                        <thead>
                                        <th>Código Recebimento</th>
                                        <th>Representante</th>
                                        <th>Nº Documento</th>
                                        <th>Vencimento</th>
                                        <th>Lançamento</th>
                                        <th>Emissão</th>
                                        <th>Data Recebimento</th>
                                        <th>Baixa</th>
                                        <th>Valor Bruto</th>
                                        <th>Valor Base</th>
                                        <th>Forma de Rec.</th>
                                        <th>Juros</th>
                                        <th>Multa</th>
                                        <th>Valor Desconto</th>
                                        <th>Valor Recebido</th>
                                        <th>Cliente</th>
                                        <th>NF</th>
                                        <th>Cedente</th>
                                        <th>Operação</th>
                                        <th>Tipo de Documento</th>
                                        <th>Estado</th>
                                        <th>Valor Impostos</th>
                                        <th>Valor IRRF</th>
                                        <th>Valor ISS</th>
                                        <th>Valor CSLL</th>
                                        <th>Valor PIS</th>
                                        <th>Valor INSS</th>
                                        <th>Valor COFINS</th>
                                        <th>Emissão Pedido</th>
                                        <th>dsNFSe</th>
                                        <th>CNPJ</th>
                                        <th>COFINS Retido</th>
                                        <th>CS Retido</th>
                                        <th>PIS Retido</th>
                                        <th>ICMS Retido</th>
                                        <th>ISS Retido</th>
                                        <th>Valor Bruto Movimentação</th>
                                        <th>Valor Desconto Movimentação</th>
                                        <th>Valor Liquido Movimentação</th>
                                        <th>Valor Financeiro Movimentação</th>

                                        </thead>
                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer no-border"></div>
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
    <script src="https://cdn.datatables.net/plug-ins/1.10.12/sorting/date-eu.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{ URL::asset('plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ URL::asset('plugins/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ URL::asset('plugins/bower_components/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js') }}"></script>
    <script src="{{ URL::asset('js/datepickReginalPTBR.js')}}"></script>
    <script src="{{ URL::asset('js/comercial/datepickrange.js')}}"></script>
    <script src="{{ URL::asset('js/comercial/validate.js')}}"></script>
    <script src="{{ URL::asset('js/datatableColumnVisible/datatableColumnVisible.js')}}"></script>
    <script>
        $("#submitrel").click(function (e){
            e.preventDefault();
            nomeFilial = $("#filial option:selected").html() ;
            dtinicial = moment($("#dtInicial").datepicker('getDate'));
            dtFim = moment($("#dtFinal").datepicker('getDate'));
            if($.fn.dataTable.isDataTable('#report'))
            {
                $('#report').DataTable().clear().destroy();
            }


            table = $('#report').DataTable({
                dom: 'lBfrtip',
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
                retrieve: true,
                destroy: true,
                processing:true,
                serverSide:false,
                ajax:{
                    'url':'{{"relatorios/RelF212"}}',
                    'contentType': 'application/json',
                    'type': "get",
                    'data':{
                        'cdFilial':$("#filial").val(),
                        'dtInicio': dtinicial.format("YYYY-MM-DD"),
                        'dtFim': dtFim.format("YYYY-MM-DD"),
                    }
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                },
                columns: [
                    {data:'cdRec', name:'cdRec', visible:false},
                    {data:'cdRepres', name:'cdRepres', visible: false},
                    {data:'nrDoc', name:'nrDoc'},
                    {data:'dtVencto', name:'dtVencto', "type":'date-eu'},
                    {data:'dtLancto', name:'dtLancto', "type":'date-eu', visible: false},
                    {data:'dtEmissao', name:'dtEmissao', "type":'date-eu'},
                    {data:'dtPag', name:'dtPag'},
                    {data:'dtBaixa', name:'dtBaixa'},
                    {data:'vlBruto', name:'vlBruto'},
                    {data:'vlBaseBruto', name:'vlBaseBruto'},
                    {data:'FormaRec', name:'FormaRec'},
                    {data:'Juros', name:'Juros', visible: false},
                    {data:'Multa', name:'Multa', visible: false},
                    {data:'vlDesc', name:'vlDesc', visible: false},
                    {data:'vlPago', name:'vlPago', visible: false},
                    {data:'Cliente', name:'Cliente'},
                    {data:'nf', name:'nf'},
                    {data:'dsCedente', name:'dsCedente', visible: false},
                    {data:'dsOp', name:'dsOp', visible: false},
                    {data:'tpDoc', name:'tpDoc'},
                    {data:'stEstado', name:'stEstado', visible: false},
                    {data:'vlImpostos', name:'vlImpostos'},
                    {data:'vlIRRF', name:'vlIRRF'},
                    {data:'vlISS', name:'vlISS'},
                    {data:'vlCSLL', name:'vlCSLL'},
                    {data:'vlPIS', name:'vlPIS'},
                    {data:'vlINSS', name:'vlINSS', visible: false},
                    {data:'vlCOFINS', name:'vlCOFINS'},
                    {data:'EmissaoPedido', name:'EmissaoPedido',"type":'date-eu', visible: false},
                    {data:'dsNFSe', name:'dsNFSe', visible: false},
                    {data:'CNPJ', name:'CNPJ'},
                    {data:'vlCOFINSRetidoMov', name:'vlCOFINSRetidoMov', visible: false},
                    {data:'vlCSRetidoMov', name:'vlCSRetidoMov', visible: false},
                    {data:'vlPISRetidoMov', name:'vlPISRetidoMov', visible: false},
                    {data:'vlICMSRetidoMov', name:'vlICMSRetidoMov', visible: false},
                    {data:'vlISSRetidoMov', name:'vlISSRetidoMov'},
                    {data:'vlBrutoMov', name:'vlBrutoMov'},
                    {data:'vlDescontoMov', name:'vlDescontoMov', visible: false},
                    {data:'vlLiquidoMov', name:'vlLiquidoMov',visible: false},
                    {data:'vlFinanceiroMov', name:'vlFinanceiroMov', visible:false}

                ],
                buttons: [
                    'copyHtml5',
                    {
                        extend:'excelHtml5',
                        title: 'Recebimentos - F212',
                        messageTop: 'Filial:' + nomeFilial + 
                                ' \n Data Inicial: '+ dtinicial.format("DD/MM/YYYY") + 
                                '\n Data Final: ' +  dtFim.format("DD/MM/YYYY"),
                    },

                    'csvHtml5',
                    {
                        extend: 'pdfHtml5',
                        messageTop: 'Filial:' + nomeFilial + 
                                ' \n Data Inicial: '+ dtinicial.format("DD/MM/YYYY") + 
                                '\n Data Final ' +  dtFim.format("DD/MM/YYYY"),
                        title: 'Recebimentos - F212',
                        orientation: 'landscape',
                        pageSize: 'A3'
                    }
                ]

            });
            
            columnListVisible();
        });


        $(document).ready(function (){
            $('.datepicker').datepicker({
                autoclose: true,
                language:'pt-BR',
                format:"dd/mm/yyyy",
            })
        })

    </script>
    
    @include('sweetalert::alert')
@endpush

@extends('adminlte::page')
@section('title', 'Posição de Estoque - RelS016')
@section('content_header')
<h1>Estoque</h1>
@stop
@section('content')
<div class="row">

    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header">
                <i class="fa fa-th"></i>
                <h3 class="box-title">Posição de Estoque - RelS016</h3>
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
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-sm-3 control-label">Data do Balanço</label>
                                    <div class="col-sm-8">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker" autocomplete="off">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label class="col-sm-3 control-label">Tipo de Produto</label>
                                        <div class="col-sm-8">
                                            <select id="fvenda" class="form-control">
                                                <option value="I">Ativo Imobilizado</option>
                                                <option value="N">Material de Uso ou Consumo</option>
                                                <option value="A">Mercadoria para revenda</option>
                                                <option value="S">Produtos Acabados</option>
                                                <option value="V">Serviço (Venda)</option>
                                                <option value="C">Serviço (Consumo)</option>
                                                <option value="O">Outras</option>
                                            </select>
                                        </div>
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
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="report" class="table table-bordered table-striped">
                                    <thead>
                                    <th>Classe do Item</th>
                                    <th>Grupo do Item</th>
                                    <th>SubGrupo</th>
                                    <th>Código Item</th>
                                    <th>Código Alternativo</th>
                                    <th>Nome do Item</th>
                                    <th>Unidade</th>
                                    <th>Grupo Contábil</th>
                                    <th>NCM</th>
                                    <th>Descrição NCM</th>
                                    <th>Saldo</th>
                                    <th>Valor Financeiro</th>
                                    <th>Preço Médio</th>
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
<script>
    $("#submitrel").click(function (e){
        e.preventDefault();

        if($.fn.dataTable.isDataTable('#report'))
        {
            $('#report').DataTable().clear().destroy();
        }


         $('#report').DataTable({
                dom: 'lBfrtip',
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
                retrieve: true,
                destroy: true,
                processing:true,
                serverSide:false,
                ajax:{
                    'url':'{{"RelS016"}}',
                    'contentType': 'application/json',
                    'type': "get",
                    'data':{
                        'cdFilial':$("#filial").val(),
                        'dtBalanco': moment($("#datepicker").datepicker('getDate')).format("YYYY-MM-DD"),
                        'ClassificacaoProduto': $("#fvenda").val()
                    }
                },
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                },
                columns: [
                    {data:'nmClasse', name:'nmClasse'},
                    {data:'nmGrupo', name:'nmGrupo'},
                    {data:'nmSubgrupo', name:'nmSubgrupo'},
                    {data:'codp', name:'codp'},
                    {data:'cdAlter', name:'cdAlter'},
                    {data:'nmProduto', name:'nmProduto'},
                    {data:'nmUnidade', name:'nmUnidade'},
                    {data:'dsGrupoCtb', name:'dsGrupoCtb'},
                    {data:'NCM', name:'NCM'},
                    {data:'dsNCM', name:'dsNCM'},
                    {data:'qtSaldo', name:'qtSaldo'},
                    {data:'vlFinanceiro', name:'vlFinanceiro'},
                    {data:'vlPrecoMedio', name:'vlPrecoMedio'},

                ],
                 buttons: [
                     'copyHtml5',
                     {
                         extend:'excelHtml5',
                         title: 'Posição de Estoque - RelS016'
                     },

                     'csvHtml5',
                     {
                         extend: 'pdfHtml5',
                         title: 'Posição de Estoque - RelS016',
                         orientation: 'landscape',
                         pageSize: 'A3'
                     }
                 ]

            });

    });
    $(document).ready(function (){
        $('#datepicker').datepicker({
            autoclose: true,
            language:'pt-BR',
            format:{
                toDisplay:function (date){
                    var date = new Date(date),
                        month = '' + (date.getMonth() + 1),
                        day = '' + date.getUTCDate(),
                        year = date.getFullYear();
                    if (month.length < 2) month = '0' + month;
                    if (day.length < 2) day = '0' + day;
                    return [day, month, year].join('/');
                },
                toValue: function(dt){
                    var date = new Date(date),
                        month = '' + (date.getMonth() + 1),
                        day = '' + date.getUTCDate(),
                        year = date.getFullYear();
                    if (month.length < 2) month = '0' + month;
                    if (day.length < 2) day = '0' + day;
                    return [year, month, day].join('-');
                }
            }
        })
    })

</script>

@include('sweetalert::alert')
@endpush

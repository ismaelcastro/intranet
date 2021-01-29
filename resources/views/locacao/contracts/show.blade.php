@extends('adminlte::page')
@section('title', 'Posição de Estoque - RelS016')
@section('content_header')
<h1>Contratos de Locação</h1>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header">
                <i class="fa fa-th"></i>
                <h3 class="box-title">
                    Objetos Cobertos -
                    {{$contracts->numberContract}} -
                    {{$contracts->description}}
                </h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="objetoscobertos" class="table table-bordered table-striped">
                        <thead>
                            <th>id</th>
                            <th>Cod.</th>
                            <th>Cod. Alternativo</th>
                            <th>Descrição</th>
                            <th>Quantidade</th>
                            <th>Nº Serie</th>
                            <th>R$ Valor</th>
                            <th>Contrato</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @foreach($products as $p)
                            <tr class='context-menu-one'>
                                <td>{{$p->id}}</td>
                                <td>{{$p->codp}}</td>
                                <td>{{$p->apelido}}</td>
                                <td>{{$p->nome}}</td>
                                <td>{{$p->qtd}}</td>
                                <td>{{$p->numSerie}}</td>
                                <td>{{number_format($p->valor, 2)}}</td>
                                <td>
                                    @if(isset($p->contracts->numberContract))
                                        {{$p->contracts->numberContract}}
                                    @endif

                                </td>
                                <td>
                                    <span class="label {{$p->active ? 'bg-green': 'bg-red'}}">
                                        {{$p->active ? 'Operacional' : 'Condenado'}}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">

<style type="text/css">
    .select2-container{
	    display:block !important;
	    width: 100% !important;
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.ui.position.js"></script>
<script src="{{ URL::asset('js/contextMenu/contextMenu.js')}}"></script>
<script>

	$('.select2').select2();



</script>

@include('sweetalert::alert')
@endpush

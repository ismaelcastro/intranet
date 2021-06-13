@extends('adminlte::page')
@section('title', 'Posição de Estoque - RelS016')
@section('content_header')
<h1>Contratos de Locação - Acessórios do Equipamento</h1>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header">
                <i class="fa fa-th"></i>
                <h3 class="box-title">{{$p->nome}} - {{$p->numSerie}}</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2 border-right">
                        <div class="description-block">
                            <h5 class="description-header">N° Contrato</h5>
                            <span class="description-text">
                                {{$p->contracts->numberContract}}
                            </span>
                        </div>

                    </div>
                    <div class="col-md-2 border-right">
                        <div class="description-block">
                            <h5 class="description-header">Cliente</h5>
                            <span class="description-text">
                                {{$p->contracts->customer->name}}
                            </span>
                        </div>

                    </div>
                    <div class="col-md-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header">Descrição</h5>
                            <span class="description-text">
                                {{$p->contracts->description}}
                            </span>

                        </div>
                    </div>
                    <div class="col-md-2 border-right">

                        <div class="description-block">
                            <h5 class="description-header">Data de Inicio</h5>
                            <span class="description-text">
                                {{\Carbon\Carbon::parse($p->contracts->dtStart)->format("d/m/Y")}}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2 border-right">

                        <div class="description-block">
                            <h5 class="description-header">Data de Fim</h5>
                            <span class="description-text">
                                {{\Carbon\Carbon::parse($p->contracts->dtEnd)->format("d/m/Y")}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button
                            type="button"
                            class="btn btn-info"
                            data-toggle="modal"
                            data-target="#modal-acessorios">
                                Incluir Acessório
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="contratos" class="table table-bordered table-striped">
                                <thead>
                                    <th>Cod. Alternativo</th>
                                    <th style="width: 150px">Descrição</th>
                                    <th>QTD</th>
                                    <th>Nº Serie</th>
                                    <th>R$ Valor</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </thead>
                                <tbody>
                                    @foreach ($acessories as $item)


                                    <tr>
                                       <td>{{$item->apelido }}</td>
                                       <td>{{$item->nome}}</td>
                                       <td>{{$item->qtd}}</td>
                                       <td>{{$item->numSerie}}</td>
                                       <td>{{number_format($item->valor, 2)}}</td>
                                       <td>
                                            <span class="badge {{$item->active ? 'bg-green': 'bg-red'}}">
                                                {{$item->active ? 'Operacional' : 'Condenado'}}
                                            </span>
                                       </td>
                                       <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-info">Opções</button>
                                            <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{route('produtos.edit', $item->id)}}">Editar</a></li>
                                                <li><a href="{{ route('acessorios.show', $item->id)}}"> Ver Objeto Vinculados</a></li>
                                                <li><a href="{{route('produtos.show', $item->id)}}">Detalhes</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#" data-toggle="modal" data-target="#modal-condenar">Condenar</a></li>

                                            </ul>
                                        </div>
                                        <form method="POST" action="{{route('removeFromContract')}}">
                                            @csrf
                                            <button
                                                name="product_id"
                                                value="{{$item->id}}"
                                                class="btn btn-sm btn-danger">
                                                    Remover
                                            </button>
                                        </form>
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
    </div>
  <!-- modal -->
  <div class="modal fade" id="modal-acessorios">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Adicionar ao Contrato</h4>
        </div>
        <!-- formulario -->
        {!! form_start($form) !!}
        <div class="modal-body">

            <div class="row">
                <div class="col-md-12">
                  {!! form_row($form->id_equipamento) !!}
                  {!! form_row($form->id_contract) !!}
                  {!! form_row($form->id_acessorio) !!}
                </div>
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          {!! form_row($form->submit) !!}
        </div>
        {!! form_end($form, $renderRest = false)!!}
        <!-- fim form -->
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<!-- end modal -->
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
<script>
      $(function(){
			$('.select2').select2();

		});



</script>

@include('sweetalert::alert')
@endpush

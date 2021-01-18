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
                <h3 class="box-title">Estoque Locação</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select name="localEstoque" id="localEstoque" class="col-md-12">
                                <option value="-1">-- Local de Estoque --</option>
                            </select>
                        </div>
                    </div>
                </div>
                @if(count($errors) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-error">
							<p>Desculpe! Não foi possível vincular o item ao contrato.</p>
							<ul>
								@foreach( $errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
                    </div>
                </div>                      

                @endif
                @if(Session()->has('success'))
                <div class="row">
                    <div class="col-md-12">
                         <div class="alert alert-success">
                            {{Session::get('success')}}
                         </div>   
                    </div>
                </div>

                @endif
                @if(Session()->has('fall'))
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-error">
                            {{Session::get('fall')}}
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="produtos" class="table table-bordered table-striped">
                                <thead>
                                    <th>COD.</th>
                                    <th>COD. Alternativo</th>
                                    <th>Nome Produto</th>
                                    <th>Unidade</th>
                                    <th>Tipo de Mercadoria</th>
                                    <th>Local de Estoque</th>
                                    <th>Nº Serie</th>
                                    <th>Ações</th>
                                    <th>fvenda</th>
                                </thead>
                                <tbody>
                                    @foreach($produtos as $p)                      
                                    <tr>
                                        <td>{{$p->CODP}}</td>
                                        <td>{{$p->APELIDO}}</td>
                                        <td>{{$p->NOME}}</td>
                                        <td>{{$p->dsUnidade}}</td>
                                        <td>{{$p->Tipo}}</td>
                                        <td>{{$p->dsLocal}}</td>
                                        <td>{{$p->numserie}}</td>
                                        <td>
                                            <button 
                                                type="button" 
                                                class="btn btn-info" 
                                                data-toggle="modal" 
                                                data-target="#modal-contrato">
                                                    ADD ao Contrato
                                                </button>
                                        </td>
                                        <td>{{$p->fVenda }}</td>
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
</div>

<!-- modal -->
<div class="modal fade" id="modal-contrato">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
              </div>
              <!-- formulario -->
              {!! form_start($form) !!}
              <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        {!! form_row($form->id_branch) !!}
                    </div>
                    <div class="col-md-6">
                        {!! form_row($form->id_contract) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        {!! form_row($form->codp) !!}
                    </div>

                    <div class="col-md-3">
                        {!! form_row($form->apelido) !!}
                        {!! form_row($form->nome) !!}
                    </div>
                    <div class="col-md-2">
                        {!! form_row($form->numSerie) !!}
                    </div>
                    <div class="col-md-3">
                        {!! form_row($form->tpobj) !!}
                    </div>
                    <div class="col-md-2">
                        {!! form_row($form->qtd) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        {!! form_row($form->dsUnidade) !!}
                    </div>
                    <div class="col-md-3">
                        {!! form_row($form->dsLocal) !!}
                    </div>
                    <div class="col-md-4">
                        {!! form_row($form->Tipo) !!}
                    </div>
                    <div class="col-md-3">
                        {!! form_row($form->valor) !!}
                        {!! form_row($form->fvenda) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! form_row($form->id_product) !!}
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
<script src="{{ URL::asset('js/locacao/datatables.js') }}"></script>

@include('sweetalert::alert')
@endpush

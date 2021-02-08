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
                <h3 class="box-title">Editar Produto</h3>
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
            {!! form_start($form)!!}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        {!! form_row($form->codp) !!}
                    </div>
                    <div class="col-md-3">
                        {!! form_row($form->apelido) !!}
                    </div>
                    <div class="col-md-6">
                        {!! form_row($form->nome) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        {!! form_row($form->numSerie) !!}
                    </div>
                    <div class="col-md-3">
                        {!! form_row($form->dsUnidade) !!}
                    </div>
                    <div class="col-md-2">
                        {!! form_row($form->valor)!!}
                    </div>
                    <div class="col-md-2">
                        {!! form_row($form->Tipo) !!}
                    </div>
                    <div class="col-md-2">
                        {!! form_row($form->tpobj) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {!! form_row($form->id_contract) !!}
                    </div>
                    <div class="col-md-6">
                        {!! form_row($form->id_branch) !!}
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! form_row($form->submit) !!}
                    </div>
                </div>
            </div>
            {!! form_row($form->qtd) !!}
            {!! form_row($form->dsLocal)!!}
            {!! form_row($form->fvenda)!!}
            {!! form_end($form, $renderRest = false) !!}
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


@include('sweetalert::alert')
@endpush

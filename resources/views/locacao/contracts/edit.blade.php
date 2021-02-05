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
                <h3 class="box-title">Contratos</h3>
            </div>
            <div class="box-body">
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
                {!! form_start($form) !!}
                <div class="row">
                    <div class="col-md-2">
                        {!! form_row($form->numberContract) !!}
                    </div>
                    <div class="col-md-3">
                        {!! form_row($form->id_branch) !!}
                    </div>
                    <div class="col-md-2">
                        {!! form_row($form->id_saleplans) !!}
                    </div>
                    <div class="col-md-2">
                        {!! form_row($form->price) !!}
                    </div>
                    <div class="col-md-3">
                        {!! form_row($form->manager)!!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! form_row($form->description) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        {!! form_row($form->dtemission) !!}
                    </div>
                    <div class="col-md-3">
                        {!! form_row($form->dtStart) !!}
                    </div>
                    <div class="col-md-3">
                        {!! form_row($form->dtEnd) !!}
                    </div>
                    <div class="col-md-3">
                        {!! form_row($form->dtbilling) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        {!! form_row($form->id_type) !!}
                    </div>
                    <div class="col-md-2">
                        {!! form_row($form->active) !!}
                    </div>
                    <div class="col-md-7">
                        {!! form_row($form->id_customers) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        {!! form_row($form->submit) !!}
                    </div>
                </div>
                {!! form_end($form, $renderRest = false)!!}
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

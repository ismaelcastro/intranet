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
                <div class="row">
                    <div class="col-md-12">
                        <button 
                            type="button" 
                            class="btn btn-info" 
                            data-toggle="modal" 
                            data-target="#modal-contrato">
                                Novo Contrato
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="contratos" class="table table-bordered table-striped">
                                <thead>
                                    <th>Nº Contrato</th>
                                    <th>Cliente</th>
                                    <th>Descricao</th>
                                    <th>Data Inicio</th>
                                    <th>Data Fim</th>
                                    <th>Ações</th>
                                </thead>
                            </table>
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
                <h4 class="modal-title">Novo Contrato</h4>
              </div>
              <!-- formulario -->
              {!! form_start($form) !!}
              <div class="modal-body">
                
                  <div class="row">
                      <div class="col-md-12">
                        {!! form_row($form->numeroContrato) !!}
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                        {!! form_row($form->descricao) !!}
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-3">
                          {!! form_row($form->dataEmissao) !!}
                      </div>
                      <div class="col-md-3">
                          {!! form_row($form->dataInicio) !!}
                      </div>
                      <div class="col-md-3">
                          {!! form_row($form->dataFinal) !!}
                      </div>
                      <div class="col-md-3">
                          {!! form_row($form->dataFaturamento) !!} 
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          {!! form_row($form->TipoContrato) !!}
                      </div>
                      <div class="col-md-6">
                          {!! form_row($form->ativo) !!}
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          {!! form_row($form->id_cliente) !!}
                      </div>
                      <div class="col-md-6">
                          {!! form_row($form->gestor) !!}
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        {!! form_row($form->id_planoVenda) !!}
                    </div>
                    
                    <div class="col-md-6">
                        {!! form_row($form->valor) !!}
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

        $(function(){
            table = $("#contratos").DataTable({
                //dom: 'lBfrtip',
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
                retrieve: true,
                destroy: true,
                processing:true,
                serverSide:false,
                ajax:{
                    'url' : '{{"contratos-locacao/datatables"}}'
                },
                columns: [
                    {data:'numeroContrato', name:'numeroContrato'},
                    {data:'cliente', name:'cliente'},
                    {data:'descricao', name:'descricao'},
                    {data:'dataInicio', name:'dataInicio'},
                    {data:'dataFinal', name:'datdataFinal'},
                    {data:'action', name:'action'}
                ],
            });
        })
      
</script>

@include('sweetalert::alert')
@endpush

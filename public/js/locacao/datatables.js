$(function(){
    $('.select2').select2();
});

$(function(){
table = $('#produtos').DataTable({
    "columns": [
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        {"visible":false},
    ]
});

table.column(5).data().unique().each(function(d, j){
    $('#localEstoque').append('<option value="'+d+'">'+d+'</option>');
})
});

$('#localEstoque').on('change', function(){
var val = $(this).val();
if(val != -1){
    table.column(5)
    .search(val ? '^'+$(this).val()+'$' : val, true, false)
    .draw();
}

});
$('.btn-info').on('click', function(e){
column = $.map(table.row($(this).parent().parent()).data(), function(item){
   return item;
});
objColumn = {
    'codp' : column[0],
    'apelido': column[1],
    'nome' : column[2],
    'unidade': column[3],
    'tipoMercadoria': column[4],
    'localEstoque': column[5],
    'ns': column[6],
    'fvenda':column[8]

}


modalFormItemToContract(objColumn);


})

function modalFormItemToContract(obj){
    $(".modal-title").html(obj.nome);
    $("#codp").val(obj.codp);
    $("#apelido").val(obj.apelido);
    $("#nome").val(obj.nome);
    $("#dsUnidade").val(obj.unidade);
    $("#dsLocal").val(obj.localEstoque);
    $("#Tipo").val(obj.tipoMercadoria);
    $("#numSerie").val(obj.ns);
    $("#fvenda").val(obj.fvenda);

}
$(document).ready(function(){

    table = $("#objetoscobertos").DataTable();


    $.contextMenu({
        selector:'.context-menu-one',
        callback: function(key, options){
            objColumn = seriealize($(this));
            //baseURL = window.location.origin+'/intranet/public/';

            if(key === 'edit'){
                window.location.href = /*baseURL+*/'/produtos/'+objColumn.id+'/edit';
            }else if(key === 'condenar'){
                modalFormItemToContract(objColumn);
                $('#modal-condenar').modal('show');
            }else{
                window.location.href = /*baseURL+*/'/produtos/'+objColumn.id
            }


        },
        items: {
            "edit": {name:'Editar', icon:'edit'},
            "condenar": {
                name:'Condenar',
                icon:'fa-minus-circle', },
            "detalhar" : {
                name:'Detalhes',
                icon:'fa-eye'
            }

        }
    });

    function seriealize(args){
        column = $.map(table.row(args).data(), function(item){
            return item;
        })
        objColumn = {
            'id':column[0],
            'codp' : column[1],
            'apelido': column[2],
            'nome' : column[3],
            'qtd': column[4],
            'ns': column[5]



        };

        return objColumn;
    }

    function modalFormItemToContract(obj){
        $(".modal-title").html(obj.nome +' Nº Serie: '+ obj.ns);
        $("[name='product_id']").val(obj.id);


    }
});

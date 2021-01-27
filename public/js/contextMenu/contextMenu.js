$(function(){
    $(function(){
        table = $("#objetoscobertos").DataTable();
    });

    $.contextMenu({
        selector:'.context-menu-one',
        callback: function(key, options){
            objColumn = seriealize($(this));

            if(key === 'edit'){
                window.location.href = 'produtos/'+objColumn.id+'/edit';
            }else if(key === 'condenar'){
                modalFormItemToContract(objColumn);
                $('#modal-condenar').modal('show');
            }


        },
        items: {
            "edit": {name:'Editar', icon:'edit'},
            "condenar": {
                name:'Condenar',
                icon:'fa-minus-circle', },
            "addContract" : {name: 'ADD ao Contrato', icon:'fa-plus-square'}

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
            'ns': column[5],
            'valor': column[6],
            'contrato': column[7],


        };

        return objColumn;
    }

    function modalFormItemToContract(obj){
        $(".modal-title").html(obj.nome +' Nº Serie: '+ obj.ns);


    }
});

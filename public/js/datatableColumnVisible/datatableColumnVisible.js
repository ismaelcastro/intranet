
   function columnListVisible(){ 
    $(".collunm-list").empty();
    $("table thead th").each(function(index){
        
        var visible = table.column(index).visible() === true ? "checked" : "";
        var html = '<li><a href="#"><label><input class="toggle-vis" '+visible+' data-column='+index+' type="checkbox" class="flat-red">'+$(this).text()+'</label></a></li>';
        $(".collunm-list").append(html);
        });
    
    $(".collunm-list li .toggle-vis").on('click', function(e){
    
    
        var column = table.column($(this).attr('data-column'));
        column.visible( !column.visible() );
    
    });
}
    


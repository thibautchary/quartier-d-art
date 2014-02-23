$(document).ready(function(){
    $("div.formulaireGlob").each(function(i){
        $(this).find("div.hidden").attr("id","hidden"+(i+1)).hide();
        var deplie = false;

        $(this).find("div.clique").attr("id","clique"+(i+1)).click(function(){
            if(deplie==false){
            $("#hidden"+(i+1)).show("fast");
            deplie=true;
            }
        else{
            $("#hidden"+(i+1)).hide("fast");
            deplie= false;
        }
        })
        
        
        var mouse_is_inside = false;
        
        $(this).hover(function(){
            mouse_is_inside=true;
        }, function(){
            mouse_is_inside = false;
        });
        
        $("body").mouseup(function(){ 
        if(! mouse_is_inside ) $('#hidden'+(i+1)).hide("fast");
        });
    });
    
    
    
    
    
        $("div.afficherMasquer").each(function(i){
        $(this).find("div.hidden").attr("id","hidden"+(i+1)).hide();
        var deplie = false;

        $(this).find("div.clique").attr("id","clique"+(i+1)).click(function(){
            if(deplie==false){
            $("#hidden"+(i+1)).show("fast");
            deplie=true;
            }
        else{
            $("#hidden"+(i+1)).hide("fast");
            deplie= false;
        }
        })
        
    });
    
    
    $("input.datepicker").each(function(i){
        $(this).attr("id","datepicker"+(i+1));
        $( "#datepicker" +(i+1)).datepicker();

    });
    
    $(function() {
        $("#gallery a").lightBox();
    });
  
    
});

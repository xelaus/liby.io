$( document ).ready(function() {
    
    $( "select" )
    .change(function () {
    var str = "";
    $( "select option:selected" ).each(function() {
      str += $( this ).text() + " ";
    });
    $('#spesificsearch').attr("placeholder",str);
                    $("#spesificsearch").focus();
    })
    .change();
    
    
    $( "#gensearch" ).focus(function() {
         var field= document.getElementById('spesificsearch');
        field.value= '';
    });
    
    $( "#spesificsearch" ).focus(function() {
         var field= document.getElementById('gensearch');
        field.value= '';
    });
    
        
    $('#delete_button').on('click',function(){
          
		$('#optionquestion_delete').css({"position": "relative", "visibility": "visible"});
        $('#bookoptions').css({"position": "fixed", "visibility": "hidden"});
          
    });
            
    
    $('#answer_no').on('click',function(){
          
		$('#optionquestion_delete').css({"position": "fixed", "visibility": "hidden"});
        $('#bookoptions').css({"position": "relative", "visibility": "visible"});
      
    });
    
    $('#lend_button').on('click',function(){
          
		$('#optionquestion_lend').css({"position": "relative", "visibility": "visible"});
        $('#bookoptions').css({"position": "fixed", "visibility": "hidden"});
          
    });
    
    $('#cancel_lend').on('click',function(){
          
        //alert("asdas");
		$('#optionquestion_lend').css({"position": "fixed", "visibility": "hidden"});
        $('#bookoptions').css({"position": "relative", "visibility": "visible"});
      
    });
    
    $( "#unlend_button" ).click(function() {
        $( "#btn_unlend" ).click();
    });
    
    
    
    $('#bookmain .book_info_wrapper #edit_logo').on('click',function(){
          
		$(this).parent().next().css({"position": "relative", "visibility": "visible"});
                                                               
        $(this).parent().next().children().children().children('#book_name_input').focus();
      
    });
    
   $('#down').on('click',function(){
       if($('#tabs_wrapper').css('height') == "0px"){
            $('#tabs_wrapper').css({"height": "280px", "visibility": "visible"});
            $('#searcharea').animate({"height": "380px"},300);
            $(this).css({"transform": "rotate(180deg)"});
           //alert($(window).innerWidth());
       }
       else{
            $('#tabs_wrapper').css({"height": "0px", "visibility": "hidden"});
            $('#searcharea').animate({"height": "100px"},300);
            $(this).css({"transform": "rotate(360deg)"});
       }

       
    });
    
    
        $('#tabsul').on('click',function(){
            if($(window).innerWidth() > 766 ){
            }
            else{
                $('#tabs_wrapper').css({"height": "280px", "visibility": "visible"});
                $('#searcharea').animate({"height": "380px"},300);
                $('#down').css({"transform": "rotate(180deg)"});  
            }
        });
    
    
    
    window.onresize = function(event) {
        if($(window).innerWidth() > 766 ){
             $('#tabs_wrapper').css({"height": "90%", "visibility": "visible"});
        }
        else{
             //$('#tabs_wrapper').css({"height": "0px", "visibility": "hidden"});
        }
    };
  
    
    
    //Outside click
    $('body').click(function(){
        $('#bookmain .book_info_wrapper .book_info_edit').css({"position": "fixed", "visibility": "hidden"});
        
        $('#optionquestion_delete').css({"position": "fixed", "visibility": "hidden"});
        $('#bookoptions').css({"position": "relative", "visibility": "visible"});
        
        $('#optionquestion_lend').css({"position": "fixed", "visibility": "hidden"});
        $('#bookoptions').css({"position": "relative", "visibility": "visible"});
        
        
        
    });
    
    $('#bookmain .book_info_wrapper .book_info_edit').click(function(e){
        e.stopPropagation();   
    });
    
    $('#bookmain .book_info_wrapper #edit_logo').click(function(e){
        e.stopPropagation();  
    });
    

    $('#bookoptions_wrapper').click(function(e){
        e.stopPropagation();  
   });
    

});
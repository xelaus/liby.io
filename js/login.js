$( document ).ready(function() {   

    $("#signupinput").focus(function() {
         var field= document.getElementById("logininput");
        field.value= '';
        var field= document.getElementById("logininputpass");
        field.value= '';
    });
    
    $("#signupinputpass").focus(function() {
         var field= document.getElementById("logininput");
        field.value= '';
        var field= document.getElementById("logininputpass");
        field.value= '';
    });
    
    $("#signupinputpassretry").focus(function() {
         var field= document.getElementById("logininput");
        field.value= '';
        var field= document.getElementById("logininputpass");
        field.value= '';
    });
    
    $("#logininput").focus(function() {
         var field= document.getElementById("signupinput");
         field.value= '';
        var field= document.getElementById("signupinputpass");
         field.value= '';
        var field= document.getElementById("signupinputpassretry");
         field.value= '';
    });
    
    $("#logininputpass").focus(function() {
         var field= document.getElementById("signupinput");
         field.value= '';
        var field= document.getElementById("signupinputpass");
         field.value= '';
        var field= document.getElementById("signupinputpassretry");
         field.value= '';
    });
    
    $('#btn-signup').on('click',function(){
          
		$('#loading').css({"visibility": "visible"});
      
    });
    
});
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
                     
                   
       

   $(".modal").dialog({
        modal: true,
        autoOpen: false,
        width :"60%"
    }); 
    
$(".responder").click(function(){
   
    $(".modal").dialog('open');
})  

});
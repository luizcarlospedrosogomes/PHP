// JavaScript Document
//pg usuario editar lugar.
	

        
    $(document).ready(function() {
//#alert("Teste");
////modal tratar exclusao de fotos
    	//modal padrao     
    	$(".modal").dialog({
    	        modal: true,
    	        autoOpen: false,
    	        width: "45%"
    	   }); 
    	
    	
    	$('.login').dialog({
    			modal:true,
    			autoOpen: true,
    	});
    	
      	
    	//$('.editar').click(function() {
			//$( ".modal" ).dialog('open');
		//});
    	
    	//botao categoria
    	$('#bt_cadCat').click(function(){
    		$('#cadCat').dialog('open');
    	});
    	
    	//botao produto
    	$('#bt_cadProd').click(function(){
    		$('#cadProd').dialog('open');
    				
    	});
    	
    	//pendencias
    	$('#bt_pendcdam').click(function(){
    		$('#pendcdam').dialog('open').dialog({
    							width:"20%"
    		});
    	});
    	
    	$('#bt_pendfl').click(function(){
    		$('#pendfl').dialog('open').dialog({
    							width:"20%"
    		});
    	});
        $('#geraOS').click(function(){
    		$('#geraOSForm').dialog('open').dialog({
    							width:"20%"
    		});
    	});
    	$('#cadastraForn').click(function(){
    		$('#cadFornForm').dialog('open').dialog({
    							width:"20%"
    		});
    	});
    	$('#cadastraCat').click(function(){
    		$('#cadCatForm').dialog('open').dialog({
    							width:"20%"
    		});
    	});
    	$('#cadastraEquip').click(function(){
    		$('#cadEquipForm').dialog('open').dialog({
    							width:"20%"
    		});
        });
         $('#cadastraFilial').click(function(){
    		$('#cadFilialForm').dialog('open').dialog({
    							width:"20%"
    		});
    	});
        
    	
    	//alert($('.status').text());
		
/*
 
    
   //logout 
    $("#modallogout").click(function(){
       $(".modal").load(urlLogout);
       $(".modal").dialog('open');
       return false;
    }); 

*/


    
});
 

    





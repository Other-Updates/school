// JavaScript Document
function isNumeric(evt)
{
	evt = (evt) ? evt : event;
	var characterCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
	if ((characterCode < 48 || characterCode > 57)&&(characterCode != 43) && (characterCode != 45)&& (characterCode != 8)&& (characterCode != 46) && (characterCode != 39) && (characterCode != 37) && (characterCode != 9) && (characterCode!=38)) 
	{
		
			return false;
	}
	return true;
}
function ValidateSpecialChar(evt) 
{
	evt = (evt) ? evt : event;
	var characterCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
	//alert(evt.keyCode);
	if (characterCode > 32 && (characterCode < 65 || characterCode > 90) &&	(characterCode < 97 || characterCode > 122) && (characterCode < 48 || characterCode > 57) && (characterCode != 46) && (characterCode != 45) && (characterCode != 95) && (characterCode!=38) && (characterCode!=39)&& (characterCode!=37)) 
	{
	
		return false;
	}
	return true;
 }
 function ValidateFabricName(evt) 
{
	evt = (evt) ? evt : event;
	var characterCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
	if (characterCode > 32 && (characterCode < 65 || characterCode > 90) &&	(characterCode < 97 || characterCode > 122) && (characterCode < 48 || characterCode > 57) && (characterCode != 46) &&(characterCode !=37) && (characterCode!=38)) 
	{
	
		return false;
	}
	return true;
 }
function validateAlphabets(evt)
{
		evt = (evt) ? evt : event;
		
		var characterCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : ((evt.which) ? evt.which : 0));
	
	if (characterCode > 32 && (characterCode < 65 || characterCode > 90) && 
(characterCode < 97 || characterCode > 122) && (characterCode != 46) && (characterCode != 8) && (characterCode != 39) && (characterCode != 37) && (characterCode!=38)) {

				return false;
			}
			return true;
 }
 
 $('.float_val,.text_int,.get_model').live('keypress',function(eve) {
  if ((eve.which != 46 || $(this).val().indexOf('.') != -1) && (eve.which < 48 || eve.which > 57) || (eve.which == 46 && $(this).caret().start == 0) ) {
  	if(eve.which != 8)
    eve.preventDefault();
  }
     
// this part is when left part of number is deleted and leaves a . in the leftmost position. For example, 33.25, then 33 is deleted
 $('.filterme').keyup(function(eve) {
  if($(this).val().indexOf('.') == 0) {    $(this).val($(this).val().substring(1));
  }
 });
});

$(".int_val,.text_total").live('keypress',function(event){
  	var characterCode = (event.charCode) ? event.charCode : event.which ;
		var browser;
		if($.browser.mozilla)
		{
      		if((characterCode > 47 && characterCode < 58) || characterCode==8 || event.keyCode==39  || event.keyCode==37 || characterCode==97 || characterCode==118) 
		  {
		   
			return true;
		  }
		  return false;
		}
		if($.browser.chrome)
		{
     		if (event.keyCode != 8 && event.keyCode != 0 && (event.keyCode < 48 || event.keyCode > 57)) {
        //display error message
        
               return false;
   			 }
		}
			 
	
 });
 $('form').live('submit',function(){
		var result=0;
		$(this).find('.mandatory').each(function() 
		{
    		if($(this).val()=='' || $(this).val()==null || $(this).val().trim().length==0 || $(this).val()=='.' || $(this).val()==',')
    		{		
				$(this).css('border','1px solid red');	
				result=1;
   			} 
			else{
				$(this).css('border','1px solid #CCCCCC');
				//$(this).tooltip('hide');
			}	
			
		});	
		if(result==1)
		   return false; 
		 else
		   return true; 
	});
	$('.mandatory').live('blur',function() 
	{
		if($(this).val()=='' || $(this).val()==null || $(this).val().trim().length==0 || $(this).val()=='.' || $(this).val()==',')
		{		
			$(this).css('border','1px solid red');	
			result=1;
		} 
		else
			$(this).css('border','1px solid #CCCCCC');	
	});	
	
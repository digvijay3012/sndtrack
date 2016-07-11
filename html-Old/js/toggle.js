$('#toggle-message').click(function()
{
	var value=$('#toggle-message').attr('value');

	$('#message').animate({width:'toggle'}); 
	
	
	/*if($("#message").hasClass("custom_deep"))
	{
		$("#message").removeClass("custom_deep");
	}else{
		
		$('#message').addClass("custom_deep");
		$('.custom_deep').css("width","400px");
		}
	*/
});


$("#username").on("blur",function(){
	if($("#username").val() != '')
		$("#username-error").html('');	
});

$("#password").on("blur",function(){
	if($("#password").val() != '')
		$("#password-error").html('');	
});

$("#login").on("click",function()
{	
	var flag = 0;
	if($("#username").val()== '')
	{
		$("#username-error").html('This feild is mandatory');
		flag = 1;
	}
	else
		$("#username-error").html('');
	if($("#password").val()== '')
	{
		$("#password-error").html('This feild is mandatory');
		flag = 1;
	}
	else
		$("#password-error").html('');
	
	if(flag == 1)
		return false;
	else
		return true;

});
$("#confPass, #password").on("blur",function()
{
	if($("#confPass").val() != $("#password").val())
	{
		$("#confPass-error").html('Password does not match');
	}
	else
	{
		$("#confPass-error").html('');
	}
});

$(".text").on("keypress",function(e)
{
	if((!((e.charCode >= 65 && e.charCode <= 90) || (e.charCode >= 97 && e.charCode <= 122) || e.charCode == 0)))
	{
		return false;
	}
	else
	{
		return true;
	}
});


$(".number").on("keypress",function(e)
{
	//console.log(e.charCode);
	if((!((e.charCode >= 48 && e.charCode <= 57) || e.charCode == 0)))
	{
		return false;
	}
	else
	{
		return true;
	}
});


$(".number").on("keypress",function(e) 
{
	var length = $(this).val().length+1;
	var id= $(this).attr("id");
	var condition = 0;
	if(id == "zip")
		condition = 5;
	else
		condition = 10;
	if(length > condition )
	{
		$("#"+id+"-error").html('Only '+condition+' digits are allowed');
		if(e.charCode != 0)
			return false;
	}
	else
		$("#"+id+"-error").html('');
});


$(".number").on("blur",function(e) 
{
	var length = $(this).val().length-1;
	var id= $(this).attr("id");
	var id= $(this).attr("id");
	var condition = 0;
	if(id == "zip")
		condition = 5;
	else
		condition = 10;
	
	if(length < condition)
	{
		$("#"+id+"-error").html('');
	}
});


$("#register").on("click",function()
{	

	if($("#username").val()== '')
	{
		$("#username-error").html('This feild is mandatory');
		return false;
	}
	else
		$("#username-error").html('');
	if($("#password").val()== '')
	{
		$("#password-error").html('This feild is mandatory');
		return false;
	}
	else
		$("#password-error").html('');
	if($("#confPass").val()== '')
	{
		$("#confPass-error").html('This feild is mandatory');
		return false;
	}
	else
	{
			$("#confPass-error").html('');
	}
		
	if($("#name").val()== '')
	{
		$("#name-error").html('This feild is mandatory');
		return false;
	}
	else
		$("#name-error").html('');	
	if($("#state").val()== '')
	{
		$("#state-error").html('This feild is mandatory');
		return false;
	}
	else
		$("#state-error").html('');	
	if($("#city").val()== '')
	{
		$("#city-error").html('This feild is mandatory');
		return false;
	}
	else
		$("#city-error").html('');
	if($("#zip").val()== '')
	{
		$("#zip-error").html('This feild is mandatory');
		return false;
	}
	else
		$("#zip-error").html('');		
	if($("#phone").val()== '')
	{
		$("#phone-error").html('This feild is mandatory');
		return false;
	}
	else
		$("#phone-error").html('');	
	if($("#confPass").val() != $("#password").val())
	{
		$("#confPass-error").html('Password does not match');
		return false;
	}
	else
	{
		$("#confPass-error").html('');
	}	
});
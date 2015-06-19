var flag = 0;
/*$("#year").on("blur",function()
{
	if($("#year").val().length < 4)
	{
		$("#year-error").html("Invalid year");
		flag = 1;
	}
	else
	{
		$("#year-error").html("");
		flag = 0;
	}
});

$("#pDate").on("blur",function()
{
	var num = parseInt($("#pDate").val())
	if(num <= 0 || num > 31)
	{
		$("#pDate-error").html("Invalid date");
		flag = 1;
	}
	else
	{
		$("#pDate-error").html("");
		flag = 0;
	}
});

$("#month").on("blur",function()
{
	var num = 	parseInt($("#month").val());

	if(num <= 0 || num > 12)
	{
		$("#month-error").html("Invalid month");
		flag = 1;
	}
	else
	{
		$("#month-error").html("");
		flag = 0;
	}
});*/


$("body").delegate(".text","keypress",function(e)
{
	if(!((e.charCode >= 65 && e.charCode <= 90) || (e.charCode >= 97 && e.charCode <= 122) || e.charCode == 0 || e.charCode == 32))
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

$("#addBook").on("click",function()
{	
	if($("#title").val()== '')
	{
		$("#title-error").html('Book title is mandatory');
		flag = 1;
	}
	else
		$("#title-error").html('');
	if($("#author").val()== '')
	{
		$("#author-error").html('Author name is mandatory');
		flag = 1;
	}
	else
		$("#author-error").html('');
	if($("#isbn").val()== '')
	{
		$("#isbn-error").html('ISBN is mandatory');
		flag = 1;
	}
	else
		$("#isbn-error").html('');	
	if($("#pDate").val()== '' || $("#month").val()== '' || $("#year").val()== '')
	{
		$("#pDate-error").html('Publication date is mandatory');
		flag = 1;
	}
	else
	{
		if(flag != 1)
			$("#pDate-error").html('');		
	}
		
	if($("#pId").val()== '')
	{
		$("#pId-error").html('Publication ID is mandatory');
		flag = 1;
	}
	else
		$("#pId-error").html('');
	
	
	if($("#phone").val()== '')
	{
		$("#phone-error").html('This feild is mandatory');
		flag = 1;
	}
	else
		$("#phone-error").html('');	
	if(flag == 1)
		return false;
	else
		return true;

});

$("body").delegate(".text", "keypress", function(e)
{
	if((!((e.charCode >= 65 && e.charCode <= 90) || (e.charCode >= 97 && e.charCode <= 122) || e.charCode == 0 || e.charCode == 32)))
	{
		return false;
	}
	else
	{
		return true;
	}
});

$("body").delegate(".number", "keypress", function(e)
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

$("#search-form").delegate("#searchButton", "click", function(e)
{
	if($("#searchInput").val() == '')
		return false;
	else
		$("#jumbo").show();
});



$(document).ready( function()
{
	if($("table").length == 0)
		$("#jumbo").hide();
	else
		$("#jumbo").show();
});


$("#search-form").delegate("input[name=BRradio]","change",function()
{
	var val = $(this).val();
	if(val == "borrow")
	{
		$("input[name=borrowRadio]:radio").attr("disabled",false);
		$("input[name=reserveRadio]:radio").attr("disabled",true);
	}
	else
	{
		$("input[name=borrowRadio]:radio").attr("disabled",true);
		$("input[name=reserveRadio]:radio").attr("disabled",false);
	}
	
});

$("body").delegate("input[name=borrowRadio]:radio", "change", function()
{
	var val = $(this).val();
	$("#copyAndBookID").val(val);
});

$("body").delegate("input[name=reserveRadio]:radio", "change", function()
{
	var val = $(this).val();
	$("#copyAndBookID").val(val);
});


$("input[name=optradio]").on("change",function ()
{
	var val = $(this).val();
	$("#searchInput").val('');
	if(val != 'Book_ID')
	{
	
		$("#searchInput").removeClass("number").addClass("text");
	}
	else
	{
		$("#searchInput").removeClass("text").addClass("number");
	}
	
});
// JavaScript Document

$("body").delegate("input[name=returnRadio]:radio", "change", function()
{
	$("#return-form").show('puff');
	var val = $(this).val();
	$("#details").val(val);
});

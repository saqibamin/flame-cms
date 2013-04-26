function submitEditMenuForm()
{
	var ref = document.getElementsByName('amf');
	if(validatemenu(ref[0]))
	{
		ref[0].submit();
	}
	else return false;
}
function submitEditPageForm()
{
	var ref = document.getElementsByName('apf');
	if(validatepage(ref[0]))
	{
		ref[0].submit();
	}
	else return false;
}
function validatepage(f)
{
	if(f.ptitle.value=="")
	{
		alert("You Forgot to Enter a Page Title");
		f.ptitle.focus();
		return false;
	}
	if(f.linktitle.value=="")
	{
		alert("You Forgot to Enter a Link Title");
		f.linktitle.focus();
		return false;
	}
	
	else
		return true;
	
}
function validateConfirmBox() {
	
	var ref = document.getElementsByName("confirm");
	
	if(ref[0].checked)
	{
		return true;
	}
	else
	{
		alert("You must check the verification box");
		ref[0].focus();
		return false;
	}
}
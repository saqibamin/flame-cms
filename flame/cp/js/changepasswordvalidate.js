function validateCP(f)
{
	if(f.new_pass.value=="")
	{
		alert("New Password is empty");
		f.new_pass.focus();
		return false;
	}
	if(f.new_pass.value.length < 3)
	{
		alert("New Password is too short");
		f.new_pass.focus();
		return false;
	}
	
	if(f.new_pass.value != f.c_new_pass.value)
	{
		alert("Passwords do not match");
		f.c_new_pass.focus();
		return false;
	}
	
	else
		return true;
	
}
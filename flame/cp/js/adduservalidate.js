function validateEmail(email) 
{ 
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

function validateuserform(f)
{
	if(f.user_id.value=="")
	{
		alert("You Forgot to Enter a User ID");
		f.user_id.focus();
		return false;
	}
	if(f.user_id.value.length < 3)
	{
		alert("User ID is too short . . .");
		f.user_id.focus();
		return false;
	}
	
	if(f.user_email.value=="")
	{
		alert("You Forgot to Enter User Email");
		f.user_email.focus();
		return false;
	}
	
	if(!validateEmail(f.user_email.value))
	{
		alert("Please enter a valid email address");
		f.user_email.focus();
		return false;
	}
	
	if(f.user_pass.value == '')
	{
		alert("You did not write a password");
		f.user_pass.focus();
		return false;
	}
	
	if(f.user_pass.value.length < 3)
	{
		alert("Password must be at least three characters long");
		f.user_pass.focus();
		return false;
	}
	
	else
		return true;
	
}
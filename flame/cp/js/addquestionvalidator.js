function validate_add_question_form(addQForm)
{
	if(addQForm.qText.value=="")
	{
		alert("You Didn't Enter a Question");
		addQForm.qText.focus();
		return false;
	}
	if(addQForm.opt1.value=="")
	{
		alert("Option 1 Must Not be Empty");
		addQForm.opt1.focus();
		return false;
	}
	if(addQForm.opt2.value=="")
	{
		alert("Option 2 Must Not be Empty");
		addQForm.opt2.focus();
		return false;
	}
	else
		return true;
	
}
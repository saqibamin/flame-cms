function validate_edit_question_form(editQForm)
{
	if(editQForm.qText.value=="")
	{
		alert("You Didn't Enter a Question");
		editQForm.qText.focus();
		return false;
	}
	if(editQForm.opt1.value=="")
	{
		alert("Option 1 Must Not be Empty");
		editQForm.opt1.focus();
		return false;
	}
	if(editQForm.opt2.value=="")
	{
		alert("Option 2 Must Not be Empty");
		editQForm.opt2.focus();
		return false;
	}
	else
		return true;
	
}
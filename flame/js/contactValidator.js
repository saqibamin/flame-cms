/*
	 This page contains code for validation of the 
	 contact us form
	 
	 The top four functions here are to provide
	 for more enhanced interactivity on the form
	 they are used for highlighting of the fields
	 green borders are added to the fields 
	 when they get the focus
	 and red borders are added when the field's data
	 is found to be incorrect or missing
 */

// This function adds green borders to the field 'N'
function addBorders(N)
{
	$(N).addClass("currentField");
}

//This function removes the green borders from the field 'N'
function removeBorders(N)
{
	$(N).removeClass("currentField");
}

//This function adds red borders indicating error in an input field 'e'
function addRedBorders(e)
{
	// This function 
	$(e).addClass("redBorders");
}

// This function removes red borders from an input field 'e'
// Where there was an error previously
function removeRedBorders(e)
{
	$(e).removeClass("redBorders");
}

// This function return true if the string argument
// provided to it is a valid email address
function validateEmail(email) 
{ 
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

// This function validates the contact form
function validateContactForm(frm)
{
	// validate email address
	if(frm.uemail.value == "")
	{
		alert("Email Address can not be empty");
		addRedBorders(frm.uemail);
		frm.uemail.focus();
		return false;
	}
	else if(!validateEmail(frm.uemail.value))
	{
		alert("Email Address is not valid");
		frm.uemail.focus();
		addRedBorders(frm.uemail);
		return false;
	}
	
	// email address validation successfull
	// validate the subject of the form
	else if(frm.msgSub.value == "")
	{
		alert("Subject cannot be empy");
		frm.msgSub.focus();
		addRedBorders(frm.msgSub);
		removeRedBorders(frm.uemail);
		return false;
	}
	else if(frm.msgSub.value.length < 5)
	{
		alert("OOPS\n\rSubject is too short . . . ");
		frm.msgSub.focus();
		addRedBorders(frm.msgSub);
		return false;
	}
	
	// validate the message
	else if(frm.message.value.trim() == "")
	{
		alert("Message cannot be empty");
		frm.message.focus();
		addRedBorders(frm.message);
		removeRedBorders(frm.msgSub);
		return false;
	}
	else if(frm.message.value.length < 10)
	{
		alert("Message is just too short!\n\r Please write more . . .");
		frm.message.focus();
		addRedBorders(frm.message);
		return false;
	}
	// message validation complete
	// validate captcha field
	else if(frm.captcha.value == '')
	{
		alert("Your must write the security code");
		frm.captcha.focus();
		addRedBorders(frm.captcha);
		removeRedBorders(frm.message);
		return false;
	}
	
	
	// all data validated
	else
		return true;
}
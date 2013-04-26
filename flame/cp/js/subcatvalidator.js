function validatepage(f)
{
	if(f.subcatname.value=="")
	{
		alert("Invalid SubCategory Name");
		f.subcatname.focus();
		return false;
	}
	else
	if((f.subcatvalue.value==0) || (f.subcatvalue.value==""))
	{
		alert("Invalid SubCategory Value");
		f.subcatvalue.focus();
		return false;
	}
	else
	if((f.questionstrength.value==0) || (f.questionstrength.value==""))
	{
		alert("Invalid Question Strength");
		f.questionstrength.focus();
		return false;
	}
	else
	if((f.qsvalue.value==0) || (f.qsvalue.value=="") || (f.qsvalue.value<0))
	{
		alert("Invalid Question Strength Value");
		f.qsvalue.focus();
		return false;
	}
	else
	if((f.month.value==0) || (f.month.value=="") || (f.month.value>60))
	{
		alert("Invalid Month");
		f.month.focus();
		return false;
	}
	else
	if((f.monthvalue.value==0) || (f.monthvalue.value=="") || (f.monthvalue.value<0))
	{
		alert("Invalid Month Value");
		f.monthvalue.focus();
		return false;
	}
	else
	if((f.expanse.value==0) || (f.expanse.value=="") || (f.expanse.value<0))
	{
		alert("Invalid Expanse");
		f.expanse.focus();
		return false;
	}
	else
	if((f.expansevalue.value==0) || (f.expansevalue.value=="") || (f.expansevalue.value<0))
	{
		alert("Invalid Expanse Value");
		f.expansevalue.focus();
		return false;
	}
	else
		return true;
	
}
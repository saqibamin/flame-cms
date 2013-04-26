function validatemenu(f)
{
	if(f.menu_name.value=="")
	{
		alert("You Forgot to Enter a Menu Name");
		f.menu_name.focus();
		return false;
	}
	if(f.menu_name.value.length < 3)
	{
		alert("Menu Name is too short . . .");
		f.menu_name.focus();
		return false;
	}
	
	else
		return true;
	
}
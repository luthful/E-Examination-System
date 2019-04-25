function login_validate()
{
	if(document.forms["login_form"]["reg_no"].value.length==0)
	{
		alert("Please enter registration no");
		document.forms["login_form"]["reg_no"].focus();
		return false;
	}
	if(document.forms["login_form"]["password"].value.length==0)
	{
		alert("Password can't be empty");
		document.forms["login_form"]["password"].focus();
		return false;
	}
	return true;
}
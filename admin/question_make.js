function validate()
{
	if (trimAll(document.forms["reg_form"]["std_name"].value).length==0)
	{
		alert("Name cannot be empty");
		document.forms["reg_form"]["std_name"].focus();
		return false;
	}
}
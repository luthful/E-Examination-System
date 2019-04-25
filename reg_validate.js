function validate()
{
	
	if (trimAll(document.forms["reg_form"]["std_name"].value).length==0)
	{
		alert("Name cannot be empty");
		document.forms["reg_form"]["std_name"].focus();
		return false;
	}
	if(document.forms["reg_form"]["reg_no"].value.length!=10)
	{
		alert("Invalid Registration no");
		document.forms["reg_form"]["reg_no"].value="";
		document.forms["reg_form"]["reg_no"].focus();
		return false;
	}
	if (trimAll(document.forms["reg_form"]["password"].value).length==0)
	{
		alert("Please enter a password");
		document.forms["reg_form"]["password"].focus();
		return false;
	}
	if((document.forms["reg_form"]["std_email"].value==null)|| (document.forms["reg_form"]["std_email"].value==""))
	{
		alert("Please enter your Email");
		document.forms["reg_form"]["std_email"].focus();
		return false;
	}
	if(email_check(document.forms["reg_form"]["std_email"].value)==false)
	{
		alert("Invalid email id");
		document.forms["reg_form"]["std_email"].focus();
		return false;
	}
	if (trimAll(document.forms["reg_form"]["department"].value).length==0)
	{
		alert("Department cannot be empty");
		document.forms["reg_form"]["department"].focus();
		return false;
	}
	if (trimAll(document.forms["reg_form"]["semester"].value).length==0)
	{
		alert("Semester cannot be empty");
		document.forms["reg_form"]["semester"].focus();
		return false;
	}
	if (trimAll(document.forms["reg_form"]["session"].value).length==0)
	{
		alert("Session cannot be empty");
		document.forms["reg_form"]["session"].focus();
		return false;
	}
	return true;
}
function email_check(str)
{
        var at="@";
		var dot=".";
		var lat=str.indexOf(at);
		var lstr=str.length;
		var ldot=str.indexOf(dot);
		if (str.indexOf(at)==-1){
		alert("Invalid E-mail ID");
		return false;
		}
		
		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		alert("Invalid E-mail ID");
		return false;
		}
		
		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		alert("Invalid E-mail ID");
		return false;
		}
		
		if (str.indexOf(at,(lat+1))!=-1){
		alert("Invalid E-mail ID");
		return false;
		}
		
		if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		alert("Invalid E-mail ID");
		return false;
		}
		
		if (str.indexOf(dot,(lat+2))==-1){
		alert("Invalid E-mail ID");
		return false;
		}
		
		if (str.indexOf(" ")!=-1){
		alert("Invalid E-mail ID");
		return false;
		}
		
		return true;
}
function trimAll(sString)
{
   while (sString.substring(0,1) == ' ')
{
sString = sString.substring(1, sString.length);
}
while (sString.substring(sString.length-1, sString.length) == ' ')
{
sString = sString.substring(0,sString.length-1);
}
return sString;
} 
function test()
{
	alert("Entered in the validate");
}
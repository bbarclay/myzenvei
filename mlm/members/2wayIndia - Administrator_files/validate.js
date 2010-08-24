function CheckValidation(objValue,strError)
{
   if(eval(objValue.value.length) == 0) 
   { 
      if(!strError || strError.length ==0) 
      { 
        strError =  "Required Field"; 
      } 
      alert(strError); 
	   objValue.focus();
      return false; 
   }
   return true;
}


function alpha(str)
{
//alert(str.keyCode);
	if(str.keyCode == 32) return true;
	if(str.keyCode > 31 && str.keyCode < 65) return false;
	if(str.keyCode > 90 && str.keyCode < 97 ) return false;
	if(str.keyCode > 122 && str.keyCode <127) return false; 
}
function checkemail(str)
{
//alert(str.keyCode);
	if(str.keyCode == 95) return true;
	if(str.keyCode > 47 && str.keyCode < 58) return true;
	if(str.keyCode > 31 && str.keyCode < 46 ) return false;
	if(str.keyCode  >46 && str.keyCode	< 64) return false;
	if(str.keyCode > 90 && str.keyCode < 97) return false;
	if(str.keyCode > 122 && str.keyCode <127) return false; 
}
function alphanum(str)
{
	if(str.keyCode == 32) return true;
	if(str.keyCode > 31 && str.keyCode < 48) return false;
	if(str.keyCode > 90 && str.keyCode < 97) return false;
	if(str.keyCode > 122 && str.keyCode <127) return false; 
}
function num(str)
{
if (str.keyCode > 31 && str.keyCode < 48) return false;
if(str.keyCode > 58 && str.keyCode < 127) return false;
}

function num_float(str)
{
//alert(str.keyCode);
//if(str.keycode == 44) return true;
if (str.keyCode > 31 && str.keyCode < 46) return true;
if(str.keyCode > 58 && str.keyCode < 127) return false;

}
function num_size(str)
{
//alert(str.keyCode);
//if(str.keycode == 44) return true;
if (str.keyCode > 31 && str.keyCode < 46) return true;
if(str.keyCode > 58 && str.keyCode < 127) return false;

}


function checkmail(email)
{
// a very simple email validation checking. 
/* you can add more complex email checking if it helps */
    if(email.length <= 0)
	{
	  return true;
	}
    var splitted = email.match("^(.+)@(.+)$");
    if(splitted == null) return false;
    if(splitted[1] != null )
    {
      var regexp_user=/^\"?[\w-_\.]*\"?$/;
      if(splitted[1].match(regexp_user) == null) return false;
    }
    if(splitted[2] != null)
    {
      var regexp_domain=/^[\w-\.]*\.[A-Za-z]{2,4}$/;
      if(splitted[2].match(regexp_domain) == null) 
      {
	    var regexp_ip =/^\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\]$/;
	    if(splitted[2].match(regexp_ip) == null) return false;
      }// if
      return true;
    }
return false; 
}
function validateemail(o)
{
	var strError;
	email=o.value;
			   if(!checkmail(email)) 
               { 
                 if(!strError || strError.length ==0) 
                 { 
                    strError ="Enter valid Email address "; 
                 }//if                                               
                 alert(strError); 
                 return false; 
               }
}
function no_enter(str)
{
	return false;
}
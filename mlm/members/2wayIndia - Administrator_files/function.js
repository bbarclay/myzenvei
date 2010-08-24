//////////////////////////////////////////////// Website Setting ///////////////////////////////////////////////////////////
function checkenter_website(str)
{
		if(str.keyCode == 13)
		{
		updatewebsitedate();
		}
}


function updatewebsitedate()
 {

  	var idn=document.getElementById('id').value;
 	var cnam=document.getElementById('cname').value;
	var ema=document.getElementById('email').value;
	var phon=document.getElementById('phone').value;
	var caddres=document.getElementById('caddress').value;
	var stat=document.getElementById('state').value;
	var zi=document.getElementById('zip').value;
	var td=document.getElementById('tds').value;
	var serv=document.getElementById('service_charge').value;
	var f=document.getElementById('fee').value;
	

	document.getElementById('result').innerHTML="";
if(!CheckValidation(document.getElementById('cname'),"Please Enter the Company Name"))return false;
if(!CheckValidation(document.getElementById('email'),"Please Enter the Email Address"))return false;
var temp=validateemail(document.getElementById("email"));	if(temp==false) return false;
if(!CheckValidation(document.getElementById('state'),"Please Enter the Email Address"))return false;
if(!CheckValidation(document.getElementById('zip'),"Please Enter the Email Address"))return false;
if(!CheckValidation(document.getElementById('phone'),"Please Enter the Phone number"))return false;
if(!CheckValidation(document.getElementById('caddress'),"Please Enter the Company Address"))return false;


	agent.call('','update_websitedate', 'callback_update_websitedate',idn,cnam,ema,phon,caddres,stat,zi,td,serv,f);	
}
function savefrm()
{

	if(!CheckValidation(document.getElementById('txtsponsorid'),"Please Enter the Sponser Id"))return false;
	if(!CheckValidation(document.getElementById('txtsponname'),"Please enter valid Sponser Id"))return false;
	var f=0;
		if(document.getElementById("posleft").checked==true)
		f=1;
		if(document.getElementById("posright").checked==true)
		f=1;
		
		if(f!=1)
		{
			alert("No position available");
			return false;
		}
	
	if(!CheckValidation(document.getElementById('txtuname'),"Please Enter the Name"))return false;
	
//	if(!CheckValidation(document.getElementById('txtEmail'),"Please Enter the Email Address"))return false;
//	var temp=validateemail(document.getElementById("txtEmail"));	if(temp==false) return false;	
	
	if(!CheckValidation(document.getElementById('txtaddress'),"Please Enter the Address"))return false;
	if(!CheckValidation(document.getElementById('txtdist'),"Please Enter the District"))return false;
	if(!CheckValidation(document.getElementById('cmdstate'),"Please Enter the State"))return false;
	if(!CheckValidation(document.getElementById('txtPincode'),"Please Enter the Zipcode"))return false;
	if(!CheckValidation(document.getElementById('txtmobile'),"Please Enter the Mobile number"))return false;	
	if(!CheckValidation(document.getElementById('txtsrno'),"Please Enter the pin serial number"))return false;
	if(!CheckValidation(document.getElementById('txtpin'),"Please Enter the pin number"))return false;
	if(!CheckValidation(document.getElementById('txtpckgval'),"Please Enter the package value"))return false;

	var newpass=document.getElementById('txtpwd').value;
	var renewpass=document.getElementById('txtreconfpwd').value;

	if(!CheckValidation(document.getElementById('txtpwd'),"Please Enter the new password"))return false;
	if(!CheckValidation(document.getElementById('txtreconfpwd'),"Please Enter the retype password"))return false;
	if(newpass!=renewpass)
	{
	alert('New Password & Retype Password must be same.');
	return false;
	}
	
	if(document.getElementById("chkTerms").checked!=true)
	{
			alert('Please select the Terms & Conditions.');
			return false;
	}
	
}
function callback_update_websitedate(res)
{
	document.getElementById('result').innerHTML=res;
}

function sp_detail(sid)
{
	 document.getElementById('posleft').checked=false;
	 document.getElementById('posright').checked=false;
	 document.getElementById('txtsponname').value='';
	agent.call('','sel_sponser', 'callback_sel_sponser',sid);	
}
function callback_sel_sponser(res)
{
	// alert(res);
	var r=res.split(",");	
	document.getElementById('txtsponname').value=r[0];
	if(r[1]=="1")
	document.getElementById('posleft').checked="checked";
	else if(r[2]=="1")
	document.getElementById('posright').checked="checked";
	
}
		








//////////////////////////////////////////////////////////////////////////

function focus()
{
	document.frmlogin.txtname.focus();
//	document.frmlogin.txtpass.focus();
	
}
var newpass;
function changepass()
{
	document.getElementById('result').innerHTML="";
	var name=document.getElementById('txtname').value;
	newpass=document.getElementById('txtnew').value;
	var renewpass=document.getElementById('txtrenew').value;
	

	if(!CheckValidation(document.getElementById('txtnew'),"Please Enter the new password"))return false;
	if(!CheckValidation(document.getElementById('txtrenew'),"Please Enter the retype password"))return false;
			if(newpass!=renewpass)
				alert('New Password & Retype Password must be same.');
				else	
				{
					//newpass=newpass;

	agent.call('','change_password', 'callback_change_password',name,newpass);		
				}
	
		
	
}

function changepass_user()
{
	document.getElementById('result').innerHTML="";
	var name=document.getElementById('txtname').value;
	newpass=document.getElementById('txtnew').value;
	var renewpass=document.getElementById('txtrenew').value;
	

	if(!CheckValidation(document.getElementById('txtnew'),"Please Enter the new password"))return false;
	if(!CheckValidation(document.getElementById('txtrenew'),"Please Enter the retype password"))return false;
			if(newpass!=renewpass)
				alert('New Password & Retype Password must be same.');
				else	
				{
					//newpass=newpass;

	agent.call('','change_password_user', 'callback_change_password_user',name,newpass);		
				}
	
		
	
}

function callback_change_password_user(res)
{
	 
	
	if(res==1)
	{
//		alert(newpass);
			document.getElementById('txtnew').value="";
			document.getElementById('txtrenew').value="";
			document.getElementById('result').innerHTML="Record has been updates successfully";
	}
	else
	{
//		document.getElementById('txtold').value=newpass;
		document.getElementById('result').innerHTML=res;
		document.getElementById('res').innerHTML="User Name and Passward is invalid try again";
	}
}
function onwebload()
{
document.getElementById("cname").focus();
}

function changeadmin(id)
{

		if(document.getElementById('txtnew').value!='')
		{
			document.getElementById('txtold').value=document.getElementById('txtnew').value;
			document.getElementById('txtnew').value="";
			document.getElementById('txtrenew').value="";;
		}
		
		document.getElementById("tbldata").style.display="none";
	
	try {
	    document.getElementById('editadmin').style.display="table";
		}
		catch(ex)
		{
			document.getElementById("editadmin").style.display="block";
		}
		document.getElementById("txtnew").focus();
		document.getElementById('result').innerHTML="";
	document.getElementById('res').innerHTML="";
	
}

function callback_admin_data(re)
{
	document.getElementById('result').innerHTML="";
	document.getElementById('res').innerHTML="";
	var r=re.split("`");
	document.getElementById('txtname').value=r[0];
	document.getElementById('txtold').value=r[1];
		
}



function redirect_admin()
{
	document.getElementById("editadmin").style.display="none";
	try {
	    document.getElementById('tbldata').style.display="table";
		}
		catch(ex)
		{
			document.getElementById("tbldata").style.display="block";
		}
}

function check()
{

		document.getElementById('res').innerHTML="";
		var name=document.getElementById('txtname').value;
		var pass=document.getElementById('txtpass').value;
		if(name=='')
		{
			alert('Please Eneter the Name');
			document.frmlogin.txtname.focus();
		}
		else
		{
				if(pass=='')
				{
					alert('Please Eneter the Password');
					document.frmlogin.txtpass.focus();
				}
				else
				{
					document.getElementById("process").style.display="block";
					agent.call('','checklogin', 'callback_checklogin',name,pass);
				}
	 }
}
function callback_checklogin(result)
{
	
		document.getElementById('txtname').value="";
		document.getElementById('txtpass').value="";
		document.getElementById("process").style.display="none";
		if (result==0)
		{
			var temp="Invalid UserName or Password"
			document.getElementById('res').innerHTML=temp;
			document.frmlogin.txtname.focus();
		}
		if (result==1)
		{
			location.href="index.php";
		}
}

function check_login()
{

		document.getElementById('res').innerHTML="";
		var name=document.getElementById('txtname').value;
		var pass=document.getElementById('txtpass').value;
		if(name=='')
		{
			document.getElementById('res').innerHTML='Please Eneter the Name';
			document.frmlogin.txtname.focus();
		}
		else
		{
				if(pass=='')
				{
					document.getElementById('res').innerHTML='Please Eneter the Password';
					document.frmlogin.txtpass.focus();
				}
				else
				{
					document.getElementById("process").style.display="block";
					document.getElementById('res').innerHTML="";
					agent.call('','check_userlogin', 'callback_check_login',name,pass);
				}
	 }
}
function callback_check_login(result)
{
	 
		document.getElementById('txtname').value="";
		document.getElementById('txtpass').value="";
		document.getElementById("process").style.display="none";
		if (result==0)
		{
			var temp="Invalid Id or Password"
			document.getElementById('res').innerHTML=temp;
			document.frmlogin.txtname.focus();
		}
		if (result==1)
		{
			location.href="index.php";
		}
}
function checkenter(str)
{
		if(str.keyCode == 13)
		{
		check();
		}
}
function checkenter_admin(str)
{
		if(str.keyCode == 13)
		{
		changepass();
		}
}

function checkenter_customer(str)
{
		if(str.keyCode == 13)
		{
		addcustomer_data();
		}
}
function checkenter_service(str)
{
		if(str.keyCode == 13)
		{
		addcustomer_data();
		}
}
function checkenter_package(str)
{
		if(str.keyCode == 13)
		{
		addpackage_data();
		}
}

function editsavefrm()
{

	
	if(!CheckValidation(document.getElementById('txtuname'),"Please Enter the Name"))return false;
	
	//if(!CheckValidation(document.getElementById('txtEmail'),"Please Enter the Email Address"))return false;
//	var temp=validateemail(document.getElementById("txtEmail"));	if(temp==false) return false;	
	
	if(!CheckValidation(document.getElementById('txtaddress'),"Please Enter the Address"))return false;
	if(!CheckValidation(document.getElementById('txtdist'),"Please Enter the District"))return false;
	if(!CheckValidation(document.getElementById('cmdstate'),"Please Enter the State"))return false;
	if(!CheckValidation(document.getElementById('txtPincode'),"Please Enter the Zipcode"))return false;
	if(!CheckValidation(document.getElementById('txtmobile'),"Please Enter the Mobile number"))return false;	
	
}
function hidemydetail()
{
	document.getElementById("mydetail").style.display="none";
	document.getElementById("mydetail").innerHTML="";
}
function showmydetail(id)
{
	agent.call('','getmydetail', 'callback_showmydetail',id);
}
function callback_showmydetail(res)
{
		document.getElementById("mydetail").innerHTML=res;
		document.getElementById("mydetail").style.display="block";
}
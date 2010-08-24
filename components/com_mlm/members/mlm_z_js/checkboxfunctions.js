function fnCheckAllCommissions(chkCommissions)
{
	if(chkCommissions.checked)
	{
		////Check All Commissions
		document.getElementById("chkFastStartBonus").checked=false;
		document.getElementById("chkComission").checked=false;
		document.getElementById("chkPrefCustomerCommission").checked=false;
		
		////Matching  All On/Off
		document.getElementById("chkMatchingAll").checked=false;
		document.getElementById("chkMatchingFastStart").checked=false;
		document.getElementById("chkMatchingCommissions").checked=false;
		document.getElementById("chkMatchingPreferredCustomer").checked=false;
		
		
		
	}
	else
	{
		////Check All Commissions
		document.getElementById("chkFastStartBonus").checked=true;
		document.getElementById("chkComission").checked=true;
		document.getElementById("chkPrefCustomerCommission").checked=true;
		
		////Matching  All On/Off
		document.getElementById("chkMatchingAll").checked=true;
		document.getElementById("chkMatchingFastStart").checked=true;
		document.getElementById("chkMatchingCommissions").checked=true;
		document.getElementById("chkMatchingPreferredCustomer").checked=true;
	}
}

function subAllCommissions(chkMatchingAll)
{
	if(chkMatchingAll.checked)
	{ 
		
		document.getElementById("chkMatchingFastStart").checked=false;
		document.getElementById("chkMatchingCommissions").checked=false;
		document.getElementById("chkMatchingPreferredCustomer").checked=false;
		
	}
	else
	{   
		
	
		document.getElementById("chkMatchingFastStart").checked=true;
		document.getElementById("chkMatchingCommissions").checked=true;
		document.getElementById("chkMatchingPreferredCustomer").checked=true;
		
		
	}
}

function fnStatusAll(chkStatusAll)
{
	if(chkStatusAll.checked)
	{
		document.getElementById("chkDownlineAssociates").checked=false;
		document.getElementById("chkPendingAssoc").checked=false;
		document.getElementById("chkActiveAssoc").checked=false;
		document.getElementById("chkInnactiveAssoc").checked=false;
		document.getElementById("chkPendingAutoship").checked=false;
		document.getElementById("chklPendingActiveDate").checked=false;
	}
	else
	{
		document.getElementById("chkDownlineAssociates").checked=true;
		document.getElementById("chkPendingAssoc").checked=true;
		document.getElementById("chkActiveAssoc").checked=true;
		document.getElementById("chkInnactiveAssoc").checked=true;
		document.getElementById("chkPendingAutoship").checked=true;
		document.getElementById("chklPendingActiveDate").checked=true;
	}
}
function fnLevelInformation(chkLevelInformation)
{
	if(chkLevelInformation.checked)
	{
		////Level Information
		document.getElementById("chkShowNames").checked=false;
		document.getElementById("chkMyPersonally").checked=false;
		document.getElementById("chkPhoneNumbers").checked=false;

		//////All Levels
		document.getElementById("chkAllLevels").checked=false;
		document.getElementById("chkOne").checked=false;
		document.getElementById("chkTwo").checked=false;
		document.getElementById("chkThree").checked=false;
		document.getElementById("chkFour").checked=false;
		document.getElementById("chkFive").checked=false;
		document.getElementById("chkSix").checked=false;
		document.getElementById("chkSeven").checked=false;
		document.getElementById("chkEight").checked=false;
		document.getElementById("chkNine").checked=false;
	}
	else
	{
		////Level Information
		document.getElementById("chkShowNames").checked=true;
		document.getElementById("chkMyPersonally").checked=true;
		document.getElementById("chkPhoneNumbers").checked=true;

		//////All Levels
		document.getElementById("chkAllLevels").checked=true;
		document.getElementById("chkOne").checked=true;
		document.getElementById("chkTwo").checked=true;
		document.getElementById("chkThree").checked=true;
		document.getElementById("chkFour").checked=true;
		document.getElementById("chkFive").checked=true;
		document.getElementById("chkSix").checked=true;
		document.getElementById("chkSeven").checked=true;
		document.getElementById("chkEight").checked=true;
		document.getElementById("chkNine").checked=true;
	}
}

function subLevelInformation(chkAllLevels)
{
	if(chkAllLevels.checked)
	{
		
	    document.getElementById("chkOne").checked=false;
		document.getElementById("chkTwo").checked=false;
		document.getElementById("chkThree").checked=false;
		document.getElementById("chkFour").checked=false;
		document.getElementById("chkFive").checked=false;
		document.getElementById("chkSix").checked=false;
		document.getElementById("chkSeven").checked=false;
		document.getElementById("chkEight").checked=false;
		document.getElementById("chkNine").checked=false;
	}
	else
	{
		
		document.getElementById("chkOne").checked=true;
		document.getElementById("chkTwo").checked=true;
		document.getElementById("chkThree").checked=true;
		document.getElementById("chkFour").checked=true;
		document.getElementById("chkFive").checked=true;
		document.getElementById("chkSix").checked=true;
		document.getElementById("chkSeven").checked=true;
		document.getElementById("chkEight").checked=true;
		document.getElementById("chkNine").checked=true;
	}
}


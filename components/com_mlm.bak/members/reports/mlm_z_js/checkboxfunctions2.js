function fnCheckAllCommissions(chkCommissions)
{
	if(chkCommissions.checked)
	{
		////Check All Commissions
		frmRegistration.chkFastStartBonus.checked=false;
		frmRegistration.chkComission.checked=false;
		frmRegistration.chkPrefCustomerCommission.checked=false;

		////Matching  All On/Off
		frmRegistration.chkMatchingAll.checked=false;
		frmRegistration.chkMatchingFastStart.checked=false;
		frmRegistration.chkMatchingCommissions.checked=false;
		frmRegistration.chkMatchingPreferredCustomer.checked=false;
	}
	else
	{
		////Check All Commissions
		frmRegistration.chkFastStartBonus.checked=true;
		frmRegistration.chkComission.checked=true;
		frmRegistration.chkPrefCustomerCommission.checked=true;

		////Matching  All On/Off
		frmRegistration.chkMatchingAll.checked=true;
		frmRegistration.chkMatchingFastStart.checked=true;
		frmRegistration.chkMatchingCommissions.checked=true;
		frmRegistration.chkMatchingPreferredCustomer.checked=true;
	}
}

function subAllCommissions(chkCommissions)
{
	if(chkMatchingAll.checked)
	{
		
		frmRegistration.chkMatchingFastStart.checked=false;
		frmRegistration.chkMatchingCommissions.checked=false;
		frmRegistration.chkMatchingPreferredCustomer.checked=false;
	}
	else
	{
		
		frmRegistration.chkMatchingFastStart.checked=true;
		frmRegistration.chkMatchingCommissions.checked=true;
		frmRegistration.chkMatchingPreferredCustomer.checked=true;
	}
}

function fnStatusAll(chkStatusAll)
{
	if(chkStatusAll.checked)
	{
		frmRegistration.chkDownlineAssociates.checked=false;
		frmRegistration.chkPendingAssoc.checked=false;
		frmRegistration.chkActiveAssoc.checked=false;
		frmRegistration.chkInnactiveAssoc.checked=false;
		frmRegistration.chkPendingAutoship.checked=false;
		frmRegistration.chklPendingActiveDate.checked=false;
	}
	else
	{
		frmRegistration.chkDownlineAssociates.checked=true;
		frmRegistration.chkPendingAssoc.checked=true;
		frmRegistration.chkActiveAssoc.checked=true;
		frmRegistration.chkInnactiveAssoc.checked=true;
		frmRegistration.chkPendingAutoship.checked=true;
		frmRegistration.chklPendingActiveDate.checked=true;
	}
}
function fnLevelInformation(chkLevelInformation)
{
	if(chkLevelInformation.checked)
	{
		////Level Information
		frmRegistration.chkShowNames.checked=false;
		frmRegistration.chkMyPersonally.checked=false;
		frmRegistration.chkPhoneNumbers.checked=false;

		//////All Levels
		frmRegistration.chkAllLevels.checked=false;
		frmRegistration.chkOne.checked=false;
		frmRegistration.chkTwo.checked=false;
		frmRegistration.chkThree.checked=false;
		frmRegistration.chkFour.checked=false;
		frmRegistration.chkFive.checked=false;
		frmRegistration.chkSix.checked=false;
		frmRegistration.chkSeven.checked=false;
		frmRegistration.chkEight.checked=false;
		frmRegistration.chkNine.checked=false;
	}
	else
	{
		////Level Information
		frmRegistration.chkShowNames.checked=true;
		frmRegistration.chkMyPersonally.checked=true;
		frmRegistration.chkPhoneNumbers.checked=true;

		//////All Levels
		frmRegistration.chkAllLevels.checked=true;
		frmRegistration.chkOne.checked=true;
		frmRegistration.chkTwo.checked=true;
		frmRegistration.chkThree.checked=true;
		frmRegistration.chkFour.checked=true;
		frmRegistration.chkFive.checked=true;
		frmRegistration.chkSix.checked=true;
		frmRegistration.chkSeven.checked=true;
		frmRegistration.chkEight.checked=true;
		frmRegistration.chkNine.checked=true;
	}
}

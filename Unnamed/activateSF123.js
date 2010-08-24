//Powered by Softery.com
//Ver: 4//
function FlashSolver()
    {
    window.setTimeout("ReloadFlashObjects()", 1);
    window.status = "";
    window.defaultStatus = "";
    }
function ReloadFlashObjects()
	{
	n=navigator;
	nav=n.appVersion.toLowerCase();
	if ((nav.indexOf('win')!=-1) || (nav.indexOf('nt')!=-1)) 
		{
		if (navigator.appName == "Microsoft Internet Explorer")
			{
			var tmpObject = document.getElementsByTagName('object');
			if (tmpObject && tmpObject.length) 
				{
				for (var i = 0; i < tmpObject.length; i++) 
					{
					if (tmpObject[i].getAttribute('classid').toLowerCase() == 'clsid:d27cdb6e-ae6d-11cf-96b8-444553540000') 
						{
						var ps = tmpObject[i].getElementsByTagName('param');
						if (ps && ps != null)
							{
							for (var j = 0; j < ps.length; j++) 
								{
								if (ps[j].getAttribute('name').toLowerCase() == 'flashvars') 
									{
									var variables = ps[j].getAttribute('value');
									break;
									}
								}
							}
						var obj = tmpObject[i].outerHTML + "\n";
						obj = obj.replace(/FLASHVARS" VALUE=""/i,'FLASHVARS" value="'+variables+'"');
						tmpObject[i].outerHTML = obj;
						}
					}
				tmpObject = null;
				}
			}
		}
	}
window.onunload = function()
	{
	n=navigator;
	nav=n.appVersion.toLowerCase();
	if ((nav.indexOf('win')!=-1) || (nav.indexOf('nt')!=-1)) 
		{
		if (navigator.appName == "Microsoft Internet Explorer")
			{
			if (document.getElementsByTagName) 
				{
				var tmpObject = document.getElementsByTagName("object"); 
				for (i=0; i<tmpObject.length; i++)
					{
					tmpObject[i].outerHTML = ""; 
					}
				}
			}
		}
	}

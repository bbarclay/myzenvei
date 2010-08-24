if (document.getElementsByTagName) {
        var hrefs = document.getElementsByTagName("a");
        for (var l = 0; l < hrefs.length; l++) {
			try{
	                if (hrefs[l].protocol == "mailto:") {
							if (pv[1] == 1) {
			                		startListening(hrefs[l],"click",trackMailto);
							}
	                } else if (hrefs[l].hostname == location.host) {
							if (pv[0] == 1) {
			                		var path = hrefs[l].pathname + hrefs[l].search;
									var isDoc = path.match(regex);
	            		    		if (isDoc) {
	                    				    startListening(hrefs[l],"click",trackExternalLinks);
	                        		}
							}
	                } else {
							if (pv[2] == 1) {
			               			startListening(hrefs[l],"click",trackExternalLinks);
							}
	                }
			}
			catch(e){
					continue;
			}
        }
}

function startListening (obj,evnt,func) {
        if (obj.addEventListener) {
                obj.addEventListener(evnt,func,false);
        } else if (obj.attachEvent) {
                obj.attachEvent("on" + evnt,func);
        }
}

function trackMailto (evnt) {
        var href = (evnt.srcElement) ? evnt.srcElement.href : this.href;
        var mailto = trmlname + href.substring(7);
        if (typeof(pageTracker) == "object") pageTracker._trackPageview(mailto);
}

function trackExternalLinks (evnt) {
        var e = (evnt.srcElement) ? evnt.srcElement : this;
        while (e.tagName != "A") {
                e = e.parentNode;
        }
        var lnk = (e.pathname.charAt(0) == "/") ? e.pathname : "/" + e.pathname;
		if (pv[4] == 1) lnk = trdlname + e.pathname;
        if (e.search && e.pathname.indexOf(e.search) == -1) lnk += e.search;
        if (e.hostname != location.host && pv[3] == 1) lnk = trlkname + e.hostname + lnk;
		if (e.hostname != location.host && pv[3] == 0) lnk = trlkname + e.hostname;
        if (typeof(pageTracker) == "object") pageTracker._trackPageview(lnk); 
}
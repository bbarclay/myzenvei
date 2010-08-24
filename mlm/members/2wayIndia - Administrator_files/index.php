<!--
/*
Copyright (c) 2005 JSON.org

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The Software shall be used for Good, not Evil.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

/*
    The global object JSON contains two methods.

    JSON.stringify(value) takes a JavaScript value and produces a JSON text.
    The value must not be cyclical.

    JSON.parse(text) takes a JSON text and produces a JavaScript value. It will
    throw a 'JSONError' exception if there is an error.
*/
var JSON = {
    copyright: '(c)2005 JSON.org',
    license: 'http://www.crockford.com/JSON/license.html',
/*
    Stringify a JavaScript value, producing a JSON text.
*/
    stringify: function (v) {
        var a = [];

/*
    Emit a string.
*/
        function e(s) {
            a[a.length] = s;
        }

/*
    Convert a value.
*/
        function g(x) {
            var c, i, l, v;

            switch (typeof x) {
            case 'object':
                if (x) {
                    if (x instanceof Array) {
                        e('[');
                        l = a.length;
                        for (i = 0; i < x.length; i += 1) {
                            v = x[i];
                            if (typeof v != 'undefined' &&
                                    typeof v != 'function') {
                                if (l < a.length) {
                                    e(',');
                                }
                                g(v);
                            }
                        }
                        e(']');
                        return;
                    } else if (typeof x.toString != 'undefined') {
                        e('{');
                        l = a.length;
                        for (i in x) {
                            v = x[i];
                            if (x.hasOwnProperty(i) &&
                                    typeof v != 'undefined' &&
                                    typeof v != 'function') {
                                if (l < a.length) {
                                    e(',');
                                }
                                g(i);
                                e(':');
                                g(v);
                            }
                        }
                        return e('}');
                    }
                }
                e('null');
                return;
            case 'number':
                e(isFinite(x) ? +x : 'null');
                return;
            case 'string':
                l = x.length;
                e('"');
                for (i = 0; i < l; i += 1) {
                    c = x.charAt(i);
                    if (c >= ' ') {
                        if (c == '\\' || c == '"') {
                            e('\\');
                        }
                        e(c);
                    } else {
                        switch (c) {
                        case '\b':
                            e('\\b');
                            break;
                        case '\f':
                            e('\\f');
                            break;
                        case '\n':
                            e('\\n');
                            break;
                        case '\r':
                            e('\\r');
                            break;
                        case '\t':
                            e('\\t');
                            break;
                        default:
                            c = c.charCodeAt();
                            e('\\u00' + Math.floor(c / 16).toString(16) +
                                (c % 16).toString(16));
                        }
                    }
                }
                e('"');
                return;
            case 'boolean':
                e(String(x));
                return;
            default:
                e('null');
                return;
            }
        }
        g(v);
        return a.join('');
    },
/*
    Parse a JSON text, producing a JavaScript value.
*/
    parse: function (text) {
        return (/^(\s+|[,:{}\[\]]|"(\\["\\\/bfnrtu]|[^\x00-\x1f"\\]+)*"|-?\d+(\.\d*)?([eE][+-]?\d+)?|true|false|null)+$/.test(text)) &&
            eval('(' + text + ')');
    }
};


// client-side agent implementation 
this_url = "/2wayindia/admin/index.php?page=chart";
function Agent() {
  this.debug = false; // default
  this.call = function () {
    var aa_sfunc = "";
    var aa_cfunc = "";
    var result = "";
    var xmlHttpObject;
    if(arguments.length<3) {
      alert("Incorrect number of parameters. Please check your function call");
      return;
    } 
    aa_url=arguments[0];
    aa_sfunc=arguments[1];
    aa_cfunc=arguments[2];

    if((aa_url==null)||(aa_url=="")) aa_url = this_url;
    var aa_poststr = "aa_afunc=call&aa_sfunc=" + encodeURI(aa_sfunc) +
        "&aa_cfunc=" + encodeURI(aa_cfunc);
    for(var i=3; i<arguments.length; i++) {
      if(typeof(arguments[i])=='object') {
        aa_poststr += "&aa_sfunc_args[]="+encodeURI(JSON.stringify(arguments[i]));
      } else {
        aa_poststr += "&aa_sfunc_args[]="+encodeURI(arguments[i]);
      }
    }
    xmlHttpObject = false;
    if (window.XMLHttpRequest) { // Mozilla, Safari,...
       xmlHttpObject = new XMLHttpRequest();
       if (xmlHttpObject.overrideMimeType) {
          xmlHttpObject.overrideMimeType('text/xml');
       }
    } else if (window.ActiveXObject) { // IE
       try {
          xmlHttpObject = new ActiveXObject("Msxml2.XMLHTTP");
       } catch (e) {
          try {
             xmlHttpObject = new ActiveXObject("Microsoft.XMLHTTP");
          } catch (e) {}
       }
    }
    if (!xmlHttpObject) {
       alert('Agent unable to establish communication  :( ');
       return false;
    }
    
    if((aa_sfunc==null)||(aa_sfunc=="")) {
      if(arguments[3]) aa_poststr=arguments[3];
    }
    
    if((aa_cfunc==null)||(aa_cfunc=="")) {
      xmlHttpObject.open('POST', aa_url, false);
      xmlHttpObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlHttpObject.setRequestHeader("Content-length", arguments.length+1);
      //xmlHttpObject.setRequestHeader("Connection", "close"); // not needed
      xmlHttpObject.send(aa_poststr);
      return xmlHttpObject.responseText;
    } else {
      xmlHttpObject.onreadystatechange = function () {
        if (xmlHttpObject.readyState == 4) {
           if (xmlHttpObject.status == 200) {
              result = xmlHttpObject.responseText;
              result = result.replace(/\\\"/g,'"');
              if(document.getElementById(aa_cfunc)) {
                try {
                  document.getElementById(aa_cfunc).innerHTML=result;
                }
                catch (e) {
                  document.getElementById(aa_cfunc).value=result;
                }               
              } else {
                if (JSON.parse(result)) 
                  eval(aa_cfunc+"(JSON.parse(result));");
                else 
                  eval(aa_cfunc+"(result);");
              }
           } else {
              if(xmlHttpObject.status!=0) {
                alert('There was a problem with the request.');
              }
           }
        }
      }
      xmlHttpObject.open('POST', aa_url, true);
      xmlHttpObject.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlHttpObject.setRequestHeader("Content-length", arguments.length+1);
      //xmlHttpObject.setRequestHeader("Connection", "close"); // not needed
      xmlHttpObject.send(aa_poststr);
      return xmlHttpObject;
    }
  }
  this.listen = function (aa_event, aa_cfunc) {
    // listener function will come here
  }
}
var agent = new Agent();

//-->

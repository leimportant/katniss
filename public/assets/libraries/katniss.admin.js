function strRepeat(e,t){for(var i=0;i<t-1;++i)e+=e;return e}function toDigits(e,t){"undefined"==typeof t&&(t=2);var i=Math.pow(10,t-1);return e<i?strRepeat("0",t-1)+e:e}function urlParam(e){var t=new RegExp("[?&]"+e+"=([^&#]*)").exec(window.location.href);return null==t?null:decodeURIComponent(t[1])||0}function isUnset(e){return void 0==e||"undefined"==typeof e||null==e}function isSet(e){return!isUnset(e)}function isString(e){return"string"==typeof e}function isObject(e,t){return t=isUnset(t)?"[object]":"[object "+t+"]",isSet(e)&&Object.prototype.toString.call(e)===t}function isArray(e){return isObject(e,"Array")}function beginsWith(e,t){return!!isSet(e)&&0==e.toString().indexOf(t)}function nl2br(e){return e.replace(/\r*\n/g,"<br>")}function htmlspecialchars(e){var t={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#039;"};return e.replace(/[&<>"']/g,function(e){return t[e]})}function NumberFormatHelper(){this.DEFAULT_NUMBER_OF_DECIMAL_POINTS=2,this.type=KATNISS_SETTINGS.number_format,this.numberOfDecimalPoints=this.DEFAULT_NUMBER_OF_DECIMAL_POINTS}function KatnissApiMessages(e){this.messages=isArray(e)?e:isString(e)?[e]:[]}function KatnissApi(e){this.REQUEST_TYPE_POST="post",this.REQUEST_TYPE_GET="get",this.REQUEST_TYPE_PUT="put",this.REQUEST_TYPE_DELETE="delete",this.isWebApi=isSet(e)&&e===!0}function updateCsrfToken(e){KATNISS_REQUEST_TOKEN=e,$('input[type="hidden"][name="_token"]').val(e),startSessionTimeout()}function startSessionTimeout(){isSet(_sessionTimeout)&&clearTimeout(_sessionTimeout),_sessionTimeout=setTimeout(function(){if(KATNISS_USER!==!1&&KATNISS_USER_REQUIRED)x_modal_lock();else{var e=new KatnissApi((!0));e.get("user/csrf-token",null,function(e,t,i){e||updateCsrfToken(t.csrf_token)})}},KATNISS_SESSION_LIFETIME+1e3)}function openWindow(e,t,i,n){var o=[];for(var r in i)o.push(r+"="+i[r]);return window.open(e,t,o.join(","),n)}function quickForm(e,t,i){"undefined"==typeof i&&(i="post"),$form=$('<form action="'+e+'" method="'+i+'"></form>');for(var n in t)$form.append('<input type="hidden" name="'+n+'" value="'+t[n]+'">');return $form}!function(e){function t(e){return n?n[e]:(n=require("unicode/category/So"),o=["sign","cross","of","symbol","staff","hand","black","white"].map(function(e){return new RegExp(e,"gi")}),n[e])}function i(e,n){e=e.toString(),"string"==typeof n&&(n={replacement:n}),n=n||{},n.mode=n.mode||i.defaults.mode;for(var r,s=i.defaults.modes[n.mode],a=["replacement","multicharmap","charmap","remove","lower"],u=0,p=a.length;u<p;u++)r=a[u],n[r]=r in n?n[r]:s[r];"undefined"==typeof n.symbols&&(n.symbols=s.symbols);var c=[];for(var r in n.multicharmap)if(n.multicharmap.hasOwnProperty(r)){var l=r.length;c.indexOf(l)===-1&&c.push(l)}for(var m,f,d,h="",u=0,p=e.length;u<p;u++){if(d=e[u],!c.some(function(t){var i=e.substr(u,t);return!!n.multicharmap[i]&&(u+=t-1,d=n.multicharmap[i],!0)})&&(n.charmap[d]?(d=n.charmap[d],m=d.charCodeAt(0)):m=e.charCodeAt(u),n.symbols&&(f=t(m)))){d=f.name.toLowerCase();for(var y=0,S=o.length;y<S;y++)d=d.replace(o[y],"");d=d.replace(/^\s+|\s+$/g,"")}d=d.replace(/[^\w\s\-\.\_~]/g,""),n.remove&&(d=d.replace(n.remove,"")),h+=d}return h=h.replace(/^\s+|\s+$/g,""),h=h.replace(/[-\s]+/g,n.replacement),h=h.replace(n.replacement+"$",""),n.lower&&(h=h.toLowerCase()),h}var n,o;if(i.defaults={mode:"pretty"},i.multicharmap=i.defaults.multicharmap={"<3":"love","&&":"and","||":"or","w/":"with"},i.charmap=i.defaults.charmap={"À":"A","Á":"A","Â":"A","Ã":"A","Ä":"A","Å":"A","Æ":"AE","Ç":"C","È":"E","É":"E","Ê":"E","Ë":"E","Ì":"I","Í":"I","Î":"I","Ï":"I","Ð":"D","Ñ":"N","Ò":"O","Ó":"O","Ô":"O","Õ":"O","Ö":"O","Ő":"O","Ø":"O","Ù":"U","Ú":"U","Û":"U","Ü":"U","Ű":"U","Ý":"Y","Þ":"TH","ß":"ss","à":"a","á":"a","â":"a","ã":"a","ä":"a","å":"a","æ":"ae","ç":"c","è":"e","é":"e","ê":"e","ë":"e","ì":"i","í":"i","î":"i","ï":"i","ð":"d","ñ":"n","ò":"o","ó":"o","ô":"o","õ":"o","ö":"o","ő":"o","ø":"o","ù":"u","ú":"u","û":"u","ü":"u","ű":"u","ý":"y","þ":"th","ÿ":"y","ẞ":"SS","α":"a","β":"b","γ":"g","δ":"d","ε":"e","ζ":"z","η":"h","θ":"8","ι":"i","κ":"k","λ":"l","μ":"m","ν":"n","ξ":"3","ο":"o","π":"p","ρ":"r","σ":"s","τ":"t","υ":"y","φ":"f","χ":"x","ψ":"ps","ω":"w","ά":"a","έ":"e","ί":"i","ό":"o","ύ":"y","ή":"h","ώ":"w","ς":"s","ϊ":"i","ΰ":"y","ϋ":"y","ΐ":"i","Α":"A","Β":"B","Γ":"G","Δ":"D","Ε":"E","Ζ":"Z","Η":"H","Θ":"8","Ι":"I","Κ":"K","Λ":"L","Μ":"M","Ν":"N","Ξ":"3","Ο":"O","Π":"P","Ρ":"R","Σ":"S","Τ":"T","Υ":"Y","Φ":"F","Χ":"X","Ψ":"PS","Ω":"W","Ά":"A","Έ":"E","Ί":"I","Ό":"O","Ύ":"Y","Ή":"H","Ώ":"W","Ϊ":"I","Ϋ":"Y","ş":"s","Ş":"S","ı":"i","İ":"I","ğ":"g","Ğ":"G","а":"a","б":"b","в":"v","г":"g","д":"d","е":"e","ё":"yo","ж":"zh","з":"z","и":"i","й":"j","к":"k","л":"l","м":"m","н":"n","о":"o","п":"p","р":"r","с":"s","т":"t","у":"u","ф":"f","х":"h","ц":"c","ч":"ch","ш":"sh","щ":"sh","ъ":"u","ы":"y","ь":"","э":"e","ю":"yu","я":"ya","А":"A","Б":"B","В":"V","Г":"G","Д":"D","Е":"E","Ё":"Yo","Ж":"Zh","З":"Z","И":"I","Й":"J","К":"K","Л":"L","М":"M","Н":"N","О":"O","П":"P","Р":"R","С":"S","Т":"T","У":"U","Ф":"F","Х":"H","Ц":"C","Ч":"Ch","Ш":"Sh","Щ":"Sh","Ъ":"U","Ы":"Y","Ь":"","Э":"E","Ю":"Yu","Я":"Ya","Є":"Ye","І":"I","Ї":"Yi","Ґ":"G","є":"ye","і":"i","ї":"yi","ґ":"g","č":"c","ď":"d","ě":"e","ň":"n","ř":"r","š":"s","ť":"t","ů":"u","ž":"z","Č":"C","Ď":"D","Ě":"E","Ň":"N","Ř":"R","Š":"S","Ť":"T","Ů":"U","Ž":"Z","ą":"a","ć":"c","ę":"e","ł":"l","ń":"n","ś":"s","ź":"z","ż":"z","Ą":"A","Ć":"C","Ę":"E","Ł":"L","Ń":"N","Ś":"S","Ź":"Z","Ż":"Z","ā":"a","ē":"e","ģ":"g","ī":"i","ķ":"k","ļ":"l","ņ":"n","ū":"u","Ā":"A","Ē":"E","Ģ":"G","Ī":"I","Ķ":"K","Ļ":"L","Ņ":"N","Ū":"U","ė":"e","į":"i","ų":"u","Ė":"E","Į":"I","Ų":"U","ț":"t","Ț":"T","ţ":"t","Ţ":"T","ș":"s","Ș":"S","ă":"a","Ă":"A","Ạ":"A","Ả":"A","Ầ":"A","Ấ":"A","Ậ":"A","Ẩ":"A","Ẫ":"A","Ằ":"A","Ắ":"A","Ặ":"A","Ẳ":"A","Ẵ":"A","Ẹ":"E","Ẻ":"E","Ẽ":"E","Ề":"E","Ế":"E","Ệ":"E","Ể":"E","Ễ":"E","Ị":"I","Ỉ":"I","Ĩ":"I","Ọ":"O","Ỏ":"O","Ồ":"O","Ố":"O","Ộ":"O","Ổ":"O","Ỗ":"O","Ơ":"O","Ờ":"O","Ớ":"O","Ợ":"O","Ở":"O","Ỡ":"O","Ụ":"U","Ủ":"U","Ũ":"U","Ư":"U","Ừ":"U","Ứ":"U","Ự":"U","Ử":"U","Ữ":"U","Ỳ":"Y","Ỵ":"Y","Ỷ":"Y","Ỹ":"Y","Đ":"D","ạ":"a","ả":"a","ầ":"a","ấ":"a","ậ":"a","ẩ":"a","ẫ":"a","ằ":"a","ắ":"a","ặ":"a","ẳ":"a","ẵ":"a","ẹ":"e","ẻ":"e","ẽ":"e","ề":"e","ế":"e","ệ":"e","ể":"e","ễ":"e","ị":"i","ỉ":"i","ĩ":"i","ọ":"o","ỏ":"o","ồ":"o","ố":"o","ộ":"o","ổ":"o","ỗ":"o","ơ":"o","ờ":"o","ớ":"o","ợ":"o","ở":"o","ỡ":"o","ụ":"u","ủ":"u","ũ":"u","ư":"u","ừ":"u","ứ":"u","ự":"u","ử":"u","ữ":"u","ỳ":"y","ỵ":"y","ỷ":"y","ỹ":"y","đ":"d","€":"euro","₢":"cruzeiro","₣":"french franc","£":"pound","₤":"lira","₥":"mill","₦":"naira","₧":"peseta","₨":"rupee","₩":"won","₪":"new shequel","₫":"dong","₭":"kip","₮":"tugrik","₯":"drachma","₰":"penny","₱":"peso","₲":"guarani","₳":"austral","₴":"hryvnia","₵":"cedi","¢":"cent","¥":"yen","元":"yuan","円":"yen","﷼":"rial","₠":"ecu","¤":"currency","฿":"baht",$:"dollar","₹":"indian rupee","©":"(c)","œ":"oe","Œ":"OE","∑":"sum","®":"(r)","†":"+","“":'"',"”":'"',"‘":"'","’":"'","∂":"d","ƒ":"f","™":"tm","℠":"sm","…":"...","˚":"o","º":"o","ª":"a","•":"*","∆":"delta","∞":"infinity","♥":"love","&":"and","|":"or","<":"less",">":"greater"},i.defaults.modes={rfc3986:{replacement:"-",symbols:!0,remove:null,lower:!0,charmap:i.defaults.charmap,multicharmap:i.defaults.multicharmap},pretty:{replacement:"-",symbols:!0,remove:/[.]/g,lower:!1,charmap:i.defaults.charmap,multicharmap:i.defaults.multicharmap}},"undefined"!=typeof define&&define.amd){for(var r in i.defaults.modes)i.defaults.modes.hasOwnProperty(r)&&(i.defaults.modes[r].symbols=!1);define([],function(){return i})}else if("undefined"!=typeof module&&module.exports)t(),module.exports=i;else{for(var r in i.defaults.modes)i.defaults.modes.hasOwnProperty(r)&&(i.defaults.modes[r].symbols=!1);e.slug=i}}(this),$.fn.extend({registerSlugTo:function(e){return this.on("keyup",function(){var t=slug($(this).val(),{lower:!0});e.each(function(){var e=$(this);e.is("span")?e.text(t):e.val(t)})})},registerSlug:function(e){var t=this;return"undefined"!=typeof e&&t.on("keyup",function(){e.each(function(){var e=$(this);e.is("span")?e.text(t.val()):e.val(t.val())})}),t.on("keydown",function(e){if(e.shiftKey||e.ctrlKey||e.altKey||e.metaKey)return!1;var t=e.keyCode;return t>=65&&t<=90||t>=48&&t<=57||t>=35&&t<=40||t>=96&&t<=105||[189,8,9,13,46].indexOf(t)!=-1})}}),NumberFormatHelper.prototype.modeInt=function(e){this.mode(0)},NumberFormatHelper.prototype.modeNormal=function(e){this.mode(this.DEFAULT_NUMBER_OF_DECIMAL_POINTS)},NumberFormatHelper.prototype.mode=function(e){this.numberOfDecimalPoints=e},NumberFormatHelper.prototype.format=function(e){switch(e=parseFloat(e),this.type){case"point_comma":return this.formatPointComma(e);case"point_space":return this.formatPointSpace(e);case"comma_point":return this.formatCommaPoint(e);case"comma_space":return this.formatCommaSpace(e);default:return e}},NumberFormatHelper.prototype.formatPointComma=function(e){return e.toFixed(this.numberOfDecimalPoints).replace(/(\d)(?=(\d{3})+\.)/g,"$1,")},NumberFormatHelper.prototype.formatPointSpace=function(e){return e.toFixed(this.numberOfDecimalPoints).replace(/(\d)(?=(\d{3})+\.)/g,"$1 ")},NumberFormatHelper.prototype.formatCommaPoint=function(e){return e=this.formatPointSpace(e),e.replace(".",",").replace(" ",".")},NumberFormatHelper.prototype.formatCommaSpace=function(e){return e=this.formatPointSpace(e),e.replace(".",",")},KatnissApiMessages.prototype.hasAny=function(){return this.messages.length>0},KatnissApiMessages.prototype.all=function(){return this.messages},KatnissApiMessages.prototype.first=function(){return this.hasAny()?this.messages[0]:""},KatnissApi.prototype.switchToAppApi=function(){this.isWebApi=!1},KatnissApi.prototype.switchToWebApi=function(){this.isWebApi=!0},KatnissApi.prototype.buildUrl=function(e){var t=this.isWebApi?KATNISS_WEB_API_URL:KATNISS_API_URL;return beginsWith(e,t)?e:t+"/"+e},KatnissApi.prototype.buildParams=function(e){return isUnset(e)&&(e={}),this.isWebApi?(isObject(e,"FormData")?e.append("_token",KATNISS_REQUEST_TOKEN):e._token=KATNISS_REQUEST_TOKEN,e):(isObject(e,"FormData")?(e.append("_app",JSON.stringify(KATNISS_APP)),e.append("_settings",JSON.stringify(KATNISS_SETTINGS))):(e._app=KATNISS_APP,e._settings=KATNISS_SETTINGS),e)},KatnissApi.prototype.buildOptions=function(e,t,i){return isSet(i)||(i={}),i.type=e,i.data=this.buildParams(t),isSet(i.dataType)||(i.dataType="json"),isObject(t,"FormData")&&(i.processData=!1,i.contentType=!1),i},KatnissApi.prototype.beforeRequest=function(){this.isWebApi&&startSessionTimeout()},KatnissApi.prototype.get=function(e,t,i,n,o){this.beforeRequest(),this.promise($.get(this.buildUrl(e),this.buildParams(t)),i,n,o)},KatnissApi.prototype.post=function(e,t,i,n,o){this.beforeRequest(),this.promise($.post(this.buildUrl(e),this.buildParams(t)),i,n,o)},KatnissApi.prototype.put=function(e,t,i,n,o){t._method="put",this.post(e,t,i,n,o)},KatnissApi.prototype["delete"]=function(e,t,i,n,o){t._method="delete",this.post(e,t,i,n,o)},KatnissApi.prototype.request=function(e,t,i,n,o,r,s){this.beforeRequest(),this.promise($.ajax(this.buildUrl(e),this.buildOptions(t,i,n)),o,r,s)},KatnissApi.prototype.promise=function(e,t,i,n){var o=this;e.done(function(e){isSet(t)&&t.call(o,o.isFailed(e),o.data(e),o.messages(e))}).fail(function(e,t,n){isSet(i)&&i.call(o,t,n)}).always(function(){isSet(n)&&n.call(o)})},KatnissApi.prototype.isFailed=function(e){return isSet(e._success)&&1!=e._success},KatnissApi.prototype.data=function(e){return isSet(e._data)?e._data:null},KatnissApi.prototype.messages=function(e){return new KatnissApiMessages(e._messages)};var _sessionTimeout=null;startSessionTimeout(),$(function(){var e=1050;$(document).on("shown.bs.modal",".modal",function(t){$(this).css("z-index",++e)}),$(document).on("click",".go-url",function(e){e.preventDefault();var t=$(this).attr("data-url");t&&(window.location.href=t)}).on("click",".open-window",function(e){e.preventDefault();var t=$(this),i=$.extend(t.data()),n="",o="",r=!0,s=null;i.url?(n=i.url,delete i.url):t.is("a")?n=t.attr("href"):t.is("img")&&(n=t.attr("src")),i.name&&(o=i.name,delete i.name),i.replace&&(r=i.replace,delete i.replace),i.callback&&(s=i.callback,delete i.callback);var a=openWindow(n,o,i,r);return s&&"string"==typeof s&&window[s](this,a),!1}),$(".unsigned-integer-input").on("keydown",function(e){return e.which>=48&&e.which<=57||e.which>=96&&e.which<=105||[8,9,13,35,36,37,39,46,144].indexOf(e.which)!=-1})});
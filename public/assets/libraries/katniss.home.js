function strRepeat(t,e){for(var n=0;n<e-1;++n)t+=t;return t}function toDigits(t,e){"undefined"==typeof e&&(e=2);var n=Math.pow(10,e-1);return t<n?strRepeat("0",e-1)+t:t}function urlParam(t){var e=new RegExp("[?&]"+t+"=([^&#]*)").exec(window.location.href);return null==e?null:decodeURIComponent(e[1])||0}function isUnset(t){return void 0==t||"undefined"==typeof t||null==t}function isSet(t){return!isUnset(t)}function isString(t){return"string"==typeof t}function isObject(t,e){return e=isUnset(e)?"[object]":"[object "+e+"]",isSet(t)&&Object.prototype.toString.call(t)===e}function isArray(t){return isObject(t,"Array")}function beginsWith(t,e){return!!isSet(t)&&0==t.toString().indexOf(e)}function nl2br(t){return t.replace(/\r*\n/g,"<br>")}function htmlspecialchars(t){var e={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#039;"};return t.replace(/[&<>"']/g,function(t){return e[t]})}function strReplaceMany(t,e){for(var n in e)t=t.replace(new RegExp("{"+n+"}","g"),e[n]);return t}function NumberFormatHelper(){this.DEFAULT_NUMBER_OF_DECIMAL_POINTS=2,this.type=KATNISS_SETTINGS.number_format,this.numberOfDecimalPoints=this.DEFAULT_NUMBER_OF_DECIMAL_POINTS}function KatnissApiMessages(t){this.messages=isArray(t)?t:isString(t)?[t]:[]}function KatnissApi(t){this.REQUEST_TYPE_POST="post",this.REQUEST_TYPE_GET="get",this.REQUEST_TYPE_PUT="put",this.REQUEST_TYPE_DELETE="delete",this.isWebApi=isSet(t)&&t===!0}function updateCsrfToken(t){KATNISS_REQUEST_TOKEN=t,$('input[type="hidden"][name="_token"]').val(t),startSessionTimeout()}function startSessionTimeout(){isSet(_sessionTimeout)&&clearTimeout(_sessionTimeout),_sessionTimeout=setTimeout(function(){if(KATNISS_USER!==!1&&KATNISS_USER_REQUIRED)x_modal_lock();else{var t=new KatnissApi((!0));t.get("user/csrf-token",null,function(t,e,n){t||updateCsrfToken(e.csrf_token)})}},KATNISS_SESSION_LIFETIME+1e3)}function openWindow(t,e,n,i){var o=[];for(var r in n)o.push(r+"="+n[r]);return window.open(t,e,o.join(","),i)}function quickForm(t,e,n){"undefined"==typeof n&&(n="post"),$form=$('<form action="'+t+'" method="'+n+'"></form>');for(var i in e)$form.append('<input type="hidden" name="'+i+'" value="'+e[i]+'">');return $form}!function(t){var e=!1;if("function"==typeof define&&define.amd&&(define(t),e=!0),"object"==typeof exports&&(module.exports=t(),e=!0),!e){var n=window.Cookies,i=window.Cookies=t();i.noConflict=function(){return window.Cookies=n,i}}}(function(){function t(){for(var t=0,e={};t<arguments.length;t++){var n=arguments[t];for(var i in n)e[i]=n[i]}return e}function e(n){function i(e,o,r){var s;if("undefined"!=typeof document){if(arguments.length>1){if(r=t({path:"/"},i.defaults,r),"number"==typeof r.expires){var a=new Date;a.setMilliseconds(a.getMilliseconds()+864e5*r.expires),r.expires=a}try{s=JSON.stringify(o),/^[\{\[]/.test(s)&&(o=s)}catch(p){}return o=n.write?n.write(o,e):encodeURIComponent(String(o)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g,decodeURIComponent),e=encodeURIComponent(String(e)),e=e.replace(/%(23|24|26|2B|5E|60|7C)/g,decodeURIComponent),e=e.replace(/[\(\)]/g,escape),document.cookie=[e,"=",o,r.expires?"; expires="+r.expires.toUTCString():"",r.path?"; path="+r.path:"",r.domain?"; domain="+r.domain:"",r.secure?"; secure":""].join("")}e||(s={});for(var u=document.cookie?document.cookie.split("; "):[],c=/(%[0-9A-Z]{2})+/g,f=0;f<u.length;f++){var l=u[f].split("="),m=l.slice(1).join("=");'"'===m.charAt(0)&&(m=m.slice(1,-1));try{var d=l[0].replace(c,decodeURIComponent);if(m=n.read?n.read(m,d):n(m,d)||m.replace(c,decodeURIComponent),this.json)try{m=JSON.parse(m)}catch(p){}if(e===d){s=m;break}e||(s[d]=m)}catch(p){}}return s}}return i.set=i,i.get=function(t){return i.call(i,t)},i.getJSON=function(){return i.apply({json:!0},[].slice.call(arguments))},i.defaults={},i.remove=function(e,n){i(e,"",t(n,{expires:-1}))},i.withConverter=e,i}return e(function(){})}),NumberFormatHelper.prototype.modeInt=function(t){this.mode(0)},NumberFormatHelper.prototype.modeNormal=function(t){this.mode(this.DEFAULT_NUMBER_OF_DECIMAL_POINTS)},NumberFormatHelper.prototype.mode=function(t){this.numberOfDecimalPoints=t},NumberFormatHelper.prototype.format=function(t){switch(t=parseFloat(t),this.type){case"point_comma":return this.formatPointComma(t);case"point_space":return this.formatPointSpace(t);case"comma_point":return this.formatCommaPoint(t);case"comma_space":return this.formatCommaSpace(t);default:return t}},NumberFormatHelper.prototype.formatPointComma=function(t){return t.toFixed(this.numberOfDecimalPoints).replace(/(\d)(?=(\d{3})+\.)/g,"$1,")},NumberFormatHelper.prototype.formatPointSpace=function(t){return t.toFixed(this.numberOfDecimalPoints).replace(/(\d)(?=(\d{3})+\.)/g,"$1 ")},NumberFormatHelper.prototype.formatCommaPoint=function(t){return t=this.formatPointSpace(t),t.replace(".",",").replace(" ",".")},NumberFormatHelper.prototype.formatCommaSpace=function(t){return t=this.formatPointSpace(t),t.replace(".",",")},KatnissApiMessages.prototype.hasAny=function(){return this.messages.length>0},KatnissApiMessages.prototype.all=function(){return this.messages},KatnissApiMessages.prototype.first=function(){return this.hasAny()?this.messages[0]:""},KatnissApi.prototype.switchToAppApi=function(){this.isWebApi=!1},KatnissApi.prototype.switchToWebApi=function(){this.isWebApi=!0},KatnissApi.prototype.buildUrl=function(t){var e=this.isWebApi?KATNISS_WEB_API_URL:KATNISS_API_URL;return beginsWith(t,e)?t:e+"/"+t},KatnissApi.prototype.buildParams=function(t){return isUnset(t)&&(t={}),this.isWebApi?(isObject(t,"FormData")?t.append("_token",KATNISS_REQUEST_TOKEN):t._token=KATNISS_REQUEST_TOKEN,t):(isObject(t,"FormData")?(t.append("_app",JSON.stringify(KATNISS_APP)),t.append("_settings",JSON.stringify(KATNISS_SETTINGS))):(t._app=KATNISS_APP,t._settings=KATNISS_SETTINGS),t)},KatnissApi.prototype.buildOptions=function(t,e,n){return isSet(n)||(n={}),n.type=t,n.data=this.buildParams(e),isSet(n.dataType)||(n.dataType="json"),isObject(e,"FormData")&&(n.processData=!1,n.contentType=!1),n},KatnissApi.prototype.beforeRequest=function(){this.isWebApi&&startSessionTimeout()},KatnissApi.prototype.get=function(t,e,n,i,o){this.beforeRequest(),this.promise($.get(this.buildUrl(t),this.buildParams(e)),n,i,o)},KatnissApi.prototype.post=function(t,e,n,i,o){this.beforeRequest(),this.promise($.post(this.buildUrl(t),this.buildParams(e)),n,i,o)},KatnissApi.prototype.put=function(t,e,n,i,o){e._method="put",this.post(t,e,n,i,o)},KatnissApi.prototype["delete"]=function(t,e,n,i,o){e._method="delete",this.post(t,e,n,i,o)},KatnissApi.prototype.request=function(t,e,n,i,o,r,s){this.beforeRequest(),this.promise($.ajax(this.buildUrl(t),this.buildOptions(e,n,i)),o,r,s)},KatnissApi.prototype.promise=function(t,e,n,i){var o=this;t.done(function(t){isSet(e)&&e.call(o,o.isFailed(t),o.data(t),o.messages(t))}).fail(function(t,e,i){isSet(n)&&n.call(o,e,i)}).always(function(){isSet(i)&&i.call(o)})},KatnissApi.prototype.isFailed=function(t){return isSet(t._success)&&1!=t._success},KatnissApi.prototype.data=function(t){return isSet(t._data)?t._data:null},KatnissApi.prototype.messages=function(t){return new KatnissApiMessages(t._messages)};var _sessionTimeout=null;startSessionTimeout(),$(function(){$(document).on("click",".go-url",function(t){t.preventDefault();var e=$(this).attr("data-url");e&&(window.location.href=e)}).on("click",".open-window",function(t){t.preventDefault();var e=$(this),n=$.extend(e.data()),i="",o="",r=!0,s=null;n.url?(i=n.url,delete n.url):e.is("a")?i=e.attr("href"):e.is("img")&&(i=e.attr("src")),n.name&&(o=n.name,delete n.name),n.replace&&(r=n.replace,delete n.replace),n.callback&&(s=n.callback,delete n.callback);var a=openWindow(i,o,n,r);return s&&"string"==typeof s&&window[s](this,a),!1}),$(".unsigned-integer-input").on("keydown",function(t){return t.which>=48&&t.which<=57||t.which>=96&&t.which<=105||[8,9,13,35,36,37,39,46,144].indexOf(t.which)!=-1}),$(".pop-hover").popover({trigger:"manual",html:!0,animation:!1}).on("mouseenter",function(){var t=this;$(this).popover("show"),$(".popover").on("mouseleave",function(){$(t).popover("hide")})}).on("mouseleave",function(){var t=this;setTimeout(function(){$(".popover:hover").length||$(t).popover("hide")},300)})});
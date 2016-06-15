// Copyright (c) 2009, Baidu Inc. All rights reserved.
// 
// Licensed under the BSD License
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
// 
//      http:// tangram.baidu.com/license.html
// 
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS-IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

/*
 * Tangram
 * Copyright 2009 Baidu Inc. All rights reserved.
 * 
 * path: baidu/json.js
 * author: erik
 * version: 1.1.0
 * date: 2009/12/02
 */

/*
 * Tangram
 * Copyright 2009 Baidu Inc. All rights reserved.
 * 
 * path: baidu/json/parse.js
 * author: erik, berg
 * version: 1.2
 * date: 2009/11/23
 */

/*
 * Tangram
 * Copyright 2009 Baidu Inc. All rights reserved.
 * 
 * path: baidu/json/decode.js
 * author: erik, cat
 * version: 1.3.4
 * date: 2010/12/23
 */

/*
 * Tangram
 * Copyright 2009 Baidu Inc. All rights reserved.
 * 
 * path: baidu/json/stringify.js
 * author: erik
 * version: 1.1.0
 * date: 2010/01/11
 */

/*
 * Tangram
 * Copyright 2009 Baidu Inc. All rights reserved.
 * 
 * path: baidu/json/encode.js
 * author: erik, cat
 * version: 1.3.4
 * date: 2010/12/23
 */

var T,baidu=T=baidu||{version:"1.5.0"};baidu.guid="$BAIDU$",baidu.$$=window[baidu.guid]=window[baidu.guid]||{global:{}},baidu.flash=baidu.flash||{},baidu.dom=baidu.dom||{},baidu.dom.g=function(e){return e?"string"==typeof e||e instanceof String?document.getElementById(e):!e.nodeName||1!=e.nodeType&&9!=e.nodeType?null:e:null},baidu.g=baidu.G=baidu.dom.g,baidu.array=baidu.array||{},baidu.each=baidu.array.forEach=baidu.array.each=function(e,n,a){var t,i,r,o=e.length;if("function"==typeof n)for(r=0;o>r&&(i=e[r],t=n.call(a||e,i,r),t!==!1);r++);return e},baidu.lang=baidu.lang||{},baidu.lang.isFunction=function(e){return"[object Function]"==Object.prototype.toString.call(e)},baidu.lang.isString=function(e){return"[object String]"==Object.prototype.toString.call(e)},baidu.isString=baidu.lang.isString,baidu.browser=baidu.browser||{},baidu.browser.opera=/opera(\/| )(\d+(\.\d+)?)(.+?(version\/(\d+(\.\d+)?)))?/i.test(navigator.userAgent)?+(RegExp.$6||RegExp.$2):void 0,baidu.dom.insertHTML=function(e,n,a){e=baidu.dom.g(e);var t,i;return e.insertAdjacentHTML&&!baidu.browser.opera?e.insertAdjacentHTML(n,a):(t=e.ownerDocument.createRange(),n=n.toUpperCase(),"AFTERBEGIN"==n||"BEFOREEND"==n?(t.selectNodeContents(e),t.collapse("AFTERBEGIN"==n)):(i="BEFOREBEGIN"==n,t[i?"setStartBefore":"setEndAfter"](e),t.collapse(i)),t.insertNode(t.createContextualFragment(a))),e},baidu.insertHTML=baidu.dom.insertHTML,baidu.swf=baidu.swf||{},baidu.swf.version=function(){var e=navigator;if(e.plugins&&e.mimeTypes.length){var n=e.plugins["Shockwave Flash"];if(n&&n.description)return n.description.replace(/([a-zA-Z]|\s)+/,"").replace(/(\s)+r/,".")+".0"}else if(window.ActiveXObject&&!window.opera)for(var a=12;a>=2;a--)try{var t=new ActiveXObject("ShockwaveFlash.ShockwaveFlash."+a);if(t){var i=t.GetVariable("$version");return i.replace(/WIN/g,"").replace(/,/g,".")}}catch(r){}}(),baidu.string=baidu.string||{},baidu.string.encodeHTML=function(e){return String(e).replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;").replace(/'/g,"&#39;")},baidu.encodeHTML=baidu.string.encodeHTML,baidu.swf.createHTML=function(e){e=e||{};var n,a,t,i,r,o,u=baidu.swf.version,l=e.ver||"6.0.0",d={},c=baidu.string.encodeHTML;for(i in e)d[i]=e[i];if(e=d,!u)return"";for(u=u.split("."),l=l.split("."),t=0;3>t&&(n=parseInt(u[t],10),a=parseInt(l[t],10),!(n>a));t++)if(a>n)return"";var s=e.vars,f=["classid","codebase","id","width","height","align"];if(e.align=e.align||"middle",e.classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000",e.codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0",e.movie=e.url||"",delete e.vars,delete e.url,"string"==typeof s)e.flashvars=s;else{var b=[];for(i in s)o=s[i],b.push(i+"="+encodeURIComponent(o));e.flashvars=b.join("&")}var p=["<object "];for(t=0,r=f.length;r>t;t++)o=f[t],p.push(" ",o,'="',c(e[o]),'"');p.push(">");var g={wmode:1,scale:1,quality:1,play:1,loop:1,menu:1,salign:1,bgcolor:1,base:1,allowscriptaccess:1,allownetworking:1,allowfullscreen:1,seamlesstabbing:1,devicefont:1,swliveconnect:1,flashvars:1,movie:1};for(i in e)o=e[i],i=i.toLowerCase(),g[i]&&(o||o===!1||0===o)&&p.push('<param name="'+i+'" value="'+c(o)+'" />');e.src=e.movie,e.name=e.id,delete e.id,delete e.movie,delete e.classid,delete e.codebase,e.type="application/x-shockwave-flash",e.pluginspage="http://www.macromedia.com/go/getflashplayer",p.push("<embed");var m;for(i in e)if(o=e[i],o||o===!1||0===o){if(new RegExp("^salign$","i").test(i)){m=o;continue}p.push(" ",i,'="',c(o),'"')}return m&&p.push(' salign="',c(m),'"'),p.push("></embed></object>"),p.join("")},baidu.swf.create=function(e,n){e=e||{};var a=baidu.swf.createHTML(e)||e.errorMessage||"";n&&"string"==typeof n&&(n=document.getElementById(n)),baidu.dom.insertHTML(n||document.body,"beforeEnd",a)},baidu.browser.ie=baidu.ie=/msie (\d+\.\d+)/i.test(navigator.userAgent)?document.documentMode||+RegExp.$1:void 0,baidu.array.remove=function(e,n){for(var a=e.length;a--;)a in e&&e[a]===n&&e.splice(a,1);return e},baidu.lang.isArray=function(e){return"[object Array]"==Object.prototype.toString.call(e)},baidu.lang.toArray=function(e){if(null===e||void 0===e)return[];if(baidu.lang.isArray(e))return e;if("number"!=typeof e.length||"string"==typeof e||baidu.lang.isFunction(e))return[e];if(e.item){for(var n=e.length,a=new Array(n);n--;)a[n]=e[n];return a}return[].slice.call(e)},baidu.swf.getMovie=function(e){var n,a=document[e];return 9==baidu.browser.ie?a&&a.length?1==(n=baidu.array.remove(baidu.lang.toArray(a),function(e){return"embed"!=e.tagName.toLowerCase()})).length?n[0]:n:a:a||window[e]},baidu.flash._Base=function(){function e(){return r+Math.floor(2147483648*Math.random()).toString(36)}function n(e){return"undefined"!=typeof e&&"undefined"!=typeof e.flashInit&&e.flashInit()?!0:!1}function a(e,n){var a=null;e=e.reverse(),baidu.each(e,function(e){a=n.call(e.fnName,e.params),e.callBack(a)})}function t(n){var a="";return baidu.lang.isFunction(n)?(a=e(),window[a]=function(){n.apply(window,arguments)},a):baidu.lang.isString?n:void 0}function i(n){n.id||(n.id=e());var a=n.container||"";return delete n.container,baidu.swf.create(n,a),baidu.swf.getMovie(n.id)}var r="bd__flash__";return function(e,r){function o(){n(s)&&(clearInterval(p),p=null,u(),f=!0)}function u(){a(b,s),b=[]}var l=this,d="undefined"!=typeof e.autoRender?e.autoRender:!0,c=e.createOptions||{},s=null,f=!1,b=[],p=null,r=r||[];l.render=function(){s=i(c),r.length>0&&baidu.each(r,function(n,a){r[a]=t(e[n]||new Function)}),l.call("setJSFuncName",[r])},l.isReady=function(){return f},l.call=function(e,n,a){if(!e)return null;a=a||new Function;var t=null;f?(t=s.call(e,n),a(t)):(b.push({fnName:e,params:n,callBack:a}),!p&&(p=setInterval(o,200)))},l.createFunName=function(e){return t(e)},d&&l.render()}}(),baidu.flash.imageUploader=baidu.flash.imageUploader||function(e){var n=this,e=e||{},a=new baidu.flash._Base(e,["selectFileCallback","exceedFileCallback","deleteFileCallback","startUploadCallback","uploadCompleteCallback","uploadErrorCallback","allCompleteCallback","changeFlashHeight"]);n.upload=function(){a.call("upload")},n.pause=function(){a.call("pause")},n.addCustomizedParams=function(e,n){a.call("addCustomizedParams",[e,n])}},baidu.object=baidu.object||{},baidu.extend=baidu.object.extend=function(e,n){for(var a in n)n.hasOwnProperty(a)&&(e[a]=n[a]);return e},baidu.flash.fileUploader=baidu.flash.fileUploader||function(e){var n=this,e=e||{};e.createOptions=baidu.extend({wmod:"transparent"},e.createOptions||{});var a=new baidu.flash._Base(e,["selectFile","exceedMaxSize","deleteFile","uploadStart","uploadComplete","uploadError","uploadProgress"]);a.call("setMaxNum",e.maxNum?[e.maxNum]:[1]),n.setHandCursor=function(e){a.call("setHandCursor",[e||!1])},n.setMSFunName=function(e){a.call("setMSFunName",[a.createFunName(e)])},n.upload=function(e,n,t,i){return"string"!=typeof e||"string"!=typeof n?null:("undefined"==typeof i&&(i=-1),void a.call("upload",[e,n,t,i]))},n.cancel=function(e){"undefined"==typeof e&&(e=-1),a.call("cancel",[e])},n.deleteFile=function(e,n){var t=function(e){n&&n(e)};return"undefined"==typeof e?void a.call("deleteFilesAll",[],t):("Number"==typeof e&&(e=[e]),e.sort(function(e,n){return n-e}),void baidu.each(e,function(e){a.call("deleteFileBy",e,t)}))},n.addFileType=function(e){var e=e||[[]];e=e instanceof Array?[e]:[[e]],a.call("addFileTypes",e)},n.setFileType=function(e){var e=e||[[]];e=e instanceof Array?[e]:[[e]],a.call("setFileTypes",e)},n.setMaxNum=function(e){a.call("setMaxNum",[e])},n.setMaxSize=function(e){a.call("setMaxSize",[e])},n.getFileAll=function(e){a.call("getFileAll",[],e)},n.getFileByIndex=function(e,n){a.call("getFileByIndex",[],n)},n.getStatusByIndex=function(e,n){a.call("getStatusByIndex",[],n)}},baidu.sio=baidu.sio||{},baidu.sio._createScriptTag=function(e,n,a){e.setAttribute("type","text/javascript"),a&&e.setAttribute("charset",a),e.setAttribute("src",n),document.getElementsByTagName("head")[0].appendChild(e)},baidu.sio._removeScriptTag=function(e){if(e.clearAttributes)e.clearAttributes();else for(var n in e)e.hasOwnProperty(n)&&delete e[n];e&&e.parentNode&&e.parentNode.removeChild(e),e=null},baidu.sio.callByBrowser=function(e,n,a){var t,i=document.createElement("SCRIPT"),r=0,o=a||{},u=o.charset,l=n||function(){},d=o.timeOut||0;i.onload=i.onreadystatechange=function(){if(!r){var e=i.readyState;if("undefined"==typeof e||"loaded"==e||"complete"==e){r=1;try{l(),clearTimeout(t)}finally{i.onload=i.onreadystatechange=null,baidu.sio._removeScriptTag(i)}}}},d&&(t=setTimeout(function(){i.onload=i.onreadystatechange=null,baidu.sio._removeScriptTag(i),o.onfailure&&o.onfailure()},d)),baidu.sio._createScriptTag(i,e,u)},baidu.sio.callByServer=function(e,n,a){function t(e){return function(){try{e?d.onfailure&&d.onfailure():(n.apply(window,arguments),clearTimeout(r)),window[i]=null,delete window[i]}catch(a){}finally{baidu.sio._removeScriptTag(u)}}}var i,r,o,u=document.createElement("SCRIPT"),l="bd__cbs__",d=a||{},c=d.charset,s=d.queryField||"callback",f=d.timeOut||0,b=new RegExp("(\\?|&)"+s+"=([^&]*)");baidu.lang.isFunction(n)?(i=l+Math.floor(2147483648*Math.random()).toString(36),window[i]=t(0)):baidu.lang.isString(n)?i=n:(o=b.exec(e))&&(i=o[2]),f&&(r=setTimeout(t(1),f)),e=e.replace(b,"$1"+s+"="+i),e.search(b)<0&&(e+=(e.indexOf("?")<0?"?":"&")+s+"="+i),baidu.sio._createScriptTag(u,e,c)},baidu.sio.log=function(e){var n=new Image,a="tangram_sio_log_"+Math.floor(2147483648*Math.random()).toString(36);window[a]=n,n.onload=n.onerror=n.onabort=function(){n.onload=n.onerror=n.onabort=null,window[a]=null,n=null},n.src=e},baidu.json=baidu.json||{},baidu.json.parse=function(e){return new Function("return ("+e+")")()},baidu.json.decode=baidu.json.parse,baidu.json.stringify=function(){function e(e){return/["\\\x00-\x1f]/.test(e)&&(e=e.replace(/["\\\x00-\x1f]/g,function(e){var n=i[e];return n?n:(n=e.charCodeAt(),"\\u00"+Math.floor(n/16).toString(16)+(n%16).toString(16))})),'"'+e+'"'}function n(e){var n,a,t,i=["["],r=e.length;for(a=0;r>a;a++)switch(t=e[a],typeof t){case"undefined":case"function":case"unknown":break;default:n&&i.push(","),i.push(baidu.json.stringify(t)),n=1}return i.push("]"),i.join("")}function a(e){return 10>e?"0"+e:e}function t(e){return'"'+e.getFullYear()+"-"+a(e.getMonth()+1)+"-"+a(e.getDate())+"T"+a(e.getHours())+":"+a(e.getMinutes())+":"+a(e.getSeconds())+'"'}var i={"\b":"\\b","	":"\\t","\n":"\\n","\f":"\\f","\r":"\\r",'"':'\\"',"\\":"\\\\"};return function(a){switch(typeof a){case"undefined":return"undefined";case"number":return isFinite(a)?String(a):"null";case"string":return e(a);case"boolean":return String(a);default:if(null===a)return"null";if(a instanceof Array)return n(a);if(a instanceof Date)return t(a);var i,r,o=["{"],u=baidu.json.stringify;for(var l in a)if(Object.prototype.hasOwnProperty.call(a,l))switch(r=a[l],typeof r){case"undefined":case"unknown":case"function":break;default:i&&o.push(","),i=1,o.push(u(l)+":"+u(r))}return o.push("}"),o.join("")}}}(),baidu.json.encode=baidu.json.stringify;
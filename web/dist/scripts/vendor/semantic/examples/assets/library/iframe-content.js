!function(){"use strict";function e(e,t,n){"addEventListener"in window?e.addEventListener(t,n,!1):"attachEvent"in window&&e.attachEvent("on"+t,n)}function t(e){return ee+"["+ne+"] "+e}function n(e){_&&"object"==typeof window.console&&console.log(t(e))}function o(e){"object"==typeof window.console&&console.warn(t(e))}function i(){n("Initialising iFrame"),r(),c(),u("background",B),u("padding",V),g(),f(),l(),p(),m(),Q=v(),x("init","Init message from host page")}function r(){function e(e){return"true"===e?!0:!1}var t=G.substr(te).split(":");ne=t[0],D=void 0!==t[1]?Number(t[1]):D,W=void 0!==t[2]?e(t[2]):W,_=void 0!==t[3]?e(t[3]):_,Z=void 0!==t[4]?Number(t[4]):Z,oe=void 0!==t[5]?e(t[5]):oe,H=void 0!==t[6]?e(t[6]):H,q=t[7],K=void 0!==t[8]?t[8]:K,B=t[9],V=t[10],ce=void 0!==t[11]?Number(t[11]):ce,Q.enable=void 0!==t[12]?e(t[12]):!1,re=t[13]}function a(e,t){return-1!==t.indexOf("-")&&(o("Negative CSS value ignored for "+e),t=""),t}function u(e,t){void 0!==t&&""!==t&&"null"!==t&&(document.body.style[e]=t,n("Body "+e+' set to "'+t+'"'))}function c(){void 0===q&&(q=D+"px"),a("margin",q),u("margin",q)}function l(){document.documentElement.style.height="",document.body.style.height="",n('HTML & body height set to "auto"')}function s(t){function o(n){e(window,n,function(e){x(t.eventName,t.eventType)})}t.eventNames&&Array.prototype.map?(t.eventName=t.eventNames[0],t.eventNames.map(o)):o(t.eventName),n("Added event listener: "+t.eventType)}function d(){s({eventType:"Animation Start",eventNames:["animationstart","webkitAnimationStart"]}),s({eventType:"Animation Iteration",eventNames:["animationiteration","webkitAnimationIteration"]}),s({eventType:"Animation End",eventNames:["animationend","webkitAnimationEnd"]}),s({eventType:"Device Orientation Change",eventName:"deviceorientation"}),s({eventType:"Transition End",eventNames:["transitionend","webkitTransitionEnd","MSTransitionEnd","oTransitionEnd","otransitionend"]}),s({eventType:"Window Clicked",eventName:"click"}),"child"===re&&s({eventType:"IFrame Resized",eventName:"resize"})}function f(){J!==K&&(K in fe||(o(K+" is not a valid option for heightCalculationMethod."),K="bodyScroll"),n('Height calculation method set to "'+K+'"'))}function m(){!0===H?(d(),b()):n("Auto Resize disabled")}function g(){var e=document.createElement("div");e.style.clear="both",e.style.display="block",document.body.appendChild(e)}function v(){function t(){return{x:void 0!==window.pageXOffset?window.pageXOffset:document.documentElement.scrollLeft,y:void 0!==window.pageYOffset?window.pageYOffset:document.documentElement.scrollTop}}function i(e){var n=e.getBoundingClientRect(),o=t();return{x:parseInt(n.left,10)+parseInt(o.x,10),y:parseInt(n.top,10)+parseInt(o.y,10)}}function r(e){function t(e){var t=i(e);n("Moving to in page link (#"+o+") at x: "+t.x+" y: "+t.y),R(t.y,t.x,"scrollToOffset")}var o=e.split("#")[1]||"",r=decodeURIComponent(o),a=document.getElementById(r)||document.getElementsByName(r)[0];a?t(a):(n("In page link (#"+o+") not found in iFrame, so sending to parent"),R(0,0,"inPageLink","#"+o))}function a(){""!==location.hash&&"#"!==location.hash&&r(location.href)}function u(){function t(t){function n(e){e.preventDefault(),r(this.getAttribute("href"))}"#"!==t.getAttribute("href")&&e(t,"click",n)}Array.prototype.forEach.call(document.querySelectorAll('a[href^="#"]'),t)}function c(){e(window,"hashchange",a)}function l(){setTimeout(a,U)}function s(){Array.prototype.forEach&&document.querySelectorAll?(n("Setting up location.hash handlers"),u(),c(),l()):o("In page linking not fully supported in this browser! (See README.md for IE8 workaround)")}return Q.enable?s():n("In page linking not enabled"),{findTarget:r}}function p(){oe&&(n("Enable public methods"),window.parentIFrame={close:function(){R(0,0,"close")},getId:function(){return ne},moveToAnchor:function(e){Q.findTarget(e)},reset:function(){L("parentIFrame.reset")},scrollTo:function(e,t){R(t,e,"scrollTo")},scrollToOffset:function(e,t){R(t,e,"scrollToOffset")},sendMessage:function(e,t){R(0,0,"message",JSON.stringify(e),t)},setHeightCalculationMethod:function(e){K=e,f()},setTargetOrigin:function(e){n("Set targetOrigin: "+e),ae=e},size:function(e,t){var n=""+(e?e:"")+(t?","+t:"");z(),x("size","parentIFrame.size("+n+")",e,t)}})}function y(){0!==Z&&(n("setInterval: "+Z+"ms"),setInterval(function(){x("interval","setInterval: "+Z)},Math.abs(Z)))}function h(t){function o(t){(void 0===t.height||void 0===t.width||0===t.height||0===t.width)&&(n("Attach listerner to "+t.src),e(t,"load",function(){x("imageLoad","Image loaded")}))}t.forEach(function(e){if("attributes"===e.type&&"src"===e.attributeName)o(e.target);else if("childList"===e.type){var t=e.target.querySelectorAll("img");Array.prototype.forEach.call(t,function(e){o(e)})}})}function b(){function e(){var e=document.querySelector("body"),o={attributes:!0,attributeOldValue:!1,characterData:!0,characterDataOldValue:!1,childList:!0,subtree:!0},i=new t(function(e){x("mutationObserver","mutationObserver: "+e[0].target+" "+e[0].type),h(e)});n("Enable MutationObserver"),i.observe(e,o)}var t=window.MutationObserver||window.WebKitMutationObserver;t?0>Z?y():e():(o("MutationObserver not supported in this browser!"),y())}function w(){function e(e){function t(e){var t=/^\d+(px)?$/i;if(t.test(e))return parseInt(e,P);var o=n.style.left,i=n.runtimeStyle.left;return n.runtimeStyle.left=n.currentStyle.left,n.style.left=e||0,e=n.style.pixelLeft,n.style.left=o,n.runtimeStyle.left=i,e}var n=document.body,o=0;return"defaultView"in document&&"getComputedStyle"in document.defaultView?(o=document.defaultView.getComputedStyle(n,null),o=null!==o?o[e]:0):o=t(n.currentStyle[e]),parseInt(o,P)}return document.body.offsetHeight+e("marginTop")+e("marginBottom")}function T(){return document.body.scrollHeight}function E(){return document.documentElement.offsetHeight}function S(){return document.documentElement.scrollHeight}function I(){for(var e=document.querySelectorAll("body *"),t=e.length,o=0,i=(new Date).getTime(),r=0;t>r;r++)e[r].getBoundingClientRect().bottom>o&&(o=e[r].getBoundingClientRect().bottom);return i=(new Date).getTime()-i,n("Parsed "+t+" HTML elements"),n("LowestElement bottom position calculated in "+i+"ms"),o}function O(){return[w(),T(),E(),S()]}function A(){return Math.max.apply(null,O())}function N(){return Math.min.apply(null,O())}function M(){return Math.max(w(),I())}function k(){return Math.max(document.documentElement.scrollWidth,document.body.scrollWidth)}function x(e,t,o,i){function r(){e in{reset:1,resetPage:1,init:1}||n("Trigger event: "+t)}function a(){X=m,de=g,R(X,de,e)}function u(){return le&&e in j}function c(){function e(e,t){var n=Math.abs(e-t)<=ce;return!n}return m=void 0!==o?o:fe[K](),g=void 0!==i?i:k(),e(X,m)||W&&e(de,g)}function l(){return!(e in{init:1,interval:1,size:1})}function s(){return K in ie}function d(){n("No change in size detected")}function f(){l()&&s()?L(t):e in{interval:1}||(r(),d())}var m,g;u()?n("Trigger event cancelled: "+e):c()?(r(),z(),a()):f()}function z(){le||(le=!0,n("Trigger event lock on")),clearTimeout(se),se=setTimeout(function(){le=!1,n("Trigger event lock off"),n("--")},U)}function C(e){X=fe[K](),de=k(),R(X,de,e)}function L(e){var t=K;K=J,n("Reset trigger event: "+e),z(),C("reset"),K=t}function R(e,t,o,i,r){function a(){void 0===r?r=ae:n("Message targetOrigin: "+r)}function u(){var a=e+":"+t,u=ne+":"+a+":"+o+(void 0!==i?":"+i:"");n("Sending message to host page ("+u+")"),ue.postMessage(ee+u,r)}a(),u()}function F(e){function t(){return ee===(""+e.data).substr(0,te)}function r(){G=e.data,ue=e.source,i(),Y=!1,setTimeout(function(){$=!1},U)}function a(){$?n("Page reset ignored by init"):(n("Page size reset by host page"),C("resetPage"))}function u(){x("resizeParent","Parent window resized")}function c(){return e.data.split("]")[1]}function l(){return"iFrameResize"in window}function s(){return e.data.split(":")[2]in{"true":1,"false":1}}t()&&(Y===!1?"reset"===c()?a():"resize"===c()?u():e.data===G||l()||o("Unexpected message ("+e.data+")"):s()?r():o("Received message of type ("+c()+") before initialization."))}var H=!0,P=10,B="",D=0,q="",V="",W=!1,j={resize:1,click:1},U=128,X=1,Y=!0,J="offset",K=J,$=!0,G="",Q={},Z=32,_=!1,ee="[iFrameSizer]",te=ee.length,ne="",oe=!1,ie={max:1,scroll:1,bodyScroll:1,documentElementScroll:1},re="parent",ae="*",ue=window.parent,ce=0,le=!1,se=null,de=1,fe={offset:w,bodyOffset:w,bodyScroll:T,documentElementOffset:E,scroll:S,documentElementScroll:S,max:A,min:N,grow:A,lowestElement:M};e(window,"message",F)}();
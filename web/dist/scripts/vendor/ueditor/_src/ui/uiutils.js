!function(){function e(){var e=document.getElementById("edui_fixedlayer");a.setViewportOffset(e,{left:0,top:0})}function t(t){o.on(window,"scroll",e),o.on(window,"resize",baidu.editor.utils.defer(e,0,!0))}var n=baidu.editor.browser,o=baidu.editor.dom.domUtils,i="$EDITORUI",r=window[i]={},l="ID"+i,s=0,a=baidu.editor.ui.uiUtils={uid:function(e){return e?e[l]||(e[l]=++s):++s},hook:function(e,t){var n;return e&&e._callbacks?n=e:(n=function(){var t;e&&(t=e.apply(this,arguments));for(var o=n._callbacks,i=o.length;i--;){var r=o[i].apply(this,arguments);void 0===t&&(t=r)}return t},n._callbacks=[]),n._callbacks.push(t),n},createElementByHtml:function(e){var t=document.createElement("div");return t.innerHTML=e,t=t.firstChild,t.parentNode.removeChild(t),t},getViewportElement:function(){return n.ie&&n.quirks?document.body:document.documentElement},getClientRect:function(e){var t;try{t=e.getBoundingClientRect()}catch(n){t={left:0,top:0,height:0,width:0}}for(var i,r={left:Math.round(t.left),top:Math.round(t.top),height:Math.round(t.bottom-t.top),width:Math.round(t.right-t.left)};(i=e.ownerDocument)!==document&&(e=o.getWindow(i).frameElement);)t=e.getBoundingClientRect(),r.left+=t.left,r.top+=t.top;return r.bottom=r.top+r.height,r.right=r.left+r.width,r},getViewportRect:function(){var e=a.getViewportElement(),t=0|(window.innerWidth||e.clientWidth),n=0|(window.innerHeight||e.clientHeight);return{left:0,top:0,height:n,width:t,bottom:n,right:t}},setViewportOffset:function(e,t){var n=a.getFixedLayer();e.parentNode===n?(e.style.left=t.left+"px",e.style.top=t.top+"px"):o.setViewportOffset(e,t)},getEventOffset:function(e){var t=e.target||e.srcElement,n=a.getClientRect(t),o=a.getViewportOffsetByEvent(e);return{left:o.left-n.left,top:o.top-n.top}},getViewportOffsetByEvent:function(e){var t=e.target||e.srcElement,n=o.getWindow(t).frameElement,i={left:e.clientX,top:e.clientY};if(n&&t.ownerDocument!==document){var r=a.getClientRect(n);i.left+=r.left,i.top+=r.top}return i},setGlobal:function(e,t){return r[e]=t,i+'["'+e+'"]'},unsetGlobal:function(e){delete r[e]},copyAttributes:function(e,t){for(var i=t.attributes,r=i.length;r--;){var l=i[r];"style"==l.nodeName||"class"==l.nodeName||n.ie&&!l.specified||e.setAttribute(l.nodeName,l.nodeValue)}t.className&&o.addClass(e,t.className),t.style.cssText&&(e.style.cssText+=";"+t.style.cssText)},removeStyle:function(e,t){if(e.style.removeProperty)e.style.removeProperty(t);else{if(!e.style.removeAttribute)throw"";e.style.removeAttribute(t)}},contains:function(e,t){return e&&t&&(e===t?!1:e.contains?e.contains(t):16&e.compareDocumentPosition(t))},startDrag:function(e,t,n){function o(e){var n=e.clientX-l,o=e.clientY-s;t.ondragmove(n,o,e),e.stopPropagation?e.stopPropagation():e.cancelBubble=!0}function i(e){n.removeEventListener("mousemove",o,!0),n.removeEventListener("mouseup",i,!0),window.removeEventListener("mouseup",i,!0),t.ondragstop()}function r(){a.releaseCapture(),a.detachEvent("onmousemove",o),a.detachEvent("onmouseup",r),a.detachEvent("onlosecaptrue",r),t.ondragstop()}var n=n||document,l=e.clientX,s=e.clientY;if(n.addEventListener)n.addEventListener("mousemove",o,!0),n.addEventListener("mouseup",i,!0),window.addEventListener("mouseup",i,!0),e.preventDefault();else{var a=e.srcElement;a.setCapture(),a.attachEvent("onmousemove",o),a.attachEvent("onmouseup",r),a.attachEvent("onlosecaptrue",r),e.returnValue=!1}t.ondragstart()},getFixedLayer:function(){var o=document.getElementById("edui_fixedlayer");return null==o&&(o=document.createElement("div"),o.id="edui_fixedlayer",document.body.appendChild(o),n.ie&&n.version<=8?(o.style.position="absolute",t(),setTimeout(e)):o.style.position="fixed",o.style.left="0",o.style.top="0",o.style.width="0",o.style.height="0"),o},makeUnselectable:function(e){if(n.opera||n.ie&&n.version<9){if(e.unselectable="on",e.hasChildNodes())for(var t=0;t<e.childNodes.length;t++)1==e.childNodes[t].nodeType&&a.makeUnselectable(e.childNodes[t])}else void 0!==e.style.MozUserSelect?e.style.MozUserSelect="none":void 0!==e.style.WebkitUserSelect?e.style.WebkitUserSelect="none":void 0!==e.style.KhtmlUserSelect&&(e.style.KhtmlUserSelect="none")}}}();
function getDomNode(e,t,r,i,n,o){var s,l=i&&e[t];for(!l&&(l=e[r]);!l&&(s=(s||e).parentNode);){if("BODY"==s.tagName||o&&!o(s))return null;l=s[r]}return l&&n&&!n(l)?getDomNode(l,t,r,!1,n):l}var attrFix=ie&&browser.version<9?{tabindex:"tabIndex",readonly:"readOnly","for":"htmlFor","class":"className",maxlength:"maxLength",cellspacing:"cellSpacing",cellpadding:"cellPadding",rowspan:"rowSpan",colspan:"colSpan",usemap:"useMap",frameborder:"frameBorder"}:{tabindex:"tabIndex",readonly:"readOnly"},styleBlock=utils.listToMap(["-webkit-box","-moz-box","block","list-item","table","table-row-group","table-header-group","table-footer-group","table-row","table-column-group","table-column","table-cell","table-caption"]),domUtils=dom.domUtils={NODE_ELEMENT:1,NODE_DOCUMENT:9,NODE_TEXT:3,NODE_COMMENT:8,NODE_DOCUMENT_FRAGMENT:11,POSITION_IDENTICAL:0,POSITION_DISCONNECTED:1,POSITION_FOLLOWING:2,POSITION_PRECEDING:4,POSITION_IS_CONTAINED:8,POSITION_CONTAINS:16,fillChar:ie&&"6"==browser.version?"\ufeff":"​",keys:{8:1,46:1,16:1,17:1,18:1,37:1,38:1,39:1,40:1,13:1},getPosition:function(e,t){if(e===t)return 0;var r,i=[e],n=[t];for(r=e;r=r.parentNode;){if(r===t)return 10;i.push(r)}for(r=t;r=r.parentNode;){if(r===e)return 20;n.push(r)}if(i.reverse(),n.reverse(),i[0]!==n[0])return 1;for(var o=-1;o++,i[o]===n[o];);for(e=i[o],t=n[o];e=e.nextSibling;)if(e===t)return 4;return 2},getNodeIndex:function(e,t){for(var r=e,i=0;r=r.previousSibling;)t&&3==r.nodeType?r.nodeType!=r.nextSibling.nodeType&&i++:i++;return i},inDoc:function(e,t){return 10==domUtils.getPosition(e,t)},findParent:function(e,t,r){if(e&&!domUtils.isBody(e))for(e=r?e:e.parentNode;e;){if(!t||t(e)||domUtils.isBody(e))return t&&!t(e)&&domUtils.isBody(e)?null:e;e=e.parentNode}return null},findParentByTagName:function(e,t,r,i){return t=utils.listToMap(utils.isArray(t)?t:[t]),domUtils.findParent(e,function(e){return t[e.tagName]&&!(i&&i(e))},r)},findParents:function(e,t,r,i){for(var n=t&&(r&&r(e)||!r)?[e]:[];e=domUtils.findParent(e,r);)n.push(e);return i?n:n.reverse()},insertAfter:function(e,t){return e.nextSibling?e.parentNode.insertBefore(t,e.nextSibling):e.parentNode.appendChild(t)},remove:function(e,t){var r,i=e.parentNode;if(i){if(t&&e.hasChildNodes())for(;r=e.firstChild;)i.insertBefore(r,e);i.removeChild(e)}return e},getNextDomNode:function(e,t,r,i){return getDomNode(e,"firstChild","nextSibling",t,r,i)},getPreDomNode:function(e,t,r,i){return getDomNode(e,"lastChild","previousSibling",t,r,i)},isBookmarkNode:function(e){return 1==e.nodeType&&e.id&&/^_baidu_bookmark_/i.test(e.id)},getWindow:function(e){var t=e.ownerDocument||e;return t.defaultView||t.parentWindow},getCommonAncestor:function(e,t){if(e===t)return e;for(var r=[e],i=[t],n=e,o=-1;n=n.parentNode;){if(n===t)return n;r.push(n)}for(n=t;n=n.parentNode;){if(n===e)return n;i.push(n)}for(r.reverse(),i.reverse();o++,r[o]===i[o];);return 0==o?null:r[o-1]},clearEmptySibling:function(e,t,r){function i(e,t){for(var r;e&&!domUtils.isBookmarkNode(e)&&(domUtils.isEmptyInlineElement(e)||!new RegExp("[^	\n\r"+domUtils.fillChar+"]").test(e.nodeValue));)r=e[t],domUtils.remove(e),e=r}!t&&i(e.nextSibling,"nextSibling"),!r&&i(e.previousSibling,"previousSibling")},split:function(e,t){var r=e.ownerDocument;if(browser.ie&&t==e.nodeValue.length){var i=r.createTextNode("");return domUtils.insertAfter(e,i)}var n=e.splitText(t);if(browser.ie8){var o=r.createTextNode("");domUtils.insertAfter(n,o),domUtils.remove(o)}return n},isWhitespace:function(e){return!new RegExp("[^ 	\n\r"+domUtils.fillChar+"]").test(e.nodeValue)},getXY:function(e){for(var t=0,r=0;e.offsetParent;)r+=e.offsetTop,t+=e.offsetLeft,e=e.offsetParent;return{x:t,y:r}},on:function(e,t,r){var i=utils.isArray(t)?t:utils.trim(t).split(/\s+/),n=i.length;if(n)for(;n--;)if(t=i[n],e.addEventListener)e.addEventListener(t,r,!1);else{r._d||(r._d={els:[]});var o=t+r.toString(),s=utils.indexOf(r._d.els,e);r._d[o]&&-1!=s||(-1==s&&r._d.els.push(e),r._d[o]||(r._d[o]=function(e){return r.call(e.srcElement,e||window.event)}),e.attachEvent("on"+t,r._d[o]))}e=null},un:function(e,t,r){var i=utils.isArray(t)?t:utils.trim(t).split(/\s+/),n=i.length;if(n)for(;n--;)if(t=i[n],e.removeEventListener)e.removeEventListener(t,r,!1);else{var o=t+r.toString();try{e.detachEvent("on"+t,r._d?r._d[o]:r)}catch(s){}if(r._d&&r._d[o]){var l=utils.indexOf(r._d.els,e);-1!=l&&r._d.els.splice(l,1),0==r._d.els.length&&delete r._d[o]}}},isSameElement:function(e,t){if(e.tagName!=t.tagName)return!1;var r=e.attributes,i=t.attributes;if(!ie&&r.length!=i.length)return!1;for(var n,o,s=0,l=0,a=0;n=r[a++];){if("style"==n.nodeName){if(n.specified&&s++,domUtils.isSameStyle(e,t))continue;return!1}if(ie){if(!n.specified)continue;s++,o=i.getNamedItem(n.nodeName)}else o=t.attributes[n.nodeName];if(!o.specified||n.nodeValue!=o.nodeValue)return!1}if(ie){for(a=0;o=i[a++];)o.specified&&l++;if(s!=l)return!1}return!0},isSameStyle:function(e,t){var r=e.style.cssText.replace(/( ?; ?)/g,";").replace(/( ?: ?)/g,":"),i=t.style.cssText.replace(/( ?; ?)/g,";").replace(/( ?: ?)/g,":");if(browser.opera){if(r=e.style,i=t.style,r.length!=i.length)return!1;for(var n in r)if(!/^(\d+|csstext)$/i.test(n)&&r[n]!=i[n])return!1;return!0}if(!r||!i)return r==i;if(r=r.split(";"),i=i.split(";"),r.length!=i.length)return!1;for(var o,s=0;o=r[s++];)if(-1==utils.indexOf(i,o))return!1;return!0},isBlockElm:function(e){return 1==e.nodeType&&(dtd.$block[e.tagName]||styleBlock[domUtils.getComputedStyle(e,"display")])&&!dtd.$nonChild[e.tagName]},isBody:function(e){return e&&1==e.nodeType&&"body"==e.tagName.toLowerCase()},breakParent:function(e,t){var r,i,n,o=e,s=e;do{for(o=o.parentNode,i?(r=o.cloneNode(!1),r.appendChild(i),i=r,r=o.cloneNode(!1),r.appendChild(n),n=r):(i=o.cloneNode(!1),n=i.cloneNode(!1));r=s.previousSibling;)i.insertBefore(r,i.firstChild);for(;r=s.nextSibling;)n.appendChild(r);s=o}while(t!==o);return r=t.parentNode,r.insertBefore(i,t),r.insertBefore(n,t),r.insertBefore(e,n),domUtils.remove(t),e},isEmptyInlineElement:function(e){if(1!=e.nodeType||!dtd.$removeEmpty[e.tagName])return 0;for(e=e.firstChild;e;){if(domUtils.isBookmarkNode(e))return 0;if(1==e.nodeType&&!domUtils.isEmptyInlineElement(e)||3==e.nodeType&&!domUtils.isWhitespace(e))return 0;e=e.nextSibling}return 1},trimWhiteTextNode:function(e){function t(t){for(var r;(r=e[t])&&3==r.nodeType&&domUtils.isWhitespace(r);)e.removeChild(r)}t("firstChild"),t("lastChild")},mergeChild:function(e,t,r){for(var i,n=domUtils.getElementsByTagName(e,e.tagName.toLowerCase()),o=0;i=n[o++];)if(i.parentNode&&!domUtils.isBookmarkNode(i))if("span"!=i.tagName.toLowerCase())domUtils.isSameElement(e,i)&&domUtils.remove(i,!0);else{if(e===i.parentNode&&(domUtils.trimWhiteTextNode(e),1==e.childNodes.length)){e.style.cssText=i.style.cssText+";"+e.style.cssText,domUtils.remove(i,!0);continue}if(i.style.cssText=e.style.cssText+";"+i.style.cssText,r){var s=r.style;if(s){s=s.split(";");for(var l,a=0;l=s[a++];)i.style[utils.cssStyleToDomStyle(l.split(":")[0])]=l.split(":")[1]}}domUtils.isSameStyle(i,e)&&domUtils.remove(i,!0)}},getElementsByTagName:function(e,t,r){if(r&&utils.isString(r)){var i=r;r=function(e){return domUtils.hasClass(e,i)}}t=utils.trim(t).replace(/[ ]{2,}/g," ").split(" ");for(var n,o=[],s=0;n=t[s++];)for(var l,a=e.getElementsByTagName(n),d=0;l=a[d++];)(!r||r(l))&&o.push(l);return o},mergeToParent:function(e){for(var t=e.parentNode;t&&dtd.$removeEmpty[t.tagName];){if(t.tagName==e.tagName||"A"==t.tagName){if(domUtils.trimWhiteTextNode(t),"SPAN"==t.tagName&&!domUtils.isSameStyle(t,e)||"A"==t.tagName&&"SPAN"==e.tagName){if(t.childNodes.length>1||t!==e.parentNode){e.style.cssText=t.style.cssText+";"+e.style.cssText,t=t.parentNode;continue}t.style.cssText+=";"+e.style.cssText,"A"==t.tagName&&(t.style.textDecoration="underline")}if("A"!=t.tagName){t===e.parentNode&&domUtils.remove(e,!0);break}}t=t.parentNode}},mergeSibling:function(e,t,r){function i(e,t,r){var i;if((i=r[e])&&!domUtils.isBookmarkNode(i)&&1==i.nodeType&&domUtils.isSameElement(r,i)){for(;i.firstChild;)"firstChild"==t?r.insertBefore(i.lastChild,r.firstChild):r.appendChild(i.firstChild);domUtils.remove(i)}}!t&&i("previousSibling","firstChild",e),!r&&i("nextSibling","lastChild",e)},unSelectable:ie&&browser.ie9below||browser.opera?function(e){e.onselectstart=function(){return!1},e.onclick=e.onkeyup=e.onkeydown=function(){return!1},e.unselectable="on",e.setAttribute("unselectable","on");for(var t,r=0;t=e.all[r++];)switch(t.tagName.toLowerCase()){case"iframe":case"textarea":case"input":case"select":break;default:t.unselectable="on",e.setAttribute("unselectable","on")}}:function(e){e.style.MozUserSelect=e.style.webkitUserSelect=e.style.msUserSelect=e.style.KhtmlUserSelect="none"},removeAttributes:function(e,t){t=utils.isArray(t)?t:utils.trim(t).replace(/[ ]{2,}/g," ").split(" ");for(var r,i=0;r=t[i++];){switch(r=attrFix[r]||r){case"className":e[r]="";break;case"style":e.style.cssText="";var n=e.getAttributeNode("style");!browser.ie&&n&&e.removeAttributeNode(n)}e.removeAttribute(r)}},createElement:function(e,t,r){return domUtils.setAttributes(e.createElement(t),r)},setAttributes:function(e,t){for(var r in t)if(t.hasOwnProperty(r)){var i=t[r];switch(r){case"class":e.className=i;break;case"style":e.style.cssText=e.style.cssText+";"+i;break;case"innerHTML":e[r]=i;break;case"value":e.value=i;break;default:e.setAttribute(attrFix[r]||r,i)}}return e},getComputedStyle:function(e,t){var r="width height top left";if(r.indexOf(t)>-1)return e["offset"+t.replace(/^\w/,function(e){return e.toUpperCase()})]+"px";if(3==e.nodeType&&(e=e.parentNode),browser.ie&&browser.version<9&&"font-size"==t&&!e.style.fontSize&&!dtd.$empty[e.tagName]&&!dtd.$nonChild[e.tagName]){var i=e.ownerDocument.createElement("span");i.style.cssText="padding:0;border:0;font-family:simsun;",i.innerHTML=".",e.appendChild(i);var n=i.offsetHeight;return e.removeChild(i),i=null,n+"px"}try{var o=domUtils.getStyle(e,t)||(window.getComputedStyle?domUtils.getWindow(e).getComputedStyle(e,"").getPropertyValue(t):(e.currentStyle||e.style)[utils.cssStyleToDomStyle(t)])}catch(s){return""}return utils.transUnitToPx(utils.fixColor(t,o))},removeClasses:function(e,t){t=utils.isArray(t)?t:utils.trim(t).replace(/[ ]{2,}/g," ").split(" ");for(var r,i=0,n=e.className;r=t[i++];)n=n.replace(new RegExp("\\b"+r+"\\b"),"");n=utils.trim(n).replace(/[ ]{2,}/g," "),n?e.className=n:domUtils.removeAttributes(e,["class"])},addClass:function(e,t){if(e){t=utils.trim(t).replace(/[ ]{2,}/g," ").split(" ");for(var r,i=0,n=e.className;r=t[i++];)new RegExp("\\b"+r+"\\b").test(n)||(n+=" "+r);e.className=utils.trim(n)}},hasClass:function(e,t){if(utils.isRegExp(t))return t.test(e.className);t=utils.trim(t).replace(/[ ]{2,}/g," ").split(" ");for(var r,i=0,n=e.className;r=t[i++];)if(!new RegExp("\\b"+r+"\\b","i").test(n))return!1;return i-1==t.length},preventDefault:function(e){e.preventDefault?e.preventDefault():e.returnValue=!1},removeStyle:function(e,t){browser.ie?("color"==t&&(t="(^|;)"+t),e.style.cssText=e.style.cssText.replace(new RegExp(t+"[^:]*:[^;]+;?","ig"),"")):e.style.removeProperty?e.style.removeProperty(t):e.style.removeAttribute(utils.cssStyleToDomStyle(t)),e.style.cssText||domUtils.removeAttributes(e,["style"])},getStyle:function(e,t){var r=e.style[utils.cssStyleToDomStyle(t)];return utils.fixColor(t,r)},setStyle:function(e,t,r){e.style[utils.cssStyleToDomStyle(t)]=r,utils.trim(e.style.cssText)||this.removeAttributes(e,"style")},setStyles:function(e,t){for(var r in t)t.hasOwnProperty(r)&&domUtils.setStyle(e,r,t[r])},removeDirtyAttr:function(e){for(var t,r=0,i=e.getElementsByTagName("*");t=i[r++];)t.removeAttribute("_moz_dirty");e.removeAttribute("_moz_dirty")},getChildCount:function(e,t){var r=0,i=e.firstChild;for(t=t||function(){return 1};i;)t(i)&&r++,i=i.nextSibling;return r},isEmptyNode:function(e){return!e.firstChild||0==domUtils.getChildCount(e,function(e){return!domUtils.isBr(e)&&!domUtils.isBookmarkNode(e)&&!domUtils.isWhitespace(e)})},clearSelectedArr:function(e){for(var t;t=e.pop();)domUtils.removeAttributes(t,["class"])},scrollToView:function(e,t,r){var i=function(){var e=t.document,r="CSS1Compat"==e.compatMode;return{width:(r?e.documentElement.clientWidth:e.body.clientWidth)||0,height:(r?e.documentElement.clientHeight:e.body.clientHeight)||0}},n=function(e){if("pageXOffset"in e)return{x:e.pageXOffset||0,y:e.pageYOffset||0};var t=e.document;return{x:t.documentElement.scrollLeft||t.body.scrollLeft||0,y:t.documentElement.scrollTop||t.body.scrollTop||0}},o=i().height,s=-1*o+r;s+=e.offsetHeight||0;var l=domUtils.getXY(e);s+=l.y;var a=n(t).y;(s>a||a-o>s)&&t.scrollTo(0,s+(0>s?-20:20))},isBr:function(e){return 1==e.nodeType&&"BR"==e.tagName},isFillChar:function(e,t){if(3!=e.nodeType)return!1;var r=e.nodeValue;return t?new RegExp("^"+domUtils.fillChar).test(r):!r.replace(new RegExp(domUtils.fillChar,"g"),"").length},isStartInblock:function(e){var t,r=e.cloneRange(),i=0,n=r.startContainer;if(1==n.nodeType&&n.childNodes[r.startOffset]){n=n.childNodes[r.startOffset];for(var o=n.previousSibling;o&&domUtils.isFillChar(o);)n=o,o=o.previousSibling}for(this.isFillChar(n,!0)&&1==r.startOffset&&(r.setStartBefore(n),n=r.startContainer);n&&domUtils.isFillChar(n);)t=n,n=n.previousSibling;for(t&&(r.setStartBefore(t),n=r.startContainer),1==n.nodeType&&domUtils.isEmptyNode(n)&&1==r.startOffset&&r.setStart(n,0).collapse(!0);!r.startOffset;){if(n=r.startContainer,domUtils.isBlockElm(n)||domUtils.isBody(n)){i=1;break}var s,o=r.startContainer.previousSibling;if(o){for(;o&&domUtils.isFillChar(o);)s=o,o=o.previousSibling;s?r.setStartBefore(s):r.setStartBefore(r.startContainer)}else r.setStartBefore(r.startContainer)}return i&&!domUtils.isBody(r.startContainer)?1:0},isEmptyBlock:function(e,t){if(1!=e.nodeType)return 0;if(t=t||new RegExp("[  	\r\n"+domUtils.fillChar+"]","g"),e[browser.ie?"innerText":"textContent"].replace(t,"").length>0)return 0;for(var r in dtd.$isNotEmpty)if(e.getElementsByTagName(r).length)return 0;return 1},setViewportOffset:function(e,t){var r=0|parseInt(e.style.left),i=0|parseInt(e.style.top),n=e.getBoundingClientRect(),o=t.left-n.left,s=t.top-n.top;o&&(e.style.left=r+o+"px"),s&&(e.style.top=i+s+"px")},fillNode:function(e,t){var r=browser.ie?e.createTextNode(domUtils.fillChar):e.createElement("br");t.innerHTML="",t.appendChild(r)},moveChild:function(e,t,r){for(;e.firstChild;)r&&t.firstChild?t.insertBefore(e.lastChild,t.firstChild):t.appendChild(e.firstChild)},hasNoAttributes:function(e){return browser.ie?/^<\w+\s*?>/.test(e.outerHTML):0==e.attributes.length},isCustomeNode:function(e){return 1==e.nodeType&&e.getAttribute("_ue_custom_node_")},isTagNode:function(e,t){return 1==e.nodeType&&new RegExp("\\b"+e.tagName+"\\b","i").test(t)},filterNodeList:function(e,t,r){var i=[];if(!utils.isFunction(t)){var n=t;t=function(e){return-1!=utils.indexOf(utils.isArray(n)?n:n.split(" "),e.tagName.toLowerCase())}}return utils.each(e,function(e){t(e)&&i.push(e)}),0==i.length?null:1!=i.length&&r?i:i[0]},isInNodeEndBoundary:function(e,t){var r=e.startContainer;if(3==r.nodeType&&e.startOffset!=r.nodeValue.length)return 0;if(1==r.nodeType&&e.startOffset!=r.childNodes.length)return 0;for(;r!==t;){if(r.nextSibling)return 0;r=r.parentNode}return 1},isBoundaryNode:function(e,t){for(var r;!domUtils.isBody(e);)if(r=e,e=e.parentNode,r!==e[t])return!1;return!0},fillHtml:browser.ie11below?"&nbsp;":"<br/>"},fillCharReg=new RegExp(domUtils.fillChar,"g");
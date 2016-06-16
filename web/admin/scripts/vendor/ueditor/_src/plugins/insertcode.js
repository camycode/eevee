UE.plugins.insertcode=function(){var e=this;e.ready(function(){utils.cssRule("pre","pre{margin:.5em 0;padding:.4em .6em;border-radius:8px;background:#f8f8f8;}",e.document)}),e.setOpt("insertcode",{as3:"ActionScript3",bash:"Bash/Shell",cpp:"C/C++",css:"Css",cf:"CodeFunction","c#":"C#",delphi:"Delphi",diff:"Diff",erlang:"Erlang",groovy:"Groovy",html:"Html",java:"Java",jfx:"JavaFx",js:"Javascript",pl:"Perl",php:"Php",plain:"Plain Text",ps:"PowerShell",python:"Python",ruby:"Ruby",scala:"Scala",sql:"Sql",vb:"Vb",xml:"Xml"}),e.commands.insertcode={execCommand:function(e,t){var r=this,n=r.selection.getRange(),a=domUtils.findParentByTagName(n.startContainer,"pre",!0);if(a)a.className="brush:"+t+";toolbar:false;";else{var i="";if(n.collapsed)i=browser.ie&&browser.ie11below?browser.version<=8?"&nbsp;":"":"<br/>";else{var o=n.extractContents(),s=r.document.createElement("div");s.appendChild(o),utils.each(UE.filterNode(UE.htmlparser(s.innerHTML.replace(/[\r\t]/g,"")),r.options.filterTxtRules).children,function(e){if(browser.ie&&browser.ie11below&&browser.version>8)"element"==e.type?"br"==e.tagName?i+="\n":dtd.$empty[e.tagName]||(utils.each(e.children,function(t){"element"==t.type?"br"==t.tagName?i+="\n":dtd.$empty[e.tagName]||(i+=t.innerText()):i+=t.data}),/\n$/.test(i)||(i+="\n")):i+=e.data+"\n",!e.nextSibling()&&/\n$/.test(i)&&(i=i.replace(/\n$/,""));else if(browser.ie&&browser.ie11below)"element"==e.type?"br"==e.tagName?i+="<br>":dtd.$empty[e.tagName]||(utils.each(e.children,function(t){"element"==t.type?"br"==t.tagName?i+="<br>":dtd.$empty[e.tagName]||(i+=t.innerText()):i+=t.data}),/br>$/.test(i)||(i+="<br>")):i+=e.data+"<br>",!e.nextSibling()&&/<br>$/.test(i)&&(i=i.replace(/<br>$/,""));else if(i+="element"==e.type?dtd.$empty[e.tagName]?"":e.innerText():e.data,!/br\/?\s*>$/.test(i)){if(!e.nextSibling())return;i+="<br>"}})}r.execCommand("inserthtml",'<pre id="coder"class="brush:'+t+';toolbar:false">'+i+"</pre>",!0),a=r.document.getElementById("coder"),domUtils.removeAttributes(a,"id");var l=a.previousSibling;l&&(3==l.nodeType&&1==l.nodeValue.length&&browser.ie&&6==browser.version||domUtils.isEmptyBlock(l))&&domUtils.remove(l);var n=r.selection.getRange();domUtils.isEmptyBlock(a)?n.setStart(a,0).setCursor(!1,!0):n.selectNodeContents(a).select()}},queryCommandValue:function(){var e=this.selection.getStartElementPath(),t="";return utils.each(e,function(e){if("PRE"==e.nodeName){var r=e.className.match(/brush:([^;]+)/);return t=r&&r[1]?r[1]:"",!1}}),t}},e.addInputRule(function(e){utils.each(e.getNodesByTagName("pre"),function(e){var t=e.getNodesByTagName("br");if(t.length)return void(browser.ie&&browser.ie11below&&browser.version>8&&utils.each(t,function(e){var t=UE.uNode.createText("\n");e.parentNode.insertBefore(t,e),e.parentNode.removeChild(e)}));if(!(browser.ie&&browser.ie11below&&browser.version>8)){var r=e.innerText().split(/\n/);e.innerHTML(""),utils.each(r,function(t){t.length&&e.appendChild(UE.uNode.createText(t)),e.appendChild(UE.uNode.createElement("br"))})}})}),e.addOutputRule(function(e){utils.each(e.getNodesByTagName("pre"),function(e){var t="";utils.each(e.children,function(e){t+="text"==e.type?e.data.replace(/[ ]/g,"&nbsp;").replace(/\n$/,""):"br"==e.tagName?"\n":dtd.$empty[e.tagName]?e.innerText():""}),e.innerText(t.replace(/(&nbsp;|\n)+$/,""))})}),e.notNeedCodeQuery={help:1,undo:1,redo:1,source:1,print:1,searchreplace:1,fullscreen:1,preview:1,insertparagraph:1,elementpath:1,insertcode:1,inserthtml:1,selectall:1};e.queryCommandState;e.queryCommandState=function(e){var t=this;return!t.notNeedCodeQuery[e.toLowerCase()]&&t.selection&&t.queryCommandValue("insertcode")?-1:UE.Editor.prototype.queryCommandState.apply(this,arguments)},e.addListener("beforeenterkeydown",function(){var t=e.selection.getRange(),r=domUtils.findParentByTagName(t.startContainer,"pre",!0);if(r){if(e.fireEvent("saveScene"),t.collapsed||t.deleteContents(),!browser.ie||browser.ie9above){var r,n=e.document.createElement("br");t.insertNode(n).setStartAfter(n).collapse(!0);var a=n.nextSibling;a||browser.ie&&!(browser.version>10)?t.setStartAfter(n):t.insertNode(n.cloneNode(!1)),r=n.previousSibling;for(var i;r;)if(i=r,r=r.previousSibling,!r||"BR"==r.nodeName){r=i;break}if(r){for(var o="";r&&"BR"!=r.nodeName&&new RegExp("^[\\s"+domUtils.fillChar+"]*$").test(r.nodeValue);)o+=r.nodeValue,r=r.nextSibling;if("BR"!=r.nodeName){var s=r.nodeValue.match(new RegExp("^([\\s"+domUtils.fillChar+"]+)"));s&&s[1]&&(o+=s[1])}o&&(o=e.document.createTextNode(o),t.insertNode(o).setStartAfter(o))}t.collapse(!0).select(!0)}else if(browser.version>8){var l=e.document.createTextNode("\n"),d=t.startContainer;if(0==t.startOffset){var c=d.previousSibling;if(c){t.insertNode(l);var m=e.document.createTextNode(" ");t.setStartAfter(l).insertNode(m).setStart(m,0).collapse(!0).select(!0)}}else{t.insertNode(l).setStartAfter(l);var m=e.document.createTextNode(" ");d=t.startContainer.childNodes[t.startOffset],d&&!/^\n/.test(d.nodeValue)&&t.setStartBefore(l),t.insertNode(m).setStart(m,0).collapse(!0).select(!0)}}else{var n=e.document.createElement("br");t.insertNode(n),t.insertNode(e.document.createTextNode(domUtils.fillChar)),t.setStartAfter(n),r=n.previousSibling;for(var i;r;)if(i=r,r=r.previousSibling,!r||"BR"==r.nodeName){r=i;break}if(r){for(var o="";r&&"BR"!=r.nodeName&&new RegExp("^[ "+domUtils.fillChar+"]*$").test(r.nodeValue);)o+=r.nodeValue,r=r.nextSibling;if("BR"!=r.nodeName){var s=r.nodeValue.match(new RegExp("^([ "+domUtils.fillChar+"]+)"));s&&s[1]&&(o+=s[1])}o=e.document.createTextNode(o),t.insertNode(o).setStartAfter(o)}t.collapse(!0).select()}return e.fireEvent("saveScene"),!0}}),e.addListener("tabkeydown",function(t,r){var n=e.selection.getRange(),a=domUtils.findParentByTagName(n.startContainer,"pre",!0);if(a){if(e.fireEvent("saveScene"),r.shiftKey);else if(n.collapsed){var i=e.document.createTextNode("    ");n.insertNode(i).setStartAfter(i).collapse(!0).select(!0)}else{for(var o=n.createBookmark(),s=o.start.previousSibling;s;){if(a.firstChild===s&&!domUtils.isBr(s)){a.insertBefore(e.document.createTextNode("    "),s);break}if(domUtils.isBr(s)){a.insertBefore(e.document.createTextNode("    "),s.nextSibling);break}s=s.previousSibling}var l=o.end;for(s=o.start.nextSibling,a.firstChild===o.start&&a.insertBefore(e.document.createTextNode("    "),s.nextSibling);s&&s!==l;){if(domUtils.isBr(s)&&s.nextSibling){if(s.nextSibling===l)break;a.insertBefore(e.document.createTextNode("    "),s.nextSibling)}s=s.nextSibling}n.moveToBookmark(o).select()}return e.fireEvent("saveScene"),!0}}),e.addListener("beforeinserthtml",function(e,t){var r=this,n=r.selection.getRange(),a=domUtils.findParentByTagName(n.startContainer,"pre",!0);if(a){n.collapsed||n.deleteContents();var i="";if(browser.ie&&browser.version>8){utils.each(UE.filterNode(UE.htmlparser(t),r.options.filterTxtRules).children,function(e){"element"==e.type?"br"==e.tagName?i+="\n":dtd.$empty[e.tagName]||(utils.each(e.children,function(t){"element"==t.type?"br"==t.tagName?i+="\n":dtd.$empty[e.tagName]||(i+=t.innerText()):i+=t.data}),/\n$/.test(i)||(i+="\n")):i+=e.data+"\n",!e.nextSibling()&&/\n$/.test(i)&&(i=i.replace(/\n$/,""))});var o=r.document.createTextNode(utils.html(i.replace(/&nbsp;/g," ")));n.insertNode(o).selectNode(o).select()}else{var s=r.document.createDocumentFragment();utils.each(UE.filterNode(UE.htmlparser(t),r.options.filterTxtRules).children,function(e){"element"==e.type?"br"==e.tagName?s.appendChild(r.document.createElement("br")):dtd.$empty[e.tagName]||(utils.each(e.children,function(t){"element"==t.type?"br"==t.tagName?s.appendChild(r.document.createElement("br")):dtd.$empty[e.tagName]||s.appendChild(r.document.createTextNode(utils.html(t.innerText().replace(/&nbsp;/g," ")))):s.appendChild(r.document.createTextNode(utils.html(t.data.replace(/&nbsp;/g," "))))}),"BR"!=s.lastChild.nodeName&&s.appendChild(r.document.createElement("br"))):s.appendChild(r.document.createTextNode(utils.html(e.data.replace(/&nbsp;/g," ")))),e.nextSibling()||"BR"!=s.lastChild.nodeName||s.removeChild(s.lastChild)}),n.insertNode(s).select()}return!0}}),e.addListener("keydown",function(e,t){var r=this,n=t.keyCode||t.which;if(40==n){var a,i=r.selection.getRange(),o=i.startContainer;if(i.collapsed&&(a=domUtils.findParentByTagName(i.startContainer,"pre",!0))&&!a.nextSibling){for(var s=a.lastChild;s&&"BR"==s.nodeName;)s=s.previousSibling;(s===o||i.startContainer===a&&i.startOffset==a.childNodes.length)&&(r.execCommand("insertparagraph"),domUtils.preventDefault(t))}}}),e.addListener("delkeydown",function(t,r){var n=this.selection.getRange();n.txtToElmBoundary(!0);var a=n.startContainer;if(domUtils.isTagNode(a,"pre")&&n.collapsed&&domUtils.isStartInblock(n)){var i=e.document.createElement("p");return domUtils.fillNode(e.document,i),a.parentNode.insertBefore(i,a),domUtils.remove(a),n.setStart(i,0).setCursor(!1,!0),domUtils.preventDefault(r),!0}})};
UE.plugins.enterkey=function(){var e,t=this,r=t.options.enterTag;t.addListener("keyup",function(r,n){var o=n.keyCode||n.which;if(13==o){var a,s=t.selection.getRange(),i=s.startContainer;if(browser.ie)t.fireEvent("saveScene",!0,!0);else{if(/h\d/i.test(e)){if(browser.gecko){var d=domUtils.findParentByTagName(i,["h1","h2","h3","h4","h5","h6","blockquote","caption","table"],!0);d||(t.document.execCommand("formatBlock",!1,"<p>"),a=1)}else if(1==i.nodeType){var l,f=t.document.createTextNode("");if(s.insertNode(f),l=domUtils.findParentByTagName(f,"div",!0)){for(var m=t.document.createElement("p");l.firstChild;)m.appendChild(l.firstChild);l.parentNode.insertBefore(m,l),domUtils.remove(l),s.setStartBefore(f).setCursor(),a=1}domUtils.remove(f)}t.undoManger&&a&&t.undoManger.save()}browser.opera&&s.select()}}}),t.addListener("keydown",function(n,o){var a=o.keyCode||o.which;if(13==a){if(t.fireEvent("beforeenterkeydown"))return void domUtils.preventDefault(o);t.fireEvent("saveScene",!0,!0),e="";var s=t.selection.getRange();if(!s.collapsed){var i=s.startContainer,d=s.endContainer,l=domUtils.findParentByTagName(i,"td",!0),f=domUtils.findParentByTagName(d,"td",!0);if(l&&f&&l!==f||!l&&f||l&&!f)return void(o.preventDefault?o.preventDefault():o.returnValue=!1)}if("p"==r)browser.ie||(i=domUtils.findParentByTagName(s.startContainer,["ol","ul","p","h1","h2","h3","h4","h5","h6","blockquote","caption"],!0),i||browser.opera?(e=i.tagName,"p"==i.tagName.toLowerCase()&&browser.gecko&&domUtils.removeDirtyAttr(i)):(t.document.execCommand("formatBlock",!1,"<p>"),browser.gecko&&(s=t.selection.getRange(),i=domUtils.findParentByTagName(s.startContainer,"p",!0),i&&domUtils.removeDirtyAttr(i))));else if(o.preventDefault?o.preventDefault():o.returnValue=!1,s.collapsed){u=s.document.createElement("br"),s.insertNode(u);var m=u.parentNode;m.lastChild===u?(u.parentNode.insertBefore(u.cloneNode(!0),u),s.setStartBefore(u)):s.setStartAfter(u),s.setCursor()}else if(s.deleteContents(),i=s.startContainer,1==i.nodeType&&(i=i.childNodes[s.startOffset])){for(;1==i.nodeType;){if(dtd.$empty[i.tagName])return s.setStartBefore(i).setCursor(),t.undoManger&&t.undoManger.save(),!1;if(!i.firstChild){var u=s.document.createElement("br");return i.appendChild(u),s.setStart(i,0).setCursor(),t.undoManger&&t.undoManger.save(),!1}i=i.firstChild}i===s.startContainer.childNodes[s.startOffset]?(u=s.document.createElement("br"),s.insertNode(u).setCursor()):s.setStart(i,0).setCursor()}else u=s.document.createElement("br"),s.insertNode(u).setStartAfter(u).setCursor()}})};
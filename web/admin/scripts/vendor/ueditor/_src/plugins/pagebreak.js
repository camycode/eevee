UE.plugins.pagebreak=function(){function e(e){if(domUtils.isEmptyBlock(e)){for(var t,o=e.firstChild;o&&1==o.nodeType&&domUtils.isEmptyBlock(o);)t=o,o=o.firstChild;!t&&(t=e),domUtils.fillNode(a.document,t)}}function t(e){return e&&1==e.nodeType&&"HR"==e.tagName&&"pagebreak"==e.className}var a=this,o=["td"];a.setOpt("pageBreakTag","_ueditor_page_break_tag_"),a.ready(function(){utils.cssRule("pagebreak",".pagebreak{display:block;clear:both !important;cursor:default !important;width: 100% !important;margin:0;}",a.document)}),a.addInputRule(function(e){e.traversal(function(e){if("text"==e.type&&e.data==a.options.pageBreakTag){var t=UE.uNode.createElement('<hr class="pagebreak" noshade="noshade" size="5" style="-webkit-user-select: none;">');e.parentNode.insertBefore(t,e),e.parentNode.removeChild(e)}})}),a.addOutputRule(function(e){utils.each(e.getNodesByTagName("hr"),function(e){if("pagebreak"==e.getAttr("class")){var t=UE.uNode.createText(a.options.pageBreakTag);e.parentNode.insertBefore(t,e),e.parentNode.removeChild(e)}})}),a.commands.pagebreak={execCommand:function(){var r=a.selection.getRange(),i=a.document.createElement("hr");domUtils.setAttributes(i,{"class":"pagebreak",noshade:"noshade",size:"5"}),domUtils.unSelectable(i);var n,s=domUtils.findParentByTagName(r.startContainer,o,!0),d=[];if(s)switch(s.tagName){case"TD":if(n=s.parentNode,n.previousSibling)n.parentNode.insertBefore(i,n),d=domUtils.findParents(i);else{var l=domUtils.findParentByTagName(n,"table");l.parentNode.insertBefore(i,l),d=domUtils.findParents(i,!0)}n=d[1],i!==n&&domUtils.breakParent(i,n),a.fireEvent("afteradjusttable",a.document)}else{if(!r.collapsed){r.deleteContents();for(var m=r.startContainer;!domUtils.isBody(m)&&domUtils.isBlockElm(m)&&domUtils.isEmptyNode(m);)r.setStartBefore(m).collapse(!0),domUtils.remove(m),m=r.startContainer}r.insertNode(i);for(var p,n=i.parentNode;!domUtils.isBody(n);)domUtils.breakParent(i,n),p=i.nextSibling,p&&domUtils.isEmptyBlock(p)&&domUtils.remove(p),n=i.parentNode;p=i.nextSibling;var c=i.previousSibling;if(t(c)?domUtils.remove(c):c&&e(c),p)t(p)?domUtils.remove(p):e(p),r.setEndAfter(i).collapse(!1);else{var f=a.document.createElement("p");i.parentNode.appendChild(f),domUtils.fillNode(a.document,f),r.setStart(f,0).collapse(!0)}r.select(!0)}}}};
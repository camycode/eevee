UE.plugins.dragdrop=function(){var e=this;e.ready(function(){domUtils.on(this.body,"dragend",function(){var t=e.selection.getRange(),i=t.getClosedNode()||e.selection.getStart();if(i&&"IMG"==i.tagName){for(var o,l=i.previousSibling;(o=i.nextSibling)&&1==o.nodeType&&"SPAN"==o.tagName&&!o.firstChild;)domUtils.remove(o);(!l||1!=l.nodeType||domUtils.isEmptyBlock(l))&&l||o&&(!o||domUtils.isEmptyBlock(o))||(l&&"P"==l.tagName&&!domUtils.isEmptyBlock(l)?(l.appendChild(i),domUtils.moveChild(o,l),domUtils.remove(o)):o&&"P"==o.tagName&&!domUtils.isEmptyBlock(o)&&o.insertBefore(i,o.firstChild),l&&"P"==l.tagName&&domUtils.isEmptyBlock(l)&&domUtils.remove(l),o&&"P"==o.tagName&&domUtils.isEmptyBlock(o)&&domUtils.remove(o),t.selectNode(i).select(),e.fireEvent("saveScene"))}})}),e.addListener("keyup",function(t,i){var o=i.keyCode||i.which;if(13==o){var l,s=e.selection.getRange();(l=domUtils.findParentByTagName(s.startContainer,"p",!0))&&"center"==domUtils.getComputedStyle(l,"text-align")&&domUtils.removeStyle(l,"text-align")}})};
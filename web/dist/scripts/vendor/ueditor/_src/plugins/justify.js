UE.plugins.justify=function(){var t=domUtils.isBlockElm,e={left:1,right:1,center:1,justify:1},o=function(e,o){var n=e.createBookmark(),i=function(t){return 1==t.nodeType?"br"!=t.tagName.toLowerCase()&&!domUtils.isBookmarkNode(t):!domUtils.isWhitespace(t)};e.enlarge(!0);for(var r,s=e.createBookmark(),a=domUtils.getNextDomNode(s.start,!1,i),l=e.cloneRange();a&&!(domUtils.getPosition(a,s.end)&domUtils.POSITION_FOLLOWING);)if(3!=a.nodeType&&t(a))a=domUtils.getNextDomNode(a,!0,i);else{for(l.setStartBefore(a);a&&a!==s.end&&!t(a);)r=a,a=domUtils.getNextDomNode(a,!1,null,function(e){return!t(e)});l.setEndAfter(r);var m=l.getCommonAncestor();if(!domUtils.isBody(m)&&t(m))domUtils.setStyles(m,utils.isString(o)?{"text-align":o}:o),a=m;else{var d=e.document.createElement("p");domUtils.setStyles(d,utils.isString(o)?{"text-align":o}:o);var c=l.extractContents();d.appendChild(c),l.insertNode(d),a=d}a=domUtils.getNextDomNode(a,!1,i)}return e.moveToBookmark(s).moveToBookmark(n)};UE.commands.justify={execCommand:function(t,e){var n,i=this.selection.getRange();return i.collapsed&&(n=this.document.createTextNode("p"),i.insertNode(n)),o(i,e),n&&(i.setStartBefore(n).collapse(!0),domUtils.remove(n)),i.select(),!0},queryCommandValue:function(){var t=this.selection.getStart(),o=domUtils.getComputedStyle(t,"text-align");return e[o]?o:"left"},queryCommandState:function(){var t=this.selection.getStart(),e=t&&domUtils.findParentByTagName(t,["td","th","caption"],!0);return e?-1:0}}};
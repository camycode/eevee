!function(){var e=domUtils.isBlockElm,t=function(e){return domUtils.filterNodeList(e.selection.getStartElementPath(),function(e){return e&&1==e.nodeType&&e.getAttribute("dir")})},o=function(o,r,i){var n,d=function(e){return 1==e.nodeType?!domUtils.isBookmarkNode(e):!domUtils.isWhitespace(e)},s=t(r);if(s&&o.collapsed)return s.setAttribute("dir",i),o;n=o.createBookmark(),o.enlarge(!0);for(var a,m=o.createBookmark(),l=domUtils.getNextDomNode(m.start,!1,d),c=o.cloneRange();l&&!(domUtils.getPosition(l,m.end)&domUtils.POSITION_FOLLOWING);)if(3!=l.nodeType&&e(l))l=domUtils.getNextDomNode(l,!0,d);else{for(c.setStartBefore(l);l&&l!==m.end&&!e(l);)a=l,l=domUtils.getNextDomNode(l,!1,null,function(t){return!e(t)});c.setEndAfter(a);var u=c.getCommonAncestor();if(!domUtils.isBody(u)&&e(u))u.setAttribute("dir",i),l=u;else{var f=o.document.createElement("p");f.setAttribute("dir",i);var N=c.extractContents();f.appendChild(N),c.insertNode(f),l=f}l=domUtils.getNextDomNode(l,!1,d)}return o.moveToBookmark(m).moveToBookmark(n)};UE.commands.directionality={execCommand:function(e,t){var r=this.selection.getRange();if(r.collapsed){var i=this.document.createTextNode("d");r.insertNode(i)}return o(r,this,t),i&&(r.setStartBefore(i).collapse(!0),domUtils.remove(i)),r.select(),!0},queryCommandValue:function(){var e=t(this);return e?e.getAttribute("dir"):"ltr"}}}();
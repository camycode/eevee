UE.parse.register("table",function(t){function e(e,r){var n,a=e;for(r=t.isArray(r)?r:[r];a;){for(n=0;n<r.length;n++)if(a.tagName==r[n].toUpperCase())return a;a=a.parentNode}return null}function r(e,r,a){for(var o=e.rows,l=[],i="TH"===o[0].cells[0].tagName,s=0,c=0,d=o.length;d>c;c++)l[c]=o[c];var b={reversecurrent:function(t,e){return 1},orderbyasc:function(t,e){var r=t.innerText||t.textContent,n=e.innerText||e.textContent;return r.localeCompare(n)},reversebyasc:function(t,e){var r=t.innerHTML,n=e.innerHTML;return n.localeCompare(r)},orderbynum:function(e,r){var n=e[t.isIE?"innerText":"textContent"].match(/\d+/),a=r[t.isIE?"innerText":"textContent"].match(/\d+/);return n&&(n=+n[0]),a&&(a=+a[0]),(n||0)-(a||0)},reversebynum:function(e,r){var n=e[t.isIE?"innerText":"textContent"].match(/\d+/),a=r[t.isIE?"innerText":"textContent"].match(/\d+/);return n&&(n=+n[0]),a&&(a=+a[0]),(a||0)-(n||0)}};e.setAttribute("data-sort-type",a&&"string"==typeof a&&b[a]?a:""),i&&l.splice(0,1),l=n(l,function(t,e){var n;return n=a&&"function"==typeof a?a.call(this,t.cells[r],e.cells[r]):a&&"number"==typeof a?1:a&&"string"==typeof a&&b[a]?b[a].call(this,t.cells[r],e.cells[r]):b.orderbyasc.call(this,t.cells[r],e.cells[r])});for(var u=e.ownerDocument.createDocumentFragment(),f=0,d=l.length;d>f;f++)u.appendChild(l[f]);var g=e.getElementsByTagName("tbody")[0];s?g.insertBefore(u,o[s-range.endRowIndex+range.beginRowIndex-1]):g.appendChild(u)}function n(t,e){e=e||function(t,e){return t.localeCompare(e)};for(var r=0,n=t.length;n>r;r++)for(var a=r,o=t.length;o>a;a++)if(e(t[r],t[a])>0){var l=t[r];t[r]=t[a],t[a]=l}return t}function a(e){if(!t.hasClass(e.rows[0],"firstRow")){for(var r=1;r<e.rows.length;r++)t.removeClass(e.rows[r],"firstRow");t.addClass(e.rows[0],"firstRow")}}var o=this,l=this.root,i=l.getElementsByTagName("table");if(i.length){var s=this.selector;t.cssRule("table",s+" table.noBorderTable td,"+s+" table.noBorderTable th,"+s+" table.noBorderTable caption{border:1px dashed #ddd !important}"+s+" table.sortEnabled tr.firstRow th,"+s+" table.sortEnabled tr.firstRow td{padding-right:20px; background-repeat: no-repeat;background-position: center right; background-image:url("+this.rootPath+"themes/default/images/sortable.png);}"+s+" table.sortEnabled tr.firstRow th:hover,"+s+" table.sortEnabled tr.firstRow td:hover{background-color: #EEE;}"+s+" table{margin-bottom:10px;border-collapse:collapse;display:table;}"+s+" td,"+s+" th{ background:white; padding: 5px 10px;border: 1px solid #DDD;}"+s+" caption{border:1px dashed #DDD;border-bottom:0;padding:3px;text-align:center;}"+s+" th{border-top:1px solid #BBB;background:#F7F7F7;}"+s+" table tr.firstRow th{border-top:2px solid #BBB;background:#F7F7F7;}"+s+" tr.ue-table-interlace-color-single td{ background: #fcfcfc; }"+s+" tr.ue-table-interlace-color-double td{ background: #f7faff; }"+s+" td p{margin:0;padding:0;}",document),t.each("td th caption".split(" "),function(e){var r=l.getElementsByTagName(e);r.length&&t.each(r,function(t){t.firstChild||(t.innerHTML="&nbsp;")})});var i=l.getElementsByTagName("table");t.each(i,function(n){/\bsortEnabled\b/.test(n.className)&&t.on(n,"click",function(n){var l=n.target||n.srcElement,i=e(l,["td","th"]),s=e(l,"table"),c=t.indexOf(s.rows[0].cells,i),d=s.getAttribute("data-sort-type");-1!=c&&(r(s,c,o.tableSortCompareFn||d),a(s))})})}});
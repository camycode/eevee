UE.UETable.prototype.sortTable=function(e,t){var n=this.table,r=n.rows,o=[],a="TH"===r[0].cells[0].tagName,s=0;if(this.selectedTds.length){for(var l=this.cellsRange,i=l.endRowIndex+1,c=l.beginRowIndex;i>c;c++)o[c]=r[c];o.splice(0,l.beginRowIndex),s=l.endRowIndex+1===this.rowsNum?0:l.endRowIndex+1}else for(var c=0,i=r.length;i>c;c++)o[c]=r[c];var d={reversecurrent:function(e,t){return 1},orderbyasc:function(e,t){var n=e.innerText||e.textContent,r=t.innerText||t.textContent;return n.localeCompare(r)},reversebyasc:function(e,t){var n=e.innerHTML,r=t.innerHTML;return r.localeCompare(n)},orderbynum:function(e,t){var n=e[browser.ie?"innerText":"textContent"].match(/\d+/),r=t[browser.ie?"innerText":"textContent"].match(/\d+/);return n&&(n=+n[0]),r&&(r=+r[0]),(n||0)-(r||0)},reversebynum:function(e,t){var n=e[browser.ie?"innerText":"textContent"].match(/\d+/),r=t[browser.ie?"innerText":"textContent"].match(/\d+/);return n&&(n=+n[0]),r&&(r=+r[0]),(r||0)-(n||0)}};n.setAttribute("data-sort-type",t&&"string"==typeof t&&d[t]?t:""),a&&o.splice(0,1),o=utils.sort(o,function(n,r){var o;return o=t&&"function"==typeof t?t.call(this,n.cells[e],r.cells[e]):t&&"number"==typeof t?1:t&&"string"==typeof t&&d[t]?d[t].call(this,n.cells[e],r.cells[e]):d.orderbyasc.call(this,n.cells[e],r.cells[e])});for(var m=n.ownerDocument.createDocumentFragment(),b=0,i=o.length;i>b;b++)m.appendChild(o[b]);var u=n.getElementsByTagName("tbody")[0];s?u.insertBefore(m,r[s-l.endRowIndex+l.beginRowIndex-1]):u.appendChild(m)},UE.plugins.tablesort=function(){var e=this,t=UE.UETable,n=function(e){return t.getUETable(e)},r=function(e){return t.getTableItemsByRange(e)};e.ready(function(){utils.cssRule("tablesort","table.sortEnabled tr.firstRow th,table.sortEnabled tr.firstRow td{padding-right:20px;background-repeat: no-repeat;background-position: center right;   background-image:url("+e.options.themePath+e.options.theme+"/images/sortable.png);}",e.document),e.addListener("afterexeccommand",function(e,t){("mergeright"==t||"mergedown"==t||"mergecells"==t)&&this.execCommand("disablesort")})}),UE.commands.sorttable={queryCommandState:function(){var e=this,t=r(e);if(!t.cell)return-1;for(var n,o=t.table,a=o.getElementsByTagName("td"),s=0;n=a[s++];)if(1!=n.rowSpan||1!=n.colSpan)return-1;return 0},execCommand:function(e,t){var o=this,a=o.selection.getRange(),s=a.createBookmark(!0),l=r(o),i=l.cell,c=n(l.table),d=c.getCellInfo(i);c.sortTable(d.cellIndex,t),a.moveToBookmark(s);try{a.select()}catch(m){}}},UE.commands.enablesort=UE.commands.disablesort={queryCommandState:function(e){var t=r(this).table;if(t&&"enablesort"==e)for(var n=domUtils.getElementsByTagName(t,"th td"),o=0;o<n.length;o++)if(n[o].getAttribute("colspan")>1||n[o].getAttribute("rowspan")>1)return-1;return t?"enablesort"==e^"sortEnabled"!=t.getAttribute("data-sort")?-1:0:-1},execCommand:function(e){var t=r(this).table;t.setAttribute("data-sort","enablesort"==e?"sortEnabled":"sortDisabled"),"enablesort"==e?domUtils.addClass(t,"sortEnabled"):domUtils.removeClasses(t,"sortEnabled")}}};
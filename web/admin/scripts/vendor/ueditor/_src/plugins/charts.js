UE.plugin.register("charts",function(){function t(t){var e=null,r=0;if(t.rows.length<2)return!1;if(t.rows[0].cells.length<2)return!1;e=t.rows[0].cells,r=e.length;for(var a,n=0;a=e[n];n++)if("th"!==a.tagName.toLowerCase())return!1;for(var i,n=1;i=t.rows[n];n++){if(i.cells.length!=r)return!1;if("th"!==i.cells[0].tagName.toLowerCase())return!1;for(var a,s=1;a=i.cells[s];s++){var l=utils.trim(a.innerText||a.textContent||"");if(l=l.replace(new RegExp(UE.dom.domUtils.fillChar,"g"),"").replace(/^\s+|\s+$/g,""),!/^\d*\.?\d+$/.test(l))return!1}}return!0}var e=this;return{bindEvents:{chartserror:function(){}},commands:{charts:{execCommand:function(r,a){var n=domUtils.findParentByTagName(this.selection.getRange().startContainer,"table",!0),i=[],s={};if(!n)return!1;if(!t(n))return e.fireEvent("chartserror"),!1;s.title=a.title||"",s.subTitle=a.subTitle||"",s.xTitle=a.xTitle||"",s.yTitle=a.yTitle||"",s.suffix=a.suffix||"",s.tip=a.tip||"",s.dataFormat=a.tableDataFormat||"",s.chartType=a.chartType||0;for(var l in s)s.hasOwnProperty(l)&&i.push(l+":"+s[l]);n.setAttribute("data-chart",i.join(";")),domUtils.addClass(n,"edui-charts-table")},queryCommandState:function(e,r){var a=domUtils.findParentByTagName(this.selection.getRange().startContainer,"table",!0);return a&&t(a)?0:-1}}},inputRule:function(t){utils.each(t.getNodesByTagName("table"),function(t){void 0!==t.getAttr("data-chart")&&t.setAttr("style")})},outputRule:function(t){utils.each(t.getNodesByTagName("table"),function(t){void 0!==t.getAttr("data-chart")&&t.setAttr("style","display: none;")})}}});
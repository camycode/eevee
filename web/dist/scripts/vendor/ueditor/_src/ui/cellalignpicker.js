!function(){var i=baidu.editor.utils,t=baidu.editor.ui.Popup,e=baidu.editor.ui.Stateful,n=baidu.editor.ui.UIBase,l=baidu.editor.ui.CellAlignPicker=function(i){this.initOptions(i),this.initSelected(),this.initCellAlignPicker()};l.prototype={initSelected:function(){var i={valign:{top:0,middle:1,bottom:2},align:{left:0,center:1,right:2},count:3};this.selected&&(this.selectedIndex=i.valign[this.selected.valign]*i.count+i.align[this.selected.align])},initCellAlignPicker:function(){this.initUIBase(),this.Stateful_init()},getHtmlTpl:function(){for(var i=["left","center","right"],t=9,e=null,n=-1,l=[],d=0;t>d;d++)e=this.selectedIndex===d?' class="edui-cellalign-selected" ':"",n=d%3,0===n&&l.push("<tr>"),l.push('<td index="'+d+'" '+e+' stateful><div class="edui-icon edui-'+i[n]+'"></div></td>'),2===n&&l.push("</tr>");return'<div id="##" class="edui-cellalignpicker %%"><div class="edui-cellalignpicker-body"><table onclick="$$._onClick(event);">'+l.join("")+"</table></div></div>"},getStateDom:function(){return this.target},_onClick:function(i){var e=i.target||i.srcElement;/icon/.test(e.className)&&(this.items[e.parentNode.getAttribute("index")].onclick(),t.postHide(i))},_UIBase_render:n.prototype.render},i.inherits(l,n),i.extend(l.prototype,e,!0)}();
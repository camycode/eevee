!function(){var t=baidu.editor.utils,i=baidu.editor.ui.Stateful,e=baidu.editor.ui.uiUtils,s=baidu.editor.ui.UIBase,d=baidu.editor.ui.PastePicker=function(t){this.initOptions(t),this.initPastePicker()};d.prototype={initPastePicker:function(){this.initUIBase(),this.Stateful_init()},getHtmlTpl:function(){return'<div class="edui-pasteicon" onclick="$$._onClick(this)"></div><div class="edui-pastecontainer"><div class="edui-title">'+this.editor.getLang("pasteOpt")+'</div><div class="edui-button"><div title="'+this.editor.getLang("pasteSourceFormat")+'" onclick="$$.format(false)" stateful><div class="edui-richtxticon"></div></div><div title="'+this.editor.getLang("tagFormat")+'" onclick="$$.format(2)" stateful><div class="edui-tagicon"></div></div><div title="'+this.editor.getLang("pasteTextFormat")+'" onclick="$$.format(true)" stateful><div class="edui-plaintxticon"></div></div></div></div></div>'},getStateDom:function(){return this.target},format:function(t){this.editor.ui._isTransfer=!0,this.editor.fireEvent("pasteTransfer",t)},_onClick:function(t){var i=domUtils.getNextDomNode(t),s=e.getViewportRect().height,d=e.getClientRect(i);d.top+d.height>s?i.style.top=-d.height-t.offsetHeight+"px":i.style.top="",/hidden/gi.test(domUtils.getComputedStyle(i,"visibility"))?(i.style.visibility="visible",domUtils.addClass(t,"edui-state-opened")):(i.style.visibility="hidden",domUtils.removeClasses(t,"edui-state-opened"))},_UIBase_render:s.prototype.render},t.inherits(d,s),t.extend(d.prototype,i,!0)}();
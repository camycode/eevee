!function(){var t=baidu.editor.utils,i=baidu.editor.ui.UIBase,e=baidu.editor.ui.Stateful,s=baidu.editor.ui.Button=function(t){if(t.name){var i=t.name,e=t.cssRules;t.className||(t.className="edui-for-"+i),t.cssRules=".edui-default  .edui-for-"+i+" .edui-icon {"+e+"}"}this.initOptions(t),this.initButton()};s.prototype={uiName:"button",label:"",title:"",showIcon:!0,showText:!0,cssRules:"",initButton:function(){this.initUIBase(),this.Stateful_init(),this.cssRules&&t.cssRule("edui-customize-"+this.name+"-style",this.cssRules)},getHtmlTpl:function(){return'<div id="##" class="edui-box %%"><div id="##_state" stateful><div class="%%-wrap"><div id="##_body" unselectable="on" '+(this.title?'title="'+this.title+'"':"")+' class="%%-body" onmousedown="return $$._onMouseDown(event, this);" onclick="return $$._onClick(event, this);">'+(this.showIcon?'<div class="edui-box edui-icon"></div>':"")+(this.showText?'<div class="edui-box edui-label">'+this.label+"</div>":"")+"</div></div></div></div>"},postRender:function(){this.Stateful_postRender(),this.setDisabled(this.disabled)},_onMouseDown:function(t){var i=t.target||t.srcElement,e=i&&i.tagName&&i.tagName.toLowerCase();return"input"==e||"object"==e||"object"==e?!1:void 0},_onClick:function(){this.isDisabled()||this.fireEvent("click")},setTitle:function(t){var i=this.getDom("label");i.innerHTML=t}},t.inherits(s,i),t.extend(s.prototype,e)}();
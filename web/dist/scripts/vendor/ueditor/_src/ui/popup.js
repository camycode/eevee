!function(){function t(t,e){for(var i=0;i<h.length;i++){var o=h[i];if(!o.isHidden()&&o.queryAutoHide(e)!==!1){if(t&&/scroll/gi.test(t.type)&&"edui-wordpastepop"==o.className)return;o.hide()}}h.length&&o.editor.fireEvent("afterhidepop")}var e=baidu.editor.utils,i=baidu.editor.ui.uiUtils,o=baidu.editor.dom.domUtils,n=baidu.editor.ui.UIBase,s=baidu.editor.ui.Popup=function(t){this.initOptions(t),this.initPopup()},h=[];s.postHide=t;var d=["edui-anchor-topleft","edui-anchor-topright","edui-anchor-bottomleft","edui-anchor-bottomright"];s.prototype={SHADOW_RADIUS:5,content:null,_hidden:!1,autoRender:!0,canSideLeft:!0,canSideUp:!0,initPopup:function(){this.initUIBase(),h.push(this)},getHtmlTpl:function(){return'<div id="##" class="edui-popup %%" onmousedown="return false;"> <div id="##_body" class="edui-popup-body"> <iframe style="position:absolute;z-index:-1;left:0;top:0;background-color: transparent;" frameborder="0" width="100%" height="100%" src="about:blank"></iframe> <div class="edui-shadow"></div> <div id="##_content" class="edui-popup-content">'+this.getContentHtmlTpl()+"  </div> </div></div>"},getContentHtmlTpl:function(){return this.content?"string"==typeof this.content?this.content:this.content.renderHtml():""},_UIBase_postRender:n.prototype.postRender,postRender:function(){if(this.content instanceof n&&this.content.postRender(),this.captureWheel&&!this.captured){this.captured=!0;var t=(document.documentElement.clientHeight||document.body.clientHeight)-80,e=this.getDom().offsetHeight,s=i.getClientRect(this.combox.getDom()).top,h=this.getDom("content"),d=this.getDom("body").getElementsByTagName("iframe"),r=this;for(d.length&&(d=d[0]);s+e>t;)e-=30;h.style.height=e+"px",d&&(d.style.height=e+"px"),window.XMLHttpRequest?o.on(h,"onmousewheel"in document.body?"mousewheel":"DOMMouseScroll",function(t){t.preventDefault?t.preventDefault():t.returnValue=!1,t.wheelDelta?h.scrollTop-=t.wheelDelta/120*60:h.scrollTop-=t.detail/-3*60}):o.on(this.getDom(),"mousewheel",function(t){t.returnValue=!1,r.getDom("content").scrollTop-=t.wheelDelta/120*60})}this.fireEvent("postRenderAfter"),this.hide(!0),this._UIBase_postRender()},_doAutoRender:function(){!this.getDom()&&this.autoRender&&this.render()},mesureSize:function(){var t=this.getDom("content");return i.getClientRect(t)},fitSize:function(){if(this.captureWheel&&this.sized)return this.__size;this.sized=!0;var t=this.getDom("body");t.style.width="",t.style.height="";var e=this.mesureSize();if(this.captureWheel){t.style.width=-(-20-e.width)+"px";var i=parseInt(this.getDom("content").style.height,10);!window.isNaN(i)&&(e.height=i)}else t.style.width=e.width+"px";return t.style.height=e.height+"px",this.__size=e,this.captureWheel&&(this.getDom("content").style.overflow="auto"),e},showAnchor:function(t,e){this.showAnchorRect(i.getClientRect(t),e)},showAnchorRect:function(t,e,n){this._doAutoRender();var s=i.getViewportRect();this.getDom().style.visibility="hidden",this._show();var h,r,l,u,c=this.fitSize();e?(h=this.canSideLeft&&t.right+c.width>s.right&&t.left>c.width,r=this.canSideUp&&t.top+c.height>s.bottom&&t.bottom>c.height,l=h?t.left-c.width:t.right,u=r?t.bottom-c.height:t.top):(h=this.canSideLeft&&t.right+c.width>s.right&&t.left>c.width,r=this.canSideUp&&t.top+c.height>s.bottom&&t.bottom>c.height,l=h?t.right-c.width:t.left,u=r?t.top-c.height:t.bottom);var a=this.getDom();i.setViewportOffset(a,{left:l,top:u}),o.removeClasses(a,d),a.className+=" "+d[2*(r?1:0)+(h?1:0)],this.editor&&(a.style.zIndex=1*this.editor.container.style.zIndex+10,baidu.editor.ui.uiUtils.getFixedLayer().style.zIndex=a.style.zIndex-1),this.getDom().style.visibility="visible"},showAt:function(t){var e=t.left,i=t.top,o={left:e,top:i,right:e,bottom:i,height:0,width:0};this.showAnchorRect(o,!1,!0)},_show:function(){if(this._hidden){var t=this.getDom();t.style.display="",this._hidden=!1,this.fireEvent("show")}},isHidden:function(){return this._hidden},show:function(){this._doAutoRender(),this._show()},hide:function(t){!this._hidden&&this.getDom()&&(this.getDom().style.display="none",this._hidden=!0,t||this.fireEvent("hide"))},queryAutoHide:function(t){return!t||!i.contains(this.getDom(),t)}},e.inherits(s,n),o.on(document,"mousedown",function(e){var i=e.target||e.srcElement;t(e,i)}),o.on(window,"scroll",function(e,i){t(e,i)})}();
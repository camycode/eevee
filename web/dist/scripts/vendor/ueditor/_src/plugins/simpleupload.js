UE.plugin.register("simpleupload",function(){function e(){var e=t.offsetWidth||20,n=t.offsetHeight||20,a=document.createElement("iframe"),r="display:block;width:"+e+"px;height:"+n+"px;overflow:hidden;border:0;margin:0;padding:0;position:absolute;top:0;left:0;filter:alpha(opacity=0);-moz-opacity:0;-khtml-opacity: 0;opacity: 0;cursor:pointer;";domUtils.on(a,"load",function(){var t,d,l,s=(+new Date).toString(36);d=a.contentDocument||a.contentWindow.document,l=d.body,t=d.createElement("div"),t.innerHTML='<form id="edui_form_'+s+'" target="edui_iframe_'+s+'" method="POST" enctype="multipart/form-data" action="'+i.getOpt("serverUrl")+'" style="'+r+'"><input id="edui_input_'+s+'" type="file" accept="image/*" name="'+i.options.imageFieldName+'" style="'+r+'"></form><iframe id="edui_iframe_'+s+'" name="edui_iframe_'+s+'" style="display:none;width:0;height:0;border:0;margin:0;padding:0;position:absolute;"></iframe>',t.className="edui-"+i.options.theme,t.id=i.ui.id+"_iframeupload",l.style.cssText=r,l.style.width=e+"px",l.style.height=n+"px",l.appendChild(t),l.parentNode&&(l.parentNode.style.width=e+"px",l.parentNode.style.height=e+"px");var m=d.getElementById("edui_form_"+s),c=d.getElementById("edui_input_"+s),u=d.getElementById("edui_iframe_"+s);domUtils.on(c,"change",function(){function e(){try{var n,a,r,d=(u.contentDocument||u.contentWindow.document).body,l=d.innerText||d.textContent||"";a=new Function("return "+l)(),n=i.options.imageUrlPrefix+a.url,"SUCCESS"==a.state&&a.url?(r=i.document.getElementById(o),r.setAttribute("src",n),r.setAttribute("_src",n),r.setAttribute("title",a.title||""),r.setAttribute("alt",a.original||""),r.removeAttribute("id"),domUtils.removeClasses(r,"loadingclass")):t&&t(a.state)}catch(s){t&&t(i.getLang("simpleupload.loadError"))}m.reset(),domUtils.un(u,"load",e)}function t(e){if(o){var t=i.document.getElementById(o);t&&domUtils.remove(t),i.fireEvent("showmessage",{id:o,content:e,type:"error",timeout:4e3})}}if(c.value){var o="loading_"+(+new Date).toString(36),n=utils.serializeParam(i.queryCommandValue("serverparam"))||"",a=i.getActionUrl(i.getOpt("imageActionName")),r=i.getOpt("imageAllowFiles");if(i.focus(),i.execCommand("inserthtml",'<img class="loadingclass" id="'+o+'" src="'+i.options.themePath+i.options.theme+'/images/spacer.gif" title="'+(i.getLang("simpleupload.loading")||"")+'" >'),!i.getOpt("imageActionName"))return void errorHandler(i.getLang("autoupload.errorLoadConfig"));var d=c.value,l=d?d.substr(d.lastIndexOf(".")):"";if(!l||r&&-1==(r.join("")+".").indexOf(l.toLowerCase()+"."))return void t(i.getLang("simpleupload.exceedTypeError"));domUtils.on(u,"load",e),m.action=utils.formatUrl(a+(-1==a.indexOf("?")?"?":"&")+n),m.submit()}});var p;i.addListener("selectionchange",function(){clearTimeout(p),p=setTimeout(function(){var e=i.queryCommandState("simpleupload");-1==e?c.disabled="disabled":c.disabled=!1},400)}),o=!0}),a.style.cssText=r,t.appendChild(a)}var t,i=this,o=!1;return{bindEvents:{ready:function(){utils.cssRule("loading",".loadingclass{display:inline-block;cursor:default;background: url('"+this.options.themePath+this.options.theme+"/images/loading.gif') no-repeat center center transparent;border:1px solid #cccccc;margin-right:1px;height: 22px;width: 22px;}\n.loaderrorclass{display:inline-block;cursor:default;background: url('"+this.options.themePath+this.options.theme+"/images/loaderror.png') no-repeat center center transparent;border:1px solid #cccccc;margin-right:1px;height: 22px;width: 22px;}",this.document)},simpleuploadbtnready:function(o,n){t=n,i.afterConfigReady(e)}},outputRule:function(e){utils.each(e.getNodesByTagName("img"),function(e){/\b(loaderrorclass)|(bloaderrorclass)\b/.test(e.getAttr("class"))&&e.parentNode.removeChild(e)})},commands:{simpleupload:{queryCommandState:function(){return o?0:-1}}}}});
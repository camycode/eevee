UE.plugins.defaultfilter=function(){var e=this;e.setOpt({allowDivTransToP:!0,disabledTableInTable:!0}),e.addInputRule(function(t){function a(e){for(;e&&"element"==e.type;){if("td"==e.tagName)return!0;e=e.parentNode}return!1}var r,i=this.options.allowDivTransToP;t.traversal(function(t){if("element"==t.type){if(!dtd.$cdata[t.tagName]&&e.options.autoClearEmptyNode&&dtd.$inline[t.tagName]&&!dtd.$empty[t.tagName]&&(!t.attrs||utils.isEmptyObject(t.attrs)))return void(t.firstChild()?"span"!=t.tagName||t.attrs&&!utils.isEmptyObject(t.attrs)||t.parentNode.removeChild(t,!0):t.parentNode.removeChild(t));switch(t.tagName){case"style":case"script":t.setAttr({cdata_tag:t.tagName,cdata_data:t.innerHTML()||"",_ue_custom_node_:"true"}),t.tagName="div",t.innerHTML("");break;case"a":(r=t.getAttr("href"))&&t.setAttr("_href",r);break;case"img":if((r=t.getAttr("src"))&&/^data:/.test(r)){t.parentNode.removeChild(t);break}t.setAttr("_src",t.getAttr("src"));break;case"span":browser.webkit&&(r=t.getStyle("white-space"))&&/nowrap|normal/.test(r)&&(t.setStyle("white-space",""),e.options.autoClearEmptyNode&&utils.isEmptyObject(t.attrs)&&t.parentNode.removeChild(t,!0)),r=t.getAttr("id"),r&&/^_baidu_bookmark_/i.test(r)&&t.parentNode.removeChild(t);break;case"p":(r=t.getAttr("align"))&&(t.setAttr("align"),t.setStyle("text-align",r)),utils.each(t.children,function(e){if("element"==e.type&&"p"==e.tagName){var a=e.nextSibling();t.parentNode.insertAfter(e,t);for(var r=e;a;){var i=a.nextSibling();t.parentNode.insertAfter(a,r),r=a,a=i}return!1}}),t.firstChild()||t.innerHTML(browser.ie?"&nbsp;":"<br/>");break;case"div":if(t.getAttr("cdata_tag"))break;if(r=t.getAttr("class"),r&&/^line number\d+/.test(r))break;if(!i)break;for(var s,d=UE.uNode.createElement("p");s=t.firstChild();)"text"!=s.type&&UE.dom.dtd.$block[s.tagName]?d.firstChild()?(t.parentNode.insertBefore(d,t),d=UE.uNode.createElement("p")):t.parentNode.insertBefore(s,t):d.appendChild(s);d.firstChild()&&t.parentNode.insertBefore(d,t),t.parentNode.removeChild(t);break;case"dl":t.tagName="ul";break;case"dt":case"dd":t.tagName="li";break;case"li":var n=t.getAttr("class");n&&/list\-/.test(n)||t.setAttr();var o=t.getNodesByTagName("ol ul");UE.utils.each(o,function(e){t.parentNode.insertAfter(e,t)});break;case"td":case"th":case"caption":t.children&&t.children.length||t.appendChild(browser.ie11below?UE.uNode.createText(" "):UE.uNode.createElement("br"));break;case"table":e.options.disabledTableInTable&&a(t)&&(t.parentNode.insertBefore(UE.uNode.createText(t.innerText()),t),t.parentNode.removeChild(t))}}})}),e.addOutputRule(function(t){var a;t.traversal(function(t){if("element"==t.type){if(e.options.autoClearEmptyNode&&dtd.$inline[t.tagName]&&!dtd.$empty[t.tagName]&&(!t.attrs||utils.isEmptyObject(t.attrs)))return void(t.firstChild()?"span"!=t.tagName||t.attrs&&!utils.isEmptyObject(t.attrs)||t.parentNode.removeChild(t,!0):t.parentNode.removeChild(t));switch(t.tagName){case"div":(a=t.getAttr("cdata_tag"))&&(t.tagName=a,t.appendChild(UE.uNode.createText(t.getAttr("cdata_data"))),t.setAttr({cdata_tag:"",cdata_data:"",_ue_custom_node_:""}));break;case"a":(a=t.getAttr("_href"))&&t.setAttr({href:utils.html(a),_href:""});break;case"span":a=t.getAttr("id"),a&&/^_baidu_bookmark_/i.test(a)&&t.parentNode.removeChild(t);break;case"img":(a=t.getAttr("_src"))&&t.setAttr({src:t.getAttr("_src"),_src:""})}}})})};
module("core.node"),test("createElement",function(){var e=UE.uNode,t=e.createElement("div");equals(t.tagName,"div","空div ——tagname"),equals(t.type,"element","空div ——节点类型"),t=e.createElement('<div id="aa">sdfadf</div>'),equals(t.tagName,"div","非空div——tagname"),equals(t.children[0].data,"sdfadf","非空div——数据内容")}),test("getNodeById",function(){var e=UE.uNode,t=e.createElement('<div id="aa"><div id="bb"></div>sdfadf</div>');t=t.getNodeById("bb"),equals(t.getAttr("id"),"bb","获取标签id"),t=e.createElement('<div id="aa"><div id="bb"><div id="cc"></div> </div>sdfadf</div>'),t=t.getNodeById("cc"),equals(t.getAttr("id"),"cc","获取标签id")}),test("getNodesByTagName",function(){var e=UE.uNode,t=e.createElement('<div id="aa"><div id="bb"><div id="cc"></div> </div>sdfadf</div>'),d=t.getNodesByTagName("div");equals(d.length,2,"div节点列表长度"),equals(t.innerHTML().replace(/[ ]+>/g,">"),'<div id="bb"><div id="cc"></div></div>sdfadf',"innerHTML内容")}),test("innerHTML",function(){var e=UE.uNode,t=e.createElement('<div id="aa">sdfadf</div>');t.innerHTML("<div><div><div></div></div></div>");var d=t.getNodesByTagName("div");equals(d.length,3,"div节点列表长度");for(var i,r=0;i=d[r++];)i.tagName="p";equals(t.innerHTML(),"<p><p><p></p></p></p>","innerHTML内容"),t=e.createElement("<div></div>"),t.innerHTML("asdf"),equals(t.innerHTML(),"asdf","innerHTML内容")}),test("innerText",function(){var e=new UE.uNode.createElement("area");e.innerHTML("<p></p>"),equals(e.innerText(),e,"标签类型特殊"),e=new UE.uNode.createText(""),e.innerHTML("<p></p>"),equals(e.innerText(),e,"对象类型不为element");var t=UE.uNode,d=t.createElement('<div id="aa">sdfadf</div>');d.innerHTML("<p>dfsdfsdf<b>eee</b>sdf</p>"),equals(d.innerText(),"dfsdfsdfeeesdf","获取标签中纯文本"),d.innerText("sdf"),equals(d.innerHTML(),"sdf","设置文本节点")}),test("getData",function(){var e=new UE.uNode.createElement("div");equals(e.getData(),"","element元素"),e=new UE.uNode.createText("askdj"),equals(e.getData(),"askdj","其他类型")}),test("appendChild && insertBefore",function(){var e=UE.uNode,t=e.createElement('<div id="aa">sdfadf</div>');t.innerHTML("<p><td></td></p>"),equals(t.innerHTML().replace(/[ ]+>/g,">"),"<p><table><tbody><tr><td></td></tr></tbody></table></p>","补全html标签");var d=e.createElement("div");t.appendChild(d),equals(t.innerHTML().replace(/[ ]+>/g,">"),"<p><table><tbody><tr><td></td></tr></tbody></table></p><div></div>","appendChild"),t.insertBefore(d,t.firstChild()),equals(t.innerHTML().replace(/[ ]+>/g,">"),"<div></div><p><table><tbody><tr><td></td></tr></tbody></table></p>","insertBefore"),t.appendChild(d),equals(t.innerHTML().replace(/[ ]+>/g,">"),"<p><table><tbody><tr><td></td></tr></tbody></table></p><div></div>","appendChild")}),test("replaceChild && setAttr",function(){var e=UE.uNode,t=e.createElement('<div id="aa">sdfadf</div>');t.innerHTML("<p><table><tbody><tr><td></td></tr></tbody></table></p><div></div>");var d=e.createElement("p");d.setAttr({"class":"test",id:"aa"}),t.insertBefore(d,t.lastChild()),equals(t.innerHTML().replace(/[ ]+>/g,">"),'<p><table><tbody><tr><td></td></tr></tbody></table></p><p class="test" id="aa"></p><div></div>',"setAttr不为空"),t.replaceChild(e.createElement("div"),d),equals(t.innerHTML().replace(/[ ]+>/g,">"),"<p><table><tbody><tr><td></td></tr></tbody></table></p><div></div><div></div>","replaceChild"),t.removeChild(t.lastChild(),!0),d=e.createElement("p"),d.setAttr(),t.insertAfter(d,t.lastChild()),equals(t.innerHTML().replace(/[ ]+>/g,">"),"<p><table><tbody><tr><td></td></tr></tbody></table></p><div></div><p></p>","setAttr为空"),t.innerHTML("<p><td></td></p>"),d=e.createElement("div"),t.appendChild(d),t.replaceChild(t.firstChild(),d),equals(t.innerHTML().replace(/[ ]+>/g,">"),"<p><table><tbody><tr><td></td></tr></tbody></table></p>","replaceChild")}),test("insertAfter",function(){var e=UE.uNode,t=e.createElement('<div id="aa">sdfadf</div>');t.innerHTML("<p><td></td></p>");var d=e.createElement("div");t.appendChild(d),t.insertAfter(d,t.firstChild()),equals(t.innerHTML().replace(/[ ]+>/g,">"),"<p><table><tbody><tr><td></td></tr></tbody></table></p><div></div>","在第一个子节点后插入")}),test("getStyle",function(){var e=UE.uNode,t=e.createElement("div");t.innerHTML('<div style=""><div>'),t=t.firstChild(),equals(t.getStyle(""),"","空cssStyle"),t.innerHTML('<div style="border:1px solid #ccc"><div>'),t=t.firstChild(),equals(t.getStyle("border"),"1px solid #ccc","有border，取border样式"),t.innerHTML('<div style="border:1px solid #ccc"><div>'),t=t.firstChild(),equals(t.getStyle("color"),"","无color样式，取color样式"),t.innerHTML('<div style=" border:1px solid #ccc; background-color:#fff; color:#ccc"></div>'),t=t.firstChild(),equals(t.getStyle("color"),"#ccc","有2个样式，取其一")}),test("setStyle",function(){var e=UE.uNode,t=e.createElement("div");t.innerHTML('<div style="border:1px solid #ccc;color:#ccc"><div>'),t=t.firstChild(),t.setStyle("border","2px solid #ccc"),equals(t.getAttr("style"),"border:2px solid #ccc;color:#ccc","修改样式中的一个"),t.setStyle({font:"12px",background:"#ccc"}),equals(t.getAttr("style"),"background:#ccc;font:12px;border:2px solid #ccc;color:#ccc","添加新样式"),t.setStyle({font:"",background:"",border:"",color:""}),equals(t.getAttr("style"),void 0,"清空样式"),t.setStyle("border",'<script>alert("")</script>'),equals(t.getAttr("style"),"border:&lt;script&gt;alert(&quot;&quot;)&lt;/script&gt;;","脚本"),equals(t.toHtml(),'<div style="border:&lt;script&gt;alert(&quot;&quot;)&lt;/script&gt;;"><div></div></div>',"脚本转html"),t.innerHTML("<div>asdfasdf<b>sdf</b></div>"),t.removeChild(t.firstChild(),!0),equals(t.toHtml(),'<div style="border:&lt;script&gt;alert(&quot;&quot;)&lt;/script&gt;;">asdfasdf<b>sdf</b></div>',"移除子节点"),t.innerHTML('<div style="border:1px solid #ccc;color:#ccc"></div>'),t.firstChild().setStyle("border"),equals(t.firstChild().toHtml(),'<div style="color:#ccc"></div>',"删除分号"),t.innerHTML('<div style="border:1px solid #ccc;color:#ccc" dfasdfas="sdfsdf" sdfsdf="sdfsdfs" ></div>'),equals(t.firstChild().toHtml(),'<div style="border:1px solid #ccc;color:#ccc" dfasdfas="sdfsdf" sdfsdf="sdfsdfs"></div>'),t.innerHTML('<div style=" border:1px "></div>'),t.firstChild().setStyle("border"),equals(t.firstChild().toHtml(),"<div></div>"),t.innerHTML('<div style=" border:1px solid #ccc; background-color:#fff; color:#ccc"></div>'),t.firstChild().setStyle("border"),equals(t.firstChild().toHtml(),'<div style="background-color:#fff; color:#ccc"></div>'),t.firstChild().setStyle("color"),equals(t.firstChild().toHtml(),'<div style="background-color:#fff;"></div>'),t.firstChild().setStyle("background-color"),equals(t.firstChild().toHtml(),"<div></div>")}),test("getIndex",function(){var e=UE.uNode,t=e.createElement("div");t.innerHTML("<div>asdfasdf<b>sdf</b></div>"),t.removeChild(t.firstChild(),!0);var d=new UE.uNode.createElement("div");t.appendChild(d),equals(d.getIndex(),2,"节点索引")}),test("traversal",function(){var e=UE.uNode,t=e.createElement("div");t.innerHTML("<div>asdfasdf<b>sdf</b></div>");var d=0;t.traversal(function(e){d++}),equals(d,4),d=0,t.traversal(function(e){"text"==e.type&&d++}),equals(d,2),t.traversal(function(e){"text"==e.type&&e.parentNode.removeChild(e)}),equals(t.toHtml(),"<div><div><b></b></div></div>"),t.innerHTML("<div>asdfasdf<b>sdf</b></div>"),t.traversal(function(t){if("text"==t.type){var d=e.createElement("span");t.parentNode.insertBefore(d,t),d.appendChild(t)}}),equals(t.toHtml(),"<div><div><span>asdfasdf</span><b><span>sdf</span></b></div></div>")});
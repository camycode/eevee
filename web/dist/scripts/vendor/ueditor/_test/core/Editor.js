module("core.Editor"),test("contentchange在命令调用时的触发机制",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),e.ready(function(){e.commands.test1={execCommand:function(){e.body.innerHTML="1123"}};var t=0;e.on("contentchange",function(){t++}),e.commands.test={execCommand:function(){e.execCommand("test1")},ignoreContentChange:!0},setTimeout(function(){e.execCommand("test1"),equals(t,1),t=0,e.execCommand("test"),equals(t,0),start()},200)}),stop()}),test("initialStyle",function(){if(!ua.browser.gecko){var e=document.body.appendChild(document.createElement("div"));e.id="ue";var t=UE.getEditor("ue",{initialStyle:"body{font-family: arial black;}.testCss{        color: rgb(192, 0, 0);    }",initialContent:"<p><span class='testCss'>测试样式，红色，字体： arial black</span></p>",autoHeightEnabled:!1});t.ready(function(){equal(ua.formatColor(ua.getComputedStyle(t.body.firstChild.firstChild).color),"#c00000","initialStyle中设置的class样式有效"),ok(/arial black/.test(ua.getComputedStyle(t.body.firstChild.firstChild).fontFamily),"initialStyle中设置的body样式有效"),setTimeout(function(){UE.delEditor("ue"),te.dom.push(document.getElementById("ue")),start()},200)}),stop()}}),test("autoSyncData:true,textarea容器(由setcontent触发的)",function(){var e=document.body.appendChild(document.createElement("div"));e.innerHTML='<form id="form" method="post" target="_blank"><textarea id="myEditor" name="myEditor">这里的内容将会和html，body等标签一块提交</textarea></form>',equal(document.getElementById("form").childNodes.length,1,"form里只有一个子节点");var t=UE.getEditor("myEditor",{autoHeightEnabled:!1});stop(),t.ready(function(){equal(document.getElementById("form").childNodes.length,2,"form里有2个子节点"),t.setContent("<p>设置内容autoSyncData 1<br/></p>"),setTimeout(function(){var e=document.getElementById("form");equal(e.childNodes.length,2,"失去焦点,form里多了textarea"),equal(e.lastChild.tagName.toLowerCase(),"textarea","失去焦点,form里多了textarea"),equal(e.lastChild.value,"<p>设置内容autoSyncData 1<br/></p>","textarea内容正确"),setTimeout(function(){UE.delEditor("myEditor"),document.getElementById("form").parentNode.removeChild(document.getElementById("form")),document.getElementById("test1")&&te.dom.push(document.getElementById("test1")),start()},200)},100)})}),test("autoSyncData:true（由blur触发的）",function(){if(ua.browser.ie>8||!ua.browser.ie){var e=document.body.appendChild(document.createElement("div"));e.innerHTML='<form id="form" method="post" ><script type="text/plain" id="myEditor" name="myEditor"></script></form>';var t=UE.getEditor("myEditor",{autoHeightEnabled:!1});stop(),t.ready(function(){t.body.innerHTML="<p>设置内容autoSyncData 2<br/></p>",equal(document.getElementsByTagName("textarea").length,0,"内容空没有textarea"),ua.blur(t.body),stop(),setTimeout(function(){var e=document.getElementById("form");equal(e.childNodes.length,2,"失去焦点,form里多了textarea"),equal(e.lastChild.tagName.toLowerCase(),"textarea","失去焦点,form里多了textarea"),equal(e.lastChild.value,"<p>设置内容autoSyncData 2<br/></p>","textarea内容正确"),UE.delEditor("myEditor"),e.parentNode.removeChild(e),start()},200)})}}),test("sync",function(){var e=document.body.appendChild(document.createElement("div"));e.innerHTML='<form id="form" method="post" target="_blank"><textarea id="myEditor" name="myEditor">这里的内容将会和html，body等标签一块提交</textarea></form>';var t=UE.getEditor("myEditor",{autoHeightEnabled:!1});stop(),t.ready(function(){t.body.innerHTML="<p>hello</p>",t.sync("form"),setTimeout(function(){var t=document.getElementById("form");equal(t.lastChild.value,"<p>hello</p>","同步内容正确"),e=t.parentNode,UE.delEditor("myEditor"),e.parentNode.removeChild(e),start()},100)})}),test("hide,show",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),e.ready(function(){equal(e.body.getElementsByTagName("span").length,0,"初始没有书签"),e.hide(),setTimeout(function(){equal($(e.container).css("display"),"none","隐藏编辑器"),equal(e.body.getElementsByTagName("span").length,1,"插入书签"),ok(/_baidu_bookmark_start/.test(e.body.getElementsByTagName("span")[0].id),"书签"),e.show(),setTimeout(function(){equal($(te.dom[0]).css("display"),"block","显示编辑器");ua.browser.ie?"":"<br>";equal(ua.getChildHTML(e.body),"<p>tool</p>","删除书签"),start()},50)},50)}),stop()}),test("_setDefaultContent--focus",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),e.ready(function(){e._setDefaultContent("hello"),e.fireEvent("focus"),setTimeout(function(){var t=ua.browser.ie?"":"<br>";equal(ua.getChildHTML(e.body),"<p>"+t+"</p>","focus"),start()},50)}),stop()}),test("_setDefaultContent--firstBeforeExecCommand",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),e.ready(function(){e._setDefaultContent("hello"),e.fireEvent("firstBeforeExecCommand"),setTimeout(function(){var t=ua.browser.ie?"":"<br>";equal(ua.getChildHTML(e.body),"<p>"+t+"</p>","firstBeforeExecCommand"),start()},50)}),stop()}),test("setDisabled,setEnabled",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),e.ready(function(){e.setContent("<p>欢迎使用ueditor!</p>"),e.focus(),setTimeout(function(){var t=e.selection.getRange().startContainer.outerHTML,o=e.selection.getRange().startOffset,n=e.selection.getRange().collapsed;e.setDisabled(),setTimeout(function(){equal(e.body.contentEditable,"false","setDisabled"),equal(e.body.firstChild.firstChild.tagName.toLowerCase(),"span","插入书签"),equal($(e.body.firstChild.firstChild).css("display"),"none","检查style"),equal($(e.body.firstChild.firstChild).css("line-height"),"0px","检查style"),ok(/_baidu_bookmark_start/.test(e.body.firstChild.firstChild.id),"书签"),e.setEnabled(),setTimeout(function(){equal(e.body.contentEditable,"true","setEnabled"),equal(ua.getChildHTML(e.body),"<p>欢迎使用ueditor!</p>","内容恢复"),(!ua.browser.ie||ua.browser.ie<9)&&equal(e.selection.getRange().startContainer.outerHTML,t,"检查range"),equal(e.selection.getRange().startOffset,o,"检查range"),equal(e.selection.getRange().collapsed,n,"检查range"),start()},50)},50)},50)}),stop()}),test("render-- element",function(){var e=new baidu.editor.Editor({UEDITOR_HOME_URL:"../../../",autoFloatEnabled:!1}),t=document.body.appendChild(document.createElement("div"));equal(t.innerHTML,"","before render"),e.render(t),equal(t.firstChild.tagName.toLocaleLowerCase(),"iframe","check iframe"),ok(/ueditor_/.test(t.firstChild.id),"check iframe id"),te.dom.push(t)}),test("render-- elementid",function(){var e=te.obj[1],t=te.dom[0];e.render(t.id),equal(t.firstChild.tagName.toLocaleLowerCase(),"iframe","check iframe"),ok(/ueditor_/.test(t.firstChild.id),"check iframe id")}),test("render-- options",function(){var e={initialContent:'<span class="span">xxx</span><div>xxx<p></p></div>',UEDITOR_HOME_URL:"../../../",autoClearinitialContent:!1,autoFloatEnabled:!1},t=new baidu.editor.Editor(e),o=document.body.appendChild(document.createElement("div"));t.render(o);var n=baidu.editor.browser.ie?"&nbsp;":"<br>";stop(),t.ready(function(){equal(ua.getChildHTML(t.body),'<p><span class="span">xxx</span></p><p>xxx</p><p>'+n+"</p>","check initialContent"),te.dom.push(o),start()})}),test("destroy",function(){var e=new UE.ui.Editor({autoFloatEnabled:!1});e.key="ed";var t=document.body.appendChild(document.createElement("div"));t.id="ed",e.render(t),e.ready(function(){setTimeout(function(){e.destroy(),equal(document.getElementById("ed").tagName.toLowerCase(),"textarea","容器被删掉了"),document.getElementById("ed")&&te.dom.push(document.getElementById("ed")),start()},200)}),stop()}),test("testBindshortcutKeys",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),expect(1),e.ready(function(){e.addshortcutkey({testBindshortcutKeys:"ctrl+67"}),e.commands.testbindshortcutkeys={execCommand:function(e){ok(1,"")},queryCommandState:function(){return 0}},ua.keydown(e.body,{keyCode:67,ctrlKey:!0}),setTimeout(function(){start()},200)}),stop()}),test("getContent--转换空格，nbsp与空格相间显示",function(){var e=te.obj[1],t=te.dom[0];e.render(t),stop(),e.ready(function(){setTimeout(function(){e.focus();var t="<div> x  x   x&nbsp;&nbsp;&nbsp;&nbsp;x&nbsp;&nbsp;  &nbsp;</div>";e.setContent(t),equal(e.getContent(),"<p>x &nbsp;x &nbsp; x&nbsp;&nbsp;&nbsp;&nbsp;x&nbsp;&nbsp; &nbsp;&nbsp;</p>","转换空格，nbsp与空格相间显示，原nbsp不变"),setTimeout(function(){start()},100)},100)})}),test("getContent--参数为函数",function(){var e=te.obj[1],t=te.dom[0];e.render(t),stop(),e.ready(function(){e.focus(),e.setContent("<p><br/>dd</p>"),equal(e.getContent(),"<p><br/>dd</p>","hasContents判断不为空"),equal(e.getContent(function(){return!1}),"","为空"),setTimeout(function(){setTimeout(function(){start()},50)},100)})}),test("getContent--2个参数，第一个参数为参数为函数",function(){var e=te.obj[1],t=te.dom[0];e.render(t),stop(),e.ready(function(){e.focus(),e.setContent("<p><br/>dd</p>"),equal(e.getContent(),"<p><br/>dd</p>","hasContents判断不为空"),equal(e.getContent("",function(){return!1}),"","为空"),setTimeout(function(){start()},100)})}),test("setContent",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),stop(),e.ready(function(){e.focus(),expect(2),e.addListener("beforesetcontent",function(){ok(!0,"beforesetcontent")}),e.addListener("aftersetcontent",function(){ok(!0,"aftersetcontent")});var t="<span><span></span><strong>xx</strong><em>em</em><em></em><u></u></span><div>xxxx</div>";e.setContent(t);var o=document.createElement("div");o.innerHTML='<p><span><span></span><strong>xx</strong><em>em</em><em></em><span style="text-decoration: underline"></span></span></p><div>xxxx</div>';var n=document.createElement("div");n.innerHTML=e.body.innerHTML,ua.haveSameAllChildAttribs(n,o,"check contents"),start()})}),test("setContent 追加",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),stop(),e.ready(function(){e.focus(),expect(2),e.addListener("beforesetcontent",function(){ok(!0,"beforesetcontent")}),e.addListener("aftersetcontent",function(){ok(!0,"aftersetcontent")});var t="<span><span></span><strong>xx</strong><em>em</em><em></em><u></u></span><div>xxxx</div>";e.setContent(t);var o=document.createElement("div");o.innerHTML='<p><span><span></span><strong>xx</strong><em>em</em><em></em><span style="text-decoration: underline"></span></span></p><div>xxxx</div>';var n=document.createElement("div");n.innerHTML=e.body.innerHTML,ua.haveSameAllChildAttribs(n,o,"check contents"),start()},50)}),test("focus(false)",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),stop(),e.ready(function(){e.setContent("<p>hello1</p><p>hello2</p>"),setTimeout(function(){e.focus(!1),setTimeout(function(){var t=e.selection.getRange();equal(t.startOffset,0,"focus(false)焦点在最前面"),equal(t.endOffset,0,"focus(false)焦点在最前面"),ua.browser.gecko||ua.browser.webkit?(equal(t.startContainer,e.body.firstChild,"focus(false)焦点在最前面"),equal(t.collapsed,!0,"focus(false)焦点在最前面")):(equal(t.startContainer,e.body.firstChild.firstChild,"focus(false)焦点在最前面"),equal(t.endContainer,e.body.firstChild.firstChild,"focus(false)焦点在最前面")),start()},200)},100)})}),test("focus(true)",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),stop(),e.ready(function(){e.setContent("<p>hello1</p><p>hello2</p>"),setTimeout(function(){e.focus(!0),setTimeout(function(){ua.browser.gecko||ua.browser.webkit?(equal(e.selection.getRange().startContainer,e.body.lastChild,"focus( true)焦点在最后面"),equal(e.selection.getRange().endContainer,e.body.lastChild,"focus( true)焦点在最后面"),equal(e.selection.getRange().startOffset,e.body.lastChild.childNodes.length,"focus( true)焦点在最后面"),equal(e.selection.getRange().endOffset,e.body.lastChild.childNodes.length,"focus( true)焦点在最后面")):(equal(e.selection.getRange().startContainer,e.body.lastChild.lastChild,"focus( true)焦点在最后面"),equal(e.selection.getRange().endContainer,e.body.lastChild.lastChild,"focus( true)焦点在最后面"),equal(e.selection.getRange().startOffset,e.body.lastChild.lastChild.length,"focus( true)焦点在最后面"),equal(e.selection.getRange().endOffset,e.body.lastChild.lastChild.length,"focus( true)焦点在最后面")),start()},200)},100)})}),test("isFocus()",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),stop(),e.ready(function(){e.focus(),setTimeout(function(){ok(e.isFocus()),start()},200)})}),test("blur()",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),stop(),e.ready(function(){e.focus(),ok(e.isFocus()),e.blur(),ok(!e.isFocus()),e.blur(),ok(!e.isFocus()),start()})}),test("_initEvents,_proxyDomEvent--click",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),stop(),e.ready(function(){e.focus(),expect(1),stop(),e.addListener("click",function(){ok(!0,"click event dispatched"),start()}),ua.click(e.document)})}),test("queryCommandState",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),stop(),e.ready(function(){e.focus(),e.setContent("<p><b>xxx</b>xxx</p>");var t=e.document.getElementsByTagName("p")[0],o=new baidu.editor.dom.Range(e.document);o.setStart(t.firstChild,0).setEnd(t.firstChild,1).select(),equal(e.queryCommandState("bold"),1,"加粗状态为1"),o.setStart(t,1).setEnd(t,2).select(),setTimeout(function(){equal(e.queryCommandState("bold"),0,"加粗状态为0"),start()},100)})}),test("queryCommandValue",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),stop(),e.ready(function(){e.focus(),e.setContent('<p style="text-align:left">xxx</p>');var t=new baidu.editor.dom.Range(e.document),o=e.document.getElementsByTagName("p")[0];t.selectNode(o).select(),equal(e.queryCommandValue("justify"),"left","text align is left"),start()})}),test("execCommand",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),stop(),e.ready(function(){e.focus(),e.setContent("<p>xx</p><p>xxx</p>");var t=e.document,o=new baidu.editor.dom.Range(t),n=t.getElementsByTagName("p")[1];o.setStart(n,0).setEnd(n,1).select(),e.execCommand("justify","right"),equal($(n).css("text-align"),"right","execCommand align"),o.selectNode(n).select(),e.execCommand("forecolor","red");var s=t.getElementsByTagName("span")[0];equal(s.style.color,"red","check execCommand color");var a=document.createElement("div");a.innerHTML='<p><span style="color: red; ">xx</span></p><p style="text-align: right; ">xxx</p>';var d=document.createElement("div");d.innerHTML=e.body.innerHTML,ok(ua.haveSameAllChildAttribs(a,d),"check style"),start()})}),test("hasContents",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),stop(),e.ready(function(){e.focus(),e.setContent(""),ok(!e.hasContents(),"have't content"),e.setContent("xxx"),ok(e.hasContents(),"has contents"),e.setContent("<p><br/></p>"),ok(!e.hasContents(),"空p认为是空"),start()})}),test("hasContents--有参数",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),stop(),e.ready(function(){e.focus(),e.setContent('<p><img src="" alt="">你好<ol><li>ddd</li></ol></p>'),ok(e.hasContents(["ol","li","table"]),"有ol和li"),ok(e.hasContents(["td","li","table"]),"有li"),e.setContent("<p><br></p>"),ok(!e.hasContents([""]),"为空"),ok(e.hasContents(["br"]),"不为空"),start()})}),test("trace 1964 getPlainTxt--得到有格式的编辑器的纯文本内容",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),stop(),e.ready(function(){e.focus(),e.setContent("<p>&nbsp;</p><p>&nbsp; hell\no<br/>hello</p>");var t=ua.browser.ie>0&&ua.browser.ie<9?"\n  hell o\nhello\n":"\n  hello\nhello\n";equal(e.getPlainTxt(),t,"得到编辑器的纯文本内容，但会保留段落格式"),start()})}),test("getContentTxt--文本前后的空格,&nbs p转成空格",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),stop(),e.ready(function(){e.focus(),e.setContent("&nbsp;&nbsp;你 好&nbsp;&nbsp; "),equal(e.getContentTxt(),"  你 好   "),equal(e.getContentTxt().length,8,"8个字符，空格不被过滤"),start()})}),test("getAllHtml",function(){var e=te.obj[1],t=te.dom[0];$(t).css("width","500px").css("height","500px").css("border","1px solid #ccc"),e.render(t),stop(),e.ready(function(){e.focus();var t=e.getAllHtml();ok(/iframe.css/.test(t),"引入样式"),start()})}),test("2个实例采用2个配置文件",function(){var e=document.getElementsByTagName("head")[0],t=document.createElement("script");t.type="text/javascript",t.src="../../editor_config.js",e.appendChild(t),expect(6),stop(),setTimeout(function(){var e=document.body.appendChild(document.createElement("div"));e.id="div1",e.style.height="200px";var t=document.body.appendChild(document.createElement("div"));t.id="div2";var o=UE.getEditor("div1",{UEDITOR_HOME_URL:"../../../",initialContent:"欢迎使用ueditor",autoFloatEnabled:!1});o.ready(function(){var e=UE.getEditor("div2",UEDITOR_CONFIG2);e.ready(function(){equal(o.ui.getDom("iframeholder").style.height,"200px","编辑器高度为200px"),equal(e.ui.getDom("iframeholder").style.height,"400px","自定义div高度为400px");var t=UEDITOR_CONFIG2.initialContent;ua.checkHTMLSameStyle(t,e.document,e.body.firstChild,"初始内容为自定制的"),equal(e.options.enterTag,"br","enterTag is br"),t="欢迎使用ueditor",equal(t,o.body.firstChild.innerHTML,"内容和ueditor.config一致"),equal(o.options.enterTag,"p","enterTag is p"),setTimeout(function(){UE.delEditor("div1"),UE.delEditor("div2"),document.getElementById("div1")&&te.dom.push(document.getElementById("div1")),document.getElementById("div2")&&te.dom.push(document.getElementById("div2")),start()},500)})})},300)}),test("绑定事件",function(){document.onmouseup=function(e){ok(!0,"mouseup is fired")},document.onmousedown=function(e){ok(!0,"mousedown is fired")},document.onmouseover=function(e){ok(!0,"mouseover is fired")},document.onkeydown=function(e){ok(!0,"keydown is fired")},document.onkeyup=function(e){ok(!0,"keyup is fired")};var e=new baidu.editor.Editor({autoFloatEnabled:!1}),t=document.body.appendChild(document.createElement("div"));e.render(t),expect(5),e.ready(function(){setTimeout(function(){e.focus(),ua.mousedown(document.body),ua.mouseup(document.body),ua.mouseover(document.body),ua.keydown(document.body,{keyCode:13}),ua.keyup(document.body,{keyCode:13}),setTimeout(function(){document.getElementById("div")&&te.dom.push(document.getElementById("div")),start()},1e3)},50)}),stop()});
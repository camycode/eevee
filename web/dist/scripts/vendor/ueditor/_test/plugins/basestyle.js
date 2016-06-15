module("plugins.basestyle"),test("sub--table",function(){var e=te.obj[0];setTimeout(function(){e.setContent('<table border="solid"><tr><td>hello1</td><td>hello2</td></tr><tr><td>hello3</td><td>hello4</td></tr></table>'),setTimeout(function(){var t=te.obj[1],l=e.document.body,o=e.document.getElementsByTagName("table")[0].firstChild;t.selectNode(l.firstChild).select();l.firstChild.getElementsByTagName("td");e.execCommand("subscript"),setTimeout(function(){equal(ua.getChildHTML(o.firstChild.firstChild),"<sub>hello1</sub>","检查第1个单元格中文本是否是下标"),equal(ua.getChildHTML(o.firstChild.firstChild.nextSibling),"<sub>hello2</sub>","检查第2个单元格中文本是否是下标"),equal(ua.getChildHTML(o.lastChild.firstChild),"<sub>hello3</sub>","检查第3个单元格中文本是否是下标"),equal(ua.getChildHTML(o.lastChild.firstChild.nextSibling),"<sub>hello4</sub>","检查第4个单元格中文本是否是下标"),equal(e.queryCommandState("superscript"),0,"check sup state"),equal(e.queryCommandState("subscript"),1,"check sub state"),e.execCommand("subscript"),equal(o.firstChild.firstChild.innerHTML,"hello1","检查第1个单元格中文本是否不是下标"),equal(o.firstChild.firstChild.nextSibling.innerHTML,"hello2","检查第2个单元格中文本是否不是下标"),equal(o.lastChild.firstChild.innerHTML,"hello3","检查第3个单元格中文本是否不是下标"),equal(o.lastChild.firstChild.nextSibling.innerHTML,"hello4","检查第4个单元格中文本是否你是下标"),equal(e.queryCommandState("superscript"),0,"check sup state"),equal(e.queryCommandState("subscript"),0,"check sub state"),e.execCommand("superscript"),equal(ua.getChildHTML(o.firstChild.firstChild),"<sup>hello1</sup>","检查第1个单元格中文本是否是上标"),equal(ua.getChildHTML(o.firstChild.firstChild.nextSibling),"<sup>hello2</sup>","检查第2个单元格中文本是否是上标"),equal(ua.getChildHTML(o.lastChild.firstChild),"<sup>hello3</sup>","检查第3个单元格中文本是否是上标"),equal(ua.getChildHTML(o.lastChild.firstChild.nextSibling),"<sup>hello4</sup>","检查第4个单元格中文本是否是上标"),equal(e.queryCommandState("superscript"),1,"check sup state"),equal(e.queryCommandState("subscript"),0,"check sub state"),start()},50)},50)},50),stop()}),test("闭合插入上下标",function(){var e=te.obj[0],t=te.obj[1];e.setContent("<p>你好</p>");var l=e.body;stop(),setTimeout(function(){t.setStart(l.firstChild.firstChild,1).collapse(1).select(!0),e.execCommand("superscript"),equal(ua.getChildHTML(l.firstChild),"你<sup></sup>好","查看执行上标后的结果"),t=e.selection.getRange(),t.insertNode(e.document.createTextNode("hello")),equal(ua.getChildHTML(l.firstChild),"你<sup>hello</sup>好","上标标签中插入文本"),start()},100)}),test("不闭合插入上下标",function(){var e=te.obj[0],t=te.obj[1];e.setContent('<strong>hello1<em>hello2</em></strong><a href="http://www.baid.com/"><strong>baidu_link</strong></a>hello3');var l=e.document.body;stop(),setTimeout(function(){t.setStart(l.firstChild.firstChild,0).setEnd(l.firstChild.lastChild,3).select(),e.execCommand("superscript"),ua.manualDeleteFillData(l),ua.checkSameHtml(e.getContent(),'<p><sup><strong>hello1<em>hello2</em></strong></sup><a href="http://www.baid.com/" ><sup><strong>baidu_link</strong></sup></a><sup>hel</sup>lo3</p>',"普通文本添加上标"),start()},100)}),test("trace 870:加粗文本前面去加粗",function(){var e=te.obj[0],t=e.body,l=te.obj[1];e.setContent("<p><br></p>"),l.setStart(t.firstChild,0).collapse(!0).select(),e.execCommand("bold"),l=e.selection.getRange(),l.insertNode(e.document.createTextNode("hello")),equal(e.queryCommandState("bold"),1,"加粗"),e.execCommand("bold"),l=e.selection.getRange(),equal(e.queryCommandState("bold"),0,"不加粗"),l.insertNode(e.document.createTextNode("hello2")),ua.manualDeleteFillData(e.body),ua.browser.chrome||ua.browser.safari||ua.browser.ie&&ua.browser.ie>8&&ua.browser.ie<11?equal(e.getContent(),"<p>hello2<strong>hello</strong><br/></p>"):equal(e.getContent(),"<p><strong>hello</strong>hello2<br/></p>")}),test("bold-在已加粗文本中间去除加粗",function(){var e=te.obj[0],t=e.body,l=te.obj[1];e.setContent("<b>hello</b>ssss"),l.setStart(t.firstChild.firstChild,0).collapse(!0).select(),e.execCommand("bold"),l=e.selection.getRange(),equal(e.queryCommandState("bold"),0,"<strong> 被去掉"),l.insertNode(l.document.createTextNode("aa")),ua.manualDeleteFillData(e.body),equal(ua.getChildHTML(t.firstChild),"aa<strong>hello</strong>ssss","新文本节点没有加粗")}),test("bold-在已加粗文本中间去除加粗",function(){var e=te.obj[0],t=e.body;te.obj[1];e.setContent(""),e.execCommand("bold"),ok(ua.getChildHTML(t),"<stong></stong>","editor不focus时点加粗，不会多一个空行")}),test("bold-加粗状态反射",function(){var e=te.obj[0],t=e.body,l=te.obj[1];e.setContent("<p>this is a dog</p>"),stop(),setTimeout(function(){l.selectNode(t.firstChild).select(),e.execCommand("bold"),l.setStart(t.firstChild.firstChild.firstChild,2).collapse(!0).select(),equal(e.queryCommandState("bold"),1,"闭合选择，加粗高亮"),ua.manualDeleteFillData(e.body),l.setStart(t.firstChild.firstChild.firstChild,0).setEnd(t.firstChild.firstChild.lastChild,4).select(),equal(e.queryCommandState("bold"),1,"不闭合选择，加粗高亮"),start()},100)}),test("bold-连续加粗2次",function(){var e=te.obj[0],t=e.body,l=te.obj[1];e.setContent("<p>this is a dog</p>");var o=t.firstChild.firstChild;l.setStart(o,0).setEnd(o,3).select(),e.execCommand("bold"),equal(e.queryCommandState("bold"),1,"加粗按钮高亮"),o=t.firstChild.lastChild,l.setStart(o,1).setEnd(o,3).select(),equal(e.queryCommandState("bold"),0,"不闭合选择，加粗不高亮"),ua.manualDeleteFillData(e.body),e.execCommand("bold"),equal(e.queryCommandState("bold"),1,"加粗高亮")}),test("bold-2个单词，中间有空格第一个单词加粗，第二个单词加粗再去加粗",function(){var e=te.obj[0],t=e.body,l=te.obj[1];t.innerHTML="<p>hello world</p>";var o=t.firstChild.firstChild;l.setStart(o,0).setEnd(o,5).select(),e.execCommand("bold"),o=t.firstChild.lastChild,l.setStart(o,1).setEnd(o,6).select(),e.execCommand("bold"),e.execCommand("bold"),ok(3==t.firstChild.childNodes.length&&1==t.firstChild.childNodes[1].length,"空格保留")}),test("测试 userAction.manualdeleteFilldata",function(){var e=te.obj[0],t=e.body;te.obj[1];e.setContent("<p></p>");var l=e.document.createTextNode(domUtils.fillChar);t.appendChild(l);var o=ua.browser.ie?"&nbsp;":"<br>";notEqual(t.innerHTML.toLowerCase(),"<p>"+o+"</p>","清除不可见字符前不相等"),ua.manualDeleteFillData(t),equal(t.innerHTML.toLowerCase(),"<p>"+o+"</p>","清除不可见字符后相等")}),test("trace 1884:单击B再单击I ",function(){var e=te.obj[0],t=e.body,l=te.obj[1];e.setContent(""),l.setStart(t.firstChild,0).collapse(1).select(),e.execCommand("bold"),equal(e.queryCommandState("bold"),1,"b高亮"),e.execCommand("italic"),equal(e.queryCommandState("italic"),1,"b高亮")}),test("单击B再在其他地方单击I，空的strong标签被删除 ",function(){var e=te.obj[0],t=e.body,l=te.obj[1];e.setContent("<p>hello</p>"),l.setStart(t.firstChild,0).collapse(1).select(),e.execCommand("bold"),equal(e.queryCommandState("bold"),1,"b高亮"),l.setStart(t.firstChild,1).collapse(1).select(),e.execCommand("italic"),equal(e.queryCommandState("italic"),1,"b高亮"),ua.manualDeleteFillData(t),ua.browser.ie||equal(t.innerHTML.toLowerCase(),"<p><em></em>hello</p>","空strong标签被删除")}),test("ctrl+i",function(){var e=te.obj[0],t=e.body,l=te.obj[1];e.setContent("<p>没有加粗的文本</p>"),l.selectNode(t.firstChild).select();var o=t.firstChild;setTimeout(function(){ua.keydown(e.body,{keyCode:73,ctrlKey:!0}),e.focus(),setTimeout(function(){equal(ua.getChildHTML(o),"<em>没有加粗的文本</em>"),start()},150)},100),stop()}),test("ctrl+u",function(){var e=te.obj[0],t=e.body,l=te.obj[1];e.setContent("<p>没有加粗的文本</p>"),setTimeout(function(){l.selectNode(t.firstChild).select(),setTimeout(function(){var l='<span style="text-decoration: underline;">没有加粗的文本</span>';ua.checkHTMLSameStyle(l,e.document,t.firstChild,"文本被添加了下划线"),equal(e.body.firstChild.firstChild.style.textDecoration,"underline"),start()},150),ua.keydown(e.body,{keyCode:85,ctrlKey:!0})},150),stop()}),test("ctrl+b",function(){var e=te.obj[0],t=e.body,l=te.obj[1];e.setContent("<p>没有加粗的文本</p>"),l.selectNode(t.firstChild).select(),setTimeout(function(){ua.keydown(e.body,{keyCode:66,ctrlKey:!0}),setTimeout(function(){equal(ua.getChildHTML(t.firstChild),"<strong>没有加粗的文本</strong>"),start()},150)},150),stop()}),test("表格中文本加粗",function(){var e=te.obj[0],t=te.obj[1];e.setContent("<p></p>"),t.setStart(e.body.firstChild,0).collapse(!0).select(),e.execCommand("inserttable"),ua.manualDeleteFillData(e.body),setTimeout(function(){var l=e.body.getElementsByTagName("td");l[0].innerHTML="asd",l[10].innerHTML="asd";var o=e.body.firstChild.getElementsByTagName("tr"),s=e.getUETable(e.body.firstChild),a=s.getCellsRange(o[0].cells[0],o[2].cells[0]);s.setSelected(a),t.setStart(o[0].cells[0],0).collapse(!0).select(),e.execCommand("bold"),ua.manualDeleteFillData(e.body),equal(e.queryCommandState("bold"),1,"b高亮"),equal(o[0].cells[0].firstChild.tagName.toLowerCase(),"strong","[0][0]单元格中文本标签"),ua.browser.ie||equal(o[1].cells[0].firstChild.tagName.toLowerCase(),"br","[1][0]单元格中文本标签"),equal(o[2].cells[0].firstChild.tagName.toLowerCase(),"strong","[2][0]单元格中文本标签"),start()},50),stop()});
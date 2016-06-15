module("plugins.cleardoc"),test("取得焦点后清空后查看range",function(){var e=te.obj[0];e.setContent("<p>hello1</p><table><tr><td>hello2</td></tr></table>"),e.focus();var t=e.body;e.execCommand("cleardoc"),ua.manualDeleteFillData(e.body),UE.browser.ie?equal(ua.getChildHTML(t),"<p></p>"):equal(ua.getChildHTML(t),"<p><br></p>","清空文档")}),test("编辑器没有焦点，清空",function(){var e=te.obj[0];e.setContent("<p>hello1</p><table><tr><td>hello2</td></tr></table>");var t=e.body;e.execCommand("cleardoc"),ua.manualDeleteFillData(e.body),UE.browser.ie?equal(ua.getChildHTML(t),"<p></p>"):equal(ua.getChildHTML(t),"<p><br></p>","清空文档")}),test("enterTag为br",function(){var e=te.obj[0];e.options.enterTag="br",e.setContent("<table><tr><td>hello</td></tr></table>");var t=e.body;e.execCommand("cleardoc"),ua.manualDeleteFillData(e.body),UE.browser.ie?equal(ua.getChildHTML(t),"<br>","清空文档"):equal(ua.getChildHTML(t),"<br>","清空文档")}),test("删除时不会删除block元素",function(){if(ua.browser.opera)return 0;var e=te.obj[0];e.setContent("<h1>hello</h1>"),setTimeout(function(){var t=te.obj[1];t.selectNode(e.body.firstChild).select(),e.execCommand("cleardoc"),equal(e.body.lastChild.tagName.toLowerCase(),"p","h1替换为p"),ua.manualDeleteFillData(e.body),baidu.editor.browser.ie?equal(e.body.lastChild.innerHTML,"","内容被删除了"):equal(e.body.lastChild.innerHTML,"<br>","内容被删除了"),start()},50),stop()}),test("选中文本，清空",function(){var e=te.obj[0],t=te.obj[1];e.setContent("<p>hello</p><p>hello1</p>"),t.selectNode(e.body.firstChild).select(),e.execCommand("cleardoc");var l=ua.browser.ie?"":"<br>";equal(ua.getChildHTML(e.body),"<p>"+l+"</p>","")}),test("全选后删除",function(){var e=te.obj[0];baidu.editor.browser.ie?e.setContent("<p>dsafds&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>"):e.setContent("<p><br></p><p><br></p><p><br></p><p>d<br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p>"),setTimeout(function(){e.focus(),e.execCommand("selectall"),e.execCommand("cleardoc"),ua.manualDeleteFillData(e.body),equal(e.body.childNodes.length,1,"删除后只剩一个bolock元素"),equal(e.body.firstChild.tagName.toLowerCase(),"p","删除后只剩一个p"),UE.browser.ie?equal(e.body.lastChild.innerHTML,"","内容被删除了"):equal(e.body.lastChild.innerHTML,"<br>","内容被删除了"),start()},50),stop()}),test("删除所有列表",function(){var e=te.obj[0];e.setContent("<ol><li>hello1</li><li>你好</li></ol>"),setTimeout(function(){var t=e.body;e.focus(),e.execCommand("selectall"),e.execCommand("cleardoc"),equal(t.childNodes.length,1,"删除后只剩一个ol元素");var l=UE.browser.ie?"":"<br>";equal(ua.getChildHTML(t),"<p>"+l+"</p>","删除后只剩一个p"),start()},50),stop()});
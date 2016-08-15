module("plugins.blockquote"),test("在表格中添加和去除引用",function(){var e=te.obj[0],l=te.obj[1];e.setContent("hello<table><tbody><tr><td>hello</td></tr></tbody></table>");var t=e.body,o=t.lastChild.getElementsByTagName("td");l.setStart(o[0].firstChild,2).collapse(!0).select(),e.execCommand("blockquote"),equal(t.lastChild.tagName.toLowerCase(),"blockquote","引用加到表格外面去了"),equal(o[0].firstChild.nodeType,3,"td里仍然是文本"),equal(o[0].firstChild.data,"he","td里仍然是文本he"),l.setStart(o[0].firstChild,2).collapse(!0).select(),e.execCommand("blockquote"),ok("blockquote"!=t.lastChild.tagName.toLowerCase(),"引用去掉了"),stop(),setTimeout(function(){o=t.lastChild.getElementsByTagName("td"),l.selectNode(o[0]).select(),e.execCommand("blockquote"),equal(t.lastChild.tagName.toLowerCase(),"blockquote","非闭合方式选中添加引用"),start()},50)}),test("在列表中添加引用",function(){var e=te.obj[0],l=te.obj[1];e.setContent("hello<ol><li><p>hello1</p></li><li><p>hello2</p></li></ol>");var t=e.body,o=t.lastChild.getElementsByTagName("li");l.setStart(o[0].firstChild,1).collapse(1).select(),e.execCommand("blockquote"),equal(t.lastChild.tagName.toLowerCase(),"blockquote","引用加到列表外面去了"),equal(o[0].firstChild.nodeType,1,"列表里套着p"),equal(o[0].firstChild.firstChild.data,"hello1","列表里仍然是文本hello1")}),test("trace1183：选中列表中添加引用，再去掉引用",function(){var e=te.obj[0],l=te.obj[1];e.setContent("<p>hello1</p><p>hello2</p>");var t=e.body;l.setStart(t,0).setEnd(t,2).select(),e.execCommand("insertorderedlist"),ua.manualDeleteFillData(e.body);var o=t.getElementsByTagName("ol")[0],a=ua.getChildHTML(o);e.execCommand("blockquote"),e.execCommand("blockquote"),ua.manualDeleteFillData(e.body),equal(ua.getChildHTML(t.getElementsByTagName("ol")[0]),a,"引用前后列表没有发生变化"),equal(t.getElementsByTagName("ol").length,1,"只有一个有序列表")}),test("trace 3298：对段落添加引用和去除引用",function(){var e=te.obj[0],l=te.obj[1];e.setContent("<p><strong><em>hello1</em></strong></p><p>hello2  world</p>");var t=e.body;l.setStart(t.firstChild,0).setEnd(t.lastChild,1).select(),e.execCommand("blockquote"),equal(ua.getChildHTML(t),"<blockquote><p><strong><em>hello1</em></strong></p><p>hello2 &nbsp;world</p></blockquote>","不闭合添加引用"),equal(e.queryCommandState("blockquote"),1,"引用高亮"),l.setStart(t.firstChild.lastChild,0).collapse(!0).select(),e.execCommand("blockquote"),equal(ua.getChildHTML(t),"<blockquote><p><strong><em>hello1</em></strong></p></blockquote><p>hello2 &nbsp;world</p>","闭合去除引用"),equal(e.queryCommandState("blockquote"),0,"引用不高亮"),l.setStart(t.firstChild,0).setEnd(t.lastChild,1).select(),e.execCommand("blockquote"),equal(ua.getChildHTML(t),"<p><strong><em>hello1</em></strong></p><p>hello2 &nbsp;world</p>"),equal(e.queryCommandState("blockquote"),0,"非闭合去除引用后，引用不高亮"),l.setStart(t.lastChild,0).collapse(!0).select(),e.execCommand("blockquote"),equal(ua.getChildHTML(t),"<p><strong><em>hello1</em></strong></p><blockquote><p>hello2 &nbsp;world</p></blockquote>","闭合添加引用 ")}),test("trace 3285：startContainer为body添加引用",function(){var e=te.obj[0],l=te.obj[1];e.setContent("hello<ol><li>hello1</li><li>hello2</li></ol>");var t=e.body;l.setStart(t,0).setEnd(t,2).select(),e.execCommand("blockquote");var o=' class=" list-paddingleft-2"';equal(ua.getChildHTML(t),"<blockquote><p>hello</p><ol"+o+"><li><p>hello1</p></li><li><p>hello2</p></li></ol></blockquote>","选中body加引用"),equal(e.queryCommandState("blockquote"),1,"引用高亮"),e.undoManger.undo(),l.setStart(t,1).collapse(!0).select(),equal(e.queryCommandState("blockquote"),0,"引用不高亮")}),test("aa标签",function(){var e=te.obj[0],l=te.obj[1];ua.browser.ie||(e.setContent("<aa>hello</aa>"),l.setStart(e.body.firstChild.firstChild,0).collapse(1).select(),e.execCommand("blockquote"),equal(ua.getChildHTML(e.body),"<blockquote><aa>hello</aa></blockquote>","aa标签"),e.setContent("hello<aa>hello2</aa>"),l.setStart(e.body.lastChild.firstChild,0).setEnd(e.body.lastChild.firstChild,3).select(),e.execCommand("blockquote"),equal(ua.getChildHTML(e.body),"<p>hello</p><blockquote><aa>hello2</aa></blockquote>","<aa>"))}),test("trace 3284：列表内引用",function(){var e=te.obj[0],l=te.obj[1],t=' class=" list-paddingleft-2"';e.setContent("<ol><li><blockquote><p>hello1</p></blockquote></li><blockquote><li><p>hello2</p></li></blockquote></ol>"),l.setStart(e.body.firstChild.firstChild.firstChild.firstChild,0).setEnd(e.body.firstChild.lastChild.firstChild.firstChild,6).select(),e.execCommand("blockquote"),equal(ua.getChildHTML(e.body),"<ol"+t+"><li><p>hello1</p></li><li><p>hello2</p></li></ol>","引用删除")});
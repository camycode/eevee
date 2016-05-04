module("plugins.undo"),test("trace 856 输入文本后撤销按钮不亮",function(){var e=te.obj[0],t=te.obj[1];e.setContent("<p></p>"),t.setStart(e.body.firstChild,0).collapse(!0).select(),ua.keydown(e.body),t.insertNode(e.document.createTextNode("hello")),ua.keydown(e.body),setTimeout(function(){equal(e.queryCommandState("undo"),0,"模拟输入文本后撤销按钮应当高亮"),start()},500),stop()}),test("trace 583,1726 插入表格、表情,撤销",function(){var e=te.obj[0],t=te.obj[1];e.setContent("<p></p>"),t.setStart(e.body.firstChild,0).collapse(!0).select(),e.execCommand("inserttable",{numCols:2,numRows:2}),e.execCommand("insertimage",{src:"http://img.baidu.com/hi/jx2/j_0001.gif",width:50,height:50}),e.execCommand("undo"),e.execCommand("undo"),e.execCommand("undo"),ua.manualDeleteFillData(e.body),equal(e.getContent().toLowerCase(),"","插入表格、表情,撤销")}),test("trace 595 撤销合并单元格后再合并单元格",function(){var e=te.obj[0],t=te.obj[1];e.setContent("<p></p>"),t.setStart(e.body.firstChild,0).collapse(!0).select(),e.execCommand("inserttable",{numCols:3,numRows:3});for(var l=e.body.firstChild.getElementsByTagName("td"),o=0;5>o;o++)l[o].innerHTML="hello";setTimeout(function(){var l=e.body.firstChild.getElementsByTagName("tr"),o=e.getUETable(e.body.firstChild),a=o.getCellsRange(l[0].cells[0],l[1].cells[1]);o.setSelected(a),t.setStart(l[0].cells[0],0).collapse(!0).select(),e.execCommand("mergecells"),ua.manualDeleteFillData(e.body);var s=e.body.getElementsByTagName("td");equal(s.length,6,"单元格数"),equal(l[0].cells[0].colSpan,2,"合并--[0][0]单元格colspan"),equal(l[0].cells[0].rowSpan,2,"合并--[0][0]单元格rowspan"),equal(l[0].cells[0].innerHTML.toLowerCase(),"hello<br>hello<br>hello<br>hello","内容复制正确"),e.execCommand("undo"),ua.manualDeleteFillData(e.body),ok(1==s[0].colSpan&&1==s[0].rowSpan&&9==s.length,"撤销后，单元格回复成多个"),ok("hello"==s[0].innerHTML.toLowerCase()&&"hello"==s[1].innerHTML.toLowerCase()&&"hello"==s[3].innerHTML.toLowerCase()&&"hello"==s[4].innerHTML.toLowerCase(),"内容复制正确"),setTimeout(function(){var l=e.body.firstChild.getElementsByTagName("tr"),o=e.getUETable(e.body.firstChild),a=o.getCellsRange(l[0].cells[0],l[1].cells[1]);o.setSelected(a),t.setStart(l[0].cells[0],0).collapse(!0).select(),e.execCommand("mergecells"),ua.manualDeleteFillData(e.body),s=e.body.firstChild.getElementsByTagName("td"),ok(2==s[0].colSpan&&2==s[0].rowSpan&&6==s.length,"再次合并，多个单元格合并成一个"),equal(s[0].innerHTML.toLowerCase(),"hello<br>hello<br>hello<br>hello","内容复制正确"),start()},50)},50),stop()}),test("trace 599 插入表格、表情、超链接、表情,撤销2次",function(){var e=te.obj[0],t=te.obj[1];e.setContent("<p></p>"),t.setStart(e.body,0).collapse(!0).select(),e.execCommand("inserttable",{numCols:2,numRows:2}),t.setStart(e.body.lastChild,0).collapse(!0).select(),e.execCommand("insertimage",{src:"http://img.baidu.com/hi/jx2/j_0001.gif",width:50,height:50}),t.setStartAfter(e.body.lastChild).collapse(!0).select(),e.execCommand("link",{href:"http://www.baidu.com/"}),t.setStartAfter(e.body.lastChild).collapse(!0).select(),e.execCommand("insertimage",{src:"http://img.baidu.com/hi/jx2/j_0001.gif",width:50,height:50}),e.execCommand("Undo"),e.execCommand("Undo"),ua.manualDeleteFillData(e.body),equal(e.body.childNodes.length,2,"撤销2次后只剩表格、表情");var l=e.body.childNodes[0].firstChild.tagName.toLowerCase();ok("table"==l||"tbody"==l,"表格"),equal(e.body.childNodes[1].firstChild.tagName.toLowerCase(),"img","表情")}),test("trace 617 插入文本、分割线、文本,撤销2次，撤销掉分割线",function(){var e=te.obj[0],t=te.obj[1];e.setContent("<p></p>"),t.setStart(e.body.firstChild,0).collapse(!0).select(),ua.keydown(e.body),t.insertNode(e.document.createTextNode("hello")),ua.browser.ie||ua.compositionstart(e.body),ua.keyup(e.body),t.setStartAfter(e.body.lastChild).collapse(!0).select(),e.execCommand("Horizontal"),t.setStartAfter(e.body.lastChild).collapse(!0).select(),ua.keydown(e.body),t.insertNode(e.document.createTextNode("hello")),ua.browser.ie||ua.compositionend(e.body),ua.keyup(e.body),e.execCommand("Undo"),e.execCommand("Undo"),equal(e.body.getElementsByTagName("hr").length,0,"分割线已删除")}),test("trace 632 合并单元格后撤销再合并单元格不会丢字",function(){var e=te.obj[0],t=te.obj[1];e.setContent("<p></p>"),t.setStart(e.body.firstChild,0).collapse(!0).select(),e.execCommand("inserttable",{numCols:4,numRows:4});for(var l=e.body.firstChild.getElementsByTagName("td"),o=0;6>o;o++)l[o].innerHTML="hello";setTimeout(function(){var o=e.body.firstChild.getElementsByTagName("tr"),a=e.getUETable(e.body.firstChild),s=a.getCellsRange(o[0].cells[0],o[1].cells[1]);a.setSelected(s),t.setStart(o[0].cells[0],0).collapse(!0).select(),e.execCommand("mergecells"),ua.manualDeleteFillData(e.body),l=e.body.firstChild.getElementsByTagName("td"),equal(l[0].innerHTML.toLowerCase(),"hello<br>hello<br>hello<br>hello","合并单元格,内容复制正确"),e.execCommand("Undo"),setTimeout(function(){var o=e.body.firstChild.getElementsByTagName("tr"),a=e.getUETable(e.body.firstChild),s=a.getCellsRange(o[0].cells[0],o[1].cells[1]);a.setSelected(s),t.setStart(o[0].cells[0],0).collapse(!0).select(),e.execCommand("mergecells"),ua.manualDeleteFillData(e.body),l=e.body.firstChild.getElementsByTagName("td"),equal(l[0].innerHTML.toLowerCase(),"hello<br>hello<br>hello<br>hello","撤销后再次合并单元格,内容复制正确"),start()},50)},50),stop()}),test("trace 685 合并单元格后,删除行,再撤销,再删除行",function(){var e=te.obj[0],t=te.obj[1];e.setContent("<p></p>"),t.setStart(e.body.firstChild,0).collapse(!0).select(),e.execCommand("inserttable",{numCols:4,numRows:4}),setTimeout(function(){var l=e.body.firstChild.getElementsByTagName("tr"),o=e.getUETable(e.body.firstChild),a=o.getCellsRange(l[0].cells[0],l[0].cells[3]);o.setSelected(a),t.setStart(l[0].cells[0],0).collapse(!0).select();var s=e.body.getElementsByTagName("td");e.execCommand("mergecells"),ok(4==s[0].colSpan&&1==s[0].rowSpan,"第一行的4个单元格合并成一个"),setTimeout(function(){var l=e.body.firstChild.getElementsByTagName("tr"),o=e.getUETable(e.body.firstChild),a=o.getCellsRange(l[1].cells[0],l[3].cells[0]);o.setSelected(a),t.setStart(l[0].cells[0],0).collapse(!0).select();var s=e.body.getElementsByTagName("td");e.execCommand("mergecells"),ok(1==s[1].colSpan&&3==s[1].rowSpan,"第2，3，4行的第一个单元格合并成一个"),t.setStart(s[4],0).collapse(!0).select(),e.execCommand("deleterow"),equal(e.body.firstChild.getElementsByTagName("tr").length,3,"点击删除行，表格剩三行"),e.execCommand("undo"),equal(e.body.firstChild.getElementsByTagName("tr").length,4,"撤销后，表格恢复成4行"),t.setStart(s[4],0).collapse(!0).select(),e.execCommand("deleterow"),equal(e.body.firstChild.getElementsByTagName("tr").length,3,"撤销后，再点击删除行，表格剩三行"),start()},50)},50),stop()}),test("trace 718 合并单元格后,删除列,再撤销,再删除列",function(){var e=te.obj[0],t=te.obj[1];e.setContent("<p></p>"),t.setStart(e.body.firstChild,0).collapse(!0).select(),e.execCommand("inserttable",{numCols:4,numRows:4}),setTimeout(function(){var l=e.body.firstChild.getElementsByTagName("tr"),o=e.getUETable(e.body.firstChild),a=o.getCellsRange(l[1].cells[1],l[2].cells[2]);o.setSelected(a),t.setStart(l[1].cells[1],0).collapse(!0).select();var s=e.body.firstChild.getElementsByTagName("td");e.execCommand("mergecells"),ok(2==s[5].colSpan&&2==s[5].rowSpan,"对一个4*4的表格，选择中间的4格单元格，合并成一个"),t.setStart(s[5],0).collapse(!0).select(),e.execCommand("deletecol"),equal(e.body.firstChild.getElementsByTagName("tr")[0].childNodes.length,3,"点击删除列，表格剩三列"),e.execCommand("undo"),equal(e.body.firstChild.getElementsByTagName("tr")[0].childNodes.length,4,"撤销后，表格剩四列"),ua.browser.gecko||ua.browser.ie||(t.setStart(s[5],0).collapse(!0).select(),e.execCommand("deletecol"),equal(e.body.firstChild.getElementsByTagName("tr")[0].childNodes.length,3,"再次点击删除列，表格剩三列")),equal(e.body.firstChild.getElementsByTagName("tr").length,4,"表格依然有4行"),start()},50),stop()}),test("trace 743 合并单元格后,删除列,再撤销",function(){var e=te.obj[0],t=te.obj[1];e.setContent("<p></p>"),t.setStart(e.body.firstChild,0).collapse(!0).select(),e.execCommand("inserttable",{numCols:4,numRows:4}),setTimeout(function(){var l=e.body.firstChild.getElementsByTagName("tr"),o=e.getUETable(e.body.firstChild),a=o.getCellsRange(l[0].cells[0],l[0].cells[3]);o.setSelected(a),t.setStart(l[0].cells[0],0).collapse(!0).select(),e.execCommand("mergecells");var s=e.body.firstChild.getElementsByTagName("td");ok(4==s[0].colSpan&&1==s[0].rowSpan&&13==s.length,"对一个4*4的表格，选择第一行的4格单元格，合并成一个"),e.execCommand("deletecol"),equal(e.body.firstChild.getElementsByTagName("tr")[1].childNodes.length,3,"点击删除列，表格剩3列"),e.execCommand("undo"),equal(e.body.firstChild.getElementsByTagName("tr")[1].childNodes.length,4,"撤销后，表格恢复成4列"),equal(e.body.firstChild.getElementsByTagName("tr").length,4,"表格依然有4行"),start()},50),stop()}),test("trace 942 用格式刷后撤销",function(){var e=te.obj[0],t=te.obj[1];stop(),expect(1),e.setContent('<p><strong>hello</strong></p><p><a href="http://www.baidu.com/">hello</a></p>'),t.setStart(e.body.firstChild.firstChild.firstChild,2).setEnd(e.body.firstChild.firstChild.firstChild,4).select(),e.addListener("mouseup",function(){ua.manualDeleteFillData(e.body),equal(e.body.lastChild.firstChild.innerHTML.toLowerCase(),"h<strong></strong>ello")}),e.execCommand("formatmatch"),t.setStart(e.body.lastChild.firstChild.firstChild,1).collapse(!0).select(),ua.mouseup(e.body),setTimeout(function(){start()},100)}),test("undo--redo",function(){var e=te.obj[0];te.obj[1];e.setContent("<p></p>"),e.focus(),e.execCommand("anchor","hello"),e.undoManger.undo();var t=ua.browser.ie?"&nbsp;":"<br>";equal(ua.getChildHTML(e.body),"<p>"+t+"</p>",""),e.undoManger.redo(),ua.manualDeleteFillData(e.body),ua.browser.ie?equal(ua.getChildHTML(e.body),'<p><img class="anchorclass" anchorname="hello">'+t+"</p>",""):equal(ua.getChildHTML(e.body),'<p><img anchorname="hello" class="anchorclass">'+t+"</p>","")}),test("reset,index",function(){var e=te.obj[0];e.setContent("<p></p>"),e.focus(),e.execCommand("anchor","hello");var t=e.undoManger.list.length;ok(t>0,"检查undoManger.list"),equal(e.undoManger.index,1,"检查undoManger.index"),e.undoManger.undo(),equal(e.undoManger.list.length,t,"undo操作,undoManger.list不变"),equal(e.undoManger.index,0,"undo操作,undoManger.index-1");var l=ua.browser.ie?"&nbsp;":"<br>";equal(ua.getChildHTML(e.body),"<p>"+l+"</p>","检查内容"),e.reset(),equal(e.undoManger.list.length,0,"reset,undoManger.list清空"),equal(e.undoManger.index,0,"reset,undoManger.index清空"),e.undoManger.redo(),ua.manualDeleteFillData(e.body);var l=ua.browser.ie?"&nbsp;":"<br>";equal(ua.getChildHTML(e.body),"<p>"+l+"</p>","检查内容")}),test("trace 1068 默认样式的图片刷左浮动图片，撤销，左浮动图片刷默认样式的图片",function(){var e=te.obj[0],t=te.obj[1],l=0,o=e.body;e.setContent("<p><br></p>"),t.setStart(o.firstChild,0).collapse(1).select(),e.execCommand("insertimage",{src:"http://img.baidu.com/hi/jx2/j_0001.gif",width:50,height:51}),t.selectNode(e.body.getElementsByTagName("img")[0]).select(),e.execCommand("imagefloat","none"),t.setStart(o.firstChild,0).collapse(1).select(),e.execCommand("insertimage",{src:"http://img.baidu.com/hi/jx2/j_0002.gif",width:50,height:51}),t.selectNode(e.body.getElementsByTagName("img")[0]).select(),e.execCommand("imagefloat","left"),t.selectNode(o.getElementsByTagName("img")[1]).select(),e.addListener("mouseup",function(){equal(e.queryCommandState("formatmatch"),0,"刷后状态为0"),1==l?(equal(ua.getFloatStyle(o.getElementsByTagName("img")[0]),"none","默认刷左浮动"),e.execCommand("Undo"),equal(ua.getFloatStyle(o.getElementsByTagName("img")[0]),"left","撤销后，左浮动还原"),t.selectNode(o.getElementsByTagName("img")[0]).select(),e.execCommand("formatmatch"),t.selectNode(o.getElementsByTagName("img")[1]).select(),l=2,ua.mouseup(e.body)):2==l&&(ua.browser.opera||equal(ua.getFloatStyle(o.getElementsByTagName("img")[1]),"left","左浮动刷默认"),setTimeout(function(){start()},100))}),e.execCommand("formatmatch"),t.selectNode(o.getElementsByTagName("img")[0]).select(),l=1,ua.mouseup(o.getElementsByTagName("img")[0]),stop()}),test("ctrl+z/y",function(){var e=te.obj[0],t=te.obj[1],l=e.body;e.setContent("<p>没有加粗的文本</p>"),t.selectNode(l.firstChild).select();var o=l.firstChild;setTimeout(function(){ua.keydown(e.body,{keyCode:66,ctrlKey:!0}),setTimeout(function(){equal(ua.getChildHTML(o),"<strong>没有加粗的文本</strong>"),ua.keydown(e.body,{keyCode:90,ctrlKey:!0}),setTimeout(function(){e.focus(),equal(ua.getChildHTML(l.firstChild),"没有加粗的文本"),ua.keydown(e.body,{keyCode:89,ctrlKey:!0}),e.focus(),setTimeout(function(){equal(ua.getChildHTML(l.firstChild),"<strong>没有加粗的文本</strong>"),start()},100)},100)},150)},100),stop()}),test("trace 3209 插入表格,undo redo",function(){var e=te.obj[0],t=te.obj[1];e.setContent("<p></p>"),t.setStart(e.body.firstChild,0).collapse(!0).select(),e.execCommand("inserttable"),e.execCommand("undo"),equal(e.getContent().toLowerCase(),"","插入表格,撤销"),e.execCommand("redo"),ua.manualDeleteFillData(e.body),equal(e.body.firstChild.tagName.toLowerCase(),"table","插入表格,撤销重做")});
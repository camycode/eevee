module("plugins.pagebreak"),test("对合并过单元格的表格分页",function(){stop();var e=te.obj[0],t=te.obj[1];e.setContent("<p></p>"),t.setStart(e.body.firstChild,0).collapse(!0).select(),e.execCommand("inserttable",{numCols:5,numRows:5});var a=e.body.getElementsByTagName("tr");t.setStart(a[0].firstChild,0).collapse(1).select(),e.currentSelectedArr=[a[0].firstChild,a[1].firstChild,a[2].firstChild,a[3].firstChild],e.execCommand("mergecells"),e.currentSelectedArr=[a[1].childNodes[2],a[1].childNodes[3],a[2].childNodes[2],a[2].childNodes[3]],e.execCommand("mergecells"),t.setStart(a[1].childNodes[1],0).collapse(1).select(),e.execCommand("pagebreak");var l=e.body.getElementsByTagName("table"),s=l[0].getElementsByTagName("tr");equal(l.length,2,"应当拆为2个table"),equal(s.length,1,"第一个table只有一行"),setTimeout(function(){start()},200)}),test("对第一行的单元格进行分页",function(){stop();var e=te.obj[0],t=te.obj[1];e.setContent("<p></p>"),t.setStart(e.body.firstChild,0).collapse(!0).select(),e.execCommand("inserttable",{numCols:5,numRows:5});var a=e.body.getElementsByTagName("td");t.setStart(a[1],0).collapse(1).select();var l=e.body.getElementsByTagName("table")[0],s=ua.getChildHTML(l);e.execCommand("pagebreak");var o=e.body.firstChild;equal(ua.getChildHTML(e.body.getElementsByTagName("table")[0]),s,"表格没发生变化"),equal($(o).attr("class"),"pagebreak","插入一个分页符"),equal(o.tagName.toLowerCase(),"hr","hr"),setTimeout(function(){start()},200)}),test("对最后一行的单元格进行分页",function(){stop();var e=te.obj[0],t=te.obj[1];e.setContent("<p></p>"),t.setStart(e.body.firstChild,0).collapse(!0).select(),e.execCommand("inserttable",{numCols:5,numRows:5});var a=e.body.getElementsByTagName("td");t.setStart(a[24],0).collapse(1).select(),e.execCommand("pagebreak");var l=e.body.getElementsByTagName("table"),s=e.body.childNodes[1];equal(l[0].getElementsByTagName("tr").length,4,"第一个table 4行"),equal(l[1].getElementsByTagName("tr").length,1,"第2个table 1行"),equal($(s).attr("class"),"pagebreak","插入一个分页符"),equal(s.tagName.toLowerCase(),"hr","插入的分页符是hr"),setTimeout(function(){start()},200)}),test("在段落中间闭合插入分页符",function(){stop();var e=te.obj[0],t=te.obj[1],a=e.body;e.setContent("<p>你好Ueditor</p>"),t.setStart(e.body.firstChild.firstChild,2).collapse(!0).select(),e.execCommand("pagebreak"),ua.manualDeleteFillData(e.body),equal(a.childNodes.length,3,"3个孩子"),equal(ua.getChildHTML(a.firstChild),"你好"),equal(a.firstChild.tagName.toLowerCase(),"p","第一个孩子是p"),equal($(a.firstChild.nextSibling).attr("class"),"pagebreak"),equal(ua.getChildHTML(a.lastChild),"ueditor"),equal(a.lastChild.tagName.toLowerCase(),"p","第二个孩子是p"),setTimeout(function(){start()},100)}),test("选中部分段落再插入分页符",function(){stop();var e=te.obj[0],t=te.obj[1],a=e.body;e.setContent("<p>你好Ueditor</p><p>hello编辑器</p>"),t.setStart(a.firstChild.firstChild,2).setEnd(a.lastChild.firstChild,5).select(),e.execCommand("pagebreak"),ua.manualDeleteFillData(e.body),equal(a.childNodes.length,3,"3个孩子"),equal(ua.getChildHTML(a.firstChild),"你好"),equal($(a.firstChild.nextSibling).attr("class"),"pagebreak"),equal(ua.getChildHTML(a.lastChild),"编辑器"),equal(a.firstChild.tagName.toLowerCase(),"p","第一个孩子是p"),equal(a.lastChild.tagName.toLowerCase(),"p","第二个孩子是p"),setTimeout(function(){start()},200)}),test("trace 1887:连续插入2次分页符，每次插入都在文本后面",function(){stop();var e=te.obj[0],t=te.obj[1],a=e.body;e.setContent("<p>你好</p>"),t.setStart(a.firstChild,1).collapse(1).select(),e.execCommand("pagebreak"),t.setStart(a.firstChild,1).collapse(1).select(),e.execCommand("pagebreak"),equal(a.childNodes.length,3,"3个孩子"),equal(a.childNodes[1].childNodes.length,0,"hr没有孩子节点"),setTimeout(function(){start()},200)});
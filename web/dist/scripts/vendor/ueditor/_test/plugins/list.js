module("plugins.list"),test("trace 3859 回车将p转成列表",function(){if(9!=ua.browser.ie&&10!=ua.browser.ie){var e=te.obj[0],l=te.obj[1],t=ua.browser.ie?"":"<br>";e.setContent("<p>1. 2</p>"),stop(),setTimeout(function(){l.setStart(e.body.firstChild,0).collapse(!0).select(),ua.keydown(e.body,{keyCode:13}),setTimeout(function(){ua.checkSameHtml(ua.getChildHTML(e.body),'<ol style="list-style-type: decimal;" class=" list-paddingleft-2"><li><p> 2</p></li><li><p>'+t+"</p></li></ol>","回车将p转成列表"),start()},50)},100)}}),test("ol标签嵌套",function(){var e=te.obj[0];e.setContent('<ol class="custom_num list-paddingleft-1"><li class="list-num-1-1 list-num-paddingleft-1"><p>a</p></li><ol class="custom_num list-paddingleft-1"><li class="list-num-1-1 list-num-paddingleft-1"><p>b</p></li></ol></ol>'),ua.checkSameHtml(e.body.innerHTML,'<ol class="custom_num list-paddingleft-1"><li class="list-num-1-1 list-num-paddingleft-1"><p>a</p></li><ol class="custom_num1 list-paddingleft-2"><li class="list-num-2-1 list-num1-paddingleft-1"><p>b</p></li></ol></ol>')}),test("li内添加p标签",function(){var e=te.obj[0];e.setContent("<ol><li>asd<p>asd</p></li></ol>"),ua.manualDeleteFillData(e.body),ua.checkSameHtml(e.body.innerHTML,'<ol class=" list-paddingleft-2"><li><p>asd</p><p>asd</p></li></ol>',"添加p标签")}),test("p转成列表",function(){var e=document.body.appendChild(document.createElement("div"));e.id="ue";var l=UE.getEditor("ue",{autoTransWordToList:!0}),t="";l.ready(function(){setTimeout(function(){l.setContent('<p class="MsoListParagraph">1.a</p><ol><li>b</li></ol>'),ua.manualDeleteFillData(l.body),l.setContent('<p class="MsoListParagraph"><span style="font-family: Symbol;">abc</span></p>'),ua.manualDeleteFillData(l.body),ua.checkSameHtml(l.body.innerHTML,'<ul style="list-style-type: disc;" class=" list-paddingleft-2"><li><p>'+t+"</p></li></ul>","p转成无序列表"),UE.delEditor("ue"),te.dom.push(document.getElementById("ue")),start()},200)}),stop()}),test("列表复制粘贴",function(){var e=te.obj[0];e.setContent('<ol class="custom_num2 list-paddingleft-1"><li class="list-num-3-1 list-num2-paddingleft-1">a</li><li>b</li></ol><ul><li>a</li><li>b</li></ul>'),ua.keydown(e.body,{keyCode:65,ctrlKey:!0}),ua.keydown(e.body,{keyCode:67,ctrlKey:!0}),setTimeout(function(){var l={html:e.body.innerHTML};e.fireEvent("beforepaste",l),e.setContent("<ol><li>a</li><li>b</li></ol><ul><li>a</li><li>b</li></ul>"),ua.keydown(e.body,{keyCode:65,ctrlKey:!0}),ua.keydown(e.body,{keyCode:67,ctrlKey:!0}),l={html:e.body.innerHTML},e.fireEvent("beforepaste",l),e.setContent("<ol><ol><li>a</li><li>b</li></ol><ul><li>a</li><li>b</li></ul></ol>"),ua.keydown(e.body,{keyCode:65,ctrlKey:!0}),ua.keydown(e.body,{keyCode:67,ctrlKey:!0}),l={html:e.body.innerHTML},e.fireEvent("beforepaste",l),e.setContent('<ol class="custom_cn1 list-paddingleft-1"><ol><li>a</li><li>b</li></ol><ul><li>a</li><li>b</li></ul></ol>'),ua.keydown(e.body,{keyCode:65,ctrlKey:!0}),ua.keydown(e.body,{keyCode:67,ctrlKey:!0}),l={html:e.body.innerHTML},setTimeout(function(){e.fireEvent("beforepaste",l),start()},50)},50),stop()}),test("修改列表再删除列表",function(){if(ua.browser.safari&&!ua.browser.chrome)return 0;var e=te.obj[0],l=te.obj[1];baidu.editor.browser.ie?"":"<br>";e.setContent("<ol>hello1</ol>"),l.setStart(e.body.firstChild,0).collapse(!0).select(),e.execCommand("insertorderedlist","cn2"),ua.manualDeleteFillData(e.body),equal(e.body.firstChild.tagName.toLowerCase(),"ol","查询列表的类型"),equal(ua.getChildHTML(e.body.firstChild),'<li class="list-cn-3-1 list-cn2-paddingleft-1"><p>hello1</p></li>'),l.setStart(e.body.lastChild,0).setEnd(e.body.lastChild,1).select(),e.execCommand("insertorderedlist","cn2"),ua.manualDeleteFillData(e.body),ua.checkSameHtml(e.body.innerHTML,"<p>hello1</p>")}),test("列表内没有列表标号的项后退",function(){if(ua.browser.safari&&!ua.browser.chrome)return 0;var e,l=te.obj[0],t=te.obj[1];ua.browser.ie,"<br>";l.setContent('<ol><li><p>hello</p><p><a href="http://www.baidu.com">www.baidu.com</a></p></li></ol>'),t.setStart(l.body.firstChild.firstChild.lastChild.lastChild,0).collapse(!0).select(),ua.manualDeleteFillData(l.body),ua.keydown(l.body,{keyCode:8}),setTimeout(function(){e=l.body.getElementsByTagName("li"),equal(e.length,"1","列表长度不变"),ua.checkSameHtml(ua.getChildHTML(l.body),'<ol class=" list-paddingleft-2"><li><p>hello</p></li></ol><p><a href="http://www.baidu.com" _href="http://www.baidu.com">www.baidu.com</a></p>',"p在列表外"),start()},50),stop()}),test("多个p，选中其中几个变为列表",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent("<p>hello1</p><p>hello2</p><p>hello3</p><p>hello4</p>"),setTimeout(function(){l.setStart(t.firstChild,0).setEnd(t.firstChild.nextSibling,1).select(),e.execCommand("insertorderedlist"),equal(ua.getChildHTML(t.firstChild),"<li><p>hello1</p></li><li><p>hello2</p></li>","检查列表的内容"),equal(t.firstChild.tagName.toLowerCase(),"ol","检查列表的类型"),equal(t.childNodes.length,3,"3个孩子"),equal(t.lastChild.tagName.toLowerCase(),"p","后面的p没有变为列表"),equal(t.lastChild.innerHTML.toLowerCase(),"hello4","p里的文本"),start()},50),stop()}),test("有序列表的切换",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent("<p>你好</p><p>是的</p>"),setTimeout(function(){l.setStart(t,0).setEnd(t,2).select(),e.execCommand("insertorderedlist","decimal"),equal(e.queryCommandValue("insertorderedlist"),"decimal","查询插入数字列表的结果1"),e.execCommand("insertorderedlist","lower-alpha"),equal(e.queryCommandValue("insertorderedlist"),"lower-alpha","查询插入字母列表的结果"),e.execCommand("insertorderedlist","decimal"),equal(e.queryCommandValue("insertorderedlist"),"decimal","查询插入数字列表的结果2"),start()},50),stop()}),test("无序列表之间的切换",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent("<p>你好</p><p>是的</p>"),l.setStart(t,0).setEnd(t,2).select(),e.execCommand("insertunorderedlist","circle"),equal(e.queryCommandValue("insertunorderedlist"),"circle","查询插入圆圈列表的结果1"),e.execCommand("insertunorderedlist","square"),equal(e.queryCommandValue("insertunorderedlist"),"square","查询插入正方形列表的结果"),e.execCommand("insertunorderedlist","circle"),equal(e.queryCommandValue("insertunorderedlist"),"circle","查询插入圆圈列表的结果1")}),test("引用中插入列表",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent("<p></p>"),l.setStart(t.firstChild,0).collapse(1).select(),e.execCommand("blockquote"),e.execCommand("insertorderedlist"),equal(t.firstChild.tagName.toLowerCase(),"blockquote","firstChild of body is blockquote"),equal(t.childNodes.length,1,"只有一个孩子"),equal(t.firstChild.firstChild.tagName.toLowerCase(),"ol","insert an ordered list"),equal(t.firstChild.childNodes.length,1,"blockquote只有一个孩子"),equal($(t.firstChild.firstChild).css("list-style-type"),"decimal","数字列表"),equal(e.queryCommandValue("insertorderedlist"),"decimal","queryCommand value is decimal")}),test("去除无序列表",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent("<p></p>"),l.setStart(t.firstChild,0).collapse(1).select(),e.execCommand("insertunorderedlist"),equal(t.firstChild.tagName.toLowerCase(),"ul","insert an unordered list"),equal(t.childNodes.length,1,"body只有一个孩子"),equal(e.queryCommandValue("insertunorderedlist"),"disc","queryCommand value is disc"),ok(e.queryCommandState("insertunorderedlist"),"state是1"),e.execCommand("insertunorderedlist"),ua.manualDeleteFillData(e.body),equal(t.firstChild.tagName.toLowerCase(),"p","去除列表"),equal(t.childNodes.length,1,"body只有一个孩子"),ok(!e.queryCommandState("insertunorderedlist"),"state是0")}),test("闭合方式有序和无序列表之间的切换",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent("<p></p>"),l.setStart(t.firstChild,0).collapse(1).select(),e.execCommand("insertunorderedlist"),equal(t.firstChild.tagName.toLowerCase(),"ul","insert an unordered list"),equal(t.childNodes.length,1,"body只有一个孩子"),equal(e.queryCommandValue("insertunorderedlist"),"disc","queryCommand value is disc"),equal(e.queryCommandValue("insertorderedlist"),null,"有序列表查询结果为null"),e.execCommand("insertorderedlist"),ua.manualDeleteFillData(e.body),equal(t.firstChild.tagName.toLowerCase(),"ol","变为有序列表"),equal(t.childNodes.length,1,"body只有一个孩子"),equal(e.queryCommandValue("insertorderedlist"),"decimal","queryCommand value is decimal"),equal(e.queryCommandValue("insertunorderedlist"),null,"无序列表查询结果为null"),e.execCommand("insertunorderedlist","circle"),ua.manualDeleteFillData(e.body),equal(t.firstChild.tagName.toLowerCase(),"ul","变为无序列表"),equal(t.childNodes.length,1,"body只有一个孩子"),equal(e.queryCommandValue("insertunorderedlist"),"circle","无序列表是圆圈"),equal(e.queryCommandValue("insertorderedlist"),null,"有序列表查询结果为null")}),test("非闭合方式切换有序和无序列表",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent("<ol><li>hello</li><li>hello3</li></ol><p>hello2</p>"),l.selectNode(t.firstChild).select(),e.execCommand("insertunorderedlist","square"),equal(t.firstChild.tagName.toLowerCase(),"ul","有序列表变为无序列表"),equal(e.queryCommandValue("insertunorderedlist"),"square","无序列表是方块"),equal(ua.getChildHTML(t.firstChild),"<li><p>hello</p></li><li><p>hello3</p></li>","innerHTML 不变"),e.execCommand("insertorderedlist","upper-alpha"),equal(t.firstChild.tagName.toLowerCase(),"ol","无序列表变为有序列表"),equal(e.queryCommandValue("insertorderedlist"),"upper-alpha","有序列表是A"),equal(ua.getChildHTML(t.firstChild),"<li><p>hello</p></li><li><p>hello3</p></li>","变为有序列表后innerHTML 不变")}),test("将列表下的文本合并到列表中",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent("<ul><li>hello1</li></ul><p>是的</p>"),setTimeout(function(){l.setStart(t.firstChild,0).setEnd(t.lastChild,1).select(),e.execCommand("insertorderedlist"),ua.manualDeleteFillData(e.body),equal(t.firstChild.tagName.toLowerCase(),"ol","ul变为了ol"),equal(ua.getChildHTML(t.firstChild),"<li><p>hello1</p></li><li><p>是的</p></li>"),equal(t.childNodes.length,1,"只有一个孩子是ol"),start()},50),stop()}),test("多个列表",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent("<ol><li>hello1</li></ol><ul><li>hello2</li></ul>"),l.selectNode(t.lastChild).select(),e.execCommand("insertorderedlist"),equal(t.firstChild.tagName.toLowerCase(),"ol","仍然是ol"),equal(t.childNodes.length,1,"body只有1个孩子ol"),equal(t.firstChild.childNodes.length,2,"下面的列表合并到上面"),equal(ua.getChildHTML(t.lastChild),"<li><p>hello1</p></li><li><p>hello2</p></li>","2个li子节点")}),test("修改列表中间某一段列表为另一种列表",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent("<ol><li>hello</li><li>hello2</li><li>hello3</li><li>hello4</li></ol>");var i=t.firstChild.getElementsByTagName("li");l.setStart(i[1],0).setEnd(i[2],1).select(),e.execCommand("insertunorderedlist"),equal(t.childNodes.length,3,"3个列表"),equal(ua.getChildHTML(t.firstChild),"<li><p>hello</p></li>","第一个列表只有一个li"),equal(ua.getChildHTML(t.lastChild),"<li><p>hello4</p></li>","最后一个列表只有一个li"),equal(t.childNodes[1].tagName.toLowerCase(),"ul","第二个孩子是无序列表"),equal(ua.getChildHTML(t.childNodes[1]),"<li><p>hello2</p></li><li><p>hello3</p></li>","检查第二个列表的内容")}),test("两个列表，将下面的合并上去",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent("<ol><li>hello3</li></ol><ol><li>hello1</li></ol><ul><li>hello2</li></ul>"),l.selectNode(t.lastChild).select(),e.execCommand("insertorderedlist"),equal(t.firstChild.tagName.toLowerCase(),"ol","仍然是ol"),equal(t.childNodes.length,2,"body有两个孩子ol"),equal(t.lastChild.childNodes.length,2,"下面和上面的列表合并到上面去了")}),test("trace 3293：列表下的文本合并到列表中",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent("<ol><li>hello3</li><li>hello1</li></ol><p>文本1</p><p>文本2</p>"),l.setStart(t,1).setEnd(t,3).select(),e.execCommand("insertorderedlist");var i=t.firstChild;equal(t.childNodes.length,1,"所有合并为一个列表"),equal(i.tagName.toLowerCase(),"ol","仍然是ol"),equal(i.childNodes.length,4,"下面和上面的列表合并到上面去了"),equal(ua.getChildHTML(t.firstChild),"<li><p>hello3</p></li><li><p>hello1</p></li><li><p>文本1</p></li><li><p>文本2</p></li>","4个li子节点")}),test("2个相同类型的列表合并",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent('<ol><li>hello3</li><li>hello1</li></ol><ol style="list-style-type: lower-alpha"><li><p>文本1</p></li><li><p>文本2</p></li></ol>'),l.selectNode(t.lastChild).select(),e.execCommand("insertorderedlist");var i=t.firstChild;equal(t.childNodes.length,1,"所有合并为一个列表"),equal(i.tagName.toLowerCase(),"ol","仍然是ol"),equal(i.childNodes.length,4,"下面和上面的列表合并到上面去了"),equal(ua.getChildHTML(t.firstChild),"<li><p>hello3</p></li><li><p>hello1</p></li><li><p>文本1</p></li><li><p>文本2</p></li>","4个li子节点")}),test("不闭合情况h1套列表",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent("<h1>hello1</h1><h2>hello2</h2>"),l.setStart(t.firstChild,0).setEnd(t.lastChild,1).select(),e.execCommand("insertorderedlist"),equal(t.firstChild.tagName.toLowerCase(),"ol","仍然是ol"),equal(ua.getChildHTML(t.firstChild),"<li><h1>hello1</h1></li><li><h2>hello2</h2></li>","查看插入列表后的结果"),equal(t.childNodes.length,1,"body只有一个孩子ol"),equal(t.firstChild.childNodes.length,2,"2个li")}),test("闭合情况h1套列表",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent("<h2>hello1</h2>"),l.setStart(t.firstChild,0).collapse(1).select(),e.execCommand("insertorderedlist"),equal(t.firstChild.tagName.toLowerCase(),"ol","仍然是ol"),equal(ua.getChildHTML(t.firstChild),"<li><h2>hello1</h2></li>","查看插入列表后的结果"),equal(t.childNodes.length,1,"body只有一个孩子ol"),equal(t.firstChild.childNodes.length,1,"1个li")}),test("列表内后退",function(){if(ua.browser.safari&&!ua.browser.chrome)return 0;var e,l=te.obj[0],t=te.obj[1],i=(ua.browser.ie,"<br>");l.setContent("<ol><li><br></li><li><p>hello2</p></li><li><br></li><li><sss>hello3</sss></li><li><p>hello4</p></li><li><p>hello5</p></li></ol>"),t.setStart(l.body.firstChild.lastChild.firstChild.firstChild,0).collapse(1).select(),ua.manualDeleteFillData(l.body),ua.keydown(l.body,{keyCode:8});l.body.getElementsByTagName("ol");e=l.body.getElementsByTagName("li"),equal(e.length,"5","变成5个列表项"),equal(ua.getChildHTML(l.body.firstChild),"<li><p>"+i+"</p></li><li><p>hello2</p></li><li><p>"+i+"</p></li><li><sss>hello3</sss></li><li><p>hello4</p><p>hello5</p></li>","最后一个列表项"),t.setStart(e[0].firstChild,0).collapse(1).select(),ua.keydown(l.body,{keyCode:8}),e=l.body.getElementsByTagName("li"),equal(e.length,"4","变成4个列表项"),equal(ua.getChildHTML(l.body.lastChild),"<li><p>hello2</p></li><li><p>"+i+"</p></li><li><sss>hello3</sss></li><li><p>hello4</p><p>hello5</p></li>","第一个列表项且为空行"),t.setStart(e[1].firstChild,0).collapse(1).select(),ua.keydown(l.body,{keyCode:8}),e=l.body.getElementsByTagName("li"),equal(e.length,"3","变成3个列表项"),equal(ua.getChildHTML(l.body.lastChild),"<li><p>hello2</p><p>"+i+"</p></li><li><sss>hello3</sss></li><li><p>hello4</p><p>hello5</p></li>","中间列表项且为空行"),ua.browser.ie||(t.setStart(e[1].firstChild.firstChild,0).collapse(1).select(),ua.manualDeleteFillData(l.body),ua.keydown(l.body,{keyCode:8}))}),test("列表内回车",function(){var e,l=te.obj[0],t=te.obj[1];ua.browser.ie?"":"<br>";l.setContent("<ol><li><sss></sss><sss></sss></li></ol>"),e=l.body.getElementsByTagName("li"),t.setStart(e[0],0).collapse(1).select(),ua.keydown(l.body,{keyCode:13});var i=ua.browser.opera?"<br>":"";equal(ua.getChildHTML(l.body),i+"<p><sss></sss><sss></sss></p>","空列表项回车--无列表"),l.setContent("<ol><li><sss>hello1</sss><p>hello2</p></li></ol>"),e=l.body.getElementsByTagName("li"),t.setStart(e[0].lastChild,0).collapse(1).select(),ua.keydown(l.body,{keyCode:13}),equal(ua.getChildHTML(l.body.firstChild),"<li><p><sss>hello1</sss><p></p></p></li><li><p><p>hello2</p></p></li>","单个列表项内回车"),l.setContent("<ol><li><br></li><li><p>hello5</p></li><li><p><br></p><p><br></p></li></ol>"),e=l.body.getElementsByTagName("li"),t.setStart(e[2].firstChild.firstChild,0).setEnd(e[2].lastChild.firstChild,0).select(),ua.keydown(l.body,{keyCode:13}),t.setStart(l.body.firstChild.firstChild.firstChild,0).collapse(1).select(),ua.keydown(l.body,{keyCode:13}),l.setContent("<ol><li><p>hello2</p></li><li><p>hello3</p></li><li><p><br /></p><p>hello5</p></li></ol>"),e=l.body.getElementsByTagName("li"),t.setStart(e[0].firstChild.firstChild,2).setEnd(e[1].firstChild.firstChild,4).select(),ua.keydown(l.body,{keyCode:13}),equal(ua.getChildHTML(l.body.firstChild),"<li><p>he</p></li><li><p>o3</p></li><li><p><br></p><p>hello5</p></li>","非闭合回车"),l.setContent("<ol><li><sss>hello</sss><p>hello4</p></li><li><p>hello5</p></li></ol>"),e=l.body.getElementsByTagName("li"),t.setStart(e[0].lastChild.firstChild,1).setEnd(e[0].lastChild.firstChild,2).select(),ua.keydown(l.body,{keyCode:13}),equal(ua.getChildHTML(l.body.firstChild),"<li><p><sss>hello</sss><p>h</p></p></li><li><p><p>llo4</p></p></li><li><p>hello5</p></li>","一个列表项内两行")}),test("tab键",function(){var e,l=te.obj[0],t=te.obj[1];l.setContent("<ol><li><p>hello1</p></li><li><p>hello2</p></li></ol>"),e=l.body.getElementsByTagName("li"),t.setStart(e[1],0).collapse(1).select(),ua.keydown(l.body,{keyCode:9}),ua.keydown(l.body,{keyCode:9});var i='<li><p>hello1</p></li><ol style="list-style-type: lower-alpha;" class=" list-paddingleft-2" ><ol style="list-style-type: lower-roman;" class=" list-paddingleft-2" ><li><p>hello2</p></li></ol></ol>';ua.checkSameHtml(i,l.body.firstChild.innerHTML.toLowerCase(),"有序列表---tab键")}),test("回车后产生新的li-选区闭合",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent("<p>hello1</p><p>hello2</p>"),setTimeout(function(){l.setStart(t.firstChild,0).setEnd(t.firstChild.nextSibling,1).select(),e.execCommand("insertorderedlist");var i=t.firstChild.lastChild.firstChild.firstChild;l.setStart(i,i.length).collapse(1).select(),setTimeout(function(){ua.keydown(e.body,{keyCode:13}),equal(t.firstChild.childNodes.length,3,"回车后产生新的li"),equal(t.firstChild.lastChild.tagName.toLowerCase(),"li","回车后产生新的li");var i=ua.browser.ie?"":"<br>";equal(ua.getChildHTML(t.firstChild),"<li><p>hello1</p></li><li><p>hello2</p></li><li><p>"+i+"</p></li>","检查内容");var o=t.firstChild.lastChild.firstChild.firstChild;l.setStart(o,o.length).collapse(1).select(),setTimeout(function(){ua.keydown(e.body,{keyCode:13}),equal(t.firstChild.childNodes.length,2,"空li后回车，删除此行li"),equal(t.lastChild.tagName.toLowerCase(),"p","产生p"),i=ua.browser.ie?"":"<br>",ua.manualDeleteFillData(t.lastChild),equal(t.lastChild.innerHTML.toLowerCase().replace(/\r\n/gi,""),i,"检查内容"),start()},20)},20)},50),stop()}),test("trace 1622：表格中插入列表",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent("<table><tbody><tr><td><br></td><td>你好</td></tr><tr><td>hello2</td><td>你好2</td></tr></tbody></table>"),stop(),setTimeout(function(){var i=t.getElementsByTagName("td");l.setStart(i[0],0).collapse(1).select(),e.execCommand("insertorderedlist"),equal(i[0].firstChild.tagName.toLowerCase(),"ol","查询列表的类型"),equal(i[0].firstChild.style.listStyleType,"decimal","查询有序列表的类型");var o=(baidu.editor.browser.ie,"<br>");equal(ua.getChildHTML(i[0].firstChild),"<li><p>"+o+"</p></li>"),setTimeout(function(){var o=e.body.firstChild.getElementsByTagName("tr"),s=e.getUETable(e.body.firstChild),a=s.getCellsRange(o[0].cells[0],o[1].cells[1]);s.setSelected(a),l.setStart(o[0].cells[0],0).collapse(!0).select(),i=t.getElementsByTagName("td"),e.execCommand("insertunorderedlist","circle"),equal(i[1].firstChild.tagName.toLowerCase(),"ul","查询无序列表"),equal(i[1].firstChild.style.listStyleType,"circle","查询无序列表的类型"),equal(ua.getChildHTML(i[1].firstChild),"<li>你好</li>"),equal(ua.getChildHTML(i[3].firstChild),"<li>你好2</li>"),start()},50)},50)}),test("trace1620：修改上面的列表与下面的列表一致",function(){var e=te.obj[0],l=te.obj[1];e.setContent('<p>你好</p><ol><li><p>数字列表1</p></li><li><p>数字列表2</p></li></ol><ol style="list-style-type:lower-alpha; "><li><p>字母列表2</p></li><li><p>字母列表2</p></li></ol>'),l.selectNode(e.body.firstChild.nextSibling).select(),e.execCommand("insertorderedlist","lower-alpha");var t='<p>你好</p><ol style="list-style-type: lower-alpha;" class=" list-paddingleft-2" ><li><p>数字列表1</p></li><li><p>数字列表2</p></li><li><p>字母列表2</p></li><li><p>字母列表2</p></li></ol>';ua.checkSameHtml(t,e.body.innerHTML.toLowerCase(),"检查列表结果")}),test("trace 1621：选中多重列表，设置为相同类型的列表",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent('<ol style="list-style-type:decimal; "><li><p>数字列表1</p></li><li><p>数字列表2</p></li></ol><ol style="list-style-type:lower-alpha; "><li><p>字母列表1</p></li><li><p>字母列表2</p></li></ol><ol style="list-style-type: upper-alpha; "><li><p>​大写字母1<br></p></li><li><p>大写字母2</p></li><li><p>大写字母3</p></li></ol>'),l.setStart(t,1).setEnd(t.lastChild.firstChild.nextSibling,1).select();var i='<ol style="list-style-type: decimal;" class=" list-paddingleft-2" ><li><p>数字列表1</p></li><li><p>数字列表2</p></li></ol><ol style="list-style-type: upper-alpha;" class=" list-paddingleft-2" ><li><p>字母列表1</p></li><li><p>字母列表2</p></li><li><p>大写字母1<br/></p></li><li><p>大写字母2</p></li><li><p>大写字母3</p></li></ol>';e.execCommand("insertorderedlist","upper-alpha"),ua.checkSameHtml(i,e.body.innerHTML.toLowerCase(),"trace 1621")}),test("trace 3056：列表内表格后回车",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent('<ol class="custom_cn2 list-paddingleft-1" ><li class="list-cn-3-1 list-cn2-paddingleft-1" ><p>a</p></li><li class="list-cn-3-2 list-cn2-paddingleft-1" ><p><br></p></li><li class="list-cn-3-3 list-cn2-paddingleft-1" ><p>c</p></li></ol>');var i=e.body.getElementsByTagName("li");l.setStart(i[1].firstChild,0).collapse(!0).select(),setTimeout(function(){e.execCommand("inserttable");var i=t.getElementsByTagName("td");i[0].innerHTML="asd<br>",l.setStart(i[0].firstChild,3).collapse(!0).select(),setTimeout(function(){ua.keydown(t,{keyCode:13}),equal(t.childNodes.length,1,"body只有一个孩子"),equal(e.body.getElementsByTagName("li").length,3,"ol有3个孩子"),equal(e.body.getElementsByTagName("table").length,1,"只有1个table"),start()},20)},50),stop()}),test("trace 3117：列表内后退两次",function(){if(ua.browser.safari&&!ua.browser.chrome)return 0;var e=te.obj[0],l=te.obj[1],t=(ua.browser.ie,"<br>");e.setContent("<ol><li>hello</li><li><p><br></p></li></ol>"),l.setStart(e.body.firstChild.lastChild.firstChild,0).collapse(1).select(),ua.manualDeleteFillData(e.body),ua.keydown(e.body,{keyCode:8});var i=(e.body.getElementsByTagName("ol"),e.body.getElementsByTagName("li"));equal(i.length,"1","变成1个列表项"),equal(ua.getChildHTML(e.body.firstChild),"<li><p>hello</p><p>"+t+"</p></li>","检查列表内容")}),test("trace 3118：全选后backspace",function(){if(ua.browser.safari&&!ua.browser.chrome)return 0;var e=te.obj[0],l=(te.obj[1],ua.browser.ie?"":"<br>");e.setContent("<ol><li>hello</li><li><p><br></p></li></ol>"),ua.keydown(e.body,{keyCode:65,ctrlKey:!0}),ua.keydown(e.body,{keyCode:8}),equal(ua.getChildHTML(e.body),"<p>"+l+"</p>",""),ok(!e.queryCommandState("insertorderedlist"),"state是0")}),test("trace 3126：1.2.5+列表重构新增标签，tab键",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.setContent("<p>hello1</p><p>hello2</p><p>hello3</p><p>hello4</p>"),e.execCommand("selectAll"),e.execCommand("insertorderedlist","cn2");var i=t.getElementsByTagName("li");l.setStart(i[1].firstChild,0).setEnd(i[2].firstChild,1).select(),ua.keydown(e.body,{keyCode:9});var o='<li class="list-cn-3-1 list-cn2-paddingleft-1" ><p>hello1</p></li><ol style="list-style-type: decimal;" class=" list-paddingleft-3" ><li><p>hello2</p></li><li><p>hello3</p></li></ol><li class="list-cn-3-2 list-cn2-paddingleft-1" ><p>hello4</p></li>';ua.checkSameHtml(o,e.body.firstChild.innerHTML.toLowerCase(),"有序列表---tab键")}),test("trace 3132：单行列表backspace",function(){if(ua.browser.safari&&!ua.browser.chrome)return 0;var e=te.obj[0],l=te.obj[1];e.setContent("<ol><li><br></li></ol>"),l.selectNode(e.body.firstChild.firstChild.firstChild.firstChild).select(),ua.keydown(e.body,{keyCode:8});var t="<br>";equal(ua.getChildHTML(e.body),"<p>"+t+"</p>","")}),test("trace 3133：表格中插入列表再取消列表",function(){if(ua.browser.safari&&!ua.browser.chrome)return 0;var e=te.obj[0],l=te.obj[1],t=e.body,i=baidu.editor.browser.ie?"":"<br>";e.setContent("<table><tbody><tr><td><br></td></tr></tbody></table>");var o=t.getElementsByTagName("td");l.setStart(o[0],0).collapse(1).select(),e.execCommand("insertorderedlist","num2"),equal(o[0].firstChild.tagName.toLowerCase(),"ol","查询列表的类型"),equal(ua.getChildHTML(o[0].firstChild),'<li class="list-num-3-1 list-num2-paddingleft-1"><p><br></p></li>'),e.execCommand("insertorderedlist","num2"),equal(ua.getChildHTML(o[0]),"<p><br></p>"),ua.keydown(e.body,{keyCode:65,ctrlKey:!0}),ua.keydown(e.body,{keyCode:8}),equal(ua.getChildHTML(e.body),"<p>"+i+"</p>","")}),test("trace 3164：添加列表，取消列表",function(){var e=te.obj[0],l=e.body;e.setContent("<p>hello1</p><p>hello2</p><p>hello3</p><p>hello4</p>"),e.execCommand("selectAll"),e.execCommand("insertunorderedlist","dash"),equal(l.firstChild.tagName.toLowerCase(),"ul","检查无序列表"),equal(l.firstChild.className,"custom_dash list-paddingleft-1","查询有序列表的类型"),equal(e.queryCommandValue("insertunorderedlist"),"dash","查询插入无序列表的结果"),ok(e.queryCommandState("insertunorderedlist"),"state是1"),e.execCommand("selectAll"),e.execCommand("insertunorderedlist","dash"),ua.checkHTMLSameStyle("<p>hello1</p><p>hello2</p><p>hello3</p><p>hello4</p>",e.document,e.body,"取消列表"),equal(e.queryCommandValue("insertunorderedlist"),null,"查询取消无序列表的结果"),ok(!e.queryCommandState("insertunorderedlist"),"state是0")}),test("trace 3165：检查表格中列表tab键",function(){var e=te.obj[0],l=te.obj[1],t=e.body;setTimeout(function(){e.execCommand("inserttable");var i=t.getElementsByTagName("td");l.setStart(i[6],0).collapse(1).select(),e.execCommand("insertorderedlist"),equal(i[6].firstChild.style.listStyleType,"decimal","查询有序列表的类型"),i=t.getElementsByTagName("td"),l.setStart(i[5],0).collapse(1).select(),l=e.selection.getRange(),9==ua.browser.ie||10==ua.browser.ie?equal(l.startContainer.tagName.toLowerCase(),"td","tab键前光标位于td中"):equal(l.startContainer.parentNode.tagName.toLowerCase(),"td","tab键前光标位于td中"),ua.keydown(e.body,{keyCode:9}),setTimeout(function(){l=e.selection.getRange(),ua.browser.gecko||ua.browser.ie||ua.browser.webkit||equal(l.startContainer.parentNode.tagName.toLowerCase(),"li","tab键后光标跳到有列表的单元格中"),equal(i[6].firstChild.style.listStyleType,"decimal","检查有序列表的类型不应该被改变"),start()},100)},100),stop()}),test("trace 3168：表格中列表更改样式",function(){var e=te.obj[0],l=te.obj[1],t=e.body;e.execCommand("inserttable");var i=t.getElementsByTagName("td");i[0].innerHTML="asdf",i[1].innerHTML='<ol class="custom_num1 list-paddingleft-1"><li class="list-num-2-1 list-num1-paddingleft-1"><p>asd</p></li></ol>',setTimeout(function(){var t=e.body.firstChild.getElementsByTagName("tr"),o=e.getUETable(e.body.firstChild),s=o.getCellsRange(t[0].cells[0],t[0].cells[1]);o.setSelected(s),l.setStart(t[0].cells[0],0).collapse(!0).select(),e.execCommand("insertorderedlist","cn1"),equal(i[0].firstChild.className,"custom_cn1 list-paddingleft-1","查询有序列表的类型"),equal(i[1].firstChild.className,"custom_cn1 list-paddingleft-1","查询有序列表的类型"),equal(e.queryCommandValue("insertorderedlist"),"cn1","查询插入有序列表的结果"),e.execCommand("insertunorderedlist","dot"),equal(i[0].firstChild.className,"custom_dot list-paddingleft-1","查询无序列表的类型"),equal(i[1].firstChild.className,"custom_dot list-paddingleft-1","查询无序列表的类型"),equal(e.queryCommandValue("insertunorderedlist"),"dot","查询插入无序列表的结果"),start()},50),stop()});
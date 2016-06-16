module("plugins.source"),test("chrome删除后切换源码再切换回来，光标没了",function(){if(ua.browser.opera)return 0;var e=te.obj[0],t=te.dom[0];e.render(t),e.setContent("hello");var o=e.selection.getRange();o.selectNode(e.body.firstChild).select(),e.execCommand("cleardoc"),stop(),expect(2),setTimeout(function(){e.execCommand("source"),setTimeout(function(){e.execCommand("source"),start()},20)},20),o=e.selection.getRange(),equal(o.startContainer.nodeType,1,"光标定位在p里"),equal(o.startContainer.tagName.toLowerCase(),"p","startContainer为p"),te.dom.push(t)}),test("切换源码，源码中多处空行",function(){var e=te.obj[0];e.setContent('<p>hello<a href="http://www.baidu.com/">baidu</a></p>'),stop(),setTimeout(function(){e.execCommand("source"),setTimeout(function(){e.execCommand("source"),setTimeout(function(){var t=e.getContent();equal(t,'<p>hello<a href="http://www.baidu.com/">baidu</a></p>'),start()},100)},100)},100)}),test("设置源码内容没有p标签，切换源码后会自动添加",function(){var e=te.obj[0];e.setContent("<strong><em>helloworld你好啊</em></strong>大家好，<strong><i>你在干嘛呢</i></strong><em><strong>。谢谢，不用谢</strong></em>~~%199<p>hello</p>"),setTimeout(function(){e.execCommand("source"),setTimeout(function(){e.execCommand("source"),setTimeout(function(){e.execCommand("source"),setTimeout(function(){var t=e.body.childNodes;ok(t.length,3,"3个p");for(var o=0;3>o;o++)equal(t[0].tagName.toLowerCase(),"p","第"+o+"个孩子为p");start()},100)},100)},100)},100),stop()}),test("切换源码去掉空的span",function(){var e=te.obj[0];e.setContent("<p>切换源码<span>去掉空的span</span></p>"),setTimeout(function(){e.execCommand("source"),setTimeout(function(){e.execCommand("source"),start()},100)},100),stop(),equal(e.getContent(),"<p>切换源码去掉空的span</p>")}),test("b,i标签，切换源码后自动转换成strong和em",function(){var e=te.obj[0];e.setContent("<p><b>加粗的内容</b><i>斜体的内容<b>加粗且斜体</b></i></p>"),setTimeout(function(){e.execCommand("source"),setTimeout(function(){e.execCommand("source"),start()},100)},100),stop(),equal(e.getContent(),"<p><strong>加粗的内容</strong><em>斜体的内容<strong>加粗且斜体</strong></em></p>")}),test(" trace 3739 trace 1734 range的更新/特殊符号的转换",function(){var e=te.obj[0];e.setContent('<p>"<></p>'),setTimeout(function(){e.execCommand("source"),setTimeout(function(){e.execCommand("source"),equal(e.getContent(),"<p>&quot;&lt;&gt;</p>"),e.setContent("<p>'<img src='http://nsclick.baidu.com/u.gif?&asdf=\"sdf&asdfasdfs;asdf'></p>"),setTimeout(function(){ua.manualDeleteFillData(e.body);var t=11==ua.browser.ie?e.selection.getRange().startContainer.parentNode.tagName.toLowerCase():e.selection.getRange().startContainer.parentNode.parentNode.tagName.toLowerCase();equal(t,"html","range的更新"),e.execCommand("source"),setTimeout(function(){e.execCommand("source"),equal(e.getContent(),'<p>&#39;<img src="http://nsclick.baidu.com/u.gif?&asdf=&quot;sdf&asdfasdfs;asdf"/></p>'),start()},100)},100)},100)},100),stop()}),test("默认插入的占位符",function(){var e=te.obj[0];e.setContent(""),equal(e.getContent(),"")}),test("插入分页符,源码中显示：_baidu_page_break_tag_",function(){var e=te.obj[0],t=te.obj[1];e.setContent("<p><br /></p>"),setTimeout(function(){t.setStart(e.body.firstChild,0).collapse(1).select(),e.execCommand("pagebreak"),ua.manualDeleteFillData(e.body);var o=e.body.getElementsByTagName("hr")[0];"undefined"==typeof o.attributes["class"]?equal(o.getAttribute("class"),"pagebreak","pagebreak"):equal(o.attributes["class"].nodeValue,"pagebreak","pagebreak"),ua.manualDeleteFillData(e.body),ok(e.getContent().indexOf("_ueditor_page_break_tag_")>=0,"pagebreak被解析"),start()},200),stop()}),test("不以http://开头的超链接绝对路径网址",function(){if(9==ua.browser.ie)return 0;var e=te.obj[0];e.setContent('<p><a href="www.baidu.com">绝对路径网址</a></p>'),setTimeout(function(){e.execCommand("source"),setTimeout(function(){e.execCommand("source"),equal(e.getContent(),'<p><a href="www.baidu.com">绝对路径网址</a></p>'),start()},100)},100),stop()}),test("trace 1727:插入超链接后再插入空格，空格不能被删除",function(){var e=te.obj[0];e.setContent('<p> <a href="http://www.baidu.com/">绝对路径网址</a>  ddd</p>'),setTimeout(function(){e.execCommand("source"),setTimeout(function(){e.execCommand("source"),equal(e.body.innerHTML.toLowerCase(),'<p><a href="http://www.baidu.com/" _href="http://www.baidu.com/">绝对路径网址</a> &nbsp;ddd</p>',"查看空格是否被删除"),start()},100)},100),stop()}),test("在font,b,i标签中输入，会自动转换标签 ",function(){var e=te.obj[0];e.body.innerHTML='<p><font size="3" color="red"><b><i>x</i></b></font></p>',setTimeout(function(){e.execCommand("source"),setTimeout(function(){e.execCommand("source"),equal(e.body.firstChild.firstChild.tagName.toLowerCase(),"span","font转换成span"),ua.browser.gecko||ua.browser.ie?equal($(e.body.firstChild.firstChild).css("font-size"),"16px","检查style"):equal($(e.body.firstChild.firstChild).css("font-size"),"16px","检查style");var t=$(e.body.firstChild.firstChild).css("color");ok("rgb(255, 0, 0)"==t||"red"==t||"#ff0000"==t,"检查style"),equal(ua.getChildHTML(e.body.firstChild.firstChild),"<strong><em>x</em></strong>","b转成strong,i转成em "),start()},20)},20),stop()}),test("trace 3334:img和a之间不会产生多余空格",function(){var e=te.obj[0];e.setContent('<p><img src="http://img.baidu.com/hi/jx2/j_0001.gif" /><a href="http://www.baidu.com">http://www.baidu.com</a></p>'),setTimeout(function(){e.execCommand("source"),setTimeout(function(){e.execCommand("source"),setTimeout(function(){e.execCommand("source"),ua.manualDeleteFillData(e.body);var t='<p><img src="http://img.baidu.com/hi/jx2/j_0001.gif" _src="http://img.baidu.com/hi/jx2/j_0001.gif"><a href="http://www.baidu.com" _href="http://www.baidu.com">http://www.baidu.com</a></p>';ua.checkSameHtml(e.body.innerHTML.toLowerCase(),t,"查看img和a之间是否会产生多余空格"),start()},20)},20)},20),stop()}),test("trace 3334:table中td不会产生多余空格",function(){if(!ua.browser.ie){var e=te.obj[0];e.execCommand("inserttable");var t=ua.browser.ie?"":"<br>";setTimeout(function(){e.execCommand("source"),setTimeout(function(){e.execCommand("source"),ua.manualDeleteFillData(e.body),equal(e.body.getElementsByTagName("table").length,1,"有1个table"),equal(e.body.getElementsByTagName("tr").length,5,"有5个tr"),equal(e.body.getElementsByTagName("td").length,25,"有25个td"),equal(e.body.getElementsByTagName("td")[12].innerHTML,t,"不会产生多余空格"),start()},20)},20),stop()}}),test("trace 3349：带颜色的span切到源码再切回，不会丢失span",function(){var e=te.obj[0];e.setContent('<p><span style="color: rgb(255, 0, 0);"></span><br></p>'),setTimeout(function(){e.execCommand("source"),setTimeout(function(){e.execCommand("source"),ua.checkSameHtml(e.body.innerHTML,'<p><span style="color: rgb(255, 0, 0);"></span><br></p>'),start()},20)},20),stop()});
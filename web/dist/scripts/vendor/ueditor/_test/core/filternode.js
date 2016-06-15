module("core.filternode"),test("过滤掉整个标签",function(){var d=UE.uNode,e=d.createElement('<div id="aa"><p>sdf<b>sdf</b></p><i>sdf</i></div>');UE.filterNode(e,{p:{},b:"-"}),equals(e.toHtml().replace(/[ ]+>/g,">"),'<div id="aa"><p>sdf</p>sdf</div>',"保留p，过滤b"),e.innerHTML("<p><p>sdfs</p><br/><br/><br/><br/></p>"),UE.filterNode(e,{p:{},br:"-"}),equals(e.toHtml().replace(/[ ]+>/g,">"),'<div id="aa"><p><p>sdfs</p></p></div>',"保留p，过滤br")}),test("过滤标签全部属性",function(){var d=UE.uNode,e=d.createElement('<div id="aa"><p>sdf<b>sdf</b></p><i>sdf</i></div>');e.innerHTML('<div id="aa"><p style="color:#ccc"><p>sdfssdfs</p></p>sdfasdf</div>'),UE.filterNode(e,{p:{$:{}}}),equals(e.toHtml().replace(/[ ]+>/g,">"),'<div id="aa"><p><p>sdfssdfs</p></p>sdfasdf</div>',"过滤p全部属性"),e.innerHTML("<h6>asd<b>lk</b><i>fj</i></h6>"),UE.filterNode(e,{h6:function(d){d.tagName="p",d.setAttr()},"-":"b i",p:{}}),equals(e.toHtml().replace(/[ ]+>/g,">"),'<div id="aa"><p>asd</p></div>',"同时过滤多个标签属性")}),test("过滤标签部分属性",function(){var d=UE.uNode,e=d.createElement('<div id="aa"><p>sdf<b>sdf</b></p><i>sdf</i></div>');e.innerHTML('<p style="color:#ccc;border:1px solid #ccc;"><table><tbody><tr><td></td></tr></tbody></table></p><div>sdfasdf</div>'),UE.filterNode(e,{p:{$:{style:["color"]}},td:{}}),equals(e.toHtml().replace(/[ ]+>/g,">"),'<div id="aa"><p style="color:#ccc"><td></td></p>sdfasdf</div>',"保留p的color属性"),e.innerHTML('<p style="text-indent:28px;line-height:200%;margin-top:62px;"><strong>sdfs</strong><span style="font-family:宋体">sdfs</span></p>'),UE.filterNode(e,{p:{$:{style:["line-height"]}},span:{$:{}},strong:"-"}),equals(e.toHtml().replace(/[ ]+>/g,">"),'<div id="aa"><p style="line-height:200%"><span>sdfs</span></p></div>',"过滤span全部属性，保留p部分属性，过滤strong标签"),e.innerHTML('<p><a></a><u class="ad" id="underline">sdfs<sub class="ab">sdfs</sub><i>sdfs</i></u><i>sdfs</i></p>'),UE.filterNode(e,{p:{},u:{$:{"class":["ad"]}},sub:{$:{}},i:"-"}),equals(e.toHtml().replace(/[ ]+>/g,">"),'<div id="aa"><p><u class="ad">sdfs<sub>sdfs</sub></u></p></div>',"过滤sub全部属性，保留u部分属性，过滤i标签")}),test("标签替换过滤",function(){var d=UE.uNode,e=d.createElement('<div id="aa"><p>sdf<b>sdf</b></p><i>sdf</i></div>');e.innerHTML('<p style="color:#ccc;border:1px solid #ccc;"><table><tbody><tr><td>sdfs</td><td>sdfs</td></tr></tbody></table></p><div>sdfasdf</div>'),UE.filterNode(e,{p:{$:{style:["color"]}},tr:function(d){d.tagName="p",d.setAttr()},td:function(d){d.parentNode.removeChild(d,!0)}}),equals(e.toHtml().replace(/[ ]+>/g,">"),'<div id="aa"><p style="color:#ccc"><p>sdfssdfs</p></p>sdfasdf</div>',"tr替换为p，过滤掉td"),e.innerHTML('<img src="http://img.baidu.com/hi/jx2/j_0020.gif" height="10px"/><table><caption>aldkfj</caption><tbody><tr style="background-color: #ccc;"><th>adf</th></tr><tr><td>lkj</td></tbody></table>'),UE.filterNode(e,{img:{$:{src:[""]}},table:{},tbody:{},tr:{$:{}},td:{$:{}},th:function(d){var e=!!d.innerText();e&&d.parentNode.insertAfter(UE.uNode.createText(" &nbsp; &nbsp;"),d),d.parentNode.removeChild(d,d.innerText())}}),ua.checkSameHtml(e.toHtml().replace(/[ ]+>/g,">"),'<div id="aa"><img src="http://img.baidu.com/hi/jx2/j_0020.gif" /><table>aldkfj<tbody><tr>adf &nbsp; &nbsp;</tr><tr><td>lkj</td></tr></tbody></table></div>',"th按文本内容替换，保留img部分属性")}),test("保留标签全部属性",function(){var d=UE.uNode,e=d.createElement('<div id="aa"><p>sdf<b>sdf</b></p><i>sdf</i></div>');e.innerHTML('<ol><li><em>sdf</em></li><ul class=" list-paddingleft-2"><li>a</li><li>b</li><li>c</ul><li>jkl</ol>'),UE.filterNode(e,{ol:{},ul:{$:{}},li:{}}),equals(e.toHtml().replace(/[ ]+>/g,">"),'<div id="aa"><ol><li>sdf</li><ul><li>a</li><li>b</li><li>c</li></ul><li>jkl</li></ol></div>',"保留ol、li全部属性，过滤ul全部属性")}),test("过滤规则为空",function(){var d=UE.uNode,e=d.createElement('<div id="aa"><p>sdf<b>sdf</b></p><i>sdf</i></div>');e.innerHTML('<p style="color:#ccc;border:1px solid #ccc;"><table><tbody><tr><td><h1>asd</h1></td></tr></tbody></table></p><div>sdfasdf</div>'),UE.filterNode(e,{}),equals(e.toHtml().replace(/[ ]+>/g,">"),'<div id="aa"><p style="color:#ccc;border:1px solid #ccc;"><table><tbody><tr><td><h1>asd</h1></td></tr></tbody></table></p><div>sdfasdf</div></div>',"过滤规则为空")}),test("特殊规则过滤",function(){var d=UE.uNode,e=d.createElement('<div id="aa"><p>sdf</p><i>sdf</i></div>');e.innerHTML("<script></script>"),UE.filterNode(e,{b:"-"}),equals(e.toHtml().replace(/[ ]+>/g,">"),'<div id="aa"></div>',"过滤规则中包含html中不存在的标签"),e.innerHTML("<p><!--asdfjasldkfjasldkfj--></p>"),UE.filterNode(e,{p:{}}),equals(e.toHtml().replace(/[ ]+>/g,">"),'<div id="aa"><p></p></div>',"innerHTML中包含注释")}),test("只有white list--滤除属性",function(){var d=UE.uNode,e=d.createElement('<div id="aa"><p>sdf</p><i>sdf</i></div>');e.innerHTML('<table></table>hellotable<!--hello--><p><div class="div_class" id="div_id" name="div_name">hellodiv</div></p><span style="color:red;font-size:12px" >hellospan</span>'),UE.filterNode(e,{div:{$:{id:{},"class":{}}},table:{},span:{}}),ua.checkSameHtml(e.toHtml().replace(/[ ]+>/g,">"),'<div id="aa"><table></table>hellotable<div id="div_id" class="div_class">hellodiv</div><span style="color:red;font-size:12px" >hellospan</span></div>',"滤除属性")}),test("只有black list",function(){var d=UE.uNode,e=d.createElement('<div id="aa"><p>sdf</p><i>sdf</i></div>');e.innerHTML('<style  type="text/css"></style><script type="text/javascript"></script><!--comment--><div><script type="text/javascript"></script><span>hello1</span>hello2</div>'),UE.filterNode(e,{span:"-",em:"-","#comment":"-",script:"-",style:"-"}),equals(e.toHtml().replace(/[ ]+>/g,">"),'<div id="aa">hello2</div>',"过滤规则中包含html中不存在的标签")});
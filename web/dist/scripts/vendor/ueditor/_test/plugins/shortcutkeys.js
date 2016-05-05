module("plugins.shortcutkeys"),test("ctrl+i",function(){var t=te.obj[0],e=te.obj[1],o=t.body;t.setContent("<p>没有加粗的文本</p>"),e.selectNode(o.firstChild).select();var s=o.firstChild;t.focus(),setTimeout(function(){ua.keydown(t.body,{keyCode:73,ctrlKey:!0}),t.focus(),setTimeout(function(){equal(ua.getChildHTML(s),"<em>没有加粗的文本</em>"),start()},150)},100),stop()}),test("ctrl+u",function(){var t=te.obj[0],e=te.obj[1],o=t.body;stop(),t.setContent("<p>没有加粗的文本</p>"),setTimeout(function(){e.selectNode(o.firstChild).select();o.firstChild;t.focus(),setTimeout(function(){var e='<span style="text-decoration: underline">没有加粗的文本</span>';ua.checkHTMLSameStyle(e,t.document,o.firstChild,"文本被添加了下划线"),start()},150),ua.keydown(t.body,{keyCode:85,ctrlKey:!0})},150)}),test("ctrl+z/y",function(){var t=te.obj[0],e=te.obj[1],o=t.body;t.setContent("<p>没有加粗的文本</p>"),e.selectNode(o.firstChild).select();var s=o.firstChild;t.focus(),setTimeout(function(){ua.keydown(t.body,{keyCode:66,ctrlKey:!0}),setTimeout(function(){equal(ua.getChildHTML(s),"<strong>没有加粗的文本</strong>"),ua.keydown(t.body,{keyCode:90,ctrlKey:!0}),setTimeout(function(){t.focus(),equal(ua.getChildHTML(o.firstChild),"没有加粗的文本"),ua.keydown(t.body,{keyCode:89,ctrlKey:!0}),t.focus(),setTimeout(function(){equal(ua.getChildHTML(o.firstChild),"<strong>没有加粗的文本</strong>"),start()},100)},100)},150)},100),stop()}),test("ctrl+a",function(){var t=te.obj[0],e=te.obj[1],o=t.body;t.setContent("<p>全选的文本1</p><h1>全选的文本2</h1>"),e.selectNode(o.firstChild).select();o.firstChild;ua.keydown(t.body,{keyCode:65,ctrlKey:!0}),setTimeout(function(){var e=t.selection.getRange();ua.browser.gecko?ua.checkResult(e,o,o,0,2,!1,"查看全选后的range"):ua.checkResult(e,o.firstChild.firstChild,o.lastChild.firstChild,0,6,!1,"查看全选后的range"),start()},150),stop()}),test("ctrl+b",function(){var t=te.obj[0],e=te.obj[1],o=t.body;t.setContent("<p>没有加粗的文本</p>"),e.selectNode(o.firstChild).select(),t.focus(),setTimeout(function(){ua.keydown(t.body,{keyCode:66,ctrlKey:!0}),setTimeout(function(){equal(ua.getChildHTML(o.firstChild),"<strong>没有加粗的文本</strong>"),start()},150)},150),stop()});
module("core.Selection"),test("getRange--闭合选区的边界情况",function(){var e=document.createElement("div");document.body.appendChild(e);var t=new baidu.editor.Editor({autoFloatEnabled:!1});stop(),setTimeout(function(){t.render(e),t.ready(function(){setTimeout(function(){var o=new baidu.editor.dom.Range(t.document);t.setContent("<p><strong>xxx</strong></p>"),o.setStart(t.body.firstChild.firstChild,0).collapse(!0).select(),o=t.selection.getRange();var n=t.body.firstChild.firstChild;ua.browser.ie>8?ok(o.startContainer===n&&1===o.startOffset,"startContainer是xxx左边的占位符或者xxx"):(ok(3==o.startContainer.nodeType,"startContainer是文本节点"),ok(o.startContainer===n.firstChild&&1==n.firstChild.length||3==o.startContainer.nodeValue.length&&o.startContainer===n.lastChild,"startContainer是xxx左边的占位符或者xxx")),ua.manualDeleteFillData(t.body),o.setStart(t.body.firstChild.firstChild,1).collapse(!0).select(),o=t.selection.getRange(),ok(o.startContainer===n||o.startContainer===n.lastChild&&1==n.lastChild.length||3==o.startContainer.nodeValue.length&&o.startContainer===n.firstChild,"startContainer是xxx或者xxx右边的占位符"),ua.manualDeleteFillData(t.body),o.setStart(t.body.firstChild,0).collapse(!0).select(),o=t.selection.getRange(),te.dom.push(e),te.obj.push(t),start()},50)})},50)}),test("trace 1742  isFocus",function(){if(!ua.browser.opera){var e=document.createElement("div"),t=document.createElement("div");document.body.appendChild(e),document.body.appendChild(t);var o=new UE.Editor({initialContent:"<span>hello</span>",autoFloatEnabled:!1}),n=new UE.Editor({initialContent:"<span>hello</span>",autoFloatEnabled:!1});o.render(e),stop(),o.ready(function(){n.render(t),n.ready(function(){o.focus(),ok(o.selection.isFocus(),"设editor内容是<span> editor1 is focused"),ok(!n.selection.isFocus(),"设editor内容是<span> editor2 is not focused"),n.focus(),ok(n.selection.isFocus(),"设editor内容是<span> editor2 is focused"),ok(!o.selection.isFocus(),"设editor内容是<span> editor1 is not focused"),e.parentNode.removeChild(e),t.parentNode.removeChild(t);var i=document.createElement("div"),a=document.createElement("div");document.body.appendChild(i),document.body.appendChild(a);var d=new UE.Editor({initialContent:"<h1>hello</h1>",autoFloatEnabled:!1}),r=new UE.Editor({initialContent:"<h1>hello</h1>",autoFloatEnabled:!1});d.render(i),d.ready(function(){r.render(a),r.ready(function(){d.focus(),ok(d.selection.isFocus(),"设editor内容是<h1> editor1 is focused"),ok(!r.selection.isFocus(),"设editor内容是<h1> editor2 is not focused"),r.focus(),ok(r.selection.isFocus(),"设editor内容是<h1> editor2 is focused"),ok(!d.selection.isFocus(),"设editor内容是<h1> editor1 is not focused"),setTimeout(function(){i.parentNode.removeChild(i),a.parentNode.removeChild(a),start()},50)})})})})}});
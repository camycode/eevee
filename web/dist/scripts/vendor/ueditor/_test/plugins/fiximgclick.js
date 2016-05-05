module("plugins.fiximgclick"),test("webkit下图片可以被选中并出现八个角",function(){if(ua.browser.webkit){var e=document.createElement("script");e.id="sc",e.type="text/plain",document.body.appendChild(e);var t=new UE.ui.Editor({autoFloatEnabled:!0,topOffset:60,autoHeightEnabled:!0,scaleEnabled:!1});t.render(e.id),t.ready(function(){t.setContent('<p>修正webkit下图片选择的问题<img src="" width="200" height="100" />修正webkit下图片选择的问题</p>');var i=t.body.getElementsByTagName("img")[0],d=t.body.firstChild;ua.click(i);var n=t.selection.getRange();ua.checkResult(n,d,d,1,2,!1,"检查当前的range是否为img");var a=document.getElementById(t.ui.id+"_scale");ok(a&&"none"!=a.style.display,"检查八个角是否已出现"),ok(i.style.width==a.style.width&&i.style.height==a.style.height,"检查八个角和图片宽高度是否相等"),UE.delEditor(e.id),domUtils.remove(e),start()}),stop()}}),test("鼠标在八个角上拖拽改变图片大小",function(){if(ua.browser.webkit){var e=document.createElement("script");e.id="sc",e.type="text/plain",document.body.appendChild(e);var t=new UE.ui.Editor({autoFloatEnabled:!0,topOffset:60,autoHeightEnabled:!0,scaleEnabled:!1});t.render(e.id),t.ready(function(){t.setContent('<p>修正webkit下图片选择的问题<img src="" width="200" height="100" />修正webkit下图片选择的问题</p>');var i=t.body.getElementsByTagName("img")[0];t.body.firstChild;ua.click(i);var d,n,a=document.getElementById(t.ui.id+"_imagescale"),o=a.children[0];d=parseInt(a.style.width),n=parseInt(a.style.height),ua.mousedown(o,{clientX:322,clientY:281}),ua.mousemove(document,{clientX:352,clientY:301}),equal(d-parseInt(a.style.width),30,"检查鼠标拖拽中图片宽度是否正确 --"),equal(n-parseInt(a.style.height),20,"检查鼠标拖拽中图片高度是否正确 --"),ua.mousemove(document,{clientX:382,clientY:321}),ua.mouseup(document,{clientX:382,clientY:321}),equal(d-parseInt(a.style.width),60,"检查鼠标拖拽完毕图片高度是否正确 --"),equal(n-parseInt(a.style.height),40,"检查鼠标拖拽完毕图片高度是否正确 --"),ok(i.style.width==a.style.width&&i.style.height==a.style.height,"检查八个角和图片宽高度是否相等"),UE.delEditor(e.id),domUtils.remove(e),start()}),stop()}}),test("鼠标点击图片外的其他区域时，八个角消失",function(){if(ua.browser.webkit){var e=document.createElement("script");e.id="sc",e.type="text/plain",document.body.appendChild(e);var t=new UE.ui.Editor({autoFloatEnabled:!0,topOffset:60,autoHeightEnabled:!0,scaleEnabled:!1});t.render(e.id),t.ready(function(){t.setContent('<p>修正webkit下图片选择的问题<img src="" width="200" height="100" />修正webkit下图片选择的问题</p>');var i=t.body.getElementsByTagName("img")[0];t.body.firstChild;ua.click(i);var d=document.getElementById(t.ui.id+"_imagescale"),n=document.getElementById(t.ui.id+"_imagescale_cover");ok(d&&"none"!=d.style.display,"检查八个角是否已出现"),ok(n&&"none"!=n.style.display,"检查遮罩层是否已出现"),ua.mousedown(t.ui.getDom(),{clientX:100,clientY:100}),ok(n&&"none"==n.style.display,"检查遮罩层是否已消失"),ok(d&&"none"==d.style.display,"检查八个角是否已消失"),UE.delEditor(e.id),domUtils.remove(e),start()}),stop()}}),test("键盘有操作时，八个角消失",function(){if(ua.browser.webkit){var e=document.createElement("script");e.id="sc",e.type="text/plain",document.body.appendChild(e);var t=new UE.ui.Editor({autoFloatEnabled:!0,topOffset:60,autoHeightEnabled:!0,scaleEnabled:!1});t.render(e.id),t.ready(function(){t.setContent('<p>修正webkit下图片选择的问题<img src="" width="200" height="100" />修正webkit下图片选择的问题</p>');var i=t.body.getElementsByTagName("img")[0];t.body.firstChild;ua.click(i);var d=document.getElementById(t.ui.id+"_imagescale"),n=document.getElementById(t.ui.id+"_imagescale_cover");ok(d&&"none"!=d.style.display,"检查八个角是否已出现"),ok(n&&"none"!=n.style.display,"检查遮罩层是否已出现"),ua.keydown(t.ui.getDom()),ok(n&&"none"==n.style.display,"检查遮罩层是否已消失"),ok(d&&"none"==d.style.display,"检查八个角是否已消失"),UE.delEditor(e.id),domUtils.remove(e),start()}),stop()}});
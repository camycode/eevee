module("plugins.template"),test("模板",function(){var e=te.obj[0],t=te.obj[1];e.setContent("<p>hello</p>"),t.setStart(e.body.firstChild,0).collapse(!0).select(),e.execCommand("template",{html:'<p class="ue_t">欢迎使用UEditor！</p>'}),ua.manualDeleteFillData(e.body),equal(ua.getHTML(e.body.firstChild),'<p class="ue_t">欢迎使用ueditor！</p>'),ua.browser.gecko||ua.browser.ie>8||(ua.browser.webkit?(ua.click(e.body.firstChild),equal(e.selection.getRange().startContainer.firstChild.length,"12","检查选区"),ua.keydown(e.body.firstChild),equal(e.selection.getRange().startContainer.firstChild.length,"12","检查选区")):(ua.click(e.body.firstChild),equal(e.selection.getRange().startContainer.length,"12","检查选区"),ua.keydown(e.body.firstChild),equal(e.selection.getRange().startContainer.length,"12","检查选区")))});
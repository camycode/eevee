module("plugins.searchreplace"),test("trace 3381：查找",function(){if(!ua.browser.opera){var e=te.obj[0],a=te.obj[1];e.setContent("<p>hello啊</p>"),stop(),setTimeout(function(){a.setStart(e.body.firstChild,0).collapse(!0).select();e.execCommand("searchreplace",{searchStr:"啊"});ua.manualDeleteFillData(e.body),equal(e.body.firstChild.innerHTML,"hello啊"),equal(e.selection.getRange().collapsed,!1,"检查选区:不闭合为找到"),start()},20)}}),test(" trace 3697全部替换",function(){if(!ua.browser.opera){var e=te.obj[0],a=te.obj[1];e.setContent("<p>欢迎回来</p>"),a.setStart(e.body.firstChild,0).collapse(!0).select(),e.execCommand("searchreplace",{searchStr:"欢迎",replaceStr:"你好"}),e.undoManger.undo(),e.execCommand("searchreplace",{searchStr:"欢迎",replaceStr:"你好",all:!0}),ua.manualDeleteFillData(e.body),equal(e.body.firstChild.innerHTML,"你好回来")}}),test(" trace 3697替换内容包含查找内容",function(){if(!ua.browser.opera){var e=te.obj[0],a=te.obj[1];e.setContent("<p>欢迎回来</p>"),a.setStart(e.body.firstChild,0).collapse(1).select(),e.execCommand("searchreplace",{searchStr:"欢迎",replaceStr:"欢迎啊"}),ua.manualDeleteFillData(e.body),equal(e.body.firstChild.innerHTML,"欢迎啊回来"),e.undoManger.undo(),ua.manualDeleteFillData(e.body),equal(e.body.firstChild.innerHTML,"欢迎回来")}}),test("替换内容为空",function(){if(!ua.browser.opera){var e=te.obj[0];e.setContent("<p>欢迎回来</p>"),stop(),setTimeout(function(){e.focus(),e.execCommand("searchreplace",{searchStr:"欢迎",replaceStr:""}),ua.manualDeleteFillData(e.body),equal(e.body.firstChild.innerHTML,"回来"),start()},50)}}),test("全部替换内容为空",function(){if(!ua.browser.opera){var e=te.obj[0];e.setContent("<p>欢迎回来 欢迎啊</p>"),e.execCommand("searchreplace",{searchStr:"欢迎",replaceStr:"",all:!0}),ua.manualDeleteFillData(e.body),equal(e.body.firstChild.innerHTML,"回来 啊")}});
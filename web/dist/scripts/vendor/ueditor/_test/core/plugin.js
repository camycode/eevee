module("core.plugin"),test("register",function(){UE.plugin.register("test",function(){this.testplugin=!0}),$('<div id="ue"></div>').appendTo(document.body);var t=UE.getEditor("ue");stop(),t.ready(function(){ok(this.testplugin),t.destroy(),$("#ue").remove(),start()})}),test("load",function(){UE.plugin.register("test",function(){this.testplugin=!0}),$('<div id="ue"></div>').appendTo(document.body);var t=UE.getEditor("ue",{test:!1});stop(),t.ready(function(){start()})});
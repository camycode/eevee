$(document).ready(function(){function e(e){$("#console").focus().append(e+"\n")}$("#demo2").html($("#demo1").html()),$("#demo1 li").first().addClass("active"),$("#demo2 li").first().addClass("active"),$("#demo1, #demo2").find("li > a").click(function(t){t.preventDefault();var i=$(this).is("a"),n=i?$(this).attr("href"):"";i&&"#"!==n?e("Click my caret to open my submenu"):i&&e("Dummy link")}),e("navgoco console waiting for input..."),$("pre > code").each(function(){var e=$(this),t=e.attr("class"),i=e.data("source"),n=$("#"+i+"-"+t).html();e.text($.trim(n))}),$(".tabs a").click(function(e){e.preventDefault(),$(this).parent().siblings().removeClass("active").end().addClass("active"),$(this).parents("ul").next().children().hide().eq($(this).parent().index()).show()}),$(".panes").each(function(){$(this).children().hide().eq(0).show()}),hljs.tabReplace="    ",hljs.initHighlightingOnLoad()});
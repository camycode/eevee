var testingElement={},te=testingElement;te.log=function(t){var e=new Image,n="tangram_sio_log_"+Math.floor(2147483648*Math.random()).toString(36);window[n]=e,e.onload=e.onerror=e.onabort=function(){e.onload=e.onerror=e.onabort=null,window[n]=null,e=null},e.src=t},function(){function t(){te.presskey=function(t,e){var n=top.document.getElementsByTagName("title")[0].innerHTML,o=document.getElementById("plugin"),r=ua.getBrowser();"ie9"!=r&&o.sendKeyborad(r,n,"null",""),o.sendKeyborad(r,n,t,e)},te.setClipData=function(t){var e=top.document.getElementsByTagName("title")[0].innerHTML,n=document.getElementById("plugin"),o=ua.getBrowser();n.setClipboard(o,e,t)},te.dom=[],te.obj=[]}function e(){if(te&&te.dom&&te.dom.length)for(var t=0;t<te.dom.length;t++)te.dom[t]&&te.dom[t].parentNode&&te.dom[t].parentNode.removeChild(te.dom[t])}var n=QUnit.testStart,o=QUnit.testDone;QUnit.moduleStart,QUnit.moduleEnd,QUnit.done;QUnit.testStart=function(){t(),n.apply(this,arguments)},QUnit.testDone=function(){o.call(this,arguments),e()}}();
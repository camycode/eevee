module("core.browser"),test("browser",function(){var e=baidu.editor.browser;if(e.ie){ok(ua.browser.ie,"is ie");var o=ua.browser.ie;switch(e.version<7&&(ok(e.ie6Compat,"ie6 compat mode"),equal(o,e.version,"check ie version")),7==e.version&&(ok(e.ie7Compat,"ie7 compat mode"),equal(o,e.version,"check ie version"),ok(e.isCompatible,"is compatible")),document.documentMode){case 7:ok(e.ie7Compat,"ie7 document Mode"),equal(o,e.version,"check ie version"),ok(e.isCompatible,"is compatible");break;case 8:ok(e.ie8Compat,"ie8 document Mode"),equal(o,e.version,"check ie version"),ok(e.isCompatible,"is compatible");break;case 9:ok(e.ie9Compat,"ie9 document Mode"),equal(o,e.version,"check ie version"),ok(e.isCompatible,"is compatible");break;case 11:ok(e.ie11Compat,"ie11 document Mode"),equal(o,e.version,"check ie version"),ok(e.isCompatible,"is compatible")}}e.opera&&(ok(ua.browser.opera,"is opera"),equal(e.version,ua.browser.opera,"check opera version")),e.webkit&&(ok(ua.browser.webkit,"is webkit"),equal(e.webkit,ua.browser.webkit>0,"check webkit version")),e.gecko&&(ok(ua.browser.gecko,"is gecko"),equal(e.gecko,!!ua.browser.gecko,"check gecko version")),e.quirks&&(equal(document.compatMode,"BackCompat","is quirks mode"),equal(e.version,6,"ie version is 6"))});
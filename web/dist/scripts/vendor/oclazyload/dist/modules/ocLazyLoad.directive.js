!function(n){"use strict";n.module("oc.lazyLoad").directive("ocLazyLoad",["$ocLazyLoad","$compile","$animate","$parse","$timeout",function(t,o,e,i,a){return{restrict:"A",terminal:!0,priority:1e3,compile:function(a,c){var r=a[0].innerHTML;return a.html(""),function(a,c,u){var L=i(u.ocLazyLoad);a.$watch(function(){return L(a)||u.ocLazyLoad},function(i){n.isDefined(i)&&t.load(i).then(function(){e.enter(r,c),o(c.contents())(a)})},!0)}}}}])}(angular);
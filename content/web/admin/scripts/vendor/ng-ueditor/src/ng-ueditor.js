!function(){"use strict";var e=function(e,t,n,r,i){var o=0,d="ng-ueditor",a=function(a,u){var c;return u.ready&&(c=i(u.ready)),function(i,a,u,s){if(void 0===e.UE)return void t.warn("Can not load ueditor.");var v,l=s[0],f=i.$eval(u.ngUeditor)||{};if(c)var $=function(){c(i,{$editor:v})};var g,m=void 0!==u.allHtml;void 0!==u.id?g=u.id:(g=d+"-"+o++,u.$set("id",g));var y=function(e){l.$setViewValue(e),r.$applyAsync()},p=function(e){var t=e.getContent().trim();y(t)},E=function(e){var t=e.getAllHtml().trim();y(t)};l.$formatters.unshift(function(e){return e?n.trustAsHtml(e):""}),l.$render=function(){var e=n.getTrustedHtml(l.$viewValue||"");void 0!==v&&1===v.isReady&&(v.setContent(e),v.fireEvent("contentChange"))},v=UE.getEditor(g,f);var w=function(){var e=m===!0?E.bind(void 0,v):p.bind(void 0,v);v.addListener("afterExecCommand",e),v.addListener("contentChange",e),f.enableAutoSave===!1&&v.addListener("showmessage",function(e,t){return"本地保存成功"===t.content||"Local conservation success"===t.content?!0:void 0}),$&&i.$apply($),l.$render(),l.$setPristine()};v.ready(w),i.$on("$destroy",function(){void 0!==v&&1===v.isReady&&UE.delEditor(g),v=void 0})}};return{restrict:"A",require:["ngModel"],compile:a}};angular.module("ng.ueditor",[]).directive("ngUeditor",["$window","$log","$sce","$rootScope","$parse",e])}();
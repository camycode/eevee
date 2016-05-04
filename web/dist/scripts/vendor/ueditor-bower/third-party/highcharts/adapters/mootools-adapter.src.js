/**
 * @license Highcharts JS v3.0.6 (2013-10-04)
 * MooTools adapter
 *
 * (c) 2010-2013 Torstein Hønsi
 *
 * License: www.highcharts.com/license
 */

!function(){var t=window,e=document,n=t.MooTools.version.substring(0,3),r="1.2"===n||"1.1"===n,a=r||"1.3"===n,o=t.$extend||function(){return Object.append.apply(Object,arguments)};t.HighchartsAdapter={init:function(t){var e=Fx.prototype,n=e.start,r=Fx.Morph.prototype,a=r.compute;e.start=function(e,r){var a=this,o=a.element;return e.d&&(a.paths=t.init(o,o.d,a.toD)),n.apply(a,arguments),this},r.compute=function(e,n,r){var o=this,i=o.paths;return i?void o.element.attr("d",t.step(i[0],i[1],r,o.toD)):a.apply(o,arguments)}},adapterRun:function(t,e){return"width"===e||"height"===e?parseInt($(t).getStyle(e),10):void 0},getScript:function(t,n){var r=e.getElementsByTagName("head")[0],a=e.createElement("script");a.type="text/javascript",a.src=t,a.onload=n,r.appendChild(a)},animate:function(e,n,r){var a,i=e.attr,u=r&&r.complete;i&&!e.setStyle&&(e.getStyle=e.attr,e.setStyle=function(){var t=arguments;this.attr.call(this,t[0],t[1][0])},e.$family=function(){return!0}),t.HighchartsAdapter.stop(e),a=new Fx.Morph(i?e:$(e),o({transition:Fx.Transitions.Quad.easeInOut},r)),i&&(a.element=e),n.d&&(a.toD=n.d),u&&a.addEvent("complete",u),a.start(n),e.fx=a},each:function(t,e){return r?$each(t,e):Array.each(t,e)},map:function(t,e){return t.map(e)},grep:function(t,e){return t.filter(e)},inArray:function(t,e,n){return e?e.indexOf(t,n):-1},offset:function(t){var e=t.getPosition();return{left:e.x,top:e.y}},extendWithEvents:function(t){t.addEvent||(t.nodeName?t=$(t):o(t,new Events))},addEvent:function(e,n,r){"string"==typeof n&&("unload"===n&&(n="beforeunload"),t.HighchartsAdapter.extendWithEvents(e),e.addEvent(n,r))},removeEvent:function(t,e,n){"string"!=typeof t&&t.addEvent&&(e?("unload"===e&&(e="beforeunload"),n?t.removeEvent(e,n):t.removeEvents&&t.removeEvents(e)):t.removeEvents())},fireEvent:function(t,e,n,r){var i={type:e,target:t};e=a?new Event(i):new DOMEvent(i),e=o(e,n),!e.target&&e.event&&(e.target=e.event.target),e.preventDefault=function(){r=null},t.fireEvent&&t.fireEvent(e.type,e),r&&r(e)},washMouseEvent:function(t){return t.page&&(t.pageX=t.page.x,t.pageY=t.page.y),t},stop:function(t){t.fx&&t.fx.cancel()}}}();
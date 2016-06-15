/*!
 * # Semantic UI 2.1.7 - Visibility
 * http://github.com/semantic-org/semantic-ui/
 *
 *
 * Copyright 2015 Contributors
 * Released under the MIT license
 * http://opensource.org/licenses/MIT
 *
 */

!function(e,o,n,t){e.fn.visibility=function(i){var s,c=e(this),r=c.selector||"",a=(new Date).getTime(),l=[],u=arguments[0],d="string"==typeof u,f=[].slice.call(arguments,1);return c.each(function(){var c,b,m,g=e.isPlainObject(i)?e.extend(!0,{},e.fn.visibility.settings,i):e.extend({},e.fn.visibility.settings),p=g.className,v=g.namespace,h=g.error,P=g.metadata,x="."+v,C="module-"+v,y=e(o),R=e(this),V=e(g.context),S=(R.selector||"",R.data(C)),k=o.requestAnimationFrame||o.mozRequestAnimationFrame||o.webkitRequestAnimationFrame||o.msRequestAnimationFrame||function(e){setTimeout(e,0)},T=this,O=!1;m={initialize:function(){m.debug("Initializing",g),m.setup.cache(),m.should.trackChanges()&&("image"==g.type&&m.setup.image(),"fixed"==g.type&&m.setup.fixed(),g.observeChanges&&m.observeChanges(),m.bind.events()),m.save.position(),m.is.visible()||m.error(h.visible,R),g.initialCheck&&m.checkVisibility(),m.instantiate()},instantiate:function(){m.debug("Storing instance",m),R.data(C,m),S=m},destroy:function(){m.verbose("Destroying previous module"),b&&b.disconnect(),y.off("load"+x,m.event.load).off("resize"+x,m.event.resize),V.off("scrollchange"+x,m.event.scrollchange),R.off(x).removeData(C)},observeChanges:function(){"MutationObserver"in o&&(b=new MutationObserver(function(e){m.verbose("DOM tree modified, updating visibility calculations"),m.timer=setTimeout(function(){m.verbose("DOM tree modified, updating sticky menu"),m.refresh()},100)}),b.observe(T,{childList:!0,subtree:!0}),m.debug("Setting up mutation observer",b))},bind:{events:function(){m.verbose("Binding visibility events to scroll and resize"),g.refreshOnLoad&&y.on("load"+x,m.event.load),y.on("resize"+x,m.event.resize),V.off("scroll"+x).on("scroll"+x,m.event.scroll).on("scrollchange"+x,m.event.scrollchange)}},event:{resize:function(){m.debug("Window resized"),g.refreshOnResize&&k(m.refresh)},load:function(){m.debug("Page finished loading"),k(m.refresh)},scroll:function(){g.throttle?(clearTimeout(m.timer),m.timer=setTimeout(function(){V.triggerHandler("scrollchange"+x,[V.scrollTop()])},g.throttle)):k(function(){V.triggerHandler("scrollchange"+x,[V.scrollTop()])})},scrollchange:function(e,o){m.checkVisibility(o)}},precache:function(o,t){o instanceof Array||(o=[o]);for(var i=o.length,s=0,c=[],r=n.createElement("img"),a=function(){s++,s>=o.length&&e.isFunction(t)&&t()};i--;)r=n.createElement("img"),r.onload=a,r.onerror=a,r.src=o[i],c.push(r)},enableCallbacks:function(){m.debug("Allowing callbacks to occur"),O=!1},disableCallbacks:function(){m.debug("Disabling all callbacks temporarily"),O=!0},should:{trackChanges:function(){return d?(m.debug("One time query, no need to bind events"),!1):(m.debug("Callbacks being attached"),!0)}},setup:{cache:function(){m.cache={occurred:{},screen:{},element:{}}},image:function(){var e=R.data(P.src);e&&(m.verbose("Lazy loading image",e),g.once=!0,g.observeChanges=!1,g.onOnScreen=function(){m.debug("Image on screen",T),m.precache(e,function(){m.set.image(e)})})},fixed:function(){m.debug("Setting up fixed"),g.once=!1,g.observeChanges=!1,g.initialCheck=!0,g.refreshOnLoad=!0,i.transition||(g.transition=!1),m.create.placeholder(),m.debug("Added placeholder",c),g.onTopPassed=function(){m.debug("Element passed, adding fixed position",R),m.show.placeholder(),m.set.fixed(),g.transition&&e.fn.transition!==t&&R.transition(g.transition,g.duration)},g.onTopPassedReverse=function(){m.debug("Element returned to position, removing fixed",R),m.hide.placeholder(),m.remove.fixed()}}},create:{placeholder:function(){m.verbose("Creating fixed position placeholder"),c=R.clone(!1).css("display","none").addClass(p.placeholder).insertAfter(R)}},show:{placeholder:function(){m.verbose("Showing placeholder"),c.css("display","block").css("visibility","hidden")}},hide:{placeholder:function(){m.verbose("Hiding placeholder"),c.css("display","none").css("visibility","")}},set:{fixed:function(){m.verbose("Setting element to fixed position"),R.addClass(p.fixed).css({position:"fixed",top:g.offset+"px",left:"auto",zIndex:"1"})},image:function(o){R.attr("src",o),g.transition?e.fn.transition!==t?R.transition(g.transition,g.duration):R.fadeIn(g.duration):R.show()}},is:{onScreen:function(){var e=m.get.elementCalculations();return e.onScreen},offScreen:function(){var e=m.get.elementCalculations();return e.offScreen},visible:function(){return m.cache&&m.cache.element?!(0===m.cache.element.width&&0===m.cache.element.offset.top):!1}},refresh:function(){m.debug("Refreshing constants (width/height)"),"fixed"==g.type&&(m.remove.fixed(),m.remove.occurred()),m.reset(),m.save.position(),g.checkOnRefresh&&m.checkVisibility(),g.onRefresh.call(T)},reset:function(){m.verbose("Reseting all cached values"),e.isPlainObject(m.cache)&&(m.cache.screen={},m.cache.element={})},checkVisibility:function(e){m.verbose("Checking visibility of element",m.cache.element),!O&&m.is.visible()&&(m.save.scroll(e),m.save.calculations(),m.passed(),m.passingReverse(),m.topVisibleReverse(),m.bottomVisibleReverse(),m.topPassedReverse(),m.bottomPassedReverse(),m.onScreen(),m.offScreen(),m.passing(),m.topVisible(),m.bottomVisible(),m.topPassed(),m.bottomPassed(),g.onUpdate&&g.onUpdate.call(T,m.get.elementCalculations()))},passed:function(o,n){var i=m.get.elementCalculations();if(o&&n)g.onPassed[o]=n;else{if(o!==t)return m.get.pixelsPassed(o)>i.pixelsPassed;i.passing&&e.each(g.onPassed,function(e,o){i.bottomVisible||i.pixelsPassed>m.get.pixelsPassed(e)?m.execute(o,e):g.once||m.remove.occurred(o)})}},onScreen:function(e){var o=m.get.elementCalculations(),n=e||g.onOnScreen,i="onScreen";return e&&(m.debug("Adding callback for onScreen",e),g.onOnScreen=e),o.onScreen?m.execute(n,i):g.once||m.remove.occurred(i),e!==t?o.onOnScreen:void 0},offScreen:function(e){var o=m.get.elementCalculations(),n=e||g.onOffScreen,i="offScreen";return e&&(m.debug("Adding callback for offScreen",e),g.onOffScreen=e),o.offScreen?m.execute(n,i):g.once||m.remove.occurred(i),e!==t?o.onOffScreen:void 0},passing:function(e){var o=m.get.elementCalculations(),n=e||g.onPassing,i="passing";return e&&(m.debug("Adding callback for passing",e),g.onPassing=e),o.passing?m.execute(n,i):g.once||m.remove.occurred(i),e!==t?o.passing:void 0},topVisible:function(e){var o=m.get.elementCalculations(),n=e||g.onTopVisible,i="topVisible";return e&&(m.debug("Adding callback for top visible",e),g.onTopVisible=e),o.topVisible?m.execute(n,i):g.once||m.remove.occurred(i),e===t?o.topVisible:void 0},bottomVisible:function(e){var o=m.get.elementCalculations(),n=e||g.onBottomVisible,i="bottomVisible";return e&&(m.debug("Adding callback for bottom visible",e),g.onBottomVisible=e),o.bottomVisible?m.execute(n,i):g.once||m.remove.occurred(i),e===t?o.bottomVisible:void 0},topPassed:function(e){var o=m.get.elementCalculations(),n=e||g.onTopPassed,i="topPassed";return e&&(m.debug("Adding callback for top passed",e),g.onTopPassed=e),o.topPassed?m.execute(n,i):g.once||m.remove.occurred(i),e===t?o.topPassed:void 0},bottomPassed:function(e){var o=m.get.elementCalculations(),n=e||g.onBottomPassed,i="bottomPassed";return e&&(m.debug("Adding callback for bottom passed",e),g.onBottomPassed=e),o.bottomPassed?m.execute(n,i):g.once||m.remove.occurred(i),e===t?o.bottomPassed:void 0},passingReverse:function(e){var o=m.get.elementCalculations(),n=e||g.onPassingReverse,i="passingReverse";return e&&(m.debug("Adding callback for passing reverse",e),g.onPassingReverse=e),o.passing?g.once||m.remove.occurred(i):m.get.occurred("passing")&&m.execute(n,i),e!==t?!o.passing:void 0},topVisibleReverse:function(e){var o=m.get.elementCalculations(),n=e||g.onTopVisibleReverse,i="topVisibleReverse";return e&&(m.debug("Adding callback for top visible reverse",e),g.onTopVisibleReverse=e),o.topVisible?g.once||m.remove.occurred(i):m.get.occurred("topVisible")&&m.execute(n,i),e===t?!o.topVisible:void 0},bottomVisibleReverse:function(e){var o=m.get.elementCalculations(),n=e||g.onBottomVisibleReverse,i="bottomVisibleReverse";return e&&(m.debug("Adding callback for bottom visible reverse",e),g.onBottomVisibleReverse=e),o.bottomVisible?g.once||m.remove.occurred(i):m.get.occurred("bottomVisible")&&m.execute(n,i),e===t?!o.bottomVisible:void 0},topPassedReverse:function(e){var o=m.get.elementCalculations(),n=e||g.onTopPassedReverse,i="topPassedReverse";return e&&(m.debug("Adding callback for top passed reverse",e),g.onTopPassedReverse=e),o.topPassed?g.once||m.remove.occurred(i):m.get.occurred("topPassed")&&m.execute(n,i),e===t?!o.onTopPassed:void 0},bottomPassedReverse:function(e){var o=m.get.elementCalculations(),n=e||g.onBottomPassedReverse,i="bottomPassedReverse";return e&&(m.debug("Adding callback for bottom passed reverse",e),g.onBottomPassedReverse=e),o.bottomPassed?g.once||m.remove.occurred(i):m.get.occurred("bottomPassed")&&m.execute(n,i),e===t?!o.bottomPassed:void 0},execute:function(e,o){var n=m.get.elementCalculations(),t=m.get.screenCalculations();e=e||!1,e&&(g.continuous?(m.debug("Callback being called continuously",o,n),e.call(T,n,t)):m.get.occurred(o)||(m.debug("Conditions met",o,n),e.call(T,n,t))),m.save.occurred(o)},remove:{fixed:function(){m.debug("Removing fixed position"),R.removeClass(p.fixed).css({position:"",top:"",left:"",zIndex:""})},occurred:function(e){if(e){var o=m.cache.occurred;o[e]!==t&&o[e]===!0&&(m.debug("Callback can now be called again",e),m.cache.occurred[e]=!1)}else m.cache.occurred={}}},save:{calculations:function(){m.verbose("Saving all calculations necessary to determine positioning"),m.save.direction(),m.save.screenCalculations(),m.save.elementCalculations()},occurred:function(e){e&&(m.cache.occurred[e]===t||m.cache.occurred[e]!==!0)&&(m.verbose("Saving callback occurred",e),m.cache.occurred[e]=!0)},scroll:function(e){e=e+g.offset||V.scrollTop()+g.offset,m.cache.scroll=e},direction:function(){var e,o=m.get.scroll(),n=m.get.lastScroll();return e=o>n&&n?"down":n>o&&n?"up":"static",m.cache.direction=e,m.cache.direction},elementPosition:function(){var e=m.cache.element,o=m.get.screenSize();return m.verbose("Saving element position"),e.fits=e.height<o.height,e.offset=R.offset(),e.width=R.outerWidth(),e.height=R.outerHeight(),m.cache.element=e,e},elementCalculations:function(){var e=m.get.screenCalculations(),o=m.get.elementPosition();return g.includeMargin?(o.margin={},o.margin.top=parseInt(R.css("margin-top"),10),o.margin.bottom=parseInt(R.css("margin-bottom"),10),o.top=o.offset.top-o.margin.top,o.bottom=o.offset.top+o.height+o.margin.bottom):(o.top=o.offset.top,o.bottom=o.offset.top+o.height),o.topVisible=e.bottom>=o.top,o.topPassed=e.top>=o.top,o.bottomVisible=e.bottom>=o.bottom,o.bottomPassed=e.top>=o.bottom,o.pixelsPassed=0,o.percentagePassed=0,o.onScreen=o.topVisible&&!o.bottomPassed,o.passing=o.topPassed&&!o.bottomPassed,o.offScreen=!o.onScreen,o.passing&&(o.pixelsPassed=e.top-o.top,o.percentagePassed=(e.top-o.top)/o.height),m.cache.element=o,m.verbose("Updated element calculations",o),o},screenCalculations:function(){var e=m.get.scroll();return m.save.direction(),m.cache.screen.top=e,m.cache.screen.bottom=e+m.cache.screen.height,m.cache.screen},screenSize:function(){m.verbose("Saving window position"),m.cache.screen={height:V.height()}},position:function(){m.save.screenSize(),m.save.elementPosition()}},get:{pixelsPassed:function(e){var o=m.get.elementCalculations();return e.search("%")>-1?o.height*(parseInt(e,10)/100):parseInt(e,10)},occurred:function(e){return m.cache.occurred!==t?m.cache.occurred[e]||!1:!1},direction:function(){return m.cache.direction===t&&m.save.direction(),m.cache.direction},elementPosition:function(){return m.cache.element===t&&m.save.elementPosition(),m.cache.element},elementCalculations:function(){return m.cache.element===t&&m.save.elementCalculations(),m.cache.element},screenCalculations:function(){return m.cache.screen===t&&m.save.screenCalculations(),m.cache.screen},screenSize:function(){return m.cache.screen===t&&m.save.screenSize(),m.cache.screen},scroll:function(){return m.cache.scroll===t&&m.save.scroll(),m.cache.scroll},lastScroll:function(){return m.cache.screen===t?(m.debug("First scroll event, no last scroll could be found"),!1):m.cache.screen.top}},setting:function(o,n){if(e.isPlainObject(o))e.extend(!0,g,o);else{if(n===t)return g[o];g[o]=n}},internal:function(o,n){if(e.isPlainObject(o))e.extend(!0,m,o);else{if(n===t)return m[o];m[o]=n}},debug:function(){g.debug&&(g.performance?m.performance.log(arguments):(m.debug=Function.prototype.bind.call(console.info,console,g.name+":"),m.debug.apply(console,arguments)))},verbose:function(){g.verbose&&g.debug&&(g.performance?m.performance.log(arguments):(m.verbose=Function.prototype.bind.call(console.info,console,g.name+":"),m.verbose.apply(console,arguments)))},error:function(){m.error=Function.prototype.bind.call(console.error,console,g.name+":"),m.error.apply(console,arguments)},performance:{log:function(e){var o,n,t;g.performance&&(o=(new Date).getTime(),t=a||o,n=o-t,a=o,l.push({Name:e[0],Arguments:[].slice.call(e,1)||"",Element:T,"Execution Time":n})),clearTimeout(m.performance.timer),m.performance.timer=setTimeout(m.performance.display,500)},display:function(){var o=g.name+":",n=0;a=!1,clearTimeout(m.performance.timer),e.each(l,function(e,o){n+=o["Execution Time"]}),o+=" "+n+"ms",r&&(o+=" '"+r+"'"),(console.group!==t||console.table!==t)&&l.length>0&&(console.groupCollapsed(o),console.table?console.table(l):e.each(l,function(e,o){console.log(o.Name+": "+o["Execution Time"]+"ms")}),console.groupEnd()),l=[]}},invoke:function(o,n,i){var c,r,a,l=S;return n=n||f,i=T||i,"string"==typeof o&&l!==t&&(o=o.split(/[\. ]/),c=o.length-1,e.each(o,function(n,i){var s=n!=c?i+o[n+1].charAt(0).toUpperCase()+o[n+1].slice(1):o;if(e.isPlainObject(l[s])&&n!=c)l=l[s];else{if(l[s]!==t)return r=l[s],!1;if(!e.isPlainObject(l[i])||n==c)return l[i]!==t?(r=l[i],!1):(m.error(h.method,o),!1);l=l[i]}})),e.isFunction(r)?a=r.apply(i,n):r!==t&&(a=r),e.isArray(s)?s.push(a):s!==t?s=[s,a]:a!==t&&(s=a),r}},d?(S===t&&m.initialize(),S.save.scroll(),S.save.calculations(),m.invoke(u)):(S!==t&&S.invoke("destroy"),m.initialize())}),s!==t?s:this},e.fn.visibility.settings={name:"Visibility",namespace:"visibility",debug:!1,verbose:!1,performance:!0,observeChanges:!0,initialCheck:!0,refreshOnLoad:!0,refreshOnResize:!0,checkOnRefresh:!0,once:!0,continuous:!1,offset:0,includeMargin:!1,context:o,throttle:!1,type:!1,transition:"fade in",duration:1e3,onPassed:{},onOnScreen:!1,onOffScreen:!1,onPassing:!1,onTopVisible:!1,onBottomVisible:!1,onTopPassed:!1,onBottomPassed:!1,onPassingReverse:!1,onTopVisibleReverse:!1,onBottomVisibleReverse:!1,onTopPassedReverse:!1,onBottomPassedReverse:!1,onUpdate:!1,onRefresh:function(){},metadata:{src:"src"},className:{fixed:"fixed",placeholder:"placeholder"},error:{method:"The method you called is not defined.",visible:"Element is hidden, you must call refresh after element becomes visible"}}}(jQuery,window,document);
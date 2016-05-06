/*!
 * # Semantic UI 2.0.0 - Visit
 * http://github.com/semantic-org/semantic-ui/
 *
 *
 * Copyright 2015 Contributors
 * Released under the MIT license
 * http://opensource.org/licenses/MIT
 *
 */

!function(e,t,i,n){e.visit=e.fn.visit=function(i){var o,r=e(e.isFunction(this)?t:this),s=r.selector||"",a=(new Date).getTime(),c=[],u=arguments[0],l="string"==typeof u,d=[].slice.call(arguments,1);return r.each(function(){var g,m=e.isPlainObject(i)?e.extend(!0,{},e.fn.visit.settings,i):e.extend({},e.fn.visit.settings),f=m.error,p=m.namespace,v=p+"-module",h=e(this),b=e(),y=this,k=h.data(v);g={initialize:function(){m.count?g.store(m.key.count,m.count):m.id?g.add.id(m.id):m.increment&&"increment"!==l&&g.increment(),g.add.display(h),g.instantiate()},instantiate:function(){g.verbose("Storing instance of visit module",g),k=g,h.data(v,g)},destroy:function(){g.verbose("Destroying instance"),h.removeData(v)},increment:function(e){var t=g.get.count(),i=+t+1;e?g.add.id(e):(i>m.limit&&!m.surpass&&(i=m.limit),g.debug("Incrementing visits",i),g.store(m.key.count,i))},decrement:function(e){var t=g.get.count(),i=+t-1;e?g.remove.id(e):(g.debug("Removing visit"),g.store(m.key.count,i))},get:{count:function(){return+g.retrieve(m.key.count)||0},idCount:function(e){return e=e||g.get.ids(),e.length},ids:function(e){var t=[];return e=e||g.retrieve(m.key.ids),"string"==typeof e&&(t=e.split(m.delimiter)),g.verbose("Found visited ID list",t),t},storageOptions:function(e){var t={};return m.expires&&(t.expires=m.expires),m.domain&&(t.domain=m.domain),m.path&&(t.path=m.path),t}},has:{visited:function(t,i){var o=!1;return i=i||g.get.ids(),t!==n&&i&&e.each(i,function(e,i){i==t&&(o=!0)}),o}},set:{count:function(e){g.store(m.key.count,e)},ids:function(e){g.store(m.key.ids,e)}},reset:function(){g.store(m.key.count,0),g.store(m.key.ids,null)},add:{id:function(e){var t=g.retrieve(m.key.ids),i=t===n||""===t?e:t+m.delimiter+e;g.has.visited(e)?g.debug("Unique content already visited, not adding visit",e,t):e===n?g.debug("ID is not defined"):(g.debug("Adding visit to unique content",e),g.store(m.key.ids,i)),g.set.count(g.get.idCount())},display:function(t){var i=e(t);i.length>0&&!e.isWindow(i[0])&&(g.debug("Updating visit count for element",i),b=b.length>0?b.add(i):i)}},remove:{id:function(t){var i=g.get.ids(),o=[];t!==n&&i!==n&&(g.debug("Removing visit to unique content",t,i),e.each(i,function(e,i){i!==t&&o.push(i)}),o=o.join(m.delimiter),g.store(m.key.ids,o)),g.set.count(g.get.idCount())}},check:{limit:function(e){e=e||g.get.count(),m.limit&&(e>=m.limit&&(g.debug("Pages viewed exceeded limit, firing callback",e,m.limit),m.onLimit.call(y,e)),g.debug("Limit not reached",e,m.limit),m.onChange.call(y,e)),g.update.display(e)}},update:{display:function(e){e=e||g.get.count(),b.length>0&&(g.debug("Updating displayed view count",b),b.html(e))}},store:function(i,o){var r=g.get.storageOptions(o);if("localstorage"==m.storageMethod&&t.localStorage!==n)t.localStorage.setItem(i,o),g.debug("Value stored using local storage",i,o);else{if(e.cookie===n)return void g.error(f.noCookieStorage);e.cookie(i,o,r),g.debug("Value stored using cookie",i,o,r)}i==m.key.count&&g.check.limit(o)},retrieve:function(i,o){var r;return"localstorage"==m.storageMethod&&t.localStorage!==n?r=t.localStorage.getItem(i):e.cookie!==n?r=e.cookie(i):g.error(f.noCookieStorage),("undefined"==r||"null"==r||r===n||null===r)&&(r=n),r},setting:function(t,i){if(e.isPlainObject(t))e.extend(!0,m,t);else{if(i===n)return m[t];m[t]=i}},internal:function(t,i){return g.debug("Changing internal",t,i),i===n?g[t]:void(e.isPlainObject(t)?e.extend(!0,g,t):g[t]=i)},debug:function(){m.debug&&(m.performance?g.performance.log(arguments):(g.debug=Function.prototype.bind.call(console.info,console,m.name+":"),g.debug.apply(console,arguments)))},verbose:function(){m.verbose&&m.debug&&(m.performance?g.performance.log(arguments):(g.verbose=Function.prototype.bind.call(console.info,console,m.name+":"),g.verbose.apply(console,arguments)))},error:function(){g.error=Function.prototype.bind.call(console.error,console,m.name+":"),g.error.apply(console,arguments)},performance:{log:function(e){var t,i,n;m.performance&&(t=(new Date).getTime(),n=a||t,i=t-n,a=t,c.push({Name:e[0],Arguments:[].slice.call(e,1)||"",Element:y,"Execution Time":i})),clearTimeout(g.performance.timer),g.performance.timer=setTimeout(g.performance.display,500)},display:function(){var t=m.name+":",i=0;a=!1,clearTimeout(g.performance.timer),e.each(c,function(e,t){i+=t["Execution Time"]}),t+=" "+i+"ms",s&&(t+=" '"+s+"'"),r.length>1&&(t+=" ("+r.length+")"),(console.group!==n||console.table!==n)&&c.length>0&&(console.groupCollapsed(t),console.table?console.table(c):e.each(c,function(e,t){console.log(t.Name+": "+t["Execution Time"]+"ms")}),console.groupEnd()),c=[]}},invoke:function(t,i,r){var s,a,c,u=k;return i=i||d,r=y||r,"string"==typeof t&&u!==n&&(t=t.split(/[\. ]/),s=t.length-1,e.each(t,function(i,o){var r=i!=s?o+t[i+1].charAt(0).toUpperCase()+t[i+1].slice(1):t;if(e.isPlainObject(u[r])&&i!=s)u=u[r];else{if(u[r]!==n)return a=u[r],!1;if(!e.isPlainObject(u[o])||i==s)return u[o]!==n?(a=u[o],!1):!1;u=u[o]}})),e.isFunction(a)?c=a.apply(r,i):a!==n&&(c=a),e.isArray(o)?o.push(c):o!==n?o=[o,c]:c!==n&&(o=c),a}},l?(k===n&&g.initialize(),g.invoke(u)):(k!==n&&k.invoke("destroy"),g.initialize())}),o!==n?o:this},e.fn.visit.settings={name:"Visit",debug:!1,verbose:!1,performance:!0,namespace:"visit",increment:!1,surpass:!1,count:!1,limit:!1,delimiter:"&",storageMethod:"localstorage",key:{count:"visit-count",ids:"visit-ids"},expires:30,domain:!1,path:"/",onLimit:function(){},onChange:function(){},error:{method:"The method you called is not defined",missingPersist:"Using the persist setting requires the inclusion of PersistJS",noCookieStorage:"The default storage cookie requires $.cookie to be included."}}}(jQuery,window,document);
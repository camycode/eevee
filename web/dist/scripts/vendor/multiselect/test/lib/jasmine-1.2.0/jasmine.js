var isCommonJS="undefined"==typeof window,jasmine={};isCommonJS&&(exports.jasmine=jasmine),jasmine.unimplementedMethod_=function(){throw new Error("unimplemented method")},jasmine.undefined=jasmine.___undefined___,jasmine.VERBOSE=!1,jasmine.DEFAULT_UPDATE_INTERVAL=250,jasmine.DEFAULT_TIMEOUT_INTERVAL=5e3,jasmine.getGlobal=function(){function e(){return this}return e()},jasmine.bindOriginal_=function(e,t){var n=e[t];return n.apply?function(){return n.apply(e,arguments)}:jasmine.getGlobal()[t]},jasmine.setTimeout=jasmine.bindOriginal_(jasmine.getGlobal(),"setTimeout"),jasmine.clearTimeout=jasmine.bindOriginal_(jasmine.getGlobal(),"clearTimeout"),jasmine.setInterval=jasmine.bindOriginal_(jasmine.getGlobal(),"setInterval"),jasmine.clearInterval=jasmine.bindOriginal_(jasmine.getGlobal(),"clearInterval"),jasmine.MessageResult=function(e){this.type="log",this.values=e,this.trace=new Error},jasmine.MessageResult.prototype.toString=function(){for(var e="",t=0;t<this.values.length;t++)t>0&&(e+=" "),e+=jasmine.isString_(this.values[t])?this.values[t]:jasmine.pp(this.values[t]);return e},jasmine.ExpectationResult=function(e){this.type="expect",this.matcherName=e.matcherName,this.passed_=e.passed,this.expected=e.expected,this.actual=e.actual,this.message=this.passed_?"Passed.":e.message;var t=e.trace||new Error(this.message);this.trace=this.passed_?"":t},jasmine.ExpectationResult.prototype.toString=function(){return this.message},jasmine.ExpectationResult.prototype.passed=function(){return this.passed_},jasmine.getEnv=function(){var e=jasmine.currentEnv_=jasmine.currentEnv_||new jasmine.Env;return e},jasmine.isArray_=function(e){return jasmine.isA_("Array",e)},jasmine.isString_=function(e){return jasmine.isA_("String",e)},jasmine.isNumber_=function(e){return jasmine.isA_("Number",e)},jasmine.isA_=function(e,t){return Object.prototype.toString.apply(t)==="[object "+e+"]"},jasmine.pp=function(e){var t=new jasmine.StringPrettyPrinter;return t.format(e),t.string},jasmine.isDomNode=function(e){return e.nodeType>0},jasmine.any=function(e){return new jasmine.Matchers.Any(e)},jasmine.objectContaining=function(e){return new jasmine.Matchers.ObjectContaining(e)},jasmine.Spy=function(e){this.identity=e||"unknown",this.isSpy=!0,this.plan=function(){},this.mostRecentCall={},this.argsForCall=[],this.calls=[]},jasmine.Spy.prototype.andCallThrough=function(){return this.plan=this.originalValue,this},jasmine.Spy.prototype.andReturn=function(e){return this.plan=function(){return e},this},jasmine.Spy.prototype.andThrow=function(e){return this.plan=function(){throw e},this},jasmine.Spy.prototype.andCallFake=function(e){return this.plan=e,this},jasmine.Spy.prototype.reset=function(){this.wasCalled=!1,this.callCount=0,this.argsForCall=[],this.calls=[],this.mostRecentCall={}},jasmine.createSpy=function(e){var t=function(){t.wasCalled=!0,t.callCount++;var e=jasmine.util.argsToArray(arguments);return t.mostRecentCall.object=this,t.mostRecentCall.args=e,t.argsForCall.push(e),t.calls.push({object:this,args:e}),t.plan.apply(this,arguments)},n=new jasmine.Spy(e);for(var i in n)t[i]=n[i];return t.reset(),t},jasmine.isSpy=function(e){return e&&e.isSpy},jasmine.createSpyObj=function(e,t){if(!jasmine.isArray_(t)||0===t.length)throw new Error("createSpyObj requires a non-empty array of method names to create spies for");for(var n={},i=0;i<t.length;i++)n[t[i]]=jasmine.createSpy(e+"."+t[i]);return n},jasmine.log=function(){var e=jasmine.getEnv().currentSpec;e.log.apply(e,arguments)};var spyOn=function(e,t){return jasmine.getEnv().currentSpec.spyOn(e,t)};isCommonJS&&(exports.spyOn=spyOn);var it=function(e,t){return jasmine.getEnv().it(e,t)};isCommonJS&&(exports.it=it);var xit=function(e,t){return jasmine.getEnv().xit(e,t)};isCommonJS&&(exports.xit=xit);var expect=function(e){return jasmine.getEnv().currentSpec.expect(e)};isCommonJS&&(exports.expect=expect);var runs=function(e){jasmine.getEnv().currentSpec.runs(e)};isCommonJS&&(exports.runs=runs);var waits=function(e){jasmine.getEnv().currentSpec.waits(e)};isCommonJS&&(exports.waits=waits);var waitsFor=function(e,t,n){jasmine.getEnv().currentSpec.waitsFor.apply(jasmine.getEnv().currentSpec,arguments)};isCommonJS&&(exports.waitsFor=waitsFor);var beforeEach=function(e){jasmine.getEnv().beforeEach(e)};isCommonJS&&(exports.beforeEach=beforeEach);var afterEach=function(e){jasmine.getEnv().afterEach(e)};isCommonJS&&(exports.afterEach=afterEach);var describe=function(e,t){return jasmine.getEnv().describe(e,t)};isCommonJS&&(exports.describe=describe);var xdescribe=function(e,t){return jasmine.getEnv().xdescribe(e,t)};isCommonJS&&(exports.xdescribe=xdescribe),jasmine.XmlHttpRequest="undefined"==typeof XMLHttpRequest?function(){function e(e){try{return e()}catch(t){}return null}var t=e(function(){return new ActiveXObject("Msxml2.XMLHTTP.6.0")})||e(function(){return new ActiveXObject("Msxml2.XMLHTTP.3.0")})||e(function(){return new ActiveXObject("Msxml2.XMLHTTP")})||e(function(){return new ActiveXObject("Microsoft.XMLHTTP")});if(!t)throw new Error("This browser does not support XMLHttpRequest.");return t}:XMLHttpRequest,jasmine.util={},jasmine.util.inherit=function(e,t){var n=function(){};n.prototype=t.prototype,e.prototype=new n},jasmine.util.formatException=function(e){var t;e.line?t=e.line:e.lineNumber&&(t=e.lineNumber);var n;e.sourceURL?n=e.sourceURL:e.fileName&&(n=e.fileName);var i=e.name&&e.message?e.name+": "+e.message:e.toString();return n&&t&&(i+=" in "+n+" (line "+t+")"),i},jasmine.util.htmlEscape=function(e){return e?e.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;"):e},jasmine.util.argsToArray=function(e){for(var t=[],n=0;n<e.length;n++)t.push(e[n]);return t},jasmine.util.extend=function(e,t){for(var n in t)e[n]=t[n];return e},jasmine.Env=function(){this.currentSpec=null,this.currentSuite=null,this.currentRunner_=new jasmine.Runner(this),this.reporter=new jasmine.MultiReporter,this.updateInterval=jasmine.DEFAULT_UPDATE_INTERVAL,this.defaultTimeoutInterval=jasmine.DEFAULT_TIMEOUT_INTERVAL,this.lastUpdate=0,this.specFilter=function(){return!0},this.nextSpecId_=0,this.nextSuiteId_=0,this.equalityTesters_=[],this.matchersClass=function(){jasmine.Matchers.apply(this,arguments)},jasmine.util.inherit(this.matchersClass,jasmine.Matchers),jasmine.Matchers.wrapInto_(jasmine.Matchers.prototype,this.matchersClass)},jasmine.Env.prototype.setTimeout=jasmine.setTimeout,jasmine.Env.prototype.clearTimeout=jasmine.clearTimeout,jasmine.Env.prototype.setInterval=jasmine.setInterval,jasmine.Env.prototype.clearInterval=jasmine.clearInterval,jasmine.Env.prototype.version=function(){if(jasmine.version_)return jasmine.version_;throw new Error("Version not set")},jasmine.Env.prototype.versionString=function(){if(!jasmine.version_)return"version unknown";var e=this.version(),t=e.major+"."+e.minor+"."+e.build;return e.release_candidate&&(t+=".rc"+e.release_candidate),t+=" revision "+e.revision},jasmine.Env.prototype.nextSpecId=function(){return this.nextSpecId_++},jasmine.Env.prototype.nextSuiteId=function(){return this.nextSuiteId_++},jasmine.Env.prototype.addReporter=function(e){this.reporter.addReporter(e)},jasmine.Env.prototype.execute=function(){this.currentRunner_.execute()},jasmine.Env.prototype.describe=function(e,t){var n=new jasmine.Suite(this,e,t,this.currentSuite),i=this.currentSuite;i?i.add(n):this.currentRunner_.add(n),this.currentSuite=n;var s=null;try{t.call(n)}catch(r){s=r}return s&&this.it("encountered a declaration exception",function(){throw s}),this.currentSuite=i,n},jasmine.Env.prototype.beforeEach=function(e){this.currentSuite?this.currentSuite.beforeEach(e):this.currentRunner_.beforeEach(e)},jasmine.Env.prototype.currentRunner=function(){return this.currentRunner_},jasmine.Env.prototype.afterEach=function(e){this.currentSuite?this.currentSuite.afterEach(e):this.currentRunner_.afterEach(e)},jasmine.Env.prototype.xdescribe=function(e,t){return{execute:function(){}}},jasmine.Env.prototype.it=function(e,t){var n=new jasmine.Spec(this,this.currentSuite,e);return this.currentSuite.add(n),this.currentSpec=n,t&&n.runs(t),n},jasmine.Env.prototype.xit=function(e,t){return{id:this.nextSpecId(),runs:function(){}}},jasmine.Env.prototype.compareObjects_=function(e,t,n,i){if(e.__Jasmine_been_here_before__===t&&t.__Jasmine_been_here_before__===e)return!0;e.__Jasmine_been_here_before__=t,t.__Jasmine_been_here_before__=e;var s=function(e,t){return null!==e&&e[t]!==jasmine.undefined};for(var r in t)!s(e,r)&&s(t,r)&&n.push("expected has key '"+r+"', but missing from actual.");for(r in e)!s(t,r)&&s(e,r)&&n.push("expected missing key '"+r+"', but present in actual.");for(r in t)"__Jasmine_been_here_before__"!=r&&(this.equals_(e[r],t[r],n,i)||i.push("'"+r+"' was '"+(t[r]?jasmine.util.htmlEscape(t[r].toString()):t[r])+"' in expected, but was '"+(e[r]?jasmine.util.htmlEscape(e[r].toString()):e[r])+"' in actual."));return jasmine.isArray_(e)&&jasmine.isArray_(t)&&e.length!=t.length&&i.push("arrays were not the same length"),delete e.__Jasmine_been_here_before__,delete t.__Jasmine_been_here_before__,0===n.length&&0===i.length},jasmine.Env.prototype.equals_=function(e,t,n,i){n=n||[],i=i||[];for(var s=0;s<this.equalityTesters_.length;s++){var r=this.equalityTesters_[s],a=r(e,t,this,n,i);if(a!==jasmine.undefined)return a}return e===t?!0:e===jasmine.undefined||null===e||t===jasmine.undefined||null===t?e==jasmine.undefined&&t==jasmine.undefined:jasmine.isDomNode(e)&&jasmine.isDomNode(t)?e===t:e instanceof Date&&t instanceof Date?e.getTime()==t.getTime():e.jasmineMatches?e.jasmineMatches(t):t.jasmineMatches?t.jasmineMatches(e):e instanceof jasmine.Matchers.ObjectContaining?e.matches(t):t instanceof jasmine.Matchers.ObjectContaining?t.matches(e):jasmine.isString_(e)&&jasmine.isString_(t)?e==t:jasmine.isNumber_(e)&&jasmine.isNumber_(t)?e==t:"object"==typeof e&&"object"==typeof t?this.compareObjects_(e,t,n,i):e===t},jasmine.Env.prototype.contains_=function(e,t){if(jasmine.isArray_(e)){for(var n=0;n<e.length;n++)if(this.equals_(e[n],t))return!0;return!1}return e.indexOf(t)>=0},jasmine.Env.prototype.addEqualityTester=function(e){this.equalityTesters_.push(e)},jasmine.Reporter=function(){},jasmine.Reporter.prototype.reportRunnerStarting=function(e){},jasmine.Reporter.prototype.reportRunnerResults=function(e){},jasmine.Reporter.prototype.reportSuiteResults=function(e){},jasmine.Reporter.prototype.reportSpecStarting=function(e){},jasmine.Reporter.prototype.reportSpecResults=function(e){},jasmine.Reporter.prototype.log=function(e){},jasmine.Block=function(e,t,n){this.env=e,this.func=t,this.spec=n},jasmine.Block.prototype.execute=function(e){try{this.func.apply(this.spec)}catch(t){this.spec.fail(t)}e()},jasmine.JsApiReporter=function(){this.started=!1,this.finished=!1,this.suites_=[],this.results_={}},jasmine.JsApiReporter.prototype.reportRunnerStarting=function(e){this.started=!0;for(var t=e.topLevelSuites(),n=0;n<t.length;n++){var i=t[n];this.suites_.push(this.summarize_(i))}},jasmine.JsApiReporter.prototype.suites=function(){return this.suites_},jasmine.JsApiReporter.prototype.summarize_=function(e){var t=e instanceof jasmine.Suite,n={id:e.id,name:e.description,type:t?"suite":"spec",children:[]};if(t)for(var i=e.children(),s=0;s<i.length;s++)n.children.push(this.summarize_(i[s]));return n},jasmine.JsApiReporter.prototype.results=function(){return this.results_},jasmine.JsApiReporter.prototype.resultsForSpec=function(e){return this.results_[e]},jasmine.JsApiReporter.prototype.reportRunnerResults=function(e){this.finished=!0},jasmine.JsApiReporter.prototype.reportSuiteResults=function(e){},jasmine.JsApiReporter.prototype.reportSpecResults=function(e){this.results_[e.id]={messages:e.results().getItems(),result:e.results().failedCount>0?"failed":"passed"}},jasmine.JsApiReporter.prototype.log=function(e){},jasmine.JsApiReporter.prototype.resultsForSpecs=function(e){for(var t={},n=0;n<e.length;n++){var i=e[n];t[i]=this.summarizeResult_(this.results_[i])}return t},jasmine.JsApiReporter.prototype.summarizeResult_=function(e){for(var t=[],n=e.messages.length,i=0;n>i;i++){var s=e.messages[i];t.push({text:"log"==s.type?s.toString():jasmine.undefined,passed:s.passed?s.passed():!0,type:s.type,message:s.message,trace:{stack:s.passed&&!s.passed()?s.trace.stack:jasmine.undefined}})}return{result:e.result,messages:t}},jasmine.Matchers=function(e,t,n,i){this.env=e,this.actual=t,this.spec=n,this.isNot=i||!1,this.reportWasCalled_=!1},jasmine.Matchers.pp=function(e){throw new Error("jasmine.Matchers.pp() is no longer supported, please use jasmine.pp() instead!")},jasmine.Matchers.prototype.report=function(e,t,n){throw new Error("As of jasmine 0.11, custom matchers must be implemented differently -- please see jasmine docs")},jasmine.Matchers.wrapInto_=function(e,t){for(var n in e)if("report"!=n){var i=e[n];t.prototype[n]=jasmine.Matchers.matcherFn_(n,i)}},jasmine.Matchers.matcherFn_=function(e,t){return function(){var n=jasmine.util.argsToArray(arguments),i=t.apply(this,arguments);if(this.isNot&&(i=!i),this.reportWasCalled_)return i;var s;if(!i)if(this.message)s=this.message.apply(this,arguments),jasmine.isArray_(s)&&(s=s[this.isNot?1:0]);else{var r=e.replace(/[A-Z]/g,function(e){return" "+e.toLowerCase()});if(s="Expected "+jasmine.pp(this.actual)+(this.isNot?" not ":" ")+r,n.length>0)for(var a=0;a<n.length;a++)a>0&&(s+=","),s+=" "+jasmine.pp(n[a]);s+="."}var o=new jasmine.ExpectationResult({matcherName:e,passed:i,expected:n.length>1?n:n[0],actual:this.actual,message:s});return this.spec.addMatcherResult(o),jasmine.undefined}},jasmine.Matchers.prototype.toBe=function(e){return this.actual===e},jasmine.Matchers.prototype.toNotBe=function(e){return this.actual!==e},jasmine.Matchers.prototype.toEqual=function(e){return this.env.equals_(this.actual,e)},jasmine.Matchers.prototype.toNotEqual=function(e){return!this.env.equals_(this.actual,e)},jasmine.Matchers.prototype.toMatch=function(e){return new RegExp(e).test(this.actual)},jasmine.Matchers.prototype.toNotMatch=function(e){return!new RegExp(e).test(this.actual)},jasmine.Matchers.prototype.toBeDefined=function(){return this.actual!==jasmine.undefined},jasmine.Matchers.prototype.toBeUndefined=function(){return this.actual===jasmine.undefined},jasmine.Matchers.prototype.toBeNull=function(){return null===this.actual},jasmine.Matchers.prototype.toBeTruthy=function(){return!!this.actual},jasmine.Matchers.prototype.toBeFalsy=function(){return!this.actual},jasmine.Matchers.prototype.toHaveBeenCalled=function(){if(arguments.length>0)throw new Error("toHaveBeenCalled does not take arguments, use toHaveBeenCalledWith");if(!jasmine.isSpy(this.actual))throw new Error("Expected a spy, but got "+jasmine.pp(this.actual)+".");return this.message=function(){return["Expected spy "+this.actual.identity+" to have been called.","Expected spy "+this.actual.identity+" not to have been called."]},this.actual.wasCalled},jasmine.Matchers.prototype.wasCalled=jasmine.Matchers.prototype.toHaveBeenCalled,jasmine.Matchers.prototype.wasNotCalled=function(){if(arguments.length>0)throw new Error("wasNotCalled does not take arguments");if(!jasmine.isSpy(this.actual))throw new Error("Expected a spy, but got "+jasmine.pp(this.actual)+".");return this.message=function(){return["Expected spy "+this.actual.identity+" to not have been called.","Expected spy "+this.actual.identity+" to have been called."]},!this.actual.wasCalled},jasmine.Matchers.prototype.toHaveBeenCalledWith=function(){var e=jasmine.util.argsToArray(arguments);if(!jasmine.isSpy(this.actual))throw new Error("Expected a spy, but got "+jasmine.pp(this.actual)+".");return this.message=function(){return 0===this.actual.callCount?["Expected spy "+this.actual.identity+" to have been called with "+jasmine.pp(e)+" but it was never called.","Expected spy "+this.actual.identity+" not to have been called with "+jasmine.pp(e)+" but it was."]:["Expected spy "+this.actual.identity+" to have been called with "+jasmine.pp(e)+" but was called with "+jasmine.pp(this.actual.argsForCall),"Expected spy "+this.actual.identity+" not to have been called with "+jasmine.pp(e)+" but was called with "+jasmine.pp(this.actual.argsForCall)]},this.env.contains_(this.actual.argsForCall,e)},jasmine.Matchers.prototype.wasCalledWith=jasmine.Matchers.prototype.toHaveBeenCalledWith,jasmine.Matchers.prototype.wasNotCalledWith=function(){var e=jasmine.util.argsToArray(arguments);if(!jasmine.isSpy(this.actual))throw new Error("Expected a spy, but got "+jasmine.pp(this.actual)+".");return this.message=function(){return["Expected spy not to have been called with "+jasmine.pp(e)+" but it was","Expected spy to have been called with "+jasmine.pp(e)+" but it was"]},!this.env.contains_(this.actual.argsForCall,e)},jasmine.Matchers.prototype.toContain=function(e){return this.env.contains_(this.actual,e)},jasmine.Matchers.prototype.toNotContain=function(e){return!this.env.contains_(this.actual,e)},jasmine.Matchers.prototype.toBeLessThan=function(e){return this.actual<e},jasmine.Matchers.prototype.toBeGreaterThan=function(e){return this.actual>e},jasmine.Matchers.prototype.toBeCloseTo=function(e,t){0!==t&&(t=t||2);var n=Math.pow(10,t),i=Math.round(this.actual*n);return e=Math.round(e*n),e==i},jasmine.Matchers.prototype.toThrow=function(e){var t,n=!1;if("function"!=typeof this.actual)throw new Error("Actual is not a function");try{this.actual()}catch(i){t=i}t&&(n=e===jasmine.undefined||this.env.equals_(t.message||t,e.message||e));var s=this.isNot?"not ":"";return this.message=function(){return!t||e!==jasmine.undefined&&this.env.equals_(t.message||t,e.message||e)?"Expected function to throw an exception.":["Expected function "+s+"to throw",e?e.message||e:"an exception",", but it threw",t.message||t].join(" ")},n},jasmine.Matchers.Any=function(e){this.expectedClass=e},jasmine.Matchers.Any.prototype.jasmineMatches=function(e){return this.expectedClass==String?"string"==typeof e||e instanceof String:this.expectedClass==Number?"number"==typeof e||e instanceof Number:this.expectedClass==Function?"function"==typeof e||e instanceof Function:this.expectedClass==Object?"object"==typeof e:e instanceof this.expectedClass},jasmine.Matchers.Any.prototype.jasmineToString=function(){return"<jasmine.any("+this.expectedClass+")>"},jasmine.Matchers.ObjectContaining=function(e){this.sample=e},jasmine.Matchers.ObjectContaining.prototype.jasmineMatches=function(e,t,n){t=t||[],n=n||[];var i=jasmine.getEnv(),s=function(e,t){return null!=e&&e[t]!==jasmine.undefined};for(var r in this.sample)!s(e,r)&&s(this.sample,r)?t.push("expected has key '"+r+"', but missing from actual."):i.equals_(this.sample[r],e[r],t,n)||n.push("'"+r+"' was '"+(e[r]?jasmine.util.htmlEscape(e[r].toString()):e[r])+"' in expected, but was '"+(this.sample[r]?jasmine.util.htmlEscape(this.sample[r].toString()):this.sample[r])+"' in actual.");return 0===t.length&&0===n.length},jasmine.Matchers.ObjectContaining.prototype.jasmineToString=function(){return"<jasmine.objectContaining("+jasmine.pp(this.sample)+")>"},jasmine.FakeTimer=function(){this.reset();var e=this;e.setTimeout=function(t,n){return e.timeoutsMade++,e.scheduleFunction(e.timeoutsMade,t,n,!1),e.timeoutsMade},e.setInterval=function(t,n){return e.timeoutsMade++,e.scheduleFunction(e.timeoutsMade,t,n,!0),e.timeoutsMade},e.clearTimeout=function(t){e.scheduledFunctions[t]=jasmine.undefined},e.clearInterval=function(t){e.scheduledFunctions[t]=jasmine.undefined}},jasmine.FakeTimer.prototype.reset=function(){this.timeoutsMade=0,this.scheduledFunctions={},this.nowMillis=0},jasmine.FakeTimer.prototype.tick=function(e){var t=this.nowMillis,n=t+e;this.runFunctionsWithinRange(t,n),this.nowMillis=n},jasmine.FakeTimer.prototype.runFunctionsWithinRange=function(e,t){var n,i=[];for(var s in this.scheduledFunctions)n=this.scheduledFunctions[s],n!=jasmine.undefined&&n.runAtMillis>=e&&n.runAtMillis<=t&&(i.push(n),this.scheduledFunctions[s]=jasmine.undefined);if(i.length>0){i.sort(function(e,t){return e.runAtMillis-t.runAtMillis});for(var r=0;r<i.length;++r)try{var a=i[r];this.nowMillis=a.runAtMillis,a.funcToCall(),a.recurring&&this.scheduleFunction(a.timeoutKey,a.funcToCall,a.millis,!0)}catch(o){}this.runFunctionsWithinRange(e,t)}},jasmine.FakeTimer.prototype.scheduleFunction=function(e,t,n,i){this.scheduledFunctions[e]={runAtMillis:this.nowMillis+n,funcToCall:t,recurring:i,timeoutKey:e,millis:n}},jasmine.Clock={defaultFakeTimer:new jasmine.FakeTimer,reset:function(){jasmine.Clock.assertInstalled(),jasmine.Clock.defaultFakeTimer.reset()},tick:function(e){jasmine.Clock.assertInstalled(),jasmine.Clock.defaultFakeTimer.tick(e)},runFunctionsWithinRange:function(e,t){jasmine.Clock.defaultFakeTimer.runFunctionsWithinRange(e,t)},scheduleFunction:function(e,t,n,i){jasmine.Clock.defaultFakeTimer.scheduleFunction(e,t,n,i)},useMock:function(){if(!jasmine.Clock.isInstalled()){var e=jasmine.getEnv().currentSpec;e.after(jasmine.Clock.uninstallMock),jasmine.Clock.installMock()}},installMock:function(){jasmine.Clock.installed=jasmine.Clock.defaultFakeTimer},uninstallMock:function(){jasmine.Clock.assertInstalled(),jasmine.Clock.installed=jasmine.Clock.real},real:{setTimeout:jasmine.getGlobal().setTimeout,clearTimeout:jasmine.getGlobal().clearTimeout,setInterval:jasmine.getGlobal().setInterval,clearInterval:jasmine.getGlobal().clearInterval},assertInstalled:function(){if(!jasmine.Clock.isInstalled())throw new Error("Mock clock is not installed, use jasmine.Clock.useMock()")},isInstalled:function(){return jasmine.Clock.installed==jasmine.Clock.defaultFakeTimer},installed:null},jasmine.Clock.installed=jasmine.Clock.real,jasmine.getGlobal().setTimeout=function(e,t){return jasmine.Clock.installed.setTimeout.apply?jasmine.Clock.installed.setTimeout.apply(this,arguments):jasmine.Clock.installed.setTimeout(e,t)},jasmine.getGlobal().setInterval=function(e,t){return jasmine.Clock.installed.setInterval.apply?jasmine.Clock.installed.setInterval.apply(this,arguments):jasmine.Clock.installed.setInterval(e,t)},jasmine.getGlobal().clearTimeout=function(e){return jasmine.Clock.installed.clearTimeout.apply?jasmine.Clock.installed.clearTimeout.apply(this,arguments):jasmine.Clock.installed.clearTimeout(e)},jasmine.getGlobal().clearInterval=function(e){return jasmine.Clock.installed.clearTimeout.apply?jasmine.Clock.installed.clearInterval.apply(this,arguments):jasmine.Clock.installed.clearInterval(e)},jasmine.MultiReporter=function(){this.subReporters_=[]},jasmine.util.inherit(jasmine.MultiReporter,jasmine.Reporter),jasmine.MultiReporter.prototype.addReporter=function(e){this.subReporters_.push(e)},function(){for(var e=["reportRunnerStarting","reportRunnerResults","reportSuiteResults","reportSpecStarting","reportSpecResults","log"],t=0;t<e.length;t++){var n=e[t];jasmine.MultiReporter.prototype[n]=function(e){return function(){for(var t=0;t<this.subReporters_.length;t++){var n=this.subReporters_[t];n[e]&&n[e].apply(n,arguments)}}}(n)}}(),jasmine.NestedResults=function(){this.totalCount=0,this.passedCount=0,this.failedCount=0,this.skipped=!1,this.items_=[]},jasmine.NestedResults.prototype.rollupCounts=function(e){this.totalCount+=e.totalCount,this.passedCount+=e.passedCount,this.failedCount+=e.failedCount},jasmine.NestedResults.prototype.log=function(e){this.items_.push(new jasmine.MessageResult(e))},jasmine.NestedResults.prototype.getItems=function(){return this.items_},jasmine.NestedResults.prototype.addResult=function(e){"log"!=e.type&&(e.items_?this.rollupCounts(e):(this.totalCount++,e.passed()?this.passedCount++:this.failedCount++)),this.items_.push(e)},jasmine.NestedResults.prototype.passed=function(){return this.passedCount===this.totalCount},jasmine.PrettyPrinter=function(){this.ppNestLevel_=0},jasmine.PrettyPrinter.prototype.format=function(e){if(this.ppNestLevel_>40)throw new Error("jasmine.PrettyPrinter: format() nested too deeply!");this.ppNestLevel_++;try{e===jasmine.undefined?this.emitScalar("undefined"):null===e?this.emitScalar("null"):e===jasmine.getGlobal()?this.emitScalar("<global>"):e.jasmineToString?this.emitScalar(e.jasmineToString()):"string"==typeof e?this.emitString(e):jasmine.isSpy(e)?this.emitScalar("spy on "+e.identity):e instanceof RegExp?this.emitScalar(e.toString()):"function"==typeof e?this.emitScalar("Function"):"number"==typeof e.nodeType?this.emitScalar("HTMLNode"):e instanceof Date?this.emitScalar("Date("+e+")"):e.__Jasmine_been_here_before__?this.emitScalar("<circular reference: "+(jasmine.isArray_(e)?"Array":"Object")+">"):jasmine.isArray_(e)||"object"==typeof e?(e.__Jasmine_been_here_before__=!0,jasmine.isArray_(e)?this.emitArray(e):this.emitObject(e),delete e.__Jasmine_been_here_before__):this.emitScalar(e.toString())}finally{this.ppNestLevel_--}},jasmine.PrettyPrinter.prototype.iterateObject=function(e,t){for(var n in e)"__Jasmine_been_here_before__"!=n&&t(n,e.__lookupGetter__?e.__lookupGetter__(n)!==jasmine.undefined&&null!==e.__lookupGetter__(n):!1)},jasmine.PrettyPrinter.prototype.emitArray=jasmine.unimplementedMethod_,jasmine.PrettyPrinter.prototype.emitObject=jasmine.unimplementedMethod_,jasmine.PrettyPrinter.prototype.emitScalar=jasmine.unimplementedMethod_,jasmine.PrettyPrinter.prototype.emitString=jasmine.unimplementedMethod_,jasmine.StringPrettyPrinter=function(){jasmine.PrettyPrinter.call(this),this.string=""},jasmine.util.inherit(jasmine.StringPrettyPrinter,jasmine.PrettyPrinter),jasmine.StringPrettyPrinter.prototype.emitScalar=function(e){this.append(e)},jasmine.StringPrettyPrinter.prototype.emitString=function(e){this.append("'"+e+"'")},jasmine.StringPrettyPrinter.prototype.emitArray=function(e){this.append("[ ");for(var t=0;t<e.length;t++)t>0&&this.append(", "),this.format(e[t]);this.append(" ]")},jasmine.StringPrettyPrinter.prototype.emitObject=function(e){var t=this;this.append("{ ");var n=!0;this.iterateObject(e,function(i,s){n?n=!1:t.append(", "),t.append(i),t.append(" : "),s?t.append("<getter>"):t.format(e[i])}),this.append(" }")},jasmine.StringPrettyPrinter.prototype.append=function(e){this.string+=e},jasmine.Queue=function(e){this.env=e,this.blocks=[],this.running=!1,this.index=0,this.offset=0,this.abort=!1},jasmine.Queue.prototype.addBefore=function(e){this.blocks.unshift(e)},jasmine.Queue.prototype.add=function(e){this.blocks.push(e)},jasmine.Queue.prototype.insertNext=function(e){this.blocks.splice(this.index+this.offset+1,0,e),this.offset++},jasmine.Queue.prototype.start=function(e){this.running=!0,this.onComplete=e,this.next_()},jasmine.Queue.prototype.isRunning=function(){return this.running},jasmine.Queue.LOOP_DONT_RECURSE=!0,jasmine.Queue.prototype.next_=function(){for(var e=this,t=!0;t;)if(t=!1,e.index<e.blocks.length&&!this.abort){var n=!0,i=!1,s=function(){if(jasmine.Queue.LOOP_DONT_RECURSE&&n)return void(i=!0);e.blocks[e.index].abort&&(e.abort=!0),e.offset=0,e.index++;var s=(new Date).getTime();e.env.updateInterval&&s-e.env.lastUpdate>e.env.updateInterval?(e.env.lastUpdate=s,e.env.setTimeout(function(){e.next_()},0)):jasmine.Queue.LOOP_DONT_RECURSE&&i?t=!0:e.next_()};e.blocks[e.index].execute(s),n=!1,i&&s()}else e.running=!1,e.onComplete&&e.onComplete()},jasmine.Queue.prototype.results=function(){for(var e=new jasmine.NestedResults,t=0;t<this.blocks.length;t++)this.blocks[t].results&&e.addResult(this.blocks[t].results());return e},jasmine.Runner=function(e){var t=this;t.env=e,t.queue=new jasmine.Queue(e),t.before_=[],t.after_=[],t.suites_=[]},jasmine.Runner.prototype.execute=function(){var e=this;e.env.reporter.reportRunnerStarting&&e.env.reporter.reportRunnerStarting(this),e.queue.start(function(){e.finishCallback()})},jasmine.Runner.prototype.beforeEach=function(e){e.typeName="beforeEach",this.before_.splice(0,0,e)},jasmine.Runner.prototype.afterEach=function(e){e.typeName="afterEach",this.after_.splice(0,0,e)},jasmine.Runner.prototype.finishCallback=function(){this.env.reporter.reportRunnerResults(this)},jasmine.Runner.prototype.addSuite=function(e){this.suites_.push(e)},jasmine.Runner.prototype.add=function(e){e instanceof jasmine.Suite&&this.addSuite(e),this.queue.add(e)},jasmine.Runner.prototype.specs=function(){for(var e=this.suites(),t=[],n=0;n<e.length;n++)t=t.concat(e[n].specs());return t},jasmine.Runner.prototype.suites=function(){return this.suites_},jasmine.Runner.prototype.topLevelSuites=function(){for(var e=[],t=0;t<this.suites_.length;t++)this.suites_[t].parentSuite||e.push(this.suites_[t]);return e},jasmine.Runner.prototype.results=function(){return this.queue.results()},jasmine.Spec=function(e,t,n){if(!e)throw new Error("jasmine.Env() required");if(!t)throw new Error("jasmine.Suite() required");var i=this;i.id=e.nextSpecId?e.nextSpecId():null,i.env=e,i.suite=t,i.description=n,i.queue=new jasmine.Queue(e),i.afterCallbacks=[],i.spies_=[],i.results_=new jasmine.NestedResults,i.results_.description=n,i.matchersClass=null},jasmine.Spec.prototype.getFullName=function(){return this.suite.getFullName()+" "+this.description+"."},jasmine.Spec.prototype.results=function(){return this.results_},jasmine.Spec.prototype.log=function(){return this.results_.log(arguments)},jasmine.Spec.prototype.runs=function(e){var t=new jasmine.Block(this.env,e,this);return this.addToQueue(t),this},jasmine.Spec.prototype.addToQueue=function(e){this.queue.isRunning()?this.queue.insertNext(e):this.queue.add(e)},jasmine.Spec.prototype.addMatcherResult=function(e){this.results_.addResult(e)},jasmine.Spec.prototype.expect=function(e){var t=new(this.getMatchersClass_())(this.env,e,this);return t.not=new(this.getMatchersClass_())(this.env,e,this,!0),t},jasmine.Spec.prototype.waits=function(e){var t=new jasmine.WaitsBlock(this.env,e,this);return this.addToQueue(t),this},jasmine.Spec.prototype.waitsFor=function(e,t,n){for(var i=null,s=null,r=null,a=0;a<arguments.length;a++){var o=arguments[a];switch(typeof o){case"function":i=o;break;case"string":s=o;break;case"number":r=o}}var u=new jasmine.WaitsForBlock(this.env,r,i,s,this);return this.addToQueue(u),this},jasmine.Spec.prototype.fail=function(e){var t=new jasmine.ExpectationResult({passed:!1,message:e?jasmine.util.formatException(e):"Exception",trace:{stack:e.stack}});this.results_.addResult(t)},jasmine.Spec.prototype.getMatchersClass_=function(){return this.matchersClass||this.env.matchersClass},jasmine.Spec.prototype.addMatchers=function(e){var t=this.getMatchersClass_(),n=function(){t.apply(this,arguments)};jasmine.util.inherit(n,t),jasmine.Matchers.wrapInto_(e,n),this.matchersClass=n},jasmine.Spec.prototype.finishCallback=function(){this.env.reporter.reportSpecResults(this)},jasmine.Spec.prototype.finish=function(e){this.removeAllSpies(),this.finishCallback(),e&&e()},jasmine.Spec.prototype.after=function(e){this.queue.isRunning()?this.queue.add(new jasmine.Block(this.env,e,this)):this.afterCallbacks.unshift(e)},jasmine.Spec.prototype.execute=function(e){var t=this;return t.env.specFilter(t)?(this.env.reporter.reportSpecStarting(this),t.env.currentSpec=t,t.addBeforesAndAftersToQueue(),void t.queue.start(function(){t.finish(e)})):(t.results_.skipped=!0,void t.finish(e))},jasmine.Spec.prototype.addBeforesAndAftersToQueue=function(){for(var e,t=this.env.currentRunner(),n=this.suite;n;n=n.parentSuite)for(e=0;e<n.before_.length;e++)this.queue.addBefore(new jasmine.Block(this.env,n.before_[e],this));for(e=0;e<t.before_.length;e++)this.queue.addBefore(new jasmine.Block(this.env,t.before_[e],this));for(e=0;e<this.afterCallbacks.length;e++)this.queue.add(new jasmine.Block(this.env,this.afterCallbacks[e],this));for(n=this.suite;n;n=n.parentSuite)for(e=0;e<n.after_.length;e++)this.queue.add(new jasmine.Block(this.env,n.after_[e],this));for(e=0;e<t.after_.length;e++)this.queue.add(new jasmine.Block(this.env,t.after_[e],this))},jasmine.Spec.prototype.explodes=function(){throw"explodes function should not have been called"},jasmine.Spec.prototype.spyOn=function(e,t,n){if(e==jasmine.undefined)throw"spyOn could not find an object to spy upon for "+t+"()";if(!n&&e[t]===jasmine.undefined)throw t+"() method does not exist";if(!n&&e[t]&&e[t].isSpy)throw new Error(t+" has already been spied upon");
var i=jasmine.createSpy(t);return this.spies_.push(i),i.baseObj=e,i.methodName=t,i.originalValue=e[t],e[t]=i,i},jasmine.Spec.prototype.removeAllSpies=function(){for(var e=0;e<this.spies_.length;e++){var t=this.spies_[e];t.baseObj[t.methodName]=t.originalValue}this.spies_=[]},jasmine.Suite=function(e,t,n,i){var s=this;s.id=e.nextSuiteId?e.nextSuiteId():null,s.description=t,s.queue=new jasmine.Queue(e),s.parentSuite=i,s.env=e,s.before_=[],s.after_=[],s.children_=[],s.suites_=[],s.specs_=[]},jasmine.Suite.prototype.getFullName=function(){for(var e=this.description,t=this.parentSuite;t;t=t.parentSuite)e=t.description+" "+e;return e},jasmine.Suite.prototype.finish=function(e){this.env.reporter.reportSuiteResults(this),this.finished=!0,"function"==typeof e&&e()},jasmine.Suite.prototype.beforeEach=function(e){e.typeName="beforeEach",this.before_.unshift(e)},jasmine.Suite.prototype.afterEach=function(e){e.typeName="afterEach",this.after_.unshift(e)},jasmine.Suite.prototype.results=function(){return this.queue.results()},jasmine.Suite.prototype.add=function(e){this.children_.push(e),e instanceof jasmine.Suite?(this.suites_.push(e),this.env.currentRunner().addSuite(e)):this.specs_.push(e),this.queue.add(e)},jasmine.Suite.prototype.specs=function(){return this.specs_},jasmine.Suite.prototype.suites=function(){return this.suites_},jasmine.Suite.prototype.children=function(){return this.children_},jasmine.Suite.prototype.execute=function(e){var t=this;this.queue.start(function(){t.finish(e)})},jasmine.WaitsBlock=function(e,t,n){this.timeout=t,jasmine.Block.call(this,e,null,n)},jasmine.util.inherit(jasmine.WaitsBlock,jasmine.Block),jasmine.WaitsBlock.prototype.execute=function(e){jasmine.VERBOSE&&this.env.reporter.log(">> Jasmine waiting for "+this.timeout+" ms..."),this.env.setTimeout(function(){e()},this.timeout)},jasmine.WaitsForBlock=function(e,t,n,i,s){this.timeout=t||e.defaultTimeoutInterval,this.latchFunction=n,this.message=i,this.totalTimeSpentWaitingForLatch=0,jasmine.Block.call(this,e,null,s)},jasmine.util.inherit(jasmine.WaitsForBlock,jasmine.Block),jasmine.WaitsForBlock.TIMEOUT_INCREMENT=10,jasmine.WaitsForBlock.prototype.execute=function(e){jasmine.VERBOSE&&this.env.reporter.log(">> Jasmine waiting for "+(this.message||"something to happen"));var t;try{t=this.latchFunction.apply(this.spec)}catch(n){return this.spec.fail(n),void e()}if(t)e();else if(this.totalTimeSpentWaitingForLatch>=this.timeout){var i="timed out after "+this.timeout+" msec waiting for "+(this.message||"something to happen");this.spec.fail({name:"timeout",message:i}),this.abort=!0,e()}else{this.totalTimeSpentWaitingForLatch+=jasmine.WaitsForBlock.TIMEOUT_INCREMENT;var s=this;this.env.setTimeout(function(){s.execute(e)},jasmine.WaitsForBlock.TIMEOUT_INCREMENT)}},jasmine.version_={major:1,minor:2,build:0,revision:1337005947};
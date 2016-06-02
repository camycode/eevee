jasmine.HtmlReporterHelpers={},jasmine.HtmlReporterHelpers.createDom=function(e,t,s){for(var i=document.createElement(e),a=2;a<arguments.length;a++){var r=arguments[a];"string"==typeof r?i.appendChild(document.createTextNode(r)):r&&i.appendChild(r)}for(var n in t)"className"==n?i[n]=t[n]:i.setAttribute(n,t[n]);return i},jasmine.HtmlReporterHelpers.getSpecStatus=function(e){var t=e.results(),s=t.passed()?"passed":"failed";return t.skipped&&(s="skipped"),s},jasmine.HtmlReporterHelpers.appendToSummary=function(e,t){var s=this.dom.summary,i="undefined"==typeof e.parentSuite?"suite":"parentSuite",a=e[i];a&&("undefined"==typeof this.views.suites[a.id]&&(this.views.suites[a.id]=new jasmine.HtmlReporter.SuiteView(a,this.dom,this.views)),s=this.views.suites[a.id].element),s.appendChild(t)},jasmine.HtmlReporterHelpers.addHelpers=function(e){for(var t in jasmine.HtmlReporterHelpers)e.prototype[t]=jasmine.HtmlReporterHelpers[t]},jasmine.HtmlReporter=function(e){function t(){var e;return function(){if(!e){for(var t=[],s=r.location.search.substring(1).split("&"),i=0;i<s.length;i++){var a=s[i].split("=");t[decodeURIComponent(a[0])]=decodeURIComponent(a[1])}e=t.spec}}(),e}function s(e){n.reporter=a.createDom("div",{id:"HTMLReporter",className:"jasmine_reporter"},n.banner=a.createDom("div",{className:"banner"},a.createDom("span",{className:"title"},"Jasmine "),a.createDom("span",{className:"version"},e)),n.symbolSummary=a.createDom("ul",{className:"symbolSummary"}),n.alert=a.createDom("div",{className:"alert"}),n.results=a.createDom("div",{className:"results"},n.summary=a.createDom("div",{className:"summary"}),n.details=a.createDom("div",{id:"details"})))}var i,a=this,r=e||window.document,n={};return a.logRunningSpecs=!1,a.reportRunnerStarting=function(e){var t=e.specs()||[];0!=t.length&&(s(e.env.versionString()),r.body.appendChild(n.reporter),i=new jasmine.HtmlReporter.ReporterView(n),i.addSpecs(t,a.specFilter))},a.reportRunnerResults=function(e){i&&i.complete()},a.reportSuiteResults=function(e){i.suiteComplete(e)},a.reportSpecStarting=function(e){a.logRunningSpecs&&a.log(">> Jasmine Running "+e.suite.description+" "+e.description+"...")},a.reportSpecResults=function(e){i.specComplete(e)},a.log=function(){var e=jasmine.getGlobal().console;e&&e.log&&(e.log.apply?e.log.apply(e,arguments):e.log(arguments))},a.specFilter=function(e){return t()?0===e.getFullName().indexOf(t()):!0},a},jasmine.HtmlReporterHelpers.addHelpers(jasmine.HtmlReporter),jasmine.HtmlReporter.ReporterView=function(e){function t(){-1===e.reporter.className.search(/showDetails/)&&(e.reporter.className+=" showDetails")}function s(e){return"undefined"==typeof e}function i(e){return!s(e)}function a(e){var t=e+" spec";return e>1&&(t+="s"),t}return this.startedAt=new Date,this.runningSpecCount=0,this.completeSpecCount=0,this.passedCount=0,this.failedCount=0,this.skippedCount=0,this.createResultsMenu=function(){this.resultsMenu=this.createDom("span",{className:"resultsMenu bar"},this.summaryMenuItem=this.createDom("a",{className:"summaryMenuItem",href:"#"},"0 specs")," | ",this.detailsMenuItem=this.createDom("a",{className:"detailsMenuItem",href:"#"},"0 failing")),this.summaryMenuItem.onclick=function(){e.reporter.className=e.reporter.className.replace(/ showDetails/g,"")},this.detailsMenuItem.onclick=function(){t()}},this.addSpecs=function(t,s){this.totalSpecCount=t.length,this.views={specs:{},suites:{}};for(var i=0;i<t.length;i++){var a=t[i];this.views.specs[a.id]=new jasmine.HtmlReporter.SpecView(a,e,this.views),s(a)&&this.runningSpecCount++}},this.specComplete=function(t){this.completeSpecCount++,s(this.views.specs[t.id])&&(this.views.specs[t.id]=new jasmine.HtmlReporter.SpecView(t,e));var i=this.views.specs[t.id];switch(i.status()){case"passed":this.passedCount++;break;case"failed":this.failedCount++;break;case"skipped":this.skippedCount++}i.refresh(),this.refresh()},this.suiteComplete=function(e){var t=this.views.suites[e.id];s(t)||t.refresh()},this.refresh=function(){s(this.resultsMenu)&&this.createResultsMenu(),s(this.runningAlert)&&(this.runningAlert=this.createDom("a",{href:"?",className:"runningAlert bar"}),e.alert.appendChild(this.runningAlert)),this.runningAlert.innerHTML="Running "+this.completeSpecCount+" of "+a(this.totalSpecCount),s(this.skippedAlert)&&(this.skippedAlert=this.createDom("a",{href:"?",className:"skippedAlert bar"})),this.skippedAlert.innerHTML="Skipping "+this.skippedCount+" of "+a(this.totalSpecCount)+" - run all",1===this.skippedCount&&i(e.alert)&&e.alert.appendChild(this.skippedAlert),s(this.passedAlert)&&(this.passedAlert=this.createDom("span",{href:"?",className:"passingAlert bar"})),this.passedAlert.innerHTML="Passing "+a(this.passedCount),s(this.failedAlert)&&(this.failedAlert=this.createDom("span",{href:"?",className:"failingAlert bar"})),this.failedAlert.innerHTML="Failing "+a(this.failedCount),1===this.failedCount&&i(e.alert)&&(e.alert.appendChild(this.failedAlert),e.alert.appendChild(this.resultsMenu)),this.summaryMenuItem.innerHTML=""+a(this.runningSpecCount),this.detailsMenuItem.innerHTML=""+this.failedCount+" failing"},this.complete=function(){e.alert.removeChild(this.runningAlert),this.skippedAlert.innerHTML="Ran "+this.runningSpecCount+" of "+a(this.totalSpecCount)+" - run all",0===this.failedCount?e.alert.appendChild(this.createDom("span",{className:"passingAlert bar"},"Passing "+a(this.passedCount))):t(),e.banner.appendChild(this.createDom("span",{className:"duration"},"finished in "+((new Date).getTime()-this.startedAt.getTime())/1e3+"s"))},this},jasmine.HtmlReporterHelpers.addHelpers(jasmine.HtmlReporter.ReporterView),jasmine.HtmlReporter.SpecView=function(e,t,s){this.spec=e,this.dom=t,this.views=s,this.symbol=this.createDom("li",{className:"pending"}),this.dom.symbolSummary.appendChild(this.symbol),this.summary=this.createDom("div",{className:"specSummary"},this.createDom("a",{className:"description",href:"?spec="+encodeURIComponent(this.spec.getFullName()),title:this.spec.getFullName()},this.spec.description)),this.detail=this.createDom("div",{className:"specDetail"},this.createDom("a",{className:"description",href:"?spec="+encodeURIComponent(this.spec.getFullName()),title:this.spec.getFullName()},this.spec.getFullName()))},jasmine.HtmlReporter.SpecView.prototype.status=function(){return this.getSpecStatus(this.spec)},jasmine.HtmlReporter.SpecView.prototype.refresh=function(){switch(this.symbol.className=this.status(),this.status()){case"skipped":break;case"passed":this.appendSummaryToSuiteDiv();break;case"failed":this.appendSummaryToSuiteDiv(),this.appendFailureDetail()}},jasmine.HtmlReporter.SpecView.prototype.appendSummaryToSuiteDiv=function(){this.summary.className+=" "+this.status(),this.appendToSummary(this.spec,this.summary)},jasmine.HtmlReporter.SpecView.prototype.appendFailureDetail=function(){this.detail.className+=" "+this.status();for(var e=this.spec.results().getItems(),t=this.createDom("div",{className:"messages"}),s=0;s<e.length;s++){var i=e[s];"log"==i.type?t.appendChild(this.createDom("div",{className:"resultMessage log"},i.toString())):"expect"==i.type&&i.passed&&!i.passed()&&(t.appendChild(this.createDom("div",{className:"resultMessage fail"},i.message)),i.trace.stack&&t.appendChild(this.createDom("div",{className:"stackTrace"},i.trace.stack)))}t.childNodes.length>0&&(this.detail.appendChild(t),this.dom.details.appendChild(this.detail))},jasmine.HtmlReporterHelpers.addHelpers(jasmine.HtmlReporter.SpecView),jasmine.HtmlReporter.SuiteView=function(e,t,s){this.suite=e,this.dom=t,this.views=s,this.element=this.createDom("div",{className:"suite"},this.createDom("a",{className:"description",href:"?spec="+encodeURIComponent(this.suite.getFullName())},this.suite.description)),this.appendToSummary(this.suite,this.element)},jasmine.HtmlReporter.SuiteView.prototype.status=function(){return this.getSpecStatus(this.suite)},jasmine.HtmlReporter.SuiteView.prototype.refresh=function(){this.element.className+=" "+this.status()},jasmine.HtmlReporterHelpers.addHelpers(jasmine.HtmlReporter.SuiteView),jasmine.TrivialReporter=function(e){this.document=e||document,this.suiteDivs={},this.logRunningSpecs=!1},jasmine.TrivialReporter.prototype.createDom=function(e,t,s){for(var i=document.createElement(e),a=2;a<arguments.length;a++){var r=arguments[a];"string"==typeof r?i.appendChild(document.createTextNode(r)):r&&i.appendChild(r)}for(var n in t)"className"==n?i[n]=t[n]:i.setAttribute(n,t[n]);return i},jasmine.TrivialReporter.prototype.reportRunnerStarting=function(e){var t,s;this.outerDiv=this.createDom("div",{id:"TrivialReporter",className:"jasmine_reporter"},this.createDom("div",{className:"banner"},this.createDom("div",{className:"logo"},this.createDom("span",{className:"title"},"Jasmine"),this.createDom("span",{className:"version"},e.env.versionString())),this.createDom("div",{className:"options"},"Show ",t=this.createDom("input",{id:"__jasmine_TrivialReporter_showPassed__",type:"checkbox"}),this.createDom("label",{"for":"__jasmine_TrivialReporter_showPassed__"}," passed "),s=this.createDom("input",{id:"__jasmine_TrivialReporter_showSkipped__",type:"checkbox"}),this.createDom("label",{"for":"__jasmine_TrivialReporter_showSkipped__"}," skipped"))),this.runnerDiv=this.createDom("div",{className:"runner running"},this.createDom("a",{className:"run_spec",href:"?"},"run all"),this.runnerMessageSpan=this.createDom("span",{},"Running..."),this.finishedAtSpan=this.createDom("span",{className:"finished-at"},""))),this.document.body.appendChild(this.outerDiv);for(var i=e.suites(),a=0;a<i.length;a++){var r=i[a],n=this.createDom("div",{className:"suite"},this.createDom("a",{className:"run_spec",href:"?spec="+encodeURIComponent(r.getFullName())},"run"),this.createDom("a",{className:"description",href:"?spec="+encodeURIComponent(r.getFullName())},r.description));this.suiteDivs[r.id]=n;var o=this.outerDiv;r.parentSuite&&(o=this.suiteDivs[r.parentSuite.id]),o.appendChild(n)}this.startedAt=new Date;var p=this;t.onclick=function(e){t.checked?p.outerDiv.className+=" show-passed":p.outerDiv.className=p.outerDiv.className.replace(/ show-passed/,"")},s.onclick=function(e){s.checked?p.outerDiv.className+=" show-skipped":p.outerDiv.className=p.outerDiv.className.replace(/ show-skipped/,"")}},jasmine.TrivialReporter.prototype.reportRunnerResults=function(e){var t=e.results(),s=t.failedCount>0?"runner failed":"runner passed";this.runnerDiv.setAttribute("class",s),this.runnerDiv.setAttribute("className",s);for(var i=e.specs(),a=0,r=0;r<i.length;r++)this.specFilter(i[r])&&a++;var n=""+a+" spec"+(1==a?"":"s")+", "+t.failedCount+" failure"+(1==t.failedCount?"":"s");n+=" in "+((new Date).getTime()-this.startedAt.getTime())/1e3+"s",this.runnerMessageSpan.replaceChild(this.createDom("a",{className:"description",href:"?"},n),this.runnerMessageSpan.firstChild),this.finishedAtSpan.appendChild(document.createTextNode("Finished at "+(new Date).toString()))},jasmine.TrivialReporter.prototype.reportSuiteResults=function(e){var t=e.results(),s=t.passed()?"passed":"failed";0===t.totalCount&&(s="skipped"),this.suiteDivs[e.id].className+=" "+s},jasmine.TrivialReporter.prototype.reportSpecStarting=function(e){this.logRunningSpecs&&this.log(">> Jasmine Running "+e.suite.description+" "+e.description+"...")},jasmine.TrivialReporter.prototype.reportSpecResults=function(e){var t=e.results(),s=t.passed()?"passed":"failed";t.skipped&&(s="skipped");for(var i=this.createDom("div",{className:"spec "+s},this.createDom("a",{className:"run_spec",href:"?spec="+encodeURIComponent(e.getFullName())},"run"),this.createDom("a",{className:"description",href:"?spec="+encodeURIComponent(e.getFullName()),title:e.getFullName()},e.description)),a=t.getItems(),r=this.createDom("div",{className:"messages"}),n=0;n<a.length;n++){var o=a[n];"log"==o.type?r.appendChild(this.createDom("div",{className:"resultMessage log"},o.toString())):"expect"==o.type&&o.passed&&!o.passed()&&(r.appendChild(this.createDom("div",{className:"resultMessage fail"},o.message)),o.trace.stack&&r.appendChild(this.createDom("div",{className:"stackTrace"},o.trace.stack)))}r.childNodes.length>0&&i.appendChild(r),this.suiteDivs[e.suite.id].appendChild(i)},jasmine.TrivialReporter.prototype.log=function(){var e=jasmine.getGlobal().console;e&&e.log&&(e.log.apply?e.log.apply(e,arguments):e.log(arguments))},jasmine.TrivialReporter.prototype.getLocation=function(){return this.document.location},jasmine.TrivialReporter.prototype.specFilter=function(e){for(var t={},s=this.getLocation().search.substring(1).split("&"),i=0;i<s.length;i++){var a=s[i].split("=");t[decodeURIComponent(a[0])]=decodeURIComponent(a[1])}return t.spec?0===e.getFullName().indexOf(t.spec):!0};
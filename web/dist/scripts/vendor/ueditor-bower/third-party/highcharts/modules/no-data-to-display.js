/*
 Highcharts JS v3.0.6 (2013-10-04)
 Plugin for displaying a message when there is no data visible in chart.

 (c) 2010-2013 Highsoft AS
 Author: Øystein Moseng

 License: www.highcharts.com/license
*/

!function(t){function a(){return!!this.points.length}function o(){this.hasData()?this.hideNoData():this.showNoData()}var n=t.seriesTypes,e=t.Chart.prototype,i=t.getOptions(),s=t.extend;s(i.lang,{noData:"No data to display"}),i.noData={position:{x:0,y:0,align:"center",verticalAlign:"middle"},attr:{},style:{fontWeight:"bold",fontSize:"12px",color:"#60606a"}},n.pie.prototype.hasData=a,n.gauge&&(n.gauge.prototype.hasData=a),n.waterfall&&(n.waterfall.prototype.hasData=a),t.Series.prototype.hasData=function(){return void 0!==this.dataMax&&void 0!==this.dataMin},e.showNoData=function(t){var a=this.options,t=t||a.lang.noData,a=a.noData;this.noDataLabel||(this.noDataLabel=this.renderer.label(t,0,0,null,null,null,null,null,"no-data").attr(a.attr).css(a.style).add(),this.noDataLabel.align(s(this.noDataLabel.getBBox(),a.position),!1,"plotBox"))},e.hideNoData=function(){this.noDataLabel&&(this.noDataLabel=this.noDataLabel.destroy())},e.hasData=function(){for(var t=this.series,a=t.length;a--;)if(t[a].hasData()&&!t[a].options.isInternal)return!0;return!1},e.callbacks.push(function(a){t.addEvent(a,"load",o),t.addEvent(a,"redraw",o)})}(Highcharts);
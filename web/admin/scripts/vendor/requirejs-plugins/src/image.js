/** @license
 * RequireJS Image Plugin
 * Author: Miller Medeiros
 * Version: 0.2.2 (2013/02/08)
 * Released under the MIT license
 */

define([],function(){function n(){}function r(n){return n=n.replace(o,""),n+=n.indexOf("?")<0?"?":"&",n+e+"="+Math.round(2147483647*Math.random())}var e="bust",o="!bust",t="!rel";return{load:function(r,e,o,u){var a;u.isBuild?o(null):(a=new Image,a.onerror=function(n){o.error(n)},a.onload=function(r){o(a);try{delete a.onload}catch(e){a.onload=n}},-1!==r.indexOf(t)?a.src=e.toUrl(r.replace(t,"")):a.src=r)},normalize:function(n,e){return-1===n.indexOf(o)?n:r(n)}}});
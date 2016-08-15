/** @license
 * Plugin to load JS files that have dependencies but aren't wrapped into
 * `define` calls.
 * Author: Miller Medeiros
 * Version: 0.1.0 (2011/12/13)
 * Released under the MIT license
 */

define([],function(){var n=/^(.*)\[([^\]]*)\]$/;return{load:function(i,t,c,e){var f=n.exec(i);t(f[2].split(","),function(){t([f[1]],function(n){c(n)})})}}});
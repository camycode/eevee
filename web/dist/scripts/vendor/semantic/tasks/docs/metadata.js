function startsWith(t,e){return 0===t.indexOf(e)}function inArray(t,e){for(var r=e.length,n=0;r>n;n++)if(e[n]==t)return!0;return!1}function parser(t,e){if(t.isNull())return e(null,t);if(t.isStream())return e(new Error("Streaming not supported"));try{var r=String(t.contents.toString("utf8")),n=r.split("\n"),i=t.path.substring(0,t.path.length-4),l="server/documents",s=i.indexOf(l);if(!n)return;if(0>s)return e(null,t);i=i.substring(s+l.length+1,i.length);var a,o,u,f=n.length,p=!1,h=[],c=["UI Element","UI Global","UI Collection","UI View","UI Module","UI Behavior"];for(a=0;f>a;a++)if(u=n[a],p){if(startsWith(u,"---"))break;h.push(u)}else startsWith(u,"---")&&(p=!0);o=YAML.parse(h.join("\n")),o&&o.type&&o.title&&inArray(o.type,c)&&(o.category=o.type,o.filename=i,o.url="/"+i,o.title=o.title,data[o.element]=o)}catch(g){console.log(g,i)}e(null,t)}var console=require("better-console"),fs=require("fs"),YAML=require("yamljs"),data={};module.exports={result:data,parser:parser};
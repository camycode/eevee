var filterWord=UE.filterWord=function(){function e(e){return/(class="?Mso|style="[^"]*\bmso\-|w:WordDocument|<(v|o):|lang=)/gi.test(e)}function t(e){return e=e.replace(/[\d.]+\w+/g,function(e){return utils.transUnitToPx(e)})}function a(e){return e.replace(/[\t\r\n]+/g," ").replace(/<!--[\s\S]*?-->/gi,"").replace(/<v:shape [^>]*>[\s\S]*?.<\/v:shape>/gi,function(e){if(browser.opera)return"";try{if(/Bitmap/i.test(e))return"";var a=e.match(/width:([ \d.]*p[tx])/i)[1],n=e.match(/height:([ \d.]*p[tx])/i)[1],s=e.match(/src=\s*"([^"]*)"/i)[1];return'<img width="'+t(a)+'" height="'+t(n)+'" src="'+s+'" />'}catch(i){return""}}).replace(/<\/?div[^>]*>/g,"").replace(/v:\w+=(["']?)[^'"]+\1/g,"").replace(/<(!|script[^>]*>.*?<\/script(?=[>\s])|\/?(\?xml(:\w+)?|xml|meta|link|style|\w+:\w+)(?=[\s\/>]))[^>]*>/gi,"").replace(/<p [^>]*class="?MsoHeading"?[^>]*>(.*?)<\/p>/gi,"<p><strong>$1</strong></p>").replace(/\s+(class|lang|align)\s*=\s*(['"]?)([\w-]+)\2/gi,function(e,t,a,n){return"class"==t&&"MsoListParagraph"==n?e:""}).replace(/<(font|span)[^>]*>(\s*)<\/\1>/gi,function(e,t,a){return a.replace(/[\t\r\n ]+/g," ")}).replace(/(<[a-z][^>]*)\sstyle=(["'])([^\2]*?)\2/gi,function(e,a,n,s){for(var i,r=[],o=s.replace(/^\s+|\s+$/,"").replace(/&#39;/g,"'").replace(/&quot;/gi,"'").replace(/[\d.]+(cm|pt)/g,function(e){return utils.transUnitToPx(e)}).split(/;\s*/g),c=0;i=o[c];c++){var l,g,u=i.split(":");if(2==u.length){if(l=u[0].toLowerCase(),g=u[1].toLowerCase(),/^(background)\w*/.test(l)&&0==g.replace(/(initial|\s)/g,"").length||/^(margin)\w*/.test(l)&&/^0\w+$/.test(g))continue;switch(l){case"mso-padding-alt":case"mso-padding-top-alt":case"mso-padding-right-alt":case"mso-padding-bottom-alt":case"mso-padding-left-alt":case"mso-margin-alt":case"mso-margin-top-alt":case"mso-margin-right-alt":case"mso-margin-bottom-alt":case"mso-margin-left-alt":case"mso-height":case"mso-width":case"mso-vertical-align-alt":/<table/.test(a)||(r[c]=l.replace(/^mso-|-alt$/g,"")+":"+t(g));continue;case"horiz-align":r[c]="text-align:"+g;continue;case"vert-align":r[c]="vertical-align:"+g;continue;case"font-color":case"mso-foreground":r[c]="color:"+g;continue;case"mso-background":case"mso-highlight":r[c]="background:"+g;continue;case"mso-default-height":r[c]="min-height:"+t(g);continue;case"mso-default-width":r[c]="min-width:"+t(g);continue;case"mso-padding-between-alt":r[c]="border-collapse:separate;border-spacing:"+t(g);continue;case"text-line-through":("single"==g||"double"==g)&&(r[c]="text-decoration:line-through");continue;case"mso-zero-height":"yes"==g&&(r[c]="display:none");continue;case"margin":if(!/[1-9]/.test(g))continue}if(/^(mso|column|font-emph|lang|layout|line-break|list-image|nav|panose|punct|row|ruby|sep|size|src|tab-|table-border|text-(?:decor|trans)|top-bar|version|vnd|word-break)/.test(l)||/text\-indent|padding|margin/.test(l)&&/\-[\d.]+/.test(g))continue;r[c]=l+":"+u[1]}}return a+(r.length?' style="'+r.join(";").replace(/;{2,}/g,";")+'"':"")})}return function(t){return e(t)?a(t):t}}();
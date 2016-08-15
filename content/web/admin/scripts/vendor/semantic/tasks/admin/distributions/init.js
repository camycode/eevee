var gulp=require("gulp"),console=require("better-console"),del=require("del"),fs=require("fs"),path=require("path"),git=require("gulp-git"),githubAPI=require("github"),mkdirp=require("mkdirp"),github=require("../../config/admin/github.js"),release=require("../../config/admin/release"),project=require("../../config/project/release"),oAuth=fs.existsSync(__dirname+"/../../config/admin/oauth.js")?require("../../config/admin/oauth"):!1,version=project.version;module.exports=function(e){var i,o,r=-1,t=release.distributions.length;return oAuth?(o=function(){function n(){v?u():s()}function s(){console.info("Initializing repository for "+g),git.init(h,function(e){e&&console.error("Error initializing repo",e),u()})}function u(){console.info("Adding remote origin as "+b),git.addRemote("origin",b,h,function(){c()})}function c(){console.info("Pulling "+g+" files"),git.pull("origin","master",m,function(e){l()})}function l(){console.info("Resetting files to head"),git.reset("HEAD",q,function(e){a()})}function a(){global.clearTimeout(i),i=global.setTimeout(function(){o()},0)}if(r+=1,r>=t)return void e();var g=release.distributions[r],f=g.toLowerCase(),d=path.resolve(release.outputRoot+f),p=release.distRepoRoot+g,h={cwd:d},m={args:"-q",cwd:d,quiet:!0},q={args:"-q --hard",cwd:d,quiet:!0},b="git@github.com:"+release.org+"/"+p+".git",v=("https://github.com/"+release.org+"/"+p+"/",fs.existsSync(path.join(d,".git")));console.log("Processing repository: "+d),fs.existsSync(d)||mkdirp.sync(d),0==release.outputRoot.search("../repos")&&(console.info("Cleaning dir",d),del.sync([d+"**/*"],{silent:!0,force:!0})),v?c():n()},void o()):void console.error("Must add oauth token for GitHub in tasks/config/admin/oauth.js")};
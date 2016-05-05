var gulp=require("gulp"),console=require("better-console"),del=require("del"),fs=require("fs"),path=require("path"),runSequence=require("run-sequence"),mergeStream=require("merge-stream"),concatFileNames=require("gulp-concat-filenames"),debug=require("gulp-debug"),flatten=require("gulp-flatten"),git=require("gulp-git"),jsonEditor=require("gulp-json-editor"),plumber=require("gulp-plumber"),rename=require("gulp-rename"),replace=require("gulp-replace"),tap=require("gulp-tap"),config=require("../../config/user"),release=require("../../config/admin/release"),project=require("../../config/project/release"),version=project.version,output=config.paths.output;module.exports=function(e){var r,s=[];for(r in release.distributions){var p=release.distributions[r];!function(e){var r,p,t=e.toLowerCase(),i=path.join(release.outputRoot,t),u=path.join(i,release.files.npm),a=(release.distRepoRoot+e,{match:{files:"{files}",version:"{version}"}}),n={all:e+" copying files",repo:e+" create repo",meteor:e+" create meteor package.js","package":e+" create package.json"};r=function(e){var e=e||path.resolve("."),s=fs.readdirSync(e),p=[".git","node_modules","package.js","LICENSE","README.md","package.json","bower.json",".gitignore"],t=[];return s.forEach(function(s){var u=p.indexOf(s)>-1,a=path.join(e,s),n=fs.statSync(a);u||(n&&n.isDirectory()?t=t.concat(r(a)):t.push(a.replace(i+path.sep,"")))}),t},p=function(e){var r="";for(var s in e)r+=s==e.length-1?"'"+e[s]+"'":"'"+e[s]+"',\n    ";return r},gulp.task(n.meteor,function(){var e=r(i),s=p(e);gulp.src(release.templates.meteor[t]).pipe(plumber()).pipe(flatten()).pipe(replace(a.match.version,version)).pipe(replace(a.match.files,s)).pipe(rename(release.files.meteor)).pipe(gulp.dest(i))}),"CSS"==e?gulp.task(n.repo,function(){var e,r,s;return e=gulp.src("dist/themes/default/**/*",{base:"dist/"}).pipe(gulp.dest(i)),r=gulp.src("dist/components/*",{base:"dist/"}).pipe(gulp.dest(i)),s=gulp.src("dist/*",{base:"dist/"}).pipe(gulp.dest(i)),mergeStream(e,r,s)}):"LESS"==e&&gulp.task(n.repo,function(){var e,r,s,p,t;return e=gulp.src("src/definitions/**/*",{base:"src/"}).pipe(gulp.dest(i)),r=gulp.src("src/semantic.less",{base:"src/"}).pipe(gulp.dest(i)),r=gulp.src("src/theme.less",{base:"src/"}).pipe(gulp.dest(i)),s=gulp.src("src/theme.config.example",{base:"src/"}).pipe(gulp.dest(i)),p=gulp.src("src/_site/**/*",{base:"src/"}).pipe(gulp.dest(i)),t=gulp.src("src/themes/**/*",{base:"src/"}).pipe(gulp.dest(i)),mergeStream(e,r,s,p,t)}),gulp.task(n["package"],function(){return gulp.src(u).pipe(plumber()).pipe(jsonEditor(function(e){return version&&(e.version=version),e})).pipe(gulp.dest(i))}),s.push(n.meteor),s.push(n.repo),s.push(n["package"])}(p)}runSequence(s,e)};
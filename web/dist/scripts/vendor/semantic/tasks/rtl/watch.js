var gulp=require("gulp"),console=require("better-console"),fs=require("fs"),autoprefixer=require("gulp-autoprefixer"),chmod=require("gulp-chmod"),clone=require("gulp-clone"),gulpif=require("gulp-if"),less=require("gulp-less"),minifyCSS=require("gulp-minify-css"),plumber=require("gulp-plumber"),print=require("gulp-print"),rename=require("gulp-rename"),replace=require("gulp-replace"),rtlcss=require("gulp-rtlcss"),uglify=require("gulp-uglify"),util=require("gulp-util"),watch=require("gulp-watch"),config=require("../config/user"),tasks=require("../config/tasks"),install=require("../config/project/install"),globs=config.globs,assets=config.paths.assets,output=config.paths.output,source=config.paths.source,banner=tasks.banner,comments=tasks.regExp.comments,log=tasks.log,settings=tasks.settings;require("../collections/internal")(gulp),module.exports=function(e){return install.isSetup()?(console.clear(),console.log("Watching source files for changes"),gulp.watch([source.config,source.definitions+"/**/*.less",source.site+"/**/*.{overrides,variables}",source.themes+"/**/*.{overrides,variables}"],function(e){var s,i,p,t,n,r,o,l;gulp.src(e.path).pipe(print(log.modified)),l=-1!==e.path.indexOf(".config"),r=-1!==e.path.indexOf(source.themes),o=-1!==e.path.indexOf(source.site),n=-1!==e.path.indexOf(source.definitions),l?(console.log("Change detected in theme config"),gulp.start("build")):r?(console.log("Change detected in packaged theme"),s=s.replace(tasks.regExp.theme,source.definitions),s=util.replaceExtension(e.path,".less")):o?(console.log("Change detected in site theme"),s=s.replace(source.site,source.definitions),s=util.replaceExtension(e.path,".less")):n&&(console.log("Change detected in definition"),s=util.replaceExtension(e.path,".less")),fs.existsSync(s)?(i=gulp.src(s).pipe(plumber()).pipe(less(settings.less)).pipe(replace(comments.variables["in"],comments.variables.out)).pipe(replace(comments.license["in"],comments.license.out)).pipe(replace(comments.large["in"],comments.large.out)).pipe(replace(comments.small["in"],comments.small.out)).pipe(replace(comments.tiny["in"],comments.tiny.out)).pipe(autoprefixer(settings.prefix)).pipe(gulpif(config.hasPermission,chmod(config.permission))).pipe(rtlcss()),t=i.pipe(clone()),p=i.pipe(clone()),t.pipe(plumber()).pipe(replace(assets.source,assets.uncompressed)).pipe(rename(settings.rename.rtlCSS)).pipe(gulp.dest(output.uncompressed)).pipe(print(log.created)).on("end",function(){gulp.start("package uncompressed rtl css")}),p=i.pipe(plumber()).pipe(replace(assets.source,assets.compressed)).pipe(minifyCSS(settings.minify)).pipe(rename(settings.rename.minCSS)).pipe(rename(settings.rename.rtlMinCSS)).pipe(gulp.dest(output.compressed)).pipe(print(log.created)).on("end",function(){gulp.start("package compressed rtl css")})):console.log("Cannot find UI definition at path",s)}),gulp.watch([source.definitions+"/**/*.js"],function(e){gulp.src(e.path).pipe(plumber()).pipe(replace(comments.license["in"],comments.license.out)).pipe(gulpif(config.hasPermission,chmod(config.permission))).pipe(gulp.dest(output.uncompressed)).pipe(print(log.created)).pipe(uglify(settings.uglify)).pipe(rename(settings.rename.minJS)).pipe(gulp.dest(output.compressed)).pipe(print(log.created)).on("end",function(){gulp.start("package compressed js"),gulp.start("package uncompressed js")})}),void gulp.watch([source.themes+"/**/assets/**/"+globs.components+"?(s).*"],function(e){gulp.src(e.path,{base:source.themes}).pipe(gulpif(config.hasPermission,chmod(config.permission))).pipe(gulp.dest(output.themes)).pipe(print(log.created))})):void console.error('Cannot watch files. Run "gulp install" to set-up Semantic')};
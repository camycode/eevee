module.exports=function(e){e.initConfig({pkg:e.file.readJSON("package.json"),uglify:{options:{expand:!0},"layer.js":{options:{banner:"/*! layer-v<%= pkg.version %> <%= pkg.description %> License LGPL  <%= pkg.homepage %> By <%= pkg.author %> */\n;"},src:"./src/layer.js",dest:"./layer.js"},"layer.ext.js":{options:{banner:"/*! layer<%= pkg.description %>拓展类 */\n;"},src:"./src/extend/layer.ext.js",dest:"./extend/layer.ext.js"},"layer.mobile.js":{options:{banner:"/*! layer mobile-v<%= pkg.mobile %> <%= pkg.description %>移动版 License LGPL <%= pkg.homepage %>mobile By <%= pkg.author %> */\n;"},src:"./src/mobile/layer.m.js",dest:"./mobile/layer.m.js"}},cssmin:{options:{compatibility:"ie8",noAdvanced:!0},layer:{files:[{expand:!0,cwd:"./src/skin",src:["*.css","!*.min.css"],dest:"./skin"}]}}}),e.loadNpmTasks("grunt-contrib-uglify"),e.loadNpmTasks("grunt-contrib-cssmin"),e.registerTask("default",["uglify","cssmin"])};
module.exports=function(e){var t=require("../admin/components/init"),i=require("../admin/components/create"),s=require("../admin/components/update"),a=require("../admin/distributions/init"),r=require("../admin/distributions/create"),n=require("../admin/distributions/update"),o=require("../admin/release"),u=require("../admin/publish"),m=require("../admin/register");e.task("init distributions","Grabs each component from GitHub",a),e.task("create distributions","Updates files in each repo",r),e.task("init components","Grabs each component from GitHub",t),e.task("create components","Updates files in each repo",i),e.task("update distributions","Commits component updates from create to GitHub",n),e.task("update components","Commits component updates from create to GitHub",s),e.task("release","Stages changes in GitHub repos for all distributions",o),e.task("publish","Publishes all releases (components, package)",u),e.task("register","Registers all packages with NPM",m)};
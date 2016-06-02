({
    appDir: './src',
    baseUrl: './scripts',
    dir: './dist',
    mainConfigFile: "./src/scripts/bootstrap.js",
    include: "./src/scripts/main",
    modules: [
        {
            name: 'bootstrap'
        }
    ],
    // fileExclusionRegExp: /^(r|build|bower)\.js$/,
    optimizeCss: 'standard',
    // removeCombined: true,
    optimize: "uglify2"
});
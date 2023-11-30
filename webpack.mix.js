const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/bootstrap.js", "public/js/bootstrap.js")
    .sass("resources/sass/app.scss", "public/css")
    .js("public/firebase-messaging-sw.js", "public/js");

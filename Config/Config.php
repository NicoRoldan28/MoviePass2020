<?php namespace Config;
    
    define("ROOT", dirname(__DIR__) . "/");
    //Path to your project's root folder
    define("FRONT_ROOT", "/MoviePass2020/");
    define("VIEWS_PATH", "Views/");
    define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
    define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");

    //DataBase
    define("DB_HOST", "localhost");
    define("DB_NAME", "MP");
    define("DB_USER", "root");
    define("DB_PASS", "");

    //API
    define('KEY','api_key=2e353a04f443ba09a1f69c15142ff76f');
    define("API","https://api.themoviedb.org/3/movie/top_rated?");
    define("IMAGE","http://image.tmdb.org/t/p//w500");
    define("API2","https://api.themoviedb.org/3/movie/now_playing?".KEY);
    define("GENDER","https://api.themoviedb.org/3/genre/movie/list?".KEY);



?>
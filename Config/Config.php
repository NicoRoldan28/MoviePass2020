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
<<<<<<< HEAD
    define('KEY','api_key=2e353a04f443ba09a1f69c15142ff76f');

    define("API","https://api.themoviedb.org/3/movie");

    //https://api.themoviedb.org/3/movie/157336?api_key={api_key}

=======
    
    define('KEY','?api_key=2e353a04f443ba09a1f69c15142ff76f');
    //define("API","https://api.themoviedb.org/3/movie/top_rated?");
>>>>>>> Rodrigo
    define("IMAGE","http://image.tmdb.org/t/p//w500");
    
    //define("APIDETAILS","https://api.themoviedb.org/3/movie/now_playing?".KEY);
    define("GENDER","https://api.themoviedb.org/3/genre/movie/list".KEY);
    
    
    
    define("API","https://api.themoviedb.org/3/movie");
    define("APINOWPLAYING",API."/now_playing".KEY);
    //define("APIDETAILS",API.KEY);
    //https://api.themoviedb.org/3/movie/{movie_id}?api_key=<<api_key>>&language=en-US

    //define("API3","https://api.themoviedb.org/3/movie/".idPelicula"?".KEY);
   
    //define("APIDETAILS",API.KEY);

    define("APINOWPLAYING",API."/now_playing?".KEY);

    //https://api.themoviedb.org/3/movie/%7Bmovie_id%7D?api_key=<<api_key>>&language=en-US

    //define("APIDETAILS","https://api.themoviedb.org/3/movie/now_playing?%22.KEY);


?>

https://api.themoviedb.org/3/movie/now_playing?api_key=2e353a04f443ba09a1f69c15142ff76f&language=en-US&page=1




    
    
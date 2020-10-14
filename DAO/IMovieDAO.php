<?php 
    namespace DAO;

    use Models\Movie as Movie;

    interface IMovieDAO{
        function AddMovie(Movie $movie);
        function GetAllMovie();
        function GetMovie();
    }


?>
<?php namespace Controllers;

    use DAO\MovieDAO as MovieDAO;
    use Models\Gender as Gender;
    use Models\Movie as Movie;

    use DAO\ApiDAO as ApiDAO;


    class MovieController{
        private $movieDAO;
        private $apiDAO;


        public function __construct()
        {
            $this->movieDAO = new MovieDAO();
            $this->apiDAO = new ApiDAO();
        }
        public function ShowListView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $movieList = $this->movieDAO->GetAll();
            require_once(VIEWS_PATH."movie-list.php");
        }
        public function ShowListView2()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $movieList = $this->movieDAO->GetAll();
            require_once(VIEWS_PATH."showings-adds.php");
        }
        public function ShowListView3()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $movieList = $this->movieDAO->GetAll();
            require_once(VIEWS_PATH."movie-list2.php");
        }
        public function actualizarPeliculas()
        {
            require_once('SaveDataBD.php');
            require_once("ShowListView");
        }

        
        // Funcion que actualiza las peliculas de la base de datos.. verifica que no se encuentre y si no se encuentra
        // la agrega. Ademas vincula los generos de las peliculas con la pelicula
        public function SaveDataBD(){

            $decodeMovie = $this->apiDAO->RetrieveDataMovie();
            foreach($decodeMovie['results'] as $movie){
                $result=$this->movieDAO->checkIfExist($movie['id']);
                if($result==null)
                {
                   $insert= new Movie($movie['id'],rand(100,150),$movie['title'],$movie['poster_path'],$movie['original_language']);
                 $this->movieDAO->Add($insert);
                 foreach ($movie['genre_ids'] as $value) {
                     $this->movieDAO->AddGxM($insert->getId(),$value);
                 }
                }
          }
          echo '<script language="javascript">alert("THE DATA BASE WAS UPDATE");</script>';
            $this->ShowListView();

        }

    }

?>
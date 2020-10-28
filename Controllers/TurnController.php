<?php 
    namespace Controllers;

    use Models\Turn as Turn;
    use DAO\TurnDAO as TurnDAO;
    
    //use DAO\MovieDAO as MovieDAO;
    //use Models\Movie as Movie;

    class TurnController{

        private $turnDAO;

        public function __construct(){
            $this->turnDAO = new TurnDAO();
        }

        public function ShowListTurn(){
            $turnList = $this->turnDAO->GetAll();
            var_dump($turnList);
            //require_once(VIEWS_PATH.'movie-list2.php');
        }
    }
?>
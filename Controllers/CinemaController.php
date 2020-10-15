<?php
    namespace Controllers;

    use Models\Cinema as Cinema;
    use DAO\CinemaDAO as CinemaDAO;

    class CinemaController{

        private $cinemaDAO;

        public function __construct(){
            $this->cinemaDAO = new CinemaDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."registerCinema.php");
        }

        public function ShowListView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $cineList =array();
            $cineList =$this->cinemaDAO->getAll();
            require_once(VIEWS_PATH."listCinema.php");
        }

        public function ShowFilmTabView($cine)
        { 
            require_once(VIEWS_PATH."validate-session.php");
            var_dump($cine);
            $cinema= new Cinema();
            $cinema=$this->cinemaDAO->getCinemaById($cine);
            var_dump($cinema);
            //$cineList =$this->cinemaDAO->getAll();
            //require_once(VIEWS_PATH."FilmTab.php");
        }


        public function RegisterCine($name,$adress,$price_ticket)
        {
            $cinema = new Cinema();
            
            $cinema->setName($name);
            $cinema->setAdress($adress);
            $cinema->setPrice_ticket($price_ticket);

            $this->cinemaDAO->Add($cinema);

            $this->ShowListView();
        }
    

    }
?>
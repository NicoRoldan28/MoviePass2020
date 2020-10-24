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

        public function ShowFilmTabView($idCinema)
        {
            require_once(VIEWS_PATH."validate-session.php");
            $cinema =$this->cinemaDAO->getCinemaById($idCinema);
            //var_dump($cinema);
            require_once(VIEWS_PATH."FilmTab.php");
        }


        public function RegisterCine($name,$adress,$price_ticket)
        {
            $cinema = new Cinema();
            
            $cinema->setName($name);
            $cinema->setAdress($adress);
            $cinema->setPrice_ticket($price_ticket);

            $result=$this->cinemaDAO->seachCinema($cinema->getName(),$cinema->getAdress());
            if($result==null){
                $this->cinemaDAO->Add($cinema);
                $this->ShowListView();
            }else{
                echo '<script language="javascript">alert("Ya hay un cine registrado con ese nombre o direccion");</script>';
                $this->ShowAddView();
            }
        }
    }
?>
<?php namespace Controllers;

    use DAO\ShowingDAO as ShowingDAO;
    use Models\Showing as Showing;
    //use Models\Cinema as Cinema;
    //use DAO\CinemaDAO as CinemaDAO;
    //use Models\Movie as Movie;

    //use DAO\ApiDAO as ApiDAO;


    class ShowingController{
        private $showingDAO;
        private $cinemaDAO;

        public function __construct(){
            $this->showingDAO = new ShowingDAO();
            //$this->cinemaDAO = new CinemaDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $cineList=array();
            $cineList=$this->cinemaDAO->getAll();
            require_once(VIEWS_PATH."showings-add.php");
        }

        /*public function ShowListView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $cineList =array();
            $cineList =$this->cinemaDAO->getAll();
            require_once(VIEWS_PATH."listCinema2.php");
        }*/



        public function RegisterShowing($name,$capacidad,$idcinema)
        {
            $room = new Room();
            
            $room->setNombre($name);
            $room->setCapacidad($capacidad);
            $room->setCinema($this->cinemaDAO->getCinemaById($idcinema));
            
            $result=$this->roomDAO->seachRoom($room->getNombre(),$idcinema);
            if($result==null){
                $this->roomDAO->Add($room);
                $this->ShowListView();
            }else{
                echo '<script language="javascript">alert("Ya hay una sala registrada con ese nombre en ese cine");</script>';
                $this->ShowAddView();
            }
        }
    }
?>
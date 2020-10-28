<?php namespace Controllers;

    use DAO\RoomDAO as RoomDAO;
    use DAO\CinemaDAO as CinemaDAO;
    use DAO\ShowingDAO as ShowingDAO;

    use Models\Room as Room;
    use Models\Cinema as Cinema;
    use Models\Showing as Showing;

    //use Models\Movie as Movie;

    //use DAO\ApiDAO as ApiDAO;


    class RoomController{
        private $roomDAO;
        private $cinemaDAO;

        public function __construct(){
            $this->roomDAO = new RoomDAO();
            $this->cinemaDAO = new CinemaDAO();
        }

        public function ShowAddView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $cineList=array();
            $cineList=$this->cinemaDAO->getAll();
            require_once(VIEWS_PATH."registerRoom.php");
        }

        public function ShowListView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $cineList =array();
            $cineList =$this->cinemaDAO->getAll();
            require_once(VIEWS_PATH."listCinema2.php");
        }


        public function RegisterRoom($name,$capacidad,$idcinema)
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
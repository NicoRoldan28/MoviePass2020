<?php
    namespace Controllers;

    use Models\Cinema as Cinema;
    use Models\Room as Room;
    use Models\Showing as Showing;

    use DAO\CinemaDAO as CinemaDAO;
    use DAO\RoomDAO as RoomDAO;
    use DAO\ShowingDAO as ShowingDAO;

    class CinemaController{

        private $cinemaDAO;
        private $roomDAO;
        private $showingDAO;

        public function __construct(){
            $this->cinemaDAO = new CinemaDAO();
            $this->roomDAO = new RoomDAO();
            ////$this->showingDAO = new ShowingDAO();
        }

        //################ CINEMA ##################

        public function ShowAddCinemaView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."registerCinema.php");
        }

        public function ShowListCinemaView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $cineList =array();
            $cineList =$this->cinemaDAO->getAll();
            require_once(VIEWS_PATH."listCinema2.php");
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

        ################### ROOM #####################
        
        public function ShowAddRoomView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $cineList=array();
            $cineList=$this->cinemaDAO->getAll();
            require_once(VIEWS_PATH."registerRoom.php");
        }

        public function ShowListRoomView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $cineList =array();
            $cineList =$this->cinemaDAO->getAll();
            require_once(VIEWS_PATH."listCinema2.php");
        }

        public function RegisterRoom($name,$capacidad,$idCinema)
        {
            
            $room = new Room();
            $room->setNombre($name);
            $room->setCapacidad($capacidad);
            $room->setCinema($this->cinemaDAO->getCinemaById($idCinema));
            
            $result=$this->roomDAO->seachRoom($room->getNombre(),$idCinema);
            if($result==null){
                $this->roomDAO->Add($room);
                $this->ShowListView();
            }else{
                echo '<script language="javascript">alert("Ya hay una sala registrada con ese nombre en ese cine");</script>';
                $this->ShowAddView();
            }
        }

        ################### SHOWING #####################

        
        public function ShowAddShowingView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $cineList=$this->cinemaDAO->getAll();
            $roomList=$this->roomDAO->GetAll();
            var_dump($roomList);
            var_dump($cineList);
            require_once(VIEWS_PATH."selectCinema.php");
        }

        public function ShowListShowingView()
        {
            require_once(VIEWS_PATH."validate-session.php");
            $cineList =array();
            $cineList =$this->cinemaDAO->getAll();
            require_once(VIEWS_PATH."listCinema2.php");
        }

        public function AddShowing($idCinema)
        {
            
            $room = new Room();
            $room->setNombre($name);
            $room->setCapacidad($capacidad);
            $room->setCinema($this->cinemaDAO->getCinemaById($idCinema));
            
            $result=$this->roomDAO->seachRoom($room->getNombre(),$idCinema);
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
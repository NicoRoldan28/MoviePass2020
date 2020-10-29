<?php 
 namespace Controllers;

 use DAO\RoomDAO as RoomDAO;
 use Models\Room as Room;
 use Models\Showing as Showing;
 use DAO\ShowingDAO as ShowingDAO;
 //use Models\Movie as Movie;

 //use DAO\ApiDAO as ApiDAO;


 class ShowingController{
     private $roomDAO;
     //private $cinemaDAO;
     private $showingDAO;

     public function __construct(){
         $this->roomDAO = new RoomDAO();
         //$this->cinemaDAO = new CinemaDAO();
         $this->showingDAO = new ShowingDAO();
     }

     public function ShowAddView()
     {
         require_once(VIEWS_PATH."validate-session.php");
         $rooms=array();
         $rooms=$this->roomDAO->GetAll();
         require_once(VIEWS_PATH."showings-add.php");
     }

     public function ShowListView()
     {
         require_once(VIEWS_PATH."validate-session.php");
         $cineList =array();
         $cineList =$this->cinemaDAO->getAll();
         require_once(VIEWS_PATH."listCinema2.php");
     }


     public function AddShowing($name,$capacidad,$idCinema)
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
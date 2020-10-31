<?php
       namespace Controllers;

       use Models\Cinema as Cinema;
       use Models\Room as Room;
       use Models\Showing as Showing;
       use Models\Movie as Movie;
   
       use DAO\CinemaDAO as CinemaDAO;
       use DAO\RoomDAO as RoomDAO;
       use DAO\ShowingDAO as ShowingDAO;
       use DAO\MovieDAO as MovieDAO;
   
       class CinemaController{
   
           private $cinemaDAO;
           private $roomDAO;
           private $showingDAO;
           private $movieDAO;
   
           public function __construct(){
               $this->cinemaDAO = new CinemaDAO();
               $this->roomDAO = new RoomDAO();
               $this->movieDAO= new MovieDAO();
               $this->showingDAO = new ShowingDAO();
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
           
           public function selectCinema(){
                require_once(VIEWS_PATH."validate-session.php");
                $cinemaList=array();
                $cinemaList= $this->cinemaDAO->GetAll();
                //var_dump($cinemaList);
                require_once(VIEWS_PATH."selectCinema.php");
           }

           public function ShowFilmTabView($idCinema)
           {    
               require_once(VIEWS_PATH."validate-session.php");
               $movieList=array();
               $roomList=array();
               $roomList= $this->roomDAO->getAllForCinema($idCinema);
               //var_dump($roomList);
               $movieList= $this->movieDAO->GetAll();
               //var_dump($movieList);
               if($roomList!=null)
                {
                    include_once(VIEWS_PATH."showings-add.php");
                }
                else{
                    echo '<script language="javascript">alert("THIS CINEMA DONT HAVE ROOMS");</script>';
                    $this->SelectCinema();
                }
               //$cinema =$this->cinemaDAO->getCinemaById($idCinema);
               //var_dump($cinema);
               //require_once(VIEWS_PATH."FilmTab.php");
           }
           /*
           public function ShowListView2($id)
        {
            require_once(VIEWS_PATH."validate-session.php");

            $movieList=array();
            $roomList=array();
            $turnList=array();

            $roomList= $this->roomDAO->getAllForCinema($id);
            $movieList= $this->movieDAO->getAll();
            $turnList=$this->turnDAO->getAll();
          
           if($roomList!=null)
           {
            include_once(VIEWS_PATH."showings-add.php");
           }
            else{
                echo '<script language="javascript">alert("THIS CINEMA DONT HAVE ROOMS");</script>';
                $this->SelectCinema();

                
            }
        }
           */
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
               $roomList = $this->roomDAO->GetAll();
               //var_dump($roomList);
               foreach($roomList as $room){
                $room2 = $this->cinemaDAO->getCinemaById($room->getCinema()->getId());
                $room->getCinema()->setName($room2->getName());
                $room->getCinema()->setAdress($room2->getAdress());
                $room->getCinema()->setPrice_ticket($room2->getPrice_ticket());
            }
            //var_dump($roomList);
               require_once(VIEWS_PATH."room-list.php");
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
                   //$this->ShowListRoomView();
                   var_dump($room);
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
               $showingList =array();
               $showingList =$this->showingDAO->GetAllForRoom(7);

               foreach($showingList as $showing){
                $room = $this->roomDAO->getRoomById($showing->getRoom()->getId());
                $showing->getRoom()->setNombre($room->getNombre());
                $showing->getRoom()->setCapacidad($room->getCapacidad());
                $showing->getRoom()->getCinema()->setId($room->getCinema()->getId());

                $cinema = $this->cinemaDAO->getCinemaById($showing->getRoom()->getCinema()->getId());
                $showing->getRoom()->getCinema()->setName($cinema->getName());
                $showing->getRoom()->getCinema()->setAdress($cinema->getAdress());
                $showing->getRoom()->getCinema()->setPrice_ticket($cinema->getPrice_ticket());

                $movie = $this->movieDAO->returnMovie($showing->getMovie()->getId());
                //var_dump($movie);
                $showing->getMovie()->setLenght($movie->getLenght());
                $showing->getMovie()->setTitle($movie->getTitle());
                $showing->getMovie()->setImage($movie->getImage());
                $showing->getMovie()->setLenguage($movie->getLenguage());
                $showing->getMovie()->setGenders($movie->getGenders());
                }

            //var_dump($showingList);
              require_once(VIEWS_PATH."showingListAdmin.php");
              // require_once(VIEWS_PATH."listCinema2.php");
           }
   
           public function AddShowing($dayTime,$idMovie,$idRoom)
           {
            
            $date=date_create($dayTime);
            var_dump($date);
            $movie= new Movie();
            $movie=$this->movieDAO->returnMovie($idMovie);
            //var_dump($movie);
            $timeMovie=$movie->getLenght();
            var_dump($timeMovie);
            $hsFinish=date_modify($date,"+". $timeMovie. "minute");
               var_dump($dayTime);
               //var_dump($date);
               //$hrFinsh= date($date);
               //$hrFinsh = $date->modify('+100 minute');
               var_dump($hsFinish);
               $horasssFinish= $hsFinish->date;
               $showing = new Showing();
               $showing->setDayTime($dayTime);
               $showing->setMovie();
               $showing->getMovie()->setId($idMovie);
               $showing->setRoom();
                $showing->getRoom()->setId($idRoom/*$this->roomDAO->getRoomById($idRoom)*/);
               $showing->setHrFinish($horasssFinish);

               //$horasssFinish= $hsFinish->date;
               var_dump($horasssFinish);

               var_dump($hsFinish->date);
               var_dump($hsFinish->timezone);
               var_dump($showing);



               $this->showingDAO->Add($showing);
               //$showing->setHrStart($HrStart);
               //var_dump($showing);
               
               /*$result=$this->roomDAO->seachRoom($room->getNombre(),$idCinema);
               if($result==null){
                   $this->roomDAO->Add($room);
                   $this->ShowListView();
               }else{
                   echo '<script language="javascript">alert("Ya hay una sala registrada con ese nombre en ese cine");</script>';
                   $this->ShowAddView();
               }*/
           }
       }
?>
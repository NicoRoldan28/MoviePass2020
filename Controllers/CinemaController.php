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

       use \Exception as Exception;
       use \DateTime as DateTime;
   
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
   
           //################ CINEMA ######################################################################################################
   
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
                   $message="Exito al crear el cine";
                   $this->ShowListCinemaView();
               }
               else{
                    $message="Error, Ya se encuentra un cine con ese nombre";
                    include_once(VIEWS_PATH."Errors.php");
                    //header("location: ".FRONT_ROOT."Cinema/ShowAddCinemaView");
               }          
           }
   
           ################### ROOM #########################################################################################################
           
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
               //var_dump($idCinema);  
               $room = new Room();
               $room->setNombre($name);
               $room->setCapacidad($capacidad);
               $room->setCinema($this->cinemaDAO->getCinemaById($idCinema));
               //var_dump($this->cinemaDAO->getCinemaById($idCinema));
               $cinema=$this->cinemaDAO->getCinemaById($idCinema);
               $room->setCinema($cinema);
               $room->getCinema()->setId($cinema->getId());
               $result=$this->roomDAO->seachRoom($room->getNombre(),$idCinema);
               if($result==null){
                   $this->roomDAO->Add($room);
                   $this->ShowListRoomView();
               }else{
                   echo '<script language="javascript">alert("Ya hay una sala registrada con ese nombre en ese cine");</script>';
                   $this->ShowAddRoomView();
               }
           }
   
           ################### SHOWING #########################################################################################################
   
           public function ShowAddShowingView()
           {
               require_once(VIEWS_PATH."validate-session.php");
               $cineList=$this->cinemaDAO->getAll();
               $roomList=$this->roomDAO->GetAll();
               //var_dump($roomList);
               //var_dump($cineList);
               require_once(VIEWS_PATH."selectCinema.php");
           }
   
           public function ShowListShowingView()
           {
               require_once(VIEWS_PATH."validate-session.php");
               $showingList =array();
               $showingList =$this->showingDAO->GetAll();

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
           
           public function cargarShowings($showingList)
           {
                require_once(VIEWS_PATH."validate-session.php");
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
                return $showingList;
           }

           public function ShowListShowingView2()
           {
               require_once(VIEWS_PATH."validate-session.php");
               $showingList =array();
               //$showingList2= array();

               $showingList =$this->showingDAO->GetAll();

               $showingList=$this->cargarShowings($showingList);
               
            //var_dump($showingList);
              require_once(VIEWS_PATH."showingListAdmin.php");
              // require_once(VIEWS_PATH."listCinema2.php");
           }





           public function AddShowing($dayTime,$idMovie,$idRoom)
           {
            $i=0;
            $date=date_create($dayTime);
            $date2=date_create($dayTime);
            var_dump("dia y hora de inicio de la funcion que vamos a agregar");
            var_dump($date);
            $movie= new Movie();
            $movie=$this->movieDAO->returnMovie($idMovie);
            //var_dump($movie);
            $timeMovie=$movie->getLenght();
            var_dump("tiempo de duracion de la pelicula que vamos a agregar");
            var_dump($timeMovie);
            $hsFinish=date_modify($date,"+". $timeMovie. "minute");
               var_dump($dayTime);
               //var_dump($date);
               //$hrFinsh= date($date);
               //$hrFinsh = $date->modify('+100 minute');
               var_dump("dia y hora de finalizacion de la funcion que vamos a agregar");
               var_dump($hsFinish);
               var_dump($hsFinish->date);
               var_dump($hsFinish->timezone);


            //$fechaActual=date("Y-m-d");
            //if($dayTime>=$fechaActual){
                //$listShowings= array();
                //$listShowings = $this->showingDAO()->GetAllByRoom($idRoom);
                /*foreach($listShowings as $row){

                }*/
                $horasssFinish= $hsFinish->date;
                $showing2 = new Showing();
                $showing2->setDayTime($dayTime);
                $showing2->setMovie();
                $showing2->getMovie()->setId($idMovie);
                $showing2->setRoom();
                $showing2->getRoom()->setId($idRoom/*$this->roomDAO->getRoomById($idRoom)*/);
               
                //$showing2->setidMovie($idMovie);
                //$showing2->setRoom($this->roomDAO->getRoomById($idRoom));
                $showing2->setHrFinish($horasssFinish);
                //$showing2->getHrFinish();
                //var_dump($showing->getHrFinish());
                //$diff = abs(stortime($dayTime)-strtotime($showing->getHrFinish()));
                //var_dump($diff);
                //$date_diff11 = date_diff(new DateTime(date('Y-m-d H:i:s', $$hsFinish->date)), new DateTime(date('Y-m-d H:i:s', $dayTime)))->format('%R %y años, %m meses, %d días, %h horas, %i minutos, %s segundos');
                //$date1=date_create("2013-03-15");
                //$date2=date_create("2013-12-12");
                //var_dump($showing->getHrFinish());

                //var_dump($hsFinish);
                //var_dump($date2);
                //$diff=date_diff($hsFinish,$date2);
                //echo $diff->format("%R%a days");
                //echo $diff->format('%R%Y años, %M meses, %D días, %H horas, %I minutos, %S segundos');
                /*if($diff->format('%I')>40)
                {
                    var_dump($diff->format( '%I minutos'));
                }
                else{
                    echo "es menor a 40";
                }*/
                
                
                //var_dump($diff);
                //echo $diff->format("%R%a days");
                //$this->showingDAO->Add($showing);
                $showingList=$this->showingDAO->GetAllForRoom($idRoom);
                
                if($showingList==null)
                {
                    $this->showingDAO->Add($showing2);
                }
                else{
                    foreach($showingList as $showing)
                    {
                        $date3=date_create($showing->getHrFinish());
                        $diff=date_diff($date3,$date2);

                        if(($diff->format('%D')>=0) && ($i==0))
                        {
                            $boleann=(( ( $showing2->getHrFinish()<$showing->getDayTime() ) &&( $showing2->getHrFinish()>$showing->getHrFinish() ) ) );
                            if ($boleann)
                            {
                                if(($diff->format('%H')>=1) || ($diff->format('%I')>=15)){
                                $this->showingDAO->Add($showing2);
                                $i=1;
                                }
                            }
                             if( ( $showing2->getHrFinish()>$showing->getDayTime() ) &&( $showing2->getHrFinish()>$showing->getHrFinish() )   ){
                                //if( ( $showing2->getHrFinish()>$showing->getDayTime() ) &&( $showing2->getHrFinish()>$showing->getHrFinish() )   ){
                                if(($diff->format('%H')>=1) || ($diff->format('%I')>=15)){
                                    $this->showingDAO->Add($showing2);
                                    $i=1;
                                }
                            } 
                        }
                    }
                    if($i==1)
                            {
                                $_SESSION['successMessage']="Extio al modificar la funcion";
                            } 
                            else{
                                $_SESSION['errorMessage']="No se puede modificar esta funcion, hay tickets vendidos para la misma";
                            }
                } 
                
                $this->ShowListShowingView2();
           }


           public function seachShowingsForMovie($idMovie)
           {
                $showingList = $this->showingDAO->GetAllForMovie($idMovie);
                $showingList=$this->cargarShowings($showingList);
                require_once(VIEWS_PATH."showingListUser.php");
           }

           public function seachShowingsForMovieForGender($idGender)
           {
                $movieList = $this->movieDAO->GetAllForShowingForGender($idGender);
                require_once(VIEWS_PATH."billboardMovie.php");
           }

           public function SelectDay()
           {
            require_once(VIEWS_PATH."validate-session.php");
            require_once(VIEWS_PATH."selectDays.php");

           }
           public function SearchDate($dayTimeStart,$dayTimeFinish){
            $fechaActual=date("Y-m-d");
                if(($dayTimeStart>=$fechaActual)&&($dayTimeFinish>=$fechaActual))
                {
                $showingList=$this->showingDAO->ShowingForDays($dayTimeStart,$dayTimeFinish);
                $showingList=$this->cargarShowings($showingList);
                require_once(VIEWS_PATH."showingListUser.php");
                }
            }
    }
?>
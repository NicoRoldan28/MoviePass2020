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

       use DAO\GenderDAO as GenderDAO;
       use Models\Gender as Gender;
   
       class CinemaController{
   
           private $cinemaDAO;
           private $roomDAO;
           private $showingDAO;
           private $movieDAO;
           private $genderDAO;
   
           public function __construct(){
               $this->cinemaDAO = new CinemaDAO();
               $this->roomDAO = new RoomDAO();
               $this->movieDAO= new MovieDAO();
               $this->showingDAO = new ShowingDAO();
               $this->genderDAO = new GenderDAO();
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
                require_once(VIEWS_PATH."selectCinema.php");
           }

           public function ShowFilmTabView($idCinema)
           {    
               require_once(VIEWS_PATH."validate-session.php");
               $movieList=array();
               $roomList=array();
               $roomList= $this->roomDAO->getAllForCinema($idCinema);
               $movieList= $this->movieDAO->GetAll();
        
               if($roomList!=null)
                {
                    include_once(VIEWS_PATH."showings-add.php");
                }
                else{
                    $cinemaList= $this->cinemaDAO->GetAll();
                    $message="Error, este cinema no tiene salas";
                    $scrip2="selectCinema.php";
                    include_once(VIEWS_PATH."Errors.php");
                }
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
                   $this->ShowListCinemaView();
               }
               else{
                    $message="Error, Ya se encuentra un cine con ese nombre o direccion";
                    $scrip2="registerCinema.php";
                    include_once(VIEWS_PATH."Errors.php");
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
        
               foreach($roomList as $room){
                $room2 = $this->cinemaDAO->getCinemaById($room->getCinema()->getId());
                $room->getCinema()->setName($room2->getName());
                $room->getCinema()->setAdress($room2->getAdress());
                $room->getCinema()->setPrice_ticket($room2->getPrice_ticket());
            }
               require_once(VIEWS_PATH."room-list.php");
           }
   
           public function RegisterRoom($name,$capacidad,$idCinema)
           {
               $room = new Room();
               $room->setNombre($name);
               $room->setCapacidad($capacidad);
               $room->setCinema($this->cinemaDAO->getCinemaById($idCinema));
   
               $cinema=$this->cinemaDAO->getCinemaById($idCinema);
               $room->setCinema($cinema);
               $room->getCinema()->setId($cinema->getId());
               $result=$this->roomDAO->seachRoom($room->getNombre(),$idCinema);
               if($result==null){
                   $this->roomDAO->Add($room);
                   $this->ShowListRoomView();
               }else{
                   $cineList = $this->cinemaDAO->GetAll();
                   $message="Error, Ya hay una sala registrada con ese nombre en ese cine";
                   $scrip2="registerRoom.php";
                   include_once(VIEWS_PATH."Errors.php");
               }
           }
   
           ################### SHOWING #########################################################################################################
   
           public function ShowAddShowingView()
           {
               require_once(VIEWS_PATH."validate-session.php");
               $cineList=$this->cinemaDAO->getAll();
               $roomList=$this->roomDAO->GetAll();
               require_once(VIEWS_PATH."selectCinema.php");
           }
   
           public function ShowListShowingView()
           {
               require_once(VIEWS_PATH."validate-session.php");
               $showingList =array();
               $showingList =$this->showingDAO->GetAll();

               $showingList=$this->cargarShowings($showingList);

              require_once(VIEWS_PATH."showingListAdmin.php");
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
               $showingList =$this->showingDAO->GetAll();
               $showingList=$this->cargarShowings($showingList);
               require_once(VIEWS_PATH."showingListAdmin.php");
           }

           public function AddShowing($dayTime,$idMovie,$idRoom)
           {
            $i=0;
            $date=date_create($dayTime);
            $date2=date_create($dayTime);
            $hrFinsh=date_create($dayTime);
            $hrInicio=date_create($dayTime);
            $hrInicio=date_format($hrInicio,'Y-m-d H:i:s');

            $movie= new Movie();
            $movie=$this->movieDAO->returnMovie($idMovie);

            $timeMovie=$movie->getLenght();
   
            $hrFinsh=date_modify($date,"+". $timeMovie. "minute");
    
            $horassss=date_format($hrFinsh,'Y-m-d H:i:s');

                $showing2 = new Showing();
                $showing2->setDayTime($hrInicio);
                //var_dump($showing2->getDayTime());
                $showing2->setMovie();
                $showing2->getMovie()->setId($idMovie);
                $showing2->setRoom();
                $showing2->getRoom()->setId($idRoom);

                $showing2->setHrFinish($horassss);


                //var_dump($showing2->getDayTime());
                $showingList=$this->showingDAO->GetShowingForDay($showing2->getDayTime());

                //var_dump($showingList);
                if($showingList==null)
                {
                    //$this->showingDAO->Add($showing2);
                    //var_dump("se agrega de una");
                    $i=1;
                }
                //else if(!($this->buscarMovieInShowing($showingList,$idMovie) ) )
                //{
                    //var_dump("ya existe esa pelicula en una funcion de ese dia");
                //}
                else if(!($this->buscarMovieInShowing($showingList,$idMovie) ) ) {

                    foreach($showingList as $showing)
                    {   
                            $date3=date_create($showing->getHrFinish());
                            //var_dump($date3);
                            //var_dump($date2);


                            $diff=date_diff($date3,$date2);
                            //var_dump($diff);

                            //$date6=date_format($date2,'Y-m-d H:i:s');
                            //var_dump($showing->getDayTime());
                            $hora2=date_create($showing->getDayTime());

                            $hora2=date_format($hora2,'Y-m-d H:i:s');

                            //$boleann5= ( ($showing2->getDayTime() > $showing->getDayTime() ) &&  ($showing->getHrFinish() < $showing2->getDayTime()) );


                            //var_dump("funcion con hora para agregar");
                            //var_dump($showing2->getDayTime());
                            //var_dump("funcion con hora en bdd");
                            //var_dump($hora2);
                            //var_dump($showing2->getDayTime() > $showing->getDayTime());

                            //var_dump("funcion con hora para agregar");
                            //var_dump($showing2->getDayTime());


                            //var_dump("funcion con hora end en bdd");
                            //var_dump($showing->getHrFinish());

                            //var_dump($showing2->getDayTime() < $showing->getHrFinish());

                            $boleano= ( ($showing2->getDayTime() > $showing->getDayTime()) && ($showing2->getDayTime() < $showing->getHrFinish()) );
                            /*var_dump($boleano);
                            if(!$boleano){
                                var_dump("caso contrario, en todo caso se puede agregar a la bdd la nueva funcion ");
                            }
                            else{
                                var_dump("la hora a agregar es mayor a la que ya existe en la bdd y menor que la hora de end en bdd ");
                            } */  
                            //var_dump($boleann5 );
                            //var_dump($i );
                            //var_dump($boleann5 );
                            //var_dump(($i==0) && (!$boleann5));
                            if((!$boleano))
                            {
                                //var_dump("estamos aca x2" );
                                //if(($showing2->getDayTime()> $showing->getDayTime())&&($showing2->getDayTime()<$showing->getHrFinish()))
                                //{
                                    //var_dump("estamos aca x3" );
                                    //var_dump($date6);
                                    //var_dump($showing2->getDayTime());
                                    //var_dump($showing->getDayTime());
                                    //var_dump($showing->getHrFinish());
                                    //var_dump("se agrega cuando ");
                                    //var_dump($showing2->getHrFinish());
                                    if(($showing2->getDayTime()<$showing->getDayTime())&&($showing2->getHrFinish()<$showing->getDayTime()))
                                    {
                                        //var_dump("se puede agrega cuando la hora de comienzo y finish de la nueva funcion ha agregar es menor a la hora de inico de una funcion de la bdd");
                                        
                                        $date15=date_create($showing->getDayTime());
                                        //var_dump($date15);
                                        $date16=date_create($showing2->getHrFinish());
                                        //var_dump($date16);

                                        $diff=date_diff($date15,$date16);
                                        //var_dump($diff);

                                        if(($diff->format('%H')>=1) || ($diff->format('%I')>=15))
                                            {
                                                //var_dump($date15);
                                                //var_dump($date16);
                                                //var_dump("hola?");
                                                //$this->showingDAO->Add($showing2);
                                                $i=1;
                                            }
                                            else{
                                                $i=0;
                                                //var_dump("confirmamos q entra aca???");
                                            }    
                                    }
                                /*$boleann=(( ( $showing2->getHrFinish()<$showing->getDayTime() ) &&( $showing2->getHrFinish()>$showing->getHrFinish() ) ) );

                                    if ($boleann)
                                    {
                                        if(($diff->format('%H')>=1) || ($diff->format('%I')>=15)){
                                        $this->showingDAO->Add($showing2);
                                        //var_dump("se agrega cuando ");
                                    $i=1;
                                    }
                                    }*/ 
                                //}   
                                    else if($showing2->getDayTime() > $showing->getHrFinish()){
                                        //var_dump("estamos aca x4");
                                        if(($diff->format('%H')>=1) || ($diff->format('%I')>=15)){
                                            //$this->showingDAO->Add($showing2);
                                            $i=1;
                                        }
                                        else{
                                            $i=0;
                                            //var_dump("confirmamos q entra aca???");
                                        } 
                                    }
                                    else{
                                        $i=0;
                                        //var_dump("estamos aca x5" );
                                    }     
                            }
                             
                    }
                } 
                if($i==1)
                        {
                            $this->showingDAO->Add($showing2);
                           $this->ShowListShowingView2();
                         } 
                else{
                       $cinemaList = $this->cinemaDAO->getAll();
                       $message="Error, no se ha podido agregar la funcion";
                       $scrip2="selectCinema.php";
                       include_once(VIEWS_PATH."Errors.php");
                }    
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
                $genderList = $this->genderDAO->GetAll();
                require_once(VIEWS_PATH."billboardMovie.php");
           }

           public function SelectDays()
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
                    if($showingList!=null)
                    {
                        require_once(VIEWS_PATH."showingListUser.php");
                    }
                    else{
                        $message="Error, no se ha podido encontrar funciones entre las fechas indicadas";
                        $scrip2="selectDays.php";
                        require_once(VIEWS_PATH."Errors.php");
                    }
                }
            }

            public function buscarMovieInShowing($showingList,$idMovie)
            {
            $i=null;
            foreach($showingList as $showing)
            {
                if($showing->getMovie()->getId()==$idMovie)
                {
                    $i=true;
                }
            }
            return $i;
            }
    }
?>
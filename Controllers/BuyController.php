<?php namespace Controllers;

    use Models\Buy as Buy;
    use Models\Ticket as Ticket;

    use DAO\TicketDAO as TicketDAO;
    use DAO\BuyDAO as BuyDAO;

    use DAO\ShowingDAO as ShowingDAO;
    /*use Models\Cinema as Cinema;
    use Models\Room as Room;
    use Models\Showing as Showing;
    use Models\Movie as Movie;

    use DAO\CinemaDAO as CinemaDAO;
    use DAO\RoomDAO as RoomDAO;
    
    use DAO\MovieDAO as MovieDAO;

    use \Exception as Exception;
    use \DateTime as DateTime;

    use DAO\GenderDAO as GenderDAO;
    use Models\Gender as Gender;*/


    class BuyController{

        private $ticketDAO;
        private $buyDAO;
        private $showingDAO;

        public function __construct(){
            $this->ticketDAO = new TicketDAO();
            $this->buyDAO = new BuyDAO();
            $this->showingDAO = new ShowingDAO();
        }

        public function buyTicket($quantity,$idShowing){

            $buy = new Buy();
           
            
            $buy->setUser();
            $buy->getUser()->setId($_SESSION['loggedUser']->getId());
            $buy->setDate(date('Y-m-d'));

            $price = $this->showingDAO->GetPrice($idShowing);
            var_dump($price);

            if((date("D")=='Tue'||date("D")=='Wed')&&$quantity>=2){

                $buy->setDiscount(0.25);
                $buy->setTotal(($price*$quantity)*(1-($buy->getDiscount())));
            }
            else{

                $buy->setDiscount(0);
                $buy->setTotal(($price*$quantity));
            }
            $capacidad = $this->ticketDAO->CheckAvailability($idShowing);
            var_dump($capacidad);

            if(($this->ticketDAO->CheckAvailability($idShowing))>=$quantity){
                $idBuy = $this->buyDAO->Add($buy);
                for ($i=0; $i < $quantity; $i++) { 
                    $ticket = new Ticket();
                    $ticket->setQr('xD');
                    $ticket->setShowing();
                    $ticket->getShowing()->setIdShowing($idShowing);

                    $ticket->setBuy();
                    $ticket->getBuy()->setIdBuy($idBuy);

                    $this->ticketDAO->Add($ticket);
                }

            }
            //var_dump($this->ticketDAO->getAll());

            /*$idUser = $this->userDAO->GetIdByEmail($_SESSION["loggedUser"]->getEmail());
            $buy->setUser();
            $buy->getUser()->setId($idUser);
            $idBuy=$this->buyDAO->Add($buy);

            $buy->setIdBuy($idBuy);


            $ticket = new Ticket();
            $ticket->setQr('asdsadds');
            $ticket->setIdShowing($idShowing);
            $ticket->setIdBuy($idBuy);
            $showing = $this->showingDAO->GetById($idShowing);
            $result = $this->checkAvailability($showing);
            if($quantity<=$result){
                for ($i=0; $i < $quantity; $i++) { 
                $this->ticketDAO->Add($ticket);
            }
            $this->ShowReceip($buy);
            }else{
                require_once(VIEWS_PATH.'nav-user.php');
                echo("<br><br><br><br><br><br><H1 style='color:white;'>no quantity available!!</H1>");
            }*/
            
        }


    }



?>
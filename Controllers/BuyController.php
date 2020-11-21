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
            $buy->setQuantityTickets($quantity);
            $buy->setDate(date('Y-m-d'));

            $price = $this->showingDAO->GetPrice($idShowing);
            //var_dump($price);

            if((date("D")=='Tue'||date("D")=='Wed')&&$quantity>=2){

                $buy->setDiscount(0.25);
                $buy->setTotal(($price*$quantity)*(1-($buy->getDiscount())));
            }
            else{
                $buy->setDiscount(0);
                $buy->setTotal(($price*$quantity));
            }
            $capacidad = $this->ticketDAO->CheckAvailability($idShowing);
            //var_dump($capacidad);

            if(($this->ticketDAO->CheckAvailability($idShowing))>=$quantity){
                $this->redirigirForm($buy);
                $i=true;
            }
                if($i)
                {
                $idBuy = $this->buyDAO->Add($buy);
                for ($i=0; $i < $quantity; $i++) { 
                    $ticket = new Ticket();
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
        public function redirigirForm($buy){
            require_once(VIEWS_PATH.'receip.php');
        }
        public function registerCard(){
            require_once(VIEWS_PATH.'IngresarTarjeta.php');
        }
        public function ValidateCard($nombre,$cvv,$cardNumber,$mes,$año,$type)
        {

            $vencimiento=array($mes,$año);
            $vencimiento=implode("/",$vencimiento);
            var_dump($vencimiento);
            //var_dump($nombre);
            //var_dump($cvv);
            //var_dump($cardNumber);
            //var_dump($mes);
            //var_dump($año);
            //var_dump($type);

            
            if($this->validateCC($cardNumber, $type))
            {
                $message=$this->validateCC($cardNumber, $type);

            }
            //var_dump($denum);
        }

        function validateCC($cardNumber, $type) {  
            if($type == "Master")  
            { $denum = "Master Card";
              if (preg_match("/([5]{1})([0-9])/",$cardNumber) && ($this->calculateLenght($cardNumber) == 16  )  ) 
              { $verified = true; } 
              else { $verified = false; }
             } 
            elseif($type == "Visa") 
            {   
                $denum = "Visa";
                if (preg_match("/([4]{1})([0-9])/",$cardNumber) && (($this->calculateLenght($cardNumber) == 16 ) or  ($this->calculateLenght($cardNumber) == 13 )  ))
                { $verified = true; } 
                else { $verified = false; } 
                }
                if($verified == false)
                {  $message= "Credit card invalid. Please make sure that you entered a valid " . $denum . " credit card "; } 
                else { $message= "Your " . $denum . " credit card is valid"; } 
                return $message;
            }
            
            function calculateLenght($cardNumber){
                $number = (string)$cardNumber;
                $length = strlen($number);
                return $length;
            }

    }



?>
<?php namespace Controllers;

    use Models\Buy as Buy;
    use Models\Ticket as Ticket;
    use Models\Pay as Pay;

    use DAO\TicketDAO as TicketDAO;
    use DAO\BuyDAO as BuyDAO;
    use DAO\PayDAO as PayDAO;


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
        private $payDAO;

        public function __construct(){
            $this->ticketDAO = new TicketDAO();
            $this->buyDAO = new BuyDAO();
            $this->showingDAO = new ShowingDAO();
            $this->payDAO = new PayDAO();
        }

        public function showBuyListView(){
            $buyList = $this->buyDAO->GetAllByUser($_SESSION['loggedUser']->getId());
            require_once(VIEWS_PATH."receip.php");
        } 

        public function showTicketListView($idBuy){
            $ticketList = $this->ticketDAO->GetAllTicketByIdBuy($idBuy);
            require_once(VIEWS_PATH."ticket-list.php");
        } 

        public function buyTicket($quantity,$idShowing){

            $buy = new Buy();
           
            $buy->setUser();
            $buy->getUser()->setId($_SESSION['loggedUser']->getId());
            $buy->setDate(date('Y-m-d'));
            $buy->setQuantityTicket($quantity);

            $price = $this->showingDAO->GetPrice($idShowing);

            if((date("D")=='Tue'||date("D")=='Wed')&&$quantity>=2){

                $buy->setDiscount(0.25);
                $buy->setTotal(($price*$quantity)*(1-($buy->getDiscount())));
            }
            else{

                $buy->setDiscount(0);
                $buy->setTotal(($price*$quantity));
            }
            $capacidad = $this->ticketDAO->CheckAvailability($idShowing);

            if(($this->ticketDAO->CheckAvailability($idShowing))>=$quantity){

                    $idBuy = $this->buyDAO->Add($buy);
                    $this->showAddInfoTarjetaView($idShowing);
                }
            }

            
            
        public function showAddInfoTarjetaView($idShowing){
                require_once(VIEWS_PATH."IngresarTarjeta.php");
            }  

           
            public function ValidateCard($nombre,$cvv,$cardNumber,$mes,$type,$idShowing)
            {
    
                
                if($this->validateCC($cardNumber, $type)){
                    $pay = new Pay();
                    $pay->setDate(date("Y-m-d"));
                    
                    $buy = $this->buyDAO->GetBuyForId($this->buyDAO->GetLastBuy($_SESSION['loggedUser']->getId())); 
                    $pay->setTotal($buy->getTotal());

                    $this->payDAO->AcreditPay($pay,$buy->getIdBuy());
                    for ($i=0; $i < $buy->getQuantityTicket(); $i++) { 
                        $ticket = new Ticket();
                        $ticket->setShowing();
                        $ticket->getShowing()->setIdShowing($idShowing);

                        $ticket->setBuy();
                        $ticket->getBuy()->setIdBuy($buy->getIdBuy());

                        $this->ticketDAO->Add($ticket);
                        $this->ShowListTicketView();
                    }

                }else{
                    $message="Error, Credit card invalid. Please make sure that you entered a valid " . $denum . " credit card";
                    $scrip2="IngresarTarjeta.php";
                    include_once(VIEWS_PATH."Errors.php");
                }
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
                return $verified;
            }
            
            function calculateLenght($cardNumber){
                $number = (string)$cardNumber;
                $length = strlen($number);
                return $length;
            }
            
    }
        
        


    



?>
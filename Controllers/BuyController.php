<?php namespace Controllers;

    use Models\Buy as Buy;
    use Models\Ticket as Ticket;
    use Models\Pay as Pay;

    use DAO\TicketDAO as TicketDAO;
    use DAO\BuyDAO as BuyDAO;
    use DAO\PayDAO as PayDAO;


    use DAO\ShowingDAO as ShowingDAO;

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

        public function buyTicket($quantity,$idShowing){

            $buy = new Buy();
           
            $buy->setUser();
            $buy->getUser()->setId($_SESSION['loggedUser']->getId());
            $buy->setDate(date('Y-m-d'));
            $buy->setQuantityTicket($quantity);

            $_SESSION["Showing"] = $idShowing;

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

                var_dump($this->buyDAO->GetBuyForId($idBuy));
                $z = $this->buyDAO->GetLastBuy($_SESSION['loggedUser']->getId());
                //$this->showAddInfoTarjetaView();
                }
            }
        public function showAddInfoTarjetaView(){
                require_once(VIEWS_PATH."IngresarTarjeta.php");
            }  

            public function ValidateCard($nombre,$cvv,$cardNumber,$mes,$type)
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
                    $ticket->getShowing()->setIdShowing($_SESSION["Showing"]);

                    $ticket->setBuy();
                    $ticket->getBuy()->setIdBuy($buy->getIdBuy());
                    //var_dump($ticket);
                    $this->ticketDAO->Add($ticket);
                    $this->ShowListTicketView();
                }
            }else{
                $message="Error, Credit card invalid. Please make sure that you entered a valid " . $denum . " credit card";
                $scrip2="IngresarTarjeta.php";
                   include_once(VIEWS_PATH."Errors.php");
            }
        }

        public function ShowListTicketView()
           {
               require_once(VIEWS_PATH."validate-session.php");
               $ticketList =array();
               $ticketList =$this->ticketDAO->GetAllByIdUser($_SESSION['loggedUser']->getId(),$this->buyDAO->GetLastBuy($_SESSION['loggedUser']->getId()));
               $buy = $this->buyDAO->GetBuyForId($this->buyDAO->GetLastBuy($_SESSION['loggedUser']->getId())); 

               require_once(VIEWS_PATH."buy-list2.php");
           }

           public function ShowListBuyView(){
            require_once(VIEWS_PATH."validate-session.php");
            $buyList =array();
            $buyList =$this->buyDAO->GetAllByUser($_SESSION['loggedUser']->getId());
            //var_dump($buyList);
            require_once(VIEWS_PATH."buy-list.php");
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

            public function ShowListTicket($id){
                $buy=$this->buyDAO->GetBuyForId($id);
                if($buy->getPago()->getIdPay()!=0)
                {
                    $ticketList = array();
                    $ticketList = $this->ticketDAO->GetAllTicketByIdBuy($id);
                    require_once(VIEWS_PATH.'ticket-list.php');
                }
                else{
                    $message="No termino de pagar las entradas, sera redirigo a la pestaña para cargar la tarjeta de credito y acretar el pago";
                    $scrip2="IngresarTarjeta.php";
                    require_once(VIEWS_PATH.'errors.php');
                }
                
    
            }
    }
?>
<?php namespace Controllers;

    use Models\Buy as Buy;
    use Models\Ticket as Ticket;
    use Models\Pay as Pay;

    use DAO\TicketDAO as TicketDAO;
    use DAO\BuyDAO as BuyDAO;
    use DAO\PayDAO as PayDAO;
    use DAO\ShowingDAO as ShowingDAO;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once("vendor/autoload.php");

    use Endroid\QrCode\ErrorCorrectionLevel;
    use Endroid\QrCode\LabelAlignment;
    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\Response\QrCodeResponse;

    require_once("PHPMailer/Exception.php");
    require_once("PHPMailer/PHPMailer.php");
    require_once("PHPMailer/SMTP.php");


    use Controllers\CinemaController as CinemaController;
    use Controllers\UserController as UserController;

    class BuyController{

        private $ticketDAO;
        private $buyDAO;
        private $showingDAO;
        private $payDAO;

        private $CinemaController;
        private $UserController;


        public function __construct(){
            $this->ticketDAO = new TicketDAO();
            $this->buyDAO = new BuyDAO();
            $this->showingDAO = new ShowingDAO();
            $this->payDAO = new payDAO();

            $this->CinemaController = new CinemaController();
            $this->UserController = new UserController();
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

            if(($this->ticketDAO->CheckAvailability($idShowing))>=$quantity){
                $idBuy = $this->buyDAO->Add($buy);

                $z = $this->buyDAO->GetLastBuy($_SESSION['loggedUser']->getId());
                $this->showAddInfoTarjetaView();
                }
             else{
                 $showingList=$this->showingDAO->GetAll();
                 $showingList=$this->CinemaController->cargarShowings($showingList);
                 $message="Error, La cantidad de entradas que quiere comprar es incorrecta.Las entradas disponibles para esa funcion son :".$this->ticketDAO->CheckAvailability($idShowing)."";
                 $scrip2="showingListUser.php";
                 include_once(VIEWS_PATH."Errors.php");
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
                var_dump($pay);
                var_dump($buy->getIdBuy());


                var_dump($pay->getDate());
                var_dump($pay->getTotal());
                var_dump($buy->getIdBuy());

                $this->payDAO->AcreditPay($pay,$buy->getIdBuy());
//                $this->payDAO->AcreditPay($pay,$buy->getIdBuy());
    
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
               $nameT=array();
               $ticketList =array();
               $ticketList =$this->ticketDAO->GetAllByIdUser($_SESSION['loggedUser']->getId(),$this->buyDAO->GetLastBuy($_SESSION['loggedUser']->getId()));
               $buy = $this->buyDAO->GetBuyForId($this->buyDAO->GetLastBuy($_SESSION['loggedUser']->getId())); 
            


               $ticketList=$this->ticketDAO->GetAllTicketByIdBuy($buy->getIdBuy());
                foreach($ticketList as $ticket){
                    
                    
                    $nameM=$ticket->getShowing()->getMovie()->getTitle();
                    $nameC=$ticket->getShowing()->getRoom()->getCinema()->getName();
                    $nameR=$ticket->getShowing()->getRoom()->getNombre();
                    $nameD=$ticket->getShowing()->getDayTime();
                    array_push($nameT,$ticket->getIdTicket());

                    //$message2="Movie :" . $nameM.",Cinema :" .$nameC. ",Room :" .$nameR.  ",Day  :". $nameD.  ",Numero Ticket :".$nameT . "";
                    //array_push($QrList,$this->GenerateQrx2($message2));

                }
                var_dump($nameT);
                $numeroTicket=null;
                foreach($nameT as $result){
                    if($numeroTicket==null)
                    {
                        $numeroTicket=$result;
                    }
                    else{
                       $numeroTicket= $numeroTicket."/".$result; 
                    }
                }

               $message3="Movie :" . $nameM.",Cinema :" .$nameC. ",Room :" .$nameR.  ",Day  :". $nameD. ",Numeros Ticket :".$numeroTicket . "";
               echo($message3);  
               //var_dump($numeroTicket);  



               //$message2="Movie :" . $nameM.",Cinema :" .$nameC. ",Room :" .$nameR.  ",Day  :". $nameD.  ",Numero Ticket :".$nameT . "";

               //echo($message2);
                $correo=$_SESSION["loggedUser"]->getEmail();
               
                
               //$QrList=$this->GenerateQrx2($message2);
               //$this->CargarCorreo($correo);
               $message="La transaccion se completo con exito, en unos instantes le llegara un correo electronico con el codigo Qr para ingresar a la funcion";
               $scrip2="buy-list2.php";
               

               //require_once(VIEWS_PATH."Errors.php");

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

            public function GenerateQrx2($message){
                $qrCode = new QrCode($message);
                $qrCode->setSize(300);
                ini_set('display_errors', 1);
                error_reporting(E_ALL);
                $qrCode->setValidateResult(true);       
                $qrCode->writeFile('Qr/img/qrcode.png');
                
                return $qrCode;
            }

            public function CargarCorreo($correo,$QrList)
    {
        //$mail=null;
        //var_dump($mail);
        $mail = new PHPMailer();
        //var_dump($mail);

    try {
        //Server settings
        //var_dump("hola");
        $mail->SMTPDebug =SMTP::DEBUG_OFF;                    // Enable verbose debug output

        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = "ssl://smtp.gmail.com";   //buscar para hotmail.com or outlook.com                 // Set the SMTP server to send through
        "ssl://smtp.gmail.com";
        //'smtp1.gmail.com';
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'nicolasroldan31@gmail.com';                     // SMTP username
        $mail->Password   = "fernandamama";                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
//var_dump("hola");
        //Recipients
        $mail->setFrom('nicolasroldan31@gmail.com', 'Nicolas');
        $mail->addAddress("$correo");     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        //
        //echo FRONT_ROOT.VIEWS_PATH."img\pngwing.com.png"
        //
        // Attachments
        //$mail->addAttachment($QrList->);         // Add attachments
        //$mail->addAttachment('Qr\img\qrcode.png', 'new2.jpg');         // Add attachments
        //$mail->addAttachment('Views\img\pngwing.com.png', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Compra';   //asunto
        $mail->Body    = 'Escanee el Qr para ingresar a la funcion';
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        //var_dump($mail);
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    //var_dump($mail);
    }




    }
?>
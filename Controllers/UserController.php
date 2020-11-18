<?php 
    namespace Controllers;

    use Models\User as User;
    use DAO\UserDAO as UserDAO;
    
    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;

    // AGREGADO

    use DAO\GenderDAO as GenderDAO;
    use Models\Gender as Gender;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    use Endroid\QrCode\QrCode;

    //require 'PHPMailer/Exception.php';
    //require 'PHPMailer/PHPMailer.php';
    //require 'PHPMailer/SMTP.php';
    require_once("PHPMailer/Exception.php");
    require_once("PHPMailer/PHPMailer.php");
    require_once("PHPMailer/SMTP.php");
    //require_once("PHPMailerAutoload.php");

    //require 'PHPMailer/autoload.php';

    class UserController{

        private $userDAO;
        private $movieDAO;
        private $genderDAO;

        public function __construct(){
            $this->userDAO = new UserDAO();
            $this->movieDAO = new MovieDAO();
            $this->genderDAO = new GenderDAO();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }

        public function Register(){
            require_once(VIEWS_PATH."register.php");
        }

        public function Login($email, $password)
        {   
            
            $user = new User;
            $user = $this->userDAO->GetByEmail($email);

            if(($user != null) && ($user->getPassword() === $password))
            {
                $_SESSION["loggedUser"] = $user;
                $rol=$user->getRol();
                if($rol==2)
                {
                    $this->admin();
                }else
                {
                    $this->user();
                }
            
            }else{
                $this->Index("Usuario y/o Contraseña incorrectos");
            }       
        }
        
        public function admin(){
            require_once(VIEWS_PATH."registerCinema.php");
        }

        public function user(){
            //$this->user();
            //$this->CargarCorreo($user->getEmail());
            $qrCode = new QrCode('Life is too short to be generating QR codes');

            header('Content-Type: '.$qrCode->getContentType());
            echo $qrCode->writeString();
            $movieList = $this->movieDAO->GetAllForShowingActivas();
            $genderList = $this->genderDAO->GetAll();
            //require_once(VIEWS_PATH."billboardMovie.php");


        }

        public function ShowMovies(){
            $movieList = $this->movieDAO->GetAll();
            require_once(VIEWS_PATH.'movie-list2.php');
        }
        


        public function logverify($email,$password,$userName,$firstName,$lastName,$dni) {
            if ($this->userDAO->readEmail($email)) {
                echo '<script language="javascript">alert("Ya hay un usuario registrado con ese Email");</script>';
                require ("views/home.php");
            }
            else {
                if($this->userDAO->readDni($dni)){
                echo '<script language="javascript">alert("Ya hay un usuario registrado con ese Dni");</script>';
                require ("views/home.php");
                }
                else {
                $this->Add($email,$password,$userName,$firstName,$lastName,$dni);
                }
            }
        }

        public function Add($email,$password,$userName,$firstName,$lastName,$dni)
        {
            //seteamos los parametros del user
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setRol(1);
            $user->setUserName($userName);
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setDni($dni);
            //var_dump($user);

            $this->userDAO->Add($user);
            
            $this->Login($user->getEmail(),$user->getPassword());
        }


    public function CargarCorreo($correo)
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
        $mail->addAddress("$correo", 'Nicolas');     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        //
        //echo FRONT_ROOT.VIEWS_PATH."img\pngwing.com.png"
        //
        // Attachments
        $mail->addAttachment('Views\img\pngwing.com.png');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'weeeeee';   //asunto
        $mail->Body    = 'hola <b>xD</b>';
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
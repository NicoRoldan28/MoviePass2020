<?php 
    namespace Controllers;

    use Models\User as User;
    use DAO\UserDAO as UserDAO;
    
    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;

    // AGREGADO

    use DAO\GenderDAO as GenderDAO;
    use Models\Gender as Gender;

    use PHPMailer\PHPMailer;
    use PHPMailer\Exception;

    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

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
            $this->CargarCorreo();
            $movieList = $this->movieDAO->GetAllForShowingActivas();
            $genderList = $this->genderDAO->GetAll();
            require_once(VIEWS_PATH."billboardMovie.php");


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


    public function CargarCorreo()
    {
        $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp1.gmail.com';   //buscar para hotmail.com or outlook.com                 // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'nicolasroldan31@gmail.com';                     // SMTP username
        $mail->Password   = 'fernandamama28';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('nicolasroldan31@gmail.com', 'Nicolas');
        $mail->addAddress('nicolasroldan31@gmail.com', 'Nicolas');     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    }
}
?>
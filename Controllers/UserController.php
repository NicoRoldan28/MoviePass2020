<?php 
    namespace Controllers;

    use Models\User as User;
    use DAO\UserDAO as UserDAO;
    
    use DAO\MovieDAO as MovieDAO;
    use Models\Movie as Movie;

    // AGREGADO

    use DAO\GenderDAO as GenderDAO;
    use Models\Gender as Gender;


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

        public function FacebookAdd()
        {
            include_once("fb-signup.php");

            if($user!=null){
                $this->Add($user->getFirstName(), $user->getLastName(), "0", $user->getEmail(), $user->getId() );
            }
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

        public function FacebookLogin()
    {
        include_once("loginFacebook.php");
        if($user!=null)
        {
            $this->Login($user->getEmail(), $user->getId());
        }
    }
        
        public function admin(){
            require_once(VIEWS_PATH."registerCinema.php");
        }

        public function user(){
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
    }
?>
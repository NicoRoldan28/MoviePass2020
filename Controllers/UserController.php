<?php 
    namespace Controllers;

    use Models\User as User;
    use DAO\UserDAO as UserDAO;
    
    class UserController{

        private $userDAO;

        public function __construct(){
            $this->userDAO = new UserDAO();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }

        public function Register(){
            //echo "eeeeeeeeee";
            require_once(VIEWS_PATH."register.php");
        }

        public function Login($email, $password)
        {
            $user = new User;
            $user = $this->userDAO->GetByEmail($email);

            if(($user != null) && ($user->getPassword() === $password))
            {
                $_SESSION["loggedUser"] = $user;
                //$this->ShowListView();
                $rol=$user->getRol();
                if($rol==2)
                {
                    require_once(VIEWS_PATH."registerCinema.php");
                }
                /*else{
                    require_once(VIEWS_PATH."menuClient.php");


                    //$this->ShowBillboard();
                }*/
            }
            else
                $this->Index("Usuario y/o Contraseña incorrectos");
        }


        public function logverify($email,$password,$userName,$firstName,$lastName,$dni) {
            if ($this->userDAO->read($email)) {
                $msg = "Ya hay un usuario registrado con ese email.";
                echo $msg;
                require ("views/home.php");
            } else {
                $this->Add($email,$password,$userName,$firstName,$lastName,$dni);
            }
        }

        public function Add($email,$password,$userName,$firstName,$lastName,$dni)
        {
            //require_once(VIEWS_PATH."validate-session.php")
            
            //$perfil= new PerfilUser();

            //seteamos los parametros del perfilUser
            /*$perfilUser = new PerfilUser();
            $perfilUser->setUserName($userName);
            $perfilUser->setFirstName($firstName);
            $perfilUser->setLastName($lastName);
            $perfilUser->setDni($dni);*/

            //agregamos a la base de datos el perfilUser y lo mostramos
            //$this->perfilUserDAO->Add($perfilUser);
            //var_dump($perfilUser);

            //buscamos el perfilUser con determinado dni
            //$perfil=$this->perfilUserDAO->getByDni($dni);
            //var_dump($perfil);

            //seteamos los parametros del user
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($password);
            //$user->setRol(1);
            $user->setUserName($userName);
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setDni($dni);
            var_dump($user);

            //$user->setId_perfilUser($perfil->getId());

            //mostramos el user
            $this->userDAO->Add($user);
            
            $this->Index();
        }
    }
?>
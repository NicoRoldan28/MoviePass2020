<?php 

    namespace Controllers;

    use Models\User as User;
    use DAO\UserDAO as UserDAO;

    class HomeController{
        
        private $userDAO;

        public function __construct(){

            $this->userDAO = new UserDAO();
        }

        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }
        public function Logout()
        {
            session_destroy();

            $this->Index();
        }
        
    }
    
?>
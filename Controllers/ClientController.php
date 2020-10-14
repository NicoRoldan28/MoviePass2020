<?php 

    namespace Controllers;

    use Models\User as User;
    use DAO\UserDAO as UserDAO;

    class ClientController{
        
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }
        

        
    }
    



?>
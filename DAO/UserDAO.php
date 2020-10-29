<?php 

    namespace DAO;
    use Models\User as User;
    use Models\PerfilUser as PerfilUser;

    use \Exception as Exception;
    use DAO\Connection as Connection;

    class UserDAO {

        private $connection;
        private $tableUsers = "users";
        private $tablePerfilUsers = "perfilUsers";

        public function Add(User $user){
            try
            {
                $procedure = "call CargarUserClient(:user_name,:firstName,:lastName,:dni,:email,:password);";

                $parameters["user_name"] = $user->getUserName();
                $parameters["firstName"] = $user->getFirstName();
                $parameters["lastName"] = $user->getLastName();
                $parameters["dni"] = $user->getDni();
                $parameters["email"] = $user->getEmail();
                $parameters["password"] = $user->getPassword();

                $this->connection = Connection::GetInstance();

                
                $this->connection->ExecuteNonQuery($procedure,$parameters);
                
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
        }

        public function readEmail($email)
        {
            try {
                $user = null;

            $query = "SELECT * FROM ".$this->tableUsers." WHERE (email = :email)";

            $parameters["email"] = $email;

            $this->connection = Connection::GetInstance();

            $results=$this->connection->Execute($query, $parameters);

            foreach($results as $row)
            {
                $user = new User();
                //$user->setId_user($row["id"]);
                $user->setEmail($row["email"]);
                $user->setPassword($row["password"]);
            }
            if($user==null)
                $verific=false;
            else
                $verific=true;

                
            return $verific;
            } catch (Exception $th) {
                throw $th;
            }    
        }
        public function readDni($dni)
        {
            try {
                $perfilUser = null;

            $query = "SELECT * FROM ".$this->tablePerfilUsers." WHERE (dni = :dni)";

            $parameters["dni"] = $dni;

            $this->connection = Connection::GetInstance();

            $results=$this->connection->Execute($query, $parameters);

            foreach($results as $row)
            {
                $perfilUser = new PerfilUser();
                //$user->setId_user($row["id"]);
                $perfilUser->setDni($row["dni"]);
            }
            if($perfilUser==null)
                $verific=false;
            else
                $verific=true;

                
            return $verific;
            } catch (Exception $th) {
                throw $th;
            }    
        }

        public function GetByEmail($email)
        {
            try {
                $user = null;

            $query = "SELECT email, password,id_rol FROM ".$this->tableUsers." WHERE (email = :email)";

            $parameters["email"] = $email;

            $this->connection = Connection::GetInstance();

            $results = $this->connection->Execute($query, $parameters);

            foreach($results as $row)
            {
                $user = new User();
                //$user->setId_user($row["id"]);
                $user->setEmail($row["email"]);
                $user->setPassword($row["password"]);
                $user->setRol($row["id_rol"]);
                //echo($row["id_rol"]);
            }

            return $user;
            } catch (Exception $th) {
                throw $th;
            }

        }


    }


?>
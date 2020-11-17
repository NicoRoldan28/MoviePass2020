<?php 

    namespace Models;
    use Models\PerfilUser as PerfilUser;

    class User extends PerfilUser{
        
        private $id;
        private $email;
        private $password;
        private $rol;
        //private $id_PerfilUser;
        
        public function setId($id){$this->id = $id;}
        public function getId(){return $this->id;}

        public function setEmail($email){$this->email=$email;}
        public function getEmail(){return $this->email;}

        public function setPassword($password){$this->password=$password;}
        public function getPassword(){return $this->password;}

        public function setRol($rol){$this->rol=$rol;}
        public function getRol(){return $this->rol;}
        
        //public function setId_PerfilUser($id_PerfilUser){$this->id_PerfilUser=$id_PerfilUser;}
        //public function getId_PerfilUser(){return $this->id_PerfilUser;}

        
        //public function setId_user($id_user){$this->id_user=$id_user;}

    }
?>
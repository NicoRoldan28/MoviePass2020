<?php

    namespace Models;

    class PerfilUser{
        //public $id;
        private $userName;
        private $firstName;
        private $lastName;
        private $dni;

        //function _construct($id,$userName,$firstName,$lastName,$dni)

        //public function setId($id){$this->id=$id;}
        //public function getId(){return $this->id;}

        public function setUserName($userName){$this->userName=$userName;}
        public function getUserName(){return $this->userName;}

        public function setFirstName($firstName){$this->firstName=$firstName;}
        public function getFirstName(){return $this->firstName;}

        public function setLastName($lastName){$this->lastName=$lastName;}
        public function getLastName(){return $this->lastName;}

        public function setDni($dni){$this->dni=$dni;}
        public function getDni(){return $this->dni;}

    }

?>
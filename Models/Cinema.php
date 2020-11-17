<?php
        namespace Models;
        class Cinema{
            private $id;
            private $adress;
            private $name;

            public function setId($id){$this->id=$id;}
            public function getId(){return $this->id;}

            public function setAdress($adress){$this->adress=$adress;}
            public function getAdress(){return $this->adress;}

            public function setName($name){$this->name=$name;}
            public function getName(){return $this->name;}


        }

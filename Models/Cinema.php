<?php
        namespace Models;
        class Cinema{
            private $id;
            private $adress;
            private $name;
            private $price_ticket;

            public function setId($id){$this->id=$id;}
            public function getId(){return $this->id;}

            public function setAdress($adress){$this->adress=$adress;}
            public function getAdress(){return $this->adress;}

            public function setName($name){$this->name=$name;}
            public function getName(){return $this->name;}

            public function setPrice_ticket($price_ticket){$this->price_ticket=$price_ticket;}
            public function getPrice_ticket(){return $this->price_ticket;}

            public function setRooms($rooms){$this->rooms=$rooms;}
            public function getRooms(){return $this->rooms;}

        }

<?php namespace Models;

    use Models\Cinema as Cinema;

    class Room{
        private $id;
        private $nombre;
        private $price_ticket;
        private $capacidad;
        private $cinema;

        public function setId($id){$this->id=$id;}
        public function getId(){return $this->id;}

        public function setNombre($nombre){$this->nombre=$nombre;}
        public function getNombre(){return $this->nombre;}

        public function setPrice_ticket($price_ticket){$this->price_ticket=$price_ticket;}
        public function getPrice_ticket(){return $this->price_ticket;}

        public function setCapacidad($capacidad){$this->capacidad=$capacidad;}
        public function getCapacidad(){return $this->capacidad;}

        public function setCinema(){$this->cinema= new Cinema();}
        public function getCinema(){return $this->cinema;}

    }
?>
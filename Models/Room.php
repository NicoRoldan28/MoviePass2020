<?php namespace Models;

    use Models\Cinema as Cinema;

    class Room{
        private $id;
        private $nombre;
        private $capacidad;
        private $cinema;

        public function setId($id){$this->id=$id;}
        public function getId(){return $this->id;}

        public function setNombre($nombre){$this->nombre=$nombre;}
        public function getNombre(){return $this->nombre;}

        public function setCapacidad($capacidad){$this->capacidad=$capacidad;}
        public function getCapacidad(){return $this->capacidad;}

        public function setCinema($cinema){$this->cinema=$cinema;}
        public function getCinema(){return $this->cinema;}

    }
?>
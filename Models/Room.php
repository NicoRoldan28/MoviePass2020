<?php namespace Models;

    class Room{
        private $id;
        private $nombre;
        private $capacidad;
        private $id_Cine;

        public function setId($id){$this->id=$id;}
        public function getId(){return $this->id;}

        public function setNombre($nombre){$this->nombre=$nombre;}
        public function getNombre(){return $this->nombre;}

        public function setCapacidad($capacidad){$this->capacidad=$capacidad;}
        public function getCapacidad(){return $this->capacidad;}

        public function setIdCine($id_Cine){$this->id_Cine=$id_Cine;}
        public function getIdCine(){return $this->id_Cine;}

    }
?>

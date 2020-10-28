<?php namespace Models;

    class Room{
        private $id;
        private $nombre;
        private $capacidad;
<<<<<<< HEAD
        private $id_Cine;
=======
        //private $id_Cine;
        private $showings = array();
>>>>>>> Rodrigo

        public function setId($id){$this->id=$id;}
        public function getId(){return $this->id;}

        public function setNombre($nombre){$this->nombre=$nombre;}
        public function getNombre(){return $this->nombre;}

        public function setCapacidad($capacidad){$this->capacidad=$capacidad;}
        public function getCapacidad(){return $this->capacidad;}

<<<<<<< HEAD
        public function setIdCine($id_Cine){$this->id_Cine=$id_Cine;}
        public function getIdCine(){return $this->id_Cine;}
=======
        //public function setIdCine($id_Cine){$this->id_Cine=$id_Cine;}
        //public function getIdCine(){return $this->id_Cine;}

        public function setShowings($showings){$this->showings=$showings;}
        public function getShowings(){return $this->showings;}
>>>>>>> Rodrigo

    }
?>

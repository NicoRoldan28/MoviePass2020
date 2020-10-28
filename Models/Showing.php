<?php namespace Models;

    class Showing
    {
        private $idShowing;
        private $dayTime;
        private $idMovie;
        private $idRoom;
        private $idTurn;

        public function setIdShowing($idShowing){$this->idShowing=$idShowing;}
        public function getIdShowing(){return $this->idShowing;}

        public function setDayTime($dayTime){$this->dayTime=$dayTime;}
        public function getDayTime(){return $this->dayTime;}

        public function setIdMovie($idMovie){$this->idMovie=$idMovie;}
        public function getIdMovie(){return $this->idMovie;}

        public function setIdRoom($idRoom){$this->idRoom=$idRoom;}
        public function getIdRoom(){return $this->idRoom;}

        public function setIdTurn($idTurn){$this->idTurn=$idTurn;}
        public function getIdTurn(){return $this->idTurn;}
    }
    
?>
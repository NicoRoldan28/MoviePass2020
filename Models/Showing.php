<?php namespace Models;

    class Showing
    {
        private $idShowing;
        private $dayTime;
        private $Movie;
        //private $idRoom;
        private $Turn;

        public function setIdShowing($idShowing){$this->idShowing=$idShowing;}
        public function getIdShowing(){return $this->idShowing;}

        public function setDayTime($dayTime){$this->dayTime=$dayTime;}
        public function getDayTime(){return $this->dayTime;}

        public function setMovie($Movie){$this->Movie=$Movie;}
        public function getMovie(){return $this->Movie;}

        //public function setIdRoom($idRoom){$this->idRoom=$idRoom;}
        //public function getIdRoom(){return $this->idRoom;}

        public function setTurn($Turn){$this->Turn=$Turn;}
        public function getTurn(){return $this->Turn;}
    }
    
?>
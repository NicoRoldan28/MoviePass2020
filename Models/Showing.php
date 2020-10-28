<?php namespace Models;

    use Models\Room as Room;


    class Showing
    {
        private $idShowing;
        private $dayTime;
        private $Movie;
        private Room $room;
  
        public function setIdShowing($idShowing){$this->idShowing=$idShowing;}
        public function getIdShowing(){return $this->idShowing;}

        public function setDayTime($dayTime){$this->dayTime=$dayTime;}
        public function getDayTime(){return $this->dayTime;}

        public function setMovie($Movie){$this->Movie=$Movie;}
        public function getMovie(){return $this->Movie;}

        public function setRoom($room){$this->room=$room;}
        public function getRoom(){return $this->room;}

    }
    
?>
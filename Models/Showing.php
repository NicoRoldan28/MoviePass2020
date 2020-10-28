<?php namespace Models;

    use Models\Room as Room;

    class Showing
    {
        private $idShowing;
        private $dayTime;
        private $idMovie;
        private $room;
        private $hrStart;
        private $hrFinish;
  
        public function setIdShowing($idShowing){$this->idShowing=$idShowing;}
        public function getIdShowing(){return $this->idShowing;}

        public function setDayTime($dayTime){$this->dayTime=$dayTime;}
        public function getDayTime(){return $this->dayTime;}

        public function setidMovie($idMovie){$this->idMovie=$idMovie;}
        public function getidMovie(){return $this->idMovie;}

        public function setRoom(Room $room){$this->room=$room;}
        public function getRoom(){return $this->room;}

        public function setHrStart($hrStart){$this->hrStart=$hrStart;}
        public function getHrStart(){return $this->hrStart;}

        public function setHrFinish($hrFinish){$this->hrFinish=$hrFinish;}
        public function getHrFinish(){return $this->hrFinish;}

    }
    
?>
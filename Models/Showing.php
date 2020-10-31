<?php namespace Models;

    use Models\Room as Room;
    use Models\Movie as Movie;

    class Showing
    {
        private $idShowing;
        private $dayTime;
        private $movie;
        private $room;
        private $hrFinish;
  
        public function setIdShowing($idShowing){$this->idShowing=$idShowing;}
        public function getIdShowing(){return $this->idShowing;}

        public function setDayTime($dayTime){$this->dayTime=$dayTime;}
        public function getDayTime(){return $this->dayTime;}

        public function setMovie(){$this->movie= new Movie();}
        public function getMovie(){return $this->movie;}

        public function setRoom(){$this->room = new Room();}
        public function getRoom(){return $this->room;}

        public function setHrFinish($hrFinish){$this->hrFinish=$hrFinish;}
        public function getHrFinish(){return $this->hrFinish;}

    }
    
?>
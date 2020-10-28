<?php namespace Models;

<<<<<<< HEAD
=======
    use Models\Room as Room;


>>>>>>> Rodrigo
    class Showing
    {
        private $idShowing;
        private $dayTime;
<<<<<<< HEAD
        private $idMovie;
        private $idRoom;
        private $idTurn;

=======
        private $Movie;
        private Room $room;
  
>>>>>>> Rodrigo
        public function setIdShowing($idShowing){$this->idShowing=$idShowing;}
        public function getIdShowing(){return $this->idShowing;}

        public function setDayTime($dayTime){$this->dayTime=$dayTime;}
        public function getDayTime(){return $this->dayTime;}

<<<<<<< HEAD
        public function setIdMovie($idMovie){$this->idMovie=$idMovie;}
        public function getIdMovie(){return $this->idMovie;}

        public function setIdRoom($idRoom){$this->idRoom=$idRoom;}
        public function getIdRoom(){return $this->idRoom;}

        public function setIdTurn($idTurn){$this->idTurn=$idTurn;}
        public function getIdTurn(){return $this->idTurn;}
=======
        public function setMovie($Movie){$this->Movie=$Movie;}
        public function getMovie(){return $this->Movie;}

        public function setRoom($room){$this->room=$room;}
        public function getRoom(){return $this->room;}

>>>>>>> Rodrigo
    }
    
?>
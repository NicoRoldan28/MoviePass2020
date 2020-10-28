<?php namespace Models;
    class Turn{
        private $id;
        private $hrStart;
        private $hrFinish;

        public function setId($id){$this->id=$id;}
        public function getId(){return $this->id;}

        public function setHrStart($hrStart){$this->hrStart=$hrStart;}
        public function getHrStart(){return $this->hrStart;}

        public function setHrFinish($hrFinish){$this->hrFinish=$hrFinish;}
        public function getHrFinish(){return $this->hrFinish;}
    }
?>
<?php 
    namespace Models;
    class Movie{
        private $id;
        private $budget ;
        private $title;
        private $image;
        private $lenguage;
        private $genders = array();

        function __construct($id,$budget ,$title,$image,$lenguage/*,$generos*/){
           $this->setId($id);
           $this->setBudget($budget);
           $this->setTitle($title);
           $this->setImage($image);
           $this->setLenguage($lenguage);
           //$this->setGenders($genders);
        }

        public function setId($id){$this->id=$id;}
        public function getId(){return $this->id;}

        public function setBudget($budget){$this->budget=$budget;}
        public function getBudget(){return $this->budget;}

        public function setTitle($title){$this->title=$title;}
        public function getTitle(){return $this->title;}

        public function setImage($image){$this->image=$image;}
        public function getImage(){return $this->image;}

        public function setLenguage($lenguage){$this->lenguage=$lenguage;}
        public function getLenguage(){return $this->lenguage;}

        public function setGenders($genders){$this->genders=$genders;}
        public function getGenders(){return $this->genders;}
    }
?>
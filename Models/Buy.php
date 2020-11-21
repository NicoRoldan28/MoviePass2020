<?php namespace Models;

    use Models\User as User;


    class Buy{
        private $idBuy;
        private $quantityTickets;
        private $date;
        private $discount;
        private $total;
        private $User;

        public function setUser(){$this->User= new User();}
        public function getUser(){return $this->User;}

        public function setIdBuy($idBuy){$this->idBuy=$idBuy;}
        public function getIdBuy(){return $this->idBuy;}

        public function setQuantityTickets($quantityTickets){$this->quantityTickets=$quantityTickets;}
        public function getQuantityTickets(){return $this->quantityTickets;}

        public function setDate($date){$this->date=$date;}
        public function getDate(){return $this->date;}

        public function setDiscount($discount){$this->discount=$discount;}
        public function getDiscount(){return $this->discount;}

        public function setTotal($total){$this->total=$total;}
        public function getTotal(){return $this->total;}

    }
?>
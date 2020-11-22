<?php namespace Models;

    use Models\User as User;
    use Models\Pay as Pay;

    class Buy{
        private $idBuy;
        private $quantityTicket;
        private $date;
        private $discount;
        private $total;
        private $pago;
        private $User;

        public function setUser(){$this->User= new User();}
        public function getUser(){return $this->User;}

        public function setPago(){$this->pago= new Pay();}
        public function getPago(){return $this->pago;}

        public function setIdBuy($idBuy){$this->idBuy=$idBuy;}
        public function getIdBuy(){return $this->idBuy;}

        public function setQuantityTicket($quantityTicket){$this->quantityTicket=$quantityTicket;}
        public function getQuantityTicket(){return $this->quantityTicket;}

        public function setDate($date){$this->date=$date;}
        public function getDate(){return $this->date;}

        public function setDiscount($discount){$this->discount=$discount;}
        public function getDiscount(){return $this->discount;}

        public function setTotal($total){$this->total=$total;}
        public function getTotal(){return $this->total;}

    }
?>
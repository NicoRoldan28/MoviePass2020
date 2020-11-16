<?php namespace Models;

    use Models\Showing as Showing;
    use Models\Buy as Buy;

    class Ticket{
        private $idTicket;
        private $qr;
        private $Showing;
        private $Buy;

        public function setIdTicket($idTicket){$this->idTicket=$idTicket;}
        public function getIdTicket(){return $this->idTicket;}

        public function setQr($qr){$this->qr=$qr;}
        public function getQr(){return $this->qr;}

        public function setShowing(){$this->Showing = new Showing(); }
        public function getShowing(){return $this->Showing;}

        public function setBuy(){$this->Buy = new Buy();}
        public function getBuy(){return $this->Buy;}
    }
?>
<?php namespace Models;

    class Pay{
        private $idPay;
        private $date;
        private $total;
        private $codeAut;
        private $idAccount;

        public function setIdPay($idPay){$this->idPay=$idPay;}
        public function getIdPay(){return $this->idPay;}

        public function setDate($date){$this->date=$date;}
        public function getDate(){return $this->date;}

        public function setTotal($total){$this->total=$total;}
        public function getTotal(){return $this->total;}

        public function setCodeAut($codeAut){$this->codeAut=$codeAut;}
        public function getCodeAut(){return $this->codeAut;}

        public function setIdAccount($idAccount){$this->idAccount=$idAccount;}
        public function getIdAccount(){return $this->idAccount;}
        
    }
    
?>
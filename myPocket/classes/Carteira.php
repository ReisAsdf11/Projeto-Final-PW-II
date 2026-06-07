<?php
    declare(strict_types=1);

    class Carteira{
        private $saldo;
        private $transacoes;

        public function __construct(){
            $this->saldo = 500;
            $this->transacoes = [];
        }

        public function getSaldo(){
            return $this->saldo;
        }

        public function getTransacoes(){
            return $this->transacoes;
        }

        public function transferir($valor){
            if($valor instanceof Receita){
                $this->saldo += $valor->getValor();
            } elseif($valor instanceof Despesa){
                if($this->saldo < $valor->getValor()){
                        throw new Exception("Saldo insuficiente");
                    } else {
                        $this->saldo -= $valor->getValor();
                    }
            }
            $this->transacoes[] = $valor;
        }
    }
?>
<?php
    declare(strict_types=1);

    abstract class Transacao{
        protected $valor;
        protected $data;
        protected $descricao;

        function __construct($valor, $data, $descricao){
            $this->valor = $valor;
            $this->data = $data;
            $this->descricao = $descricao;
        }

        public function getValor(){
            return $this->valor;    
        }

        public function getData(){
            return $this->data;
        }
        
        public function getDescricao(){
            return $this->descricao;
        }

        abstract public function getTipo();
    }

?>
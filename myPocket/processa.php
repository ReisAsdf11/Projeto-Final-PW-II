<?php

    session_start();

    require_once 'classes/Carteira.php';
    require_once 'classes/Receita.php';
    require_once 'classes/Despesa.php';

    if (!isset($_SESSION['carteira'])) {
        $_SESSION['carteira'] = new Carteira();
        }
        
    $carteira = $_SESSION['carteira'];

    try {

        $valor = $_POST['valor'];
        $data = $_POST['data'];
        $descricao = $_POST['descricao'];
        $tipo = $_POST['tipo'];

        if ($tipo == "receita") {
            $transacao = new Receita($valor, $data, $descricao);
        } else {
            $transacao = new Despesa($valor, $data, $descricao);
        }
        $carteira->transferir($transacao);

    } catch (Exception $e) {

        $_SESSION['erro'] = $e->getMessage();
    }
    $_SESSION['carteira'] = $carteira;

    header("Location: index.php");
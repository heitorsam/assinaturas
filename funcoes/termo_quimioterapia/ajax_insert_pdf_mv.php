<?php

    //INICIANDO CONEXÃO
    include '../../conexao.php';

    //RECEBENDO ARQUIVO PDF
    $pdf = $_FILES['pdf'];

    //DADOS DO ARQUIVO
    $nomeDoArquivo = $pdf['name'];
    $tipoDoArquivo = $pdf['type'];
    $caminhoTemporario = $pdf['tmp_name'];
    $tamanhoDoArquivo = $pdf['size'];
    
?>
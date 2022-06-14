<?php 
    session_start();

    //ACESSO RESTRITO
    include 'acesso_restrito.php';

    //CONEXAO
    include 'conexao.php'; 

    //RECEBENDO SESSAO
    $var_cd_usuario = $_SESSION['usuarioLogin'];

    //////////////////
    //DADOS VIA POST//
    //////////////////

    echo 'cd_atendimento: ';
     $cd_atendimento = $_POST['cd_atendimento'];
    echo '</br>';
  

    //////////
    //UPDATE//
    //////////
    
    $cons_recusa="UPDATE ASSINATURAS.documentos_assinados
                    SET TP_DOCUMENTO = 'same_recusado'
                    WHERE CD_ATENDIMENTO = $cd_atendimento
    ";
    $result_recusa= oci_parse($conn_ora, $cons_recusa);
    oci_execute($result_recusa);



?>

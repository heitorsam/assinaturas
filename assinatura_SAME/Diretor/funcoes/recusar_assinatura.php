<?php 
    session_start();

    //ACESSO RESTRITO
    include '../../../acesso_restrito.php';

    //CONEXAO
    include '../../../conexao.php'; 

    //RECEBENDO SESSAO
    $var_cd_usuario = $_SESSION['usuarioLogin'];

    //////////////////
    //DADOS VIA POST//
    //////////////////

    echo 'cd_paciente: ';
     $cd_paciente = $_POST['cd_paciente'];
    echo '</br>';
  

    //////////
    //UPDATE//
    //////////
    
    $cons_recusa="UPDATE assinaturas.DOCUMENTOS_ASSINADOS_SAME
                    SET TP_DOCUMENTO = 'same_recusado'
                    WHERE CD_PACIENTE = $cd_paciente
    ";
    $result_recusa= oci_parse($conn_ora, $cons_recusa);
    oci_execute($result_recusa);



?>

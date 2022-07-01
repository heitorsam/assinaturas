<?php 
    //CONEXAO
    include '../../../../conexao.php';

    'cd_arquivo_documento:';
    $cd_arquivo_documento = $_POST["cd_arquivo_documento"]; 
    '<br>';
    
    //////////
    //DELETE//
    //////////
    $cons_cad_subs="DELETE assinaturas.ARQUIVO_DOCUMENTO_SAME WHERE CD_ARQUIVO_DOCUMENTO = $cd_arquivo_documento ";
    $result_cad_subs= oci_parse($conn_ora, $cons_cad_subs);
    oci_execute($result_cad_subs);

?>
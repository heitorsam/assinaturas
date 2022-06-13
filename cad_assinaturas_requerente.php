<?php
session_start();	

//CONEXAO
include 'conexao.php';

@$var_cd_paciente = $_POST['cd_paciente'];

$image = $_POST['escondidinho'];

$var_user_logado = $_SESSION['usuarioLogin'];

//echo $_POST['escondidinho'];

 // get the dataURL
 $dataURL = $_POST["escondidinho"];  

 // the dataURL has a prefix (mimetype+datatype) 
 // that we don't want, so strip that prefix off
 $parts = explode(',', $dataURL);  
 $data = $parts[1];  

 // Decode base64 data, resulting in an image
 $image = base64_decode($data); 



$consult_delete = "DELETE FROM assinaturas.ASSINATURA_PACIENTE WHERE CD_PACIENTE = $var_cd_paciente";
$deleta_dados = oci_parse($conn_ora, $consult_delete);
oci_execute($deleta_dados);

$consulta_insert = 
"INSERT INTO assinaturas.ASSINATURA_PACIENTE
(CD_PACIENTE, DT_COLETA, CD_USUARIO_COLETA, ASSINATURA_PACIENTE)
VALUES 
($var_cd_paciente, SYSDATE,'$var_user_logado', empty_blob()) 
RETURNING ASSINATURA_PACIENTE INTO :image";

//echo $consulta_insert;
$insere_dados = oci_parse($conn_ora, $consulta_insert);
$blob = oci_new_descriptor($conn_ora, OCI_D_LOB);
oci_bind_by_name($insere_dados, ":image", $blob, -1, OCI_B_BLOB);

oci_execute($insere_dados, OCI_DEFAULT);

if(!$blob->save($image)) {
    oci_rollback($conn_ora);
}
else {
    oci_commit($conn_ora);
}

oci_free_statement($insere_dados);
$blob->free();


?>

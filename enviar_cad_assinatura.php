<?php
session_start();	

//CONEXAO
include 'conexao.php';

@$var_cd_prestador = $_POST['frm_cd_prestador'];

$image = $_POST['escondidinho'];

//echo $_POST['escondidinho'];

 // get the dataURL
 $dataURL = $_POST["escondidinho"];  

 // the dataURL has a prefix (mimetype+datatype) 
 // that we don't want, so strip that prefix off
 $parts = explode(',', $dataURL);  
 $data = $parts[1];  

 // Decode base64 data, resulting in an image
 $image = base64_decode($data); 

@$_SESSION['prestconsulta'] = $var_cd_prestador;
$var_user_logado = $_SESSION['usuarioNome'];

$consult_delete = "DELETE FROM dbamv.prestador_assinatura WHERE CD_PRESTADOR = $var_cd_prestador";
$deleta_dados = oci_parse($conn_ora, $consult_delete);
oci_execute($deleta_dados);

/*
    $consulta_long_raw = "INSERT INTO dbamv.PRESTADOR_ASSINATURA
                        (CD_PRESTADOR, ASSINATURA)
                        VALUES 
                        ('$var_cd_prestador',utl_raw.cast_to_raw('$image'))";
    $insere_dados = oci_parse($conn_ora, $consulta_long_raw);
    oci_execute($insere_dados);
*/

$consulta_insert = 
"INSERT INTO dbamv.PRESTADOR_ASSINATURA
(CD_PRESTADOR, ASSINATURA_TISS)
VALUES 
('$var_cd_prestador',empty_blob()) 
RETURNING ASSINATURA_TISS INTO :image";

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


//echo "</br></br>";
//SQL BUSCA ASSINATURA
$cons_assinatura_prest = "SELECT ASSINATURA_TISS, ASSINATURA
                            FROM dbamv.prestador_assinatura
                            WHERE CD_PRESTADOR = $var_cd_prestador";

@$result_assinatura_prest = oci_parse($conn_ora, @$cons_assinatura_prest);
@oci_execute(@$result_assinatura_prest);
@$row_assinatura_prest = oci_fetch_array($result_assinatura_prest);
@$assinatura = @$row_assinatura_prest['ASSINATURA_TISS']->load();

//echo '<img style="width: 150px; height: 40px;" src="data:image/png;base64,'.base64_encode($assinatura).'"/>';


if($insere_dados > 0){

	$_SESSION['msg'] = "Arquivo gerado com sucesso!"; 
    header('Location: cad_assinatura.php');
    return 0;

}else{

    $_SESSION['msgerro'] = "Ocorreu um erro ao gerar o arquivo."; 
    header('Location: cad_assinatura.php');
    return 0;

}

?>

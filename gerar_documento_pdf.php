<?php

session_start();	

@$var_cd_atendimento = $_POST['cd_atendimento'];
@$var_nm_paciente = $_POST['nm_paciente'];
@$dt_aten = $_POST['dt_aten'];
@$nm_conv = $_POST['nm_conv'];
$img = $_POST['escondidinho'];

$nm_documneto = 'pdf_assinatura_'.$var_cd_atendimento.'.pdf';

@$_SESSION['atdconsulta'] = $_POST['cd_atendimento'];


$html = "
        <form>
        <div class='row'>
        <div class='col-md-3' id='div_sn_exame_mv'>
                    <label>Paciente: <span> $var_nm_paciente </span></label>
            </div>
            <div class='col-md-3' id='div_sn_exame_mv'>
                    <label>Data Atendimento:<span> $dt_aten </span></label>
            </div>
            <div class='col-md-3' id='div_sn_exame_mv'>
                    <label>Nome Conevino: <span> $nm_conv</span></label>
            </div>
            <div>
            <img src='$img'
            width='600' height='200' >
            </div>
        </div>
        </br>	
        </form>
        ";


//echo $html;


/* Preparação do documento final
 */
$documentTemplate = '
<!doctype html> 
<html> 
    <head>
        <link rel="stylesheet" media="screen" href="http://www.site.com/css/style.css" type="text/css">
    </head> 
    <body>
        <div id="wrapper">
            '.$html.'
        </div>
    </body> 
</html>';


// inclusão da biblioteca
include 'dompdf/autoload.inc.php';


// alguns ajustes devido a variações de servidor para servidor
if ( get_magic_quotes_gpc() )
    $documentTemplate = stripslashes($documentTemplate);

use Dompdf\Dompdf;

// abertura de novo documento
$dompdf = new DOMPDF();

// carregar o HTML
$dompdf->load_html($documentTemplate);

// dados do documento destino
$dompdf->set_paper("A4", "portrail");

// gerar documento destino
$dompdf->render();

$image = $dompdf->output();

// enviar documento destino para download
//$dompdf->stream("dompdf_out.pdf");


    ///////////////////////
    // Inserindo no banco//
    ///////////////////////

include_once("conexao.php");


//DECLARANDO VARIAVEIS DO ARQUIVO PARA IMPORTACAO PARA O BANCO
//$image = file_get_contents($dompdf);

$consulta_insert = 
"INSERT INTO teste_assinaturas
(CD_ATENDIMENTO, NM_PACIENTE, DT_ATENDIMENTO, NM_CONVENIO, NOME_ANEXO, BLOB_ANEXO)
VALUES 
('$var_cd_atendimento', '$var_nm_paciente', '$dt_aten',
'$nm_conv', '$nm_documneto',
empty_blob()
) RETURNING BLOB_ANEXO INTO :image";

//echo $consulta_insert;

$insere_dados = oci_parse($conn_ora, $consulta_insert);
$blob = oci_new_descriptor($conn_ora, OCI_D_LOB);
oci_bind_by_name($insere_dados, ":image", $blob, -1, OCI_B_BLOB);

oci_execute($insere_dados, OCI_DEFAULT);

$linhas_afetadas = oci_num_rows($insere_dados);
//echo "</br>Linhas Afetadas: " . $linhas_afetadas;


if(!$blob->save($image)) {
    oci_rollback($conn_ora);
}
else {
    oci_commit($conn_ora);
}

oci_free_statement($insere_dados);
$blob->free();



if($insere_dados > 0){
	$_SESSION['msg'] = "Arquivo gerado com sucesso!"; 
    header('Location: gerar_documento.php');
    return 0;

}else{
    $_SESSION['msgerro'] = "Ocorreu um erro ao gerar o arquivo."; 
    header('Location: gerar_documento.php');
    return 0;
}


exit(0);
?>


<?php

session_start();	

@$var_cd_atendimento = $_REQUEST['cd_atendimento'];
@$var_nm_paciente = $_REQUEST['nm_paciente'];
@$dt_aten = $_REQUEST['dt_aten'];
@$nm_conv = $_REQUEST['nm_conv'];
$img = $_REQUEST['escondidinho'];
$tp_doc = 'hos_faa';

$nm_documneto = 'pdf_faa_'.$var_cd_atendimento.'.pdf';

@$_SESSION['atdconsulta'] = $_REQUEST['cd_atendimento'];

$var_user_logado = $_SESSION['usuarioLogin'];

$count = 1;

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Sao_Paulo');
//Data e hora de agora
$hora = date("d/m/Y H:i:s"); 
 
include 'sql_consulta_faa.php';
 
 $documentTemplate = "
 <html lang='en'> 
     <head> 
         <!-- Required meta tags --> 
         <meta charset='utf-8'> 
         <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'> 
     </head>
     <style>
 
     .col-hss-1,.col-hss-2,.col-hss-3,.col-hss-4, .col-hss-5, .col-hss-6, .col-hss-7, .col-hss-8, .col-hss-9, .col-hss-10, .col-hss-11, .col-hss-12 {
     
     height: 25px;
     font-size: 7px;
     background-color: #ffffff;
     margin: 1 1 1 1;
     border: solid 1px black !important;
 
 }
 
 .faixa-cinza{
 
     height: 10px !important;
     font-size: 8px; 
     background-color: #cccccc;
     line-height: 7px;
     clear:both;
 }
 
 
 .row{
 
     width: 100% !important;
     clear:both;
 
 }
 .col-hss-12{
 
     width: 99% !important;
     height: 20px;
     float: left;
 }
 .col-hss-11{
 
     width: 90.66% !important;
     height: 20px;
     float: left;
 }
 .col-hss-10{
 
     width: 82.33% !important;
     height: 20px;
     float: left;
 }
 .col-hss-9{
 
     width: 74% !important;
     height: 20px;
     float: left;
 }
 .col-hss-8{
 
     width: 65.66% !important;
     height: 20px;
     float: left;
 }
 .col-hss-7{
 
     width: 56.90% !important;
     height: 20px;
     float: left;
 }
 .col-hss-6{
 
     width: 49.40% !important;
     height: 20px;
     float: left;
 }
 .col-hss-5{
 
     width: 40.66% !important;
     height: 20px;
     float: left;
 }
 .col-hss-4{
 
     width: 32.90% !important;
     height: 20px;
     float: left;
 }
 .col-hss-3{
 
     width: 24% !important;
     height: 20px;
     float: left;
 }
 
 .col-hss-2{
 
     width: 15.66% !important;
     height: 20px;
     float: left;
     
 }
 
 .col-hss-1{
 
     width: 8.25% !important;
     height: 20px;
     float: left;
 }
 
 h2{ 
    font-weight: normal;
     font-size: 1.300em;
 }
 h1{ 
    font-weight: normal;
     font-size: 1.500em;
 }
 .imagem {
     width: 200px;
     height: 120px;
     object-fit: cover;
 }
 .texto{
    
     font-family: Arial, Helvetica, sans-serif;
 }

 p{
    font-family: Arial, Helvetica, sans-serif;
 }
 
 </style> 
 
         <form style='height: 50px;'>
             <div class='texto'>
                 <div class='row'>
                    <div style='width: 80%; margin: 0 auto; border-radius: 15px;'>
                        <div class='col-hss-12' style='border: none !important; text-align: center;'>
                                <img class='imagem' src='https://i2.wp.com/santacasasaude.com.br/wp-content/uploads/2018/07/Santa-Casa-SJC.gif?fit=730%2C457&ssl=1'>
                        </div>
                    </div>
                 </div>
             </div>
         </form>

         <br>
         <br>
         <br>

         <form>
            <div class=' texto'>
                <div class='row'>
                    <div class='col-hss-12' style='border: none !important; text-align: center;'>
                        <h1><b>FICHA DE ATENDIMENTO</b> </h1>
                    </div></br></br>
                </div>
                
                    </br>
                    </br>
                
                    <form>
                        <div class='' style='width:80%; margin:0 auto;' >
                        
                            <div class='row'>
                                <div class='col-hss-4' style='height: 15px;  border: none !important;  '>
                                    <h2><b>ATENDIMENTO:</b>  ".@$dados_pac_resp['ATENDIMENTO']."</h2>
                                </div>
                
                                <div class='col-hss-3' style='height: 15px;  border: none !important;  '>
                                    <h2><b>PRONTUÁRIO:</b> ".@$dados_pac_resp['PRONTUARIO']."</h2>
                                </div>
                
                                <div class='col-hss-5' style='height: 15px;  border: none !important;  '>
                                    <h2><b>DT.ATEND:</b> ".@date("d/m/Y",strtotime($dados_pac_resp['DATA_ATENDIMENTO']))."    ".@$dados_pac_resp['HORA_ATENDIMENTO']."</h2>
                                </div> 
                            </div>
                            
                            <div class='row'>
                                <div class='col-hss-7' style='height: 15px;  border: none !important; '>
                                    <h2><b>ORIGEM:</b> ".@$dados_pac_resp['ORIGEM_ATENDIMENTO']."</h2>
                                </div>
                
                                <div class='col-hss-4' style='height: 15px;  border: none !important;  '>
                                    <h2><b>N.CHAMADA:</b> ".@$dados_pac_resp['NUMERO_CHAMADA']."</h2>
                                </div>
                            </div>
                
                            <div class='row'>
                                <div class='col-hss-12' style='height: 15px;  border: none !important;  '>
                                    <h2></h2>
                                </div>
                            </div>
                
                            <div class='row'>
                                <div class='col-hss-12' style='height: 15px;  border: none !important;  '>
                                    <h2><b>PACIENTE:</b> ".@$dados_pac_resp['PACIENTE']."</h2>
                                </div>
                            </div>
                            
                            <div class='row'>
                                <div class='col-hss-7' style='height: 15px;  border: none !important; '>
                                    <h2><b>DT.NASC:</b> ".@$dados_pac_resp['DATA_NASCIMENTO']." </h2>
                                </div>                              
                                <div class='col-hss-5' style='height: 15px;  border: none !important;  '>
                                    <h2><b>SEXO:</b> ".@$dados_pac_resp['SEXO']."</h2>
                                </div>
                            </div>
                            
                            <div class='row'>
                                <div class='col-hss-4' style='height: 15px;  border: none !important; '>
                                    <h2><b>RG:</b> ".@$dados_pac_resp['RG']."</h2>
                                </div>
                                <div class='col-hss-3' style='height: 15px;  border: none !important; '>
                                    <h2><b>CPF:</b> ".@$dados_pac_resp['CPF']."</h2>
                                </div>

                                <div class='col-hss-5' style='height: 15px;  border: none !important; '>
                                    <h2><b>CNS:</b> ".@$dados_pac_resp['CNS']."</h2>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-hss-12' style='height: 15px;  border: none !important; '>
                                    <h2><b>NOME DA MÃE:</b> ".@$dados_pac_resp['NOME_MAE']."</h2>
                                </div>  
                            </div>

                            <div class='row'>
                                <div class='col-hss-12' style='height: 15px;  border: none !important; '>
                                    <h2></h2>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-hss-12' style='height: 15px;  border: none !important;  '>
                                    <h2><b>CONVÊNIO:</b> ".@$dados_pac_resp['CONVEINO']."</h2>
                                </div>  
                            </div>

                            <div class='row'>
                                <div class='col-hss-12' style='height: 15px;  border: none !important; '>
                                    <h2><b>CARTEIRINHA:</b> ".@$dados_pac_resp['NUMERO_CARTEIRINHA']."</h2>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-hss-12' style='height: 15px;  border: none !important;  '>
                                    <h2></h2>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='col-hss-7' style='height: 15px;  border: none !important; '>
                                    <h2><b>RESPONSAVEL:</b> ".@$dados_pac_resp['PACIENTE']."</h2>
                                </div>

                                <div class='col-hss-4' style='height: 15px;  border: none !important; '>
                                    <h2><b>RG:</b> ".@$dados_pac_resp['RG']."</h2>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div class='row'>
                                <div class='col-hss-4' style='height: 25px; border: none !important; border-bottom: solid 1px black !important; '>
                                 <img src='$img' width='100%' height='100%'  style:'float: right;'>
                                </div>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </form>
</html>";
//echo  json_encode(array($documentTemplate)); 
//echo  $documentTemplate; 


// inclusão da biblioteca
include 'dompdf/autoload.inc.php';


// alguns ajustes devido a variações de servidor para servidor


use Dompdf\Dompdf;
use Dompdf\Options;

// abertura de novo documento
$dompdf = new DOMPDF();
$dompdf->set_option('isRemoteEnabled', TRUE);

// carregar o HTML
$dompdf->load_html($documentTemplate);

// dados do documento destino
$dompdf->set_paper("A4", "retreat");

// gerar documento destino
$dompdf->render();

$image = $dompdf->output();
?>


<?php
// enviar documento destino para download
//$dompdf->stream("dompdf_out.pdf");


    ///////////////////////
    // Inserindo no banco//
    ///////////////////////

include_once("conexao.php");

//DECLARANDO VARIAVEIS DO ARQUIVO PARA IMPORTACAO PARA O BANCO
//$image = file_get_contents($dompdf);



$consulta_insert = 
"INSERT INTO ASSINATURAS.documentos_assinados
(CD_ATENDIMENTO, NM_PACIENTE, DT_ATENDIMENTO, NM_CONVENIO, NOME_ANEXO, TP_DOCUMENTO, NM_USER, DT_CRIACAO, BLOB_ANEXO)
VALUES 
('$var_cd_atendimento', '$var_nm_paciente', TO_DATE('$dt_aten', 'DD/MM/YY'),
'$nm_conv', '$nm_documneto', '$tp_doc', '$var_user_logado', SYSTIMESTAMP,
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


/*
if($insere_dados > 0){
	$_SESSION['msg'] = "Arquivo gerado com sucesso!"; 
    header('Location: gerar_documento.php');
    return 0;

}else{
    $_SESSION['msgerro'] = "Ocorreu um erro ao gerar o arquivo."; 
    header('Location: gerar_documento.php');
    return 0;
}
*/

exit(0);



//DECLARANDO VARIAVEIS DO ARQUIVO PARA IMPORTACAO PARA O BANCO
//$image = file_get_contents($dompdf);

?>





<?php

session_start();

$count = 1;

@$var_cd_atendimento = $_POST['cd_atendimento'];
@$var_nm_paciente = $_POST['nm_paciente'];
@$dt_aten = $_POST['dt_aten'];
@$nm_conv = $_POST['nm_conv'];
$img = $_POST['escondidinho'];
$tp_doc = 'cons_pa';

$nm_documneto = 'pdf_guia_cons_pa_'.$var_cd_atendimento.'.pdf';

@$_SESSION['atdconsulta'] = $_POST['cd_atendimento'];

$var_user_logado = $_SESSION['usuarioLogin'];

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Sao_Paulo');
//Data e hora de agora
$hora = date("d/m/Y H:i:s"); 

include 'sql_consulta_guia_consulta.php';

//echo $html;

/* Preparação do documento final
 */

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
     font-size: 9px;
     font-family: Arial, Helvetica, sans-serif;
     background-color: #ffffff;
     margin: 1 1 1 1;
     padding: 3 1 1 3;
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
    width: 57.33% !important;
    height: 20px;
    float: left;
}
.col-hss-6{
    width: 49% !important;
    height: 20px;
    float: left;
}
.col-hss-5{
    width: 40.66% !important;
    height: 20px;
    float: left;
}
.col-hss-4{
    width: 32.33% !important;
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
    width: 7.33% !important;
    height: 20px;
    float: left;
}
h4{
    font-size: 10px;
    line-height: 50px !important; 
    text-align: center !important;
}
h3{
    font-size: 15px;
    line-height: 50px !important; 
    text-align: center !important;
}
 h2{
     font-size: 10px;
     line-height: 4px;
     float: center;
     margin-top: 0px; 
 }

 h1{
    font-size: 15px;
    margin-top: 30px;
    
}
 h2-footer{
     font-size: 10px;
     float: center;
     margin-top: 0px;
 }
 font{
    font-family: Arial, Helvetica, sans-serif;
 }
 B{
     
     text-transform: uppercase;
    }

 </style> 
 ";

 if($row_cons_logo_con['CARACT'] > 0){
        $documentTemplate .=" 
            <form>
                <div class='container'>
                    <div class='row'>
                        
                        <div class='col-hss-4' style=' height: 100px;'>
            
                        <img src='data:application/pdf;base64, ".base64_encode(@$image)." type='application/pdf' style='width: 180px; height: 95px;'>
                        </div>
        
                        <div class='col-hss-4' style='height: 100px;'>
                            <h3>GUIA DE CONSULTA</h3>
                        </div>
                        <div class='col-hss-4' style='height: 100px;'>
                            <h4>2- N° Guia no Prestador: ".@$row_cons_guia_consulta['CP_02']."</h4>
                        </div>
                    </div>
                </div>
            </form>
        ";
}else{
        $documentTemplate .=" 
            <form>
                <div class='container'>
                    <div class='row'>
                        
                        <div class='col-hss-4' style=' height: 100px;'>
                        </div>
        
                        <div class='col-hss-4' style='height: 100px;'>
                            <h3>GUIA DE CONSULTA</h3>
                        </div>
                        <div class='col-hss-4' style='height: 100px;'>
                            <h4>2- N° Guia no Prestador: ".@$row_cons_guia_consulta['CP_02']."</h4>
                        </div>
                    </div>
                </div>
            </form>
        ";
}

$documentTemplate .=" 
         </br>
         </br>
         </br>
         </br>
         <form>
             <!--Primeiras infos -->
             <div class='container'>
                 <div class='row '>
                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                         1 - Registro ANS
                         <br>
                         <br>
                         <h2><B>".@$row_cons_guia_consulta['CP_01']."</B></h2>
                     </div>

                     <div class='col-hss-10' style='height: 30px; margin: 1px;'>
                        3 - Númeo da Guia Atribuído pela Operadora</B>
                        <br>
                        <br>
                        <h2><B>".@$row_cons_guia_consulta['CP_03']."</B></h2>
                     </div>
                 </div>
                 <!-- FIM Primeiras infos -->
             
                 <!-- ---------------------------------------------------------------------------------------------------------------------------------------- -->
                
                 <!-- Dados beneficiário -->
                 <div class='row'>
                     <div class='col-hss-12 faixa-cinza'>
                        <b>Dados do Beneficiário</b>
                     </div>
                 </div>

                 <div class='row'>
                     <div class='col-hss-8' style='height: 30px; margin: 1px;'>
                        4 - Número da Carteira
                        <br>
                        <br>
                        <h2><B>".@$row_cons_guia_consulta['CP_04']."</B></h2>
                     </div>

                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        5 - Validade da Carteira
                        <br>
                        <br>
                        <h2><B>".@$row_cons_guia_consulta['CP_05']."</B></h2>
                     </div>

                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        6 - Atendimento a RN (Sim ou Não)
                        <br>
                        <br>
                        <h2><B>".@$row_cons_guia_consulta['CP_06']."</B></h2>
                     </div>
                </div>

                <div class='row'>
                     <div class='col-hss-10' style='height: 30px; margin: 1px;'>
                        7 - Nome
                        <br>
                        <br>
                        <h2><B>".@$row_cons_guia_consulta['CP_07']."</B></h2>
                     </div>

                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        8 - Cartão Nacional de Saúde
                        <br>
                        <br>
                        <h2><B>".@$row_cons_guia_consulta['CP_08']."</B></h2>
                     </div>
                 </div>
                 <!-- FIM Dados beneficiário -->
             
                 <!-- ---------------------------------------------------------------------------------------------------------------------------------------- -->

                 <!-- Dados do Contratado -->
                 <div class='row'>
                     <div class='col-hss-12 faixa-cinza'>
                        <b>Dados do Contratado</b>
                     </div>
                 </div>

                 <div class='row'>
                     <div class='col-hss-3' style='height: 30px; margin: 1px;'>
                        9 - Código da Operadora
                        <br>
                        <br>
                        <h2><B>".@$row_cons_guia_consulta['CP_09']."</B></h2>
                     </div>
                     <div class='col-hss-7' style='height: 30px; margin: 1px;'>
                        10 - Nome do Contratado
                        <br>
                        <br>
                        <h2><B>".@$row_cons_guia_consulta['CP_10']."</B></h2>
                     </div>
                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        11 - Código CNES
                        <br>
                        <br>
                        <h2><B>".@$row_cons_guia_consulta['CP_11']."</B></h2>
                     </div>
                 </div>

                 <div class='row'>
                     <div class='col-hss-5' style='height: 30px; margin: 1px;'>
                        12 - Nome do Profissional Executante
                        <br>
                        <br>
                        <h2><B>".@$row_cons_guia_consulta['CP_12']."</B></h2>
                     </div>

                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        13 - Conselho Profissional
                        <br>
                        <br>
                        <h2><B>".@$row_cons_guia_consulta['CP_13']."</B></h2>
                     </div>

                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        14 - Número no Conselho
                        <br>
                        <br>
                        <h2><B>".@$row_cons_guia_consulta['CP_14']."</B></h2>
                     </div>

                     <div class='col-hss-1' style='height: 30px; margin: 1px;'>
                        15 - UF
                        <br>
                        <br>
                        <h2><B>".@$row_cons_guia_consulta['CP_15']."</B></h2>
                     </div>

                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        16 - Código CBO
                        <br>
                        <br>
                        <h2><B>".@$row_cons_guia_consulta['CP_16']."</B></h2>
                        
                     </div>
                 </div>
                 <!-- FIM Dados Contratado -->
             
                 <!-- ---------------------------------------------------------------------------------------------------------------------------------------- -->

                 <!--  Hipóteses Diagnósticas -->
                 <div class='row'>
                     <div class='col-hss-12 faixa-cinza' >
                        <b>Hipóteses Diagnósticas</b>
                     </div>
                 </div>
                 <div class='row'>
                     <div class='col-hss-4' style='height: 35px; margin: 1px;' >
                        17 - Indicação de Acidente (Acidente ou doença relacionada)
                        <br>
                        <br>
                        <h2><B>".@$row_cons_guia_consulta['CP_17']."</B></h2>
                     </div>    
                 </div>
                 <!-- FIM Hipóteses Diagnósticas -->
             
                 <!-- ---------------------------------------------------------------------------------------------------------------------------------------- -->


                 <!--  Dados do Atendimento / Procedimento Realizado -->
                 <div class='row'>
                     <div class='col-hss-12 faixa-cinza' >
                        <b>Dados do Atendimento / Procedimento Realizado</b>
                     </div>
                 </div>
                 <div class='row'>
                     <div class='col-hss-3' style='height: 30px; margin: 1px;'>
                        18 - Data de Atendimento
                        <br>
                        <br>
                        <h2><B>".@date("d/m/Y",strtotime($row_cons_guia_consulta['CP_18']))."</B></h2>
                        
                     </div>
                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        19 - Tipo de Consulta
                        <br>
                        <br>
                         <h2><B>".@$row_cons_guia_consulta['CP_19']."</B></h2>
                     </div>
                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        20 - Tabela
                        <br>
                        <br>
                         <h2><B>".@$row_cons_guia_consulta['CP_20']."</B></h2>
                     </div>
                     <div class='col-hss-3' style='height: 30px; margin: 1px;'>
                        21 - Código Procedimento
                        <br>
                        <br>
                        <h2><B>".@$row_cons_guia_consulta['CP_21']."</B></h2>
                     </div>
                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        22 - Valor do Procedimento
                        <br>
                        <br>  
                        <h2><B>".@$row_cons_guia_consulta['CP_22']."</B></h2>
                     </div>
                 </div>

                 <div class='row'>
                     <div class='col-hss-12' style='height: 75px; margin: 1px;'>
                        23 - Observação
                         <br>
                         <br>
                         <h2><B>".@$row_cons_guia_consulta['CP_23']."</B></h2>
                     </div>    
                 </div>

                 <div class='row'>
                     <div class='col-hss-6' style='height: 50px; margin: 1px;'>
                        24 - Assinatura do Profissional Executante
                        <br>
                        <br>
                         <h2><B>".@$row_cons_guia_consulta['CP_24']."</B></h2>
                     </div>
                     
                     <div class='col-hss-6' style='height: 50px; margin: 1px;'>
                        25 - Assinatura do Beneficiário ou Responsável
                        <br>
                
                        <div class='col-hss-4' style='height: 25px; border: none !important; border-bottom: solid 1px black !important; '>
                        <img src='$img' width='100%' height='100%'  style:'float: right;'>
                        </div>
                     </div> 
                 </div>
                 <!-- FIM Dados do Atendimento / Procedimento Realizado -->

                 <div class='container'>
                 <div class='row' >
                     <div class='col-hss-3' style=' padding-left: 30px;   border: none !important;'>
                         <h2-footer><B>".$var_user_logado."</B></h2-footer>
                     </div>
                     <div class='col-hss-2' style=' padding-left: 5px; border: none !important;'>
                         <h2-footer><B>Data:".$hora."</B></h2-footer>
                     </div>
                     <div class='col-hss-2' style=' padding-left: 5px;border: none !important;'>
                         <h2-footer><B>Conta/Lote:".$row_cons_guia_consulta['CD_CONTA']."</B></h2-footer>
                     </div>
                     <div class='col-hss-2' style=' padding-left: 5px; border: none !important;'>
                         <h2-footer><B>Atendimento: ".$var_cd_atendimento."</B></h2-footer>
                     </div>
                     <div class='col-hss-3' style=' padding-left: 5px; border: none !important;'>
                         <h2-footer><B>Convenio: ".$nm_conv."</B><h2-footer>
                 </div>
             </div>
          </div>
         </form>
";

//echo $documentTemplate;


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
$dompdf->set_paper("A4", "landscape");

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



/*if($insere_dados > 0){
	$_SESSION['msg'] = "Arquivo gerado com sucesso!"; 
    header('Location: gerar_documento.php');
    return 0;

}else{
    $_SESSION['msgerro'] = "Ocorreu um erro ao gerar o arquivo."; 
    header('Location: gerar_documento.php');
    return 0;
}*/


exit(0);



//DECLARANDO VARIAVEIS DO ARQUIVO PARA IMPORTACAO PARA O BANCO
//$image = file_get_contents($dompdf);


?>

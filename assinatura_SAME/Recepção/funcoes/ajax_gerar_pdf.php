<?php

session_start();	
@$var_cd_paciente = $_REQUEST['cd_paciente'];
@$var_nm_paciente = $_REQUEST['nm_paciente'];
$img = $_REQUEST['escondidinho'];

$tp_doc = 'same_pendente';
$nm_documento = 'pdf_guia_same_'.$var_cd_paciente.'.pdf';

$var_user_logado = $_SESSION['usuarioLogin'];

$count = 1;

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Sao_Paulo');
//Data e hora de agora
$hora = date("d/m/Y H:i:s"); 

include '../../../sql_consulta_same.php';

//echo $html;

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

    font-family: Arial, Helvetica, sans-serif;
    background-color: #ffffff;
    margin: 1 1 1 1;
    padding: 3 1 1 3;
    border: solid 0px black !important;
    }

    .row{
    width: 100% !important;
    clear:both;
    }
    .col-hss-12{
    width: 98.60% !important;
    height: 20px;
    float: left;
    }
    .col-hss-11{
    width: 90.66% !important;
    height: 20px;
    float: left;
    }
    .col-hss-10{
    width: 82.05% !important;
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
    width: 57.40% !important;
    height: 20px;
    float: left;
    }
    .col-hss-6{
    width: 49.22% !important;
    height: 20px;
    float: left;
    }
    .col-hss-5{
    width: 40.75% !important;
    height: 20px;
    float: left;
    }
    .col-hss-4{
    width: 32.65% !important;
    height: 20px;
    float: left;
    }
    .col-hss-3{
    width: 24.59% !important;
    height: 20px;
    float: left;
    }
    .col-hss-2{
    width: 16.20% !important;
    height: 20px;
    float: left;

    }
    .col-hss-1{
    width: 7.90% !important;
    height: 20px;
    float: left;
    }
    h1{
    font-size: 10px;
    line-height: 15px !important; 
    text-align: justify !important;
    }
    h2{
    font-size: 9px;
    line-height: 12px !important; 
    text-align: left !important;
    }
    h3{
    font-size: 12px;
    text-align: center !important;
    margin-top: 5px; 
    }
    h4{
    font-size: 10px;
    line-height: 15px !important; 
    text-align: right !important;
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


    <form style='height: 95px;'>
    <div class='col-hss-12' style='border: none !important; text-align: center;'>
        <img class='imagem' src='https://i2.wp.com/santacasasaude.com.br/wp-content/uploads/2018/07/Santa-Casa-SJC.gif?fit=730%2C457&ssl=1' style='width: 200px; height: 110px;'>
    </div>
    </form>

    <form style='height: 40px;'>
    <div class='container'>
    

        <div class='row'>

            <div class='col-hss-12' style='height: 30px; margin: 1px; '>
                <h3><b>REQUERIMENTO CÓPIA DE PRONTUÁRIO</b></h3>
            </div>
        </div>
    </div>
    </form>
            <div class='container'>

            <!--TEXTO-->
                <div class='row '>
                <div class='col-hss-1' style='height: 700px; margin: 1px; '>
                </div>

                    <div class='col-hss-10' style='height: 700px; margin: 1px; '>
                            
                    <h1>O(A) Requerente abaixo identificado(a) e assinado(a) vem solicitar de Vossa Senhoria, cópia do prontuário médico, relativo ao atendimento a que foi submetido(a) o(a) paciente abaixo identificado(a) neste Hospital.</h1>
                    

                    <h1><b>DADOS DO(A) PACIENTE:</b></h1>
                    <h1>Nome: <b>".@$dados_result_resp_doc['PACIENTE_NOME']." </b> RG: <b>".@$dados_result_resp_doc['PACIENTE_RG']."</b> CPF: <b>".@$dados_result_resp_doc['PACIENTE_CPF']."</b> Data de Nascimento: <b>".@$dados_result_resp_doc['PACIENTE_NASCIMENTO']."</b> </h1>
                    <h1>Período de Internação: (informação obrigatória):  <b>".@$dados_result_resp_doc['PERIODO_MINIMO']."</b> há <b>".@$dados_result_resp_doc['PERIODO_MAXIMO']."</b></h1>
                    <br>
                    <h1><b>DADOS DO(A) REQUERENTE: </b></h1>
                    <h1>( <b>".@$dados_result_resp_doc['RADIO_PACIENTE']." </b>) Paciente   ( <b>".@$dados_result_resp_doc['RADIO_REP_LEGAL']." </b>) Representante Legal   ( <b>".@$dados_result_resp_doc['RADIO_TUTOR_CURADOR']." </b>) Tutor/Curador   ( <b>".@$dados_result_resp_doc['RADIO_PARENTE']." </b>) Parente: <b>".@$dados_result_resp_doc['REQUERENTE_PARENTE']." <br> 
                    Nome: <b>".@$dados_result_resp_doc['REQUERENTE_NOME']." </b>
                    RG: <b>".@$dados_result_resp_doc['REQUERENTE_RG']." </b> CPF: <b>".@$dados_result_resp_doc['REQUERENTE_CPF']." </b> Data de Nascimento: <b>".@$dados_result_resp_doc['REQUERENTE_NASCIMENTO']." </b> 
                    Estado Civil: <b>".@$dados_result_resp_doc['REQUERENTE_ESTADO_CIVIL']." </b> Profissão: <b>".@$dados_result_resp_doc['REQUERENTE_PROFISSAO']." </b> Endereço: <b>".@$dados_result_resp_doc['REQUERENTE_RUA']." </b> Bairro: <b>".@$dados_result_resp_doc['REQUERENTE_BAIRRO']." </b> Cidade: <b>".@$dados_result_resp_doc['REQUERENTE_CIDADE']." </b> Estado: <b>".@$dados_result_resp_doc['REQUERENTE_ESTADO']." </b> Telefone(s):  <b>".@$dados_result_resp_doc['REQUERENTE_TEL_PRIMARIO']." </b> /  <b>".@$dados_result_resp_doc['REQUERENTE_TEL_SECUNDARIO']." </b> /  <b>".@$dados_result_resp_doc['REQUERENTE_TEL_TERCIARIO']." </b>
                    </h1>

                    <h1><b>MOTIVO DO REQUERIMENTO: (preenchimento obrigatório)</b></h1>
                    <h1> ".@$dados_result_resp_doc['REQUERENTE_MOTIVO']." </h1>
                    <br>


                    <h2><b>Declaro, sob as penas da Lei, que os dados informados acima são verdadeiros e que tenho pleno conhecimento do sigilo das informações contidas no documento requerido, bem como da minha responsabilidade civil e criminal pela indevida publicação e utilização das informações nele contidas.</b></h2>

                    <h2>Obs.: Com base na Resolução CFM nº 2.217/2018 e na Recomendação CFM nº 03/2014, se: </h2>
                    <h2><b>  (i)</b> Requerente é Paciente, entregar cópia do seu RG;</h2>
                    <h2><b>  (ii)</b> Requerente é Representante Legal, entregar procuração com poderes específicos, bem como entregar cópia do RG do paciente e cópia do seu RG; </h2>
                    <h2><b>  (iii)</b> Requerente é Tutor/Curador, entregar cópia do termo de tutela/curatela e cópia do seu RG; </h2>
                    <h2><b>  (iv)</b> Requerente é Parente, entregar cópia do RG do paciente falecido, cópia do seu RG e/ou qualquer outro documento a fim de comprovar o vínculo familiar e verificar a ordem de vocação hereditária, bem como cópia do atestado de óbito. </h2>
                    <h2><b>  1.</b> Cônjuge/companheiro; </h2>
                    <h2><b>  2.</b> Filhos, netos, bisnetos (descendentes); </h2>
                    <h2><b>  3.</b> Pais, avós, bisavós (ascendentes); </h2>
                    <h2><b>  4.</b> Irmãos (colaterais de 2º grau);</h2>
                    <h2><b>  5.</b> Sobrinhos/Tios (colaterais de 3º grau);</h2>
                    <h2><b>  6.</b> Sobrinhos-netos/tios-avós/primos (colaterais de 4º grau).</h2>
                    
                    <h1><b>Valor do Xerox: R$ 0,30 (Trinta centavos) por folha ou salvo em pen drive sem nenhum custo. </b></h1>
                    <h1><b>O pen drive é de responsabilidade do solicitante e deve ser entregue no momento que o prontuário estiver disponível para entrega. Prazo de entrega do documento: 20 (dias) dias úteis </b></h1>
                    <h1></h1>
                    </div>

                <div class='col-hss-1' style='height: 700px; margin: 1px; '>
                </div>   
                </div>
                

                <div class='row'>
                    <div class='col-hss-1' style='height: 30px; margin: 1px; '>
                    </div>

                    <div class='col-hss-4' style='height: 30px; margin: 1px; '>
                        <h1>Atendente: <b>".$var_user_logado." </b></h1>
                    </div>

                    <div class='col-hss-6' style='height: 30px; margin: 1px; '>
                        <h4> <b>".@$dados_result_resp_doc['DATA_EXTENSO']." </b></h4>
                    </div>

                    <div class='col-hss-1' style='height: 30px; margin: 1px; '>
                    </div>
                </div> 


                <div class='row'>
                    <div class='col-hss-1' style='height: 55px; margin: 1px; '>
                    </div>

                    <div class='col-hss-4' style='height: 55px;'>
                        <h1>Assinatura (Requerente)</h1>
                        <img src='$img' width='80%' height='80%'  style:'float: right; margin: 1px; border-style: none !important; border-bottom: 1px solid black !important;'>
                    </div>
                    

                    <div class='col-hss-1' style='height: 55px; margin: 1px; '>
                    </div>

                    <div class='col-hss-4' style='height: 55px; margin: 1px; border-style: none !important; border-bottom: 1px solid black !important;'>
                        <h1>Assinatura e Carimbo do Diretor Clínico: </h1>
                    </div>
                </div>


                    
            </div>
        </div>
        </form>
";

//echo  json_encode(array($documentTemplate)); 
//echo  $documentTemplate; 

// inclusão da biblioteca
include '../../../dompdf/autoload.inc.php';

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


include_once("../../../conexao.php");


//////////
//DELETE//
//////////

$cons_delete="DELETE ASSINATURAS.DOCUMENTOS_ASSINADOS_SAME WHERE CD_PACIENTE = $var_cd_paciente
            ";
$result_delete = oci_parse($conn_ora, $cons_delete);
$valida_delete = @oci_execute($result_delete);

if (!$valida_delete) {   
        $erro = oci_error($result_delete);																							
        $_SESSION['msgerro'] = htmlentities($erro['message']);
    }



///////////////////////
//Inserindo no banco///
///////////////////////
$consulta_insert = 
"INSERT INTO ASSINATURAS.DOCUMENTOS_ASSINADOS_SAME
(   CD_PACIENTE, NM_PACIENTE, NOME_ANEXO, 
    TP_DOCUMENTO, CD_USUARIO_CADASTRO, HR_CADASTRO, BLOB_ANEXO
)
VALUES 
(   '$var_cd_paciente', '$var_nm_paciente', '$nm_documento', 
    '$tp_doc', '$var_user_logado', SYSTIMESTAMP, empty_blob()
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

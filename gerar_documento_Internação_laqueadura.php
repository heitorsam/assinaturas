<?php

session_start();	

echo $var_cd_atendimento = $_REQUEST['cd_atendimento'];
echo $var_nm_paciente = $_REQUEST['nm_paciente'];
echo $dt_aten = $_REQUEST['dt_aten'];
echo $nm_conv = $_REQUEST['nm_conv'];
$img = $_REQUEST['escondidinho'];
$tp_doc = 'term_laqueadura';

$nm_documneto = 'pdf_term_internacao_laqueadura_'.$var_cd_atendimento.'.pdf';

@$_SESSION['atdconsulta'] = $_REQUEST['cd_atendimento'];

$var_user_logado = $_SESSION['usuarioLogin'];

$count = 1;

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Sao_Paulo');
//Data e hora de agora
$hora = date("d/m/Y H:i:s"); 
 
include 'sql_consulta_internacao.php';
 
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
     padding: 5 10 5 5;
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
     width: 90.05% !important;
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
     width: 2.90% !important;
     height: 20px;
     float: left;
 }
 h1{
    font-size: 8px;
    line-height: 10px !important; 
    text-align: justify !important;
    font-weight: normal;
}
h2{
    font-size: 8px;
    line-height: 15px !important; 
    text-align: left !important;
}
 h3{
     font-size: 10px;
     text-align: center !important;
     margin-top: 5px; 
 }
 h2-footer{
     font-size: 10px;
     float: center;
     margin-top: 0px;
 }
 font{
    font-family: Arial, Helvetica, sans-serif;
 }
 b{ 
    font-weight: bold !important;
    text-transform: uppercase !important;
    }

 </style> 
 <form style='height: 100px;'>
 <div class='col-hss-12' style='border: none !important; text-align: center;'>
     <img class='imagem' src='https://i2.wp.com/santacasasaude.com.br/wp-content/uploads/2018/07/Santa-Casa-SJC.gif?fit=730%2C457&ssl=1' style='width: 200px; height: 110px;'>
 </div>
</form>

<form style='height: 32px;'>
 <div class='container'>

     <div class='row'>

         <div class='col-hss-12' style='height: 30px; margin: 1px; '>
             <h3><b>TERMO DE RESPONSABILIDADE E CONSENTIMENTO INFORMADO PROCEDIMENTO ANESTÉSICO OU SEDAÇÃO
             </b></h3>
         </div>
     </div>
 </div>
</form>


<div class='container'>

         <!--TEXTO-->
         <div class='row '>
             <div class='col-hss-1' style='height: 620px; margin: 1px; '>
             </div>

             <div class='col-hss-10' style='height: 620px; margin: 1px; '>
                     
                 <h1><b>Identificação do paciente:</b></h1>

                 <h1>Nome: ______________________________________________________________________________
                 Portador(a) da Cédula de Identidade RG nº ______________________________,
                 Inscrito(a) no CPF/MF sob nº __________________________________, residente na 
                 _____________________________________________________________________________________
                 Cidade___________________________________ Estado______, CEP : ______________, 
                 Telefone:______________.</h1>

                 <h1><b>Identificação do Representante Legal</b></h1>

                 <h1>Nome: ______________________________________________________________________idade ____
                 Portador(a) da Cédula de Identidade RG nº ______________________________,residente na 
                 _____________________________________________________________________________________
                 Cidade_______________________ Estado______, CEP : _______________, Telefone:______________.
                 Grau de Parentesco: ___________________________________________________________________.</h1>

                 <h1>Declaro que o Dr(a) __________________________________________________, explicou-me e eu 
                 entendi que devo me submeter à <b>LAQUEADURA DE TROMPAS.</b></h1>

                 <h1>Explicou-me que: </h1>

                 <h1>A intervenção de laqueadura tubárea consiste basicamente na <b>INTERRUPÇÃO DA CONTINUIDADE DAS TROMPAS DE FALÓPIO</b>, como objetivo de impedir uma nova gravidez e que este método é considerado irreversível. Mesmo se realizado a re-ligadura de trompas através de nova cirurgia a chance de sucesso mínima, com chances aumentadas se houver a gravidez de ser ectópica se localizando nas trompas. </h1>

                 <h1>Para realização da técnica existem várias formas de abordagem cirúrgica: </h1>

                 <h1><b>    -   Laparoscópica; </b></h1>
                 <h1><b>    -   Microlaparotomia; </b></h1>
                 <h1><b>    -   Vaginal; </b></h1>
                 <h1><b>    -   Pós Cesária (laqueadura  tubarea no momento  da pratica  de uma cesária). </b></h1>

                 <h1>Estas técnicas necessitam de anestesia, que serão avaliadas pelo Serviço de Anestesia do Hospital escolhido. </h1>

                 <h1>Embora, o método de laqueadura tubárea seja o método mais efetivo de planejamento Familiar, sua efetividade não é de 100%. Existem uma porcentagem de falha de 0,41 %(dados da FEBRASGO). Como em toda intervenção cirúrgica, existe um risco excepcional de mortalidade derivado do ato cirúrgico e da situação vital de cada paciente. </h1>

                 <br>

                 <h1><b>As complicações que poderão surgir são: </b></h1>

                 <h1>Intra Operatória (hemorragia, lesões de órgãos), queimaduras por bisturi elétrico. </h1>
                 
                 <h1>Pós-operatórias: </h1>

                 <h1><b>   -   Leves e mais freqüentes (seromas, hemorragias, cistites, anemia, etc); </b></h1>
                 <h1><b>   -   Graves e excepcionais (eventração, apnéia, tromboses, hematomas, pelviperitonites, hemorragia, etc), perfuração de órgão;  </b></h1>
                 <h1><b>   -   A longo prazo, em torno de 5%: Distúrbios da menstruação como: Aumento ou diminuição do intervalo entra as menstruações.  </b></h1>

                 <h1>Se no momento do ato cirúrgico surgir algum imprevisto, a equipe médica poderá alterar a técnica cirúrgica programada. </h1>

                 <h1>Existem outros métodos de contracepção que não são irreversíveis: </h1>

                 <h1><b>    -   Métodos de barreira;  </b></h1>
                 <h1><b>    -   Anticoncepção hormonal;   </b></h1>
                 <h1><b>    -   Contracepção intra uterina com dispositivos intra útero com ou sem hormônios;</b></h1>
                 <h1><b>    -   Métodos naturais.</b></h1>


                 <h1>Entendi as explicações que me foram prestadas em linguagem clara e simples, esclarecendo-me todas as dúvidas que me ocorreram. </h1>

                 <h1>Também entendi que, a qualquer momento e sem necessidade de dar nenhuma explicação poderei revogar o consentimento que agora presto. </h1>

                 <h1>Assim, declaro agora que estou satisfeito com a informação recebida e que compreendo o alcance e riscos do tratamento. </h1>

                 <h1>Por tal razão e nestas condições CONSITO que se realize a INTERVENÇÃO DE LAQUEADURA TUBÁRIA proposta. </h1>

                 <h1>Reservo-me expressamente o direito de revogar a qualquer momento meu consentimento antes que o procedimento objeto deste documento se realize. </h1>

                 <h1>São José dos Campos, ______ de ________________ de ____________.</h1>
             </div>

             <div class='col-hss-1' style='height: 620px; margin: 1px; '>
             </div>  

         </div>

     <br>
     <br>
     
         <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->                 
    
    <div class='row'>
         <div class='col-hss-1' style='height: 50px; margin: 1px; '>
         </div>

         <div class='col-hss-4' style='height: 50px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
             <h1>Assinatura Médico: </h1>
         </div>

         <div class='col-hss-3' style='height: 50px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
             <h1>Assinatura da Paciente: </h1>
         </div>

         <div class='col-hss-3' style='height: 50px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
             <h1>Assinatura Representante Legal: </h1>
         </div>
    </div>

     <br>
     <div class='row'>
        <div class='col-hss-1' style='height: 50px; margin: 1px; '>
        </div>

        <div class='col-hss-10' style='height: 50px; margin: 1px; '>
            
            <h1><b>REVOGAÇÃO</b></h1>

            <h1>Revogo o consentimento prestado na data de ___/ ___/ _______ e não desejo prosseguir o tratamento que dou com esta por finalizado. </h1>

            <h1>São José dos Campos, ______ de ________________ de ____________.</h1>
    
        </div>

        <div class='col-hss-1' style='height: 50px; margin: 1px; '>
        </div>
     </div>


        <div class='row'>
            <div class='col-hss-1' style='height: 50px; margin: 1px; '>
            </div>

            <div class='col-hss-4' style='height: 50px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
                <h1>Assinatura Médico: </h1>
            </div>

            <div class='col-hss-1' style='height: 50px; margin: 1px; '>
            </div>

            <div class='col-hss-3' style='height: 50px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
                <h1>Assinatura da Paciente: </h1>
            </div>  
        </div>
       
</div>
         ";
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

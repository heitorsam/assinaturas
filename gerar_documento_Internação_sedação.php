<?php

session_start();	

@$var_cd_atendimento = $_REQUEST['cd_atendimento'];
@$var_nm_paciente = $_REQUEST['nm_paciente'];
@$dt_aten = $_REQUEST['dt_aten'];
@$nm_conv = $_REQUEST['nm_conv'];
$img = $_REQUEST['escondidinho'];
$tp_doc = 'term_sedacao';

$nm_documneto = 'pdf_termo_sedacao_'.$var_cd_atendimento.'.pdf';

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
             <div class='col-hss-1' style='height: 180px; margin: 1px; '>
             </div>

             <div class='col-hss-10' style='height: 180px; margin: 1px; '>
                     
                <h1>Paciente:<b>".@$dados_result_term_cirurgia['PACIENTE']."</b> Data de nascimento: <b>".@$dados_result_term_cirurgia['DT_NASCIMENTO']."</b> Data de Internação:<b>".@$dados_result_term_cirurgia['DATA_ATENDIMENTO']."</b> Atendimento nº: <b>".@$dados_result_term_cirurgia['ATENDIMENTO']."</b> Leito : ___________</h1>

                 <h1>Autorizo o(a)  Dr(a)._________________________________________________________________ credenciado(a) pela Santa Casa de São José dos Campos, a realizar na minha pessoa a técnica anestésica adequada à cirurgia a que serei submetido(a).</h1>

                 <h1>O(a) médico(a) anestesiologista se compromete a utilizar a melhor técnica disponível, obrigando-se a agir com zelo profissional e diligência em busca de seus objetivos, não se responsabilizando todavia, se não os alcançar, salvo isso ocorra por negligência, imprudência ou imperícia nos meios empregados. </h1>

                 <h1>Fui devidamente informado(a) sobre riscos anestésicos, que são inerentes ao ato anestésico, sobre minhas condições clínicas, cirúrgicas e processos alérgicos. </h1>

                 <h1>Declaro que recebi e li o “Manual de Orientação de Anestesia” conforme modelo no verso deste.</h1>

                 <h1>Estou ciente de que a Santa Casa de São José dos Campos, desde o início, se preocupou com a segurança dos pacientes e das suas equipes assistenciais. Me foi explicado, pelo(s) médico(s) responsável(s), que não há isenção do risco de contaminação pelo SARS-CoV-2, em face da pandemia. Fui informado também que a instituição adota várias medidas protetivas para a realização de cirurgias, procedimentos e ou terapias. </h1>

                 <h1>Após a leitura atenta deste termo de consentimento, afirmo que me foram esclarecidas todas as minhas dúvidas sobre a anestesia e seus riscos, e por isso firmo este termo de consentimento.</h1>

                 <h1></h1>

                 <br>
                 <br>

             </div>

             <div class='col-hss-1' style='height: 180px; margin: 1px; '>
             </div>  

         </div>
     
         <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->                 
         
         <!--ASSINATURAS-->
         <div class='row'>
             <div class='col-hss-1' style='height: 50px; margin: 1px; '>
             </div>

             <div class='col-hss-4' style='height: 50px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
                 <h1>Paciente:</h1><br>
                 <h1><b>".@$dados_result_term_cirurgia['PACIENTE']."</b></h1>
                 
             </div>

             <div class='col-hss-1' style='height: 50px; margin: 1px; '>
             </div>

             <div class='col-hss-4' style='height: 50px; margin: 1px; '>
                 <h1>Assinatura do Paciente: </h1>
                <div class='col-hss-8' style='height: 35px; border: none !important; border-bottom: solid 1px black !important; '>
                    <img src='$img' width='100%' height='100%'  style:'float: right;'>
                </div>
             </div>

             <div class='col-hss-1' style='height: 50px; margin: 1px; '>
             </div>
         </div>

         <br>

         <div class='row'>
             <div class='col-hss-1' style='height: 50px; margin: 1px; '>
             </div>

             <div class='col-hss-4' style='height: 50px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
                 <h1>Responsável: </h1>
             </div>

             <div class='col-hss-1' style='height: 50px; margin: 1px; '>
             </div>

             <div class='col-hss-4' style='height: 50px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
                 <h1>Assinatura do Responsável: </h1>
             </div>

         </div>

         <br>
         
         <div class='row'>
             <div class='col-hss-1' style='height: 50px; margin: 1px; '>
             </div>

             <div class='col-hss-4' style='height: 50px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
                 <h1>CPF N°: </h1>
             </div>

             <div class='col-hss-3' style='height: 50px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
                 <h1>Identidade N°: </h1>
             </div>

             <div class='col-hss-3' style='height: 50px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
                 <h1>Grau Parentesco: </h1>
             </div>

         </div>

         <div class='row'>

             <div class='col-hss-1' style='height: 40px; margin: 1px; border-style: none !important;'>
             </div>

             <div class='col-hss-10' style='height: 40px; margin: 1px; border-style: none !important;'>
                 <h1>São José dos Campos,<b> ".@$dados_result_term_cirurgia['DIA_ATD']." </b>de<b> ".@$dados_result_term_cirurgia['MES_EXTENSO']." </b>de<b> ".@$dados_result_term_cirurgia['ANO_ATD']." </b></h1>
             </div>

             <div class='col-hss-1' style='height: 40px; margin: 1px; border-style: none !important;'>
             </div>
         </div> 


         <br>
         
         <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

         <!--TEXTO MEDICO-->
         <div class='row '>
             <div class='col-hss-4' style='height: 90px; '>
             </div>

                 <div class='col-hss-4' style='height: 20px; '>
                 
                     <div class='faixa-cinza' >
                             <h3><b>DEVE SER PREENCHIDO PELO MÉDICO</b></h3>
                     </div>
                    <br>
                  
                     <h1>Expliquei todo o procedimento ao paciente acima identificado e/ou ao responsável, sobre os benefícios, riscos e alternativas, tendo respondido às perguntas formuladas pelos mesmos. De acordo com o meu entendimento, o paciente e/ou responsável estão em condições de compreender o que lhes foi informado.</h1>
                     <br>
                     <br>
                 </div>  
         </div> 
         
         <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

         <!--ASSINATURAS MEDICO-->
         <div class='row'>
             <div class='col-hss-1' style='height: 50px; margin: 1px; '>
             </div>

             <div class='col-hss-4' style='height: 50px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
                 <h1>NOME LEGÍVEL e/ou CARIMBO: </h1>
             </div>

             
             <div class='col-hss-4' style='height: 50px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
                 <h1>Assinatura: </h1>
             </div>

             <div class='col-hss-2' style='height: 50px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
                 <h1>CRM: </h1>
             </div>
         </div>

         <div class='row'>
             <div class='col-hss-12' style='height: 190px; margin: 1px; '>
             </div>
         </div>

     





         <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
         <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
         <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
         <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
        
         <form style='height: 100px;'>
         <div class='row'>
         <div class='col-hss-12' style='border: none !important; text-align: center;'>
             <img class='imagem' src='https://i2.wp.com/santacasasaude.com.br/wp-content/uploads/2018/07/Santa-Casa-SJC.gif?fit=730%2C457&ssl=1' style='width: 200px; height: 110px;'>
         </div>
         </div>
         </form>
         
         <form style='height: 55px;'>
             <div class='container'>
         
                 <div class='row'>

                     <div class='col-hss-12' style='height: 30px; margin: 1px; '>
                         <h3><b>TERMO DE RESPONSABILIDADE E CONSENTIMENTO INFORMADO PROCEDIMENTO ANESTÉSICO OU SEDAÇÃO
                         </b></h3>
                     </div>
                 </div>
             </div>
         </form>

         <!--TEXTO-->
         <div class='row '>
             <div class='col-hss-1' style='height: 600px; margin: 1px; '>
             </div>

             <div class='col-hss-10' style='height: 600px; margin: 1px; '>
                         

                 <h1><b>MANUAL DE ORIENTAÇÃO DE ANESTESIA</b></h1>

                 <h1><b>“ANESTESIA E VOCÊ”</b></h1>

                 <h1><b>Anestesiologistas</b> são médicos que cuidam da vida do paciente durante a realização de um procedimento cirúrgico ou de um exame diagnóstico ou terapêutico. Como médicos, cursaram seis anos de faculdade de Medicina e como especialistas na área, cumpriram, no mínimo, dois ou três anos de especialização em Anestesiologia. </h1>

                 <h1>O <b>anestesiologista</b> domina conhecimentos fundamentais para avaliação do paciente antes da cirurgia e indicação técnica anestésica mais adequada. Ele é responsável pela manutenção do organismo funcionando o mais próximo do normal durante um procedimento cirúrgico, protegendo-o não só da dor, mas também das reações que possam ocorrer. E também reúne conhecimentos para controlar a dor pós-operatória e a dor crônica. </h1>

                 <h1><b>Anestesia</b> significa “privação de sensação”, portanto, é uma condição de ausência de sensações. Levar o paciente ao estado de anestesia significa priva-lo de todas as sensações, entre elas a dor. É uma tarefa complexa e delicada que exige habilidade clínica, conhecimento de técnicas e arte ao executa-las. </h1>

                 <h1><b>Anestesia Geral</b> é obtida pela combinação de quatro elementos: hipnose (perda da consciência), analgesia (ausência da dor), relaxamento muscular e bloqueio das respostas do organismo ao estresse e ao trauma cirúrgico. É realizada através de uma combinação de medicamentos, por via venosa, com gases e vapores inalatórios através do sistema respiratório. </h1>

                 <h1><b>Anestesia Regional, Bloqueio ou Anestesia Condutiva:</b> é o tipo de anestesia em que se bloqueia a condução do estímulo nervoso, especialmente o da sensibilidade, e as vezes dos movimentos. Provoca um estado de insensibilidade temporária, sem alteração do nível de consciência e do controle da respiração. As mais freqüentes são as Raquianestesia e a Anestesia Peridural, também conhecidas como bloqueios espinhais em que, uma parte do corpo fica anestesiada. </h1>

                 <h1><b>Outros tipos de anestesia regional são:</b></h1>

                 <h1><b>Anestesia Local </b> que é feita numa pequena área do corpo tornando-o insensível temporariamente. </h1>

                 <h1><b>Anestesia Troncular ou Plexolares:</b> onde apenas um nervo de um conjunto deles é bloqueado com anestésico local, promovendo anestesia em uma região ou membro inervado por este nervo. </h1>

                 <h1><b>Na anestesia local ou regional</b>, o paciente pode ficar acordado ou não. Em cirurgias rápidas em pacientes calmos, não há necessidade de ficar inconsciente. Em cirurgias mais longas ou em pacientes mais nervosos, é comum a utilização da sedação, ou seja, o paciente ficará dormindo durante a cirurgia sem a perda da consciência como na anestesia geral. </h1>

                 <h1><b>Observação:</b> em casos de falha da anestesia regional, ou intercorrências em que a estabilidade do organismo seja alterada, poderá ser necessário mudar a técnica regional para a anestesia geral, para que o anestesiologista possa ter um controle melhor dos sinais vitais do paciente e controlar alterações que possam ocorrer. </h1>

                 <h1><b>Avaliação pré-operatória ou Pré-Anestésica:</b> Trata-se de um exame clínico e deve ser feito, preferencialmente com alguns dias de antecedência ao ato cirúrgico. </h1>

                 <h1>O anestesiologista deve conhecer as condições de saúde do paciente com antecedência,para que ele possa desempenhar seu trabalho de maneira mais adequada e dar mais segurança ao paciente. </h1>

                 <h1>A história médica, o exame físico, e possíveis exames de laboratório fornecem informações para que o anestesiologista decida qual a técnica mais indicada. </h1>

                 <h1>Nenhum julgamento sobre a pessoa ou seus atos será realizado e a informação prestada será mantida em sigilo médico, portanto, o paciente deve informar a verdade sobre todas as perguntas realizadas, ainda que algumas possam parecer constrangedoras, nada deve ser omitido. O uso de cigarros, bebidas, alcoólicas, medicamentos, drogas de uso lícito ou ilícito deverá ser informado. Informar também sobre a alergia a remédios ou a outros produtos, se já realizou alguma cirurgia, se houve alguma experiência ruim ou reação em si mesmo ou em parente próximo. </h1>

                 <h1>O paciente deverá ficar em jejum antes da cirurgia (não deve ingerir nenhum tipo de alimento nem água), pois o estômago vazio é muito importante para garantir mais segurança ao ato anestésico, e o tempo mínimo de jejum será informado pelo anestesiologista ou pelo cirurgião dependendo da hora da cirurgia. </h1>

                 <h1><b>É IMPORTANTE DEIXAR O ANESTESISTA BEM INFORMADO A RESPEITO DO SEU ESTADO CLÍNICO, SEGUIR SUAS ORIENTAÇÕES, ESCLARECER SUAS DÚVIDAS E DISCUTIR COM ELE COMO SERÁ O CONTROLE DA DOR NO PÓS-OPERATÓRIO. </b></h1>

                 <h1><b>Finalmente, após sentir-se tranqüilo, deve ser dado o consentimento para a técnica de anestesia que está sendo proposta. </b></h1>

                 <h1>Fonte: <b>Sociedade Brasileira de Anestesiologia </b></h1>

                 <h1>Sites de referência: www.sba.com.br   /   www.saesp.org.br</h1>

                 <h1></h1>

                 <br>
                 <br>

             </div>

             <div class='col-hss-1' style='height: 600px; margin: 1px; '>
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

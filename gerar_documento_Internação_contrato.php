<?php

session_start();	

@$var_cd_atendimento = $_REQUEST['cd_atendimento'];
@$var_nm_paciente = $_REQUEST['nm_paciente'];
@$dt_aten = $_REQUEST['dt_aten'];
@$nm_conv = $_REQUEST['nm_conv'];
$img = $_REQUEST['escondidinho'];
$tp_doc = 'cont_int';

$nm_documneto = 'pdf_term_cirurgia_'.$var_cd_atendimento.'.pdf';

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
    font-size: 9px;
    line-height: 15px !important; 
    text-align: left !important;
}
 h3{
     font-size: 5px;
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


    <form style='height: 00px;'>
        <div class='col-hss-12' style='height: 45px; margin: 1px; text-align: center;' >
            <img class='imagem' src='https://i2.wp.com/santacasasaude.com.br/wp-content/uploads/2018/07/Santa-Casa-SJC.gif?fit=730%2C457&ssl=1' style='width: 140px; height: 60px;'>
        </div>
    </form>
        
         <form style='height: 0px;'>
             <div class='container'>
    
                 <div class='row'>
                        <div class='col-hss-12' style='height: 30px; margin: 1px;'>
                            <h2><b>TERMO DE RESPONSABILIDADE E CONSENTIMENTO INFORMADO PARA CIRURGIA</b></h2>
                        </div>
                 </div>
             </div>
         </form>
             <div class='container'>
 
                <!--TEXTO-->
                 <div class='row '>
                    <div class='col-hss-1' style='height: 700px; margin: 1px;'>
                    </div>

                     <div class='col-hss-10' style='height: 700px; margin: 1px;'>
                                 
                        <h1>Paciente:<b> ".@$dados_result_term_cirurgia['PACIENTE']." </b>Prontuário:<b> ".@$dados_result_term_cirurgia['PRONTUARIO']." </b></h1>

                        <h1>Data da Internação:<b> ".@$dados_result_term_cirurgia['DATA_ATENDIMENTO']." </b> Leito: __________</h1>

                        <h1>Pelo presente instrumento e na melhor forma de direito, eu _______________________________, portador (a) da Cédula de Identidade R. G. nº ______________________ devidamente inscrito (a) no CPF/MF sob o nº______________________, telefone (___) ______________, residente e domiciliado (a) na _______________________________________________________________________________________, assumo a total responsabilidade, na qualidade de devedor solidário e/ou principal pelas despesas de serviços, médicos e hospitalares, medicamentos, materiais e exames laboratoriais ou imagens, inclusive pelos serviços, materiais e medicamentos fornecidos por terceiros para o (a) paciente <b> ".@$dados_result_term_cirurgia['PACIENTE']." </b>, portador (a) da Cédula de Identidade RG nº <b> ".@$dados_result_term_cirurgia['RG']." </b> devidamente inscrito no CPF/MF sob o nº <b> ".@$dados_result_term_cirurgia['CPF']." </b> residente e domiciliado (a) na <b> ".@$dados_result_term_cirurgia['ENDERECO']." </b>, telefone <b> ".@$dados_result_term_cirurgia['NR_CELULAR']." </b>. Internado (a) na data <b> ".@$dados_result_term_cirurgia['DATA_ATENDIMENTO']." </b>, por determinação do (a) Dr. (a) ___________________________ devidamente inscrito (a) no CRM sob o nº ___________.</h1>

                        <br>

                        <h1>OBJETO: A prestação de serviços médicos/hospitalares ao paciente retro qualificado, internado nas dependências da CONTRATADA, por determinação do Médico Responsável acima identificado, ficando a CONTRATADA expressamente autorizada a executar, por si ou por terceiros especializados, todos os procedimentos diagnósticos e/ou terapêuticos, clínicos, cirúrgicos e/ou laboratoriais que venham a participar do atendimento e que façam necessários e indispensáveis a salvaguarda da vida do paciente para outro local ou hospital para promover o adequado tratamento necessário ao mesmo.</h1>
            
                        <h1>PAGAMENTO: Os valores referentes tanto para parte médica como para parte hospitalar serão apurados em tríduos e apresentados ao CONTRATANTE juntamente como os respectivos demonstrativos para efetuar os respectivos pagamentos.</h
                        <h1>Após a alta do (a) paciente acima identificado (a), será apurado o valor do período remanescente a última apuração e efetivo pagamento.</h
                        <h1>Os valores apresentados ao CONTRATANTE passarão a fazer parte integrante do presente instrumento.</h1>
            
                        <h1>Todos os custos e intercorrências serão comunicados com antecedência ao CONTRATANTE, caso haja possibilidade e tempo suficiente para tanto.</h
                        <h1>Caso seja necessário, no curso do tratamento, o adiantamento de valores não previstos neste contrato o CONTRATANTE desde já se compromete a depositá-los no prazo máximo de 12h, junto à CONTRATADA.</h
                        <h1>No caso de cobertura por CONVÊNIO MÉDICO, fica concedida ao paciente a utilização do PLANO DE ASSISTÊNCIA MÉDICA com qual a CONTRATADA mantém convênio, ficando observado que as despesas não cobertas por este PLANO DE SAÚDE serão de responsabilidade do CONTRATANTE.</h
                        <h1>A responsabilidade da CONTRATADA estará sempre vinculada aos serviços e atendimento que forem por ela prestados, sem prejuízo de eventual responsabilidade solidária com terceiros (médicos, laboratórios e outros), ou exclusiva destes que venham a participar dos procedimentos clínico-cirúrgicos que forem adotados.</h
                        <h1>DIREITOS/CARÊNCIAS/EXCLUSÕES: O CONTRATANTE e o paciente têm pleno conhecimento dos DIREITOS, CARÊNCIAS E EXCLUSÕES, contratualmente estabelecidas no PLANO DE SAÚDE, com o qual o paciente mantém contrato.</h
                        <h1>MÉDICO RESPONSÁVEL: Os médicos responsáveis pela internação e pelo tratamento serão escolhidos pelo CONTRANTE e/ou pelo paciente, sendo certo que os honorários profissionais decorrentes do atendimento serão da sua exclusiva responsabilidade, sem qualquer vinculação com a CONTRATADA e, serão saldados com recursos próprios ou através da utilização do plano de assistência médica.</h
                        <h1>REGULAMENTO INTERNO E VALORES DE DIÁRIAS E PROCEDIMENTOS: O CONTRATANTE declara expressamente ter ciência nesta data da tabela de preços de diárias vigentes na data de internação, tendo conhecimento de que os preços dos medicamentos, exames laboratoriais, materiais e outros, serão aplicados de acordo com a Tabela Vigente na data de cada procedimento efetuado. Se por eventualidade for necessário a utilização de horas excedentes de centro cirúrgico dos previstos na tabela de procedimentos estéticos / plásticas, os mesmos serão cobrados do CONTRATANTE.</h
                        <h1>Declara haver recebido o Guia de Orientações que contém as normas do complexo hospitalar Santa Casa, comprometendo-se a cumpri-lo e dar o seu conhecimento ao paciente, seus familiares e visitantes, que fica fazendo parte integrante deste instrumento.</h
                        <h1>HIPÓTESE DE INADIMPLÊNCIA: Na hipótese de não cumprimento espontâneo das obrigações assumidas, acarretando via de conseqüência, cobrança judicial dos títulos sacados, assume, também, a responsabilidade pelo pagamento das custas e despesas processuais/extrajudiciais, dos juros legais, da correção monetária, calculada “PRÓ-RATA TEMPORE”, e incidente sobre o valor total do débito e dos honorários advocatícios devidos também no caso de cobrança amigável.</h
                        <h1>FORNECIMENTO DE MATERIAL: Se no tratamento dispensado ao PACIENTE for necessária a utilização de qualquer material especial, poderá a CONTRATANTE fornecer o respectivo material diretamente, desde que cumpridas às exigências que para este fim venham a ser apresentadas pela CONTRATADA, notadamente no que se refere aos critérios e procedimentos relativos à esterilização do material. Caso seja necessária a efetivação de atendimento de “URGÊNCIA”, imperiosa a salvaguarda da vida do paciente, estará a CONTRATADA expressamente autorizada a adquirir o material requisitado pela equipe médica e realizar o respectivo fornecimento, independentemente de qualquer outra autorização ou formalidade. Se por eventualidade e indicação médica, for necessário a utilização de fios excedentes dos previstos na tabela de procedimentos estéticos / plásticas, os mesmos serão cobrados do CONTRATANTE.</h
                        <h1>TRANSFERÊNCIA: O CONTRATANTE autoriza, desde já, a CONTRATADA a efetivar a transferência do paciente para outro hospital, caso venha a descumprir com as obrigações assumidas neste instrumento, desde que o quadro clínico do internado assim o permita, e sem restrição médica.</h
                        <h1>ALTA DO PACIENTE: Após a alta, o paciente terá duas horas para liberar a acomodação, pois estará sujeito a cobrança particular do período excedente.</h
                        <h1>FORO DE ELEIÇÃO: Fica eleito o Foro da comarca de São José dos Campos, como competente para dirimir todas as dúvidas que por ventura venham a ser suscitada com relação aos serviços prestados no esteio do presente instrumento, ressalvada a hipótese do artigo 51, parágrafo primeiro, III da Lei nº 8.078 de 11 de setembro de 1990 (Código de Defesa do Consumidor).</h
                        <h1>E, por estarem assim justos e contratados, assinam o presente instrumento Particular de Contrato de Assistência Médica Hospitalar, em duas vias de igual teor e forma, na presença de duas testemunhas, para que produza seus jurídicos e legais efeitos.</h
                        <h1>Declaro que recebi, li e compreendi o guia geral do hospital com todas as informações necessárias para a internação.</h1>

                        <br>

                     </div>

                    <div class='col-hss-1' style='height: 700px; margin: 1px;'>
                    </div>   

                </div>

                <div class='row'>

                    <div class='col-hss-1' style='height: 20px; margin: 1px;'>
                    </div>

                    <div class='col-hss-10' style='height: 20px; margin: 1px;'>
                        <h2>São José dos Campos,<b> ".@$dados_result_term_cirurgia['DIA_ATD']." </b>de<b> ".@$dados_result_term_cirurgia['MES_EXTENSO']." </b>de<b> ".@$dados_result_term_cirurgia['ANO_ATD']." </b></h2>
                    </div>

                    <div class='col-hss-1' style='height: 20px; margin: 1px;'>
                    </div>
                </div> 

                    
                <div class='row'>


                    <div class='col-hss-4' style='height: 50px; margin: 1px; border: none !important; border-bottom: solid 1px black !important'>
                        <h1>Assinatura do (a) Paciente: </h1>
                        <img src='$img' width='70%' height='70%'>
                        
                    </div>

                    <div class='col-hss-2' style='height: 40px; margin: 1px;'>
                    </div>

                    <div class='col-hss-4' style='height: 50px; margin: 1px; border: none !important; border-bottom: solid 1px black !important'>
                        <h1>Assinatura do Responsável: </h1>
                    </div>

                 
                </div> 

                <div class='row'>

        
                    <div class='col-hss-4' style='height: 50px; margin: 1px; border: none !important; border-bottom: solid 1px black !important'>
                        <h1>Testemunhas: </h1>
                    </div>
                    <div class='col-hss-2' style='height: 40px; margin: 1px;'>
                    </div>

                    <div class='col-hss-4' style='height: 50px; margin: 1px; border: none !important; border-bottom: solid 1px black !important'>
                        <h1>Testemunhas: </h1>
                    </div>
                </div> 








                    <div class='row'>
                        <div class='col-hss-1' style='height: 60px; margin: 1px; '>
                        </div>
                        <div class='col-hss-4' style='height: 0px; border: none !important; border-bottom: solid 1px black !important; '>
                        <img src='$img' width='0%' height='0%'>
                    </div>
                        <div class='col-hss-4' style='height: 80px; margin: 1px;'>
                                <h1>Assinatura do (a) Paciente: </h1>
                            <div class='col-hss-8' style='height: 45px; border: none !important; border-bottom: solid 1px black !important; '>
                               
                            </div>
                        </div>

                        <div class='col-hss-1' style='height: 60px; margin: 1px; '>
                        </div>

                        <div class='col-hss-4' style='height: 80px; margin: 1px;'>
                            <h1>Assinatura do Responsável: </h1>
                            <div class='col-hss-8' style='height: 45px; border: none !important; border-bottom: solid 1px black !important;'></div>
                        </div>

                       
                        
                    </div>
             </div>
          </div>
         </form>
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

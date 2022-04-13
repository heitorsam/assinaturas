<?php

session_start();	

@$var_cd_atendimento = $_REQUEST['cd_atendimento'];
@$var_nm_paciente = $_REQUEST['nm_paciente'];
@$dt_aten = $_REQUEST['dt_aten'];
@$nm_conv = $_REQUEST['nm_conv'];
$nm_documneto = 'pdf_assinatura_'.$var_cd_atendimento.'.pdf';

@$_SESSION['atdconsulta'] = $_REQUEST['cd_atendimento'];

$var_user_logado = $_SESSION['usuarioNome'];

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
     padding: 3 1 1 3;
     border: solid 1px black !important;
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
    font-size: 12px;
    line-height: 15px !important; 
    text-align: justify !important;
}
h2{
    font-size: 12px;
    line-height: 15px !important; 
    text-align: right !important;
}
 h3{
     font-size: 15px;
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
 B{
     
     text-transform: uppercase;
    }

 </style> 


    <form style='height: 100px;'>
        <div class='col-hss-12' style='border: none !important; text-align: center;'>
            <img class='imagem' src='https://i2.wp.com/santacasasaude.com.br/wp-content/uploads/2018/07/Santa-Casa-SJC.gif?fit=730%2C457&ssl=1' style='width: 200px; height: 110px;'>
        </div>
    </form>
        
         <form style='height: 50px;'>
             <div class='container'>
               

                 <div class='row'>

                        <div class='col-hss-12' style='height: 30px; margin: 1px; '>
                            <h3><b>CONTRATO DE PRESTAÇÃO DE SERVIÇOS - INTERNAÇÃO</b></h3>
                        </div>
                 </div>
             </div>
         </form>
             <div class='container'>
 
                <!--TEXTO-->
                 <div class='row '>
                    <div class='col-hss-1' style='height: 1050px; margin: 1px; '>
                    </div>

                     <div class='col-hss-10' style='height: 1050px; margin: 1px; '>
                        
                            <p><h1>OBJETO: A prestação de serviços médicos/hospitalares ao paciente retro qualificado, internado nas dependências da CONTRATADA, por determinação do Médico Responsável acima identificado, ficando a CONTRATADA expressamente autorizada a executar, por si ou por terceiros especializados, todos os procedimentos diagnósticos e/ou terapêuticos, clínicos, cirúrgicos e/ou laboratoriais que venham a participar do atendimento e que façam necessários e indispensáveis a salvaguarda da vida do paciente para outro local ou hospital para promover o adequado tratamento necessário ao mesmo.</h1>
                            
                            <p><h1>PAGAMENTO: Os valores referentes tanto para parte médica como para parte hospitalar serão apurados em tríduos e apresentados ao CONTRATANTE juntamente como os respectivos demonstrativos para efetuar os respectivos pagamentos.</h1>

                            <p><h1>Após a alta do (a) paciente acima identificado (a), será apurado o valor do período remanescente a última apuração e efetivo pagamento.</h1>

                            <p><h1>Os valores apresentados ao CONTRATANTE passarão a fazer parte integrante do presente instrumento.</h1>
                            
                            <p><h1>Todos os custos e intercorrências serão comunicados com antecedência ao CONTRATANTE, caso haja possibilidade e tempo suficiente para tanto.</h1>

                            <p><h1>Caso seja necessário, no curso do tratamento, o adiantamento de valores não previstos neste contrato o CONTRATANTE desde já se compromete a depositá-los no prazo máximo de 12h, junto à CONTRATADA.</h1>

                            <p><h1>No caso de cobertura por CONVÊNIO MÉDICO, fica concedida ao paciente a utilização do PLANO DE ASSISTÊNCIA MÉDICA com qual a CONTRATADA mantém convênio, ficando observado que as despesas não cobertas por este PLANO DE SAÚDE serão de responsabilidade do CONTRATANTE.</h1>

                            <p><h1>A responsabilidade da CONTRATADA estará sempre vinculada aos serviços e atendimento que forem por ela prestados, sem prejuízo de eventual responsabilidade solidária com terceiros (médicos, laboratórios e outros), ou exclusiva destes que venham a participar dos procedimentos clínico-cirúrgicos que forem adotados.</h1>

                            <p><h1>DIREITOS/CARÊNCIAS/EXCLUSÕES: O CONTRATANTE e o paciente têm pleno conhecimento dos DIREITOS, CARÊNCIAS E EXCLUSÕES, contratualmente estabelecidas no PLANO DE SAÚDE, com o qual o paciente mantém contrato.</h1>

                            <p><h1>MÉDICO RESPONSÁVEL: Os médicos responsáveis pela internação e pelo tratamento serão escolhidos pelo CONTRANTE e/ou pelo paciente, sendo certo que os honorários profissionais decorrentes do atendimento serão da sua exclusiva responsabilidade, sem qualquer vinculação com a CONTRATADA e, serão saldados com recursos próprios ou através da utilização do plano de assistência médica.</h1>

                            <p><h1>REGULAMENTO INTERNO E VALORES DE DIÁRIAS E PROCEDIMENTOS: O CONTRATANTE declara expressamente ter ciência nesta data da tabela de preços de diárias vigentes na data de internação, tendo conhecimento de que os preços dos medicamentos, exames laboratoriais, materiais e outros, serão aplicados de acordo com a Tabela Vigente na data de cada procedimento efetuado. Se por eventualidade for necessário a utilização de horas excedentes de centro cirúrgico dos previstos na tabela de procedimentos estéticos / plásticas, os mesmos serão cobrados do CONTRATANTE.</h1>

                            <p><h1>Declara haver recebido o Guia de Orientações que contém as normas do complexo hospitalar Santa Casa, comprometendo-se a cumpri-lo e dar o seu conhecimento ao paciente, seus familiares e visitantes, que fica fazendo parte integrante deste instrumento.</h1>

                            <p><h1>HIPÓTESE DE INADIMPLÊNCIA: Na hipótese de não cumprimento espontâneo das obrigações assumidas, acarretando via de conseqüência, cobrança judicial dos títulos sacados, assume, também, a responsabilidade pelo pagamento das custas e despesas processuais/extrajudiciais, dos juros legais, da correção monetária, calculada “PRÓ-RATA TEMPORE”, e incidente sobre o valor total do débito e dos honorários advocatícios devidos também no caso de cobrança amigável.</h1>

                            <p><h1>FORNECIMENTO DE MATERIAL: Se no tratamento dispensado ao PACIENTE for necessária a utilização de qualquer material especial, poderá a CONTRATANTE fornecer o respectivo material diretamente, desde que cumpridas às exigências que para este fim venham a ser apresentadas pela CONTRATADA, notadamente no que se refere aos critérios e procedimentos relativos à esterilização do material. Caso seja necessária a efetivação de atendimento de “URGÊNCIA”, imperiosa a salvaguarda da vida do paciente, estará a CONTRATADA expressamente autorizada a adquirir o material requisitado pela equipe médica e realizar o respectivo fornecimento, independentemente de qualquer outra autorização ou formalidade. Se por eventualidade e indicação médica, for necessário a utilização de fios excedentes dos previstos na tabela de procedimentos estéticos / plásticas, os mesmos serão cobrados do CONTRATANTE.</h1>

                            <p><h1>TRANSFERÊNCIA: O CONTRATANTE autoriza, desde já, a CONTRATADA a efetivar a transferência do paciente para outro hospital, caso venha a descumprir com as obrigações assumidas neste instrumento, desde que o quadro clínico do internado assim o permita, e sem restrição médica.</h1>

                            <p><h1>ALTA DO PACIENTE: Após a alta, o paciente terá duas horas para liberar a acomodação, pois estará sujeito a cobrança particular do período excedente.</h1>

                            <p><h1>FORO DE ELEIÇÃO: Fica eleito o Foro da comarca de São José dos Campos, como competente para dirimir todas as dúvidas que por ventura venham a ser suscitada com relação aos serviços prestados no esteio do presente instrumento, ressalvada a hipótese do artigo 51, parágrafo primeiro, III da Lei nº 8.078 de 11 de setembro de 1990 (Código de Defesa do Consumidor).</h1>

                            <p><h1>E, por estarem assim justos e contratados, assinam o presente instrumento Particular de Contrato de Assistência Médica Hospitalar, em duas vias de igual teor e forma, na presença de duas testemunhas, para que produza seus jurídicos e legais efeitos.</h1>

                            <p><h1>Declaro que recebi, li e compreendi o guia geral do hospital com todas as informações necessárias para a internação.</h1>

                        

          
                            <br>
                            <br>

                     </div>

                    <div class='col-hss-1' style='height: 1050px; margin: 1px; '>
                    </div>   
                 </div>
                    <div class='row'>

                        <div class='col-hss-1' style='height: 40px; margin: 1px; '>
                        </div>

                        <div class='col-hss-10' style='height: 40px; margin: 1px; '>
                            <h2><p>São José dos Campos,<b> ".@$dados_result_term_cirurgia['DIA_ATD']." </b>de<b> ".@$dados_result_term_cirurgia['MES_EXTENSO']." </b>de<b> ".@$dados_result_term_cirurgia['ANO_ATD']." </b></h2>
                        </div>

                        <div class='col-hss-1' style='height: 40px; margin: 1px; '>
                        </div>
                    </div> 

                    
                    <div class='row'>
                        <div class='col-hss-1' style='height: 60px; margin: 1px; '>
                        </div>

                        <div class='col-hss-4' style='height: 60px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
                            <h1><p>Assinatura do Paciente: </h1>
                        </div>

                        <div class='col-hss-1' style='height: 60px; margin: 1px; '>
                        </div>

                        <div class='col-hss-4' style='height: 60px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
                            <h1><p>Assinatura do Responsável: </h1>
                        </div>

                        <div class='col-hss-1' style='height: 60px; margin: 1px; '>
                        </div>
                    </div>
                    
                    <div class='row'>
                        <div class='col-hss-1' style='height: 60px; margin: 1px; '>
                        </div>

                        <div class='col-hss-4' style='height: 60px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
                            <h1><p>Assinatura do Paciente: </h1>
                        </div>

                        <div class='col-hss-1' style='height: 60px; margin: 1px; '>
                        </div>

                        <div class='col-hss-4' style='height: 60px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
                            <h1><p>Assinatura do Responsável: </h1>
                        </div>

                        <div class='col-hss-1' style='height: 60px; margin: 1px; '>
                        </div>
                    </div> 

             </div>
          </div>
         </form>
 ";
//visualiza documentTemplate
echo  json_encode(array($documentTemplate)); 
//echo $documentTemplate;
?>

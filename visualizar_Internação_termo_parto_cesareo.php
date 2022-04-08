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
    font-size: 13px;
    line-height: 15px !important; 
    text-align: justify !important;
}
h2{
    font-size: 13px;
    line-height: 20px !important; 
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
                            <h3><b>TERMO DE CONSENTIMENTO LIVRE E ESCLARECIDO PARTO CESÁREO</b></h3>
                        </div>
                 </div>
             </div>
         </form>
             <div class='container'>
 
                <!--TEXTO-->
                 <div class='row '>
                    <div class='col-hss-1' style='height: 500px; margin: 1px; '>
                    </div>

                     <div class='col-hss-10' style='height: 500px; margin: 1px; '>
                        
                            <p><h1>Eu, <b>".@$dados_result_term_cirurgia['PACIENTE']."</b>, ______________________ (nacionalidade), portadora do RG <b>".@$dados_result_term_cirurgia['RG']."</b> e inscrita no CPF/MF sob nº <b>".@$dados_result_term_cirurgia['CPF']."</b>, residente e domiciliada na <b>".@$dados_result_term_cirurgia['ENDERECO']."</b>, <b>".@$dados_result_term_cirurgia['CIDADE'].",</b> / <b>".@$dados_result_term_cirurgia['ESTADO']."</b>, declaro para os devidos fins minha decisão de realizar PARTO CESÁREO.</h1>


                            <br>

                            <p><h1>Declaro ter ciência de que o parto normal é considerado a melhor via de parto em condições normais de gestação conforme descrito pela literatura médica. </h1>
                            
                            

                            <p><h1>Declaro ainda ter sido informada pelo Dr(a)._________________________, CRM/SP ______________ que que a cesárea representa, em condições normais, maiores riscos para a mãe e o bebê, sendo os mais comuns infecção, hemorragia, atonia uterina (quando o útero não contrai após o nascimento da criança), histerectomia (retirada cirúrgica do útero), a possibilidade de transfusão de sangue e infecção da cicatriz operatória (corte da cesárea) e ainda de que, como em toda intervenção cirúrgica, existe risco excepcional de mortalidade derivado do próprio ato cirúrgico ou da situação vital de cada paciente.</h1>
                         

                            <p><h1>Declaro estar ciente da necessidade de procedimento anestésico para a realização da cesárea, o que envolve riscos inerentes ao procedimento, inclusive em situações excepcionais poderão ocorrer reações alérgicas, incluindo anafilaxia, afecções circulatórias, flebites, complicações infecciosas ou outros eventos adversos mais raros.</h1>


                            <p><h1>Declaro ter sido informada de que ficarei com uma cicatriz decorrente da intervenção cirúrgica, podendo ocorrer a formação de queloide (cicatriz alta com forma de cordão, podendo gerar irritação local) ou ainda cicatrização hipertrófica, que não são estéticas e, independem da habilidade do meu médico, visto que dependem das características pessoais de cada paciente.</h1>

                            
                            <p><h1>Declaro estar ciente de que a data da cesárea será definida pelo (a) médico (a) assistente, de acordo com a literatura médica, devendo ocorrer entre 39 semanas e 40 semanas e 6 dias, visando a completa maturidade do feto.</h1>

                            
                            <p><h1>Declaro, por fim, que tive a oportunidade de esclarecer todas as minhas dúvidas e mantido minha decisão de realizar parto cesárea. </h1>


                            <p><h1>Este documento foi elaborado em duas vias, sendo que uma ficará com o obstetra responsável e a outra, com a gestante.</h1>

                            <br>
                            <br>

                     </div>

                    <div class='col-hss-1' style='height: 500px; margin: 1px; '>
                    </div>   
                 </div>
                    <div class='row'>

                        <div class='col-hss-1' style='height: 40px; margin: 1px; '>
                        </div>

                        <div class='col-hss-10' style='height: 40px; margin: 1px; '>
                            <h1><p>São José dos Campos,<b> ".@$dados_result_term_cirurgia['DIA_ATD']." </b>de<b> ".@$dados_result_term_cirurgia['MES_EXTENSO']." </b>de<b> ".@$dados_result_term_cirurgia['ANO_ATD']." </b></h1>
                        </div>

                        <div class='col-hss-1' style='height: 40px; margin: 1px; '>
                        </div>
                    </div> 

                    
                    <div class='row'>
                        <div class='col-hss-1' style='height: 40px; margin: 1px; '>
                        </div>

                        <div class='col-hss-5' style='height: 40px; margin: 1px; border-style: none !;'>
                            <h1><p>Assinatura da gestante: </h1>
                        </div>

                        <div class='col-hss-5' style='height: 40px; margin: 1px; border-style: none !;'>
                            <h1><p>Assinatura do obstetra: </h1>
                        </div>

                        <div class='col-hss-1' style='height: 40px; margin: 1px; '>
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

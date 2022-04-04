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
 
 include 'sql_consulta_guia_consulta.php';
 
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
     height: 15px !important;
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
     width: 41.25% !important;
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
 h4{
    font-size: 10px;
    line-height: 100px !important; 
    text-align: center !important;
}
h3{
    font-size: 15px;
    line-height: 100px !important; 
    text-align: center !important;
}
 h2{
     font-size: 10px;
     line-height: 4px;
     float: center;
     margin-top: 0px; 
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
         <form style='height: 10px;'>
             <div class='container'>
                 <div class='row'>
                    
                        
                        <div class='col-hss-12' style='height: 100px; margin: 1px;'>
                            <h3><b>ATENÇÃO</b></h3>
                        </div>
                        
                    
                 </div>
             </div>
         </form>
         </br>
         </br>
         </br>
         
         

         </br>
         <form>
             <!--Primeiras infos -->
             <div class='container'>
                 <div class='row '>
                     <div class='col-hss-12' style='height: 100px; margin: 1px;'>

                     <p>Em caráter preventivo e de alerta, a Santa Casa de São José dos Campos comunica que está ocorrendo um tipo de golpe aplicado em hospitais, com a finalidade de obter vantagens financeiras em toda a região.

                     <p>O golpe consiste em indivíduos ligarem para pacientes e/ou familiares, apresentando-se como médicos, fornecedores ou funcionários da Santa Casa de São José dos Campos e, aproveitando-se da boa fé e momento de fragilidade da situação, convencem que seja feito um pagamento para custear medicamentos, realização de exames e/ou procedimentos.

                     <p>A Santa Casa de São José dos Campos esclarece que não solicita através de ligações a realização de depósitos de qualquer espécie em contas do Hospital.

                     <p>Orientamos também que não seja realizado qualquer tipo de depósito, TED, DOC ou outras formas de pagamento e divulgação de dados pessoais e de pacientes internados para pessoas desconhecidas.

                     <p>Diante disso, orientamos que qualquer ligação ou abordagem que gere dúvidas, sejam imediatamente informadas ao hospital através do telefone (12) 3876-1999 e que também entrem em contato com a polícia para realização de um Boletim de Ocorrência.
                     
                     <p>Declaramos que a Santa Casa não tem qualquer responsabilidade com a situação acima descrita, visto que tal fraude é proveniente de ambiente externo ao Hospital, portanto não ressarcirá qualquer importância em decorrência do golpe.
                     
                        
                     </div>

                     
                 </div>
                 <!-- FIM Primeiras infos -->
             
                 <!-- ---------------------------------------------------------------------------------------------------------------------------------------- -->
                
               
             </div>
          </div>
         </form>
 ";
//visualiza documentTemplate
//echo  json_encode(array($documentTemplate)); 
echo $documentTemplate;
?>

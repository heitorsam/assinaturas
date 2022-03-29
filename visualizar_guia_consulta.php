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
     width: 49.03% !important;
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
     width: 15.80% !important;
     height: 20px;
     float: left;
     
 }
 .col-hss-1{
     width: 7.90% !important;
     height: 20px;
     float: left;
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

 </style> 
         <form style='height: 10px;'>
             <div class='container'>
             
             

                 <div class='row'>
                    <div class='col-hss-12'  style='text-align: center; height: 90px; '>
                   
                        <div class='col-hss-5' style='height: 60px; border: none !important;'>
                        </div>
                        <div class='col-hss-2' style='text-align: center; height: 60px; border: none !important;'>
                            <h1><b>GUIA DE CONSULTA</b></h1>
                        </div>
                        <div class='col-hss-5' style='text-align: center; height: 30px; padding-top: 30px; border: none !important;'>
                            <h2><b>2 - N° no Prestador: ".@$row_cons_guia_consulta['CP_02']."</b></h2>
                        </div>
                    </div>
                 </div>
             </div>
         </form>
         </br>
         </br>
         

         </br>
         <form >
             <!--Primeiras infos -->
             <div class='container'>
                 <div class='row '>
                     <div class='col-hss-2' style='height: 30px;'>
                         1 - Registro ANS
                         <P>
                         <h2>".@$row_cons_guia_consulta['CP_01']."</h2>
                     </div>

                     <div class='col-hss-10' style='height: 30px;'>
                        3 - Númeo da Guia Atribuído pela Operadora
                         <P>
                         <h2>".@$row_cons_guia_consulta['CP_03']."</h2>
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
                     <div class='col-hss-8' style='height: 30px;'>
                     4 - Número da Carteira
                        <P>
                         <h2>".@$row_cons_guia_consulta['CP_04']."</h2>
                     </div>
                     <div class='col-hss-2' style='height: 30px;'>
                     5 - Validade da Carteira
                        <P>
                         <h2>".@$row_cons_guia_consulta['CP_05']."</h2>
                     </div>
                     <div class='col-hss-2' style='height: 30px;'>
                     6 - Atendimento a RN (Sim ou Não)
                        <P>
                         <h2>".@$row_cons_guia_consulta['CP_06']."</h2>
                     </div>
                </div>

                <div class='row'>
                     <div class='col-hss-9' style='height: 30px;'>
                    7 - Nome
                        <P>
                         <h2>".@$row_cons_guia_consulta['CP_07']."</h2>
                     </div>
                     <div class='col-hss-3' style='height: 30px;'>
                     8 - Cartão Nacional de Saúde
                        <P>
                         <h2>".@$row_cons_guia_consulta['CP_08']."</h2>
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
                     <div class='col-hss-3' style='height: 30px;'>
                     9 - Código da Operadora
                        <P>
                         <h2>".@$row_cons_guia_consulta['CP_09']."</h2>
                     </div>
                     <div class='col-hss-7' style='height: 30px;'>
                     10 - Nome do Contratado
                        <P>
                         <h2>".@$row_cons_guia_consulta['CP_10']."</h2>
                     </div>
                     <div class='col-hss-2' style='height: 30px;'>
                     11 - Código CNES
                         <P>
                         <h2>".@$row_cons_guia_consulta['CP_11']."</h2>
                     </div>
                 </div>

                 <div class='row'>
                     <div class='col-hss-5' style='height: 30px;'>
                     12 - Nome do Profissional Executante
                         <P>
                         <h2>".@$row_cons_guia_consulta['CP_12']."</h2>
                     </div>
                     <div class='col-hss-2' style='height: 30px;'>
                     13 - Conselho Profissional
                         <P>
                         <h2>".@$row_cons_guia_consulta['CP_13']."</h2>
                     </div>
                     <div class='col-hss-2' style='height: 30px;'>
                     14 - Número no Conselho
                         <P>
                         <h2>".@$row_cons_guia_consulta['CP_14']."</h2>
                     </div>
                     <div class='col-hss-1' style='height: 30px;'>
                     15 - UF
                         <P>
                         <h2>".@$row_cons_guia_consulta['CP_15']."</h2>
                     </div>
                     <div class='col-hss-2' style='height: 30px;'>
                     16 - Código CBO
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
                     <div class='col-hss-3' style='height: 35px;' >
                     17 - Indicação de Acidente (Acidente ou doença relacionada)
                         <P>
                         <h2>".@$row_cons_guia_consulta['CP_17']."</h2>
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
                     <div class='col-hss-3' style='height: 30px;'>
                     18 - Data de Atendimento
                         <P>
                         <h2>".@$row_cons_guia_consulta['CP_18']."</h2>
                     </div>
                     <div class='col-hss-2' style='height: 30px;'>
                     19 - Tipo de Consulta
                         <P>
                         <h2>".@$row_cons_guia_consulta['CP_19']."</h2>
                     </div>
                     <div class='col-hss-2' style='height: 30px;'>
                     20 - Tabela
                         <P>
                         <h2>".@$row_cons_guia_consulta['CP_20']."</h2>
                     </div>
                     <div class='col-hss-3' style='height: 30px;'>
                     21 - Código Procedimento
                         <P>
                         <h2>".@$row_cons_guia_consulta['CP_21']."</h2>
                     </div>
                     <div class='col-hss-2' style='height: 30px;'>
                     22 - Valor do Procedimento
                         <P>
                         <h2>".@$row_cons_guia_consulta['CP_22']."</h2>
                     </div>
                 </div>

                 <div class='row'>
                     <div class='col-hss-12' style='height: 75px;'>
                     23 - Observação
                         <br>
                         <h2>".@$row_cons_guia_consulta['CP_23']."</h2>
                     </div>    
                 </div>

                 <div class='row'>
                     <div class='col-hss-6' style='height: 45px;'>
                     24 - Assinatura do Profissional Executante
                         <P>
                         <h2>".@$row_cons_guia_consulta['CP_24']."</h2>
                     </div>
                     
                     <div class='col-hss-6' style='height: 45px;'>
                     25 - Assinatura do Beneficiário ou Responsável
                         <P>
                         <h2>".@$row_cons_guia_consulta['CP_25']."</h2>
                     </div> 
                 </div>
                 <!-- FIM Dados do Atendimento / Procedimento Realizado -->
         </form>
 ";

 //visualiza documentTemplate
echo  json_encode(array($documentTemplate)); 
 //echo $documentTemplate;
?>
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
                    
                        <div class='col-hss-4' style='height: 100px; margin: 1px;'>
                            
                        </div>
                        <div class='col-hss-4' style='height: 100px; margin: 1px;'>
                            <h3><b>GUIA DE CONSULTA</b></h3>
                        </div>
                        <div class='col-hss-4' style='height: 100px; margin: 1px;'>
                            <h4><b>2 - N° no Prestador: ".@$row_cons_guia_consulta['CP_02']."</b></h14>
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
                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                         1 - Registro ANS
                         <h2><B>".@$row_cons_guia_consulta['CP_01']."</B></h2>
                     </div>

                     <div class='col-hss-10' style='height: 30px; margin: 1px;'>
                        3 - Númeo da Guia Atribuído pela Operadora</B>
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
                        <h2><B>".@$row_cons_guia_consulta['CP_04']."</B></h2>
                     </div>

                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        5 - Validade da Carteira
                        <h2><B>".@$row_cons_guia_consulta['CP_05']."</B></h2>
                     </div>

                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        6 - Atendimento a RN (Sim ou Não)
                        <h2><B>".@$row_cons_guia_consulta['CP_06']."</B></h2>
                     </div>
                </div>

                <div class='row'>
                     <div class='col-hss-10' style='height: 30px; margin: 1px;'>
                        7 - Nome
                        <h2><B>".@$row_cons_guia_consulta['CP_07']."</B></h2>
                     </div>

                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        8 - Cartão Nacional de Saúde
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
                        <h2><B>".@$row_cons_guia_consulta['CP_09']."</B></h2>
                     </div>
                     <div class='col-hss-7' style='height: 30px; margin: 1px;'>
                        10 - Nome do Contratado
                        <h2><B>".@$row_cons_guia_consulta['CP_10']."</B></h2>
                     </div>
                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        11 - Código CNES
                        <h2><B>".@$row_cons_guia_consulta['CP_11']."</B></h2>
                     </div>
                 </div>

                 <div class='row'>
                     <div class='col-hss-5' style='height: 30px; margin: 1px;'>
                        12 - Nome do Profissional Executante
                        <h2><B>".@$row_cons_guia_consulta['CP_12']."</B></h2>
                     </div>

                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        13 - Conselho Profissional
                        <h2><B>".@$row_cons_guia_consulta['CP_13']."</B></h2>
                     </div>

                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        14 - Número no Conselho
                        <h2><B>".@$row_cons_guia_consulta['CP_14']."</B></h2>
                     </div>

                     <div class='col-hss-1' style='height: 30px; margin: 1px;'>
                        15 - UF
                        <h2><B>".@$row_cons_guia_consulta['CP_15']."</B></h2>
                     </div>

                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        16 - Código CBO
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
                        <h2><B>".@$row_cons_guia_consulta['CP_18']."</B></h2>
                     </div>
                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        19 - Tipo de Consulta
                         <h2><B>".@$row_cons_guia_consulta['CP_19']."</B></h2>
                     </div>
                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        20 - Tabela
                         <h2><B>".@$row_cons_guia_consulta['CP_20']."</B></h2>
                     </div>
                     <div class='col-hss-3' style='height: 30px; margin: 1px;'>
                        21 - Código Procedimento
                        <h2><B>".@$row_cons_guia_consulta['CP_21']."</B></h2>
                     </div>
                     <div class='col-hss-2' style='height: 30px; margin: 1px;'>
                        22 - Valor do Procedimento  
                        <h2><B>".@$row_cons_guia_consulta['CP_22']."</B></h2>
                     </div>
                 </div>

                 <div class='row'>
                     <div class='col-hss-12' style='height: 75px; margin: 1px;'>
                        23 - Observação
                         <br>
                         <h2><B>".@$row_cons_guia_consulta['CP_23']."</B></h2>
                     </div>    
                 </div>

                 <div class='row'>
                     <div class='col-hss-6' style='height: 45px; margin: 1px;'>
                        24 - Assinatura do Profissional Executante
                        
                         <h2><B>".@$row_cons_guia_consulta['CP_24']."</B></h2>
                     </div>
                     
                     <div class='col-hss-6' style='height: 45px; margin: 1px;'>
                        25 - Assinatura do Beneficiário ou Responsável
                         
                         <h2><B>".@$row_cons_guia_consulta['CP_25']."</B></h2>
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
                         <h2-footer><B>Conta/Lote: ".$row_cons_guia_consulta['CD_CONTA']."</B></h2-footer>
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

 //visualiza documentTemplate
echo  json_encode(array($documentTemplate)); 
// echo $documentTemplate;
?>

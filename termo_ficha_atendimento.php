<?php
 session_start();	

 @$var_cd_atendimento = $_REQUEST['cd_atendimento'];
 @$var_nm_paciente = $_REQUEST['nm_paciente'];
 @$dt_aten = $_REQUEST['dt_aten'];
 @$nm_conv = $_REQUEST['nm_conv'];
 //$img = $_REQUEST['escondidinho'];
 $tp_doc = 'cont_pa'; 
 $var_user_logado = $_SESSION['usuarioLogin'];

 $nm_documneto = 'pdf_contrato_pa_'.$var_cd_atendimento.'.pdf';

 @$_SESSION['atdconsulta'] = $_REQUEST['cd_atendimento'];

 $var_user_logado = $_SESSION['usuarioLogin'];
 
 $count = 1;
 
 // DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
 date_default_timezone_set('America/Sao_Paulo');
 //Data e hora de agora
 $hora = date("d/m/Y H:i:s"); 
 
 include 'sql_consulta_ficha_atendimento.php';
 
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
     font-size: 7px;
     background-color: #ffffff;
     margin: 1 1 1 1;
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
 
     width: 49.40% !important;
     height: 20px;
     float: left;
 }
 .col-hss-5{
 
     width: 40.66% !important;
     height: 20px;
     float: left;
 }
 .col-hss-4{
 
     width: 32.90% !important;
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
 
     width: 8.25% !important;
     height: 20px;
     float: left;
 }
 
 h2{ 
    font-weight: normal;
     font-size: 1.900em;
 }
 .imagem {
     width: 200px;
     height: 120px;
     object-fit: cover;
 }
 .texto{
    
     font-family: Arial, Helvetica, sans-serif;
 }

 p{
    font-family: Arial, Helvetica, sans-serif;
 }
 
 </style> 
 
         <form style='height: 40px;'>
             <div class='container texto'>
                 <div class='row'>
                    <div style='width: 100%; padding-left: 1.5%; padding-right: 0%;'>
                        <div class='col-hss-12' style='border: none !important; text-align: center;'>
                                <img class='imagem' src='https://i2.wp.com/santacasasaude.com.br/wp-content/uploads/2018/07/Santa-Casa-SJC.gif?fit=730%2C457&ssl=1'>
                        </div>
                    </div>
                 </div>
             </div>
         </form>

         <br>
         <br>
         <br>

         <form>
            <div class='container texto'>
                <div style='width: 99%; height: 80%; padding-left: 0%; padding-right: 0%; padding-top: 2%; border: 1px solid gray; border-radius: 10px;'>
                    <p style='text-align: center; '><b>FICHA DE ATENDIMENTO</b>
                    <p style='text-align: center;'><b>Pronto Atendimento/Ambulatório</b>
                
                    </br>
                 </br>
               
                <form>
                 <div class='container' style='margin-left:25%; margin-right:10%; border: 1px solid gray;' >

                    <div class='row'>
                         <div class='col-hss-4' style='height: 30px;  border: none !important;  '>
                             <h2><b>ATENDIMENTO:</b>  ".@$dados_pac_resp['ATENDIMENTO']."</h2>
                         </div>
         
                         <div class='col-hss-3' style='height: 30px;  border: none !important;  '>
                             <h2><b>PRONTUÁRIO:</b> ".@$dados_pac_resp['PRONTUARIO']."</h2>
                         </div>
         
                         <div class='col-hss-5' style='height: 30px;  border: none !important;  '>
                             <h2><b>DT.ATEND:</b> ".@date("d/m/Y",strtotime($dados_pac_resp['DATA_ATENDIMENTO']))."    ".@$dados_pac_resp['HORA_ATENDIMENTO']."</h2>
                         </div> 
                    </div>
                    
                    <div class='row'>
                         <div class='col-hss-4' style='height: 30px;  border: none !important; '>
                             <h2><b>ORIGEM:</b> ".@$dados_pac_resp['ORIGEM_ATENDIMENTO']."</h2>
                         </div>
         
                         <div class='col-hss-8' style='height: 30px;  border: none !important;  '>
                             <h2><b>N.CHAMADA:</b> ".@$dados_pac_resp['NUMERO_CHAMADA']."</h2>
                         </div>
                    </div>
         
                    <div class='row'>
                         <div class='col-hss-12' style='height: 30px;  border: none !important;  '>
                             <h2></h2>
                         </div>
                    </div>
         
                    <div class='row'>
                         <div class='col-hss-12' style='height: 30px;  border: none !important;  '>
                             <h2><b>PACIENTE:</b> ".@$dados_pac_resp['PACIENTE']."</h2>
                         </div>
                    </div>
         
                    <div class='row'>
                         <div class='col-hss-7' style='height: 30px;  border: none !important; '>
                             <h2><b>DT.NASC:</b> ".@date("d/m/Y",strtotime($dados_pac_resp['DATA_NASCIMENTO']))."    ".@$dados_pac_resp['IDADE']."</h2>
                         </div>

                         <div class='col-hss-5' style='height: 30px;  border: none !important;  '>
                            <h2><b>SEXO:</b> ".@$dados_pac_resp['SEXO']."</h2>
                        </div>
                    </div>
                    
                    <div class='row'>
                         <div class='col-hss-4' style='height: 30px;  border: none !important; '>
                             <h2><b>RG:</b> ".@$dados_pac_resp['RG']."</h2>
                         </div>
                         <div class='col-hss-3' style='height: 30px;  border: none !important; '>
                            <h2><b>CPF:</b> ".@$dados_pac_resp['CPF']."</h2>
                        </div>

                        <div class='col-hss-5' style='height: 30px;  border: none !important; '>
                            <h2><b>CNS:</b> ".@$dados_pac_resp['CNS']."</h2>
                        </div>
                    </div>

                    <div class='row'>
                         <div class='col-hss-12' style='height: 30px;  border: none !important; '>
                             <h2><b>NOME DA MÃE:</b> ".@$dados_pac_resp['NOME_MAE']."</h2>
                         </div>  
                    </div>

                    <div class='row'>
                         <div class='col-hss-12' style='height: 30px;  border: none !important; '>
                             <h2></h2>
                         </div>
                    </div>

                    <div class='row'>
                        <div class='col-hss-12' style='height: 30px;  border: none !important;  '>
                            <h2><b>CONVÊNIO:</b> ".@$dados_pac_resp['CONVEINO']."</h2>
                        </div>  
                    </div>

                    <div class='row'>
                        <div class='col-hss-12' style='height: 30px;  border: none !important; '>
                            <h2><b>CARTEIRINHA:</b> ".@$dados_pac_resp['NUMERO_CARTEIRINHA']."</h2>
                        </div>
                    </div>

                    <div class='row'>
                         <div class='col-hss-12' style='height: 30px;  border: none !important;  '>
                             <h2></h2>
                         </div>
                    </div>

                    <div class='row'>
                         <div class='col-hss-12' style='height: 30px;  border: none !important;  '>
                             <h2>RESPONSAVEL: <b>" . @$dados_pac_resp['PACIENTE']. "</b> </h2>
                         </div>
         
                         <div class='col-hss-12' style='height: 30px;  border: none !important;  '>
                             <h2>RG: <b>" . @$dados_pac_resp['RG']. "</b></h2>
                         </div>
                         
                         <div class='col-hss-4' style='height: 30px; border: none !important; border-bottom: solid 1px black !important; '>
                            <img src='' width='100%' height='100%'  style:'float: right;'>
                        </div>
                    </div>

                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                 </div>
                 
                </form>
                </div>
            </div>
        </form>
 ";
echo $documentTemplate;

?>
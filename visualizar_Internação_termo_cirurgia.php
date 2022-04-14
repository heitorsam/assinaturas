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
    font-size: 12px;
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

                        <div class='col-hss-12' style='height: 30px; margin: 1px; border-style: none !important;'>
                            <h3><b>TERMO DE RESPONSABILIDADE E CONSENTIMENTO INFORMADO PARA CIRURGIA</b></h3>
                        </div>
                 </div>
             </div>
         </form>
             <div class='container'>
 
                <!--TEXTO-->
                 <div class='row '>
                    <div class='col-hss-1' style='height: 810px; margin: 1px; border-style: none !important;'>
                    </div>

                     <div class='col-hss-10' style='height: 810px; margin: 1px; border-style: none !important;'>
                        
                            <p>Por este termo de consentimento livre e informado,
                            <p><h1>Nome: <b>".@$dados_result_term_cirurgia['PACIENTE']."</b>, Portador (a) da Cédula de Identidade RG nº <b>".@$dados_result_term_cirurgia['RG']."</b>, Inscrito (a) no CPF/MF sob nº <b>".@$dados_result_term_cirurgia['CPF']."</b>, residente na <b>".@$dados_result_term_cirurgia['ENDERECO']."</b>, Cidade <b>".@$dados_result_term_cirurgia['CIDADE'].",</b> Estado <b>".@$dados_result_term_cirurgia['ESTADO']."</b>, CEP: <b>".@$dados_result_term_cirurgia['CEP']."</b>.



                            <br><br><br>

                            <p><b>1.)	DA CONDUTA DO PACIENTE: </b>
                            <p><h1>Declaro ter sido informado(a) que em todo procedimento médico não há garantia de resultado e que o sucesso dos objetivos cirúrgicos dependem de minhas reações orgânicas, características anatômicas e de <b>minha conduta em seguir de forma disciplinada as prescrições e orientações que me foram repassadas pelo médico, antes, durante e após a realização da intervenção cirúrgica,</b> e fico desde já ciente de poderão ocorrer infecções no pós-operatório por várias causas, e ainda, inchaços, edemas, alergias que podem ou não ser decorrentes da intervenção cirúrgica, mas sem qualquer ligação com a conduta médica.</h1>
                            
                            <br>

                            <p><b>2.) DAS INTERCORRÊNCIAS: </b>
                            <p><h1>Declaro que fui informado(a) por meu médico que embora sejam utilizados todos os cuidados e técnicas previstas cientificamente, a realização correta e eficaz da intervenção cirúrgica indicada não está isenta de riscos, podendo ocorrer alguma intercorrência que obrigue o médico a realizar outro procedimento anteriormente não previsto ou alterar a técnica original, caso em que fica o mesmo autorizado a utilizar desde já, todos os meios disponíveis e ao alcance em meu favor, segundo o seu julgamento.</h1> 
                            <p><h1>Declaro ainda que fui informado (a) por meu médico, que tais intercorrências (fatos adversos) poderão ocorrer, e portanto, não existe obrigação e garantia de resultado pelo médico e muito menos pelo hospital no qual o procedimento será realizado.</h1> 
                        
                            <br>

                            <p><b>3.) DOS RISCOS DA ANESTESIA: </b>
                            <p><h1>Declaro ter sido ainda informado (a) e estar plenamente ciente que para realizar uma intervenção cirúrgica é necessário a aplicação de anestésico, cujos métodos, preparo (minha avaliação), as técnicas e os fármacos serão de indicação e responsabilidade exclusiva do Médico Anestesista, porém, concordo e autorizo meu médico a suspender minha operação em caso de intercorrência (fato adverso) por ocasião da aplicação do anestésico, que implique em aumento do risco cirúrgico.</h1> 

                            <br>

                            <p><b>4.) DO PROCEDIMENTO CIRÚRGICO: </b>
                       
                            <p><h1>Declaro ter sido informado (a) e devidamente esclarecido (a) sobre as contra-indicações, riscos, gravames e possíveis complicações, bem como da via de acesso da intervenção cirúrgica indicada de acordo com meu quadro clínico e da possibilidade de re-operação, permanência no hospital superior ao previsto, e no caso de hemorragia, <b>desde já autorizo por este termo de consentimento, a realização de transfusão de sangue.</b></h1> 
                            <p><h1>Declaro que fui informado (a) pelo médico da possibilidade da ocorrência de cicatriz, inerente a toda intervenção cirúrgica, podendo ocorrer a formação de quelóide (cicatriz alta com forma de cordão, podendo gerar irritação local) ou ainda cicatrização hipertrófica, que independem da habilidade do meu médico, visto que dependem de minhas características pessoais.</h1> 
                            <p><h1>Declaro por fim que, após atenta leitura de todas as informações contidos no presente <b>TERMO DE CONSENTIMENTO INFORMADO,</b> ciente e esclarecido, afirmo ser de minha vontade autorizar a realização da intervenção cirúrgica, estando plenamente esclarecido (a) dos benefícios e dos riscos da operação indicada, nada mais havendo que reivindicar.</h1> 

                         
                     </div>

                    <div class='col-hss-1' style='height: 810px; margin: 1px; border-style: none !important;'>
                    </div>   
                 </div>
                    <div class='row'>

                        <div class='col-hss-1' style='height: 40px; margin: 1px; border-style: none !important;'>
                        </div>

                        <div class='col-hss-10' style='height: 40px; margin: 1px; border-style: none !important;'>
                            <h1><p>São José dos Campos,<b> ".@$dados_result_term_cirurgia['DIA_ATD']." </b>de<b> ".@$dados_result_term_cirurgia['MES_EXTENSO']." </b>de<b> ".@$dados_result_term_cirurgia['ANO_ATD']." </b></h1>
                        </div>

                        <div class='col-hss-1' style='height: 40px; margin: 1px; border-style: none !important;'>
                        </div>
                    </div> 

                    
                    <div class='row'>
                        <div class='col-hss-1' style='height: 40px; margin: 1px; border-style: none !important;'>
                        </div>

                        <div class='col-hss-4' style='height: 60px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
                            <h1><p>Assinatura do (a) Paciente: </h1>
                        </div>

                        <div class='col-hss-1' style='height: 40px; margin: 1px; border-style: none !important;'>
                        </div>
                        
                        <div class='col-hss-4' style='height: 60px; margin: 5px; border-style: none !important; border-bottom: 1px solid black !important;'>
                            <h1><p>Assinatura do Familiar e/ou Responsável:</h1>
                        </div>

                        <div class='col-hss-1' style='height: 40px; margin: 1px; border-style: none !important;'>
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

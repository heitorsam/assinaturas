<?php
 session_start();

$document_template="<!doctype html> 
<html lang='pt-br'> 
    <head> 
        <!-- Required meta tags --> 
        <meta charset='utf-8'> 
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'> 
    </head>

    <style>

            .col-hss-1,.col-hss-2,.col-hss-3,.col-hss-4, .col-hss-5, .col-hss-6, 
            .col-hss-7, .col-hss-8, .col-hss-9, .col-hss-10, .col-hss-11, .col-hss-12 {
                height: 25px;
                font-size: 7px;
                background-color: #ffffff;
                margin: 1 1 1 1 ;
                
                
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

            width: 100% !important;
            height: 21px;
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

            width: 49% !important;
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

            width: 22% !important;
            height: 20px;
            float: left;
        }

        .col-hss-2{

            width: 15.66% !important;
            height: 20px;
            float: left;
            
        }

        .col-hss-1{

            width: 4.33% !important;
            height: 20px;
            float: left;
        }

        h2{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9px;
            line-height: 15px;
            margin-top: 1px;
        }

        h99{
            font-family: Andale Mono, monospace;
            display: inline-block;
            color: black;
            font-size: 12px;
            line-height: 10px;
            text-transform: uppercase;
            text-align: center;
            transform: rotate(-5deg);
            letter-spacing: -1px;
            font-weight: bold;
        }

        img.center {
            display: block;
            margin: 0 auto;
        }

        .container{
            font-family: Arial, Helvetica, sans-serif;
        }

        
        p{
            font-size: 13px;
        }

    </style> 
    <body>
        <form style='height: 40px;'>
            <div class='container'>
                <div class='row'>
                    <div class='col-hss-'12'>
                        <img class='center' src='https://seeklogo.com/images/B/brasao-da-republica-do-brasil-logo-F668D19105-seeklogo.com.png' width='100' height='100' >
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-12' style='border: none !important; text-align: center;'>
                        <h1>Exército Brasileiro</h1><br>
                        <h2>Comando Militar do Sudeste<br>12° Bda inf L (Amv)<br>Base Administrativa da Guarnição de Caçapava</h2>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <br> 
        <br>
        <br>
        <br>
        <br> 
        <br>
        <br>
        <br>
        <br>
        <form style='height: 20px;' >
        <div class='container'>
            <div class='row'>
                <div class='col-hss-12' style='text-align: center;'>
                <h2 Style='font-size: 15px !important;  line-height: 20px !important;'>ATENDIMENTO FUSEX</h2>
                </div>
            </div>
        </div>
    </form>
    <br>
    <br>
 
    <form>
        <div class='container' style='margin-left:50%;' >
            <div class='col-hss-12' style='height: 10px;  border: none !important;'>
                <h2>Atendimento de Urgência/Emergência em:______".@$row_dados_pac['DATA']." as ______".@$row_dados_pac['HORARIO']." Horas</h2>
            </div> 
        </div>
    </form><br>

    <form>
        <div class='container' style='margin-left:30%;' >
            <div class='row'>
                <div class='col-hss-4' style='height: 10px;  border: none !important; '>
                    <h1>DADOS DO PACIENTE:</h1>
                </div> 
            </div><br><br>

            <div class='row'>
                <div class='col-hss-4' style='height: 10px;  border: none !important;'>
                    <h2>Nome do Paciente: ".@$row_dados_pac['NM_PACIENTE']."</h2>
                </div> 
            </div><br>

            <div class='row'>
                <div class='col-hss-4' style='height: 10px;  border: none !important;'>
                    <h2 >Data de Nascimento: ".@$row_dados_pac['DT_NASCIMENTO']."</h2>
                </div>

                <div class='col-hss-2' style='height: 10px;  border: none !important;'>
                    <h2>Idade: ".@$row_dados_pac['IDADE']."</h2>
                </div>

                <div class='col-hss-2' style='height: 10px;  border: none !important;'>
                    <h2>Sexo: ".@$row_dados_pac['TP_SEXO']."</h2>
                </div> 
            </div><br>

            <div class='row'>
                <div class='col-hss-4' style='height: 10px;  border: none !important;'>
                    <h2>Endereço: ".@$row_dados_pac['DS_ENDERECO']."</h2>
                </div>

                <div class='col-hss-4' style='height: 10px;  border: none !important;'>
                    <h2>N°: ".@$row_dados_pac['NR_ENDERECO']."</h2>
                </div>
            </div><br>

            <div class='row'>
                <div class='col-hss-4' style='height: 10px;  border: none !important;'>
                    <h2>Cidade: ".@$row_dados_pac['CIDADE']."</h2>
                </div>
                
                <div class='col-hss-4' style='height: 10px;  border: none !important;'>
                    <h2>Tel: ".@$row_dados_pac['NR_FONE']."</h2>
                </div>
            </div><br>

            <div class='row'>
                <div class='col-hss-4' style='height: 10px;  border: none !important;'>
                    <h2>Nome do Titular: ".@$row_dados_pac['NOME_TITULAR']."</h2>
                </div>
            </div><br>

            <div class='row'>
                <div class='col-hss-4' style='height: 10px;  border: none !important;'>
                    <h2>Cartão Fusex n°: ".@$row_dados_pac['CARTAO_FUSEX']."</h2>
                </div>
            </div>
        </div>
    </form>

    <br>
    <br>
  
    <form style='height: 55px; border: solid 1px black !important; margin-left:35%; margin-right:35%;'>
        <div class='container' style='margin-left:3%;'>

            <div class='row'>
                <div class='col-hss-5' style='height: 10px;  border: none !important;'>
                <h2>ASSINALAR</h2>
                </div>

                <div class='col-hss-6' style='height: 10px;  border: none !important;'>
                <h2>DESCRIÇÃO</h2>
                </div>
            </div><br>

            <div class='row'>
                <div class='col-hss-5' style='height: 10px;  border: none !important;'>
                <h2>( )</h2>
                </div>

                <div class='col-hss-6' style='height: 10px;  border: none !important;'>
                <h2>Consulta em Pronto Socorro</h2>
                </div>
            </div><br>

            <div class='row'>
                <div class='col-hss-5' style='height: 10px;  border: none !important;'>
                <h2>( )</h2>
                </div>

                <div class='col-hss-6' style='height: 10px;  border: none !important;'>
                <h2>Internação</h2>
                </div>
            </div><br>
        </div>
    </form><br>


    <form >
        <div class='container' style='margin-left:30%; margin-right:10%;'>
            <div class='row'>
                <div class='col-hss-12' style='height: 10px;  border: none !important;'>
                    <h2>NOME DO MÉDICO: ".@$row_dados_pac['']."</h2>
                </div> 
            </div><br>

            <div class='row'>
                <div class='col-hss-12' style='height: 10px;  border: none !important;'>
                    <h2 >CRM: ".@$row_dados_pac['']."</h2>
                </div>
            </div><br>
        </div>
    </form><br><br>


    <form> 
        <div class='container' style='margin-left:15%; margin-right:15%;'>
            <div class='row'>
                <div class='col-hss-12' style='height: 30px !important;  border: none !important;  text-align: center;'>
                    <h1>OBSERVAÇOES</h1>
                </div> 
            </div><br>

            <div class='row'>
                <div class='col-hss-12' style='height: 30px;  border: none !important;'>
                    <p>Serão cobrados na mesma GUIA DE ENCAMINHAMENTO do procedimento citado acima, 
                    os gastos como medicação, materiais, procedimentos, 
                    exames e adicionais em geral que foram utilizados/realizados no atendimento</p>
                </div>
            </div><br><br><br><br>

            <div class='row'>
                <div class='col-hss-12' style='height: 30px !important;  border: none !important;  text-align: center;'>
                    <h1>TERMO DE RESPONSABILIDADE</h1>
                </div> 
            </div>

            <div class='row'>
                <div class='col-hss-12' style='height: 10px;  border: none !important; '>
                    <p>Declaro que o atendimento acima foi realizado, e estou ciente que devo solicitar a GUIA DE ENCAMINHAMENTO (autorização) dentro de 72 horas a Fusex, sob pena de pagar ou ser descontado 100% dos valores dos procedimentos acima realizados pela Fusex, conforme IR 30-32</p>
                </div>
            </div><br>  <br><br><br><br> 
        </div>

        <br><br><br><br><br><br>
    </form>

    





    





";


echo $document_template;

?>
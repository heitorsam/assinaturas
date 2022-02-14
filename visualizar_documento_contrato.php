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

include 'sql_consulta_contrato.php';

//echo $html;



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

    width: 7.33% !important;
    height: 20px;
    float: left;
}

h2{
    font-size: 10px;
    line-height: 4px;
    float: center;
    margin-top: 0px;

    
}
.imagem {
    width: 200px;
    height: 120px;
    object-fit: cover;
}

</style> 

        <form style='height: 40px;'>
            <div class='container'>
                <div class='row'>
                    <div class='col-hss-12' style='border: none !important; text-align: center;'>
                        <img class='imagem' src='https://i2.wp.com/santacasasaude.com.br/wp-content/uploads/2018/07/Santa-Casa-SJC.gif?fit=730%2C457&ssl=1'>
                        <p>CONTRATO DE PRESTAÇÃO DE SERVIÇOS<p>PRONTO ATENDIMENTO
                    </div>
                </div>
            </div>
        </form>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        </br>
        <form>
            <div class='container'>
                <div style='width: 100%; font-size: 12px; padding-left: 7%; padding-right: 7%;'>
                    <p>Paciente:___________ Prontuário:__________
                    <p> Data do Atendimento:__/__/___ Hora:___
                    <p>Pelo presente instrumento e na melhor forma de direito, eu Identidade R. G. ne portador (a) da Cédula de telefone devidamente inscrito (a) no CPF/MF sob o ne residente (e) ownsse PU total domiciliado responsabilidade, na qualidade de devedor solidário e/ou principal pelas despesas de serviços, médicos e nospitaloe medicamentos, materiais e exames laboratoriais ou imagens, inclusive pelos serviços, materiais e medicamentos fornecidos terceiros (e) paciente devidamente inscrito no CPF/MF sob o ne Identidade RG no residente e domiciliado portador (a) da Cédula de o eved telefone eu (e) 
                    <p>OBJETO: A prestação de serviços médicos/hospitalares ao paciente retro qualificado, em atendimento nas dependéncias da CONTRATADA, por determinação do Mėdico Responsável pelo atendimento, ficando a CONTRATADA expressamente autorizada a executar todoS os atendimentos que façam necessários e indispensáveis a salvaguarda da vida do paciente. 
                    <p>CONTRATANTE: No caso de cobertura por CONVENIO MÉDICO, fica concedida ao paciente a utilização do PLANO DE ASSISTENCIA MEDICA com qual a CONTRATADA mantém convênio, ficando observado que as despesas NÃO cobertas por este PLANO DE SAUDE serão de responsabilidade do CONTRATANTE 
                    <p>DIREITOS/CARENCIAS/EXCLUSÕES: O CONTRATANTE e o paciente têm pieno conhecimento dos DIREITOS, CARENCIAS E EXCLUSOES, contratualmente estabelecidas no PLANO DE SAÚDE, com o qual o paciente mantém contrato 
                    <p>HIPOTESE DE INADIMPLENCIA: Na hipótese de não cumprimento espontăneo das obrigações assumidas, acarretando via de consequencia, cobrança judicial dos titulos sacados, assume, também, a responsabilidade pelo pagamento das custas e despesas processuais/extrajudiciais, dos juros legais, da correção monetária, calculada PRO-RATA TEMPORE, e incidente sobre o valor total do débito e dos honorários advocaticios devidos também no caso de cobrança amigável. 
                    <p>TRANSFERÊNCIA: O CONTRATANTE autoriza, desde já, a CONTRATADA a efetivar a transferência do paciente para outro hospital, descumprir.com as obrigações assumidas neste instrumento, desde que o quadro clinico do internado assim o permita, caso venha e sem restrição mėdica. 
                    <p>FORO DE ELEIÇÃO: Fica eleito o Foro da comarca de São José dos Campos, como competente para dirimir todas as dúvidas que por ventura venham a ser suscitada com relação aos serviços prestados no esteio do presente instrumento, ressalvada a hipótese do artigo 51, parágrafo primeiro, II da Lei nº 8.078 de 11 de setembro de 1990 (Código de Defesa do Consumidor). 
                    <p>E, por estarem assim justos e contratados, assinam o presente instrumento Particular de Contrato de Assistência Médica Hospitalar, em duas vias de igual teor e forma, na presença de duas testemunhas, para que produza seus juridicos e legais efeitos. 
                    <p>Paciente:
                    <p>x__________
                    <p>RG: 


                </div>
            </div>
        </form>
";
echo  json_encode(array($documentTemplate)); 
//echo  $documentTemplate; 



?>

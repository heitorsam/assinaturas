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

//echo $dados_pac_resp['PRONTUARIO'];

//echo $pac_resp;

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
   
    line-height: 4px;
    float: center;
    margin-top: 0px;

    
}
.imagem {
    width: 200px;
    height: 120px;
    object-fit: cover;
}
.texto{
    text-align: justify;
    font-size: 1.875em;
}
p{
    font-size: 0.320em;
}

</style> 

        <form style='height: 40px;'>
            <div class='container texto'>
                <div class='row'>
                <div style='width: 100%;'>
                    <div class='col-hss-12' style='border: none !important; text-align: center;'>
                            <img class='imagem' src='https://i2.wp.com/santacasasaude.com.br/wp-content/uploads/2018/07/Santa-Casa-SJC.gif?fit=730%2C457&ssl=1'>
                    </div>
                </div>
                </div>
            </div>
        </form>
        </br>
        </br>
        </br>
        
 
        <form>
            <div class='container texto'>
                <div style='width:85%; margin: 0 auto;'>
                <p style='text-align: center; font-weight: bold;'>CONTRATO DE PRESTAÇÃO DE SERVIÇOS
                
               
                </br>
                    <p>Paciente: <b>" . @$dados_pac_resp['NOME_PACIENTE']. "</b>    Prontuário: <b>" .@$dados_pac_resp['PRONTUARIO'] . "</b>    Data do Atendimento: <b>" . @$dados_pac_resp['DT_ATENDIMENTO']. "</b>

                    <p>Pelo presente instrumento e na melhor forma de direito, eu: <b>" . @$dados_pac_resp['NOME_RESPONSAVEL']. "</b>, portador (a) da Cédula da identidade R.G. n° <b>" . @$dados_pac_resp['RG_RESPONSAVEL']. "</b> devidamente inscrito (a) no CPF/MF sob o n° <b>" . @$dados_pac_resp['CPF_RESPONSAVEL']. "</b>, telefone: <b> " . @$dados_pac_resp['TELEFONE_RESPONSAVEL']. "</b>, residente e domiciliado (a) na <b>" . @$dados_pac_resp['ENDERECO_RESPONSAVEL']. "</b> N°: <b>" . @$dados_pac_resp['NUMERO_ENDERECO_RESPONSAVEL']. "</b> assumo a total responsabilidade, na qualidade de devedor solidário e/ou principal pelas despesas de serviços, médicos e hospitalares, medicamentos, materiais e exames laboratoriais ou imagens, inclusive pelos serviços, materiais e medicamentos fornecidos por terceiros para o (e) paciente <b>" . @$dados_pac_resp['NOME_PACIENTE']. "</b>, portador (a) da Cédula de identidade RG N° <b>" . @$dados_pac_resp['CPF_PACIENTE']. "</b> devidamente inscrito no CPF/MF sob o N° <b>" . @$dados_pac_resp['RG_PACIENTE']. "</b> residente e domiciliado (a) na <b>" . @$dados_pac_resp['ENDERECO_PACIENTE']. "</b> N°: <b>" . @$dados_pac_resp['NUMERO_ENDERECO_PACIENTE']. "</b>, telefone: <b>" . @$dados_pac_resp['TELEFONE_PACIENTE']. "</b>.  
                    
                    <p><b>OBJETO:</b> A prestação de serviços médicos/hospitalares ao paciente retro qualificado, em atendimento nas dependências da CONTRATADA, por determinação do Médico Responsável pelo atendimento, ficando a CONTRATADA expressamente autorizada a executar todos os atendimentos que façam necessários e indispensáveis a salvaguarda da vida do paciente. 
                    
                    <p><b>CONTRATANTE:</b> No caso de cobertura por CONVENIO MÉDICO, fica concedida ao paciente a utilização do PLANO DE ASSISTENCIA MEDICA com qual a CONTRATADA mantém convênio, ficando observado que as despesas NÃO cobertas por este PLANO DE SAUDE serão de responsabilidade do CONTRATANTE. 
                    
                    <p><b>DIREITOS/CARÊNCIAS/EXCLUSÕES:</b> O CONTRATANTE e o paciente têm pleno conhecimento dos DIREITOS, CARÊNCIAS E EXCLUSOES, contratualmente estabelecidas no PLANO DE SAÚDE, com o qual o paciente mantém contrato.
                    
                    <p><b>HIPOTESE DE INADIMPLENCIA:</b> Na hipótese de não cumprimento espontâneo das obrigações assumidas, acarretando via de consequência, cobrança judicial dos títulos sacados, assume, também, a responsabilidade pelo pagamento das custas e despesas processuais/extrajudiciais, dos juros legais, da correção monetária, calculada “PRÓ-RATA TEMPORE”, e incidente sobre o valor total do débito e dos honorários advocatícios devidos também no caso de cobrança amigável.
                    
                    <p><b>TRANSFERÊNCIA:</b> O CONTRATANTE autoriza, desde já, a CONTRATADA a efetivar a transferência do paciente para outro hospital, caso venha a descumprir com as obrigações assumidas neste instrumento, desde que o quadro clinico do internado assim o permita, e sem restrição médica. 
                    
                    <p><b>FORO DE ELEIÇÃO:</b> Fica eleito o Foro da comarca de São José dos Campos, como competente para dirimir todas as dúvidas que por ventura venham a ser suscitada com relação aos serviços prestados no esteio do presente instrumento, ressalvada a hipótese do artigo 51, parágrafo primeiro, III da Lei nº 8.078 de 11 de setembro de 1990 (Código de Defesa do Consumidor). 
                    
                    
                    <p>E, por estarem assim justos e contratados, assinam o presente instrumento Particular de Contrato de Assistência Médica Hospitalar, em duas vias de igual teor e forma, na presença de duas testemunhas, para que produza seus jurídicos e legais efeitos. 
                    
                    <p>RESPONSAVEL: <b>" . @$dados_pac_resp['NOME_RESPONSAVEL']. "</b>        RG: <b>" . @$dados_pac_resp['RG_RESPONSAVEL']. "</b>

                </div>
            </div>
        </form>
";
echo  json_encode(array($documentTemplate)); 
//echo  $documentTemplate; 



?>

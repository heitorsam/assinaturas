<?php

session_start();

$count = 1;

@$var_cd_atendimento = $_POST['cd_atendimento'];
@$var_nm_paciente = $_POST['nm_paciente'];
@$dt_aten = $_POST['dt_aten'];
@$nm_conv = $_POST['nm_conv'];
$img = $_REQUEST['escondidinho'];

$nm_documneto = 'pdf_assinatura_'.$var_cd_atendimento.'.pdf';

@$_SESSION['atdconsulta'] = $_POST['cd_atendimento'];

$var_user_logado = $_SESSION['usuarioNome'];

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
date_default_timezone_set('America/Sao_Paulo');
//Data e hora de agora
$hora = date("d/m/Y H:i:s"); 

include 'sql_consulta_guia_tiss.php';

//echo $html;

/* Preparação do documento final
 */
$documentTemplate = "<!doctype html> 
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
    line-height: 12px;
    float: center;
    margin-top: 0px;

    
}



</style> 
    <body>
        <form style='height: 40px;'>
            <div class='container'>
                <div class='row'>
                    <div class='col-hss-4' style='border: none !important;'>
                        <img src='data:application/pdf;base64, ".base64_encode(@$image)." type='application/pdf' style='width: 150; height: 30;'>
                    </div>
                    <div class='col-hss-4' style='border: none !important; text-align: center;'>
                        <h2>GUIA DE SERVIÇO PROFISSIONAL / SERVIÇO AUXILIAR DE <BR> DIAGNÓSTICO E TERAPIA - SP/SADT</h2>
                    </div>
                    <div class='col-hss-4' style='border: none !important; padding-left: 50px;'>
                        <h2>2- N° Guia no Prestador: ".@$row_cons_guia_tiss['CP_02']."</h2>
                    </div>
                </div>
            </div>
        </form>
        </br>
        </br>
        </br>
        <form style=' border: solid 1px black; height: 650px;'>
            <!--Primeiras infos -->
            <div class='container'>
                <div class='row'>
                    <div class='col-hss-3'>
                        1-Registro ANS
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_01']."</h2>
                    </div>
                    <div class='col-hss-1'>
                        3-Número guia Principal
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_03']."</h2>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-2'>
                        4-Data autorização
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_04']."</h2>
                    </div>
                    <div class='col-hss-3'>
                        5-Senha
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_05']."</h2>
                    </div>
                    <div class='col-hss-2'>
                        6-Data Validade Senha
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_06']."</h2>
                    </div>
                    <div class='col-hss-2'>
                        7-Numero da Guia Atribuido pela operadora
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_07']."</h2>
                    </div>
                </div>
                <!-- FIM Primeiras infos -->
            
                <!-- Dados beneficiário -->
                <div class='row'>
                    <div class='col-hss-12 faixa-cinza'>
                        Dados Beneficiario
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-2'>
                        8-Numero Carteira
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_08']."</h2>
                    </div>
                    <div class='col-hss-1'>
                        9-validade da carteira
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_09']."</h2>
                    </div>
                    <div class='col-hss-4'>
                        10-Nome
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_10']."</h2>
                    </div>
                    <div class='col-hss-2'>
                        11-Cartao Nascional de Saude
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_11']."</h2>
                    </div>
                    <div class='col-hss-1'>
                        12-Atendimento a RN
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_12']."</h2>
                    </div>
                    
                </div>
                <!-- FIM Dados beneficiário -->
            
                <!-- Dados Solicitante -->
                <div class='row'>
                    <div class='col-hss-12 faixa-cinza'>
                        Dados Solicitante
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-3'>
                        13-Código Operadora
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_13']."</h2>
                    </div>
                    <div class='col-hss-8'>
                        14-Nome do Contratado
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_14']."</h2>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-3'>
                        15-Nome do Profissionl Solicitante
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_15']."</h2>
                    </div>
                    <div class='col-hss-2'>
                        16-Conselho Profissional
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_16']."</h2>
                    </div>
                    <div class='col-hss-2'>
                        17-Número no Conselho
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_17']."</h2>
                    </div>
                    <div class='col-hss-1'>
                        18-UF
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_18']."</h2>
                    </div>
                    <div class='col-hss-2'>
                        19-Código CBO
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_19']."</h2>
                    </div>
                    <div class='col-hss-2'>
                        20-Assinatura do Profissional Solic
                    </div>
                </div>
                <!-- FIM Dados Solicitante -->
            
                <!-- Dados da Solicitação/ Procedimento e Exames Solicitados -->
                <div class='row'>
                    <div class='col-hss-12 faixa-cinza' >
                        Dados da Solicitação/ Procedimento e Exames Solicitados
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-3' style='height: 35px;'>
                        21-CaráterAtendim
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_21']."</h2>
                    </div>
                    <div class='col-hss-3' style='height: 35px;'>
                        22-Data da Solicitação
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_22']."</h2>
                    </div>
                    <div class='col-hss-6' style='height: 35px;'>
                        23-Indicação Clinica
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_23']."</h2>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-12' >
                        24-Tabela
                    </div>
                </div>
                <!-- FIM Dados da Solicitação/ Procedimento e Exames Solicitados -->
            
                <!-- Dados do Contratado Executante -->
                <div class='row'>
                    <div class='col-hss-12 faixa-cinza' >
                        Dados do Contratado Executante
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-3'>
                        29-Código Operadora
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_29']."</h2>
                    </div>
                    <div class='col-hss-6'>
                        30-Nome do Contratado
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_30']."</h2>
                    </div>
                    <div class='col-hss-2'>
                        31-Código CNES
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_31']."</h2>
                    </div>
                </div>
                <!-- FIM Dados da Solicitação/ Procedimento e Exames Solicitados -->
            
                <!-- Dados do Atendimento -->
                <div class='row'>
                    <div class='col-hss-12 faixa-cinza'>
                        Dados do Atendimento
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-2'>
                        32-Tipo Atendimento
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_32']."</h2>
                    </div>
                    <div class='col-hss-3'>
                        33-Indicação de Acidente (Acidente ou Doença Relacionada)
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_33']."</h2>
                    </div>
                    <div class='col-hss-2'>
                        34-Tipo de Consulta
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_34']."</h2>
                    </div>
                    <div class='col-hss-3'>
                        35-Motivo de Encerramento do Atendimento
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_35']."</h2>
                    </div>
                </div>
                <!-- FIM  Dados do Atendimento -->
            
                <!-- Dados da Execução / Procedimento e Exames Realizados -->
                <div class='row'>
                    <div class='col-hss-12 faixa-cinza'>
                        Dados da Execução / Procedimento e Exames Realizados
                    </div>
                </div>
                <div class='row' style='padding-left: 05px;'>
                    <div class='col-hss-1' style='height: 35px; border: none !important; margin: 0px !important;''>
                        36- Data
                        <br>
                        <h2>".@$row_cons_guia_tiss_34_45['CP_34']."</h2>
                    </div>
                    <div class='col-hss-1' style='height: 35px; border: none !important; margin: 0px !important;''>
                        37- Hora Inicial
                        <br>
                        <h2>".@$row_cons_guia_tiss_34_45['CP_35']."</h2>
                    </div>
                    <div class='col-hss-1' style='height: 35px; border: none !important; margin: 0px !important;''>
                        38- Hora Final
                        <br>
                        <h2>".@$row_cons_guia_tiss_34_45['CP_36']."</h2>
                    </div>
                    <div class='col-hss-1' style='height: 35px; border: none !important; margin: 0px !important;''>
                        39-Tabela
                        <br>
                        <h2>".@$row_cons_guia_tiss_34_45['CP_37']."</h2>
                    </div>
                    <div class='col-hss-1' style='height: 35px; border: none !important; margin: 0px !important;''>
                        35-Procedimento
                        <br>
                        <h2>".@$row_cons_guia_tiss_34_45['CP_38']."</h2>
                    </div>
                    <div class='col-hss-2' style='height: 35px; border: none !important; margin: 0px !important;''>
                        41-Descrição
                        <br>
                        <h2>".@$row_cons_guia_tiss_34_45['CP_39']."</h2>
                    </div>
                    <div class='col-hss-1' style='height: 35px; border: none !important; margin: 0px !important;''>
                        42-Qtde
                        <br>
                        <h2>".@$row_cons_guia_tiss_34_45['CP_35']."</h2>
                    </div>
                    <div class='col-hss-1' style='height: 35px; border: none !important; margin: 0px !important;''>
                        43-Via
                        <br>
                        <h2>".@$row_cons_guia_tiss_34_45['CP_41']."</h2>
                    </div>
                    <div class='col-hss-1' style='height: 35px; border: none !important; margin: 0px !important;''>
                        44-Tec
                        <br>
                        <h2>".@$row_cons_guia_tiss_34_45['CP_42']."</h2>
                    </div>
                    <div class='col-hss-1' style='height: 35px; border: none !important; margin: 0px !important;''>
                        45- Fator Red./Acresc
                        <br>
                        <h2>".@$row_cons_guia_tiss_34_45['CP_43']."</h2>
                    </div>
                    <div class='col-hss-1' style='height: 35px; border: none !important; margin: 0px !important;'>
                        46- Valor Unit.(R$)
                        <br>
                        <h2>".@$row_cons_guia_tiss_34_45['CP_44']."</h2>
                    </div>
                    <div class='col-hss-1' style='height: 35px; border: none !important;margin: 0px !important;''>
                        47- Valor Total(R$)
                        <br>
                        <h2>".@$row_cons_guia_tiss_34_45['CP_45']."</h2>
                    </div>
                </div>
                <!-- FIM  Dados da Execução / Procedimento e Exames Realizados -->
            
                <!-- Identificação do(s) Profissional(is) Executante(s) -->
                <div class='row'>
                    <div class='col-hss-12 faixa-cinza'>
                        Identificação do(s) Profissional(is) Executante(s)
                    </div>
                </div>";
                while($row_cons_guia_tiss_47_53 = oci_fetch_array($result_cons_guia_tiss_47_53)){
$documentTemplate .="<div class='row' style='padding-left: 05px;'>
                    <div class='col-hss-1' style='height: 35px; border: none !important; margin: 0px !important;''>";
                    if($count > 1){ 
                        $documentTemplate .=" <h2>".@$row_cons_guia_tiss_47_53['REGISTRO']."</h2>";
                    }
                    else{
                        $documentTemplate .="48-Seq.Ref<br><h2>".@$row_cons_guia_tiss_47_53['REGISTRO']."</h2>";
                    }
$documentTemplate .=" </div>
                    <div class='col-hss-1' style='height: 35px; border: none !important; margin: 0px !important;''>";
                    if($count > 1){
                        $documentTemplate .="  <h2>".@$row_cons_guia_tiss_47_53['CP_47']."</h2>";}
                    else{
                        $documentTemplate .="  49- Grau Part.
                                                <br>
                                                <h2>".@$row_cons_guia_tiss_47_53['CP_47']."</h2>";}
$documentTemplate .=" </div>
                    <div class='col-hss-2' style='height: 35px; border: none !important; margin: 0px !important;''>";
                    if($count > 1){
                        $documentTemplate .="<h2>".@$row_cons_guia_tiss_47_53['CP_48']."</h2>";}
                    else{
                        $documentTemplate .="50- Códio na Operadore/CPF
                                            <br>
                                            <h2>".@$row_cons_guia_tiss_47_53['CP_48']."</h2>";}
$documentTemplate .="</div>
                    <div class='col-hss-3' style='height: 35px; border: none !important; margin: 0px !important;''>";
                    if($count > 1){
                        $documentTemplate .="<h2>".@$row_cons_guia_tiss_47_53['CP_49']."</h2>";}
                        else{
                            $documentTemplate .="51-Nome do Profissional
                                                <br>
                                                <h2>".@$row_cons_guia_tiss_47_53['CP_49']."</h2>";}
$documentTemplate .=" </div>
                    <div class='col-hss-1' style='height: 35px; border: none !important; margin: 0px !important;''>";
                    if($count > 1){
                        $documentTemplate .="<h2>".@$row_cons_guia_tiss_47_53['CP_50']."</h2>";}
                    else{
                            $documentTemplate .="52- Conselho Profissional
                                                <br>
                                                <h2>".@$row_cons_guia_tiss_47_53['CP_50']."</h2>";}
$documentTemplate .="</div>
                    <div class='col-hss-2' style='height: 35px; border: none !important; margin: 0px !important;''>";
                    if($count > 1){
                        $documentTemplate .="<h2>".@$row_cons_guia_tiss_47_53['CP_51']."</h2>";}
                    else{
                        $documentTemplate .="53- Número no Conselho
                        <br>
                        <h2>".@$row_cons_guia_tiss_47_53['CP_51']."</h2>";}
$documentTemplate .=" </div>
                    <div class='col-hss-1' style='height: 35px; border: none !important; margin: 0px !important;''>";
                    if($count > 1){
                        $documentTemplate .="<h2>".@$row_cons_guia_tiss_47_53['CP_52']."</h2>";}
                    else{
                            $documentTemplate .="54- UF
                                                <br>
                                                <h2>".@$row_cons_guia_tiss_47_53['CP_52']."</h2>";}
$documentTemplate .="</div>
                    <div class='col-hss-1' style='height: 35px; border: none !important; margin: 0px !important;''>";
                    if($count > 1){
                        $documentTemplate .="<h2>".@$row_cons_guia_tiss_47_53['CP_53']."</h2>";}
                        else{
                            $documentTemplate .="55- Código CBO
                                                <br>
                                                <h2>".@$row_cons_guia_tiss_47_53['CP_53']."</h2>";}
$documentTemplate .="</div>
                </div>";
            $count++;}
$documentTemplate .= "<div class='row'>
                    <div class='col-hss-12' >
                        56-Data de Realização de procedimento em série
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-12' background-color: #cccccc;'>
                        58-Observações / Justificativa
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_58']."</h2>
                    </div>
                </div>
                <!-- Identificação do(s) Profissional(is) Executante(s) -->
            
                <!-- Identificação do(s) Profissional(is) Executante(s) -->
                <div class='row'>
                    <div class='col-hss-1'>
                        59-T. Proc(R$)
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_59']."</h2>
                    </div>
                    <div class='col-hss-2'>
                        60-T.Taxase Aluguéis(R$)
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_60']."</h2>
                    </div>
                    <div class='col-hss-2'>
                        61-T. Materiais(R$)
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_61']."</h2>
                    </div>
                    <div class='col-hss-2'>
                        62-T. de OPME(R$)
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_62']."</h2>
                    </div>
                    <div class='col-hss-1'>
                        63-T. de Med(R$)
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_63']."</h2>
                    </div>
                    <div class='col-hss-2'>
                        64-T. de Gases Med(R$)
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_64']."</h2>
                    </div>
                    <div class='col-hss-1'>
                        65-T. Geral(R$)
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_65']."</h2>
                    </div>
                </div>
                <!-- Identificação do(s) Profissional(is) Executante(s) -->
            
                <!-- Identificação do(s) Profissional(is) Executante(s) -->
                <div class='row'>
                    <div class='col-hss-4' style='height: 30px;'>
                        66-Assinatura do Responsável pela Autorização
                        <br>
                        <h2>".@$row_cons_guia_tiss['CP_66']."</h2>
                    </div>
                    <div class='col-hss-4' style='height: 30px;'>
                        67-Assinatura do Beneficiário ou Responsável
                        <img src='$img'
                        width='100%' height='100%'  style:'float: right;'>
                    </div>
                    <div class='col-hss-3' style='height: 30px;'>
                        68-Assinatura do Contratado
                    </div>
                </div>
                <!-- Identificação do(s) Profissional(is) Executante(s) -->
            </div>
            <div class='container'>
                <div class='row' >
                    <div class='col-hss-2' style='border: none !important; padding-left: 35px; padding-top: 5px;'>
                        <h2>".$var_user_logado."</h2>
                    </div>
                    <div class='col-hss-2' style='border: none !important; padding-left: 35px; padding-top: 5px;'>
                        <h2>Data:".$hora."</h2>
                    </div>
                    <div class='col-hss-2' style='border: none !important; padding-left: 35px; padding-top: 5px;'>
                        <h2>Conta/Lote: ".$row_cons_guia_tiss['CD_CONTA']."</h2>
                    </div>
                    <div class='col-hss-2' style='border: none !important; padding-left: 35px; padding-top: 5px;'>
                        <h2>Atendimento: ".$var_cd_atendimento."</h2>
                    </div>
                    <div class='col-hss-2' style='border: none !important; padding-left: 35px; padding-top: 5px;'>
                        <h2>Atendimento: ".$nm_conv."</h2>
                    </div>
                </div>
            </div>
        </form>
    </body> 
</html>";

echo $documentTemplate;

/*
// inclusão da biblioteca
include 'dompdf/autoload.inc.php';


// alguns ajustes devido a variações de servidor para servidor


use Dompdf\Dompdf;
use Dompdf\Options;

// abertura de novo documento
$dompdf = new DOMPDF();
$dompdf->set_option('isRemoteEnabled', TRUE);

// carregar o HTML
$dompdf->load_html($documentTemplate);

// dados do documento destino
$dompdf->set_paper("A4", "landscape");

// gerar documento destino
$dompdf->render();

$image = $dompdf->output();
?>


<?php
// enviar documento destino para download
//$dompdf->stream("dompdf_out.pdf");


    ///////////////////////
    // Inserindo no banco//
    ///////////////////////

include_once("conexao.php");

//DECLARANDO VARIAVEIS DO ARQUIVO PARA IMPORTACAO PARA O BANCO
//$image = file_get_contents($dompdf);



$consulta_insert = 
"INSERT INTO teste_assinaturas
(CD_ATENDIMENTO, NM_PACIENTE, DT_ATENDIMENTO, NM_CONVENIO, NOME_ANEXO, BLOB_ANEXO)
VALUES 
('$var_cd_atendimento', '$var_nm_paciente', '$dt_aten',
'$nm_conv', '$nm_documneto',
empty_blob()
) RETURNING BLOB_ANEXO INTO :image";

//echo $consulta_insert;

$insere_dados = oci_parse($conn_ora, $consulta_insert);
$blob = oci_new_descriptor($conn_ora, OCI_D_LOB);
oci_bind_by_name($insere_dados, ":image", $blob, -1, OCI_B_BLOB);

oci_execute($insere_dados, OCI_DEFAULT);

$linhas_afetadas = oci_num_rows($insere_dados);
//echo "</br>Linhas Afetadas: " . $linhas_afetadas;


if(!$blob->save($image)) {
    oci_rollback($conn_ora);
}
else {
    oci_commit($conn_ora);
}

oci_free_statement($insere_dados);
$blob->free();



if($insere_dados > 0){
	$_SESSION['msg'] = "Arquivo gerado com sucesso!"; 
    header('Location: gerar_documento.php');
    return 0;

}else{
    $_SESSION['msgerro'] = "Ocorreu um erro ao gerar o arquivo."; 
    header('Location: gerar_documento.php');
    return 0;
}


exit(0);



//DECLARANDO VARIAVEIS DO ARQUIVO PARA IMPORTACAO PARA O BANCO
//$image = file_get_contents($dompdf);

*/
?>

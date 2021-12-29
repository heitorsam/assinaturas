<?php

session_start();	

@$var_cd_atendimento = $_POST['cd_atendimento'];
@$var_nm_paciente = $_POST['nm_paciente'];
@$dt_aten = $_POST['dt_aten'];
@$nm_conv = $_POST['nm_conv'];
$img = $_POST['escondidinho'];

$nm_documneto = 'pdf_assinatura_'.$var_cd_atendimento.'.pdf';

@$_SESSION['atdconsulta'] = $_POST['cd_atendimento'];



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

    height: 10px; 
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
    float: left;
}
.col-hss-11{

    width: 90.66% !important;
    float: left;
}
.col-hss-10{

    width: 82.33% !important;
    float: left;
}
.col-hss-9{

    width: 74% !important;
    float: left;
}
.col-hss-8{

    width: 65.66% !important;
    float: left;
}
.col-hss-7{

    width: 57.33% !important;
    float: left;
}
.col-hss-6{

    width: 49% !important;
    float: left;
}
.col-hss-5{

    width: 40.66% !important;
    float: left;
}
.col-hss-4{

    width: 32.33% !important;
    float: left;
}
.col-hss-3{

    width: 24% !important;
    float: left;
}

.col-hss-2{

    width: 15.66% !important;
    float: left;
}

.col-hss-1{

    width: 7.33% !important;
    float: left;
}



</style> 
    <body>
        <form style='height: 40px;'>
            <div class='container'>
                <div class='row'>
                    <div class='col-hss-4' style='border: none !important;'>
                        <img src='https://www.gndi.com.br/documents/20195/22221/LOGO_NOTREDAME_transparente_alta.png' alt='logo' width='150' height='30'>
                    </div>
                    <div class='col-hss-4' style='border: none !important; text-align: center;'>
                        <h4>GUIA DE SERVIÇO PROFISSIONAL / SERVIÇO AUXILIAR DE <BR> DIAGNÓSTICO E TERAPIA - SP/SADT</h4>
                    </div>
                    <div class='col-hss-4' style='border: none !important;'>
                        <h4>2-N° Guia no Prestador</h4>
                    </div>
                </div>
            </div>
        </form>
        </br>
        </br>
        </br>
        <form style='background-color:#E6E6FA; border: solid 1px black; height: 650px;'>
            <!--Primeiras infos -->
            <div class='container'>
                <div class='row'>
                    <div class='col-hss-3'>
                        1-Registro ANS
            
                    </div>
                    <div class='col-hss-1'>
                        3-Número guia Principal
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-2'>
                        4-Data autorização
                    </div>
                    <div class='col-hss-3'>
                        5-Senha
                    </div>
                    <div class='col-hss-2'>
                        6-Data Validade Senha
                    </div>
                    <div class='col-hss-2'>
                        7-Numero da Guia Atribuido pela operadora
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
                    <div class='col-hss-3'>
                        8-Numero Carteira
                    </div>
                    <div class='col-hss-2'>
                        9-validade da carteira
                    </div>
                    <div class='col-hss-3'>
                        10-Nome
                    </div>
                    <div class='col-hss-2'>
                        11-Cartao Nascional de Saude
                    </div>
                    <div class='col-hss-1'>
                        12-Atend RN
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
                    </div>
                    <div class='col-hss-8'>
                        14-Nome do Contratado
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-3'>
                        15-Nome do Profissionl Solicitante
                    </div>
                    <div class='col-hss-2'>
                        16-Conselho Profissional
                    </div>
                    <div class='col-hss-2'>
                        17-Número no Conselho
                    </div>
                    <div class='col-hss-1'>
                        18-UF
                    </div>
                    <div class='col-hss-2'>
                        19-Código CBO
                    </div>
                    <div class='col-hss-1'>
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
                    <div class='col-hss-3'>
                        21-CaráterAtendim
                    </div>
                    <div class='col-hss-3'>
                        22-Data da Solicitação
                    </div>
                    <div class='col-hss-5'>
                        23-Indicação Clinica
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-12' style='height: 40px;'>
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
                        teste
            
                    </div>
                    <div class='col-hss-6'>
                        30-Nome do Contratado
                    </div>
                    <div class='col-hss-2'>
                        31-Código CNES
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
                    </div>
                    <div class='col-hss-3'>
                        33-Indicação de Acidente (Acidente ou Doença Relacionada)
                    </div>
                    <div class='col-hss-2'>
                        34-Tipo de Consulta
                    </div>
                    <div class='col-hss-3'>
                        34-Motivo de Encerramento do Atendimento
                    </div>
                </div>
                <!-- FIM  Dados do Atendimento -->
            
                <!-- Dados da Execução / Procedimento e Exames Realizados -->
                <div class='row'>
                    <div class='col-hss-12 faixa-cinza'>
                        Dados da Execução / Procedimento e Exames Realizados
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-12' style='height: 40px;'>
                        36-Tipo Atendimento
                    </div>
                </div>
                <!-- FIM  Dados da Execução / Procedimento e Exames Realizados -->
            
                <!-- Identificação do(s) Profissional(is) Executante(s) -->
                <div class='row'>
                    <div class='col-hss-12 faixa-cinza'>
                        Identificação do(s) Profissional(is) Executante(s)
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-12' style='height: 40px;'>
                        48-seq.Ref.
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-12' style='height: 40px;'>
                        56-Data de Realização de procedimento em série
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-12' style='height: 35px; background-color: #cccccc;'>
                        58-Observações / Justificativa
                    </div>
                </div>
                <!-- Identificação do(s) Profissional(is) Executante(s) -->
            
                <!-- Identificação do(s) Profissional(is) Executante(s) -->
                <div class='row'>
                    <div class='col-hss-1'>
                        59-T. Proc(R$)
                    </div>
                    <div class='col-hss-2'>
                        60-T.Taxase Aluguéis(R$)
                    </div>
                    <div class='col-hss-2'>
                        61-T. Materiais(R$)
                    </div>
                    <div class='col-hss-2'>
                        62-T. de OPME(R$)
                    </div>
                    <div class='col-hss-1'>
                        63-T. de Med(R$)
                    </div>
                    <div class='col-hss-2'>
                        64-T. de Gases Med(R$)
                    </div>
                    <div class='col-hss-1'>
                        65-T. Geral(R$)
                    </div>
                </div>
                <!-- Identificação do(s) Profissional(is) Executante(s) -->
            
                <!-- Identificação do(s) Profissional(is) Executante(s) -->
                <div class='row'>
                    <div class='col-hss-4'>
                        66-Assinatura do Responsável pela Autorização
                    </div>
                    <div class='col-hss-4'>
                        67-Assinatura do Beneficiário ou Responsável
                        <img src='$img'
                        width='100%' height='100%'  style:'float: right;'>
                    </div>
                    <div class='col-hss-3'>
                        68-Assinatura do Contratado
                    </div>
                </div>
                <!-- Identificação do(s) Profissional(is) Executante(s) -->
            </div>
        </form>
    </body> 
</html>";

 $documentTemplate;


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
?>


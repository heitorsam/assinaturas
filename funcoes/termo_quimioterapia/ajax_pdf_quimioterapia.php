<?php

include '../../conexao.php';

// Recupere os dados do paciente e do prestador enviados via POST
$var_paciente = $_POST['var_paciente'];
$var_prestador_logado = $_POST['var_prestador_logado'];
$var_assinatura_pac = $_POST['var_assinatura_pac'];
$var_assinatura_med = $_POST['var_assinatura_med'];
$var_medicamento = $_POST['medicamentos'];
$periodo = $_POST['periodo'];
$ciclo = $_POST['ciclos'];

//CONSULTA PARA PEGAR DADOS DO PACIENTE
$consulta = "SELECT pac.NM_PACIENTE,
TO_CHAR(pac.DT_NASCIMENTO,'DD/MM/YYYY') AS DT_NASCIMENTO,
pac.TP_SEXO,
pac.NR_IDENTIDADE,
pac.DS_OM_IDENTIDADE
FROM dbamv.PACIENTE pac 
WHERE pac.CD_PACIENTE = $var_paciente";
$res_consulta = oci_parse($conn_ora, $consulta);
oci_execute($res_consulta);

$row_pac = oci_fetch_array($res_consulta);

//CONSULTA PARA PEGAR DADOS DO PRESTADOR LOGADO 
$prestador = "SELECT prest.NM_PRESTADOR,
                        prest.DS_CODIGO_CONSELHO
                FROM dbasgu.USUARIOS usu
                LEFT JOIN dbamv.PRESTADOR prest
                ON prest.CD_PRESTADOR = usu.CD_PRESTADOR
                WHERE prest.CD_TIP_PRESTA = 8
                AND usu.CD_USUARIO = '$var_prestador_logado'
                AND prest.TP_SITUACAO = 'A'";

$res_prestador = oci_parse($conn_ora, $prestador);
                oci_execute($res_prestador);

$row_prestador = oci_fetch_array($res_prestador);

// Importe a biblioteca Dompdf
require_once '../../dompdf/autoload.inc.php';

use Dompdf\Dompdf;

// Crie uma instância do Dompdf
$dompdf = new Dompdf();
$html = '

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termo Quimioterapia</title>
</head>
<style>

.row {

    width: 100% !important;
    clear: both;

}

.col-hss-4 {

    width: 32.33% !important;
    height: 20px;
    float: left;
}

.col-hss-12{

    width: 100% !important;
    height: 21px;
    float: left;
    
}

</style>';

$html .= '
<body>

<div style="background-color: #f4f4f4; margin-top: 2% !important; width: 100% !important; margin: 0 auto;">

    <div style="width: 90%; margin: 0 auto; padding-top: 5%; padding-bottom: 5%; text-align: center;">

        <div style="text-align: left !important;">

            1. Declaro que fui informado pelo médico Dr(a) <b>' . $row_prestador['NM_PRESTADOR']  . '</b>

        </div>
        <br>

        <div style="text-align: left !important;">

            2. CRM / N° <b>' . $row_prestador['DS_CODIGO_CONSELHO'] . '</b> que as avaliações e os exames realizados revelaram a necessidade de tratamento, 
            que inclui os seguintes medicamentos: ' . $var_medicamento . '.

        </div>
        <br>

        <div style="text-align: left !important;">
            
            3. Estou ciente que a utilização destes medicamentos está proposta, a principio para um período de ' . $periodo . ' meses / semanas / dias, em '
            . $ciclo . ' ciclos de tratamento.


        </div>


    </div>

</div>


</body>
</html>';



// Carregue o HTML no Dompdf
$dompdf->loadHtml($html);

// Renderize o HTML em PDF
$dompdf->render();

// Saída do PDF como uma string
$pdf_content = $dompdf->output();

// Defina o cabeçalho correto para a resposta
header("Content-Type: application/pdf");
header("Content-Length: " . strlen($pdf_content));

// Saída do conteúdo do PDF
echo $pdf_content;

// Finalize o script
exit();
?>

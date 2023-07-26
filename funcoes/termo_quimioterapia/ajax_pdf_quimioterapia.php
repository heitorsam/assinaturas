<?php
// Página "ajax_pdf_quimioterapia.php"

// Importe a biblioteca Dompdf
require_once '../../dompdf/autoload.inc.php';

use Dompdf\Dompdf;

// Recupere os dados do paciente e do prestador enviados via POST
$var_paciente = $_POST['var_paciente'];
$var_prestador_logado = $_POST['var_prestador_logado'];
$var_assinatura_pac = $_POST['var_assinatura_pac'];
$var_assinatura_med = $_POST['var_assinatura_med'];

// Coloque aqui o código para recuperar outros dados específicos necessários para o PDF

// Crie uma instância do Dompdf
$dompdf = new Dompdf();

// HTML que você deseja colocar no PDF (substitua pelo conteúdo real do seu termo)
$html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Termo de Quimioterapia</title>
</head>
<body>
    <h1>Termo de Quimioterapia</h1>
    <!-- Coloque aqui todo o conteúdo do termo que deseja incluir no PDF -->
</body>
</html>
';

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

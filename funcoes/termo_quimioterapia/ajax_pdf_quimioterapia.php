<?php

include '../../conexao.php';

// Recupere os dados do paciente e do prestador enviados via POST
$var_paciente = $_POST['var_paciente'];
$var_prestador_logado = $_POST['var_prestador_logado'];
$var_assinatura_pac = $_POST['var_assinatura_pac'];
$var_assinatura_med = $_POST['var_assinatura_med'];
$var_medicamento = $_POST['medicamentos'];
$logo_santinha = $_POST['var_logo_santa_casa'];
$periodo = $_POST['periodo'];
$ciclo = $_POST['ciclos'];
$dataAtual = date('d/m/Y');

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
    height: 150%;

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

        
        <div class="row" style="background-color? blue;">

            <div class="col-hss-4" style="background-color: green;">
                    
                <img style="max-width: 100%; max-height: 100%;" src=' . $logo_santinha . '>

            </div>

            <div class="col-hss-4" style="background-color: yallow;">
                    
                 <b>TERMO DE CONSENTIMENTO LIVRE E ESCLARECIDO DE QUIMIOTERAPIA</b>

            </div>

            <div class="col-hss-4" style="background-color: orange;">
                        
                <img style="max-width: 100%; max-height: 100%;" src=' . $logo_santinha . '>

            </div>

        </div>


        <br><br>

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
        <br>

        <div style="text-align: left !important;">

            4. Foram claramente explicados pelo médico citado acima os benefícios, as possibilidade alternativas, os 
            riscos, efeitos colaterais e complicações potenciais relacionados ao tratamento, bem como as 
            consequências de sua não realização, diante da patologia diagnosticada;

        </div>
        <br>

        <div style="text-align: left !important;">

            5. Estou ciente de que, durante os exames, procedimentos ou tratamentos citados, para tentar curar ou 
            melhorar a atual condição de saúde, poderão ocorrer outras situações ainda não diagnosticadas ou mesmo 
            intercorrências e outras situações imprevisíveis ou fortuitas, não obstante toda técnica e boa indicação do 
            tratamento ora proposto.

        </div>
        <br>

        <div style="text-align: left !important;">

            6. Tenho ciência de que em procedimentos invasivos (como punção lombar e outros), quando necessários 
            ou na realização de tratamento sistêmico, poderão ocorrer efeitos adversos ou complicações gerais tais 
            como as mais comuns: sangramento, infecção, perda de pelos e cabelos, trombose, alterações na visão ou 
            audição, alterações neuromotoras, náuseas, vômitos, diarreia, constipação, aftas, redução ou perda do 
            apetite, reações alérgicas, tremores e redução das células sanguíneas. 

        </div>
        <br>

        <div style="text-align: left !important;">

            7. Devido à necessidade de adoção de medidas efetivas de contracepção (homens e mulheres),pelo risco 
            de aborto e malformações congênitas, comprometo-me a utilizar um método contraceptivo a fim de evitar 
            gestação, durante toda a duração do tratamento (quimioterapia, hormonioterapia e de anticorpos 
            monoclonais dentre outros) e até o período indicado pelo médico após seu término.
            
        </div>
        <br>

        <div style="text-align: left !important;">

            8. Fui informado sobre o risco de alteração na fertilidade ocasionada pela doença ou tratamento instituído, 
            sobre métodos possíveis para minimizá-lo ou alternativas artificiais para promover uma futura gravidez, 
            sendo definida pela minha livre escolha.

        </div>
        <br>

        <div style="text-align: left !important;">

            9. Estou ciente de que algumas medicações podem ser irritantes para as veias periféricas, ou mesmo 
            causar danos teciduais se extravasarem (saírem das veias), apesar dos cuidados e da experiência dos 
            profissionais envolvidos em sua aplicação, bem como as veias podem ficar frágeis, podendo necessitar da 
            implantação de um cateter para dar continuidade na administração segura das medicações.

        </div>
        <br>

        <div style="text-align: left !important;">

            10. Tive oportunidade de fazer perguntas e obtive respostas adequadas e satisfatórias, sentindo-me 
            plenamente esclarecido e entendendo que não exista garantia absoluta sobre os resultados a serem 
            obtidos

        </div>
        <br>

        <div style="text-align: left !important;">

            11. Por livre iniciativa, AUTORIZO que o(s) tratamento(s) seja(m) realizado(s) conforme exposto no presente 
            termo, inclusive quanto aos procedimentos necessários para tentar solucionar as situações imprevisíveis e 
            emergenciais, as quais serão conduzidas conforme o julgamento técnico do médico acima autorizado e 
            equipe da instituição, para que sejam alcançados os melhores resultados possíveis, utilizando os recursos 
            disponíveis no local onde se realizam os cuidados

        </div>
        <br>

        <div style="text-align: left !important;">

            <b>Certifico que este termo me foi explicado e que o li, ou que foi lido para mim e que entendi o seu 
            conteúdo, Autorizando a realização do tratamento.</b>

        </div>
        <br>
        <div style="text-align: center !important;">

            <b>São José dos Campos, ' . $dataAtual . '.</b>

        </div>
        <br>
        Assinatura Paciente:
        <div style="text-align: center; display: flex; justify-content: center; align-items: center; height: 100px; background-color: #f0f0f0;">

            <img style="max-width: 70%; max-height: 70%;" src=' . $var_assinatura_pac . '>

        </div>
        <br>
        <div style="text-align: left !important;">

            <b>RESPONSÁVEL MÉDICO</b><br>
            Declaro que prestei todas as informações necessárias ao paciente ou responsável/representante legal, 
            conforme mencionado acima, e, de acordo com meu entendimento, o paciente ou responsável legal está em 
            condições de compreender o que lhe foi informado.

        </div>
        <br>
        <div style="text-align: center !important;">

            <b>Data: ' . $dataAtual . '.</b>

        </div>
        <br>
        Assinatura Medico:
        <div style="text-align: center; display: flex; justify-content: center; align-items: center; height: 100px; background-color: #f0f0f0;">

            <img style="max-width: 70%; max-height: 70%;" src=' . $var_assinatura_med . '>

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

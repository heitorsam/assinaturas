<?php

include '../../conexao.php';

// Recupere os dados do paciente e do prestador enviados via POST
$var_paciente = $_POST['var_paciente'];
$var_prestador_logado = $_POST['var_prestador_logado'];
$var_assinatura_pac = $_POST['data_assin_paciente'];
$var_assinatura_med = $_POST['data_assin_medico'];
$logo_santinha = $_POST['var_logo_santa_casa'];
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
                AND prest.CD_PRESTADOR = '$var_prestador_logado'
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
    height: 10%;
    display: flex;
    align-items: center;

}

.col-hss-4 {

    width: 32.33% !important;
    height: 100%;
    float: left;
}

.col-hss-12{

    width: 100% !important;
    height: 21px;
    float: left;
    
}

/* Estilo para centralizar o conteúdo */
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}


</style>';


$html .= '
<body>

<div style="background-color: #f4f4f4; margin-top: 2% !important; width: 100% !important; margin: 0 auto;">

    <div style="width: 90%; margin: 0 auto; padding-top: 5%; padding-bottom: 5%; text-align: center;">

        <!--Inicio do cabecalho-->
        <div class="row" style="background-color: blue; padding: 2.5%; font-size: 13px; text-align: justify;">

            <div class="col-hss-4">
                    
                <img style="max-width: 100%; max-height: 100%;" src=' . $logo_santinha . '>

            </div>

            <div class="col-hss-4" style="text-align: center; padding-right: 2.5%;">
                    
                 <b>TERMO DE RESPONSABILIDADE E
                 CONSENTIMENTO INFORMADO
                 PROCEDIMENTO ANESTÉSICO OU
                 SEDAÇÃO</b>

            </div>

            <div class="col-hss-4">
                        
                <!--IDENTIFICADOR DO DOCUMENTO-->
                <div>
                    FOR.REC.011
                </div>

                <div>
                
                    Data Emissão: 25/06/2018
                    <br>
                    Data Revisão: 26/09/2022
                    <br>
                    Revisão: 003

                </div> 

            </div>

        </div>
        <!--Fim do cabecalho-->

        <p style="font-weight: bold;">MANUAL DE ORIENTAÇÃO DE ANESTESIA</p> 

        <p style="font-weight: bold;">“ANESTESIA E VOCÊ”</p>

        <p style="text-align: justify;">
        <strong>Anestesiologistas</strong> são médicos que cuidam da vida do paciente durante a realização de um procedimento cirúrgico ou de um exame diagnóstico ou terapêutico.
        Como médicos, cursaram seis anos de faculdade de Medicina e como especialistas na área, cumpriram, no mínimo, dois ou três anos de especialização em Anestesiologia. <br>


        O <strong>anestesiologista</strong> domina conhecimentos fundamentais para avaliação do paciente antes da cirurgia e indicação técnica anestésica mais adequada. Ele é responsável pela manutenção do organismo funcionando o mais próximo do normal durante um procedimento cirúrgico, protegendo-o não só da dor, mas também das reações que possam ocorrer.
        E também reúne conhecimentos para controlar a dor pós operatória e a dor crônica. <br>

        <strong>Anestesia</strong> significa “privação de sensação”, portanto, é uma condição de ausência de sensações. Levar o paciente ao estado de anestesia significa priva-lo de todas as sensações, entre elas a dor.
        É uma tarefa complexa e delicada que exige habilidade clínica, conhecimento de técnicas e arte ao executa-las. <br>

        <strong>Anestesia Geral</strong> é obtida pela combinação de quatro elementos: hipnose (perda da consciência), analgesia (ausência da dor), relaxamento muscular e bloqueio das respostas do organismo ao estresse e ao trauma cirúrgico. 
        É realizada através de uma combinação de medicamentos, por via venosa, com gases e vapores inalatórios através do sistema respiratório. <br>

        <strong>Anestesia Regional, Bloqueio ou Anestesia Condutiva:</strong> é o tipo de anestesia em que se bloqueia a condução do estímulo nervoso, especialmente o da sensibilidade, e as vezes dos movimentos. Provoca um estado de insensibilidade temporária, sem alteração do nível de consciência e do controle da respiração. As mais freqüentes são as Raquianestesia e a Anestesia Peridural, também conhecidas como bloqueios espinhais em que, uma parte do corpo fica anestesiada.
        Outros tipos de anestesia regional são: <br> 

        <strong>Anestesia Local:</strong> que é feita numa pequena área do corpo tornando-o insensível temporariamente. <br>

        <strong>Anestesia Troncular ou Plexolares:</strong> onde apenas um nervo de um conjunto deles é bloqueado com anestésico local,
        promovendo anestesia em uma região ou membro inervado por este nervo. <br>

        <strong>Na anestesia local ou regional</strong>, o paciente pode ficar acordado ou não. Em cirurgias rápidas em pacientes calmos, não há necessidade de ficar inconsciente.
        Em cirurgias mais longas ou em pacientes mais nervosos, é comum a utilização da sedação, ou seja, o paciente ficará dormindo durante a cirurgia sem a perda da consciência como na anestesia geral. <br>
        <strong>Observação:</strong> em casos de falha da anestesia regional, ou intercorrências em que a estabilidade do organismo seja alterada, poderá ser necessário mudar a técnica regional para a anestesia geral, para que o anestesiologista possa ter um controle melhor dos sinais vitais do paciente e controlar alterações que possam ocorrer.<br>

        <strong>Avaliação pré-operatória ou Pré-Anestésica:</strong>
        Trata-se de um exame clínico e deve ser feito, preferencialmente com alguns dias de antecedência ao ato cirúrgico.
        O anestesiologista deve conhecer as condições de saúde do paciente com antecedência,para que ele possa desempenhar seu trabalho de maneira mais adequada e dar mais segurança ao paciente. <br>

        A história médica, o exame físico, e possíveis exames de laboratório fornecem informações para que o anestesiologista decida qual a técnica mais indicada. <br>

        Nenhum julgamento sobre a pessoa ou seus atos será realizado e a informação prestada será mantida em sigilo médico, portanto, o paciente deve informar a verdade sobre todas as perguntas realizadas, ainda que algumas possam parecer constrangedoras, nada deve ser omitido.
        O uso de cigarros, bebidas, alcoólicas, medicamentos, drogas de uso lícito ou ilícito deverá ser informado. Informar também sobre a alergia a remédios ou a outros produtos, se já realizou alguma cirurgia, se houve alguma experiência ruim ou reação em si mesmo ou em parente próximo. <br>

        O paciente deverá ficar em jejum antes da cirurgia (não deve ingerir nenhum tipo de alimento nem água), pois o estômago vazio é muito importante para garantir mais segurança ao ato anestésico, e o tempo mínimo de jejum será informado pelo anestesiologista ou pelo cirurgião dependendo da hora da cirurgia. <br>

        <strong>

        É IMPORTANTE DEIXAR O ANESTESISTA BEM INFORMADO A RESPEITO DO SEU ESTADO CLÍNICO, SEGUIR SUAS ORIENTAÇÕES, ESCLARECER SUAS DÚVIDAS E DISCUTIR COM ELE COMO SERÁ O CONTROLE DA DOR NO PÓS-OPERATÓRIO.

        </strong> <br>

        <strong>

        Finalmente, após sentir-se tranqüilo, deve ser dado o consentimento para a técnica de anestesia que está sendo proposta.

        </strong>

    </p>

    Assinatura Paciente:
    <div style="text-align: center; display: flex; justify-content: center; align-items: center; height: 100px; background-color: #f0f0f0;">

        <img style="max-width: 90%; max-height: 90%;" src=' . $var_assinatura_pac . '>

    </div>

    <div style="width: 100%; height: auto; border: solid 1px black; margin: 0px;">
        <p>Expliquei todo o procedimento ao paciente acima identificado e/ou ao responsável, sobre os benefícios, riscos e alternativas, tendo respondido às perguntas formuladas pelos mesmos.
        De acordo com o meu entendimento, o paciente e/ou responsável estão em condições de compreender o que lhes foi informado.</p>
    </div>

    <div style="text-align: center !important; margin: 2.5%;">

        <b>Data: ' . $dataAtual . '.</b>

    </div>

    <div>
    
    Assinatura Medico:
    <div style="text-align: center; display: flex; justify-content: center; align-items: center; height: 100px; background-color: #f0f0f0;">

        <img style="max-width: 90%; max-height: 90%;" src=' . $var_assinatura_med . '>

    </div>

    <div style="text-align: center; display: flex; justify-content: center; align-items: center; height: 100px; background-color: #f0f0f0;">

        <label> CRM: '. $row_prestador['DS_CODIGO_CONSELHO'] .'</label>

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

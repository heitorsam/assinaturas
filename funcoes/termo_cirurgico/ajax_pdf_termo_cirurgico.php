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
                    pac.NR_IDENTIDADE,
                    pac.NR_CPF,
                    pac.DS_OM_IDENTIDADE,
                    (SELECT cidade.NM_CIDADE FROM dbamv.CIDADE cidade WHERE cidade.CD_CIDADE = pac.CD_CIDADE) AS DS_CIDADE,
                    (SELECT cidade.CD_UF FROM dbamv.CIDADE cidade WHERE cidade.CD_CIDADE = pac.CD_CIDADE) AS DS_UF,
                    pac.NR_CEP
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
    <title>Termo Cirurgico</title>
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
        <div class="row" style="background-color: blue;">

            <div class="col-hss-4">
                    
                <img style="max-width: 100%; max-height: 100%;" src=' . $logo_santinha . '>

            </div>

            <div class="col-hss-4" style="text-align: center;">
                    
                 <b>TERMO DE RESPONSABILIDADE E CONSENTIMENTO INFORMADO PARA PROCEDIMENTO CIRURGICO</b>

            </div>

            <div class="col-hss-4">
                        
                <!--IDENTIFICADOR DO DOCUMENTO-->
                <div>
                    FOR.STA.007
                </div>

                <div>
                
                    Data Emissão: 20/09/2018
                    <br>
                    Data Revisão: - 
                    <br>
                    Revisão: 002

                </div> 

            </div>

        </div>
        <!--Fim do cabecalho-->

        <br><br>
        <div style="text-align: left; padding-bottom: -10px !important;">

            <div style="display: inline-block; padding: 5px;">

                <label>Nome:</label><br>
                <input style="text-align: center; width: 600px;" type="text" value="' . $row_pac['NM_PACIENTE'] . '">

            </div>

        </div>

        <div style="text-align: left; padding-top: 20px !important; padding-bottom: -10px !important;">

            <div style="display: inline-block; padding: 5px;">

                <label>RG:</label><br>
                <input style="text-align: center; width: 100px;" type="text" value="' . $row_pac['NR_IDENTIDADE'] . '">

            </div>

            <div style="display: inline-block; padding: 5px;">

                <label>CPF:</label><br>
                <input style="text-align: center; width: 120px;" type="text" value="' . $row_pac['NR_CPF'] . '">
                
            </div>

            <div style="display: inline-block; padding: 5px;">

                <label>Cidade:</label><br>
                <input style="text-align: center; width: 200px;" type="text" value="' . $row_pac['DS_CIDADE'] . '">
                
            </div>

            <div style="display: inline-block; padding: 5px;">

                <label>UF:</label><br>
                <input style="text-align: center; width: 60px;" type="text" value="' . $row_pac['DS_UF'] . '">
                
            </div>

            <div style="display: inline-block; padding: 5px;">

                <label>CEP:</label><br>
                <input style="text-align: center; width: 150px;" type="text" value="' . $row_pac['NR_CEP'] . '">
            
            </div>

        </div>

        <br><br>

        <div style="text-align: left !important;">

            1. DA CONDUTA DO PACIENTE:

            Declaro ter sido informado(a) que em todo procedimento médico não há garantia de resultado e que o sucesso dos objetivos cirúrgicos dependem de minhas reações orgânicas, características anatômicas e de minha conduta em seguir de forma disciplinada as prescrições e orientações que me foram repassadas pelo médico, antes, durante e após a realização da intervenção cirúrgica, e fico desde já ciente de poderão ocorrer infecções no pós-operatório por várias causas, e ainda, inchaços, edemas, alergias que podem ou não ser decorrentes da intervenção cirúrgica, mas sem qualquer ligação com a conduta médica.

        </div>
        <br>

        <div style="text-align: left !important;">

            2. DAS INTERCORRÊNCIAS:

            Declaro que fui informado(a) por meu médico que embora sejam utilizados todos os cuidados e técnicas previstas cientificamente, a realização correta e eficaz da intervenção cirúrgica indicada não está isenta de riscos, podendo ocorrer alguma intercorrência que obrigue o médico a realizar outro procedimento anteriormente não previsto ou alterar a técnica original, caso em que fica o mesmo autorizado a utilizar desde já, todos os meios disponíveis e ao alcance em meu favor, segundo o seu julgamento. Declaro ainda que fui informado(a) por meu médico, que tais intercorrências (fatos adversos) poderão ocorrer, e portanto, não existe obrigação e garantia de resultado pelo médico e muito menos pelo hospital no qual o procedimento será realizado.

        </div>
        <br>

        <div style="text-align: left !important;">
                
            3. DOS RISCOS DA ANESTESIA:

            Declaro ter sido ainda informado(a) e estar plenamente ciente que para realizar uma intervenção cirúrgica é necessário a aplicação de anestésico, cujos métodos, preparo (minha avaliação), as técnicas e os fármacos serão de indicação e responsabilidade exclusiva do Médico Anestesista, porém, concordo e autorizo meu médico a suspender minha operação em caso de intercorrência (fato adverso) por ocasião da aplicação do anestésico, que implique em aumento do risco cirúrgico.

        </div>
        <br>

        <div style="text-align: left !important;">

            4. DO PROCEDIMENTO CIRÚRGICO:

            Declaro ter sido informado(a) e devidamente esclarecido(a) sobre as contra-indicações, riscos, gravames e possíveis complicações, bem como da via de acesso da intervenção cirúrgica indicada de acordo com meu quadro clínico e da possibilidade de re-operação, permanência no hospital superior ao previsto, e no caso de hemorragia, desde já autorizo por este termo de consentimento, a realização de transfusão de sangue. Declaro que fui informado (a) pelo médico da possibilidade da ocorrência de cicatriz, inerente a toda intervenção cirúrgica, podendo ocorrer a formação de queloide (cicatriz alta com forma de cordão, podendo gerar irritação local) ou ainda cicatrização hipertrófica, que independem da habilidade do meu médico, visto que dependem de minhas características pessoais. Declaro ter sido devidamente orientado(a) sobre a importância de controle da propagação do SARSCoV- 2, também chamado de “Coronavírus”. Estou informado(a) e compreendi que durante o período perioperatório devido ambiente hospitalar poderão ser expostos a eventual contaminação pelo SARS-CoV-2 quer por contato com outros pacientes e/ou com profissionais de saúde, mesmo que assintomáticos e não sabedores de sua condição.

        </div>
        <br>

        <div style="text-align: left !important;">

            Declaro por fim que, após atenta leitura de todas as informações contidos no presente TERMO DE CONSENTIMENTO INFORMADO, ciente e esclarecido, afirmo ser de minha vontade autorizar a realização da intervenção cirúrgica, estando plenamente esclarecido(a) dos benefícios e dos riscos da operação indicada, nada mais havendo que reivindicar.
        
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

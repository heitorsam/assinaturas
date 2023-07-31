<?php

include '../../conexao.php';

//$var_pagina = $_GET['pagina'];
$var_paciente = $_GET['paciente'];
$prestador_logado = $_GET['prestador'];

// CONSULTA INFOS PACIENTE
$consulta = "SELECT pac.*,
    TO_CHAR(SYSDATE, 'DD/MM/YYYY') AS DATA_HOJE
    FROM dbamv.PACIENTE pac
    WHERE pac.CD_PACIENTE = $var_paciente";

$res_consulta = oci_parse($conn_ora, $consulta);
oci_execute($res_consulta);

$row_pac = oci_fetch_array($res_consulta);

// CONSULTA PRESTADOR LOGADO
$consulta_prestador = "SELECT *
        FROM dbamv.PRESTADOR prest
        WHERE prest.CD_PRESTADOR = $prestador_logado";

$res_consulta_prestador = oci_parse($conn_ora, $consulta_prestador);
oci_execute($res_consulta_prestador);

$row_prestador = oci_fetch_array($res_consulta_prestador);

?>

<div style="margin-top: 2.5%;">

    <p style="font-weight: bold;">1. DA CONDUTA DO PACIENTE:</p>
    
    <p>Declaro ter sido informado(a) que em todo procedimento médico não há garantia de resultado e que o
    sucesso dos objetivos cirúrgicos dependem de minhas reações orgânicas, características anatômicas e de
    <strong style="text-decoration: underline;">minha conduta em seguir de forma disciplinada as prescrições e orientações que me foram
    repassadas pelo médico, antes, durante e após a realização da intervenção cirúrgica</strong>, e fico desde já
    ciente de poderão ocorrer infecções no pós-operatório por várias causas, e ainda, inchaços, edemas, alergias
    que podem ou não ser decorrentes da intervenção cirúrgica, mas sem qualquer ligação com a conduta
    médica.</p>

    <p style="font-weight: bold;">2. DAS INTERCORRÊNCIAS:</p>

    <p>Declaro que fui informado(a) por meu médico que embora sejam utilizados todos os cuidados e
    técnicas previstas cientificamente, a realização correta e eficaz da intervenção cirúrgica indicada não está
    isenta de riscos, podendo ocorrer alguma intercorrência que obrigue o médico a realizar outro procedimento
    anteriormente não previsto ou alterar a técnica original, caso em que fica o mesmo autorizado a utilizar desde
    já, todos os meios disponíveis e ao alcance em meu favor, segundo o seu julgamento.
    Declaro ainda que fui informado(a) por meu médico, que tais intercorrências (fatos adversos) poderão
    ocorrer, e portanto, não existe obrigação e garantia de resultado pelo médico e muito menos pelo hospital no
    qual o procedimento será realizado.</p>

    <p style="font-weight: bold;">3. DOS RISCOS DA ANESTESIA:</p>

    <p>Declaro ter sido ainda informado(a) e estar plenamente ciente que para realizar uma intervenção
    cirúrgica é necessário a aplicação de anestésico, cujos métodos, preparo (minha avaliação), as técnicas e os
    fármacos serão de indicação e responsabilidade exclusiva do Médico Anestesista, porém, concordo e
    autorizo meu médico a suspender minha operação em caso de intercorrência (fato adverso) por ocasião da
    aplicação do anestésico, que implique em aumento do risco cirúrgico.</p>

    <p style="font-weight: bold;">4. DO PROCEDIMENTO CIRÚRGICO:</p>

    <p>Declaro ter sido informado(a) e devidamente esclarecido(a) sobre as contra-indicações, riscos,
    gravames e possíveis complicações, bem como da via de acesso da intervenção cirúrgica indicada de acordo com meu quadro clínico e da possibilidade de re-operação, permanência no hospital superior ao previsto, e
    no caso de hemorragia, <strong style="text-decoration: underline;">desde já autorizo por este termo de consentimento, a realização de transfusão
    de sangue.
    </strong>
    Declaro que fui informado (a) pelo médico da possibilidade da ocorrência de cicatriz, inerente a toda
    intervenção cirúrgica, podendo ocorrer a formação de queloide (cicatriz alta com forma de cordão, podendo
    gerar irritação local) ou ainda cicatrização hipertrófica, que independem da habilidade do meu médico, visto
    que dependem de minhas características pessoais.
    Declaro ter sido devidamente orientado(a) sobre a importância de controle da propagação do SARSCoV-
    2, também chamado de “Coronavírus”. Estou informado(a) e compreendi que durante o período
    perioperatório devido ambiente hospitalar poderão ser expostos a eventual contaminação pelo SARS-CoV-2
    quer por contato com outros pacientes e/ou com profissionais de saúde, mesmo que assintomáticos e não
    sabedores de sua condição.</p>

    <p>Declaro por fim que, após atenta leitura de todas as informações contidos no presente <strong>TERMO DE
    CONSENTIMENTO INFORMADO</strong>, ciente e esclarecido, afirmo ser de minha vontade autorizar a realização
    da intervenção cirúrgica, estando plenamente esclarecido(a) dos benefícios e dos riscos da operação
    indicada, nada mais havendo que reivindicar.</p>

    <p>São José dos Campos, 28/07/2023</p>

</div>


<button onclick="ajax_modal_assinatura('1')" style="display: block; margin: 0 auto;" class="btn btn-primary">Assinatura do paciente e/ou responsável</button>

<div class="div_br"></div>

<button onclick="ajax_modal_assinatura('2')" style="display: block; margin: 0 auto;" class="btn btn-primary">Assinatura do Médico</button>

<div class="div_br"></div>

<button onclick="ajax_imprime_documento()" style="display: block; margin: 0 auto; margin-top: 2.5%;" class="btn btn-primary">Finalizar</button>
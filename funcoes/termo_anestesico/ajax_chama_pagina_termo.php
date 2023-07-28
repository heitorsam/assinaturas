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

<p>Fonte: <label style="font-weight: bold; margin: 0px;">Sociedade Brasileira de Anestesiologia</label> <br>
    Sites de referência: www.sba.com.br / www.saesp.org.br</p>


<p style="text-align: justify;"> Autorizo o(a) Dr(a). <label style="margin: 0px; font-weight: bold;"><?php echo $row_prestador['NM_PRESTADOR']; ?> </label> credenciado(a) pela Santa Casa de São José dos Campos, a realizar na minha pessoa a técnica anestésica adequada à cirurgia a que serei submetido(a). <br>
    &nbsp &nbsp O(a) médico(a) anestesiologista se compromete a utilizar a melhor técnica disponível, obrigando-se a agir com zelo profissional e diligência em busca de seus objetivos, não se responsabilizando todavia, se não os alcançar, salvo isso ocorra por negligência, imprudência ou imperícia nos meios empregados. <br>
    &nbsp &nbsp Fui devidamente informado(a) sobre riscos anestésicos, que são inerentes ao ato anestésico, sobre minhas condições clínicas, cirúrgicas e processos alérgicos. <br>
    &nbsp &nbsp Fui orientado(a) que o médico anestesiologista apenas se responsabiliza pelo procedimento de sua especialidade, não se obrigando, todavia, pela qualidade dos serviços que serão prestados pela instituição ou por outros profissionais quer participarem do ato cirúrgico. <br>
    &nbsp &nbsp Declaro que recebi e li o “Manual de Orientação de Anestesia” conforme modelo no verso deste. <br>
    &nbsp &nbsp Estou ciente de que a Santa Casa de São José dos Campos, desde o início, se preocupou com a segurança dos pacientes e das suas equipes assistenciais. Me foi explicado, pelo(s) médico(s) responsável(s), que não há isenção do risco de contaminação pelo SARS-CoV-2, em face da pandemia. Fui informado também que a instituição adota várias medidas protetivas para a realização de cirurgias, procedimentos e ou terapias. <br>
    &nbsp &nbsp Após a leitura atenta deste termo de consentimento, afirmo que me foram esclarecidas todas as minhas dúvidas sobre a anestesia e seus riscos, e por isso firmo este termo de consentimento.</p>

<div class="row">

    <div class="col-md-12">

        Responsável:
        <div>
            <input class="form form-control" type="text">
        </div>
    </div>

</div>

<div class="div_br"></div>

<div class="row">

    <div class="col-md-4">

        CPF:
        <div>
            <input class="form form-control" type="text" id="cpf">
        </div>
    </div>

    <div class="col-md-4">

        Identidade Nº:
        <div>
            <input class="form form-control" type="text" id="rg">
        </div>
    </div>

    <div class="col-md-4">

        Grau Parentesco:
        <div>
            <input class="form form-control" type="text" id="grau_parentesco">
        </div>
    </div>

</div>

<div class="div_br"></div>

<div class="row">

    <div class="col-md-5">

        <p style="font-weight: bold;">São José dos Campos, <?php echo $row_pac['DATA_HOJE']; ?></p>

    </div>

</div>

<button onclick="ajax_modal_assinatura('1')" style="display: block; margin: 0 auto;" class="btn btn-primary">Assinatura do paciente e/ou responsável</button>

<div class="div_br"></div>

<div style="width: 100%; height: 3%; background-color: #AAAAAA; border: solid 1px black;">
    <p style="text-align: center; font-weight: bold; margin: 2.5px; color: black;">DEVE SER PREENCHIDO PELO MÉDICO</p>
</div>

<div style="width: 100%; height: auto; border: solid 1px black; margin: 0px;">
    <p>Expliquei todo o procedimento ao paciente acima identificado e/ou ao responsável, sobre os benefícios, riscos e alternativas, tendo respondido às perguntas formuladas pelos mesmos.
        De acordo com o meu entendimento, o paciente e/ou responsável estão em condições de compreender o que lhes foi informado.</p>
</div>

<div class="div_br"></div>

<button onclick="ajax_modal_assinatura('2')" style="display: block; margin: 0 auto;" class="btn btn-primary">Assinatura do Médico</button>

<button onclick="imprime_documento()" style="display: block; margin: 0 auto; margin-top: 2.5%;" class="btn btn-primary">Finalizar</button>
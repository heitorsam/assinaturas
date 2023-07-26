<?php

    include '../../conexao.php';

    //VARIAVEIS
    $var_paciente = $_GET['paciente'];
    $var_prestador_logado = $_GET['prestador'];

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

?>

<div class="row" style="padding-top: 2%; border-top: solid 1px black; border-left: solid 1px black; border-right: solid 1px black;">
    
    <div class="col-md-12">

        <?php echo '1. Declaro que fui informado pelo médico Dr(a) <b>'. $row_prestador['NM_PRESTADOR'] . '</b>.'; ?>

    </div>

</div>

<div class="row" style="padding-top: 2%; border-left: solid 1px black; border-right: solid 1px black;">


    <div class="col-md-12">

        <?php echo '2. CRM / N° <b>'. $row_prestador['DS_CODIGO_CONSELHO'] . '</b>, que as avaliações e os exames realizados revelaram a necessidade de tratamento, 
                    que inclui os seguintes medicamentos: <input id="medicamentos" type="text" style="height: 20px; width: 77% !important;">.
                    '; 
        ?>

    </div>

</div>

<div class="row" style="padding-top: 2%; border-left: solid 1px black; border-right: solid 1px black;">
    
    <div class="col-md-12">

        3. Estou ciente que a utilização destes medicamentos está proposta, a principio para um período de <input id="periodo" type="text" style="height: 20px; width: 13% !important;">meses / semanas / dias, em
        <input id="ciclos" type="text" style="height: 20px; width: 10% !important;"> ciclos de tratamento.
        

    </div>

</div>

<div class="row" style="padding-top: 2%; border-left: solid 1px black; border-right: solid 1px black;">

    <div class="col-md-12">

        4. Foram claramente explicados pelo médico citado acima os benefícios, as possibilidade alternativas, os 
        riscos, efeitos colaterais e complicações potenciais relacionados ao tratamento, bem como as 
        consequências de sua não realização, diante da patologia diagnosticada;
                                    
        
    

    </div>

</div>

<div class="row" style="padding-top: 2%; border-left: solid 1px black; border-right: solid 1px black;">

    <div class="col-md-12">

        5. Estou ciente de que, durante os exames, procedimentos ou tratamentos citados, para tentar curar ou 
        melhorar a atual condição de saúde, poderão ocorrer outras situações ainda não diagnosticadas ou mesmo 
        intercorrências e outras situações imprevisíveis ou fortuitas, não obstante toda técnica e boa indicação do 
        tratamento ora proposto.

    </div>

</div>

<div class="row" style="padding-top: 2%; padding-bottom: 2%; border-left: solid 1px black; border-right: solid 1px black;">

    <div class="col-md-12">

        6. Tenho ciência de que em procedimentos invasivos (como punção lombar e outros), quando necessários 
        ou na realização de tratamento sistêmico, poderão ocorrer efeitos adversos ou complicações gerais tais 
        como as mais comuns: sangramento, infecção, perda de pelos e cabelos, trombose, alterações na visão ou 
        audição, alterações neuromotoras, náuseas, vômitos, diarreia, constipação, aftas, redução ou perda do 
        apetite, reações alérgicas, tremores e redução das células sanguíneas. 

    </div>

</div>


<div class="row" style="padding-top: 2%; border-left: solid 1px black; border-right: solid 1px black;">
    
    <div class="col-md-12">

        7. Devido à necessidade de adoção de medidas efetivas de contracepção (homens e mulheres),pelo risco 
        de aborto e malformações congênitas, comprometo-me a utilizar um método contraceptivo a fim de evitar 
        gestação, durante toda a duração do tratamento (quimioterapia, hormonioterapia e de anticorpos 
        monoclonais dentre outros) e até o período indicado pelo médico após seu término.

    </div>

</div>

<div class="row" style="padding-top: 2%; border-left: solid 1px black; border-right: solid 1px black;">


    <div class="col-md-12">

        8. Fui informado sobre o risco de alteração na fertilidade ocasionada pela doença ou tratamento instituído, 
        sobre métodos possíveis para minimizá-lo ou alternativas artificiais para promover uma futura gravidez, 
        sendo definida pela minha livre escolha.

    </div>

</div>

<div class="row" style="padding-top: 2%; border-left: solid 1px black; border-right: solid 1px black;">
    
    <div class="col-md-12">

        9. Estou ciente de que algumas medicações podem ser irritantes para as veias periféricas, ou mesmo 
        causar danos teciduais se extravasarem (saírem das veias), apesar dos cuidados e da experiência dos 
        profissionais envolvidos em sua aplicação, bem como as veias podem ficar frágeis, podendo necessitar da 
        implantação de um cateter para dar continuidade na administração segura das medicações.

        

    </div>

</div>

<div class="row" style="padding-top: 2%; border-left: solid 1px black; border-right: solid 1px black;">

    <div class="col-md-12">

        10. Tive oportunidade de fazer perguntas e obtive respostas adequadas e satisfatórias, sentindo-me 
        plenamente esclarecido e entendendo que não exista garantia absoluta sobre os resultados a serem 
        obtidos
            
    </div>

</div>

<div class="row" style="padding-top: 2%; border-left: solid 1px black; border-right: solid 1px black;">

    <div class="col-md-12">

        11. Por livre iniciativa, AUTORIZO que o(s) tratamento(s) seja(m) realizado(s) conforme exposto no presente 
        termo, inclusive quanto aos procedimentos necessários para tentar solucionar as situações imprevisíveis e 
        emergenciais, as quais serão conduzidas conforme o julgamento técnico do médico acima autorizado e 
        equipe da instituição, para que sejam alcançados os melhores resultados possíveis, utilizando os recursos 
        disponíveis no local onde se realizam os cuidados

    </div>

</div>

<div class="row" style="padding-top: 2%; padding-bottom: 2%; border-left: solid 1px black; border-right: solid 1px black;">

    <div class="col-md-12">

        <b>Certifico que este termo me foi explicado e que o li, ou que foi lido para mim e que entendi o seu 
        conteúdo, Autorizando a realização do tratamento.</b>

    </div>

</div>

<div class="row" style="padding-top: 2%; padding-bottom: 2%; border-left: solid 1px black; border-right: solid 1px black;">

    <div class="col-md-12">

        <b>São José dos Campos, <?php echo $dataAtual = date('d/m/Y'); ?>. </b>

    </div>

</div>

<div class="row" style="padding-top: 2%; padding-bottom: 2%; border-left: solid 1px black; border-right: solid 1px black;">
    <div class="col-md-12 d-flex justify-content-center">
        <button onclick="ajax_modal_assinatura('1')" class="btn btn-primary">Assinatura do Paciente ou Responsavel</button>
    </div>
</div>

<div class="row" style="padding-top: 2%; padding-bottom: 2%; border-left: solid 1px black; border-right: solid 1px black;">

    <div class="col-md-12">

        <b>RESPONSÁVEL MÉDICO</b><br>
        Declaro que prestei todas as informações necessárias ao paciente ou responsável/representante legal, 
        conforme mencionado acima, e, de acordo com meu entendimento, o paciente ou responsável legal está em 
        condições de compreender o que lhe foi informado.

    </div>

</div>

<div class="row" style="padding-top: 2%; padding-bottom: 2%; border-left: solid 1px black; border-right: solid 1px black;">

    <div class="col-md-12">

        <div style="text-align: center;">
            <b> Data: <?php echo $dataAtual = date('d/m/Y'); ?>. </b>
        </div>

    </div>
 
</div>

<div class="row" style="padding-top: 2%; padding-bottom: 2%; border-left: solid 1px black; border-right: solid 1px black;">
    <div class="col-md-12 d-flex justify-content-center">
        <button onclick="ajax_modal_assinatura('2')" class="btn btn-primary">Assinatura do Médico</button>
    </div>
</div>

<div class="row" style="padding-top: 2%; padding-bottom: 2%; border-left: solid 1px black; border-right: solid 1px black; border-bottom: solid 1px black;">
    <div class="col-md-12 d-flex justify-content-center">
        <button onclick="ajax_imprime_documento('2')" class="btn btn-primary">Finalizar</button>
    </div>
</div>

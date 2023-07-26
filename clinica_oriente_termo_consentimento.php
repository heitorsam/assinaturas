<?php

include 'conexao.php';
include 'cabecalho.php';

$prestador_logado = 6522;

//RECEBENDO VARIAVEIS
$var_paciente = '123456';
$var_atendimento = '5898756';

// CONSULTA INFOS PACIENTE
$consulta = "SELECT pac.*
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

<div style="background-color: #f4f4f4; margin-top: 5% !important; width: 90%; margin: 0 auto;">

    <div style="width: 80%; margin: 0 auto; padding-top: 5%; padding-bottom: 5%;">

        <div class="row">

            <!--CABECALHO DO DOCUMENTO-->

            <div class="col-md-4" style="text-align: center; border: solid 1px black; display: flex; justify-content: center; align-items: center;">

                <div>

                    <img src="img/logo_santa_casa_sjc.gif" style="width: 50%; height: 50%">

                </div>

            </div>

            <div class="col-md-4" style="text-align: center; border-top: solid 1px black; border-bottom: solid 1px black; display: flex; justify-content: center; align-items: center;">

                <b>TERMO DE RESPONSABILIDADE E CONSENTIMENTO INFORMADO PROCEDIMENTO ANESTÉSICO OU SEDAÇÃO</b>

            </div>

            <div class="col-md-4" style="text-align: center; border: solid 1px black;">

                <!--IDENTIFICADOR DO DOCUMENTO-->
                <div>
                    FOR.STA.007
                </div>

                <div style="text-align: left;">

                    Data Emissão: 25/06/2018
                    </br>
                    Data Revisão: 10/06/2020
                    </br>
                    Revisão: 002

                </div>

            </div>

            <!--CABECALHO DO DOCUMENTO-->

            <!--CORPO DO DOCUMENTO-->

            <div class="col-md-12" style="border-left: solid 1px black; border-right: solid 1px black; border-bottom: solid 1px black; ">

                <!--COLOQUE AQUI O CORPO DO DOCUMENTO-->

                <div style="padding: 2.5%;">

                    <div class="row">

                        <div class="col-md-5">

                            <label style="font-weight: bold;">Paciente:</label>
                            <input class="form form-control" type="text" disabled value="<?php echo $row_pac['NM_PACIENTE']; ?>">

                        </div>

                        <div class="col-md-3">

                            <label style="font-weight: bold;">Data de Nascimento:</label>
                            <input class="form form-control" type="text" disabled value="<?php echo $row_pac['DT_NASCIMENTO']; ?>">

                        </div>

                        <div class="col-md-3">

                            <label style="font-weight: bold;">Nº de Atendimento:</label>
                            <input class="form form-control" type="text" disabled value="<?php echo $var_atendimento; ?>">

                        </div>

                    </div>

                    <div class="div_br"></div>

                    <p style="text-align: justify;"> Autorizo o(a) Dr(a). <label style="margin: 0px; font-weight: bold;"><?php echo $row_prestador['NM_PRESTADOR']; ?> </label> credenciado(a) pela Santa Casa de São José dos Campos, a realizar na minha pessoa a técnica anestésica adequada à cirurgia a que serei submetido(a). <br>
                        &nbsp &nbsp O(a) médico(a) anestesiologista se compromete a utilizar a melhor técnica disponível, obrigando-se a agir com zelo profissional e diligência em busca de seus objetivos, não se responsabilizando todavia, se não os alcançar, salvo isso ocorra por negligência, imprudência ou imperícia nos meios empregados. <br>
                        &nbsp &nbsp Fui devidamente informado(a) sobre riscos anestésicos, que são inerentes ao ato anestésico, sobre minhas condições clínicas, cirúrgicas e processos alérgicos. <br>
                        &nbsp &nbsp Fui orientado(a) que o médico anestesiologista apenas se responsabiliza pelo procedimento de sua especialidade, não se obrigando, todavia, pela qualidade dos serviços que serão prestados pela instituição ou por outros profissionais quer participarem do ato cirúrgico. <br>
                        &nbsp &nbsp Declaro que recebi e li o “Manual de Orientação de Anestesia” conforme modelo no verso deste. <br>
                        &nbsp &nbsp Estou ciente de que a Santa Casa de São José dos Campos, desde o início, se preocupou com a segurança dos pacientes e das suas equipes assistenciais. Me foi explicado, pelo(s) médico(s) responsável(s), que não há isenção do risco de contaminação pelo SARS-CoV-2, em face da pandemia. Fui informado também que a instituição adota várias medidas protetivas para a realização de cirurgias, procedimentos e ou terapias. <br>
                        &nbsp &nbsp Após a leitura atenta deste termo de consentimento, afirmo que me foram esclarecidas todas as minhas dúvidas sobre a anestesia e seus riscos, e por isso firmo este termo de consentimento.</p>

                        <p style="font-weight: bold;">Paciente: </p>

                        <p style="font-weight: bold;">Responsável: </p>

                </div>

            </div>

            <!--CORPO DO DOCUMENTO-->

        </div>

    </div>


</div>



<?php

include 'rodape.php';

?>
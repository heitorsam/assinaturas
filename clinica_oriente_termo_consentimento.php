<?php

include 'conexao.php';
include 'cabecalho.php';

$prestador_logado = 6522;

//RECEBENDO VARIAVEIS
$var_paciente = '123456';
$var_atendimento = '5898756';

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

            <div class="col-md-12" style="border-left: solid 1px black; border-right: solid 1px black; border-bottom: solid 1px black;">

                <!--COLOQUE AQUI O CORPO DO DOCUMENTO-->

                <div>

                    <div class="row" style="border-bottom: solid 1px black; padding-bottom: 2.5%;">

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

                    <div id="carrega_pagina"></div>

                </div>

                <div style="text-align: right; font-size: 20px;">
                    <i onclick="ajax_chama_pagina()" style="cursor:pointer;" class="fa-solid fa-share"></i>
                </div>
        

            </div>

            <!--CORPO DO DOCUMENTO-->

            


        </div>

    </div>


</div>


<?php

include 'rodape.php';

?>

<script>

    var controle_pagina = 0;

    window.onload = function() {

        ajax_chama_pagina();

    }

    function ajax_chama_pagina() {

        var paciente = '<?php echo $var_paciente; ?>';
        var prestador = '<?php echo $prestador_logado; ?>';

        if (controle_pagina == 2) {

            controle_pagina = 0;
        }

        var var_pagina = controle_pagina + 1;

        controle_pagina = controle_pagina + 1;

        $('#carrega_pagina').load('funcoes/termo_quimioterapia/termo_anestesico/ajax_chama_pagina_termo.php?pagina=' + var_pagina + '&paciente=' + paciente + '&prestador=' + prestador);

    }

</script>
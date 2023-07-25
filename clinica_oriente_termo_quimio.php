<?php

    include 'conexao.php';
    include 'cabecalho.php';

    //RECEBENDO VARIAVEIS
    $var_paciente = '123456';

    $consulta = "SELECT * FROM dbamv.PACIENTE pac WHERE pac.CD_PACIENTE = $var_paciente";
    $res_consulta = oci_parse($conn_ora, $consulta);
                    oci_execute($res_consulta);

    $row_pac = oci_fetch_array($res_consulta);
    

?>

<div style="background-color: #f4f4f4; margin-top: 5% !important; width: 90%; margin: 0 auto;">

    <div style="width: 80%; margin: 0 auto; padding-top: 5%; padding-bottom: 5%;">

        <div class="row">

            <div class="col-md-4" style="text-align: center; border: solid 1px black; display: flex; justify-content: center; align-items: center;">
            
            <div>

                <img src="img/logo_santa_casa_sjc.gif" style="width: 50%; height: 50%">

            </div>

            </div>

            <div class="col-md-4" style="text-align: center; border-top: solid 1px black; border-bottom: solid 1px black; display: flex; justify-content: center; align-items: center;">

                <b>TERMO DE CONSENTIMENTO LIVRE E ESCLARECIDO DE QUIMIOTERAPIA</b>

            </div>

            <div class="col-md-4" style="text-align: center; border: solid 1px black;">

                <!--IDENTIFICADOR DO DOCUMENTO-->
                <div style="background-color red;">
                    FOR.STA.007
                </div>

                <div style="text-align: left;">
                
                    Data Emissão: 20/09/2018
                    </br>
                    Data Revisão: - 
                    </br>
                    Revisão: 000

                </div>

            </div>

        </div>

    </div>


</div>



<?php

    include 'rodape.php';

?>
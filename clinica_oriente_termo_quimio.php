<?php

include 'conexao.php';
include 'cabecalho.php';

//RECEBENDO VARIAVEIS
$var_paciente = '750779';
$var_prestador_logado = 'ARIPEREIRA';
$var_pagina = '1';

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

<div style="background-color: #f4f4f4; margin-top: 2% !important; width: 90%; margin: 0 auto;">

    <div style="width: 80%; margin: 0 auto; padding-top: 5%; padding-bottom: 5%;">

        <div class="row">

            <!--CABECALHO DO DOCUMENTO-->

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
                    Revisão: 002

                </div>

                <div style="text-align: center; font-size: 12px;">
                
                    Página <?php echo $var_pagina; ?> de 2

                </div>

            </div>
        </div>

        <!--CABECALHO DO DOCUMENTO-->

        <!--CORPO DO DOCUMENTO-->

        <div class="row" style="padding-top: 2%; padding-bottom: 2%; border-left: solid 1px black; border-right: solid 1px black;">

            <div class="col-md-5">

                Paciente:
                <input readonly type="text" class="form form-control" id="nm_pac" value="<?php echo $row_pac['NM_PACIENTE']; ?>">

            </div>

            <div class="col-md-2">
                
                Nascimento:
                <input readonly type="text" class="form form-control" id="dt_nascimento" value="<?php echo $row_pac['DT_NASCIMENTO']; ?>">

            </div>

            <div class="col-md-1">
                
                Sexo:
                <input readonly type="text" class="form form-control" id="tp_sexo" value="<?php echo $row_pac['TP_SEXO']; ?>">
            
            </div>

            <div class="col-md-2">
                
                Identidade N°:
                <input readonly type="text" class="form form-control" id="nr_identidade" value="<?php echo $row_pac['NR_IDENTIDADE']; ?>">

            </div>

            <div class="col-md-2">
                
                Órgão:
                <input readonly type="text" class="form form-control" id="tp_orgão" value="<?php echo $row_pac['DS_OM_IDENTIDADE']; ?>">

            </div>

        </div>

        <div class="row" style="padding-top: 2%; padding-bottom: 2%; border-top: solid 1px black; border-left: solid 1px black; border-right: solid 1px black;">

            <div class="col-md-12">

                <b>No caso do declarante não ser o paciente, preencher o espaço abaixo:</b>

            </div>

            <div class="col-md-4">

            <b>Representante Lega/Responsavel:</b>

            </div>

        </div>

        <div class="row" style="padding-bottom: 2%; border-left: solid 1px black; border-right: solid 1px black;">

            <div class="col-md-5">

                Nome:
                <input type="text" class="form form-control" id="nm_responsavel" placeholder="Nome do Responsavel">

            </div>

            <div class="col-md-4">

                Nascimento:
                <input type="date" class="form form-control" id="dt_nascimento_responsavel">

            </div>

            
            <div class="col-md-3">

                Sexo:
                <select class="form form-control" id="tp_sexo_responsavel">

                    <option value="M" >Masculino</option>
                    <option value="F">Feminino</option>

                </select>

            </div>

        </div>

        <div class="row" style="padding-bottom: 2%; border-left: solid 1px black; border-right: solid 1px black;">

            <div class="col-md-3">

                Identidade:
                <input type="text" class="form form-control" id="nr_identidade" placeholder="N° Identidade">

            </div>

            <div class="col-md-3">

                Orgão:
                <input type="text" class="form form-control" id="ds_orgão_expedidor" placeholder="Orgão expedidor">

            </div>

            <div class="col-md-3">

                Endereço:
                <input type="text" class="form form-control" id="ds_endereco">

            </div>

            <div class="col-md-3">

                Telefone:
                <input type="number" class="form form-control" id="ds_endereco">

            </div>


        </div>

        <div id="pagina_doc"></div>

        <!--CORPO DO DOCUMENTO-->

        <!--PASSA PARA PAGINA DOIS DO DOCUMENTO-->

        <div style="text-align: right; font-size: 20px;">
            <i onclick="ajax_chama_pagina()" style="cursor:pointer;" class="fa-solid fa-share"></i>
        </div>
        

        
    </div>

</div>

<script>

    controle_pagina = 0;
    
    window.onload = function(){

        ajax_chama_pagina()

    }

    function ajax_chama_pagina(){

        var_paciente = '<?php echo $var_paciente; ?>';

        var_prestador_logado = '<?php echo $var_prestador_logado; ?>';

        if(controle_pagina == 2){

            controle_pagina = 0;
        }

        var_pagina = controle_pagina + 1;

        controle_pagina = controle_pagina + 1;

        console.log(var_pagina);

        $('#pagina_doc').load('funcoes/termo_quimioterapia/ajax_chama_pagina.php?paciente='+var_paciente+'&prestador='+var_prestador_logado+'&pagina='+var_pagina);
        
    }


</script>




<?php

    include 'rodape.php';

?>
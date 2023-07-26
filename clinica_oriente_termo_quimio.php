<?php

include 'conexao.php';
include 'cabecalho.php';

//RECEBENDO VARIAVEIS
$var_paciente = '750779';
$var_prestador_logado = 'ARIPEREIRA';
$var_pagina_php = '1';

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
                <div>
                    FOR.STA.007
                </div>

                <div style="text-align: left;">
                
                    Data Emissão: 20/09/2018
                    </br>
                    Data Revisão: - 
                    </br>
                    Revisão: 002

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

    </div>

</div>

    <!-- MODAL ASSINATURA -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document"> <!-- Aumentei o tamanho da modal usando "modal-lg" -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Assinatura</h5>
                </div>
                <div class="modal-body" style="margin: 0 auto;">
                    <canvas id="sig-canvas" width="920" height="260" style="border: solid 1px black; margin-top: 20px; width: 900px; height: 250px;"></canvas>
                    <input type="hidden" name="escondidinho" id="escondidinho">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="sig-clearBtn" onClick="redraw()"><i class="fas fa-eraser"></i> Limpar</button>
                    <button type="button" type="submit" class="btn btn-primary" id="sig-submitBtn" onclick="ajax_fecha_modal('1')"><i class="fas fa-paper-plane"></i> Salvar Assinatura</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ASSINATURA -->
    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document"> <!-- Aumentei o tamanho da modal usando "modal-lg" -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Assinatura</h5>
            </div>
            <div class="modal-body" style="margin: 0 auto;">
                <canvas id="sig-canvas2" width="920" height="260" style="border: solid 1px black; margin-top: 20px; width: 900px; height: 250px;"></canvas>
                <input type="hidden" name="escondidinho2" id="escondidinho2">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="sig-clearBtn" onClick="redraw()"><i class="fas fa-eraser"></i> Limpar</button>
                <button type="button" type="submit" class="btn btn-primary" id="sig-submitBtn2" onclick="ajax_fecha_modal('2')"><i class="fas fa-paper-plane"></i> Salvar Assinatura</button>
            </div>
        </div>
    </div>
    </div>

<script>

    function ajax_fecha_modal(modal){

        if(modal == '1'){

            $('#exampleModalCenter').modal('hide')

        }else{

            $('#exampleModalCenter2').modal('hide')


        }

    }



    function ajax_imprime_documento() {

    var var_paciente = '<?php echo $var_paciente; ?>';
    var var_prestador_logado = '<?php echo $var_prestador_logado; ?>';
    var var_assinatura_pac;
    var var_assinatura_med;
    var medicamentos = document.getElementById('medicamentos').value;
    var periodo = document.getElementById('periodo').value;
    var ciclos = document.getElementById('ciclos').value;
    
    
    


    $.ajax({
        url: "funcoes/termo_quimioterapia/ajax_pdf_quimioterapia.php",
        type: "POST",
        data: {
            var_paciente: var_paciente,
            var_prestador_logado: var_prestador_logado,
            var_assinatura_pac: var_assinatura_pac,
            var_assinatura_med: var_assinatura_med,
            medicamentos : medicamentos,
            periodo : periodo, 
            ciclos : ciclos

        },
        cache: false,
        xhrFields: {
            responseType: 'blob' // Importante para receber dados binários (PDF)
        },
        success: function (data) {
            // Cria uma URL temporária para o PDF
            var pdfUrl = URL.createObjectURL(data);

            // Abre uma nova janela para exibir o PDF
            window.open(pdfUrl);
        }
    });

    
}


    function ajax_modal_assinatura(tp_modal){

        if(tp_modal == '1'){

            $('#exampleModalCenter').modal('show')

        }else{

            $('#exampleModalCenter2').modal('show')


        }
        
    }

    var_assinatura_pac = '';
    var_assinatura_med = '';

    //SALVA A IMAGEM DA ASSINATURA PACIENTE

    document.getElementById("sig-submitBtn").addEventListener("click", function () {

        var canvas = document.getElementById("sig-canvas");

        var_assinatura_pac = document.getElementById('escondidinho').value = canvas.toDataURL('image/png');

    });


    //SALVA A IMAGEM DA ASSINATURA MEDICO
    document.getElementById("sig-submitBtn2").addEventListener("click", function () {

    var canvas = document.getElementById("sig-canvas2");

    var_assinatura_med = document.getElementById('escondidinho2').value = canvas.toDataURL('image/png');

    });


(function() {
    
    // Get a regular interval for drawing to the screen
    window.requestAnimFrame = (function (callback) {
        return window.requestAnimationFrame || 
                    window.webkitRequestAnimationFrame ||
                    window.mozRequestAnimationFrame ||
                    window.oRequestAnimationFrame ||
                    window.msRequestAnimaitonFrame ||
                    function (callback) {
                        window.setTimeout(callback, 1000/60);
                    };
    })();

    // Set up the canvas
    var canvas = document.getElementById("sig-canvas");
    var ctx = canvas.getContext("2d");
    ctx.strokeStyle = "#5b79b4";
    ctx.lineWith = 2;

    // Set up the UI
    var sigText = document.getElementById("sig-dataUrl");
    var sigImage = document.getElementById("sig-image");
    var clearBtn = document.getElementById("sig-clearBtn");
    clearBtn.addEventListener("click", function (e) {
        clearCanvas();
        sigText.innerHTML = "Data URL for your signature will go here!";
        sigImage.setAttribute("src", "");
    }, false);

    // Set up mouse events for drawing
    var drawing = false;
    var mousePos = { x:0, y:0 };
    var lastPos = mousePos;
    canvas.addEventListener("mousedown", function (e) {
        drawing = true;
        lastPos = getMousePos(canvas, e);
    }, false);
    canvas.addEventListener("mouseup", function (e) {
        drawing = false;
    }, false);
    canvas.addEventListener("mousemove", function (e) {
        mousePos = getMousePos(canvas, e);
    }, false);

    // Set up touch events for mobile, etc
    canvas.addEventListener("touchstart", function (e) {
        mousePos = getTouchPos(canvas, e);
        var touch = e.touches[0];
        var mouseEvent = new MouseEvent("mousedown", {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        canvas.dispatchEvent(mouseEvent);
    }, false);
    canvas.addEventListener("touchend", function (e) {
        var mouseEvent = new MouseEvent("mouseup", {});
        canvas.dispatchEvent(mouseEvent);
    }, false);
    canvas.addEventListener("touchmove", function (e) {
        var touch = e.touches[0];
        var mouseEvent = new MouseEvent("mousemove", {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        canvas.dispatchEvent(mouseEvent);
    }, false);

    // Prevent scrolling when touching the canvas
    document.body.addEventListener("touchstart", function (e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);
    document.body.addEventListener("touchend", function (e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);
    document.body.addEventListener("touchmove", function (e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);

    // Get the position of the mouse relative to the canvas
    function getMousePos(canvasDom, mouseEvent) {
        var rect = canvasDom.getBoundingClientRect();
        return {
            x: mouseEvent.clientX - rect.left,
            y: mouseEvent.clientY - rect.top
        };
    }

    // Get the position of a touch relative to the canvas
    function getTouchPos(canvasDom, touchEvent) {
        var rect = canvasDom.getBoundingClientRect();
        return {
            x: touchEvent.touches[0].clientX - rect.left,
            y: touchEvent.touches[0].clientY - rect.top
        };
    }

    // Draw to the canvas
    function renderCanvas() {
        if (drawing) {
            ctx.moveTo(lastPos.x, lastPos.y);
            ctx.lineTo(mousePos.x, mousePos.y);
            ctx.stroke();
            lastPos = mousePos;
        }
    }

    // Clear the canvas
    function clearCanvas() {
        canvas.width = canvas.width;
    }

    // Allow for animation
    (function drawLoop () {
        requestAnimFrame(drawLoop);
        renderCanvas();
    })();


})();

(function() {
    
    // Get a regular interval for drawing to the screen
    window.requestAnimFrame = (function (callback) {
        return window.requestAnimationFrame || 
                    window.webkitRequestAnimationFrame ||
                    window.mozRequestAnimationFrame ||
                    window.oRequestAnimationFrame ||
                    window.msRequestAnimaitonFrame ||
                    function (callback) {
                        window.setTimeout(callback, 1000/60);
                    };
    })();

    // Set up the canvas
    var canvas = document.getElementById("sig-canvas2");
    var ctx = canvas.getContext("2d");
    ctx.strokeStyle = "#5b79b4";
    ctx.lineWith = 2;

    // Set up the UI
    var sigText = document.getElementById("sig-dataUrl");
    var sigImage = document.getElementById("sig-image");
    var clearBtn = document.getElementById("sig-clearBtn");
    clearBtn.addEventListener("click", function (e) {
        clearCanvas();
        sigText.innerHTML = "Data URL for your signature will go here!";
        sigImage.setAttribute("src", "");
    }, false);

    // Set up mouse events for drawing
    var drawing = false;
    var mousePos = { x:0, y:0 };
    var lastPos = mousePos;
    canvas.addEventListener("mousedown", function (e) {
        drawing = true;
        lastPos = getMousePos(canvas, e);
    }, false);
    canvas.addEventListener("mouseup", function (e) {
        drawing = false;
    }, false);
    canvas.addEventListener("mousemove", function (e) {
        mousePos = getMousePos(canvas, e);
    }, false);

    // Set up touch events for mobile, etc
    canvas.addEventListener("touchstart", function (e) {
        mousePos = getTouchPos(canvas, e);
        var touch = e.touches[0];
        var mouseEvent = new MouseEvent("mousedown", {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        canvas.dispatchEvent(mouseEvent);
    }, false);
    canvas.addEventListener("touchend", function (e) {
        var mouseEvent = new MouseEvent("mouseup", {});
        canvas.dispatchEvent(mouseEvent);
    }, false);
    canvas.addEventListener("touchmove", function (e) {
        var touch = e.touches[0];
        var mouseEvent = new MouseEvent("mousemove", {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        canvas.dispatchEvent(mouseEvent);
    }, false);

    // Prevent scrolling when touching the canvas
    document.body.addEventListener("touchstart", function (e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);
    document.body.addEventListener("touchend", function (e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);
    document.body.addEventListener("touchmove", function (e) {
        if (e.target == canvas) {
            e.preventDefault();
        }
    }, false);

    // Get the position of the mouse relative to the canvas
    function getMousePos(canvasDom, mouseEvent) {
        var rect = canvasDom.getBoundingClientRect();
        return {
            x: mouseEvent.clientX - rect.left,
            y: mouseEvent.clientY - rect.top
        };
    }

    // Get the position of a touch relative to the canvas
    function getTouchPos(canvasDom, touchEvent) {
        var rect = canvasDom.getBoundingClientRect();
        return {
            x: touchEvent.touches[0].clientX - rect.left,
            y: touchEvent.touches[0].clientY - rect.top
        };
    }

    // Draw to the canvas
    function renderCanvas() {
        if (drawing) {
            ctx.moveTo(lastPos.x, lastPos.y);
            ctx.lineTo(mousePos.x, mousePos.y);
            ctx.stroke();
            lastPos = mousePos;
        }
    }

    // Clear the canvas
    function clearCanvas() {
        canvas.width = canvas.width;
    }

    // Allow for animation
    (function drawLoop () {
        requestAnimFrame(drawLoop);
        renderCanvas();
    })();
    

})();



    window.onload = function(){

        ajax_chama_pagina()

    }

    function ajax_chama_pagina(){

        var_paciente = '<?php echo $var_paciente; ?>';

        var_prestador_logado = '<?php echo $var_prestador_logado; ?>';

        $('#pagina_doc').load('funcoes/termo_quimioterapia/ajax_chama_pagina.php?paciente='+var_paciente+'&prestador='+var_prestador_logado);



    }





</script>

<?php

    include 'rodape.php';

?>
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
                <button type="button" type="submit" class="btn btn-primary" id="sig-submitBtn"><i class="fas fa-paper-plane"></i> Enviar</button>
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
                <canvas id="sig-canvas" width="920" height="260" style="border: solid 1px black; margin-top: 20px; width: 900px; height: 250px;"></canvas>
                <input type="hidden" name="escondidinho" id="escondidinho">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="sig-clearBtn" onClick="redraw()"><i class="fas fa-eraser"></i> Limpar</button>
                <button type="button" type="submit" class="btn btn-primary" id="sig-submitBtn"><i class="fas fa-paper-plane"></i> Enviar</button>
            </div>
        </div>
    </div>
</div>

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

                <div style="text-align: center; font-size: 12px;">

                    Página <label id="pagina_cabecalho"></label> de 2

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

    function ajax_modal_assinatura(tp_modal) {

        if (tp_modal == '1') {

            $('#exampleModalCenter').modal('show')

        } else {

            $('#exampleModalCenter2').modal('show')

        }

    }

    (function() {

        // Get a regular interval for drawing to the screen
        window.requestAnimFrame = (function(callback) {
            return window.requestAnimationFrame ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                window.oRequestAnimationFrame ||
                window.msRequestAnimaitonFrame ||
                function(callback) {
                    window.setTimeout(callback, 1000 / 60);
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
        clearBtn.addEventListener("click", function(e) {
            clearCanvas();
            sigText.innerHTML = "Data URL for your signature will go here!";
            sigImage.setAttribute("src", "");
        }, false);

        // Set up mouse events for drawing
        var drawing = false;
        var mousePos = {
            x: 0,
            y: 0
        };
        var lastPos = mousePos;
        canvas.addEventListener("mousedown", function(e) {
            drawing = true;
            lastPos = getMousePos(canvas, e);
        }, false);
        canvas.addEventListener("mouseup", function(e) {
            drawing = false;
        }, false);
        canvas.addEventListener("mousemove", function(e) {
            mousePos = getMousePos(canvas, e);
        }, false);

        // Set up touch events for mobile, etc
        canvas.addEventListener("touchstart", function(e) {
            mousePos = getTouchPos(canvas, e);
            var touch = e.touches[0];
            var mouseEvent = new MouseEvent("mousedown", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        }, false);
        canvas.addEventListener("touchend", function(e) {
            var mouseEvent = new MouseEvent("mouseup", {});
            canvas.dispatchEvent(mouseEvent);
        }, false);
        canvas.addEventListener("touchmove", function(e) {
            var touch = e.touches[0];
            var mouseEvent = new MouseEvent("mousemove", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        }, false);

        // Prevent scrolling when touching the canvas
        document.body.addEventListener("touchstart", function(e) {
            if (e.target == canvas) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchend", function(e) {
            if (e.target == canvas) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchmove", function(e) {
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
        (function drawLoop() {
            requestAnimFrame(drawLoop);
            renderCanvas();
        })();


    })();

    (function() {

        // Get a regular interval for drawing to the screen
        window.requestAnimFrame = (function(callback) {
            return window.requestAnimationFrame ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                window.oRequestAnimationFrame ||
                window.msRequestAnimaitonFrame ||
                function(callback) {
                    window.setTimeout(callback, 1000 / 60);
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
        clearBtn.addEventListener("click", function(e) {
            clearCanvas();
            sigText.innerHTML = "Data URL for your signature will go here!";
            sigImage.setAttribute("src", "");
        }, false);

        // Set up mouse events for drawing
        var drawing = false;
        var mousePos = {
            x: 0,
            y: 0
        };
        var lastPos = mousePos;
        canvas.addEventListener("mousedown", function(e) {
            drawing = true;
            lastPos = getMousePos(canvas, e);
        }, false);
        canvas.addEventListener("mouseup", function(e) {
            drawing = false;
        }, false);
        canvas.addEventListener("mousemove", function(e) {
            mousePos = getMousePos(canvas, e);
        }, false);

        // Set up touch events for mobile, etc
        canvas.addEventListener("touchstart", function(e) {
            mousePos = getTouchPos(canvas, e);
            var touch = e.touches[0];
            var mouseEvent = new MouseEvent("mousedown", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        }, false);
        canvas.addEventListener("touchend", function(e) {
            var mouseEvent = new MouseEvent("mouseup", {});
            canvas.dispatchEvent(mouseEvent);
        }, false);
        canvas.addEventListener("touchmove", function(e) {
            var touch = e.touches[0];
            var mouseEvent = new MouseEvent("mousemove", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        }, false);

        // Prevent scrolling when touching the canvas
        document.body.addEventListener("touchstart", function(e) {
            if (e.target == canvas) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchend", function(e) {
            if (e.target == canvas) {
                e.preventDefault();
            }
        }, false);
        document.body.addEventListener("touchmove", function(e) {
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
        (function drawLoop() {
            requestAnimFrame(drawLoop);
            renderCanvas();
        })();


    })();


    function ajax_chama_pagina() {

        var pagina_cabecalho = document.getElementById('pagina_cabecalho');

        var paciente = '<?php echo $var_paciente; ?>';
        var prestador = '<?php echo $prestador_logado; ?>';

        if (controle_pagina == 2) {

            controle_pagina = 0;
        }

        var var_pagina = controle_pagina + 1;

        controle_pagina = controle_pagina + 1;

        pagina_cabecalho.innerHTML = var_pagina;

        $('#carrega_pagina').load('funcoes/termo_anestesico/ajax_chama_pagina_termo.php?pagina=' + var_pagina + '&paciente=' + paciente + '&prestador=' + prestador);

    }
</script>
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
                <button onclick="salvar_assinatura('1')" type="button" type="submit" class="btn btn-primary" id="sig-submitBtn"><i class="fas fa-paper-plane"></i> Salvar assinatura</button>
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
                <input type="hidden" name="escondidinho" id="escondidinho">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="sig-clearBtn2" onClick="redraw()"><i class="fas fa-eraser"></i> Limpar</button>
                <button onclick="salvar_assinatura('2')" type="button" type="submit" class="btn btn-primary" id="sig-submitBtn2"><i class="fas fa-paper-plane"></i> Salvar assinatura</button>
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

            </div>

            <!--CABECALHO DO DOCUMENTO-->

            <!--CORPO DO DOCUMENTO-->

            <div class="col-md-12" style="border-left: solid 1px black; border-right: solid 1px black; border-bottom: solid 1px black;">

                <!--COLOQUE AQUI O CORPO DO DOCUMENTO-->

                <div style="padding-bottom: 2.5%;">

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

            </div>

            <!--CORPO DO DOCUMENTO-->

        </div>

    </div>


</div>


<?php

include 'rodape.php';

$varlogo = 'data:image/png;base64,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';

?>

<script>

    var controle_pagina = 0;
    data_assin_paciente = '';
    data_assin_medico = '';

    window.onload = function() {

        ajax_chama_pagina();

    }

    function imprime_documento() {

        var var_paciente = '<?php echo $var_paciente; ?>';
        var var_prestador_logado = '<?php echo $prestador_logado; ?>';
        var var_logo_santa_casa = '<?php echo $varlogo; ?>';
        var cpf = document.getElementById('cpf').value;
        var identidade = document.getElementById('rg').value;
        var grau_parentesco = document.getElementById('grau_parentesco').value;

        $.ajax({
            url: "funcoes/termo_anestesico/ajax_pdf_termo_consentimento.php",
            method: "POST",
            data: {
                var_paciente,
                var_prestador_logado,
                data_assin_paciente,
                data_assin_medico,
                var_logo_santa_casa,
                cpf,
                identidade,
                grau_parentesco
            },
            cache: false,
            xhrFields: {
                responseType: 'blob' // Importante para receber dados binários (PDF)
            },
            success: function(data) {

                // Cria uma URL temporária para o PDF
                var pdfUrl = URL.createObjectURL(data);

                // Abre uma nova janela para exibir o PDF
                window.open(pdfUrl);

            }

        })

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
        var clearBtn = document.getElementById("sig-clearBtn2");
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

    // FUNÇÃO PARA ARMAZENAR ASSINATURA
    function salvar_assinatura(tp_assinatura) {

        if (tp_assinatura == '1') {

            var assinatura_paciente = document.getElementById('sig-canvas');
            var ctx = assinatura_paciente.getContext('2d');

            data_assin_paciente = assinatura_paciente.toDataURL('image/png');
            console.log(data_assin_paciente);

        } else {

            var assinatura_medico = document.getElementById('sig-canvas2');
            var ctx = assinatura_medico.getContext('2d');

            data_assin_medico = assinatura_medico.toDataURL('image/png');
            console.log(data_assin_medico);

        }

        // FECHA A MODAL
        if (tp_assinatura == '1'){

            $('#exampleModalCenter').modal('hide')

        } else{

            $('#exampleModalCenter2').modal('hide')


        }

    }

    function ajax_chama_pagina() {

        //var pagina_cabecalho = document.getElementById('pagina_cabecalho');

        var paciente = '<?php echo $var_paciente; ?>';
        var prestador = '<?php echo $prestador_logado; ?>';

        if (controle_pagina == 2) {

            controle_pagina = 0;
        }

        var var_pagina = controle_pagina + 1;

        controle_pagina = controle_pagina + 1;

        //pagina_cabecalho.innerHTML = var_pagina;

        $('#carrega_pagina').load('funcoes/termo_anestesico/ajax_chama_pagina_termo.php?paciente=' + paciente + '&prestador=' + prestador);

    }

</script>
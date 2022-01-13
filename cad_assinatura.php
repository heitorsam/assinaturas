<?php 
	
    //CABECALHO
    include 'cabecalho.php';

    //CONEXAO
    include 'conexao.php';

	if(isset($_SESSION['prestconsulta'])){

		@$cd_prest = $_SESSION['prestconsulta'];

	} else {

		//RECEBENDO POST
		if(isset($_POST['frm_cd_prestador'])){

			@$cd_prest = $_POST['frm_cd_prestador'];			

		} else {
			
			@$cd_prest = 0;   
		}

	}

    ////////////
    //PACIENTE//
    ///////////
    //SQL BUSCA ASSINATURA
    $cons_dados_prest = "SELECT prest.CD_PRESTADOR, prest.DS_CODIGO_CONSELHO,
						 prest.NM_PRESTADOR, tipa.NM_TIP_PRESTA,
						 pas.ASSINATURA_TISS, pas.ASSINATURA
						 FROM dbamv.PRESTADOR prest
						 LEFT JOIN dbamv.prestador_assinatura pas
							ON pas.CD_PRESTADOR = prest.CD_PRESTADOR
						 LEFT JOIN dbamv.TIP_PRESTA tipa
							ON tipa.CD_TIP_PRESTA = prest.CD_TIP_PRESTA
						 WHERE prest.CD_PRESTADOR = $cd_prest";

    $result_dados_prest = oci_parse($conn_ora, $cons_dados_prest);
    @oci_execute($result_dados_prest);
    $row_dd_prest = oci_fetch_array($result_dados_prest);
    if(!isset($row_dd_prest['CD_PRESTADOR']) && isset($_POST['CD_PRESTADOR'])){
        $_SESSION['msgerro'] = "Prestador não encontrado."; 
    }
    
    @$var_cd_prestador = $row_dd_prest['CD_PRESTADOR'];
    @$var_coren = $row_dd_prest['DS_CODIGO_CONSELHO'];
    @$var_nm_prestador = $row_dd_prest['NM_PRESTADOR'];
    @$var_nm_funcao = $row_dd_prest['NM_TIP_PRESTA'];

	/*$code_base64 = $row_dd_prest['NM_TIP_PRESTA'];
	$code_base64 = str_replace('data:image/jpeg;base64,','',$code_base64);
	$code_binary = base64_decode($code_base64);
	$image= imagecreatefromstring($code_binary);
	header('Content-Type: image/jpeg');
	imagejpeg($image);
	imagedestroy($image);*/

?>

<!DOCTYPE HTML>
<html>
<body>
	<!-- Content -->
	<div class="container">
	<div class="div_br"> </div>

		<!--MENSAGENS-->
		<?php
		include 'js/mensagens.php';
		include 'js/mensagens_usuario.php';
		?>
			
		<div class="div_br"> </div>        

		<h11><i class="fas fa-user-nurse"></i> Cadastro Assinatura</h11>
		<span class="espaco_pequeno" style="width: 6px;" ></span>
		<h27> <a href="home.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 


		<div class="div_br"> </div>
		<form method="post" autocomplete="off" action="cad_assinatura.php">
		<div class="row">
		<div class="col-md-4 ">
			Prestador:
			<div class="input-group">                            
				<select class="form-control" name="frm_cd_prestador" required>
						<option selected>Selecione o Prestador</option>
						<?php
							$cons_nome_pres = "SELECT DISTINCT  pres.CD_PRESTADOR, pres.NM_PRESTADOR
												FROM dbamv.PRESTADOR pres
												JOIN dbasgu.usuarios usu ON pres.cd_prestador = usu.cd_prestador
												WHERE pres.CD_TIP_PRESTA <> 8
												AND usu.SN_ATIVO = 'S'
												ORDER BY pres.NM_PRESTADOR ASC ";
							$result_nome_pres = oci_parse($conn_ora, $cons_nome_pres);
							@oci_execute($result_nome_pres);
							while($row_nome_pres = oci_fetch_array($result_nome_pres)){ ?>
								<option value="<?php echo $row_nome_pres['CD_PRESTADOR']; ?>"><?php echo $row_nome_pres['NM_PRESTADOR']; ?></option> <?php
							}
						?>
				</select>

				<button type="submit" class=" btn btn-primary" id="btn_pesquisar"> <i class="fas fa-search"></i></button>	
				
			</div>
		</div>
		</form>
		</br>

		<!---RESULTADO DA PESQUISA-->

		<?php if(strlen($var_nm_prestador) > 1){ ?>
		
		<form style="margin-top: 20px;" method="post" autocomplete="off" id="assinatura" action="gerar_documento_pdf.php">
		<div class="row">
		<div class="col-md-2" id="div_sn_exame_mv">
					<label>Código:</label>
					<input type="text"  class="form-control" value="<?php echo @$var_cd_prestador?>" name="cd_atendimento" readonly></input>
			</div>
		<div class="col-md-2" id="div_sn_exame_mv">
					<label>Coren:</label>
					<input type="text"  class="form-control" value="<?php echo @$var_coren?>" name="nm_paciente" readonly></input>
			</div>
			<div class="col-md-4" id="div_sn_exame_mv">
					<label>Nome:</label>
					<input type="text" value="<?php echo @$var_nm_prestador ?>" class="form-control" name="dt_aten" readonly></input>
			</div>
			<div class="col-md-4" id="div_sn_exame_mv">
					<label>Função:</label>
					<input type="text" value="<?php echo @$var_nm_funcao;?>" class="form-control" name="nm_conv" readonly></input>
			</div>

				<div class="row">

					<div class="col-11" style="background-color: #f9f9f9 !important; margin-left: 15px;">

						<div class="div_br"> </div>

						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
						<i class="fas fa-signature"></i> Assinar
						</button>

					</div>

				</div>

			
		</div>

		

		<div class="div_br"> </div>
				Assinatura atual:
				<div class="div_br"> </div>
				<img style="width: 200px; height: 80px;" src="visualizar_assinatura_prestador.php?cd_prestador=<?php echo $var_cd_prestador; ?>">	
				<?php 

					echo "<br>";  
					$partes = explode(' ', $var_nm_prestador);
					$primeiroNome = array_shift($partes);
					$ultimoNome = array_pop($partes);

					echo "<h99>                        
					". $primeiroNome . " " . $ultimoNome ."
					<br>".@$var_nm_funcao."
					<br>COREN-SP ".@$var_coren."
					</h99>";
				?>

		<!--MODAL ASSINATURA-->
		<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Assinatura</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" style="margin: 0 auto;">
				<canvas id="sig-canvas" width="620" height="160" style="border: solid 1px black; 
						margin-top: 20px;
						width: 600px; height: 150px;">
				</canvas>
				<input type="hidden" name="escondidinho" id="escondidinho"></input>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="sig-clearBtn" onClick="redraw()"><i class="fas fa-eraser"></i> Limpar</button>
				<button type="button" type="submit" class="btn btn-primary" id="sig-submitBtn"><i class="fas fa-paper-plane"></i> Enviar</button>
			</div>
			</div>
		</div>
		</div>

		</form>
		<?php }?>

		<?php

		//RODAPE
		include 'rodape.php';

		unset($_SESSION["prestconsulta"]);

		?>
		
	</div>
	<!-- Scripts -->
	<script src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<!--<script src="https://code.angularjs.org/snapshot/angular.min.js"></script>-->
	<script>
	var form = document.getElementById("assinatura");

    document.getElementById("sig-submitBtn").addEventListener("click", function () {

    var canvas = document.getElementById("sig-canvas");

    document.getElementById('escondidinho').value = canvas.toDataURL('image/png');
    document.forms["assinatura"].submit();

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
	</script>
</body>
</html>
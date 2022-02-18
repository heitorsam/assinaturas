<?php 
	
    //CABECALHO
    include 'cabecalho.php';

    //CONEXAO
    include 'conexao.php';

	if(isset($_SESSION['atdconsulta'])){

		@$var_cd_atendimento = $_SESSION['atdconsulta'];

		$_SESSION['atdpdf'] = $_SESSION['atdconsulta'];

	} else {

		//RECEBENDO POST
		if(isset($_POST['cd_atendimento'])){

			@$var_cd_atendimento = $_POST['cd_atendimento'];

			$_SESSION['atdpdf'] = $_POST['cd_atendimento'];				

		} else {
			
			@$var_cd_atendimento = 0;   
		}

	}


	//VALIDANDO SE A GUIA TISS FOI GERADA NO SISTEMA

	if(isset($_POST['cd_atendimento'])){
		//CONSULTA ID
		$cons_id = "SELECT LPAD(ID,15,0) as ID
					FROM dbamv.tiss_itguia
					WHERE ID_PAI in( SELECT ID
									FROM dbamv.TISS_GUIA tg
									WHERE tg.CD_ATENDIMENTO = $var_cd_atendimento)";

		$result_cons_id = oci_parse($conn_ora, $cons_id);
		@oci_execute($result_cons_id);
		@$id_guia = oci_fetch_array($result_cons_id);

		@$id_guia_00 = $id_guia['ID'];

		if(!isset($id_guia_00)){

			$_SESSION['msgerro'] = "Guia TISS não foi gerada no sistema!"; 
			header('Location: gerar_documento.php');
			return 0;

		}

	}

			////////////
			//PACIENTE//
			///////////
			 $cons_atend="SELECT ate.CD_ATENDIMENTO, pac.NM_PACIENTE, TO_CHAR(ate.DT_ATENDIMENTO, 'DD/MM/YYYY') AS DT_ATENDIMENTO, con.NM_CONVENIO
						FROM ATENDIME ate
						INNER JOIN paciente  pac ON pac.cd_paciente = ate.cd_paciente
						INNER JOIN CONVENIO  con ON con.cd_convenio = ate.cd_convenio
						WHERE ate.cd_atendimento = '$var_cd_atendimento'";

			$result_atendimento = oci_parse($conn_ora, $cons_atend);
			@oci_execute($result_atendimento);
			$row_aten = oci_fetch_array($result_atendimento);
			if(!isset( $row_aten['CD_ATENDIMENTO']) && isset($_POST['cd_atendimento'])){
				$_SESSION['msgerro'] = "Número de atendimento não encontrado."; 
			}
			
			@$var_cd_atendimento = $row_aten['CD_ATENDIMENTO'];
			@$var_nm_paciente = $row_aten['NM_PACIENTE'];
			@$var_dt_aten = $row_aten['DT_ATENDIMENTO'];
			@$var_nm_conv = $row_aten['NM_CONVENIO'];

			///////////////////////////
			//Verifica se existe pdf///
			//para aquele atendimento//
			///////////////////////////
			if(isset($_POST['cd_atendimento']) OR isset($_SESSION['atdconsulta'])){
			$cons_pdf ="SELECT *
			FROM ASSINATURAS.DOCUMENTOS_ASSINADOS ass
			WHERE ass.cd_atendimento = $var_cd_atendimento
			";

			$result_pdf_exis = oci_parse($conn_ora, $cons_pdf);
			@oci_execute($result_pdf_exis);
			@$row_pdf_exis = oci_fetch_array($result_pdf_exis);
			@$var_pdf_existe = $row_pdf_exis['BLOB_ANEXO'];
			}

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

		<h11><i class="fas fa-file-signature"></i> Gerar Documento</h11>
		<span class="espaco_pequeno" style="width: 6px;" ></span>
		<h27> <a href="home.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 


		<div class="div_br"> </div>
		<form method="post" autocomplete="off" action="gerar_documento.php">
		<div class="row">
			<div class="col-md-3 ">
				Atendimento:
				<div class="input-group">

				<?php if(isset($_POST['cd_atendimento']) OR isset($_SESSION['atdconsulta'])){ ?>
					<input class="form-control input-group" type="text" value="<?php echo @$var_cd_atendimento;?>" name="cd_atendimento" required>
				<?php } else { ?>
					<input class="form-control input-group" type="text"  name="cd_atendimento" required>
				<?php }?>

					<button type="submit" class=" btn btn-primary" id="btn_pesquisar"> <i class="fa fa-search" aria-hidden="true"></i></button>	
					<input type="hidden" id="valor" type="text" readonly />
				</div> 
			</div>
		</div>
		</form>
		</br>

		<!---RESULTADO DA PESQUISA-->

		<?php if(strlen(@$var_nm_paciente) > 1){ ?>
		<form autocomplete="off" id="assinatura"  method="post" /action="gerar_documento_pdf.php">
		<div class="row">
			<div class="col-md-3" id="div_sn_exame_mv">
					<label>Atendimento:</label>
					<input type="text"  class="form-control" value="<?php echo @$var_cd_atendimento?>" id="atendimento" name="cd_atendimento" readonly></input>
			</div>
			<div class="col-md-3" id="div_sn_exame_mv">
					<label>Paciente:</label>
					<input type="text"  class="form-control" value="<?php echo @$var_nm_paciente?>" id="paciente" name="nm_paciente" readonly></input>
			</div>
			<div class="col-md-3" id="div_sn_exame_mv">
					<label>Data Atendimento:</label>
					<input type="text" value="<?php echo @$var_dt_aten ?>" class="form-control" id="dt_atendimento" name="dt_aten" readonly></input>
			</div>
			<div class="col-md-3" id="div_sn_exame_mv">
					<label>Nome Convenio:</label>
					<input type="text" value="<?php echo @$var_nm_conv;?>" class="form-control" id="nm_convenio" name="nm_conv" readonly></input>
			</div>
		</div>
		<br>
		<?php if(isset($var_pdf_existe)){ 
		}else{?>
		<div class="row">
			<div style="margin-top: 20px; margin-left: 15px;">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="guia_tiss">
					<i class="far fa-eye"></i> Guia TISS
				</button>
			</div>
			<div style="margin-top: 20px; margin-left: 15px;">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="contrato">
					<i class="far fa-eye"></i> Contrato
				</button>
			</div>
		</div>
		<?php } ?>
		<br>
		<div class="row">
			<?php if(isset($var_pdf_existe)){ ?>
				
				<div style="margin-top: 20px; margin-left: 15px; ">
					<a  style="height: 100%; width: 100% " class="btn btn-primary" data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="tiss_pa" data-identificador="guia_tiss_assinado"><i class="fas fa-file-pdf"></i> Guia Tiss</a>
				</div>
				<div style="margin-top: 20px; margin-left: 15px;">
					<a style="height: 100%; width: 100% "  class="btn btn-primary" data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="cont_pa" data-identificador="cont_pa"><i class="fas fa-file-pdf"></i> Contrato</a>
				</div>
			<?php }else{?>

				

				<div class="col-md-2" >

					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
					<i class="fas fa-signature"></i> Assinar
					</button>

				</div>

			

			<?php }	?>
		</div>


		<!--MODAL ASSINATURA-->
			<div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

		unset($_SESSION["atdconsulta"]);

		?>
		
	</div>


	<!-- Scripts -->
	<script src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<!--<script src="https://code.angularjs.org/snapshot/angular.min.js"></script>-->
	
	<script>
		//var form = document.getElementById("assinatura");
		

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
<!--MODAL VISUALIZA-->
	<div class="modal fade " id="visualizaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Documento para Assinatura</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="body_result" style="margin-left: 10px; width: 100%">
				
			</div>
			<div class="modal-footer">
			</div>
			</div>
		</div>
	</div>


<!--MODAL VISUALIZA ASSINADO-->
<div class="modal fade " id="visualizaModalAssinado" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLongTitle">Documento Assinado</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body" id="body_result" style="margin-left: 10px; width: 100%">
		
		</div>
		<div class="modal-footer">
		</div>
		</div>
	</div>
</div>


<script type="text/javascript">

$(document).ready(function(){
    $(document).on('shown.bs.modal','.modal', function (event) {


         // DO EVENTS
        var button = $(event.relatedTarget) // Button that triggered the modal

        var cd_atendimento = button.data('cd_atendimento') // Extract info from data-* attributes
  

        var nm_paciente = button.data('nm_paciente') // Extract info from data-* attributes
  

		var dt_aten = button.data('dt_aten') // Extract info from data-* attributes
      

		var nm_conv = button.data('nm_conv') // Extract info from data-* attributes

		var tp_doc = button.data('tp_doc') // Extract info from data-* attributes
    

		var identificador = button.data('identificador') // Extract info from data-* attributes
        //console.log(identificador);


        //PASSANDO VALOR DO CAMPO PESQUISA E EXECUTANDO AJAX

		if(identificador == 'contrato'){

			$.getJSON('visualizar_documento_contrato.php?search=',{cd_atendimento: cd_atendimento,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv, ajax: 'true'}, function(j){

				if(j){
					//alert("Certo");
					$("#visualizaModal .modal-body").html(j[0]);            
				} 
				else {
					alert("Erro");
				}


			});
			
		}else if(identificador == 'guia_tiss'){

			$.getJSON('visualizar_documento.php?search=',{cd_atendimento: cd_atendimento,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv, ajax: 'true'}, function(j){

				if(j){
					$("#visualizaModal .modal-body").html(j[0]);            
				} 
				else {
					alert("Erro");
				}


			});

		}else if(identificador == 'guia_tiss_assinado'){

			$("#visualizaModalAssinado .modal-body").load('exibi_pdf.php');
       
		}else if(identificador == 'cont_pa'){

			$("#visualizaModalAssinado .modal-body").load('exibi_pdf_contrato.php');
		}


     });



	document.getElementById("sig-submitBtn").addEventListener("click", function () {
		 //alert("Aqui");

		var canvas = document.getElementById("sig-canvas");
	
		var cd_atendimento = document.getElementById("atendimento").value;
		//console.log(cd_atendimento);

		var nm_paciente = document.getElementById("paciente").value;
		//console.log(nm_paciente);

		var dt_aten = document.getElementById("dt_atendimento").value;
		//console.log(dt_aten);

		var nm_conv = document.getElementById("nm_convenio").value;
		//console.log(nm_conv);

		var escondidinho = document.getElementById('escondidinho').value = canvas.toDataURL('image/png');
		//console.log(escondidinho);




		$.ajax({
					//Configurações
					type: 'POST',//Método que está sendo utilizado.
					dataType: 'html',//É o tipo de dado que a página vai retornar.
					url: 'gerar_documento_pdf.php',//Indica a página que está sendo solicitada.
					//função que vai ser executada assim que a requisição for enviada
					data: {cd_atendimento: cd_atendimento,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv,escondidinho:escondidinho},//Dados para consulta
					//função que será executada quando a solicitação for finalizada.
					/*success: function (msg){
						alert("Sucesso");
					},

					error: function (msg){
						alert("Erro");
					}*/
			
				});

		
		$.ajax({
			//Configurações
			type: 'POST',//Método que está sendo utilizado.
			dataType: 'html',//É o tipo de dado que a página vai retornar.
			url: 'gerar_documento_pdf_contrato.php',//Indica a página que está sendo solicitada.
			//função que vai ser executada assim que a requisição for enviada
			data: {cd_atendimento: cd_atendimento,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv,escondidinho:escondidinho},//Dados para consulta
			//função que será executada quando a solicitação for finalizada.
			/*success: function (msg){
						console.log("Sucesso");
					},

			error: function (msg){
				console.log("Erro");
			}*/
		});

		document.location.replace('gerar_documento.php');
		//document.location.reload();

		//$.getJSON('gerar_documento_pdf.php?search=',{cd_atendimento: cd_atendimento,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv,escondidinho:escondidinho, ajax: 'true'}, function(j){



		//});

		//$.getJSON('gerar_documento_pdf_contrato.php?search=',{cd_atendimento: cd_atendimento,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv,escondidinho:escondidinho, ajax: 'true'}, function(j){



		//});

		//document.location.reload(true);
	 

	});

});
        
</script>  
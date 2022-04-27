<?php 
	
    //CABECALHO
    include 'cabecalho.php';

    //CONEXAO
    include 'conexao.php';
	
	if(isset($_GET['cd_atendimento'])){

		@$var_cd_atendimento = $_GET['cd_atendimento'];

		$_SESSION['atdpdf'] = $_GET['cd_atendimento'];	

	} else {

		if(isset($_SESSION['atdconsulta'])){

			@$var_cd_atendimento = $_SESSION['atdconsulta'];
	
			$_SESSION['atdpdf'] = $_SESSION['atdconsulta'];

		} else {
			
			@$var_cd_atendimento = 0;   
		}

	}

	////////////
	//PACIENTE//
	////////////

	$cons_atend="SELECT ate.CD_ATENDIMENTO, pac.NM_PACIENTE, TO_CHAR(ate.DT_ATENDIMENTO, 'DD/MM/YYYY') AS DT_ATENDIMENTO, 
						con.CD_CONVENIO, con.NM_CONVENIO, pac.NR_IDENTIDADE, pac.NR_CPF, TO_CHAR(pac.DT_NASCIMENTO,'DD/MM/YYYY') AS DT_NASCIMENTO, ate.TP_ATENDIMENTO
				FROM ATENDIME ate
				INNER JOIN paciente  pac ON pac.cd_paciente = ate.cd_paciente
				INNER JOIN CONVENIO  con ON con.cd_convenio = ate.cd_convenio
				WHERE ate.cd_atendimento = '$var_cd_atendimento'";

	$result_atendimento = oci_parse($conn_ora, $cons_atend);
	@oci_execute($result_atendimento);
	$row_aten = oci_fetch_array($result_atendimento);
	if(!isset( $row_aten['CD_ATENDIMENTO']) && isset($_GET['cd_atendimento'])){
		$_SESSION['msgerro'] = "Número de atendimento não encontrado."; 
	}
	
	@$var_cd_atendimento = $row_aten['CD_ATENDIMENTO'];
	@$var_nm_paciente = $row_aten['NM_PACIENTE'];
	@$var_dt_aten = $row_aten['DT_ATENDIMENTO'];
	@$var_nm_conv = $row_aten['NM_CONVENIO'];
	@$var_cd_conv = $row_aten['CD_CONVENIO'];
	@$var_nr_identidade = $row_aten['NR_IDENTIDADE'];
	@$var_nr_cpf = $row_aten['NR_CPF'];
	@$var_dt_nascimento = $row_aten['DT_NASCIMENTO'];
	@$var_tp_atendimento = $row_aten['TP_ATENDIMENTO'];

	///////////////////////////
	//Verifica se existe pdf///
	//para aquele atendimento//
	///////////////////////////

	if(isset($_GET['cd_atendimento']) OR isset($_SESSION['atdpdf']) ){
	$cons_pdf ="SELECT *
			FROM ASSINATURAS.DOCUMENTOS_ASSINADOS ass
			WHERE ass.cd_atendimento = $var_cd_atendimento
			";

	$result_pdf_exis = oci_parse($conn_ora, $cons_pdf);
	@oci_execute($result_pdf_exis);
	@$row_pdf_exis = oci_fetch_array($result_pdf_exis);
	@$var_pdf_existe = $row_pdf_exis['BLOB_ANEXO'];
	}
	

	////////////////////////////////////////////////////////
	//Quantidade restante de documentos a serem assinados///
	////////////////////////////////////////////////////////


	if(isset($_GET['cd_atendimento']) OR isset($_SESSION['atdpdf']) ){
		$cons_pdf ="SELECT 
							res.TOTAL - res.ASSINADO AS RESTANTE 
					FROM(
					SELECT COUNT(CD_ATENDIMENTO) AS ASSINADO,
							6 as TOTAL
						FROM ASSINATURAS.DOCUMENTOS_ASSINADOS ass
					WHERE ass.cd_atendimento = $var_cd_atendimento
					) res
				";
	
		$result_pdf_exis = oci_parse($conn_ora, $cons_pdf);
		@oci_execute($result_pdf_exis);
		@$row_pdf_exis = oci_fetch_array($result_pdf_exis);
		@$var_total_pdf = $row_pdf_exis['RESTANTE'];
		}
		

	
		///////////////////////////////////////
	//Verifica se existe pdf carta golpe///
	//para aquele atendimento//////////////
	///////////////////////////////////////

	if(isset($_GET['cd_atendimento']) OR isset($_SESSION['atdpdf']) ){
		$cons_pdf_cart_golpe ="SELECT *
					FROM ASSINATURAS.DOCUMENTOS_ASSINADOS ass
					WHERE ass.cd_atendimento = $var_cd_atendimento
					AND ass.TP_DOCUMENTO LIKE 'cart_golpe'
				";
	
		$result_pdf_exis_cart_golpe = oci_parse($conn_ora, $cons_pdf_cart_golpe);
		@oci_execute($result_pdf_exis_cart_golpe);
		@$row_pdf_exis_cart_golpe = oci_fetch_array($result_pdf_exis_cart_golpe);
		@$pdf_cart_golpe_existe = $row_pdf_exis_cart_golpe['BLOB_ANEXO'];
		}


	//////////////////////////////////////////
	//Verifica se existe pdf termo cirurgia///
	//para aquele atendimento/////////////////
	//////////////////////////////////////////

	if(isset($_GET['cd_atendimento']) OR isset($_SESSION['atdpdf']) ){
		$cons_pdf_term_cirurgia ="SELECT *
					FROM ASSINATURAS.DOCUMENTOS_ASSINADOS ass
					WHERE ass.cd_atendimento = $var_cd_atendimento
					AND ass.TP_DOCUMENTO LIKE 'term_cirurgia'
				";
	
		$result_pdf_exis_term_cirurgia = oci_parse($conn_ora, $cons_pdf_term_cirurgia);
		@oci_execute($result_pdf_exis_term_cirurgia);
		@$row_pdf_exis_term_cirurgia = oci_fetch_array($result_pdf_exis_term_cirurgia);
		@$pdf_cart_term_cirurgia = $row_pdf_exis_term_cirurgia['BLOB_ANEXO'];
		}

	////////////////////////////////////////////////
	//Verifica se existe pdf Guia Tiss Internação///
	//para aquele atendimento///////////////////////
	////////////////////////////////////////////////

	if(isset($_GET['cd_atendimento']) OR isset($_SESSION['atdpdf']) ){
		$cons_pdf_tiss_int ="SELECT *
					FROM ASSINATURAS.DOCUMENTOS_ASSINADOS ass
					WHERE ass.cd_atendimento = $var_cd_atendimento
					AND ass.TP_DOCUMENTO LIKE 'tiss_pa'
				";
	
		$result_pdf_exis_tiss_int = oci_parse($conn_ora, $cons_pdf_tiss_int);
		@oci_execute($result_pdf_exis_tiss_int);
		@$row_pdf_exis_tiss_int = oci_fetch_array($result_pdf_exis_tiss_int);
		@$pdf_cart_tiss_int = $row_pdf_exis_tiss_int['BLOB_ANEXO'];
		}


	////////////////////////////////////////////////
	//Verifica se existe pdf termo parto cesareo////
	//para aquele atendimento///////////////////////
	////////////////////////////////////////////////

	if(isset($_GET['cd_atendimento']) OR isset($_SESSION['atdpdf']) ){
		$cons_pdf_term_part_cesareo ="SELECT *
					FROM ASSINATURAS.DOCUMENTOS_ASSINADOS ass
					WHERE ass.cd_atendimento = $var_cd_atendimento
					AND ass.TP_DOCUMENTO LIKE 'term_part_cesareo'
				";
	
		$result_pdf_exis_term_part_cesareo = oci_parse($conn_ora, $cons_pdf_term_part_cesareo);
		@oci_execute($result_pdf_exis_term_part_cesareo);
		@$row_pdf_exis_term_part_cesareo = oci_fetch_array($result_pdf_exis_term_part_cesareo);
		@$pdf_cart_term_part_cesareo = $row_pdf_exis_term_part_cesareo['BLOB_ANEXO'];
		}

	////////////////////////////////////////////////
	//Verifica se existe pdf termo parto cesareo////
	//para aquele atendimento///////////////////////
	////////////////////////////////////////////////

	if(isset($_GET['cd_atendimento']) OR isset($_SESSION['atdpdf']) ){
		$cons_pdf_contrato_internacao ="SELECT *
					FROM ASSINATURAS.DOCUMENTOS_ASSINADOS ass
					WHERE ass.cd_atendimento = $var_cd_atendimento
					AND ass.TP_DOCUMENTO LIKE 'cont_int'
				";
	
		$result_pdf_exis_contrato_internacao = oci_parse($conn_ora, $cons_pdf_contrato_internacao);
		@oci_execute($result_pdf_exis_contrato_internacao);
		@$row_pdf_exis_contrato_internacao = oci_fetch_array($result_pdf_exis_contrato_internacao);
		@$pdf_cart_contrato_internacao = $row_pdf_exis_contrato_internacao['BLOB_ANEXO'];
		}


	////////////////////////////////////////////////
	//Verifica se existe pdf termo sedação//////////
	//para aquele atendimento///////////////////////
	////////////////////////////////////////////////

	if(isset($_GET['cd_atendimento']) OR isset($_SESSION['atdpdf']) ){
		$cons_pdf_termo_sedacao ="SELECT *
					FROM ASSINATURAS.DOCUMENTOS_ASSINADOS ass
					WHERE ass.cd_atendimento = $var_cd_atendimento
					AND ass.TP_DOCUMENTO LIKE 'term_sedacao'
				";
	
		$result_pdf_exis_termo_sedacao = oci_parse($conn_ora, $cons_pdf_termo_sedacao);
		@oci_execute($result_pdf_exis_termo_sedacao);
		@$row_pdf_exis_termo_sedacao = oci_fetch_array($result_pdf_exis_termo_sedacao);
		@$pdf_termo_sedacao = $row_pdf_exis_termo_sedacao['BLOB_ANEXO'];
		}


	////////////////////////////////////////////////
	//Verifica se existe pdf termo laqueadura///////
	//para aquele atendimento///////////////////////
	////////////////////////////////////////////////

	if(isset($_GET['cd_atendimento']) OR isset($_SESSION['atdpdf']) ){
		$cons_pdf_termo_laqueadura ="SELECT *
					FROM ASSINATURAS.DOCUMENTOS_ASSINADOS ass
					WHERE ass.cd_atendimento = $var_cd_atendimento
					AND ass.TP_DOCUMENTO LIKE 'term_laqueadura'
				";
	
		$result_pdf_exis_termo_laqueadura = oci_parse($conn_ora, $cons_pdf_termo_laqueadura);
		@oci_execute($result_pdf_exis_termo_laqueadura);
		@$row_pdf_exis_termo_laqueadura = oci_fetch_array($result_pdf_exis_termo_laqueadura);
		@$pdf_termo_laqueadura = $row_pdf_exis_termo_laqueadura['BLOB_ANEXO'];
		}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//VALIDANDO SE A GUIA TISS FOI GERADA NO SISTEMA NA REGRA DO CONVENIO
	if(isset($_GET['cd_atendimento'])){
		//CONSULTA ID
		$cons_id = "SELECT ID
					FROM dbamv.TISS_GUIA tg
					WHERE tg.CD_ATENDIMENTO = $var_cd_atendimento";

		$result_cons_id = oci_parse($conn_ora, $cons_id);
		@oci_execute($result_cons_id);
		@$id_guia = oci_fetch_array($result_cons_id);

		@$id_guia_00 = $id_guia['ID'];

		//SE A GUIA EXISTE
		if(!isset($id_guia_00)){

			//E FOR CONVENIO
			if($var_cd_conv <> 1 && $var_cd_conv <> 2 && $var_cd_conv <> 40 && $var_cd_conv <> 105 && $var_tp_atendimento <> 'A'){
			
				$_SESSION['msgerro'] = "Guia TISS não foi gerada no sistema!"; 
				header('Location: gerar_documento.php');
				return 0;
			}

			//E FOR CONVENIO
			if($var_cd_conv <> 1 && $var_cd_conv <> 2 && $var_cd_conv <> 40 && $var_cd_conv <> 105 && $var_tp_atendimento == 'A'){
			
				$_SESSION['msgerro'] = "Guia Consulta não foi gerada no sistema!"; 
				header('Location: gerar_documento.php');
				return 0;
			}

		}

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
		<form method="get" autocomplete="off" action="gerar_documento.php">
			<div class="row">
				<div class="col-md-3 ">
					Atendimento:
					<div class="input-group">

					<?php if(isset($_GET['cd_atendimento']) OR isset($_SESSION['atdconsulta'])){ ?>
						<input class="form-control input-group" type="text" value="<?php echo @$var_cd_atendimento;?>" name="cd_atendimento" required>
						<input class="form-control input-group" type="hidden" value="<?php echo 'A';?>" id="tp_atendimento" required>
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

		<?php 
			if(strlen(@$var_nm_paciente) > 1 AND $_SESSION['sn_usuario_comum'] == 'S'){ 
		?>

		<div class="row">

			<div style="margin-left: 15px;">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalanexomv">
					<i class="fas fa-camera"></i> Anexar arquivo
				</button>
			</div>

			<?php 		
				//MODAL ANEXO MV
				include 'modal_anexo_mv.php';	
			?>
			
		</div></br>

		<?php 
			}
		?>

				<!---RESULTADO DA PESQUISA-->
				<?php if(strlen(@$var_nm_paciente) > 1 ){ ?>
		<form autocomplete="off" id="assinatura"  method="get//" action="gerar_documento_pdf.php">
			<div class="row">		

				<div class="col-md-3" id="div_sn_exame_mv">
						<label>Paciente:</label>
						<input type="text"  class="form-control" value="<?php echo @$var_nm_paciente?>" id="paciente" name="nm_paciente" readonly></input>
				</div>

				<div class="col-md-2" id="div_sn_exame_mv">
						<label>Nascimento:</label>
						<input type="text" value="<?php echo @$var_dt_nascimento ?>" class="form-control" id="" name="" readonly></input>
				</div>

				<div class="col-md-2" id="div_sn_exame_mv">
						<label>CPF:</label>
						<input type="text" value="<?php echo @$var_nr_cpf;?>" class="form-control" id="" name="" readonly></input>
				</div>

				<div class="col-md-2" id="div_sn_exame_mv">
						<label>RG:</label>
						<input type="text" value="<?php echo @$var_nr_identidade;?>" class="form-control" id="" name="" readonly></input>
				</div>

				<div class="col-md-3" id="div_sn_exame_mv">
						<label>Convenio:</label>
						<input type="text" value="<?php echo @$var_nm_conv;?>" class="form-control" id="nm_convenio" name="nm_conv" readonly></input>
				</div>

				<div class="col-md-0" id="div_sn_exame_mv">
						<!--<label>Data Atendimento:</label>-->
						<input type="hidden" value="<?php echo @$var_dt_aten ?>" class="form-control" id="dt_atendimento" name="dt_aten" readonly></input>
				</div>

				<div class="col-md-0" id="div_sn_exame_mv">
						<!--<label>Atendimento:</label>-->
						<input type="hidden"  class="form-control" value="<?php echo @$var_cd_atendimento?>" id="atendimento" name="cd_atendimento" readonly></input>
				</div>

				<div class="col-md-2" id="div_sn_exame_mv">
						<!--<label>Tipo Atendimeno:</label>-->
						<input type="hidden"  class="form-control" value="<?php echo @$var_tp_atendimento?>" id="tipoatendimento" name="tipoatendimento" readonly></input>
				</div>

				<div class="col-md-0" id="div_sn_exame_mv">
						<input type="hidden" value="<?php echo @$var_cd_conv;?>" class="form-control" id="cd_convenio" name="cd_conv" ></input>
				</div>
				<br>
			</div>

<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
	
		<?php
			// INCLUDE BOTOES VISUALIZAR / PESQUISA
			include 'include_internacao_botoes.php';
		?>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
		
			<?php if(isset($var_pdf_existe)){ ?>

				<!-- CHAMA A TABELA BAIXAR PDF -->

				<?php //echo $_SESSION['sn_faturamento']; ?>

				<?php if(@$_SESSION['sn_faturamento'] == 'S'){ ?>

					<?php include 'tabela_baixar_pdf.php'; ?>

				<?php } ?>
				
			<?php } ?>

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

<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
		<?php
			//INCLUDE INTERNAÇÃO CHECKBOXS
			include 'include_internacao_checkbox.php';
		?>
		
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->

		<br>
		<br>
		
		<?php
			//RODAPE
			include 'rodape.php';
			unset($_SESSION["atdconsulta"]);
		?>
		
	</div>

	<!-- ESTOU NO "gerar_documento.php" -->
	<!-- Scripts 
		<script src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
		<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	-->
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

<!--TAMANHO DA MODAL / SCROLL -->
<style>
	.modal-body {
    
    height: 100%;
}
</style>

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

	/*TODA VEZ QUE ABRIR O MODAL EXECUTAR ESSA FUNCAO*/

    $(document).on('shown.bs.modal','.modal', function (event) {

        // DO EVENTS
        var button = $(event.relatedTarget) //Button that triggered the modal
        var cd_atendimento = button.data('cd_atendimento')   
        var nm_paciente = button.data('nm_paciente')   
		var dt_aten = button.data('dt_aten')       
		var nm_conv = button.data('nm_conv') 
		var tp_doc = button.data('tp_doc')     
		var identificador = button.data('identificador') 
        //console.log(identificador);


        //PASSANDO VALOR DO CAMPO PESQUISA E EXECUTANDO AJAX

		//NÃO ASSINADOS

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

		}else if(identificador == 'guia_consulta'){

			$.getJSON('visualizar_guia_consulta.php?search=',{cd_atendimento: cd_atendimento,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv, ajax: 'true'}, function(j){

				if(j){
					$("#visualizaModal .modal-body").html(j[0]);            
				} 
				else {
					alert("Erro");
				}


			});

		}else if(identificador == 'hos_faa'){

			//BUSCANDO INFORMACOES VIA JSON E ADICIONANDO A VARIAVEL J

			$.getJSON('visualizar_faa.php?search=',{cd_atendimento: cd_atendimento,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv, ajax: 'true'}, function(j){

				//SE A VARIAVEL J FOR ADICIONADA COM SUCESSO, CONSTROI O HTML NA MA
				if(j){
					$("#visualizaModal .modal-body").html(j[0]);            
				} 
				else {
					alert("Erro");
				}


			});


				}else if(identificador == 'cont_int'){

		//BUSCANDO INFORMACOES VIA JSON E ADICIONANDO A VARIAVEL J

		$.getJSON('visualizar_Internação_contrato.php?search=',{cd_atendimento: cd_atendimento,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv, ajax: 'true'}, function(j){

			//SE A VARIAVEL J FOR ADICIONADA COM SUCESSO, CONSTROI O HTML NA MA
			if(j){
				$("#visualizaModal .modal-body").html(j[0]);            
			} 
			else {
				alert("Erro");
			}

		});


		}else if(identificador == 'carta_golpe'){

		//BUSCANDO INFORMACOES VIA JSON E ADICIONANDO A VARIAVEL J

		$.getJSON('visualizar_Internação golpe.php?search=',{cd_atendimento: cd_atendimento,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv, ajax: 'true'}, function(j){

			//SE A VARIAVEL J FOR ADICIONADA COM SUCESSO, CONSTROI O HTML NA MA
			if(j){
				$("#visualizaModal .modal-body").html(j[0]);            
			} 
			else {
				alert("Erro");
			}

		});

		}else if(identificador == 'term_cirurgia'){

		//BUSCANDO INFORMACOES VIA JSON E ADICIONANDO A VARIAVEL J

		$.getJSON('visualizar_Internação_termo_cirurgia.php?search=',{cd_atendimento: cd_atendimento,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv, ajax: 'true'}, function(j){

			//SE A VARIAVEL J FOR ADICIONADA COM SUCESSO, CONSTROI O HTML NA MA
			if(j){
				$("#visualizaModal .modal-body").html(j[0]);            
			} 
			else {
				alert("Erro");
			}
			
		});

		}else if(identificador == 'term_part_cesareo'){

		//BUSCANDO INFORMACOES VIA JSON E ADICIONANDO A VARIAVEL J

		$.getJSON('visualizar_Internação_termo_parto_cesareo.php?search=',{cd_atendimento: cd_atendimento,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv, ajax: 'true'}, function(j){

			//SE A VARIAVEL J FOR ADICIONADA COM SUCESSO, CONSTROI O HTML NA MA
			if(j){
				$("#visualizaModal .modal-body").html(j[0]);            
			} 
			else {
				alert("Erro");
			}
			
		});

		}else if(identificador == 'term_sedacao'){

		//BUSCANDO INFORMACOES VIA JSON E ADICIONANDO A VARIAVEL J

		$.getJSON('visualizar_Internação_sedação.php?search=',{cd_atendimento: cd_atendimento,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv, ajax: 'true'}, function(j){

			//SE A VARIAVEL J FOR ADICIONADA COM SUCESSO, CONSTROI O HTML NA MA
			if(j){
				$("#visualizaModal .modal-body").html(j[0]);            
			} 
			else {
				alert("Erro");
			}
			
		});

		}else if(identificador == 'term_laqueadura'){

		//BUSCANDO INFORMACOES VIA JSON E ADICIONANDO A VARIAVEL J

		$.getJSON('visualizar_Internação_laqueadura.php?search=',{cd_atendimento: cd_atendimento,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv, ajax: 'true'}, function(j){

			//SE A VARIAVEL J FOR ADICIONADA COM SUCESSO, CONSTROI O HTML NA MA
			if(j){
				$("#visualizaModal .modal-body").html(j[0]);            
			} 
			else {
				alert("Erro");
			}
			
		});

		

		//ASSINADOS

		}else if(identificador == 'guia_tiss_assinado'){

			$("#visualizaModalAssinado .modal-body").load('exibi_pdf.php');
       
		}else if(identificador == 'guia_consulta_assinado'){

			$("#visualizaModalAssinado .modal-body").load('exibi_pdf_guia_consulta.php');

		}else if(identificador == 'cont_pa_assinado'){

			$("#visualizaModalAssinado .modal-body").load('exibi_pdf_contrato.php');
		}
		else if(identificador == 'hos_faa_assinado'){
			$("#visualizaModalAssinado .modal-body").load('exibi_pdf_faa.php');
		}

		else if(identificador == 'contrato_internacao_assinada'){
			$("#visualizaModalAssinado .modal-body").load('exibi_pdf_Internação_contrato.php');
		}
	
		else if(identificador == 'carta_golpe_assinada'){
			$("#visualizaModalAssinado .modal-body").load('exibi_pdf_Internação_carta_golpe.php');
		}

		else if(identificador == 'termo_cirurgia_assinada'){
			$("#visualizaModalAssinado .modal-body").load('exibi_pdf_Internação_termo_cirurgia.php');
		}

		else if(identificador == 'termo_parto_cesareo_assinada'){
			$("#visualizaModalAssinado .modal-body").load('exibi_pdf_Internação_termo_parto_cesareo.php');
		}

		else if(identificador == 'term_sedacao_assinado'){
			$("#visualizaModalAssinado .modal-body").load('exibi_pdf_Internação_sedação.php');
		}
		
		else if(identificador == 'term_laqueadura_assinado'){
			$("#visualizaModalAssinado .modal-body").load('exibi_pdf_Internação_laqueadura.php');
		}



     });

	//AÇÃO APOS ASSINAR

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

		//CONVENIO 
		var cd_conv = document.getElementById("cd_convenio").value;

		
		//TIPO ATENDIMENTO 
		var tb_atd = document.getElementById("tipoatendimento").value;
		
	
		//APENAS GERA A GUIA TISS SE FOR CONVENIO
		if(cd_conv != 1 && cd_conv != 2 && cd_conv != 40 && cd_conv != 105 && tb_atd != "A" && tb_atd != "I"){
			
			//SALVANDO NO BANCO GUIA TISS 
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

		}

		
		//APENAS GERA A GUIA CONSULTA SE FOR CONVENIO
		if(cd_conv != 1 && cd_conv != 2 && cd_conv != 40 && cd_conv != 105 && tb_atd == "A" && tb_atd != "I"){
			
			//SALVANDO NO BANCO GUIA CONSLUTA 
			$.ajax({
				//Configurações
				type: 'POST',//Método que está sendo utilizado.
				dataType: 'html',//É o tipo de dado que a página vai retornar.
				url: 'gerar_documento_pdf_guia_consulta.php',//Indica a página que está sendo solicitada.
				//função que vai ser executada assim que a requisição for enviada
				data: {cd_atendimento: cd_atendimento,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv,escondidinho:escondidinho},//Dados para consulta
				//função que será executada quando a solicitação for finalizada.
				/*
				success: function (msg){
					alert("Sucesso");
				},

				error: function (msg){
					alert("Erro");
				}*/				
			});		
		} 

		//GERA CONTRATO EXCETO SUS
		if(cd_conv != 1 && cd_conv != 2 && cd_conv != 105 && tb_atd != "I"){
		
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

		}

		//GERA FAA APENAS SUS
		if(cd_conv == 1 || cd_conv == 2 || cd_conv == 105){

			$.ajax({
				//Configurações
				type: 'POST',//Método que está sendo utilizado.
				dataType: 'html',//É o tipo de dado que a página vai retornar.
				url: 'gerar_documento_pdf_faa.php',//Indica a página que está sendo solicitada.
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

		}
		
		
		//GERA DOCUMENTOS PARA INTERNAÇÃO
		if(tb_atd == "I"){

			//GERA CONTRATO INERNAÇÃO
			if (chkDoc1.checked) {
					
					$.ajax({
						//Configurações
						type: 'POST',//Método que está sendo utilizado.
						dataType: 'html',//É o tipo de dado que a página vai retornar.
						url: 'gerar_documento_Internação_contrato.php',//Indica a página que está sendo solicitada.
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
				} else {}

			//GERA CARTA GOLPE
			if (chkDoc2.checked) {
					
				$.ajax({
					//Configurações
					type: 'POST',//Método que está sendo utilizado.
					dataType: 'html',//É o tipo de dado que a página vai retornar.
					url: 'gerar_documento_Internação_carta_golpe.php',//Indica a página que está sendo solicitada.
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
			} else {}

			//GERA TERMO CIRURGIA
			if (chkDoc3.checked) {
					$.ajax({
						//Configurações
						type: 'POST',//Método que está sendo utilizado.
						dataType: 'html',//É o tipo de dado que a página vai retornar.
						url: 'gerar_documento_Internação_termo_cirurgia.php',//Indica a página que está sendo solicitada.
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
			} else {}


			//GERA TERMO PARTO CIRURGIA
			if (chkDoc4.checked) {
					$.ajax({
						//Configurações
						type: 'POST',//Método que está sendo utilizado.
						dataType: 'html',//É o tipo de dado que a página vai retornar.
						url: 'gerar_documento_Internação_termo_parto_cesareo.php',//Indica a página que está sendo solicitada.
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
			} else {}

			//GERA TERMO SEDAÇÃO
			if (chkDoc5.checked) {
					$.ajax({
						//Configurações
						type: 'POST',//Método que está sendo utilizado.
						dataType: 'html',//É o tipo de dado que a página vai retornar.
						url: 'gerar_documento_Internação_sedação.php',//Indica a página que está sendo solicitada.
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
			} else {}

			//GERA TERMO LAQUEADURA
			if (chkDoc6.checked) {
					$.ajax({
						//Configurações
						type: 'POST',//Método que está sendo utilizado.
						dataType: 'html',//É o tipo de dado que a página vai retornar.
						url: 'gerar_documento_Internação_laqueadura.php',//Indica a página que está sendo solicitada.
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
			} else {}
		
		}	

		//document.location.assign('gerar_documento.php');
		//document.location.reload(true);

		//$.getJSON('gerar_documento_pdf.php?search=',{cd_atendimento: cd_atendimento,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv,escondidinho:escondidinho, ajax: 'true'}, function(j){

		//});

		//$.getJSON('gerar_documento_pdf_contrato.php?search=',{cd_atendimento: cd_atendimento,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv,escondidinho:escondidinho, ajax: 'true'}, function(j){

		//});
	
		window.setTimeout(function(){location.reload()},1000)
		
	});

});

			//SCRIPT INTERNAÇÃO 
		
				//IDENTIFICA AS CHECKBOXS
				var chkDoc1 = document.getElementById("chkDoc1");
				var chkDoc2 = document.getElementById("chkDoc2");
				var chkDoc3 = document.getElementById("chkDoc3");
				var chkDoc4 = document.getElementById("chkDoc4");
				var chkDoc5 = document.getElementById("chkDoc5");
				var chkDoc6 = document.getElementById("chkDoc6");

				//IDENTIFICA OS LABELS
				var lbDoc1 = document.getElementById("lbDoc1");
				var lbDoc2 = document.getElementById("lbDoc2");
				var lbDoc3 = document.getElementById("lbDoc3");
				var lbDoc4 = document.getElementById("lbDoc4");
				var lbDoc5 = document.getElementById("lbDoc5");
				var lbDoc6 = document.getElementById("lbDoc6");
				var lbAssinarNovamente = document.getElementById("lbAssinarNovamente");
				var lbReAssinar = document.getElementById("lbReAssinar");
				var lbDocsRestantes = document.getElementById("lbDocsRestantes");
				
				//IDENTIFICA O BOTOES
				var btnChkDoc = document.getElementById("btnChkDoc");
				var btnReAssinar = document.getElementById("btnReAssinar");
				
				
				////////////////////////////////////////////////////
				var re_escdoc1 = document.getElementById("re_escdoc1");
				var re_escdoc2 = document.getElementById("re_escdoc2");
				var re_escdoc3 = document.getElementById("re_escdoc3");
				var re_escdoc4 = document.getElementById("re_escdoc4");
				var re_escdoc5 = document.getElementById("re_escdoc5");
				var re_escdoc6 = document.getElementById("re_escdoc6");


				
			//FUNCAO AO SELECIONAR AS CHECKBOX
			function funcao_re_gerar(){
				//alert('oi');
				if (chkDoc1.checked == false && chkDoc2.checked == false && chkDoc3.checked == false && chkDoc4.checked == false && chkDoc5.checked == false && chkDoc6.checked == false){
					alert('Por favor selecione um documento');
					location.reload();
				
				} else {
					//IMPEDIR DA PAGINA DE RECARREGAR -- IMPORTANTE 
					event.preventDefault()
					//btnReAssinar.style.display = 'inline';
					
					//Ocultar checkbox
					chkDoc1.style.display = 'none';
					chkDoc2.style.display = 'none';
					chkDoc3.style.display = 'none';
					chkDoc4.style.display = 'none';
					chkDoc5.style.display = 'none';
					chkDoc6.style.display = 'none';

					//Ocultar label
					lbDoc1.style.display = 'none';
					lbDoc2.style.display = 'none';
					lbDoc3.style.display = 'none';
					lbDoc4.style.display = 'none';
					lbDoc5.style.display = 'none';
					lbDoc6.style.display = 'none';
					lbAssinarNovamente.style.display = 'none';
					lbDocsRestantes.style.display = 'none';

					//Ocultar Botoes
					btnChkDoc.style.display = 'none';
					

					//erro .checked
					if (chkDoc1.checked) {
						re_escdoc1.style.display = 'inline';
					} else {
						re_escdoc1.style.display = 'none';
					}

					if (chkDoc2.checked) {
						re_escdoc2.style.display = 'inline';
					} else {
						re_escdoc2.style.display = 'none';
					}

					if (chkDoc3.checked) {
						re_escdoc3.style.display = 'inline';
					} else {
						re_escdoc3.style.display = 'none';
					}


					if (chkDoc4.checked) {
						re_escdoc4.style.display = 'inline';
					} else {
						re_escdoc4.style.display = 'none';
					}

					if (chkDoc5.checked) {
						re_escdoc5.style.display = 'inline';
					} else {
						re_escdoc5.style.display = 'none';
					}

					if (chkDoc6.checked) {
						re_escdoc6.style.display = 'inline';
					} else {
						re_escdoc6.style.display = 'none';
					}

					if (chkDoc1.checked || chkDoc2.checked || chkDoc3.checked || chkDoc4.checked || chkDoc5.checked || chkDoc6.checked){
						btnReAssinar.style.display = 'inline';
						lbReAssinar.style.display = 'inline';
					} else {
						btnReAssinar.style.display = 'none';
					}
				}
				
			}

			//FUNCAO AO SELECIONAR AS CHECKBOX
			function funcao_ocultar(){
				
				if (chkDoc1.checked == false && chkDoc2.checked == false && chkDoc3.checked == false && chkDoc4.checked == false && chkDoc5.checked == false && chkDoc6.checked == false){
					alert('Por favor selecione um documento');
					location.reload();
				
				} else {

					//IMPEDIR DA PAGINA DE RECARREGAR -- IMPORTANTE 
					event.preventDefault()

					btnAssinar.style.display = 'inline';

					//Ocultar checkbox
					chkDoc1.style.display = 'none';
					chkDoc2.style.display = 'none';
					chkDoc3.style.display = 'none';
					chkDoc4.style.display = 'none';
					chkDoc5.style.display = 'none';
					chkDoc6.style.display = 'none';


					//Ocultar label
					lbDoc1.style.display = 'none';
					lbDoc2.style.display = 'none';
					lbDoc3.style.display = 'none';
					lbDoc4.style.display = 'none';
					lbDoc5.style.display = 'none';
					lbDoc6.style.display = 'none';

					lbAssinarNovamente.style.display = 'none';
					
					//Ocultar Botoes
					btnChkDoc.style.display = 'none';

					//Mostrar Botoes
					if (chkDoc1.checked) {
						escdoc1.style.display = 'inline';
					} else {
						escdoc1.style.display = 'none';
					}

					if (chkDoc2.checked) {
						escdoc2.style.display = 'inline';
					} else {
						escdoc2.style.display = 'none';
					}

					if (chkDoc3.checked) {
						escdoc3.style.display = 'inline';
					} else {
						escdoc3.style.display = 'none';
					}

					if (chkDoc4.checked) {
						escdoc4.style.display = 'inline';
					} else {
						escdoc4.style.display = 'none';
					}

					if (chkDoc5.checked) {
						escdoc5.style.display = 'inline';
					} else {
						escdoc5.style.display = 'none';
					}

					if (chkDoc6.checked) {
						escdoc6.style.display = 'inline';
					} else {
						escdoc6.style.display = 'none';
					}
				}
			}
			
				
			
</script>
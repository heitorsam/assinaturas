<?php 

    //CABECALHO
    include 'cabecalho.php';

    //CONEXAO
    include 'conexao.php';


	if(isset($_GET['cd_paciente'])){

		@$var_cd_paciente = $_GET['cd_paciente'];

		$_SESSION['atdpdf'] = $_GET['cd_paciente'];	
        

	} else {

		if(isset($_SESSION['atdconsulta'])){

			@$var_cd_paciente = $_SESSION['atdconsulta'];
	
			$_SESSION['atdpdf'] = $_SESSION['atdconsulta'];

		} else {
			@$var_cd_paciente = 0;   
		}

	}

    ////////////
	//PACIENTE//
	////////////

	$cons_atend="SELECT pac.CD_PACIENTE,
						pac.NM_PACIENTE,
						MAX(ate.CD_ATENDIMENTO) AS CD_ATENDIMENTO,
						TO_CHAR(ate.DT_ATENDIMENTO, 'DD/MM/YYYY') AS DT_ATENDIMENTO,
						con.CD_CONVENIO,
						con.NM_CONVENIO,
						pac.NR_IDENTIDADE,
						pac.NR_CPF,
						TO_CHAR(pac.DT_NASCIMENTO, 'DD/MM/YYYY') AS DT_NASCIMENTO,
						ate.TP_ATENDIMENTO
					FROM ATENDIME ate
					INNER JOIN paciente pac
					ON pac.cd_paciente = ate.cd_paciente
					INNER JOIN CONVENIO con
					ON con.cd_convenio = ate.cd_convenio
					WHERE ate.cd_paciente = $var_cd_paciente
					GROUP BY pac.CD_PACIENTE,
						pac.NM_PACIENTE,
						TO_CHAR(ate.DT_ATENDIMENTO, 'DD/MM/YYYY'),
						con.CD_CONVENIO,
						con.NM_CONVENIO,
						pac.NR_IDENTIDADE,
						pac.NR_CPF,
						TO_CHAR(pac.DT_NASCIMENTO, 'DD/MM/YYYY'),
						ate.TP_ATENDIMENTO
    ";

    $result_atendimento = oci_parse($conn_ora, $cons_atend);
    @oci_execute($result_atendimento);
    $row_aten = oci_fetch_array($result_atendimento);

    if(!isset( $row_aten['CD_PACIENTE']) && isset($_GET['cd_paciente'])){
    $_SESSION['msgerro'] = "Paciente não encontrado"; 
    }

    @$var_cd_paciente = $row_aten['CD_PACIENTE'];
    @$var_cd_atendimento = $row_aten['CD_ATENDIMENTO'];
    @$var_nm_paciente = $row_aten['NM_PACIENTE'];
    @$var_dt_aten = $row_aten['DT_ATENDIMENTO'];
    @$var_nm_conv = $row_aten['NM_CONVENIO'];
    @$var_cd_conv = $row_aten['CD_CONVENIO'];
    @$var_nr_identidade = $row_aten['NR_IDENTIDADE'];
    @$var_nr_cpf = $row_aten['NR_CPF'];
    @$var_dt_nascimento = $row_aten['DT_NASCIMENTO'];
    @$var_tp_atendimento = $row_aten['TP_ATENDIMENTO'];

    @$_SESSION['cd_atendimento'] = $row_aten['CD_ATENDIMENTO'];

	
	/////////////////////////////////////////////////////////////////
	//VERIFICA SE EXISTE DOCUMENTO ASSINADO PARA AQUELE ATENDIMENTO//
	/////////////////////////////////////////////////////////////////
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

	
	//////////////////////////////////////////////
	//VERIFICA SE EXISTE REQUERIMENTO PREENCHIDO//
	//////////////////////////////////////////////
	if(isset($var_cd_paciente)){
		$cons_valida_requerimento="SELECT
								CASE
									WHEN COUNT(*) >= 1 THEN 'PREENCHIDO'
									ELSE 'NAO_PREENCHIDO'
								END AS VALIDA_DOCUMENTO
								FROM assinaturas.DOCUMENTO_REQUERENTE doc
								WHERE doc.CD_PACIENTE = $var_cd_paciente
		";

		$result_valida_requerimento = oci_parse($conn_ora, $cons_valida_requerimento);
		@oci_execute($result_valida_requerimento);
		$row_valida_requerimento = oci_fetch_array($result_valida_requerimento);

		@$var_valida_requerimento = $row_valida_requerimento['VALIDA_DOCUMENTO'];

		$header = 'location: gerar_documento_same_requisicao.php?frm_cd_paciente='.$var_cd_paciente;

		if($var_valida_requerimento == 'NAO_PREENCHIDO'){
			$_SESSION['msgerro'] = "Documento não preenchido";
			//header($header);  
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

		<h11><i class="fas fa-file-import"></i> Recepção</h11>
		<span class="espaco_pequeno" style="width: 6px;" ></span>
		<h27> <a href="home.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 


		<div class="div_br"> </div>
		<!--FORM - PRONTUARIO-->
		<form method="get" autocomplete="off" action="gerar_documento_same_recepcao.php">
			<div class="row">
				<div class="col-md-3 ">
					Prontuário:
					<div class="input-group">

					<?php if(isset($_GET['cd_paciente']) OR isset($_SESSION['atdconsulta'])){ ?>
						<input class="form-control input-group" type="text" value="<?php echo @$var_cd_paciente;?>" name="cd_paciente" required>
						<input class="form-control input-group" type="hidden" value="<?php echo 'A';?>" id="tp_atendimento" required>
					<?php } else { ?>
						<input class="form-control input-group" type="text"  name="cd_paciente" required>
					<?php }?>

						<button type="submit" class=" btn btn-primary" id="btn_pesquisar"> <i class="fa fa-search" aria-hidden="true"></i></button>	
						<input type="hidden" id="valor" type="text" readonly />
					</div> 
				</div>
				
			</div>
		</form>
		</br>

		<!---RESULTADO DA PESQUISA-->
		<?php if(strlen(@$var_nm_paciente) > 1 && $var_valida_requerimento == 'PREENCHIDO' ){ ?>
			<form autocomplete="off" id="assinatura"  method="get//" action="gerar_documento_pdf.php">
				
				<!---INFORMAÇOES PACIENTE-->
				<div class="row">		

					<div class="col-md-4" id="div_sn_exame_mv">
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
						<!--<label>Convenio:</label>-->
						<input type="hidden" value="<?php echo @$var_nm_conv;?>" class="form-control" id="nm_convenio" name="nm_conv" readonly></input>
					</div>

					<div class="col-md-0" id="div_sn_exame_mv">
						<!--<label>Data Atendimento:</label>-->
						<input type="hidden" value="<?php echo @$var_dt_aten ?>" class="form-control" id="dt_atendimento" name="dt_aten" readonly></input>
					</div>

					<div class="col-md-0" id="div_sn_exame_mv">
						<label>Atendimento:</label>
						<input type="text"  class="form-control" value="<?php echo @$var_cd_atendimento?>" id="atendimento" name="cd_atendimento" readonly></input>
					</div>

					<div class="col-md-0" id="div_sn_exame_mv">
						<!-- <label>paciente:</label>-->
						<input type="hidden"  class="form-control" value="<?php echo @$var_cd_paciente?>" id="cd_paciente" name="cd_paciente" readonly></input>
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
				
				<!--SE NÃO TIVER ASSINADO -->
				<div class="row" style="margin: 0 0 0 0 ; padding: 0 0 0 0 ;" >
					<!-- SE NÃO TIVER ASSINADO -->
					<?php if(!isset($var_pdf_existe)){?>
						<!-- GERA GUIA SAME PARA VISUALIZAÇÃO -->
						<div style="margin-top: 20px; margin-right: 10px;">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visualizaModal" data-cd_paciente="<?php echo $var_cd_paciente ?>"  data-nm_paciente="<?php echo $var_nm_paciente ?>" data-identificador="same">
								<i class="far fa-eye"></i> Guia SAME
							</button><br><br>
						</div>
							
					<?php }else{ ?>
					<?php } ?>
				</div>

				<div class="row" style="margin: 0 0 0 0 ; padding: 0 0 0 0 ;">
					<!-- SE TIVER ASSINADO -->
					<?php if(isset($var_pdf_existe)){ ?>
						
					<?php }else{?>
						
						<?php if(@$_SESSION['sn_usuario_same_recepcao'] == 'S'){ ?>

							<div class="col-md-2" style="margin: 0 0 0 0 ; padding: 0 0 0 0 ;">
								<button type="button" class="btn btn-primary alinhamneto_assinar" data-toggle="modal" data-target="#exampleModalCenter" id="btnAssinar" >
									<i class="fas fa-signature"></i> Assinar
								</button>  
							</div>

						<?php } ?>

					<?php }	?>
				</div>

				<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
				<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
				
				<?php if(isset($var_pdf_existe)){ ?>

					<!-- CHAMA A TABELA BAIXAR PDF -->

					<?php //echo $_SESSION['sn_faturamento']; ?>

					<?php //if(@$_SESSION['sn_faturamento'] == 'S'){ ?>

						<?php 
							$where = "WHERE NM_DOC = 'same_pendente'";
							include 'tabela_baixar_pdf.php'; 
						?>

					<?php //} ?>
					
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
		<br>
		
		<?php
			//RODAPE
			include 'rodape.php';
			unset($_SESSION["atdconsulta"]);
		?>
		
	</div>

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
        var cd_paciente = button.data('cd_paciente') 
        var nm_paciente = button.data('nm_paciente')   
		var dt_aten = button.data('dt_aten')       
		var nm_conv = button.data('nm_conv') 
		var tp_doc = button.data('tp_doc')     
		var identificador = button.data('identificador') 
        //console.log(identificador);


        //PASSANDO VALOR DO CAMPO PESQUISA E EXECUTANDO AJAX

		//NÃO ASSINADOS

		if(identificador == 'same'){

			$.getJSON('visualizar_guia_same.php?search=',{cd_atendimento: cd_atendimento, cd_paciente: cd_paciente,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv, ajax: 'true'}, function(j){

				if(j){
					//alert("Certo");
					$("#visualizaModal .modal-body").html(j[0]);            
				} 
				else {
					alert("Erro");
				}

			});	

		//ASSINADOS

		}else if(identificador == 'guia_same_assinado'){

			$("#visualizaModalAssinado .modal-body").load('exibi_pdf_guia_same.php');
       
		}


     });

	//AÇÃO APOS ASSINAR

	document.getElementById("sig-submitBtn").addEventListener("click", function () {
		 //alert("Aqui");

		var canvas = document.getElementById("sig-canvas");
	
		var cd_atendimento = document.getElementById("atendimento").value;
		console.log(cd_atendimento);

        var cd_paciente = document.getElementById("cd_paciente").value;
		console.log(cd_paciente);

		var nm_paciente = document.getElementById("paciente").value;
		console.log(nm_paciente);

		var dt_aten = document.getElementById("dt_atendimento").value;
		console.log(dt_aten);

		var nm_conv = document.getElementById("nm_convenio").value;
		console.log(nm_conv);

		var escondidinho = document.getElementById('escondidinho').value = canvas.toDataURL('image/png');
		console.log(escondidinho);

		//CONVENIO 
		var cd_conv = document.getElementById("cd_convenio").value;
		console.log(cd_conv);
		
		//TIPO ATENDIMENTO 
		var tb_atd = document.getElementById("tipoatendimento").value;
		console.log(tb_atd);
	
		//ASSINA O DOCUMENTO
		$.ajax({
			//Configurações
			type: 'POST',//Método que está sendo utilizado.
			dataType: 'html',//É o tipo de dado que a página vai retornar.
			url: 'gerar_documento_pdf_guia_same.php',//Indica a página que está sendo solicitada.
			//função que vai ser executada assim que a requisição for enviada
			data: {cd_atendimento: cd_atendimento, cd_paciente: cd_paciente,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv,escondidinho:escondidinho},//Dados para consulta
			//função que será executada quando a solicitação for finalizada.
			
				success: function (msg){
					//alert("Sucesso");
				},

				error: function (msg){
					alert("Erro");
				}
						
		});
	
		//CADASTRA A ASSINATURA 
		$.ajax({
			type: 'POST',
			dataType: 'html',
			url: 'cad_assinaturas_requerente.php',
			data: {cd_paciente: cd_paciente,
				   escondidinho:escondidinho},
			
					success: function (msg){
						//alert(msg);
					},

					error: function (msg){
						//alert("Erro");
				}
						
		});

		window.setTimeout(function(){location.reload()},1000)
		
	});

});

</script>
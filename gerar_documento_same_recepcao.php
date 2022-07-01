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
	$cons_paciente="SELECT pac.CD_PACIENTE,
							pac.NM_PACIENTE,
							pac.NR_IDENTIDADE,
							pac.NR_CPF
					FROM dbamv.PACIENTE pac WHERE pac.CD_PACIENTE = $var_cd_paciente
    ";

    $result_paciente = oci_parse($conn_ora, $cons_paciente);
    @oci_execute($result_paciente);
    $row_paciente = oci_fetch_array($result_paciente);

    if(!isset( $row_paciente['CD_PACIENTE']) && isset($_GET['cd_paciente'])){
    $_SESSION['msgerro'] = "Paciente não encontrado"; 
    }

    @$var_cd_paciente = $row_paciente['CD_PACIENTE'];
    @$var_nm_paciente = $row_paciente['NM_PACIENTE'];
    @$var_nr_identidade = $row_paciente['NR_IDENTIDADE'];
    @$var_nr_cpf = $row_paciente['NR_CPF'];

	@$_SESSION['cd_paciente'] = $row_paciente['CD_PACIENTE'];


?>

<?php
	//VALIDAÇÕES
	include 'assinatura_SAME/Recepção/validacoes.php';
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
		
		<!--ESTRUTURA FORMULARIO-->
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
		<?php if(strlen(@$var_nm_paciente) > 1 && $var_valida_requerimento == 'PREENCHIDO'){ ?>
			
			<div class="row">

				<div style="margin-left: 15px;">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalanexomv" id="jv_Abrir_Modal">
						<i class="fas fa-camera"></i> Anexar foto
					</button>
				</div>

				<?php 		
					//MODAL ANEXO MV
					include 'assinatura_SAME/Recepção/modal/modal_anexo_mv.php';	
				?>

			</div></br>

			<form autocomplete="off" id="assinatura"  method="get//" action="gerar_documento_pdf.php">
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

					<div class="col-md-0" id="div_sn_exame_mv">
						<!-- <label>CD PACIENTE:</label>-->
						<input type="hidden"  class="form-control" value="<?php echo @$var_cd_paciente?>" id="cd_paciente" name="cd_paciente" readonly></input>
					</div>

				</div>

						<div class="div_br"> </div>

				<!--SE NÃO TIVER ASSINADO -->
				<?php if(!isset($var_pdf_existe)){?>

						<div class="div_br"> </div>
						<div class="div_br"> </div>

						<!--RADIO-->
						<div class="row">		

							<div class="col-md-12">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="flexRadio" id="flexRadio_presencial" checked>
									<label class="form-check-label" for="flexRadio_presencial">
										Presencial
									</label>
								</div>

								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="flexRadio" id="flexRadio_distancia" >
									<label class="form-check-label" for="flexRadio_distancia">
										A Distância
									</label>
								</div>
							</div>

						</div>

						<div class="div_br"> </div>

						<div class="row">		
							<button type="button" class="btn btn-primary" id="requerente_presencial" data-toggle="modal" data-target="#visualizaModal" data-cd_paciente="<?php echo $var_cd_paciente ?>"  data-nm_paciente="<?php echo $var_nm_paciente ?>" data-identificador="same">
								<i class="far fa-eye"></i> Guia SAME
							</button>

							<span class="espaco_pequeno"></span>

							<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModalCenter" id="btnAssinar" >
								<i class="fas fa-signature"></i> Assinar
							</button> 
							
							<span class="espaco_pequeno"></span>

							<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#AnexoFotoDocumento" id="requetente_documento" >
								<i class="fa-solid fa-file"></i> Anexo foto Documento 
							</button> 

							<span class="espaco_pequeno"></span>

							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AnexoDocumento" id="requetente_distancia" >
								<i class="fa-solid fa-file-arrow-up"></i> Anexo Documento 
							</button>  
						</div>
				<?php } ?>

				<!-- SE TIVER DOCUMENTO ASSINADO -->
				<?php if(isset($var_pdf_existe)){ ?>
					<!-- CHAMA A TABELA BAIXAR PDF -->
					<?php 
						$where = "WHERE NM_DOC = 'same_pendente'";
						include 'assinatura_SAME/Recepção/tabela.php'; 
					?>
				<?php } ?>

				<!--MODAL ASSINATURA-->
				<?php 
					include 'assinatura_SAME/Recepção/modal/modal_assinatura.php';
				?>

			</form>
		<?php }?>

		<br>

		<?php
			//RODAPE
			include 'rodape.php';
			unset($_SESSION["atdconsulta"]);
		?>
		
	</div>

	<!--CANVAS ASSINATURA-->
	<?php 
		include 'assinatura_SAME/Recepção/funcoes/js_canvas_assinatura.php';
	?>

</body>
</html>

<!--MODALS VISUALIZAÇÃO-->
<?php 
	include 'assinatura_SAME/Recepção/modal/modal_visualizacao.php';
?>

<!--AJAX / JAVASCRIPT - ASSINATURA DOC-->
<?php 
	include 'assinatura_SAME/Recepção/funcoes/js_cadastrar_doc.php';
?>

<!--jS RADIOS-->
<?php 
	include 'assinatura_SAME/Recepção/funcoes/js_radio.php';
?>


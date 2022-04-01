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
	@$var_consulta = $row_aten['TP_ATENDIMENTO'];

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

		<h11><i class="fas fa-camera"></i> Anexos</h11>
		<span class="espaco_pequeno" style="width: 6px;" ></span>
		<h27> <a href="home.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 


		<div class="div_br"> </div>
		<form method="get" autocomplete="off" action="anexos.php">
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
				include 'modal_anexo_anexo.php';
				
			?>
			
		</div>
		</br>

		<?php 

			}

		?>

		<!---RESULTADO DA PESQUISA-->

		<?php if(strlen(@$var_nm_paciente) > 1){ ?>
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
					<input type="hidden"  class="form-control" value="<?php echo @$var_consulta?>" id="tipoatendimento" name="tipoatendimento" readonly></input>
			</div>

			<div class="col-md-0" id="div_sn_exame_mv">
					<input type="hidden" value="<?php echo @$var_cd_conv;?>" class="form-control" id="cd_convenio" name="cd_conv" ></input>
			</div>
		</div>

		<br>

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

</body>
</html>
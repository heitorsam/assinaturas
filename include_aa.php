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
				
			</div>

			<br>
			
			
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
		<!-- URGENCIA / AMBULATORIO -->
		<?php
			if($var_tp_atendimento <> 'I'){
			include 'include_ambulatorio_urgencia.php';
			}	
		?>

		<!-- INTERNAÇÃO -->
		 
		<?php
		//	if($var_tp_atendimento <> 'I'){
		//	include '.php';
		//	}	
		?>

		<!-- EXAMES -->
		<?php
		//	if($var_tp_atendimento <> 'I'){
		//	include '.php';
		//	}	
		?>


			<!-- BOTOES INTERNAÇÃO -->
		<div class="row">
			<div style="margin-top: 20px; margin-left: 5px;">
			
				<button type="button" class="btn btn-primary" id="escdoc1" style="width: 150px; height: 60px; display: none;">
					Guia Internação
				</button>
			</div>

			<div style="margin-top: 20px; margin-left: 5px;">
				<button type="button" class="btn btn-primary" id="escdoc2" style="width: 150px; height: 60px; display: none;">
					Carta Golpe
				</button>
			</div>

			<div style="margin-top: 20px; margin-left: 5px;">
				<button type="button" class="btn btn-primary" id="escdoc3" style="width: 150px; height: 60px; display: none;">
					Termo de Responsabilidade
				</button>
			</div>
		</div>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
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
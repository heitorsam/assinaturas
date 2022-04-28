<!--- TRAZ AS CHECKBOX PARA REASSINATURA  -->
<?php  if(isset($var_pdf_existe)){ ?>
			<?php if(@$var_tp_atendimento == 'I'){?>
			<form onsubmit="funcao_re_gerar()" method="post">
								<style>
									.alinhamneto_Extra_Pequeno{
										border: solid 0px black !important; 
										height: 50px;  
										width: 85px;
										padding: 0px; 
										margin: 0px;
										margin-right: 10px !important; 
									}

									.alinhamneto_Pequeno{
										border: solid 0px black !important; 
										height: 50px;  
										width: 105px;
										padding: 0px; 
										margin: 0px;
										margin-right: 10px !important; 
									}

									.alinhamneto_Medio{
										border: solid 0px black !important; 
										height: 50px;  
										width: 140px;
										padding: 0px; 
										margin: 0px;
										margin-right: 10px !important; 
									}

									.alinhamneto_Grande{
										border: solid 0px black !important; 
										height: 50px;  
										width: 180px;
										padding: 0px; 
										margin: 0px;
										margin-right: 10px !important; 
									}


									

									.alinhamneto_ERRADO{
										display: none;
									}
									
									
								</style>
								<?php if($_SESSION['sn_usuario_comum'] == 'S'){ ?>
								
									<h11 id="lbAssinarNovamente"><i class="far fa-check-square"></i> Assinar Novamente:</h11><p>
										<?php if($var_total_pdf == 0){ ?>
											<label id="lbDocsRestantes">Sem Documentos Restantes</label>
										<?php }else{?>
											<label id="lbDocsRestantes"><?php echo $var_total_pdf ?>: Documentos Restantes</label>
										<?php }?>

									<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
									<!--- GUIA TISS INTERNAÇÃO  -->		
									<?php if(isset($pdf_cart_contrato_internacao)){ ?>
										<!-- NÃO MOSTRAR CHECKBOX -->
										<div class="form-check form-check-inline alinhamneto_ERRADO">
											<input type="checkbox" id="chkDoc1" style="display: none;" >
											<label id="lbDoc1" style="display: none;"> Contrato Internação</label></br>
										</div>

									<?php }else{?>
										<!--MOSTRAR CHECKBOX-->
										<div class="form-check form-check-inline alinhamneto_Extra_Pequeno">
											<input type="checkbox" id="chkDoc1">
											<label id="lbDoc1"> Contrato</label>
										</div>
									<?php } ?>

									<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
									<!--- CARTA GOLPE  -->		
									<?php if(isset($pdf_cart_golpe_existe)){ ?>
										<!-- NÃO MOSTRAR CHECKBOX -->
										<div class="form-check form-check-inline alinhamneto_ERRADO">
											<input type="checkbox" id="chkDoc2" style="display: none;" >
											<label id="lbDoc2" style="display: none;"> Carta Golpe</label>
										</div>
									<?php }else{?>
										<!--MOSTRAR CHECKBOX-->
										<div class="form-check form-check-inline alinhamneto_Pequeno">
											<input type="checkbox" id="chkDoc2"  >
											<label id="lbDoc2"> Carta Golpe</label>
										</div>
									<?php } ?>

									<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////-->								
									<!--- TERMO DE RESPONSABILIDADE CIRURGIA  -->											
									<?php if(isset($pdf_cart_term_cirurgia)){ ?>
										<!-- NÃO MOSTRAR CHECKBOX -->
										<div class="form-check form-check-inline alinhamneto_ERRADO">
											<input type="checkbox" id="chkDoc3" style="display: none;">
											<label id="lbDoc3" style="display: none;"> Termo - Cirurgia</label></br>
										</div>
									<?php }else{?>
										<!--MOSTRAR CHECKBOX-->
										<div class="form-check form-check-inline alinhamneto_Medio ">
											<input type="checkbox" id="chkDoc3">
											<label id="lbDoc3"> Termo - Cirurgia</label>
										</div>
									<?php } ?>

									

									<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
									<!--- TERMO DE RESPONSABILIDADE Sedação  -->
									<?php if(isset($pdf_termo_sedacao)){ ?>
										<!-- NÃO MOSTRAR CHECKBOX -->
										<div class="form-check form-check-inline alinhamneto_ERRADO" >
											<input type="checkbox" id="chkDoc5" style="display: none;">
											<label id="lbDoc5" style="display: none;"> Termo - Sedação</label></br>
										</div>
									<?php }else{?>
										<!--MOSTRAR CHECKBOX-->
										<div class="form-check form-check-inline alinhamneto_Medio">
											<input type="checkbox" id="chkDoc5">
											<label id="lbDoc5"> Termo - Sedação</label>
										</div>
									<?php } ?>

									<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
									<!--- TERMO DE RESPONSABILIDADE Laqueadura  -->
									<?php if(isset($pdf_termo_laqueadura)){ ?>
										<!-- NÃO MOSTRAR CHECKBOX -->
										<div class="form-check form-check-inline alinhamneto_ERRADO" >
											<input type="checkbox" id="chkDoc6" style="display: none;">
											<label id="lbDoc6" style="display: none;"> Termo - Laqueadura</label></br>
										</div>
									<?php }else{?>
										<!--MOSTRAR CHECKBOX-->
										<div class="form-check form-check-inline alinhamneto_Grande">
											<input type="checkbox" id="chkDoc6">
											<label id="lbDoc6"> Termo - Laqueadura</label>
										</div>
									<?php } ?>
									
									<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
									<!--- TERMO DE RESPONSABILIDADE PARTO CESAREO  -->
									<?php if(isset($pdf_cart_term_part_cesareo)){ ?>
										<!-- NÃO MOSTRAR CHECKBOX -->
										<div class="form-check form-check-inline alinhamneto_ERRADO" >
											<input type="checkbox" id="chkDoc4" style="display: none;">
											<label id="lbDoc4" style="display: none;"> Termo - Parto Cesáreo</label>
										</div>
									<?php }else{?>
										<!--MOSTRAR CHECKBOX-->
										<div class="form-check form-check-inline alinhamneto_Grande">
											<input type="checkbox" id="chkDoc4">
											<label id="lbDoc4"> Termo - Parto Cesáreo</label>
										</div>
									<?php } ?><br>

								
									<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

									<?php if($var_total_pdf <> 0){ ?>
										<button type="submit" class="btn btn-primary" id="btnChkDoc"><i class="fas fa-paper-plane"></i> Enviar</button>			
									<?php }?>

								<?php } ?>
						</form>
			<?php }?>


<?php }else{ ?>
<!--- TRAZ AS CHECKBOX QUANDO NÃO HÁ NADA ASSINADO  -->			
			<?php if(@$var_tp_atendimento == 'I'){?>
				<form onsubmit="funcao_ocultar()" method="post">

					<br><br>
					<?php if($_SESSION['sn_usuario_comum'] == 'S'){ ?>
						<h11 id="lbAssinarNovamente"><i class="far fa-check-square"></i> Selecione os Documentos:</h11><p>
						

						<style>
							.alinhamneto_coluna1{
								border: solid 0px black !important; 
								height: 40px;  
								width: 115px;
								padding: 1px; 
								margin: 1px;
							}

							.alinhamneto_coluna2{
								border: solid 0px black !important; 
								height: 40px;  
								width: 150px;
								padding: 1px; 
								margin: 1px;
							}

							.alinhamneto_coluna3{
								border: solid 0px black !important; 
								height: 40px;  
								width: 180px;
								padding: 1px; 
								margin: 1px;
							}

							.alinhamneto_assinar{
								margin-top: 10px; 
								margin-left: 0px;
							}
						</style>

						<div style="border: solid 0px red !important;">
							
								<?php if(isset($pdf_cart_contrato_internacao)){ ?>
									<!-- NÃO MOSTRAR CHECKBOX -->
								<?php }else{?>
									<!--MOSTRAR CHECKBOX-->
									<div class="form-check form-check-inline alinhamneto_coluna1" style="">
										<input type="checkbox" id="chkDoc1" >
										<label id="lbDoc1"> Contrato</label></br>
									</div>
								<?php } ?>

								<?php if(isset($pdf_cart_term_cirurgia)){ ?>
									<!-- NÃO MOSTRAR CHECKBOX -->
								<?php }else{?>
									<!--MOSTRAR CHECKBOX-->
									<div class="form-check form-check-inline alinhamneto_coluna2"style="">
										<input type="checkbox" id="chkDoc3" >
										<label id="lbDoc3"> Termo - Cirurgia</label></br>
									</div>
								<?php } ?>

								<?php if(isset($pdf_cart_term_part_cesareo)){ ?>
										<!-- NÃO MOSTRAR CHECKBOX -->
									<?php }else{?>
										<!--MOSTRAR CHECKBOX-->
										<div class="form-check form-check-inline alinhamneto_coluna3"style="">
											<input type="checkbox" id="chkDoc4" >
											<label id="lbDoc4"> Termo - Parto Cesáreo</label></br>
										</div>
								<?php } ?>

								</br>

								<?php if(isset($pdf_cart_golpe_existe)){ ?>
									<!-- NÃO MOSTRAR CHECKBOX -->
								<?php }else{?>
									<!--MOSTRAR CHECKBOX-->
									<div class="form-check form-check-inline alinhamneto_coluna1" style="">
										<input type="checkbox" id="chkDoc2"  >
										<label id="lbDoc2"> Carta Golpe</label></br>
									</div>
								<?php } ?>


									<?php if(isset($pdf_termo_sedacao)){ ?>
											<!-- NÃO MOSTRAR CHECKBOX -->
									<?php }else{?>
										<!--MOSTRAR CHECKBOX-->
										<div class="form-check form-check-inline alinhamneto_coluna2"style="">
											<input type="checkbox" id="chkDoc5" >
											<label id="lbDoc5"> Termo - Sedação</label></br>
										</div>
								<?php } ?>

									<?php if(isset($pdf_termo_laqueadura)){ ?>
											<!-- NÃO MOSTRAR CHECKBOX -->
									<?php }else{?>
										<!--MOSTRAR CHECKBOX-->
										<div class="form-check form-check-inline alinhamneto_coluna3"style="">
											<input type="checkbox" id="chkDoc6" >
											<label id="lbDoc6"> Termo - Laqueadura</label></br>
										</div>
								<?php } ?>
						</div>
						<button type="submit" class="btn btn-primary alinhamneto_assinar" id="btnChkDoc"> Enviar</button>
					<?php } ?>
				</form>
			<?php } ?>
		</br>	
		<?php } ?>



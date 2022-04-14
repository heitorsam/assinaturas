<!--- TRAZ AS CHECKBOX PARA REASSINATURA  -->
<?php  if(isset($var_pdf_existe)){ ?>
			<?php if(@$var_tp_atendimento == 'I'){?>
			<form onsubmit="funcao_re_gerar()" method="post">
								<br><br>

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
									<div class="form-check form-check-inline">
										<input type="checkbox" id="chkDoc1" style="display: none;" >
										<label id="lbDoc1" style="display: none;"> Contrato Internação</label></br>
									</div>

								<?php }else{?>
									<!--MOSTRAR CHECKBOX-->
									<div class="form-check form-check-inline">
										<input type="checkbox" id="chkDoc1">
										<label id="lbDoc1"> Contrato Internação</label></br>
									</div>
								<?php } ?>

								<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
								<!--- CARTA GOLPE  -->		
								<?php if(isset($pdf_cart_golpe_existe)){ ?>
									<!-- NÃO MOSTRAR CHECKBOX -->
									<div class="form-check form-check-inline">
										<input type="checkbox" id="chkDoc2" style="display: none;" >
										<label id="lbDoc2" style="display: none;"> Carta Golpe</label></br>
									</div>
								<?php }else{?>
									<!--MOSTRAR CHECKBOX-->
									<div class="form-check form-check-inline">
										<input type="checkbox" id="chkDoc2"  >
										<label id="lbDoc2"> Carta Golpe</label></br>
									</div>
								<?php } ?>

								<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////-->								
								<!--- TERMO DE RESPONSABILIDADE CIRURGIA  -->											
								<?php if(isset($pdf_cart_term_cirurgia)){ ?>
									<!-- NÃO MOSTRAR CHECKBOX -->
									<div class="form-check form-check-inline">
										<input type="checkbox" id="chkDoc3" style="display: none;">
										<label id="lbDoc3" style="display: none;"> Termo de Responsabilidade Cirurgia</label></br>
									</div>
								<?php }else{?>
									<!--MOSTRAR CHECKBOX-->
									<div class="form-check form-check-inline">
										<input type="checkbox" id="chkDoc3">
										<label id="lbDoc3"> Termo de Responsabilidade Cirurgia</label></br>
									</div>
								<?php } ?>

								<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
								<!--- TERMO DE RESPONSABILIDADE PARTO CESAREO  -->
								<?php if(isset($pdf_cart_term_part_cesareo)){ ?>
									<!-- NÃO MOSTRAR CHECKBOX -->
									<div class="form-check form-check-inline" >
										<input type="checkbox" id="chkDoc4" style="display: none;">
										<label id="lbDoc4" style="display: none;"> Termo de Responsabilidade Parto Cesáreo</label></br>
									</div>
								<?php }else{?>
									<!--MOSTRAR CHECKBOX-->
									<div class="form-check form-check-inline">
										<input type="checkbox" id="chkDoc4">
										<label id="lbDoc4"> Termo de Responsabilidade Parto Cesáreo</label></br>
									</div>
								<?php } ?>

								<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

								</br>
		
								<!--- EM CONSTRUÇÃO CHECKBOX 
									<div class="form-check form-check">
										<input type="checkbox" id="" >
										<label id=""> Termo de Responsabilidade e Consentimento Internação</label></br>
									</div>


									<div class="form-check form-check">
										<input type="checkbox" id="" >
										<label id=""> Termo de Responsabilidade e Consentimento Laqueadura tubárea</label></br>
									</div>

									<div class="form-check form-check">
										<input type="checkbox" id="" >
										<label id=""> Termo de Responsabilidade e Consentimento Anestésico ou Sedação</label></br>
									</div>

									<div class="form-check form-check">
										<input type="checkbox" id="">
										<label id=""> Termo de Responsabilidade e Consentimento Cirurgia</label></br>
									</div>
									</br>
								-->	

								<?php if($var_total_pdf <> 0){ ?>
									<button type="submit" class="btn btn-primary" id="btnChkDoc">Enviar</button>			
								<?php }?>
						</form>
			<?php }?>




<!--- TRAZ AS CHECKBOX QUANDO NÃO HÁ NADA ASSINADO  -->
<?php }else{ ?>
			
			<?php if(@$var_tp_atendimento == 'I'){?>
						<form onsubmit="funcao_ocultar()" method="post">

								<br><br>
								<h11 id="lbAssinarNovamente"><i class="far fa-check-square"></i> Selecione os Documentos:</h11><p>

								<?php if(isset($pdf_cart_contrato_internacao)){ ?>
									<!-- NÃO MOSTRAR CHECKBOX -->
								<?php }else{?>
									<!--MOSTRAR CHECKBOX-->
									<div class="form-check form-check-inline">
										<input type="checkbox" id="chkDoc1">
										<label id="lbDoc1"> Contrato Internação</label></br>
									</div>
								<?php } ?>

								<?php if(isset($pdf_cart_golpe_existe)){ ?>
									<!-- NÃO MOSTRAR CHECKBOX -->
								<?php }else{?>
									<!--MOSTRAR CHECKBOX-->
									<div class="form-check form-check-inline">
										<input type="checkbox" id="chkDoc2" >
										<label id="lbDoc2"> Carta Golpe</label></br>
									</div>
								<?php } ?>

								<?php if(isset($pdf_cart_term_cirurgia)){ ?>
									<!-- NÃO MOSTRAR CHECKBOX -->
								<?php }else{?>
									<!--MOSTRAR CHECKBOX-->
									<div class="form-check form-check-inline">
										<input type="checkbox" id="chkDoc3">
										<label id="lbDoc3"> Termo de Responsabilidade Cirurgia</label></br>
									</div>
								<?php } ?>

								<?php if(isset($pdf_cart_term_part_cesareo)){ ?>
									<!-- NÃO MOSTRAR CHECKBOX -->
								<?php }else{?>
									<!--MOSTRAR CHECKBOX-->
									<div class="form-check form-check-inline">
										<input type="checkbox" id="chkDoc4">
										<label id="lbDoc4"> Termo de Responsabilidade Parto Cesáreo</label></br>
									</div>
								<?php } ?>

								</br>

								<!--- EM CONSTRUÇÃO CHECKBOX 
									<div class="form-check form-check">
										<input type="checkbox" id="" >
										<label id=""> Termo de Responsabilidade e Consentimento Internação</label></br>
									</div>


									<div class="form-check form-check">
										<input type="checkbox" id="" >
										<label id=""> Termo de Responsabilidade e Consentimento Laqueadura tubárea</label></br>
									</div>

									<div class="form-check form-check">
										<input type="checkbox" id="" >
										<label id=""> Termo de Responsabilidade e Consentimento Anestésico ou Sedação</label></br>
									</div>

									<div class="form-check form-check">
										<input type="checkbox" id="">
										<label id=""> Termo de Responsabilidade e Consentimento Cirurgia</label></br>
									</div>
									</br>
								-->	
								<button type="submit" class="btn btn-primary" id="btnChkDoc"> Enviar</button>
							
						</form>
			<?php } ?></br>	
		<?php } ?>



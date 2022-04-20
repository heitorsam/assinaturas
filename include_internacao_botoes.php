<style>
	.alinhamneto{
		margin-top: 20px; 
		margin-right: 10px;	
	}

	.alinhamneto_assinar{
		margin-top: 20px; 
		margin-right: 0px;
	}
</style>

<!--SE NÃO TIVER ASSINADO -->
<div class="row" style="margin: 0 0 0 0 ; padding: 0 0 0 0 ;" >

				<?php if(!isset($var_pdf_existe)){?>
					<!-- APENAS GERA A GUIA TISS SE FOR CONVENIO -->
					<?php if($var_cd_conv <> 1 && $var_cd_conv <> 2 && $var_cd_conv <> 40  && $var_cd_conv <> 105 && $var_tp_atendimento <> 'A' && $var_tp_atendimento <> 'I'){?>
						
						<div style="margin-top: 20px; margin-right: 10px;">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="guia_tiss">
								<i class="far fa-eye"></i> Guia TISS
							</button>
						</div>
						
					<?php } ?>

					<!-- APENAS GERA A GUIA CONSULTA SE FOR CONVENIO  -->
					<?php if($var_cd_conv <> 1 && $var_cd_conv <> 2 && $var_cd_conv <> 40  && $var_cd_conv <> 105 && $var_tp_atendimento == 'A' && $var_tp_atendimento <> 'I'){?>
						
						<div style="margin-top: 20px; margin-right: 10px;">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="guia_consulta">
								<i class="far fa-eye"></i> Guia Consulta
							</button>
						</div>
						
					<?php } ?>
					
					<!-- GERA CONTRATO EXCETO SUS -->
					<?php if($var_cd_conv <> 1 && $var_cd_conv <> 2 && $var_cd_conv <> 105 && $var_tp_atendimento <> 'I' ){?>
						
						<div style="margin-top: 20px; margin-right: 10px;">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="contrato">
								<i class="far fa-eye"></i> Contrato
							</button>
						</div>
					<?php } ?>
					
					<!-- GERA FAA APENAS SUS -->
					<?php if($var_cd_conv == 1 || $var_cd_conv == 2 || $var_cd_conv == 105 ){?>
						
						<div style="margin-top: 20px; margin-right: 10px;">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="hos_faa">
								<i class="far fa-eye"></i> Ficha Atendimento
							</button>
						</div>
					
					<?php } ?>

					<!-- GERA GUIAS INTERNAÇÃO -->
					<!-- SEM NADA ASSINADO  -->
					<?php if($var_tp_atendimento =='I'){?>
						
						<div style="border: solid 0px black !important;">
							<button type="button" class="btn btn-primary alinhamneto" id="escdoc1" style="display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="cont_int">
							<i class="far fa-eye"></i> Contrato Internação
							</button>
						</div>
	
						<div style="border: solid 0px black !important;">
							<button type="button" class="btn btn-primary alinhamneto" id="escdoc2" style=" display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="carta_golpe">
							<i class="far fa-eye"></i> Carta Golpe
							</button>
						</div>

				

						<div style="border: solid 0px black !important;">
							<button type="button" class="btn btn-primary alinhamneto" id="escdoc3" style=" display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="term_cirurgia">
							<i class="far fa-eye"></i> Termo - Cirurgia
							</button>
						</div>

						<div style="border: solid 0px black !important;">
							<button type="button" class="btn btn-primary alinhamneto" id="escdoc4" style="display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="term_part_cesareo">
							<i class="far fa-eye"></i> Termo - Parto Cesáreo
						</div>

						<div style="border: solid 0px black !important;">
							<button type="button" class="btn btn-primary alinhamneto" id="escdoc5" style="display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="term_sedacao">
							<i class="far fa-eye"></i> Termo - Sedação
						</div>

						<div style="border: solid 0px black !important;">
							<button type="button" class="btn btn-primary alinhamneto" id="escdoc6" style="display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="term_laqueadura">
							<i class="far fa-eye"></i> Termo - Laqueadura
						</div>

					<?php } ?>

				<!-- VISUALIZAR -- GERA A Contrato Internação PARA RE-ASSINATURA -->
				<?php }else{ ?>
					<?php if($var_tp_atendimento =='I'){?>

						<br>
						<br>
						<div class="col-md-12"><h11 id="lbReAssinar" style=" display: none;"><i class="fas fa-redo"></i> Assinar Novamente:</h11></div>

						<div style="">
							<button type="button" class="btn btn-primary alinhamneto" id="re_escdoc1" style="display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="cont_int">
							<i class="far fa-eye"></i> Contrato Internação
							</button>
						</div>

						<div style="">
							<button type="button" class="btn btn-primary alinhamneto" id="re_escdoc2" style=" display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="carta_golpe">
							<i class="far fa-eye"></i> Carta Golpe
							</button>
						</div>

						<div style="">
							<button type="button" class="btn btn-primary alinhamneto" id="re_escdoc3" style=" display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="term_cirurgia">
							<i class="far fa-eye"></i> Termo de Responsabilidade Cirurgia
							</button>
						</div>

						<div style="">
							<button type="button" class="btn btn-primary alinhamneto" id="re_escdoc4" style="display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="term_part_cesareo">
							<i class="far fa-eye"></i> Termo de Responsabilidade Parto Cesáreo
							</button>
						</div>

						<div style="">
							<button type="button" class="btn btn-primary alinhamneto" id="re_escdoc5" style="display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="term_sedacao">
							<i class="far fa-eye"></i> Termo - Sedação
							</button>
						</div>

						<div style="">
							<button type="button" class="btn btn-primary alinhamneto" id="re_escdoc6" style="display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="term_laqueadura">
							<i class="far fa-eye"></i> Termo - Laqueadura
							</button>
						</div>

					<?php } ?>
						
					<!-- BOTÃO PARA REASSINAR -->
					<div style="">
						<button type="button" class="btn btn-primary alinhamneto" data-toggle="modal" data-target="#exampleModalCenter" id="btnReAssinar" style="display: none;">
								<i class="fas fa-signature"></i> Assinar
						</button>
					</div>

					<br><br><br><br>
				<?php } ?>
			</div>

				

			<br>



			<div class="row" style="margin: 0 0 0 0 ; padding: 0 0 0 0 ;">
			<!-- SE TIVER ASSINADO -->

					<?php if(isset($var_pdf_existe)){ ?>
						
						<div class="col-md-12"><h11 id=""><i class="fas fa-file-contract"></i> Documentos Assinados:</h11></div>
						
						<!-- APENAS GERA A GUIA TISS SE FOR CONVENIO -->
						<?php if($var_cd_conv <> 1 && $var_cd_conv <> 2 && $var_cd_conv <> 40  && $var_cd_conv <> 105 && $var_tp_atendimento <> 'A' && $var_tp_atendimento <> 'I'){?>
							<div style="margin-top: 20px; margin-right: 10px; ">
								<a  style="height: 100%; width: 100% " class="btn btn-primary " data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="tiss_pa" data-identificador="guia_tiss_assinado"><i class="fas fa-file-pdf"></i> Contrato Internação</a>
							</div>
						<?php } ?>

						<!-- APENAS GERA A GUIA CONSULTA SE FOR CONVENIO -->
						<?php if($var_cd_conv <> 1 && $var_cd_conv <> 2 && $var_cd_conv <> 40  && $var_cd_conv <> 105 && $var_tp_atendimento == 'A' && $var_tp_atendimento <> 'I'){?>
							<div style="margin-top: 20px; margin-right: 10px; ">
								<a  style="height: 100%; width: 100% " class="btn btn-primary" data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="cons_pa" data-identificador="guia_consulta_assinado"><i class="fas fa-file-pdf"></i> Guia Consulta</a>
							</div>
						<?php } ?>
						
						<!-- GERA CONTRATO EXCETO SUS -->
						<?php if($var_cd_conv <> 1 && $var_cd_conv <> 2 && $var_cd_conv <> 105 && $var_tp_atendimento <> 'I'){?>
							<div style="margin-top: 20px; margin-right: 10px;">
								<a style="height: 100%; width: 100% "  class="btn btn-primary" data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="cont_pa" data-identificador="cont_pa_assinado"><i class="fas fa-file-pdf"></i> Contrato</a>
							</div>
						<?php } ?>
						
						<!-- GERA FAA APENAS SUS -->
						<?php if($var_cd_conv == 1 || $var_cd_conv == 2 || $var_cd_conv == 105){?>
							<div style="margin-top: 20px; margin-right: 10px;">
								<a style="height: 100%; width: 100% "  class="btn btn-primary" data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="hos_faa" data-identificador="hos_faa_assinado"><i class="fas fa-file-pdf"></i> Ficha Atendimento</a>
							</div>
						<?php } ?>		
						
						
						<!-- GERA INTERNAÇÃO -->
						<?php if($var_tp_atendimento =='I'){?>
							
							
							<?php if(isset($pdf_cart_contrato_internacao)){ ?>
								<!-- GERAR -->
								<div style="">
									<button type="button" class="btn btn-primary alinhamneto" id="assinado_escdoc1"  data-toggle="modal" data-target="#visualizaModalAssinado"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="cont_int" data-identificador="contrato_internacao_assinada">
									<i class="fas fa-file-pdf"></i> Contrato Internação
									</button>
								</div>
							<?php }else{?>
								<!-- NÃO GERAR -->
							<?php } ?>

							<?php if(isset($pdf_cart_golpe_existe)){ ?>
								<!-- GERAR -->
								<div style="">
									<button type="button" class="btn btn-primary alinhamneto" id="assinado_escdoc2"  data-toggle="modal" data-target="#visualizaModalAssinado"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="cart_golpe" data-identificador="carta_golpe_assinada">
									<i class="fas fa-file-pdf"></i> Carta Golpe
									</button>
								</div>
							<?php }else{?>
								<!-- NÃO GERAR -->
							<?php } ?>


							<?php if(isset($pdf_cart_term_cirurgia)){ ?>
								<!-- GERAR -->
								<div style="">
									<button type="button" class="btn btn-primary alinhamneto" id="assinado_escdoc3"  data-toggle="modal" data-target="#visualizaModalAssinado"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="term_cirurgia" data-identificador="termo_cirurgia_assinada">
									<i class="fas fa-file-pdf"></i> Termo de Responsabilidade Cirurgia
									</button>
								</div>

							<?php }else{?>
								<!-- NÃO GERAR -->
							<?php } ?>


							<?php if(isset($pdf_cart_term_part_cesareo)){ ?>
								<!-- GERAR -->
								<div style="">
									<button type="button" class="btn btn-primary alinhamneto" id="assinado_escdoc4"  data-toggle="modal" data-target="#visualizaModalAssinado"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="term_part_cesareo" data-identificador="termo_parto_cesareo_assinada">
									<i class="fas fa-file-pdf"></i> Termo de Responsabilidade Parto Cesáreo
									</button>
								</div>

							<?php }else{?>
								<!-- NÃO GERAR -->
							<?php } ?>


							<?php if(isset($pdf_termo_sedacao)){ ?>
								<!-- GERAR -->
								<div style="">
									<button type="button" class="btn btn-primary alinhamneto" id="assinado_escdoc5"  data-toggle="modal" data-target="#visualizaModalAssinado"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="term_sedacao" data-identificador="term_sedacao_assinado">
									<i class="fas fa-file-pdf"></i> Termo - Sedação
									</button>
								</div>

							<?php }else{?>
								<!-- NÃO GERAR -->
							<?php } ?>

							 
							<?php if(isset($pdf_termo_laqueadura)){ ?>
								<!-- GERAR -->
								<div style="">
									<button type="button" class="btn btn-primary alinhamneto" id="assinado_escdoc6"  data-toggle="modal" data-target="#visualizaModalAssinado"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="term_laqueadura" data-identificador="term_laqueadura_assinado">
									<i class="fas fa-file-pdf"></i> Termo - Laqueadura
									</button>
								</div>

							<?php }else{?>
								<!-- NÃO GERAR -->
							<?php } ?>

						<?php } ?>
		
					<?php }else{?>
						
						<?php if($_SESSION['sn_usuario_comum'] == 'S'){ ?>

							<div class="col-md-2" style="margin: 0 0 0 0 ; padding: 0 0 0 0 ;">

								<!-- QUANTO FOR ATENDIMENTO I TRAZAR O BOTÃO OCULTO PARA QUE function funcao_ocultar() MOSTRE ELE -->
								<?php if($var_tp_atendimento =='I'){ ?>
									<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModalCenter" id="btnAssinar" style="display: none;">
										<i class="fas fa-signature"></i> Assinar
									</button>
								<?php }else{?>
									<button type="button" class="btn btn-primary alinhamneto_assinar" data-toggle="modal" data-target="#exampleModalCenter" id="btnAssinar" >
										<i class="fas fa-signature"></i> Assinar
									</button>
								<?php }	?>

							</div>

						<?php } ?>

					<?php }	?>
			</div>

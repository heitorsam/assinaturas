<!--SE NÃO TIVER ASSINADO -->
<div class="row">
				
				<?php if(!isset($var_pdf_existe)){?>
					<!-- APENAS GERA A GUIA TISS SE FOR CONVENIO -->
					<?php if($var_cd_conv <> 1 && $var_cd_conv <> 2 && $var_cd_conv <> 40  && $var_cd_conv <> 105 && $var_tp_atendimento <> 'A' && $var_tp_atendimento <> 'I'){?>
						
						<div style="margin-top: 20px; margin-left: 15px;">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="guia_tiss">
								<i class="far fa-eye"></i> Guia TISS
							</button>
						</div>
						
					<?php } ?>

					<!-- APENAS GERA A GUIA CONSULTA SE FOR CONVENIO  -->
					<?php if($var_cd_conv <> 1 && $var_cd_conv <> 2 && $var_cd_conv <> 40  && $var_cd_conv <> 105 && $var_tp_atendimento == 'A' && $var_tp_atendimento <> 'I'){?>
						
						<div style="margin-top: 20px; margin-left: 15px;">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="guia_consulta">
								<i class="far fa-eye"></i> Guia Consulta
							</button>
						</div>
						
					<?php } ?>
					
					<!-- GERA CONTRATO EXCETO SUS -->
					<?php if($var_cd_conv <> 1 && $var_cd_conv <> 2 && $var_cd_conv <> 105 && $var_tp_atendimento <> 'I' ){?>
						
						<div style="margin-top: 20px; margin-left: 15px;">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="contrato">
								<i class="far fa-eye"></i> Contrato
							</button>
						</div>
						
					<?php } ?>
					
					<!-- GERA FAA APENAS SUS -->
					<?php if($var_cd_conv == 1 || $var_cd_conv == 2 || $var_cd_conv == 105 ){?>
						
						<div style="margin-top: 20px; margin-left: 15px;">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="hos_faa">
								<i class="far fa-eye"></i> Ficha Atendimento
							</button>
						</div>
					
					<?php } ?>

					<!-- GERA GUIA INTERNAÇÃO -->
					<?php if($var_tp_atendimento =='I'){?>
						

						<div style="margin-top: 20px; margin-left: 15px;">
							<button type="button" class="btn btn-primary" id="escdoc1" style="display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="guia_tiss">
							<i class="far fa-eye"></i> Guia Internação
							</button>
						</div>

						<div style="margin-top: 20px; margin-left: 5px;">
							<button type="button" class="btn btn-primary" id="escdoc2" style=" display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="carta_golpe">
							<i class="far fa-eye"></i> Carta Golpe
							</button>
						</div>

						<div style="margin-top: 20px; margin-left: 5px;">
							<button type="button" class="btn btn-primary" id="escdoc3" style=" display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="term_cirurgia">
							<i class="far fa-eye"></i> Termo de Responsabilidade Cirurgia
							</button>
						</div>

						<div style="margin-top: 20px; margin-left: 15px;">
							<button type="button" class="btn btn-primary" id="escdoc4" style="display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="term_part_cesareo">
							<i class="far fa-eye"></i>Termo de Responsabilidade Parto Cesáreo
						</div>

					<?php } ?>
				<?php }else{ ?>


					<!-- RE-ASSINATURA -->
					<?php if($var_tp_atendimento =='I'){?>
						<br><br>
						<div class="col-md-12"><h11 id="lbReAssinar" style=" display: none;"><i class="fas fa-redo"></i> Assinar Novamente:</h11></div>
						<div style="margin-top: 20px; margin-left: 15px;">
							<button type="button" class="btn btn-primary" id="re_escdoc1" style="display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="guia_tiss">
							<i class="far fa-eye"></i> Guia Internação
							</button>
						</div>

						<div style="margin-top: 20px; margin-left: 5px;">
							<button type="button" class="btn btn-primary" id="re_escdoc2" style=" display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="carta_golpe">
							<i class="far fa-eye"></i> Carta Golpe
							</button>
						</div>

						<div style="margin-top: 20px; margin-left: 5px;">
							<button type="button" class="btn btn-primary" id="re_escdoc3" style=" display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="term_cirurgia">
							<i class="far fa-eye"></i> Termo de Responsabilidade Cirurgia
							</button>
						</div>

						<div style="margin-top: 20px; margin-left: 15px;">
							<button type="button" class="btn btn-primary" id="re_escdoc4" style="display: none;" data-toggle="modal" data-target="#visualizaModal"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-nm_paciente="<?php echo $var_nm_paciente ?>" data-dt_aten="<?php echo $var_dt_aten ?>"  data-nm_conv="<?php echo $var_nm_conv ?>" data-identificador="term_part_cesareo">
							<i class="far fa-eye"></i>Termo de Responsabilidade Parto Cesáreo
						</div>

						
					<?php } ?>
						
					
					<div style="margin-top: 20px; margin-left: 15px;">
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" id="butao" style="display: none;">
								<i class="fas fa-signature"></i> Assinar
						</button>
					</div>

					<br><br><br><br>
				<?php } ?>
			</div>

				

			<br>





			<div class="row">
			<!-- SE TIVER ASSINADO -->

					<?php if(isset($var_pdf_existe)){ ?>
						
						<div class="col-md-12"><h11 id=""><i class="fas fa-file-contract"></i> Documentos Assinados:</h11></div>
						
						<!-- APENAS GERA A GUIA TISS SE FOR CONVENIO -->
						<?php if($var_cd_conv <> 1 && $var_cd_conv <> 2 && $var_cd_conv <> 40  && $var_cd_conv <> 105 && $var_tp_atendimento <> 'A' && $var_tp_atendimento <> 'I'){?>
							<div style="margin-top: 20px; margin-left: 15px; ">
								<a  style="height: 100%; width: 100% " class="btn btn-primary" data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="tiss_pa" data-identificador="guia_tiss_assinado"><i class="fas fa-file-pdf"></i> Guia Tiss</a>
							</div>
						<?php } ?>

						<!-- APENAS GERA A GUIA CONSULTA SE FOR CONVENIO -->
						<?php if($var_cd_conv <> 1 && $var_cd_conv <> 2 && $var_cd_conv <> 40  && $var_cd_conv <> 105 && $var_tp_atendimento == 'A' && $var_tp_atendimento <> 'I'){?>
							<div style="margin-top: 20px; margin-left: 15px; ">
								<a  style="height: 100%; width: 100% " class="btn btn-primary" data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="cons_pa" data-identificador="guia_consulta_assinado"><i class="fas fa-file-pdf"></i> Guia Consulta</a>
							</div>
						<?php } ?>
						
						<!-- GERA CONTRATO EXCETO SUS -->
						<?php if($var_cd_conv <> 1 && $var_cd_conv <> 2 && $var_cd_conv <> 105 && $var_tp_atendimento <> 'I'){?>
							<div style="margin-top: 20px; margin-left: 15px;">
								<a style="height: 100%; width: 100% "  class="btn btn-primary" data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="cont_pa" data-identificador="cont_pa_assinado"><i class="fas fa-file-pdf"></i> Contrato</a>
							</div>
						<?php } ?>
						
						<!-- GERA FAA APENAS SUS -->
						<?php if($var_cd_conv == 1 || $var_cd_conv == 2 || $var_cd_conv == 105){?>
							<div style="margin-top: 20px; margin-left: 15px;">
								<a style="height: 100%; width: 100% "  class="btn btn-primary" data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="hos_faa" data-identificador="hos_faa_assinado"><i class="fas fa-file-pdf"></i> Ficha Atendimento</a>
							</div>
						<?php } ?>		
						
						
						<!-- GERA INTERNAÇÃO -->
						<?php if($var_tp_atendimento =='I'){?>
							
							
							<?php if(isset($pdf_cart_tiss_int)){ ?>
								<!-- GERAR -->
								<div style="margin-top: 20px; margin-left: 15px;">
									<button type="button" class="btn btn-primary" id="assinado_escdoc1"  data-toggle="modal" data-target="#visualizaModalAssinado"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="hos_faa" data-identificador="guia_internacao_assinada">
									<i class="fas fa-file-pdf"></i> Guia Internação
									</button>
								</div>
							<?php }else{?>
								<!-- NÃO GERAR -->
							<?php } ?>

							<?php if(isset($pdf_cart_golpe_existe)){ ?>
								<!-- GERAR -->
								<div style="margin-top: 20px; margin-left: 5px;">
									
									<button type="button" class="btn btn-primary" id="assinado_escdoc2"  data-toggle="modal" data-target="#visualizaModalAssinado"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="cart_golpe" data-identificador="carta_golpe_assinada">
									<i class="fas fa-file-pdf"></i> Carta Golpe
									</button>
								</div>
							<?php }else{?>
								<!-- NÃO GERAR -->
							<?php } ?>


							<?php if(isset($pdf_cart_term_cirurgia)){ ?>
								<!-- GERAR -->
								<div style="margin-top: 20px; margin-left: 5px;">
									<button type="button" class="btn btn-primary" id="assinado_escdoc3"  data-toggle="modal" data-target="#visualizaModalAssinado"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="term_cirurgia" data-identificador="termo_cirurgia_assinada">
									<i class="fas fa-file-pdf"></i> Termo de Responsabilidade Cirurgia
									</button>
								</div>

							<?php }else{?>
								<!-- NÃO GERAR -->
							<?php } ?>


							<?php if(isset($pdf_cart_term_part_cesareo)){ ?>
								<!-- GERAR -->
								<div style="margin-top: 20px; margin-left: 5px;">
									<button type="button" class="btn btn-primary" id="assinado_escdoc4"  data-toggle="modal" data-target="#visualizaModalAssinado"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="term_part_cesareo" data-identificador="termo_parto_cesareo">
									<i class="fas fa-file-pdf"></i> Termo de Responsabilidade Parto Cesáreo
									</button>
								</div>

							<?php }else{?>
								<!-- NÃO GERAR -->
							<?php } ?>

						<?php } ?>



						

		
					<?php }else{?>
						
						<?php if($_SESSION['sn_usuario_comum'] == 'S'){ ?>

							<div class="col-md-2" >

								<!-- QUANTO FOR ATENDIMENTO I TRAZAR O BOTÃO OCULTO PARA QUE function funcao_ocultar() MOSTRE ELE -->
								<?php if($var_tp_atendimento =='I'){ ?>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" id="btnAssinar" style="display: none;">
										<i class="fas fa-signature"></i> Assinar
									</button>
								<?php }else{?>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" id="btnAssinar" >
										<i class="fas fa-signature"></i> Assinar
									</button>
								<?php }	?>

							</div>

						<?php } ?>

					<?php }	?>
			</div>

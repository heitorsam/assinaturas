
<?php 

//Visualizar Assinada - Tiss Guia PA
if($row_lista_doc['NM_DOC'] == 'tiss_pa' ) { 

	echo '<a type="button" class="btn btn-primary"data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="tiss_pa" data-identificador="guia_tiss_assinado"><i class="fas fa-eye"></i></a>';
} 

//Visualizar Assinada - Guia Consulta
if($row_lista_doc['NM_DOC'] == 'cons_pa' ){
                                
	echo '<a type="button" class="btn btn-primary"data-toggle="modal" data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="cons_pa" data-identificador="guia_consulta_assinado"><i class="fas fa-eye"></i></a>';
}

//Visualizar Assinada -  Contrato
if($row_lista_doc['NM_DOC'] == 'cont_pa' ){
                                
	echo '<a type="button" class="btn btn-primary"data-toggle="modal" data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="cont_pa" data-identificador="cont_pa_assinado"><i class="fas fa-eye"></i></a>';
}

//Visualizar Assinada - Ficha Atendimento
if($row_lista_doc['NM_DOC'] == 'hos_faa' ){
                                
	echo '<a type="button" class="btn btn-primary"data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="hos_faa" data-identificador="hos_faa_assinado"><i class="fas fa-eye"></i></a>';
}

//Visualizar Assinada - Contrato Internação
if($row_lista_doc['NM_DOC'] == 'cont_int' ){
                                
	echo '<a type="button" class="btn btn-primary"data-toggle="modal" data-target="#visualizaModalAssinado"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="cont_int" data-identificador="contrato_internacao_assinada"><i class="fas fa-eye"></i></a>';
}

//Visualizar Assinada - Carta Golpe 
if($row_lista_doc['NM_DOC'] == 'cart_golpe' ){
                                
	echo '<a type="button" class="btn btn-primary"data-toggle="modal" data-target="#visualizaModalAssinado"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="cart_golpe" data-identificador="carta_golpe_assinada"><i class="fas fa-eye"></i></a>';
}

//Visualizar Assinada - Termo Cirurgia
if($row_lista_doc['NM_DOC'] == 'term_cirurgia' ){
                                
	echo '<a type="button" class="btn btn-primary"data-toggle="modal" data-target="#visualizaModalAssinado"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="term_cirurgia" data-identificador="termo_cirurgia_assinada"><i class="fas fa-eye"></i></a>';
}


//Visualizar Assinada - Termo Parto
if($row_lista_doc['NM_DOC'] == 'term_part_cesareo' ){
                                
	echo '<a type="button" class="btn btn-primary"data-toggle="modal" data-target="#visualizaModalAssinado"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="term_part_cesareo" data-identificador="termo_parto_cesareo_assinada"><i class="fas fa-eye"></i></a>';
}

//Visualizar Assinada - Termo Sedação
if($row_lista_doc['NM_DOC'] == 'term_sedacao' ){
                                
	echo '<a type="button" class="btn btn-primary"data-toggle="modal" data-target="#visualizaModalAssinado"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="term_sedacao" data-identificador="term_sedacao_assinado"><i class="fas fa-eye"></i></a>';
}

//Visualizar Assinada - Termo Laqueadura
if($row_lista_doc['NM_DOC'] == 'term_laqueadura' ){
                                
	echo '<a type="button" class="btn btn-primary"data-toggle="modal" data-target="#visualizaModalAssinado"  data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="term_laqueadura" data-identificador="term_laqueadura_assinado"><i class="fas fa-eye"></i></a>';
}

//Visualizar Assinada - Requerimento Prontuário
if($row_lista_doc['NM_DOC'] == 'same_pendente' ){
                                
	echo '<a type="button" class="btn btn-primary"data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_paciente="<?php echo $var_cd_paciente ?>" data-tp_doc="same" data-identificador="guia_same_assinado"><i class="fas fa-eye"></i></a>';
}



?>
<!--BACKUP TABLE-->
<?php
	/*
	$var_modal_visualizar = 1;

	while($row_lista_doc = oci_fetch_array($result_lista_doc)){	

		echo '<tr>';
			echo '<td style="text-align: center; vertical-align : middle;">' . $row_lista_doc['NM_DOC'] . '</td>';
			echo '<td style="text-align: center; vertical-align : middle;">' . $row_lista_doc['DESC_DOC'] . '</td>';
			echo '<td style="text-align: center; vertical-align : middle;">' . $row_lista_doc['NM_USER'] . '</td>'; 
			echo '<td style="text-align: center; vertical-align : middle;">' . $row_lista_doc['DT_CRIACAO'] . '</td>';

			//VISUALIZAR


			//BAIXAR                            
			echo '<td style="text-align: center; vertical-align : middle;"> 
			<a type="button" class="btn btn-primary" target="_blank" href="baixar_pdf.php?nm_doc='. $row_lista_doc['NOME_ANEXO'] . '">'. ' <i class="fas fa-download"></i></a> 
			</td>'; 

			echo '<td style="text-align: center; vertical-align : middle;"> 
					<?php include "include_visualizar.php"?>
					<a type="button" class="btn btn-primary"data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_atendimento="<?php echo $var_cd_atendimento ?>" data-tp_doc="tiss_pa" data-identificador="guia_tiss_assinado"><i class="fas fa-eye"></i> Guia Tiss</a>

					</td>'; 
														
		echo '</tr>';

		$var_modal_visualizar = $var_modal_visualizar + 1;
	}
	*/
?>

 <?php 
  	////////////////////////////////
	//VERIFICA SE PDF FOI ASSINADO//
	////////////////////////////////
	
	if(isset($_GET['cd_atendimento']) OR isset($_SESSION['atdpdf']) ){
		$cons_pdf ="SELECT *
						FROM assinaturas.DOCUMENTOS_ASSINADOS_SAME ass
					WHERE ass.CD_PACIENTE = $var_cd_paciente
				";
	
		$result_pdf_exis = oci_parse($conn_ora, $cons_pdf);
		@oci_execute($result_pdf_exis);
		@$row_pdf_exis = oci_fetch_array($result_pdf_exis);
		@$var_pdf_existe = $row_pdf_exis['BLOB_ANEXO'];
	}
	
	/////////////////////////////////////////
	//VERIFICA SE REQUERIMENTO FOI ASSINADO//
	/////////////////////////////////////////
	
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

		//$header = 'location: gerar_documento_same_requisicao.php?frm_cd_paciente='.$var_cd_paciente;
		if($var_valida_requerimento == 'NAO_PREENCHIDO'){
			$_SESSION['msgerro'] = "Documento não preenchido";
			//header($header);  
			}
	}
?>
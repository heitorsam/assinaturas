<?php
    require_once "conexao.php";
    if(isset($_GET['cd_prestador'])) {
        $img = "SELECT ASSINATURA, ASSINATURA_TISS FROM dbamv.prestador_assinatura WHERE CD_PRESTADOR =" . $_GET['cd_prestador'];
		$result_img = oci_parse($conn_ora, $img);
		@oci_execute($result_img);
		$row_img = oci_fetch_array($result_img);
		header("Content-type: image/png");
        //echo $row_img["ASSINATURA_TISS"];

		$cd_prest = $_GET['cd_prestador'];

		//SQL BUSCA ASSINATURA
		$cons_assinatura_prest = "SELECT ASSINATURA_TISS, ASSINATURA
		FROM dbamv.prestador_assinatura
		WHERE CD_PRESTADOR = $cd_prest ";

		@$result_assinatura_prest = oci_parse($conn_ora, @$cons_assinatura_prest);
		@oci_execute(@$result_assinatura_prest);
		@$row_assinatura_prest = oci_fetch_array($result_assinatura_prest);
		@$assinatura = @$row_assinatura_prest['ASSINATURA_TISS']->load();

		echo '<img src="data:image/png;base64,'.base64_encode($assinatura).'"/>';




		//echo base64_encode($row_img['ASSINATURA_TISS']);
	}
?>
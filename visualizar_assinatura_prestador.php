<?php
    require_once "conexao.php";
    if(isset($_GET['cd_prestador'])) {
        $img = "SELECT ASSINATURA, ASSINATURA_TISS FROM dbamv.prestador_assinatura WHERE CD_PRESTADOR =" . $_GET['cd_prestador'];
		$result_img = oci_parse($conn_ora, $img);
		@oci_execute($result_img);
		$row_img = oci_fetch_array($result_img);
		header("Content-type: image/png");
        echo $row_img["ASSINATURA"];
	}
	mysqli_close($conn);
?>
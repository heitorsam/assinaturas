<?php

    session_start();

    //CONEXAO
    include 'conexao.php';

    //ACESSO RESTRITO
    include 'acesso_restrito_faturamento.php'; 

    //$var_cd_atendimento = $_SESSION['atdpdf'];
    $nm_documento = $_GET['nm_doc'];

    ///////////////
    //PDF DOWLOAD//
    ///////////////   
    
    echo $cons_dowload="SELECT da.*
    FROM assinaturas.documentos_assinados da
    WHERE da.NOME_ANEXO = '$nm_documento'";

    $result_dowload = oci_parse($conn_ora, $cons_dowload);
    @oci_execute($result_dowload);
    $result= oci_fetch_array($result_dowload);
    $image =$result['BLOB_ANEXO']->load();
    //$content= $result['BLOB_ANEXO']; 

    $html= '';

    $html.= '<object data="data:application/pdf;base64,<?php echo base64_encode(' . $image . ') ?>" type="application/pdf" style="height:60%;width:60%" title="Iframe Example">
            </object>';

    $arquivo = $result['NOME_ANEXO'] . '.pdf';

    //Configurações header para forçar o download
    header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");
    header ("Content-type:application/pdf");
    header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
    header ("Content-Description: PHP Generated Data" );

    // Envia o conteúdo do arquivo
    echo $html;

    exit;

?>
    

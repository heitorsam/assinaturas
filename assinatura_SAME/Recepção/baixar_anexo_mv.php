<?php

    session_start();

    //CONEXAO
    include '../../conexao.php';

    //ACESSO RESTRITO
    include '../../acesso_restrito.php'; 

    //$var_cd_atendimento = $_SESSION['atdpdf'];
    $nm_documento = $_GET['nm_doc'];

    $sql="SELECT *
          FROM assinaturas.ARQUIVO_DOCUMENTO_SAME ad
          WHERE ad.CD_ARQUIVO_DOCUMENTO = '$nm_documento'";

    $res_sql = oci_parse($conn_ora, $sql);
    @oci_execute($res_sql);

    $row_img = oci_fetch_array($res_sql);

    $filename= $row_img['DS_NOME_ARQUIVO'];
    $dados = $row_img['LO_ARQUIVO_DOCUMENTO'];

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream'); 
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    echo $dados->load();


    ///////////////
    //PDF DOWLOAD//
    ///////////////   
    
    echo $cons_dowload="SELECT da.*
    FROM assinaturas.ARQUIVO_DOCUMENTO_SAME da
    WHERE da.CD_ARQUIVO_DOCUMENTO = '$nm_documento'";

    $result_dowload = oci_parse($conn_ora, $cons_dowload);
    @oci_execute($result_dowload);
    $result= oci_fetch_array($result_dowload);
    $image =$result['LO_ARQUIVO_DOCUMENTO']->load();
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
    

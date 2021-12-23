<?php

    session_start();

    //CONEXAO
    include 'conexao.php';


    $var_cd_atendimento = $_SESSION['atdpdf'];

    ///////////////
    //PDF DOWLOAD//
    ///////////////
    $cons_dowload="SELECT *
    FROM dbamv.teste_assinaturas ass
    WHERE ass.cd_atendimento = $var_cd_atendimento";


    $result_dowload = oci_parse($conn_ora, $cons_dowload);
    @oci_execute($result_dowload);
    $result= oci_fetch_array($result_dowload);
    $image =$result['BLOB_ANEXO']->load();
    //$content= $result['BLOB_ANEXO']; 
?>
<iframe src="data:application/pdf;base64,<?php echo base64_encode($image) ?>" type="application/pdf" style="height:60%;width:60%" title="Iframe Example">
</iframe>
<?php //echo  $var;?>


    

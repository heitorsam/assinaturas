<?php

        include 'conexao.php';



        //CONSULTA QUE VERIFICA SE O PACIENTE JA TEVE ASSINATURA NO ATENDIMENTO
        $sn_assinatura = "SELECT ad.LO_ARQUIVO_DOCUMENTO
        FROM dbamv.ARQUIVO_ATENDIMENTO aa
        INNER JOIN dbamv.ARQUIVO_DOCUMENTO ad
        ON ad.CD_ARQUIVO_DOCUMENTO = aa.CD_ARQUIVO_DOCUMENTO
        WHERE aa.CD_ATENDIMENTO = 4755518
        AND ad.DS_NOME_ARQUIVO = 'TA'";
        
        $res_sn_assinatura = oci_parse($conn_ora, $sn_assinatura);
        oci_execute($res_sn_assinatura);

        $row_assinatura = oci_fetch_array($res_sn_assinatura);

        // Recupera o valor do BLOB do campo do banco de dados
        $pdf_blob = $row_assinatura['LO_ARQUIVO_DOCUMENTO'];


        if(isset($pdf_blob)){

            // Converte o BLOB em base64
            $pdf_base64 = base64_encode($pdf_blob->load());

        }


?>

   <!-- Usando o elemento <embed> para exibir o PDF -->
   <iframe src="data:application/pdf;base64,<?php echo $pdf_base64; ?>" width="100%" height="600px"></iframe>
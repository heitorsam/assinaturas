<?php

    echo '</br>';

    $cons_lista_doc = " SELECT tp.DESC_DOC, da.NOME_ANEXO, da.NM_USER, da.DT_CRIACAO
                        FROM assinaturas.documentos_assinados da
                        INNER JOIN assinaturas.TP_DOCUMENTO tp
                        ON tp.NM_DOC = da.TP_DOCUMENTO
                        WHERE da.cd_atendimento = $var_cd_atendimento";

    $result_lista_doc = oci_parse($conn_ora, $cons_lista_doc);
    @oci_execute($result_lista_doc);
    @$row_lista_doc = oci_fetch_array($result_lista_doc);

;

    echo '<a target="_blank" href="baixar_pdf.php?nm_doc='. $row_lista_doc['NOME_ANEXO'] . '"> '.
     $row_lista_doc['NOME_ANEXO'] . ' </a>';

?>
    

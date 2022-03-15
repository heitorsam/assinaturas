<?php

    echo '</br>';

    $cons_lista_doc = " SELECT tp.DESC_DOC, da.NOME_ANEXO, da.NM_USER, 
                        TO_CHAR(da.DT_CRIACAO,'DD/MM/YYYY HH24:MI') AS DT_CRIACAO
                        FROM assinaturas.documentos_assinados da
                        INNER JOIN assinaturas.TP_DOCUMENTO tp
                        ON tp.NM_DOC = da.TP_DOCUMENTO
                        WHERE da.cd_atendimento = $var_cd_atendimento
                        ORDER BY tp.DESC_DOC ASC";

    $result_lista_doc = oci_parse($conn_ora, $cons_lista_doc);
    @oci_execute($result_lista_doc);

     //ACESSO RESTRITO BAIXAR PDF
     //APENAS ADMIN
     
?>

    <div class="table-responsive col-md-12" style="padding: 0px !important;">

        <table class="table table-striped" cellspacing="0" cellpadding="0">
            
            <thead>
                <tr>
                    <th style="text-align: center;">Descrição</th>
                    <th style="text-align: center;">Usuário</th>
                    <th style="text-align: center;">Data Criação</th>
                    <th style="text-align: center;">Ações</th>
                </tr>
            </thead>

            <tbody>
                
                <?php

                    while($row_lista_doc = oci_fetch_array($result_lista_doc)){	

                        echo '<tr>';

                            echo '<td style="text-align: center; vertical-align : middle;">' . $row_lista_doc['DESC_DOC'] . '</td>';
                            echo '<td style="text-align: center; vertical-align : middle;">' . $row_lista_doc['NM_USER'] . '</td>'; 
                            echo '<td style="text-align: center; vertical-align : middle;">' . $row_lista_doc['DT_CRIACAO'] . '</td>';

                            //VISUALIZAR


                            //BAIXAR                            
                            echo '<td style="text-align: center; vertical-align : middle;"> <a type="button" class="btn btn-primary" target="_blank" href="baixar_pdf.php?nm_doc='. $row_lista_doc['NOME_ANEXO'] . '">'
                            . ' <i class="fas fa-download"></i></a> </td>'; 
                                                                        
                        echo '</tr>';
                    }
                ?>

            </tbody>

        </table>

    </div>

     


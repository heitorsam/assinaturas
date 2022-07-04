<?php

    echo '</br>';

    $cons_lista_doc = " SELECT doc.CD_PACIENTE, 
                                doc.NM_PACIENTE, 
                                doc.TP_DOCUMENTO, 
                                TO_CHAR(doc.HR_CADASTRO,'DD/MM/YYYY HH24:MI') AS DT_CRIACAO,
                                doc.CD_USUARIO_CADASTRO,
                                doc.NOME_ANEXO,
                                tp.DESC_DOC,
                                tp.NM_DOC
                        FROM assinaturas.DOCUMENTOS_ASSINADOS_SAME doc
                        INNER JOIN assinaturas.TP_DOCUMENTO tp
                          ON tp.NM_DOC = doc.TP_DOCUMENTO
                        WHERE doc.CD_PACIENTE = $var_cd_paciente
                        ";

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
                    <th style="text-align: center;">Anexo Foto</th>
                    <th style="text-align: center;">Anexo Documento</th>
                    <th style="text-align: center;">Visualizar</th>
                    <th style="text-align: center;">Baixar</th>

                </tr>
            </thead>

            <tbody>
                
            <?php
            $var_modal_visualizar = 1;

                while($row_lista_doc = @oci_fetch_array($result_lista_doc)){  ?>  
                    
                <tr>
                    
                    <td class='align-middle' style='text-align: center;'><?php echo @$row_lista_doc['DESC_DOC']; ?></td>
                    <td class='align-middle' style='text-align: center;'><?php echo @$row_lista_doc['CD_USUARIO_CADASTRO']; ?></td>
                    <td class='align-middle' style='text-align: center;'><?php echo @$row_lista_doc['DT_CRIACAO']; ?></td>
                     
                        <!--MODEL ANEXO FOTO-->
                        <td class="align-middle" style="text-align: center !important;">
                            <?php 
                                if($row_lista_doc['NM_DOC'] == 'same_pendente' ){
                                    echo '<a type="button" class="btn btn-primary"data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_paciente="'. $var_cd_paciente.'" data-nm_paciente="'. $var_nm_paciente.'"  data-tp_doc="same" data-identificador="guia_same_assinado"><i class="fas fa-eye"></i></a>';
                                }
                            ?>
                        </td>
                    
                        <!--MODEL DOCUMENTO-->
                        <td class="align-middle" style="text-align: center !important;">
                            <?php 
                                if($row_lista_doc['NM_DOC'] == 'same_pendente' ){
                                    echo '<a type="button" class="btn btn-primary"data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_paciente="'. $var_cd_paciente.'" data-nm_paciente="'. $var_nm_paciente.'"  data-tp_doc="same" data-identificador="guia_same_assinado"><i class="fas fa-eye"></i></a>';
                                }
                            ?>
                        </td>

                        <!--MODEL VISUALIZAR-->
                        <td class="align-middle" style="text-align: center !important;">
                            <?php 
                            //Visualizar Assinada - Requerimento Prontuário
                                if($row_lista_doc['NM_DOC'] == 'same_pendente' ){
                                                                
                                    echo '<a type="button" class="btn btn-primary"data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_paciente="'. $var_cd_paciente.'" data-nm_paciente="'. $var_nm_paciente.'"  data-tp_doc="same" data-identificador="guia_same_assinado"><i class="fas fa-eye"></i></a>';
                                }

                                //Visualizar Assinada - Requerimento Prontuário
                                if($row_lista_doc['NM_DOC'] == 'same_concluido' || $row_lista_doc['NM_DOC'] == 'same_recusado'){
                                                                
                                    echo '<a type="button" class="btn btn-primary"data-toggle="modal" data-target="#visualizaModalAssinado" data-cd_paciente="<?php echo $var_cd_paciente ?>" data-tp_doc="same" data-identificador="guia_same_assinado"><i class="fas fa-eye"></i></a>';
                                }
                            ?>
                        </td>

                        <?php
                            //BAIXAR                            
                            echo '<td style="text-align: center; vertical-align : middle;"> 
                                    <a type="button" class="btn btn-primary" target="_blank" href="assinatura_SAME/baixar_pdf.php?nm_doc='. $row_lista_doc['NOME_ANEXO'] . '&tp_permissao=same">'. ' <i class="fas fa-download"></i></a> 
                                </td>';
                        ?>

                </tr>
                
                <?php 
                    $var_modal_visualizar = $var_modal_visualizar + 1;
                    
                } ?>

            </tbody>

        </table>

    </div>

    
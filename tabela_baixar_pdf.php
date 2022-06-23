<?php

    echo '</br>';

    $cons_lista_doc = " SELECT tp.NM_DOC, tp.DESC_DOC, da.NOME_ANEXO, da.NM_USER, 
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

                    <?php if(@$_SESSION['sn_usuario_comum'] == 'S' || @$_SESSION['sn_usuario_same_recepcao'] == 'S'){ ?>
                     <th style="text-align: center;">Visualizar</th>
                    <?php } ?>

                    <?php if(@$_SESSION['sn_faturamento'] == 'S'){ ?>
                        <th style="text-align: center;">Baixar</th>
                    <?php } ?>

                </tr>
            </thead>

            <tbody>
                
            <?php
            $var_modal_visualizar = 1;

                while($row_lista_doc = @oci_fetch_array($result_lista_doc)){  ?>  
                    
                <tr>
                    
                    <td class='align-middle' style='text-align: center;'><?php echo @$row_lista_doc['DESC_DOC']; ?></td>
                    <td class='align-middle' style='text-align: center;'><?php echo @$row_lista_doc['NM_USER']; ?></td>
                    <td class='align-middle' style='text-align: center;'><?php echo @$row_lista_doc['DT_CRIACAO']; ?></td>
                     
                    <?php if(@$_SESSION['sn_usuario_comum'] == 'S' || @$_SESSION['sn_usuario_same_recepcao'] == 'S'){ ?>
                        <!--MODEL VISUALIZAR-->
                        <td class="align-middle" style="text-align: center !important;">
                            <?php include "include_visualizar.php"?>
                        </td>
                    <?php } ?>

                        <?php
                            if(@$_SESSION['sn_faturamento'] == 'S'){
                            //BAIXAR                            
                            echo '<td style="text-align: center; vertical-align : middle;"> 
                                    <a type="button" class="btn btn-primary" target="_blank" href="baixar_pdf.php?nm_doc='. $row_lista_doc['NOME_ANEXO'] . '&tp_permissao=assinaturas">'. ' <i class="fas fa-download"></i></a> 
                                  </td>';
                            }
                        ?>

                   

                </tr>
                
                <?php 
                    $var_modal_visualizar = $var_modal_visualizar + 1;
                    
                } ?>

            </tbody>

        </table>

    </div>

    
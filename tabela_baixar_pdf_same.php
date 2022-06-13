<?php
    $var_periodo_mes = SUBSTR($var_periodo_filtro,5,2);
    $var_periodo_ano = SUBSTR($var_periodo_filtro,0,4);

    echo '</br>';
    $cons_lista_doc = " SELECT da.CD_ATENDIMENTO,
                            da.NM_PACIENTE,
                            tp.NM_DOC,
                            tp.DESC_DOC,
                            da.NOME_ANEXO,
                            da.NM_USER,
                            TO_CHAR(da.DT_CRIACAO, 'DD/MM/YYYY HH24:MI') AS DT_CRIACAO
                        FROM assinaturas.documentos_assinados da
                        INNER JOIN assinaturas.TP_DOCUMENTO tp
                        ON tp.NM_DOC = da.TP_DOCUMENTO
                        WHERE NM_DOC = 'same_pendente'
                        AND EXTRACT(YEAR FROM DT_CRIACAO) = '$var_periodo_ano'
                        AND EXTRACT(MONTH FROM DT_CRIACAO) = '$var_periodo_mes'
                        ORDER BY tp.DESC_DOC ASC
                        ";

    $result_lista_doc = oci_parse($conn_ora, $cons_lista_doc);
    @oci_execute($result_lista_doc);   
?>
    <!--TABELA-->
    <div class="table-responsive col-md-12" style="padding: 0px !important;">

        <table class="table table-striped" cellspacing="0" cellpadding="0">
            
            <thead>
                <tr>
                    <th style="text-align: center;">Paciente</th>
                    <th style="text-align: center;">Descrição</th>
                    <th style="text-align: center;">Data do Pedido</th>
                    <th style="text-align: center;">Assinar</th>
                   

                </tr>
            </thead>

            <tbody>
                
            <?php
            $var_modal_visualizar = 1;

                while($row_lista_doc = @oci_fetch_array($result_lista_doc)){  ?>  
                    
                <tr>
                <td class='align-middle' style='text-align: center;'><?php echo @$row_lista_doc['NM_PACIENTE']; ?></td>
                    <td class='align-middle' style='text-align: center;'><?php echo @$row_lista_doc['DESC_DOC']; ?></td>
                    <td class='align-middle' style='text-align: center;'><?php echo @$row_lista_doc['DT_CRIACAO']; ?></td>
                     
                        <!--MODEL VISUALIZAR-->
                        <td class="align-middle" style="text-align: center !important;">
                            <?php 
                                echo '<a type="button" class="btn btn-primary"
                                                        data-toggle="modal" 
                                                        data-target="#visualizaModalAssinado" 
                                                        data-cd_atendimento="'.$row_lista_doc['CD_ATENDIMENTO'].'" 
                                                        data-tp_doc="guia_same_assinado" 
                                                        data-identificador="guia_same_assinado">
                                      <i class="fas fa-pencil-alt"></i></a>';
                            ?>
                        </td>

                </tr>
                
                <?php 
                    $var_modal_visualizar = $var_modal_visualizar + 1; 
                } ?>

            </tbody>

        </table>

    </div>

    <!--MODAL-->
    <div class="modal fade " id="visualizaModalAssinado" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Documento Assinado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="POST" action='salvar_assinatura.php'>

                    <input type="text" id="js_cd_atendimento" name="frm_cd_atendimento"> </input>
               
                    <div class="modal-body" id="body_result" style="margin-left: 10px; width: 100%">              
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-times"></i> Fechar</button>
                        <button type="submit" id='aaaaa' class="btn btn-primary"><i class="fas fa-plus"></i> Assinar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    
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
                        $where
                        AND EXTRACT(YEAR FROM DT_CRIACAO) = '$var_periodo_ano'
                        AND EXTRACT(MONTH FROM DT_CRIACAO) = '$var_periodo_mes'
                        ORDER BY da.DT_CRIACAO ASC
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

                    <!--MUDA O TITULO PARA O DIRETOR-->
                    <?php if(@$_SESSION['sn_usuario_same_diretor'] == 'S'){ ?>
                        <th style="text-align: center;">Assinar</th>
                    <?php }else{ ?>
                        <th style="text-align: center;">Visualizar</th>
                    <?php } ?>

                    <!--LIBERA O BAIXAR-->
                    <?php if(@$_SESSION['sn_usuario_same'] == 'S'){ ?>
                        <th style="text-align: center;">Baixar</th>
                    <?php } ?>
                   

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
                        
                        <!--REGRA DE PENDENCIAS PARA O DIRETOR-->
                        <?php 
                            if(@$_SESSION['sn_usuario_same_diretor'] == 'S'){ 
                                if($row_lista_doc['NM_DOC'] == 'same_pendente'){
                                    echo '<a type="button" class="btn btn-primary"
                                                data-toggle="modal" 
                                                data-target="#visualizaModalAssinado" 
                                                data-cd_atendimento="'.$row_lista_doc['CD_ATENDIMENTO'].'" 
                                                data-tp_doc="same_pendente" 
                                                data-identificador="guia_same_assinado">
                                    <i class="fas fa-pencil-alt"></i></a>';
                                }

                                if($row_lista_doc['NM_DOC'] == 'same_concluido'){
                                    echo '<a type="button" class="btn btn-primary" style="background-color: rgba(0, 0, 0, 0) !important; border-color: rgba(0, 0, 0, 0) !important;"
                                                data-toggle="modal" 
                                                data-target="#visualizaModalAssinado" 
                                                data-cd_atendimento="'.$row_lista_doc['CD_ATENDIMENTO'].'" 
                                                data-tp_doc="same_concluido" 
                                                data-identificador="guia_same_assinado">
                                    <i style="color: #008000;" class="fas fa-check"></i></a>';
                                
                                }

                                if($row_lista_doc['NM_DOC'] == 'same_recusado'){
                                    echo '<a type="button" class="btn btn-primary" style="background-color: rgba(0, 0, 0, 0) !important; border-color: rgba(0, 0, 0, 0) !important;"
                                                data-toggle="modal" 
                                                data-target="#visualizaModalAssinado" 
                                                data-cd_atendimento="'.$row_lista_doc['CD_ATENDIMENTO'].'" 
                                                data-tp_doc="same_recusado" 
                                                data-identificador="guia_same_assinado">
                                    <i style="color: red;" class="fa-solid fa-xmark"></i></a>';
                                
                                }
                            //CASO NÃO SEJA O DIRETOR MOSTRA O BOTÃO NORMAL
                            }else{
                                echo '<a type="button" class="btn btn-primary"
                                                    data-toggle="modal" 
                                                    data-target="#visualizaModalAssinado" 
                                                    data-cd_atendimento="'.$row_lista_doc['CD_ATENDIMENTO'].'" 
                                                    data-tp_doc="same_pendente" 
                                                    data-identificador="guia_same_assinado">
                                    <i class="fas fa-pencil-alt"></i></a>';
                            }
                            
                        ?>
                    </td>

                    <?php
                        if(@$_SESSION['sn_usuario_same'] == 'S'){ 
                            //BAIXAR                            
                            echo '<td style="text-align: center; vertical-align : middle;"> 
                                        <a type="button" class="btn btn-primary" target="_blank" href="baixar_pdf.php?nm_doc='. $row_lista_doc['NOME_ANEXO'] . '">'. ' <i class="fas fa-download"></i></a> 
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
                    <input type="hidden" id="js_cd_atendimento" name="frm_cd_atendimento"> </input>
                    <div class="modal-body" id="body_result" style="margin-left: 10px; width: 100%">              
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-times"></i> Fechar</button>
                        <?php if(@$_SESSION['sn_usuario_same_diretor'] == 'S'){ ?>
                            <button type="button" id='jv_btn_recusar' class="btn btn-danger"> <i class="fas fa-times"></i> Recusar</button>
                            <button type="submit" id='jv_btn_assinar' class="btn btn-primary"><i class="fas fa-plus"></i> Assinar</button>
                        <?php } ?>

                    </div>
            </div>
        </div>
    </div>


    
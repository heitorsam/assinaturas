<?php
    $var_periodo_mes = SUBSTR($var_periodo_filtro,5,2);
    $var_periodo_ano = SUBSTR($var_periodo_filtro,0,4);

    echo '</br>';
    $cons_lista_doc = "SELECT doc.CD_PACIENTE,
                                doc.NM_PACIENTE,
                                doc.TP_DOCUMENTO,
                                TO_CHAR(doc.HR_CADASTRO, 'DD/MM/YYYY HH24:MI') AS DT_CRIACAO,
                                doc.CD_USUARIO_CADASTRO,
                                doc.NOME_ANEXO,
                                tp.DESC_DOC,
                                tp.NM_DOC,

                                CASE 
                                    WHEN TP_DOCUMENTO = 'same_recusado' THEN '#fc0303'
                                    WHEN TP_DOCUMENTO = 'same_concluido' THEN '#008000'
                                    ELSE '#d9d9d9'
                                END AS COR_PENDENCIA,

                                CASE 
                                    WHEN TP_DOCUMENTO = 'same_recusado' THEN 'fa-solid fa-xmark'
                                    WHEN TP_DOCUMENTO = 'same_concluido' THEN 'fas fa-check'
                                    ELSE 'fa-solid fa-xmark'
                                END AS ICONE,


                                CASE 
                                    WHEN TP_DOCUMENTO = 'same_recusado' THEN 'same_recusado'
                                    WHEN TP_DOCUMENTO = 'same_concluido' THEN 'same_concluido'
                                    ELSE NULL
                                END AS TP_DOC

                            FROM assinaturas.DOCUMENTOS_ASSINADOS_SAME doc
                            INNER JOIN assinaturas.TP_DOCUMENTO tp
                                ON tp.NM_DOC = doc.TP_DOCUMENTO
                            $where
                            AND EXTRACT(YEAR FROM doc.HR_CADASTRO) = '$var_periodo_ano'
                            AND EXTRACT(MONTH FROM doc.HR_CADASTRO) = '$var_periodo_mes'
                        ";

    $result_lista_doc = oci_parse($conn_ora, $cons_lista_doc);
    @oci_execute($result_lista_doc);   
?>

    <!--TABELA-->
    <div class="table-responsive col-md-12" style="padding: 0px !important;">

        <table class="table table-striped" cellspacing="0" cellpadding="0">
            
            <thead>
                <!--CABEÇALHO-->
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
                            //VISUALIZAR / ASSINAR DIRETOR CLINICO
                            if(@$_SESSION['sn_usuario_same_diretor'] == 'S'){ 
                                //QUANDO NÃO FOI ACEITO OU RECUSADO
                                if($row_lista_doc['NM_DOC'] == 'same_pendente'){
                                    echo '<a type="button" class="btn btn-primary"
                                                data-toggle="modal" 
                                                data-target="#visualizaModalAssinado" 
                                                data-cd_paciente="'.$row_lista_doc['CD_PACIENTE'].'" 
                                                data-tp_doc="same_pendente" 
                                                data-identificador="guia_same_assinado">
                                    <i class="fas fa-pencil-alt"></i></a>';
                                }
                                //QUANDO FOI ACEITO OU RECUSADO
                                if($row_lista_doc['NM_DOC'] != 'same_pendente'){
                                    echo '<a type="button" class="btn btn-primary" style="background-color: rgba(0, 0, 0, 0) !important; border-color: rgba(0, 0, 0, 0) !important;"
                                                data-toggle="modal" 
                                                data-target="#visualizaModalAssinado" 
                                                data-cd_paciente="'.$row_lista_doc['CD_PACIENTE'].'" 
                                                data-tp_doc="'.$row_lista_doc['TP_DOC'].'"
                                                data-identificador="guia_same_assinado">
                                    <i style="color: '.$row_lista_doc['COR_PENDENCIA'].';" class="'.$row_lista_doc['ICONE'].'"></i></a>';
                            }

                            //VISUALIZAR SAME 
                            }else{
                                echo '<a type="button" class="btn btn-primary"
                                                    data-toggle="modal" 
                                                    data-target="#visualizaModalAssinado" 
                                                    data-cd_paciente="'.$row_lista_doc['CD_PACIENTE'].'" 
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
                                        <a type="button" class="btn btn-primary" target="_blank" href="assinatura_SAME/baixar_pdf.php?nm_doc='. $row_lista_doc['NOME_ANEXO'] . '&tp_permissao=same">'. ' <i class="fas fa-download"></i></a> 
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

    
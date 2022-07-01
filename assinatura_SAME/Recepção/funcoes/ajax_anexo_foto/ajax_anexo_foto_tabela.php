<?php
    //CONEXAO
    include '../../../../conexao.php';
    
    'var_cd_paciente:';
    $var_cd_paciente = $_GET["cd_paciente"]; 
    '<br>';

    //TABELA UNIDADE
    $lista_anaxo_foto = "SELECT aa.CD_ARQUIVO_DOCUMENTO,
                            aa.CD_PACIENTE,
                            aa.DS_NOME_ARQUIVO,
                            aa.CD_USUARIO_CADASTRO,
                            TO_CHAR(aa.HR_CADASTRO,'DD/MM/YYYY HH24:MI') AS DT_CRIACAO
                        FROM assinaturas.ARQUIVO_DOCUMENTO_SAME aa
                        WHERE aa.CD_PACIENTE = $var_cd_paciente
                        ORDER BY TO_CHAR(aa.HR_CADASTRO,'DD/MM/YYYY HH24:MI') DESC
                                                ";

    $result_anaxo_foto  = oci_parse($conn_ora, $lista_anaxo_foto );

    @oci_execute($result_anaxo_foto);

    //<!--TABELA DE RESULTADOS -->
    echo '<div class="table-responsive">';
            
        echo '<table class="table table-fixed table-hover table-striped " cellspacing="0" cellpadding="0">';

            echo '<thead><tr>';
                //<!--COLUNAS-->
                echo '<th class="align-middle" style="text-align: center !important;"><span>Descrição</span></th>';
                echo '<th class="align-middle" style="text-align: center !important;"><span>Usuário</span></th>';
                echo '<th class="align-middle" style="text-align: center !important;"><span>Data Criação</span></th>';
                echo '<th class="align-middle" style="text-align: center !important;"><span>Ações</span></th>';
            echo '</tr></thead> ';           

            echo '<tbody>';
                while($row_anaxo_foto = @oci_fetch_array($result_anaxo_foto)){ 
                    
                    
                echo '<tr>';
                    echo "<td class='align-middle' style='text-align: center;'> ". @$row_anaxo_foto['DS_NOME_ARQUIVO']." </td>";
                    echo "<td class='align-middle' style='text-align: center;'> ". @$row_anaxo_foto['CD_USUARIO_CADASTRO']." </td>";
                    echo "<td class='align-middle' style='text-align: center;'> ". @$row_anaxo_foto['DT_CRIACAO']." </td>";
                    
                    echo '<td style="text-align: center; vertical-align : middle;"> 
                                    <a type="button" class="btn btn-primary" target="_blank" href="assinatura_SAME/Recepção/baixar_anexo_mv.php?nm_doc='. $row_anaxo_foto['CD_ARQUIVO_DOCUMENTO'] . '">'. ' <i class="fas fa-download"></i></a> 
                                    <a id="js_excluir_bras" onclick="excluir_bras('.$row_anaxo_foto['CD_ARQUIVO_DOCUMENTO'].')" class="btn btn-adm"><i class="fa-solid fa-trash"></i></a>
                            </td>'; 
                ?>

                                
<?php
                echo '</tr>';
    
                } 
            echo '</tbody>';         
        echo '</table>';
        echo '</div>';
    
    echo '</div>';

?>
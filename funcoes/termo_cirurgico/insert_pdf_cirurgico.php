<?php

    //INICIANDO CONEXÃO
    include '../../conexao.php';

    //USUARIO LOGADO/DADOS PACIENTE 
    $var_cd_paciente = $_POST['var_paciente'];
    $var_usuario_prestador = $_POST['var_prestador_logado'];
    $atendimento_paciente = $_POST['var_paciente_atd'];
    $nm_prestador_logado = $_POST['var_nome_prest_logado'];

    //RECEBENDO ARQUIVO PDF
    $pdf = $_FILES['pdf'];
    
    //DADOS DO ARQUIVO
    $nomeDoArquivo = $pdf['name'];
    $tipoDoArquivo = $pdf['type'];
    $caminhoTemporario = $pdf['tmp_name'];
    $tamanhoDoArquivo = $pdf['size'];

    //TRATAMENTO
    $extensao_arquivo = strrchr( $tipoDoArquivo, '/' );
    $extencao = str_replace('/','',$extensao_arquivo);

    //DECLARANDO VARIAVEIS DO ARQUIVO PARA IMPORTACAO PARA O BANCO
    $image = file_get_contents($_FILES['pdf']['tmp_name']);


    //PEGANDO CODIGO DO PRESTADOR DO USUARIO LOGADO 
    $consulta_usu_pres = "SELECT U.CD_PRESTADOR FROM DBASGU.USUARIOS U WHERE U.CD_USUARIO = '$var_usuario_prestador'";
    $result_usu_pres = oci_parse($conn_ora, $consulta_usu_pres);
                       oci_execute($result_usu_pres);
    $row_usu_pres = oci_fetch_array($result_usu_pres);

    $var_usu_prestador = $row_usu_pres['CD_PRESTADOR'];


    //PEGANDO SEQUENCE PRIMEIRA TABELA ( ARQUIVO DOCUMENTO )
    $consulta_seq_ad = "SELECT SEQ_ARQUIVO_DOCUMENTO.nextval  as SEQ_ARQUIVO_DOCUMENTO 
                        FROM DUAL";
    $result_seq_ad = oci_parse($conn_ora, $consulta_seq_ad);
                     oci_execute($result_seq_ad);
    $row_seq_ad = oci_fetch_array($result_seq_ad);

    //PEGANDO SEQUENCE SEGUNDA TABELA ( ARQUIVO DOCUMENTO )
    $consulta_seq_aa = "SELECT SEQ_ARQUIVO_ATENDIMENTO.nextval as SEQ_ARQUIVO_ATENDIMENTO 
                        FROM DUAL";
    $result_seq_aa = oci_parse($conn_ora, $consulta_seq_aa);
                     oci_execute($result_seq_aa);
    $row_seq_aa = oci_fetch_array($result_seq_aa);


    //PEGANDO SEQUENCE TERCEIRA TABELA ( ARQUIVO DOCUMENTO )
    $consulta_seq_pdc = "SELECT SEQ_PW_DOCUMENTO_CLINICO.nextval as SEQ_PW_DOCUMENTO_CLINICO 
                         FROM DUAL";
    $result_seq_pdc = oci_parse($conn_ora, $consulta_seq_pdc);
                      oci_execute($result_seq_pdc);
    $row_seq_pdc = oci_fetch_array($result_seq_pdc);
    

    //DEFININDO VARIAVEIS PARA AS SEQUENCES
    $var_seq_arquivo_documento = $row_seq_ad['SEQ_ARQUIVO_DOCUMENTO'];
    echo 'Sequence_arquivo_documento: ' . $var_seq_arquivo_documento;

        echo '</br>';

    $var_seq_arquivo_atendimento = $row_seq_aa['SEQ_ARQUIVO_ATENDIMENTO'];
    echo 'Sequence_arquivo_atendimento: ' . $var_seq_arquivo_atendimento;

        echo '</br>';

    $var_seq_p_doc_clinico = $row_seq_pdc['SEQ_PW_DOCUMENTO_CLINICO'];
    echo 'Sequence_pw_documento_clinico: ' . $var_seq_p_doc_clinico;
    
        echo '</br>';
    
    
    //INICIANDO INSERT
    $consulta_insert_AD = "INSERT INTO dbamv.ARQUIVO_DOCUMENTO 
                                   (cd_arquivo_documento,
                                    tp_extensao,
                                    ds_autor,
                                    ds_origem,
                                    dt_documento,
                                    ds_nome_arquivo,
                                    LO_ARQUIVO_DOCUMENTO)
                            VALUES 
                                   ($var_seq_arquivo_documento,
                                    UPPER('$extencao'),
                                    NULL,
                                    NULL,
                                    NULL,
                                    'TC',
                                    empty_blob()) RETURNING LO_ARQUIVO_DOCUMENTO INTO :image";

    $result_insert_AD = oci_parse($conn_ora, $consulta_insert_AD);
    $blob = oci_new_descriptor($conn_ora, OCI_D_LOB);
    oci_bind_by_name($result_insert_AD, ":image", $blob, -1, OCI_B_BLOB);
    oci_execute($result_insert_AD, OCI_DEFAULT);

    if(!$blob->save($image)) {
    oci_rollback($conn_ora);
    }
    else {
    oci_commit($conn_ora);
    }

    oci_free_statement($result_insert_AD);
    $blob->free();

    ///////////////////////////////////////

    $consulta_insert_pdc = "INSERT INTO PW_DOCUMENTO_CLINICO
    SELECT $var_seq_p_doc_clinico AS CD_DOCUMENTO_CLINICO,
        2 AS CD_TIPO_DOCUMENTO, 
        NULL AS CD_DOCUMENTO_DIGITAL,
        '$var_cd_paciente' AS CD_PACIENTE, 
        '$atendimento_paciente' AS CD_ATENDIMENTO,
        '$var_usuario_prestador' AS CD_USUARIO,
        '$var_usu_prestador' AS CD_PRESTADOR,
        'FECHADO' AS TP_STATUS,
        SYSDATE AS DH_REFERENCIA,
        SYSDATE AS DH_CRIACAO,
        SYSDATE AS DH_FECHAMENTO,
        NULL AS DH_IMPRESSO,
        UPPER('$extencao') AS TP_EXTENSAO,
        NULL AS CD_SETOR,
        222 As CD_OBJETO,
        NULL AS CD_DOCUMENTO_CANCELADO,
        '$nomeDoArquivo' AS NM_DOCUMENTO,
        NULL AS NM_VERSAO_DOCUMENTO,
        SYSDATE AS DH_DOCUMENTO,
        NULL AS CD_DOCUMENTO_CLINICO_NOVO,
        NULL AS CD_DOC_CLINICO_REFERENCIA,
        NULL AS CD_USUARIO_AUTORIZADOR,
        NULL AS SN_INTEGRA_GREEN,
        NULL AS CD_MULTI_EMPRESA,
        NULL AS SN_CONFIDENCIAL,
        NULL AS QT_VIAS_IMPRESSAS
        FROM DUAL";
    $result_insert_pdc = oci_parse($conn_ora, $consulta_insert_pdc);
    oci_execute($result_insert_pdc);

    //////////////////////////////////////////////////////////////
    
    $consulta_insert_AA = "INSERT INTO dbamv.ARQUIVO_ATENDIMENTO
                                SELECT $var_seq_arquivo_atendimento AS CD_ARQUIVO_ATENDIMENTO,
                                       $var_seq_arquivo_documento AS CD_ARQUIVO_DOCUMENTO,
                                       $atendimento_paciente AS CD_ATENDIMENTO,
                                       SYSDATE AS DH_CRIACAO,
                                       '$nm_prestador_logado' AS NM_USUARIO,
                                       NULL AS CD_TIPO_DOCUMENTO, 
                                       $var_cd_paciente AS CD_PACIENTE,
                                       NULL AS CD_PW_TIPO_DOCUMENTO,
                                       $var_seq_p_doc_clinico AS CD_DOCUMENTO_CLINICO,
                                       NULL AS DS_DESCRICAO,
                                       661 AS CD_STATUS_ARQUIVO_ATENDIMENTO,
                                       222 AS CD_OBJETO_SELECIONADO
                                       FROM DUAL";

    $result_insert_AA = oci_parse($conn_ora, $consulta_insert_AA);
    oci_execute($result_insert_AA);
    
?>
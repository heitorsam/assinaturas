<?php 
    //CONEXAO
    include 'conexao.php';

    //@$var_cd_atendimento = $_POST['cd_atendimento'];
    //@$var_cd_atendimento = $_REQUEST['cd_atendimento'];   
    //$var_cd_atendimento = '4326628';
    
    
    //PACIENTE NOME 
    $resp_doc = "SELECT 
                    --PACIENTE NOME
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SCS_NOME_PACIENTE_2_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_NOME,
                    
                    --PACIENTE RG
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'HOSP_REG_PACIENTE_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'   
                    )AS RESP_RG,
                    
                    --PACIENTE CPF
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'CPF_PAC_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_CPF,
                    
                    --PACIENTE NASCIMENTO
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'DT_NASCIMENTO_PACIENTE_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_NASCIMENTO,
                    
                    --PACIENTE PERIODO INTERNAÇÃO
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_MOTIVO_REQUERIMENTO_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_PERIODO_INT,
                    
                    --DADOS CHECK REPRESENTANTE LEGAL
                    (SELECT 
                        CASE
                            WHEN vdic.DS_RESPOSTA = 'true' THEN 'X'
                            ELSE NULL
                        END AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_CHECKBOX_REPRESENTANTE_LEGAL_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_CHECK_REP_LEGAL,
                    
                    --DADOS CHECK CURADOR
                    (SELECT 
                        CASE
                            WHEN vdic.DS_RESPOSTA = 'true' THEN 'X'
                            ELSE NULL
                        END AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_CHECKBOX_TUTOR_CURADOR_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_CHECK_CURADOR,
                    
                    --DADOS CHECK PARENTE
                    (SELECT 
                        CASE
                            WHEN vdic.DS_RESPOSTA = 'true' THEN 'X'
                            ELSE NULL
                        END AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_CHECKBOX_PARENTE_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_CHECK_PARENTE,
                    
                    --REQUERENTE NOME
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'Metadado_P_149481_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_REQUERENTE_NOME,
                    
                    --REQUERENTE RG
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_RG_REQUERENTE_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_REQUERENTE_RG,
                    
                    --REQUERENTE CPF
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_CPF_REQUERENTE_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_REQUERENTE_CPF,  
                    
                    --REQUERENTE NASCIMENTO
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_DATA_NASC_REQUERENTE_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_REQUERENTE_NASC,  
                    
                    --REQUERENTE ESTADO CIVIL
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_ESTADO_CIVIL_REQUERENTE_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_REQUERENTE_EST_CIVIL, 
                    
                    --REQUERENTE PROFISSÃO
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_PROFISSAO_REQUERENTE_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_REQUERENTE_PROFISSAO,  
                    
                    --REQUERENTE BAIRRO
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_ENDERECO_REQUERENTE_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_REQUERENTE_ENDERECO,
                    
                    --PACIENTE NOME
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_BAIRRO_REQUERENTE_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_REQUERENTE_BAIRRO,
                    
                    --REQUERENTE CIDADE
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_CIDADE_REQUERENTE_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_REQUERENTE_CIDADE,  
                    
                    --REQUERENTE ESTADO
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_ESTADO_REQUERENTE_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_REQUERENTE_ESTADO,  
                    
                    --REQUERENTE TELEFONE 1
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_TELEFONE_REQUERENTE_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_REQUERENTE_TELEFONE_1,
                    
                    --REQUERENTE TELEFONE 2
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_TELEFONE_REQUERENTE_2'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_REQUERENTE_TELEFONE_2,
                    
                    --REQUERENTE TELEFONE 3
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_TELEFONE_REQUERENTE_3'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_REQUERENTE_TELEFONE_3,  
                    
                    --MOTIVO REQUERIMENTO
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_MOTIVO_REQUERIMENTO_2'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_MOTIVO_REQUERIMENTO,  
                    
                    --DATA
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'DT_DATA_ATUAL_POR_EXTENSO_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_DATA_EXTENSO,  
                    
                    --AURORIZADO
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_DATA_AUTORIZACAO_REQUERIMENTO_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_DATA_AUTORIZACAO,  
                    
                    --ATENDENTE
                    (SELECT NVL(vdic.DS_RESPOSTA, '____________') AS RESP_NOME
                    FROM dbamv.VDIC_RESPOSTA_METADADO_HEITOR vdic
                    WHERE vdic.CD_DOCUMENTO = '993'
                    AND vdic.DS_IDENTIFICADOR = 'SC_ATENDENTE_REQUERIMENTO_1'
                    AND vdic.CD_PACIENTE = '$var_cd_paciente'
                    )AS RESP_ATENDENTE
                FROM DUAL
    ";
  
    $result_resp_doc= oci_parse($conn_ora, $resp_doc);
    oci_execute($result_resp_doc);
    $dados_result_resp_doc = oci_fetch_array($result_resp_doc);


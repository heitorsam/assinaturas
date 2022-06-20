<?php 
    //CONEXAO
    include 'conexao.php';

    //@$var_cd_atendimento = $_POST['cd_atendimento'];
    //@$var_cd_atendimento = $_REQUEST['cd_atendimento'];   
    //$var_cd_atendimento = '4326628';
    
    
    //PACIENTE NOME 
    $resp_doc = " SELECT doc_req.CD_PACIENTE,
                        doc_req.PACIENTE_NOME,
                        doc_req.PACIENTE_RG,
                        doc_req.PACIENTE_CPF,
                        TO_CHAR(doc_req.PACIENTE_NASCIMENTO, 'DD/MM/YYYY') AS PACIENTE_NASCIMENTO,
                        TO_CHAR(doc_req.PERIODO_MINIMO, 'DD/MM/YYYY') AS PERIODO_MINIMO,
                        TO_CHAR(doc_req.PERIODO_MAXIMO, 'DD/MM/YYYY') AS PERIODO_MAXIMO,
                        doc_req.REQUERENTE_ESCOLHA,
    
                        doc_req.REQUERENTE_PARENTE,
                        
                        CASE
                        WHEN doc_req.REQUERENTE_ESCOLHA = 'Paciente' THEN
                        'X'
                        ELSE
                        NULL
                        END AS RADIO_PACIENTE,
                        
                        CASE
                        WHEN doc_req.REQUERENTE_ESCOLHA = 'Representante Legal' THEN
                        'X'
                        ELSE
                        NULL
                        END AS RADIO_REP_LEGAL,
                        
                        CASE
                        WHEN doc_req.REQUERENTE_ESCOLHA = 'Tutor ou Curador' THEN
                        'X'
                        ELSE
                        NULL
                        END AS RADIO_TUTOR_CURADOR,
                        
                        CASE
                        WHEN doc_req.REQUERENTE_ESCOLHA = 'Parente' THEN
                        'X'
                        ELSE
                        NULL
                        END AS RADIO_PARENTE,
                        
                        doc_req.REQUERENTE_NOME,
                        doc_req.REQUERENTE_RG,
                        doc_req.REQUERENTE_CPF,
                        TO_CHAR(doc_req.REQUERENTE_NASCIMENTO, 'DD/MM/YYYY') AS REQUERENTE_NASCIMENTO,
                        doc_req.REQUERENTE_ESTADO_CIVIL,
                        doc_req.REQUERENTE_PROFISSAO,
                        doc_req.REQUERENTE_CEP,
                        doc_req.REQUERENTE_CIDADE,
                        doc_req.REQUERENTE_ESTADO,
                        doc_req.REQUERENTE_RUA,
                        doc_req.REQUERENTE_BAIRRO,
                        doc_req.REQUERENTE_TEL_PRIMARIO,
                        doc_req.REQUERENTE_TEL_SECUNDARIO,
                        doc_req.REQUERENTE_TEL_TERCIARIO,
                        doc_req.REQUERENTE_MOTIVO
                    FROM assinaturas.DOCUMENTO_REQUERENTE doc_req
                    WHERE CD_PACIENTE = 649081
    ";
  
    $result_resp_doc= oci_parse($conn_ora, $resp_doc);
    oci_execute($result_resp_doc);
    $dados_result_resp_doc = oci_fetch_array($result_resp_doc);


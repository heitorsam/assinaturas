<?php 
    //CONEXAO
    include 'conexao.php';

    //@$var_cd_atendimento = $_POST['cd_atendimento'];
    //@$var_cd_atendimento = $_REQUEST['cd_atendimento'];   
    //$var_cd_atendimento = '4326628';
    
    
    //PACIENTE NOME 
    $resp_doc = " SELECT doc.CD_PACIENTE,
                        doc.PACIENTE_NOME,
                        doc.PACIENTE_RG,
                        doc.PACIENTE_CPF,
                        TO_CHAR(doc.PACIENTE_NASCIMENTO, 'DD/MM/YYYY') AS PACIENTE_NASCIMENTO,
                        TO_CHAR(doc.PERIODO_MINIMO, 'DD/MM/YYYY') AS PERIODO_MINIMO,
                        TO_CHAR(doc.PERIODO_MAXIMO, 'DD/MM/YYYY') AS PERIODO_MAXIMO,
                        doc.REQUERENTE_ESCOLHA,
    
                        doc.REQUERENTE_PARENTE,
                        
                        CASE
                        WHEN doc.REQUERENTE_ESCOLHA = 'Paciente' THEN
                        'X'
                        ELSE
                        NULL
                        END AS RADIO_PACIENTE,
                        
                        CASE
                        WHEN doc.REQUERENTE_ESCOLHA = 'Representante Legal' THEN
                        'X'
                        ELSE
                        NULL
                        END AS RADIO_REP_LEGAL,
                        
                        CASE
                        WHEN doc.REQUERENTE_ESCOLHA = 'Tutor ou Curador' THEN
                        'X'
                        ELSE
                        NULL
                        END AS RADIO_TUTOR_CURADOR,
                        
                        CASE
                        WHEN doc.REQUERENTE_ESCOLHA = 'Parente' THEN
                        'X'
                        ELSE
                        NULL
                        END AS RADIO_PARENTE,
                        
                        doc.REQUERENTE_NOME,
                        doc.REQUERENTE_RG,
                        doc.REQUERENTE_CPF,
                        TO_CHAR(doc.REQUERENTE_NASCIMENTO, 'DD/MM/YYYY') AS REQUERENTE_NASCIMENTO,
                        doc.REQUERENTE_ESTADO_CIVIL,
                        doc.REQUERENTE_PROFISSAO,
                        doc.REQUERENTE_CEP,
                        doc.REQUERENTE_CIDADE,
                        doc.REQUERENTE_ESTADO,
                        doc.REQUERENTE_RUA,
                        doc.REQUERENTE_BAIRRO,
                        doc.REQUERENTE_TEL_PRIMARIO,
                        doc.REQUERENTE_TEL_SECUNDARIO,
                        doc.REQUERENTE_TEL_TERCIARIO,
                        doc.REQUERENTE_MOTIVO,
                        doc.CD_USUARIO_CADASTRO,
                        TO_CHAR(doc.HR_CADASTRO, 'DD/MM/YYYY HH24:MM') AS HR_CADASTRO,
                        'São José dos Campos ' || TO_CHAR(SYSDATE, 'DD/MM/YYYY') AS DATA_EXTENSO

                    FROM assinaturas.DOCUMENTO_REQUERENTE doc
                    WHERE CD_PACIENTE = $var_cd_paciente
    ";
  
    $result_resp_doc= oci_parse($conn_ora, $resp_doc);
    oci_execute($result_resp_doc);
    $dados_result_resp_doc = oci_fetch_array($result_resp_doc);


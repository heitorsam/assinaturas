<?php 
    //CONEXAO
    include 'conexao.php';

    //@$var_cd_atendimento = $_POST['cd_atendimento'];
    //@$var_cd_atendimento = $_REQUEST['cd_atendimento'];   

    //CONSULTA 
    $pac_resp = "SELECT atd.CD_ATENDIMENTO AS ATENDIMENTO,
                    TO_CHAR(atd.HR_ATENDIMENTO,'DD/MM/YYYY HH24:MI') AS DT_ATENDIMENTO,
                    pac.CD_PACIENTE AS PRONTUARIO,

                    pac.NM_PACIENTE AS NOME_PACIENTE,
                    NVL(pac.NR_IDENTIDADE, '___________') AS RG_PACIENTE,
                    NVL(pac.NR_CPF, '___________') AS CPF_PACIENTE,
                    pac.DS_ENDERECO AS ENDERECO_PACIENTE,
                    pac.NR_ENDERECO AS NUMERO_ENDERECO_PACIENTE,
                    NVL(pac.NR_CELULAR, '___________') AS TELEFONE_PACIENTE,
                                            

                    NVL(resp.NM_RESPONSAVEL, pac.NM_PACIENTE) AS NOME_RESPONSAVEL,
                    NVL(resp.DS_DOCUMENTO, pac.NR_IDENTIDADE) AS RG_RESPONSAVEL, 
                    NVL(resp.NR_CPF, pac.NR_CPF) AS CPF_RESPONSAVEL,   
                    NVL(resp.NR_FONE, pac.NR_CELULAR) AS TELEFONE_RESPONSAVEL, 
                    NVL(resp.DS_ENDERECO, pac.DS_ENDERECO) AS ENDERECO_RESPONSAVEL,
                    NVL(resp.NR_ENDERECO, pac.NR_ENDERECO) AS NUMERO_ENDERECO_RESPONSAVEL

                FROM dbamv.ATENDIME atd
                INNER JOIN dbamv.PACIENTE pac
                ON pac.CD_PACIENTE = atd.CD_PACIENTE
                LEFT JOIN dbamv.RESPONSA resp
                ON resp.CD_ATENDIMENTO = atd.CD_ATENDIMENTO
                WHERE atd.CD_ATENDIMENTO = '$var_cd_atendimento'";
                            
    $result_pac_resp = oci_parse($conn_ora, $pac_resp);
    oci_execute($result_pac_resp);
    $dados_pac_resp = oci_fetch_array($result_pac_resp);

?>
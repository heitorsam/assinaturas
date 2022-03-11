<?php 
    //CONEXAO
    include 'conexao.php';

    //@$var_cd_atendimento = $_POST['cd_atendimento'];
    //@$var_cd_atendimento = $_REQUEST['cd_atendimento'];   
    //$var_cd_atendimento = '4326628';
    //CONSULTA 
    $fa_ficha = "SELECT atd.CD_ATENDIMENTO     AS ATENDIMENTO,
                        pac.CD_PACIENTE        AS PRONTUARIO,
                        atd.DT_ATENDIMENTO     AS DATA_ATENDIMENTO,
                        TO_CHAR(atd.HR_ATENDIMENTO,'HH24:MI') AS HORA_ATENDIMENTO,
                        ori.DS_ORI_ATE         AS ORIGEM_ATENDIMENTO,
                        atd.NR_CHAMADA_PAINEL  AS NUMERO_CHAMADA,
                        pac.NM_PACIENTE        AS PACIENTE,
                        TO_CHAR(pac.DT_NASCIMENTO,'DD/MM/YYYY') || ' ' AS DATA_NASCIMENTO,
                        CASE 
                            WHEN pac.TP_SEXO = 'M' THEN 'MASCULINO' 
                            WHEN pac.TP_SEXO = 'F' THEN 'FEMININO'
                            WHEN pac.TP_SEXO = 'G' THEN 'IGNORADO'
                            WHEN pac.TP_SEXO = 'I' THEN 'IDEFINIDO'
                            ELSE ' '
                        END AS SEXO,
                        pac.NR_IDENTIDADE      AS RG,
                        pac.NR_CPF             AS CPF,
                        pac.NR_CNS             AS CNS,
                        pac.NM_MAE             AS NOME_MAE,
                        conv.NM_CONVENIO       AS CONVEINO,
                        atd.NR_CARTEIRA        AS NUMERO_CARTEIRINHA

                FROM dbamv.ATENDIME atd
                INNER JOIN dbamv.PACIENTE pac
                ON pac.CD_PACIENTE = atd.CD_PACIENTE
                INNER JOIN dbamv.ORI_ATE ori
                ON ori.CD_ORI_ATE = atd.CD_ORI_ATE
                INNER JOIN dbamv.CONVENIO conv
                ON conv.CD_CONVENIO = atd.CD_CONVENIO
                WHERE atd.CD_ATENDIMENTO = '$var_cd_atendimento'";
       
    $result_fa_ficha = oci_parse($conn_ora, $fa_ficha);
    oci_execute($result_fa_ficha);
    $dados_pac_resp = oci_fetch_array($result_fa_ficha);

?>


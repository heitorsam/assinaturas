<?php 
    //CONEXAO
    include 'conexao.php';

    //@$var_cd_atendimento = $_POST['cd_atendimento'];
    //@$var_cd_atendimento = $_REQUEST['cd_atendimento'];   
    //$var_cd_atendimento = '4326628';
    //CONSULTA 
    $cart_golpe = "SELECT pac.NM_PACIENTE AS NOME, 
                        NVL(pac.NR_DOCUMENTO, '') as RG
                FROM dbamv.ATENDIME atd
                INNER JOIN dbamv.PACIENTE pac
                ON pac.CD_PACIENTE = atd.CD_PACIENTE
                WHERE atd.CD_ATENDIMENTO = '$var_cd_atendimento'
    ";
   
       
    $result_cart_golpe = oci_parse($conn_ora, $cart_golpe);
    oci_execute($result_cart_golpe);
    $dados_result_cart_golpe = oci_fetch_array($result_cart_golpe);

    $term_cirurgia = "SELECT
                    pac.NM_PACIENTE                                     AS PACIENTE,
                    pac.NR_IDENTIDADE                                   AS RG,
                    pac.NR_CPF                                          AS CPF,
                    pac.DS_ENDERECO || ' N° ' || pac.NR_ENDERECO        AS ENDERECO, 
                    cid.NM_CIDADE AS CIDADE,                               
                    cid.CD_UF AS ESTADO,                              
                    pac.NR_CEP AS CEP,
                    cida.DS_CIDADANIA AS CIDADANIA,                                  
                    EXTRACT (DAY FROM atd.DT_ATENDIMENTO)               AS DIA_ATD,
                    EXTRACT (MONTH FROM atd.DT_ATENDIMENTO)             AS MES_ATD,
                    EXTRACT (YEAR FROM atd.DT_ATENDIMENTO)              AS ANO_ATD,
                    
                    CASE
                    WHEN EXTRACT (MONTH FROM atd.DT_ATENDIMENTO) = '1' THEN 'JANEIRO'
                    WHEN EXTRACT (MONTH FROM atd.DT_ATENDIMENTO) = '2' THEN 'FEVEREIRO'
                    WHEN EXTRACT (MONTH FROM atd.DT_ATENDIMENTO) = '3' THEN 'MARÇO'
                    WHEN EXTRACT (MONTH FROM atd.DT_ATENDIMENTO) = '4' THEN 'ABRIL'
                    WHEN EXTRACT (MONTH FROM atd.DT_ATENDIMENTO) = '5' THEN 'MAIO'
                    WHEN EXTRACT (MONTH FROM atd.DT_ATENDIMENTO) = '6' THEN 'JUNHO'
                    WHEN EXTRACT (MONTH FROM atd.DT_ATENDIMENTO) = '7' THEN 'JULHO'
                    WHEN EXTRACT (MONTH FROM atd.DT_ATENDIMENTO) = '8' THEN 'AGOSTO'
                    WHEN EXTRACT (MONTH FROM atd.DT_ATENDIMENTO) = '9' THEN 'SETEMBRO'
                    WHEN EXTRACT (MONTH FROM atd.DT_ATENDIMENTO) = '10' THEN 'OUTUBRO'
                    WHEN EXTRACT (MONTH FROM atd.DT_ATENDIMENTO) = '11' THEN 'NOVEMBRO'
                    WHEN EXTRACT (MONTH FROM atd.DT_ATENDIMENTO) = '12' THEN 'DEZEMBRO'
                    END AS MES_EXTENSO
                    
                    FROM dbamv.ATENDIME atd
                    INNER JOIN dbamv.PACIENTE pac
                      ON pac.CD_PACIENTE = atd.CD_PACIENTE
                    INNER JOIN dbamv.CIDADE cid
                      ON cid.CD_CIDADE = pac.CD_CIDADE
                    INNER JOIN dbamv.CIDADANIAS cida
                      ON cida.CD_CIDADANIA = pac.CD_CIDADANIA
                    WHERE atd.CD_ATENDIMENTO = '$var_cd_atendimento'
    ";
   
       
    $result_term_cirurgia = oci_parse($conn_ora, $term_cirurgia);
    oci_execute($result_term_cirurgia); 
    $dados_result_term_cirurgia = oci_fetch_array($result_term_cirurgia);

?>


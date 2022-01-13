<?php

    //CONEXAO
    include 'conexao.php';

    $data_check = $_POST['data1'];
    $cd_prest = $_POST['Prestador'];
    $cd_atd = $_POST['Atendimento'];
    $var_cd_usuario = $_SESSION['usuarioLogin'];

    //echo '</br></br>';
    $cons_checagem_prest = "SELECT atd.CD_ATENDIMENTO,
                            TO_CHAR(ck.DH_CHECAGEM, 'DD/MM/YYYY HH24:MI:SS') AS DH_CHECAGEM,
                            TO_CHAR(ck.DH_CHECAGEM, 'HH24'),
                            TO_CHAR(ck.DH_CHECAGEM, 'DD/MM/YYYY') AS DT_CHECAGEM,
                            TO_CHAR(ck.DH_CHECAGEM, 'MM') AS MES_CHECAGEM,
                            TO_CHAR(ck.DH_CHECAGEM, 'YYYY') AS ANO_CHECAGEM,
                            pac.CD_PACIENTE, pac.NM_PACIENTE, TO_CHAR(pac.DT_NASCIMENTO,'DD/MM/YYYY') AS DT_NASCIMENTO, EXTRACT(YEAR FROM SYSDATE) - EXTRACT(YEAR FROM pac.DT_NASCIMENTO) AS DS_IDADE,
                            conv.CD_CONVENIO, conv.NM_CONVENIO,
                            lt_set.CD_LEITO, lt_set.DS_LEITO,
                            lt_set.CD_UNID_INT, lt_set.DS_UNID_INT,
                            lt_set.CD_SETOR, lt_set.NM_SETOR,
                            CASE
                            WHEN TO_CHAR(ck.DH_CHECAGEM, 'HH24') IN ('07','08','09','7','8','9','10','11','12','13','14','15','16','17','18') THEN 1
                            ELSE 2
                            END AS CD_TP_PERIODO,
                            CASE
                            WHEN TO_CHAR(ck.DH_CHECAGEM, 'HH24') IN ('07','08','09','7','8','9','10','11','12','13','14','15','16','17','18') THEN 'DIURNO'
                            ELSE 'NOTURNO'
                            END AS TP_PERIODO,
                            tp.CD_TIP_PRESC, tp.DS_TIP_PRESC,
                            itpm.DS_NPADRONIZADO,
                            itpm.CD_FOR_APL, tf.DS_TIP_FRE AS DS_TIP_FRE_RESUMIDA, up.DS_UNIDADE,
                            usu.CD_USUARIO, usu.NM_USUARIO,
                            prest.CD_PRESTADOR,
                            prest.TP_PRESTADOR, 
                            tipa.NM_TIP_PRESTA,
                            prest.DS_CODIGO_CONSELHO,
                            esq.CD_TIP_ESQ, esq.DS_TIP_ESQ,
                            COUNT(ck.QT_CONSUMO) AS QTD_CHECAGEM
                            FROM dbamv.HRITPRE_CONS ck
                            INNER JOIN dbamv.ITPRE_MED itpm
                            ON itpm.CD_ITPRE_MED = ck.CD_ITPRE_MED
                            INNER JOIN dbamv.PRE_MED pm
                            ON pm.CD_PRE_MED = itpm.CD_PRE_MED
                            INNER JOIN dbamv.ATENDIME atd
                            ON atd.CD_ATENDIMENTO = pm.CD_ATENDIMENTO
                            INNER JOIN (SELECT mi.CD_ATENDIMENTO, mi.CD_LEITO,
                                        mi.CD_LEITO_ANTERIOR, lt.DS_LEITO,
                                        unid.CD_UNID_INT, unid.DS_UNID_INT,
                                        st.CD_SETOR, st.NM_SETOR,
                                        mi.HR_MOV_INT AS DT_ENTRADA,
                                        NVL((SELECT MIN(HR_MOV_INT) -1/(24*60*60)
                                            FROM MOV_INT
                                            WHERE CD_ATENDIMENTO = mi.CD_ATENDIMENTO
                                            AND CD_LEITO_ANTERIOR = mi.CD_LEITO
                                            AND HR_MOV_INT >= mi.HR_MOV_INT), SYSDATE) AS DT_SAIDA
                                        FROM MOV_INT mi
                                        INNER JOIN dbamv.LEITO lt
                                        ON lt.CD_LEITO = mi.CD_LEITO
                                        INNER JOIN dbamv.UNID_INT unid
                                        ON unid.CD_UNID_INT = lt.CD_UNID_INT
                                        INNER JOIN dbamv.SETOR st
                                        ON st.CD_SETOR = unid.CD_SETOR
                                        WHERE mi.CD_ATENDIMENTO IS NOT NULL) lt_set
                            ON lt_set.CD_ATENDIMENTO = atd.CD_ATENDIMENTO
                            AND ck.DH_CHECAGEM BETWEEN lt_set.DT_ENTRADA AND lt_set.DT_SAIDA
                            INNER JOIN dbamv.PACIENTE pac
                            ON pac.CD_PACIENTE = atd.CD_PACIENTE
                            INNER JOIN dbamv.CONVENIO conv
                            ON conv.CD_CONVENIO = atd.CD_CONVENIO
                            INNER JOIN dbamv.TIP_PRESC tp
                            ON tp.CD_TIP_PRESC = itpm.CD_TIP_PRESC
                            INNER JOIN dbasgu.USUARIOS usu
                            ON usu.CD_USUARIO = ck.NM_USUARIO
                            INNER JOIN dbamv.PRESTADOR prest
                            ON prest.CD_PRESTADOR = usu.CD_PRESTADOR
                            LEFT JOIN dbamv.UNI_PRO up
                            ON up.CD_UNI_PRO = itpm.CD_UNI_PRO
                            LEFT JOIN dbamv.TIP_FRE tf
                            ON tf.CD_TIP_FRE = itpm.CD_TIP_FRE
                            LEFT JOIN dbamv.TIP_ESQ esq
                            ON esq.CD_TIP_ESQ = tp.CD_TIP_ESQ
                            LEFT JOIN dbamv.TIP_PRESTA tipa
                            ON tipa.CD_TIP_PRESTA = prest.CD_TIP_PRESTA
                            
                            WHERE TO_CHAR(ck.DH_CHECAGEM,'DD/MM/YYYY') = '$data_check'
                            AND atd.cd_atendimento = '$cd_atd'
                            AND prest.CD_PRESTADOR = '$cd_prest'
                            AND ck.SN_SUSPENSO <> 'S'
                        
                            GROUP BY atd.CD_ATENDIMENTO,
                            TO_CHAR(ck.DH_CHECAGEM, 'DD/MM/YYYY HH24:MI:SS'),
                            TO_CHAR(ck.DH_CHECAGEM, 'HH24'),
                            TO_CHAR(ck.DH_CHECAGEM, 'DD/MM/YYYY'),
                            TO_CHAR(ck.DH_CHECAGEM, 'MM'),
                            TO_CHAR(ck.DH_CHECAGEM, 'YYYY'),
                            pac.CD_PACIENTE, pac.NM_PACIENTE, pac.DT_NASCIMENTO,
                            EXTRACT(YEAR FROM SYSDATE) - EXTRACT(YEAR FROM pac.DT_NASCIMENTO),
                            conv.CD_CONVENIO, conv.NM_CONVENIO,
                            lt_set.CD_LEITO, lt_set.DS_LEITO,
                            lt_set.CD_UNID_INT, lt_set.DS_UNID_INT,
                            lt_set.CD_SETOR, lt_set.NM_SETOR,
                            CASE
                            WHEN TO_CHAR(ck.DH_CHECAGEM, 'HH24') IN ('07','08','09','7','8','9','10','11','12','13','14','15','16','17','18') THEN 1
                            ELSE 2
                            END,
                            CASE
                            WHEN TO_CHAR(ck.DH_CHECAGEM, 'HH24') IN ('07','08','09','7','8','9','10','11','12','13','14','15','16','17','18') THEN 'DIURNO'
                            ELSE 'NORTURNO'
                            END,
                            tp.CD_TIP_PRESC, tp.DS_TIP_PRESC,
                            usu.CD_USUARIO, usu.NM_USUARIO,
                            prest.CD_PRESTADOR,
                            prest.TP_PRESTADOR, prest.DS_CODIGO_CONSELHO, atd.CD_ATENDIMENTO,
                            TO_CHAR(ck.DH_CHECAGEM, 'DD/MM/YYYY'),
                            TO_CHAR(ck.DH_CHECAGEM, 'MM'),
                            TO_CHAR(ck.DH_CHECAGEM, 'YYYY'),
                            pac.CD_PACIENTE, pac.NM_PACIENTE, TO_CHAR(pac.DT_NASCIMENTO,'DD/MM/YYYY'),
                            conv.CD_CONVENIO, conv.NM_CONVENIO,
                            lt_set.CD_LEITO, lt_set.DS_LEITO,
                            lt_set.CD_UNID_INT, lt_set.DS_UNID_INT,
                            lt_set.CD_SETOR, lt_set.NM_SETOR,
                            CASE
                            WHEN TO_CHAR(ck.DH_CHECAGEM, 'HH24') IN ('07','08','09','7','8','9','10','11','12','13','14','15','16','17','18') THEN 1
                            ELSE 2
                            END,
                            CASE
                            WHEN TO_CHAR(ck.DH_CHECAGEM, 'HH24') IN ('07','08','09','7','8','9','10','11','12','13','14','15','16','17','18') THEN 'DIURNO'
                            ELSE 'NOTURNO'
                            END,
                            tp.CD_TIP_PRESC, tp.DS_TIP_PRESC,
                            itpm.DS_NPADRONIZADO,
                            itpm.CD_FOR_APL, tf.DS_TIP_FRE, up.DS_UNIDADE,
                            usu.CD_USUARIO, usu.NM_USUARIO,
                            prest.TP_PRESTADOR, 
                            tipa.NM_TIP_PRESTA,
                            prest.DS_CODIGO_CONSELHO,
                            esq.CD_TIP_ESQ, esq.DS_TIP_ESQ
                            ORDER BY TO_CHAR(ck.DH_CHECAGEM, 'DD/MM/YYYY HH24:MI:SS')  ASC";


    @$result_checagem_prest = oci_parse($conn_ora, @$cons_checagem_prest);
    @oci_execute(@$result_checagem_prest);
    @$row_checagem_prest = oci_fetch_array($result_checagem_prest);

    //SQL BUSCA ASSINATURA
    $cons_assinatura_prest = "SELECT ASSINATURA_TISS, ASSINATURA
                                FROM dbamv.prestador_assinatura
                                WHERE CD_PRESTADOR = $cd_prest ";

    @$result_assinatura_prest = oci_parse($conn_ora, @$cons_assinatura_prest);
    @oci_execute(@$result_assinatura_prest);
    @$row_assinatura_prest = oci_fetch_array($result_assinatura_prest);
    @$assinatura = @$row_assinatura_prest['ASSINATURA_TISS']->load();

?>
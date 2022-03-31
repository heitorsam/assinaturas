<?php 
    //CONEXAO
    include 'conexao.php';

    //@$var_cd_atendimento = $_POST['cd_atendimento'];
    //@$var_cd_atendimento = $_REQUEST['cd_atendimento'];   
    //$var_cd_atendimento = '4238415';

    //CONSULTA 
    $guia_cons = "SELECT 
                    TISS_GUIA.NR_REGISTRO_OPERADORA_ANS AS CP_01, TISS_GUIA.NR_GUIA AS CP_02, 
                    TISS_GUIA.NR_GUIA_OPERADORA AS CP_03, TISS_GUIA.NR_CARTEIRA AS CP_04, 
                    TISS_GUIA.DT_VALIDADE AS CP_05, 'N' AS CP_06,
                    TISS_GUIA.NM_PACIENTE AS CP_07, TISS_GUIA.NR_CNS AS CP_08, 
                    TISS_GUIA.CD_OPERADORA_EXE AS CP_09, TISS_GUIA.NM_PRESTADOR_EXE_COMPL AS CP_10, 
                    TISS_GUIA.CD_CNES_EXE AS CP_11, TISS_GUIA.NM_PRESTADOR_EXE AS CP_12, 
                    TISS_GUIA.DS_CONSELHO_EXE AS CP_13, TISS_GUIA.DS_CODIGO_CONSELHO_EXE AS CP_14, 
                    TISS_GUIA.UF_CONSELHO_EXE AS CP_15, TISS_GUIA.CD_CBOS_EXE AS CP_16, 
                    TISS_GUIA.TP_ACIDENTE AS CP_17, TISS_GUIA.DH_ATENDIMENTO AS CP_18, 
                    TISS_GUIA.TP_CONSULTA AS CP_19, TISS_GUIA.TP_TAB_FAT_CO AS CP_20, 
                    TISS_GUIA.CD_PROCEDIMENTO_CO AS CP_21, '' AS CP_22,
                    '' AS CP_23, '' AS CP_24, '' AS CP_25, TISS_GUIA.CD_CONVENIO,
                    NVL(TISS_GUIA.CD_REG_FAT, TISS_GUIA.CD_REG_AMB) AS CD_CONTA
                    --SELECT *
                    FROM TISS_GUIA
                    WHERE TISS_GUIA.ID          IN (SELECT ID
                                                FROM dbamv.TISS_GUIA tg
                                                WHERE tg.CD_ATENDIMENTO = '$var_cd_atendimento')";
       
    $result_guia_cons = oci_parse($conn_ora, $guia_cons);
    oci_execute($result_guia_cons);
    $row_cons_guia_consulta = oci_fetch_array($result_guia_cons);
    
    //PEGAR LOGO DO CONVÊNIO
    @$cd_convenio = $row_cons_guia_consulta['CD_CONVENIO'];

    $cons_logo_con="SELECT con.logotipo, NVL(LENGTH(con.logotipo),0) AS CARACT
                    FROM dbamv.convenio con
                    WHERE con.cd_convenio = '$cd_convenio'";

    @$result_cons_logo_con = oci_parse($conn_ora, $cons_logo_con);
    @oci_execute($result_cons_logo_con);
    @$row_cons_logo_con = oci_fetch_array($result_cons_logo_con);

    if($row_cons_logo_con['CARACT'] > 0){
        @$image = @$row_cons_logo_con['LOGOTIPO']->load();
    }else{
        @$image = '';
    }

    
?>


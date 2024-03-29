<?php 
    //CONEXAO
    include 'conexao.php';

    @$var_cd_atendimento = $_POST['cd_atendimento'];
    @$var_cd_atendimento = $_REQUEST['cd_atendimento'];
    

    //CONSULTA ID
    $cons_id = "SELECT LPAD(ID,15,0) as ID
                FROM dbamv.tiss_itguia
                WHERE ID_PAI in( SELECT ID
                                FROM dbamv.TISS_GUIA tg
                                WHERE tg.CD_ATENDIMENTO = $var_cd_atendimento)";

    $result_cons_id = oci_parse($conn_ora, $cons_id);
    @oci_execute($result_cons_id);
    @$id_guia = oci_fetch_array($result_cons_id);

    @$id_guia_00 = $id_guia['ID'];

    //ID PAI

    $cons_id_pai = "SELECT ID_PAI
                FROM dbamv.TISS_GUIA tg
                WHERE tg.CD_ATENDIMENTO = $var_cd_atendimento";

    $result_cons_id_pai = oci_parse($conn_ora, $cons_id_pai);
    @oci_execute($result_cons_id_pai);
    @$id_pai_guia = oci_fetch_array($result_cons_id_pai);

    @$id_pai = $id_pai_guia['ID_PAI'];

    //Consulta maior
    $cons_guia_tiss="SELECT  ROWNUM  FOLHA
    , USER                                                                  USUARIO_LOGADO
    , TISS_GUIA.ID                                                          ID_GUIA
    , TISS_GUIA.CD_ATENDIMENTO                                              CD_ATENDIMENTO
    , NVL(TISS_GUIA.CD_REG_FAT, TISS_GUIA.CD_REG_AMB)                       CD_CONTA
    , TISS_GUIA.CD_CONVENIO                                                 CD_CONVENIO
    , NVL(TISS_GUIA.NR_GUIA_OPERADORA,TISS_GUIA.NR_GUIA)                    F_NR_GUIA
    , TISS_GUIA.NR_REGISTRO_OPERADORA_ANS                                   CP_01
    , TISS_GUIA.NR_GUIA                                                     CP_02
    , TISS_GUIA.NR_GUIA_PRINCIPAL                                           CP_03
    , DBAMV.PKG_TISS_UTIL.F_DT(TISS_GUIA.DT_AUTORIZACAO,'DT')               CP_04
    , TISS_GUIA.CD_SENHA                                                    CP_05
    , DBAMV.PKG_TISS_UTIL.F_DT(TISS_GUIA.DT_VALIDADE_AUTORIZADA,'DT')       CP_06
    , TISS_GUIA.NR_GUIA_OPERADORA                                           CP_07
    , TISS_GUIA.NR_CARTEIRA                                                 CP_08
    , DBAMV.PKG_TISS_UTIL.F_DT(TISS_GUIA.DT_VALIDADE,'DT')                  CP_09
    , TISS_GUIA.NM_PACIENTE                                                 CP_10
    , TISS_GUIA.NR_CNS                                                      CP_11
    , TISS_GUIA.SN_ATENDIMENTO_RN                                           CP_12
    , NVL(NVL(TISS_GUIA.CD_CGC_CONTRATADO
        , TISS_GUIA.CD_CPF_CONTRATADO)
            , TISS_GUIA.CD_OPERADORA_CONTRATADO)                            CP_13
    , TISS_GUIA.NM_PRESTADOR_CONTRATADO                                     CP_14
    , TISS_GUIA.NM_PRESTADOR_SOL                                            CP_15
    , TISS_GUIA.DS_CONSELHO_SOL                                             CP_16
    , TISS_GUIA.DS_CODIGO_CONSELHO_SOL                                      CP_17
    , TISS_GUIA.UF_CONSELHO_SOL                                             CP_18
    , TISS_GUIA.CD_CBOS_SOL                                                 CP_19
    , TISS_GUIA.CD_CARATER_SOLICITACAO                                      CP_21
    , DBAMV.PKG_TISS_UTIL.F_DT(TISS_GUIA.DH_ATENDIMENTO,'DT')               CP_22
    , TISS_GUIA.DS_HDA                                                      CP_23
    , NVL(NVL(TISS_GUIA.CD_OPERADORA_EXE,TISS_GUIA.CD_CPF_EXE)
             ,TISS_GUIA.CD_CGC_EXE)                                         CP_29
    , TISS_GUIA.NM_PRESTADOR_EXE                                            CP_30
    , TISS_GUIA.CD_CNES_EXE                                                 CP_31
    , TISS_GUIA.TP_ATENDIMENTO                                              CP_32
    , TISS_GUIA.TP_ACIDENTE                                                 CP_33
    , TISS_GUIA.TP_CONSULTA                                                 CP_34
    , TISS_GUIA.CD_MOTIVO_ALTA                                              CP_35
    , TISS_GUIA.DS_OBSERVACAO                                               CP_58
    , TISS_GUIA.VL_TOT_SERVICOS                                             CP_59
    , TISS_GUIA.VL_TOT_TAXAS                                                CP_60
    , TISS_GUIA.VL_TOT_MATERIAIS                                            CP_61
    , TISS_GUIA.VL_TOT_OPME                                                 CP_62
    , TISS_GUIA.VL_TOT_MEDICAMENTOS                                         CP_63
    , TISS_GUIA.VL_TOT_GASES                                                CP_64
    , TISS_GUIA.VL_TOT_GERAL                                                CP_65
    , TISS_GUIA.DS_OBSERVACAO                                               CP_66
    , CONVENIO.NM_CONVENIO                                                  NM_CONVENIO
    , CONVENIO.CD_CONVENIO                                                  CD_CONVENIO
FROM DBAMV.TISS_GUIA
   , DBAMV.TISS_ITGUIA
   , DBAMV.CONVENIO
WHERE TISS_GUIA.ID          = TISS_ITGUIA.ID_PAI(+)
 AND TISS_GUIA.CD_CONVENIO = CONVENIO.CD_CONVENIO
 AND TISS_GUIA.ID          IN (SELECT ID
                              FROM dbamv.TISS_GUIA tg
                              WHERE tg.CD_ATENDIMENTO = $var_cd_atendimento)
 AND ROWNUM               <= 1
ORDER BY ID_GUIA
      , FOLHA
";

    @$result_cons_guia_tiss = oci_parse($conn_ora, $cons_guia_tiss);
    @oci_execute($result_cons_guia_tiss);
    @$row_cons_guia_tiss = oci_fetch_array($result_cons_guia_tiss);

    @$nm_guia = $row_cons_guia_tiss['CP_02'];

    //PEGAR LOGO DO CONVÊNIO
    @$cd_convenio = $row_cons_guia_tiss['CD_CONVENIO'];

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

     //Consulta do 47-53
    $cons_guia_tiss_47_53="SELECT *
                                FROM (SELECT Nvl(tiss_itguia_equ.sq_ref,
                                                ((instr('$id_guia_00',
                                                        LPad(To_Char(tiss_itguia_equ.id_pai), 15, '0')) + 15) / 16)) item,
                                            ROWNUM registro,
                                            tiss_itguia_equ.cd_ati_med CP_47,
                                            NVL(NVL(tiss_itguia_equ.cd_operadora, tiss_itguia_equ.cd_cpf),
                                                tiss_itguia_equ.ds_conselho_cod_prof ||
                                                tiss_itguia_equ.ds_cod_conselho_cod_prof ||
                                                tiss_itguia_equ.uf_conselho_cod_prof) CP_48,
                                            tiss_itguia_equ.nm_prestador CP_49,
                                            tiss_itguia_equ.ds_conselho CP_50,
                                            tiss_itguia_equ.ds_codigo_conselho CP_51,
                                            tiss_itguia_equ.uf_conselho CP_52,
                                            tiss_itguia_equ.cd_cbos CP_53,
                                            tiss_itguia_equ.id ID_ITGUIA_EQU,
                                            tiss_itguia_equ.id_pai id_pai
                                        FROM dbamv.tiss_itguia_equ
                                    where 1 = 1
                                        AND id_pai IN (SELECT it.ID
                                                        FROM dbamv.TISS_ITGUIA it
                                                        INNER JOIN dbamv.TISS_GUIA tg
                                                            ON tg.ID = it.ID_PAI
                                                        WHERE tg.CD_ATENDIMENTO = $var_cd_atendimento)
                                    order by id)
                            where 1 = 1
                                AND registro <= 4
                            order by registro, ID_ITGUIA_EQU";

    $result_cons_guia_tiss_47_53 = oci_parse($conn_ora, $cons_guia_tiss_47_53);
    @oci_execute($result_cons_guia_tiss_47_53);
    //@$row_cons_guia_tiss_47_53 = oci_fetch_array($result_cons_guia_tiss_47_53);


    //Consulta 34 - 45
    
    $cons_guia_tiss_34_45="SELECT * FROM (
    SELECT
    Nvl( tiss_itguia.sq_item,((instr('$id_guia_00',LPad(To_Char(id),15,'0'))+15)/16))  registro,
          to_char(to_date(tiss_itguia.dt_realizado,'yyyy-mm-dd'),'DD/MM/YYYY') CP_34,
          tiss_itguia.hr_inicio CP_35,
          tiss_itguia.hr_fim CP_36,
          tiss_itguia.tp_tab_fat CP_37,
          tiss_itguia.cd_procedimento CP_38,
          tiss_itguia.ds_procedimento CP_39,
          tiss_itguia.qt_realizada CP_40,
          DECODE( $id_guia_00 , 'R_REPO_ATE',' ','R_REPO_ATE_HOSP',' ', tiss_itguia.cd_via_acesso) CP_41,
          DECODE( $id_guia_00 , 'R_REPO_ATE',' ','R_REPO_ATE_HOSP',' ', tiss_itguia.tp_tecnica_utilizada) CP_42,
                Decode (Nvl(dbamv.pkg_mv2000.le_configuracao('FFCV','SN_IMPRIME_VL_GUIA_SP_SADT'),'N') ,'N' , DECODE( $id_guia_00 , 'R_REPO_ATE',' ','R_REPO_ATE_HOSP',' ', tiss_itguia.vl_percentual_multipla) , tiss_itguia.vl_percentual_multipla ) CP_43,
                Decode (Nvl(dbamv.pkg_mv2000.le_configuracao('FFCV','SN_IMPRIME_VL_GUIA_SP_SADT'),'N') ,'N' , DECODE( $id_guia_00 , 'R_REPO_ATE',' ','R_REPO_ATE_HOSP',' ', tiss_itguia.vl_unitario) , tiss_itguia.vl_unitario )  CP_44,
                Decode (Nvl(dbamv.pkg_mv2000.le_configuracao('FFCV','SN_IMPRIME_VL_GUIA_SP_SADT'),'N') ,'N' , DECODE( $id_guia_00 , 'R_REPO_ATE',' ','R_REPO_ATE_HOSP',' ', tiss_itguia.vl_total) , tiss_itguia.vl_total )  CP_45,
          tiss_itguia.id ID_ITGUIA
      FROM dbamv.tiss_itguia
     WHERE tiss_itguia.id_pai = $nm_guia
    ORDER BY id ) proced
    WHERE 1 = 1
    AND  proced.ID_ITGUIA = $id_guia_00
    ORDER BY 1";

    $result_cons_guia_tiss_34_45 = oci_parse($conn_ora, $cons_guia_tiss_34_45);
    @oci_execute($result_cons_guia_tiss_34_45);
    @$row_cons_guia_tiss_34_45 = oci_fetch_array($result_cons_guia_tiss_34_45);


    //Consulta 59 - 65
    
    $cons_guia_tiss_59_65= "SELECT
                                distinct 1  folha
                            ,tiss_guia.id                   ID_GUIA
                            ,tiss_guia.cd_atendimento       CD_ATENDIMENTO
                            ,tiss_guia.cd_reg_fat           CD_REG_FAT
                            ,tiss_guia.cd_convenio          CD_CONVENIO
                            ,Decode (Nvl(dbamv.pkg_mv2000.le_configuracao('FFCV','SN_IMPRIME_VL_GUIA_SP_SADT'),'N') ,'N' , DECODE((SELECT ID
                                                            FROM dbamv.TISS_GUIA tg
                                                            WHERE tg.CD_ATENDIMENTO = $var_cd_atendimento) , 'R_REPO_ATE',' ','R_REPO_ATE_HOSP',' ', tiss_guia.vl_tot_servicos ), tiss_guia.vl_tot_servicos )      CP_59
                            ,Decode (Nvl(dbamv.pkg_mv2000.le_configuracao('FFCV','SN_IMPRIME_VL_GUIA_SP_SADT'),'N') ,'N' , DECODE( (SELECT ID
                                                            FROM dbamv.TISS_GUIA tg
                                                            WHERE tg.CD_ATENDIMENTO = $var_cd_atendimento) , 'R_REPO_ATE',' ','R_REPO_ATE_HOSP',' ', tiss_guia.vl_tot_taxas ), tiss_guia.vl_tot_taxas )         CP_60
                            ,Decode (Nvl(dbamv.pkg_mv2000.le_configuracao('FFCV','SN_IMPRIME_VL_GUIA_SP_SADT'),'N') ,'N' , DECODE((SELECT ID
                                                            FROM dbamv.TISS_GUIA tg
                                                            WHERE tg.CD_ATENDIMENTO = $var_cd_atendimento) , 'R_REPO_ATE',' ','R_REPO_ATE_HOSP',' ', tiss_guia.vl_tot_materiais ), tiss_guia.vl_tot_materiais )     CP_61
                            ,Decode (Nvl(dbamv.pkg_mv2000.le_configuracao('FFCV','SN_IMPRIME_VL_GUIA_SP_SADT'),'N') ,'N' , DECODE( (SELECT ID
                                                            FROM dbamv.TISS_GUIA tg
                                                            WHERE tg.CD_ATENDIMENTO = $var_cd_atendimento) , 'R_REPO_ATE',' ','R_REPO_ATE_HOSP',' ', tiss_guia.VL_TOT_OPME ), tiss_guia.VL_TOT_OPME )          CP_62
                            ,Decode (Nvl(dbamv.pkg_mv2000.le_configuracao('FFCV','SN_IMPRIME_VL_GUIA_SP_SADT'),'N') ,'N' , DECODE( (SELECT ID
                                                            FROM dbamv.TISS_GUIA tg
                                                            WHERE tg.CD_ATENDIMENTO = $var_cd_atendimento) , 'R_REPO_ATE',' ','R_REPO_ATE_HOSP',' ', tiss_guia.vl_tot_medicamentos ), tiss_guia.vl_tot_medicamentos )  CP_63
                            ,Decode (Nvl(dbamv.pkg_mv2000.le_configuracao('FFCV','SN_IMPRIME_VL_GUIA_SP_SADT'),'N') ,'N' , DECODE( (SELECT ID
                                                            FROM dbamv.TISS_GUIA tg
                                                            WHERE tg.CD_ATENDIMENTO = $var_cd_atendimento) , 'R_REPO_ATE',' ','R_REPO_ATE_HOSP',' ', tiss_guia.vl_tot_gases ), tiss_guia.vl_tot_gases )         CP_64
                            ,Decode (Nvl(dbamv.pkg_mv2000.le_configuracao('FFCV','SN_IMPRIME_VL_GUIA_SP_SADT'),'N') ,'N' , DECODE( (SELECT ID
                                                            FROM dbamv.TISS_GUIA tg
                                                            WHERE tg.CD_ATENDIMENTO = $var_cd_atendimento) , 'R_REPO_ATE',' ','R_REPO_ATE_HOSP',' ', tiss_guia.vl_tot_geral ), tiss_guia.vl_tot_geral )        CP_65
                            From dbamv.tiss_guia
                            where tiss_guia.id                =  $id_guia_00
                            order by tiss_guia.id, folha;
";
    
        $result_cons_guia_tiss_59_65 = oci_parse($conn_ora, $cons_guia_tiss_59_65);
        @oci_execute($result_cons_guia_tiss_59_65);
        @$row_cons_guia_tiss_59_65 = oci_fetch_array($result_cons_guia_tiss_59_65);
?>
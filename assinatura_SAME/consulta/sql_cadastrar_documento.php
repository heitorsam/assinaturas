<?php 
    session_start();

    //ACESSO RESTRITO
    include '../../acesso_restrito.php';

    //CONEXAO
    include '../../conexao.php'; 

    //RECEBENDO SESSAO
    $var_cd_usuario = $_SESSION['usuarioLogin'];


    //////////////////
    //DADOS VIA POST//
    //////////////////
    

    echo 'var_cd_paciente: ';
    echo $var_cd_paciente = $_POST['frm_cd_paciente'];
    echo '</br>';

    echo 'var_paciente_nome: ';
    echo $var_paciente_nome = $_POST['frm_paciente_nome'];
    echo '</br>';

    echo 'var_paciente_rg: ';
    echo $var_paciente_rg = $_POST['frm_paciente_rg'];
    echo '</br>';

    echo 'var_paciente_cpf: ';
    echo $var_paciente_cpf = $_POST['frm_paciente_cpf'];
    echo '</br>';

    echo 'var_paciente_nascimento: ';
    echo $var_paciente_nascimento = $_POST['frm_paciente_nascimento'];
    echo '</br>';

    echo 'var_paciente_periodo_min: ';
    echo $var_paciente_periodo_min = $_POST['frm_paciente_periodo_min'];
    echo '</br>';

    echo 'var_paciente_periodo_max: ';
    echo $var_paciente_periodo_max = $_POST['frm_paciente_periodo_max'];
    echo '</br>';

    echo 'var_radio_escolha: ';
    echo $var_radio_escolha = $_POST['frm_radio_escolha'];
    echo '</br>';

    echo 'var_requerente_nome_parente: ';
    echo $var_requerente_nome_parente = $_POST['frm_requerente_nome_parente'];
    echo '</br>';

    echo 'var_requerente_nome: ';
    echo $var_requerente_nome = $_POST['frm_requerente_nome'];
    echo '</br>';

    echo 'var_requerente_rg: ';
    echo $var_requerente_rg = $_POST['frm_requerente_rg'];
    echo '</br>';

    echo 'var_requerente_cpf: ';
    echo $var_requerente_cpf = $_POST['frm_requerente_cpf'];
    echo '</br>';

    echo 'var_requerente_nascimento: ';
    echo $var_requerente_nascimento = $_POST['frm_requerente_nascimento'];
    echo '</br>';

    echo 'var_requerente_estado_civil: ';
    echo $var_requerente_estado_civil = $_POST['frm_requerente_estado_civil'];
    echo '</br>';

    echo 'var_requerente_profissao: ';
    echo $var_requerente_profissao = $_POST['frm_requerente_profissao'];
    echo '</br>';

    echo 'var_requerente_cep: ';
    echo $var_requerente_cep = $_POST['frm_requerente_cep'];
    echo '</br>';

    echo 'frm_requerente_cidade: ';
    echo $var_requerente_cidade = $_POST['frm_requerente_cidade'];
    echo '</br>';

    echo 'var_requerente_estado: ';
    echo $var_requerente_estado = $_POST['frm_requerente_estado'];
    echo '</br>';

    echo 'var_requerente_rua: ';
    echo $var_requerente_rua = $_POST['frm_requerente_rua'];
    echo '</br>';

    echo 'var_requerente_bairro: ';
    echo $var_requerente_bairro = $_POST['frm_requerente_bairro'];
    echo '</br>';

    echo 'var_requerente_tel_primario: ';
    echo $var_requerente_tel_primario = $_POST['frm_requerente_tel_primario'];
    echo '</br>';

    echo 'var_requerente_tel_secundario: ';
    echo $var_requerente_tel_secundario = $_POST['frm_requerente_tel_secundario'];
    echo '</br>';

    echo 'var_requerente_tel_terciario: ';
    echo $var_requerente_tel_terciario = $_POST['frm_requerente_tel_terciario'];
    echo '</br>';

    echo 'var_requerente_motivo: ';
    echo $var_requerente_motivo = $_POST['frm_requerente_motivo'];
    echo '</br>';


    //////////
    //DELETE//
    //////////
    $cons_requerente_delete="DELETE assinaturas.DOCUMENTO_REQUERENTE 
                                WHERE CD_PACIENTE = $var_cd_paciente
                            ";
    $result_requerente_delete = oci_parse($conn_ora, $cons_requerente_delete);
    $valida_requerente_delete = @oci_execute($result_requerente_delete);

    //VALIDA CASDASTRO PRODUTO
    if (!$valida_requerente_delete) {   
            $erro = oci_error($result_requerente_delete);																							
            $_SESSION['msgerro'] = htmlentities($erro['message']);
            //header('location: ../../../workflow.php'); 
        }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////

    //////////
    //INSERT//
    //////////
    ECHO $cons_requerente="INSERT INTO assinaturas.DOCUMENTO_REQUERENTE
                            SELECT 
                                $var_cd_paciente AS CD_PACIENTE,
                                '$var_paciente_nome' AS PACIENTE_NOME,
                                '$var_paciente_rg' AS PACIENTE_RG,
                                '$var_paciente_cpf' AS PACIENTE_CPF,
                                SYSDATE AS PACIENTE_NASCIMENTO,
                                SYSDATE AS PERIODO_MINIMO,
                                SYSDATE AS PERIODO_MAXIMO,
                                '$var_radio_escolha' AS REQUERENTE_ESCOLHA,
                                '$var_requerente_nome_parente' AS REQUERENTE_PARENTE,
                                '$var_requerente_nome' AS REQUERENTE_NOME,
                                '$var_requerente_rg' AS REQUERENTE_RG,
                                '$var_requerente_cpf' AS REQUERENTE_CPF,
                                SYSDATE AS REQUERENTE_NASCIMENTO,
                                '$var_requerente_estado_civil' AS REQUERENTE_ESTADO_CIVIL,
                                '$var_requerente_profissao' AS REQUERENTE_PROFISSAO,
                                '$var_requerente_cep' AS REQUERENTE_CEP,
                                '$var_requerente_cidade' AS REQUERENTE_CIDADE,
                                '$var_requerente_estado' AS REQUERENTE_ESTADO,
                                '$var_requerente_rua' AS REQUERENTE_RUA,
                                '$var_requerente_bairro' AS REQUERENTE_BAIRRO,
                                '$var_requerente_tel_primario' AS REQUERENTE_TEL_PRIMARIO,
                                '$var_requerente_tel_secundario' AS REQUERENTE_TEL_SECUNDARIO,
                                '$var_requerente_tel_terciario' AS REQUERENTE_TEL_TERCIARIO,
                                '$var_requerente_motivo' AS REQUERENTE_MOTIVO,
                                '$var_cd_usuario' AS CD_USUARIO_CADASTRO,
                                SYSDATE AS HR_CADASTRO
                            FROM DUAL
                                        ";

    $result_requerente = oci_parse($conn_ora, $cons_requerente);
    $valida_requerente = @oci_execute($result_requerente);


    //VALIDA CASDASTRO PRODUTO
    if (!$valida_requerente) {   
            $erro = oci_error($result_requerente);																							
            $_SESSION['msgerro'] = htmlentities($erro['message']);
            header('location: ../../gerar_documento_same_requisicao.php'); 
        }

        else{
            $_SESSION['msg'] = 'Cadastrado com sucesso!';
            header('location: ../../gerar_documento_same_requisicao.php'); 
        }  


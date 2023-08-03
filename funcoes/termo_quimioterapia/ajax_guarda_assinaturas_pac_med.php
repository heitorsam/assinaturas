<?php

include '../../conexao.php';

// Recupera os valores enviados via POST pela requisição AJAX
$var_assinatura_pac = $_POST['var_assinatura_pac'];
$var_assinatura_med = $_POST['var_assinatura_med'];
$var_paciente = $_POST['var_paciente'];
$var_atendimento = $_POST['var_atendimento'];
$var_prestador_logado = $_POST['var_prestador_logado'];

// Prepara a instrução SQL para o insert
$sql = "INSERT INTO assinaturas.ASSINATURA_PAC_MED 
        (CD_ASSINATURA_PAC_MED, CD_PACIENTE, CD_ATENDIMENTO, ASSINATURA_PACIENTE, ASSINATURA_MEDICO, CD_USUARIO_CADASTRO, HR_CADASTRO, CD_USUARIO_ULT_ALT, HR_ULT_ALT)
        VALUES 
        (assinaturas.SEQ_CD_ASSINATURA_PAC_MED.NEXTVAL, :cd_paciente, :cd_atendimento, EMPTY_BLOB(), EMPTY_BLOB(), :cd_usuario_cadastro, SYSDATE, NULL, NULL)
        RETURNING ASSINATURA_PACIENTE, ASSINATURA_MEDICO INTO :assinatura_paciente, :assinatura_medico";

// Prepara a declaração SQL
$stmt = oci_parse($conn_ora, $sql);

// Cria um objeto de descritor para os BLOBs
$assinatura_pac_blob = oci_new_descriptor($conn_ora, OCI_D_LOB);
$assinatura_med_blob = oci_new_descriptor($conn_ora, OCI_D_LOB);

// Associa os valores às variáveis da declaração SQL
oci_bind_by_name($stmt, ":cd_paciente", $var_paciente);
oci_bind_by_name($stmt, ":cd_atendimento", $var_atendimento);
oci_bind_by_name($stmt, ":assinatura_paciente", $assinatura_pac_blob, -1, OCI_B_BLOB);
oci_bind_by_name($stmt, ":assinatura_medico", $assinatura_med_blob, -1, OCI_B_BLOB);
oci_bind_by_name($stmt, ":cd_usuario_cadastro", $var_prestador_logado);

// Executa o insert
if (oci_execute($stmt, OCI_DEFAULT)) {
    // Salva os dados BLOB no banco de dados
    if ($assinatura_pac_blob->save($var_assinatura_pac) && $assinatura_med_blob->save($var_assinatura_med)) {
        oci_commit($conn_ora); // Confirma a transação
        echo "Dados inseridos com sucesso!";
    } else {
        oci_rollback($conn_ora); // Desfaz a transação em caso de erro
        echo "Erro ao salvar os dados BLOB no banco de dados.";
    }
} else {
    oci_rollback($conn_ora); // Desfaz a transação em caso de erro
    $error = oci_error($stmt);
    echo "Erro ao inserir os dados: " . $error['message'];
}

// Fecha os descritores, a declaração e a conexão
$assinatura_pac_blob->free();
$assinatura_med_blob->free();
oci_free_statement($stmt);
oci_close($conn_ora);
?>

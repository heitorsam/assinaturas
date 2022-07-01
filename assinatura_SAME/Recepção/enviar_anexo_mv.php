<?php
session_start();
//require_once('acesso_restrito.php');?>

<?php
include_once("../../conexao.php");

   if ( 0 < $_FILES['file']['error'] ) {
      echo 'Error: ' . $_FILES['file']['error'] . '<br>';
   }
   else {
      //move_uploaded_file($_FILES['file']['tmp_name'], '' . $_FILES['file']['name']);
      

      echo 'var_frm_ds_doc:';
      echo @$var_frm_ds_doc = 'aaaaaa';
      echo '<br>';



      

      //INFORMACOES DO ARQUIVO 
      $arquivo = $_FILES['file'];
      $nome_arquivo = $arquivo['name'];
      $tamanho = $_FILES['file']['size'];
      $arquivo_temp = $arquivo['tmp_name'];
      $extensao_arquivo = strrchr( $nome_arquivo, '.' );
      $nome_arquivo_personalizado = 'same_' . substr($var_frm_ds_doc, 0, 10) . $extensao_arquivo;

      //DECLARANDO VARIAVEIS DO ARQUIVO PARA IMPORTACAO PARA O BANCO
      //$image = file_get_contents($_FILES['file']['tmp_name']);

   }


/*
//INFORMACOES DO USUARIO
echo 'login_usuario:';
echo @$login_usuario = $_SESSION['usuarioLogin'];
echo '<br>';
//POST
echo 'var_frm_tp_doc:';
echo @$var_frm_tp_doc = $_POST['frm_tp_doc'];
echo '<br>';

echo 'var_frm_ds_doc:';
echo @$var_frm_ds_doc = $_POST['frm_ds_doc'];
echo '<br>';


//RECEBENDO AVISO DE CIRURGIA
echo 'var_cd_paciente:';
echo @$var_cd_paciente = filter_input(INPUT_GET, 'cd_paciente', FILTER_SANITIZE_STRING);
echo '<br>';

//INFORMACOES DO ARQUIVO 
$arquivo = $_FILES['file'];
$nome_arquivo = $arquivo['name'];
$tamanho = $_FILES['file']['size'];
$arquivo_temp = $arquivo['tmp_name'];
$extensao_arquivo = strrchr( $nome_arquivo, '.' );
$nome_arquivo_personalizado = 'same_' . substr($var_frm_ds_doc, 0, 10) . $extensao_arquivo;

//DECLARANDO VARIAVEIS DO ARQUIVO PARA IMPORTACAO PARA O BANCO
$image = file_get_contents($_FILES['file']['tmp_name']);

   //SEQ_ARQUIVO_DOCUMENTO
   $consulta_seq_ad = "SELECT assinaturas.seq_cd_arquivo.NEXTVAL AS SEQ_ARQUIVO_DOCUMENTO FROM DUAL";
   $result_seq_ad = oci_parse($conn_ora, $consulta_seq_ad);
   oci_execute($result_seq_ad);
   $row_seq_ad = oci_fetch_array($result_seq_ad);

   $var_seq_ad = $row_seq_ad['SEQ_ARQUIVO_DOCUMENTO'];

   $consulta_insert_AD = "INSERT INTO assinaturas.ARQUIVO_DOCUMENTO_SAME
                                    (CD_ARQUIVO_DOCUMENTO,
                                    CD_PACIENTE,
                                    TP_EXTENSAO,
                                    DS_NOME_ARQUIVO,
                                    CD_USUARIO_CADASTRO,
                                    HR_CADASTRO,
                                    LO_ARQUIVO_DOCUMENTO
                                       )
                              VALUES 
                                    ($var_seq_ad,
                                       $var_cd_paciente,
                                       UPPER(substr('$extensao_arquivo',2)),
                                       '$nome_arquivo_personalizado',
                                       '$login_usuario',
                                       SYSDATE,
                                       empty_blob()) RETURNING LO_ARQUIVO_DOCUMENTO INTO :image";

   echo '<br>' . $consulta_insert_AD . '<br>';

   $result_insert_AD = oci_parse($conn_ora, $consulta_insert_AD);
   $blob = oci_new_descriptor($conn_ora, OCI_D_LOB);
   oci_bind_by_name($result_insert_AD, ":image", $blob, -1, OCI_B_BLOB);
   $valida = oci_execute($result_insert_AD, OCI_DEFAULT);

   if(!$blob->save($image)) {
      oci_rollback($conn_ora);
   }
   else {
      oci_commit($conn_ora);
   }

   oci_free_statement($result_insert_AD);
   $blob->free();


   $header = 'location: ../../gerar_documento_same_recepcao.php?cd_paciente='.$var_cd_paciente;
   //$_SESSION['modalconfig'] = 'anexofoto';

   //VALIDA CASDASTRO PRODUTO
   if (!$valida) {   
   $erro = oci_error($result_insert_AD);																							
   $_SESSION['msgerro'] = htmlentities($erro['message']);
      header($header); 
   }

   else{
      $_SESSION['msg'] = 'Cadastrado com sucesso!';
      header($header); 
      }  
   

   echo '</br>';
*/
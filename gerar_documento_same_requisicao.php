<?php 
    //CABECALHO//
    include 'cabecalho.php';

    //CONEXAO
    include 'conexao.php';

		@$var_cd_paciente = $_GET['frm_cd_paciente'];
        '<br>';

    ////////////
	//PACIENTE//
	////////////

	$cons_paciente=" SELECT pac.CD_PACIENTE,
                            pac.NM_PACIENTE,
                            pac.NR_IDENTIDADE,
                            pac.NR_CPF,
                            TO_CHAR(pac.DT_NASCIMENTO, 'DD/MM/YYYY') AS DT_NASCIMENTO,
                            TO_CHAR(pac.DT_NASCIMENTO, 'YYYY-MM-DD') AS DT_REQUERENTE,
                            pac.NR_CEP,
                            pac.TP_ESTADO_CIVIL,
                            CASE
                                WHEN pac.TP_ESTADO_CIVIL = 'S' THEN 'Solteito'
                                WHEN pac.TP_ESTADO_CIVIL = 'C' THEN 'Casado'
                                WHEN pac.TP_ESTADO_CIVIL = 'V' THEN 'Viúvo'
                                WHEN pac.TP_ESTADO_CIVIL = 'D' THEN 'Desquitado'   
                                WHEN pac.TP_ESTADO_CIVIL = 'I' THEN 'Divorciado'
                                WHEN pac.TP_ESTADO_CIVIL = 'U' THEN 'União-estável'  
                            END AS ESTADO_CIVIL
                    FROM dbamv.PACIENTE pac
                    WHERE pac.CD_PACIENTE = '$var_cd_paciente'    
                ";

    $result_paciente = oci_parse($conn_ora, $cons_paciente);
    @oci_execute($result_paciente);
    $row_paciente = oci_fetch_array($result_paciente);

    if(!isset( $row_paciente['CD_PACIENTE']) && isset($var_cd_paciente)){
        $_SESSION['msgerro'] = "Paciente Não Localizado"; 
    }else{}

    ////////////////////////////////
	//DEFINE AS VARIAVEIS PACIENTE//
	////////////////////////////////
    @$var_cd_paciente = $row_paciente['CD_PACIENTE'];
    '<br>';
    @$var_nm_paciente = $row_paciente['NM_PACIENTE'];
    '<br>';
    @$var_rg = $row_paciente['NR_IDENTIDADE'];
    '<br>';
    @$var_cpf = $row_paciente['NR_CPF'];
    '<br>';
    @$var_dt_nascimento = $row_paciente['DT_NASCIMENTO'];
    '<br>';
    @$var_dt_requerente = $row_paciente['DT_REQUERENTE'];
    '<br>';
    @$var_cep = $row_paciente['NR_CEP'];
    '<br>';
    @$var_estado_civil = $row_paciente['ESTADO_CIVIL'];
?>

<!DOCTYPE HTML>
<html>
<body>

</body>
</html>

        <!--MENSAGENS-->
		<?php
            include 'js/mensagens.php';
            include 'js/mensagens_usuario.php';
		?>

        <div class="div_br"> </div>        

        <h11><i class="fa-solid fa-file"></i> Documento</h11>
        <span class="espaco_pequeno" style="width: 6px;" ></span>
        <h27> <a href="home.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

        <div class="div_br"> </div>
		
        <!--FORM-->
		<form method="get" autocomplete="off" action="gerar_documento_same_requisicao.php">
			<div class="row">

                <div class="col-md-3 ">
					Prontuário:
					<div class="input-group">

                    <?php if(isset($var_cd_paciente)){ ?>
                        <input type="number" maxlength="30" class="form-control" name="frm_cd_paciente" value="<?php echo $var_cd_paciente ?>" required>
					<?php } else { ?>
                        <input type="number" maxlength="30" class="form-control" name="frm_cd_paciente" required>
					<?php }?>

                        <button type="submit" class="btn btn-primary" >
                        <i class="fas fa-search"></i>
					</div> 
				</div>














                
			</div>
		</form>

		</br>

        <!--MOSTRA OS DADOS APOS PASSAR O FORM-->
		<?php if(strlen(@$var_nm_paciente) > 1 ){ ?>

            <?php
                //FORMULARIO DADOS REQUERENTE
                include 'assinatura_SAME/form/campos_requerente.php';
            ?>

        <?php } ?>

<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>

<?php
    //RODAPE
    include 'assinatura_SAME/funcoes/js_same_documento.php';
?>
    
<?php
    //RODAPE
    include 'rodape.php';
?>



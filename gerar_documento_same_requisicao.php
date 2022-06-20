<?php 
    //CABECALHO//
    include 'cabecalho.php';

    //CONEXAO
    include 'conexao.php';

		@$var_rg_paciente = $_GET['frm_rg_paciente'];
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
                    WHERE pac.NR_IDENTIDADE = '$var_rg_paciente'    
                ";

    $result_paciente = oci_parse($conn_ora, $cons_paciente);
    @oci_execute($result_paciente);
    $row_paciente = oci_fetch_array($result_paciente);

    if(!isset( $row_paciente['CD_PACIENTE']) && isset($var_rg_paciente)){
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
                    <?php if(isset($var_rg_paciente)){ ?>
                        RG:
                        <input type="number" maxlength="30" class="form-control" name="frm_rg_paciente" value="<?php echo $var_rg_paciente ?>" required>
                    <?php }else{ ?>
                        RG:
                        <input type="number" maxlength="30" class="form-control" name="frm_rg_paciente" required>
                    <?php } ?>
                    
				</div>
                <div class="col-md-3 ">
                     <br>
                    <!-- BOTAO PESQUISAR -->
                    <button type="submit" class="btn btn-primary" >
                        <i class="fas fa-search"></i> Pesquisar
                    </button>
				</div>
                
			</div>
		</form>

		</br>

        <!--MOSTRA OS DADOS APOS PASSAR O FORM-->
		<?php if(strlen(@$var_nm_paciente) > 1 ){ ?>

            <form action="assinatura_SAME/consulta/sql_cadastrar_documento.php" method="POST">
                <div class="div_br"> </div>
                
                <div class="row">
                    <div class="col-md-8">
                        Paciente:
                        <input type="text" class="form-control" name="frm_paciente_nome" value="<?php echo $var_nm_paciente;?>" readonly>
                        <input type="hidden" class="form-control" name="frm_cd_paciente" value="<?php echo $var_cd_paciente;?>" readonly>
                    </div>

                    <div class="col-md-2">
                        RG:
                        <input type="text" class="form-control" name="frm_paciente_rg" value="<?php echo $var_rg;?>" readonly>
                    </div>                       

                    <div class="col-md-2">
                        CPF:
                        <input type="number" class="form-control" name="frm_paciente_cpf" value="<?php echo $var_cpf;?>" readonly>
                    </div>

                </div>

                <div class="div_br"> </div>

                <div class="row">

                    <div class="col-md-3">
                        Data de Nascimento:
                        <input type="text" class="form-control" name="frm_paciente_nascimento"  value="<?php echo $var_dt_nascimento;?>" readonly>
                    </div>

                    <div class="col-md-4">
                        Périodo de Internação:
                        <input type="date" class="form-control" name="frm_paciente_periodo_min">
                    </div>

                    <div  style="padding-top: 30px;">
                        há
                    </div>

                    <div class="col-md-4">
                         
                        <input type="date" class="form-control" name="frm_paciente_periodo_max">
                    </div>
                </div>

                <div class="div_br"> </div>
                <div class="div_br"> </div>

                <!--TITULO REQUERENTE-->
                <div class="fnd_azul" id="fnd_azul">     
                <i class="fa-solid fa-user"></i> Dados do Requerente 
                </div>

                <div class="div_br"> </div>
                <div class="div_br"> </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="flexRadio" id="flexRadio_Paciente" checked>
                            <label class="form-check-label" for="flexRadio_Paciente">
                                Paciente
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="flexRadio" id="flexRadio_RepresentanteLegal" >
                            <label class="form-check-label" for="flexRadio_RepresentanteLegal">
                                Representante Legal
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="flexRadio" id="flexRadio_Tutor" >
                            <label class="form-check-label" for="flexRadio_Tutor">
                                Tutor ou Curador
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="flexRadio" id="flexRadio_Parente" >
                            <label class="form-check-label" for="flexRadio_Parente">
                                Parente  
                            </label>
                             <?php include 'assinatura_SAME/filtro/include_filtro_parente.php';?>
                        </div>

                        <!-- PASSA O VALOR SELECIONADO PARA PROXIMA PAGINA-->
                        <div class="col-md-2">
                            <input type="hidden" class="form-control" name="frm_radio_escolha" id="js_radio_escolha" value="" readonly>
                        </div>
                    </div>
                </div>

                <div class="div_br"> </div>

                <div class="row">
                    <div class="col-md-6">
                        Nome:
                        <input type="text" class="form-control" name="frm_requerente_nome" value="" id="js_frm_nome">
                    </div>

                    <div class="col-md-3">
                        RG:
                        <input type="text" class="form-control" name="frm_requerente_rg" value="" id="js_frm_rg" >
                    </div>

                    <div class="col-md-3">
                        CPF:
                        <input type="text" class="form-control" name="frm_requerente_cpf" value="" id="js_frm_cpf" >
                    </div>

                </div>

                <div class="div_br"> </div>

                <div class="row">

                    <div class="col-md-3">
                        Data de Nascimento:
                        <input type="date" class="form-control" name="frm_requerente_nascimento" value="" id="js_frm_nascimento" >
                    </div>

                    <div class="col-md-3">
                        Estado Civil:
                        <input type="text" class="form-control" name="frm_requerente_estado_civil" value="" id="js_frm_estado_civil" >
                    </div>

                    <div class="col-md-6">
                        Profissão:
                        <input type="text" class="form-control" name="frm_requerente_profissao" value="" id="js_frm_profissao" >
                    </div>

                </div>

                <div class="div_br"> </div>

                <div class="row">
                    <div class="col-md-2">
                        CEP:
                        <input type="text" class="form-control" name="frm_requerente_cep" value="" id="cep" maxlength="9" placeholder=" " >
                    </div>

                    <div class="col-md-5">
                        Cidade:
                        <input type="text" class="form-control" name="frm_requerente_cidade" value="" id="cidade" >
                    </div>

                    <div class="col-md-5">
                        Estado:
                        <input type="text" class="form-control" name="frm_requerente_estado" value="" id="uf" >
                    </div>

                </div>

                <div class="div_br"> </div>

                <div class="row">

                    <div class="col-md-6">
                        Rua:
                        <input type="text" class="form-control" name="frm_requerente_rua" value="" id="endereco" >
                    </div>

                    <div class="col-md-6">
                        Bairro:
                        <input type="text" class="form-control" name="frm_requerente_bairro" value="" id="bairro" >
                    </div>

                </div>

                <div class="div_br"> </div>

                <div class="row">

                    <div class="col-md-4">
                        Telefone Primário:
                        <input type="number" class="form-control" name="frm_requerente_tel_primario" value="" >
                    </div>

                    <div class="col-md-4">
                        Telefone Secundário:
                        <input type="number" class="form-control" name="frm_requerente_tel_secundario" value="" >
                    </div>

                    
                    <div class="col-md-4">
                        Telefone Terciário:
                        <input type="number" class="form-control" name="frm_requerente_tel_terciario" value="" >
                    </div>

                </div>

                <div class="div_br"> </div>

                <div class="row">

                    <div class="col-md-12">
                        Motivo do Requerimento:
                        <textarea class="form-control" name="frm_requerente_motivo" id="" rows="3"></textarea>
                    </div>

                </div>

                <div class="div_br"> </div>
                <div class="div_br"> </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Cadastrar</button>

            </form>

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



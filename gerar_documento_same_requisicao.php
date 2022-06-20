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

	$cons_paciente="SELECT pac.CD_PACIENTE, pac.NM_PACIENTE, pac.NR_IDENTIDADE, pac.NR_CPF, pac.DT_NASCIMENTO
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

            <form action="consultas/setor/sql_cad_setor_inserir.php" method="POST">
                    <div class="div_br"> </div>

                    <div class="row">
                        <div class="col-md-8">
                            Paciente:
                            <input type="text" class="form-control" name="" value="<?php echo $var_nm_paciente;?>" readonly>
                        </div>

                        <div class="col-md-2">
                            RG:
                            <input type="text" class="form-control" name="" value="<?php echo $var_rg;?>" readonly>
                        </div>                       

                        <div class="col-md-2">
                            CPF:
                            <input type="text" class="form-control" name="" value="<?php echo $var_cpf;?>" readonly>
                        </div>

                    </div>

                    <div class="div_br"> </div>

                    <div class="row">

                        <div class="col-md-3">
                            Data de Nascimento:
                            <input type="text" class="form-control" name=""  value="<?php echo $var_dt_nascimento;?>" readonly>
                        </div>

                        <div class="col-md-4">
                            Périodo de Internação:
                            <input type="date" class="form-control" name="">
                        </div>

                        <div  style="padding-top: 30px;">
                            há
                        </div>

                        <div class="col-md-4">
                             
                            <input type="date" class="form-control" name="">
                        </div>
                    </div>

                    <div class="div_br"> </div>
                    <div class="div_br"> </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="flexRadio" id="flexRadio_Paciente">
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
                                    Parente - 
                                </label>
                                 <?php include 'include_filtro_parente.php';?>
                            </div>
                        </div>
                    </div>

                    <div class="div_br"> </div>

                    <div class="row">
                        <div class="col-md-6">
                            Nome:
                            <input type="text" class="form-control" name="" value="" >
                        </div>

                        <div class="col-md-3">
                            RG:
                            <input type="text" class="form-control" name="" value="" >
                        </div>

                        <div class="col-md-3">
                            CPF:
                            <input type="text" class="form-control" name="" value="" >
                        </div>

                    </div>

                    <div class="div_br"> </div>

                    <div class="row">

                        <div class="col-md-3">
                            Data de Nascimento:
                            <input type="date" class="form-control" name="" value="" >
                        </div>

                        <div class="col-md-3">
                            Estado Civil:
                            <input type="text" class="form-control" name="" value="" >
                        </div>

                        <div class="col-md-6">
                            Profissão:
                            <input type="text" class="form-control" name="" value="" >
                        </div>

                    </div>

                    <div class="div_br"> </div>

                    <div class="row">
                        <div class="col-md-2">
                            CEP:
                            <input type="text" class="form-control" name="" value="" id="cep" maxlength="9" placeholder="13483-000" >
                        </div>

                        <div class="col-md-5">
                            Cidade:
                            <input type="text" class="form-control" name="" value="" id="cidade" >
                        </div>

                        <div class="col-md-5">
                            Estado:
                            <input type="text" class="form-control" name="" value="" id="uf" >
                        </div>

                    </div>

                    <div class="div_br"> </div>

                    <div class="row">

                        <div class="col-md-6">
                            Rua:
                            <input type="text" class="form-control" name="" value="" id="endereco" >
                        </div>

                        <div class="col-md-6">
                            Bairro:
                            <input type="text" class="form-control" name="" value="" id="bairro" >
                        </div>

                    </div>

                    <div class="div_br"> </div>

                    <div class="row">

                        <div class="col-md-4">
                            Telefone Primário:
                            <input type="text" class="form-control" name="" value="" >
                        </div>

                        <div class="col-md-4">
                            Telefone Secundário:
                            <input type="text" class="form-control" name="" value="" >
                        </div>

                        
                        <div class="col-md-4">
                            Telefone Terciário:
                            <input type="text" class="form-control" name="" value="" >
                        </div>

                    </div>

                    <div class="div_br"> </div>

                    <div class="row">

                        <div class="col-md-12">
                            Motivo do Requerimento:
                            <textarea class="form-control" id="" rows="3"></textarea>
                        </div>

                    </div>

                    <div class="div_br"> </div>

                    <div class="row">

                        <div class="col-md-4">
                            Telefone Primário:
                            <input type="text" class="form-control" name="" value="" >
                        </div>

                        <div class="col-md-4">
                            Telefone Secundário:
                            <input type="text" class="form-control" name="" value="" >
                        </div>

                        
                        <div class="col-md-4">
                            Telefone Terciário:
                            <input type="text" class="form-control" name="" value="" >
                        </div>

                    </div>

                
            </form>

        <?php } ?>

<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>

<script>
        /*
            * Para efeito de demonstração, o JavaScript foi
            * incorporado no arquivo HTML.
            * O ideal é que você faça em um arquivo ".js" separado. Para mais informações
            * visite o endereço https://developer.yahoo.com/performance/rules.html#external
        */

    // Registra o evento blur do campo "cep", ou seja, a pesquisa será feita
    // quando o usuário sair do campo "cep"
    $("#cep").blur(function(){
        // Remove tudo o que não é número para fazer a pesquisa
        var cep = this.value.replace(/[^0-9]/, "");
        
        // Validação do CEP; caso o CEP não possua 8 números, então cancela
        // a consulta
        if(cep.length != 8){
            return false;
        }
        
        // A url de pesquisa consiste no endereço do webservice + o cep que
        // o usuário informou + o tipo de retorno desejado (entre "json",
        // "jsonp", "xml", "piped" ou "querty")
        var url = "https://viacep.com.br/ws/"+cep+"/json/";
        
        // Faz a pesquisa do CEP, tratando o retorno com try/catch para que
        // caso ocorra algum erro (o cep pode não existir, por exemplo) a
        // usabilidade não seja afetada, assim o usuário pode continuar//
        // preenchendo os campos normalmente
        $.getJSON(url, function(dadosRetorno){
            try{
                // Preenche os campos de acordo com o retorno da pesquisa
                $("#endereco").val(dadosRetorno.logradouro);
                $("#bairro").val(dadosRetorno.bairro);
                $("#cidade").val(dadosRetorno.localidade);
                $("#uf").val(dadosRetorno.uf);
            }catch(ex){}
        });
    }); 

</script>
    
    <div class="div_br"> </div>
    <div class="div_br"> </div>
    <div class="div_br"> </div>
    <div class="div_br"> </div>
    <div class="div_br"> </div>
    <div class="div_br"> </div>
    <div class="div_br"> </div>

    <div class="div_br"> </div>
    <div class="div_br"> </div>
    <div class="div_br"> </div>
    <div class="div_br"> </div>
    <div class="div_br"> </div>
    <div class="div_br"> </div>
    <div class="div_br"> </div>
    
<?php
    //RODAPE
    include 'rodape.php';
?>


<?php 
    //CABECALHO
    include 'cabecalho.php';

    //CONEXAO
    include 'conexao.php';
?>

<!DOCTYPE HTML>
<html>
<body>

    <!--MENSAGENS-->
    <?php
    include 'js/mensagens.php';
    include 'js/mensagens_usuario.php';
    ?>

    <div class="div_br"> </div>        

    <h11><i class="fas fa-file-alt"></i> Requerimentos Concluídos:</h11>
    <span class="espaco_pequeno" style="width: 6px;" ></span>
    <h27> <a href="home.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

    <div class="div_br"> </div> 
    <!--FORM - PRONTUARIO-->
    <form method="get" autocomplete="off" action="gerar_documento_same.php">
        <div class="row">
            <!--FILTRO PERIODO-->
            <div class="col-md-3">  
                <?php    
                    $var_periodo_filtro = @$_GET["frm_cad_periodo"];

                    if(strlen($var_periodo_filtro) < 1){ 
                        
                        echo "Período:";
                        echo "<input type='month' class='form-control' name='frm_cad_periodo' id='' required>";
                    }else{
                        echo "Período:";
                        echo "<input type='month' class='form-control' name='frm_cad_periodo' id='' value='". $var_periodo_filtro."' required >";
                    }   
                ?>
            </div>

            <!--BOTÃO PESQUISAR-->
            <div class="col-md-3">  
                <!-- BOTAO PESQUISAR -->
                 <br>
                <button type="submit" class="btn btn-primary" >
                    <i class="fas fa-search"></i> Pesquisar
                </button> 
            </div>
            
        </div>
    </form>

    </br>

    <!--TABELA-->
    <?php 

        if(isset($var_periodo_filtro)){       
            //CABECALHO
            $where = "WHERE NM_DOC = 'same_concluido'";
            include 'assinatura_SAME/tabela_baixar_pdf_same.php';
        }

    ?>

</body>
</html>

<?php
    //RODAPE
    include 'rodape.php';
?>

<script type="text/javascript">

$(document).ready(function(){

	/*TODA VEZ QUE ABRIR O MODAL EXECUTAR ESSA FUNCAO*/

    $(document).on('shown.bs.modal','.modal', function (event) {
        //alert("Aqui");
        var button = $(event.relatedTarget) //Button that triggered the modal    
		var identificador = button.data('identificador') 
        var cd_atendimento = button.data('cd_atendimento') 

        document.getElementById('js_cd_atendimento').value = cd_atendimento; 

        //PASSANDO VALOR DO CAMPO PESQUISA E EXECUTANDO AJAX
		if(identificador == 'guia_same_assinado'){
            //alert(cd_atendimento);
			$("#visualizaModalAssinado .modal-body").load('exibi_pdf_guia_same.php?cd_atendimento=' + cd_atendimento);
        	}

    });    

});

</script>
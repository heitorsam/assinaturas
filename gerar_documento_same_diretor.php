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

    <h11><i class="fas fa-address-book"></i> Requerimentos Pendentes:</h11>
    <span class="espaco_pequeno" style="width: 6px;" ></span>
    <h27> <a href="home.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 

    <div class="div_br"> </div> 
    <!--FORM - PRONTUARIO-->
    <form method="get" autocomplete="off" action="gerar_documento_same_diretor.php">
        <div class="row">
            <!--FILTRO PERIODO-->
            <div class="col-md-3">  
           
                <?php    
                    echo $var_periodo_filtro = @$_GET["frm_cad_periodo"];

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
        
        $where = "WHERE NM_DOC IN ('same_pendente', 'same_concluido', 'same_recusado')";
        include 'tabela_baixar_pdf_same.php';

        //$where = "WHERE NM_DOC = 'same_concluido'";
        //include 'tabela_baixar_pdf_same.php';
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
        var tp_doc = button.data('tp_doc') 
        
        //alert(tp_doc);

        
        document.getElementById('js_cd_atendimento').value = cd_atendimento; 

        //PASSANDO VALOR DO CAMPO PESQUISA E EXECUTANDO AJAX
		if(identificador == 'guia_same_assinado'){

            var btn_recusar = document.getElementById('jv_btn_recusar');
            var btn_assinar = document.getElementById('jv_btn_assinar');
            if(tp_doc == 'same_concluido'){  
                    btn_recusar.style.display = 'inline';
                    btn_assinar.style.display = 'none';
                }

            if(tp_doc == 'same_recusado'){  
                btn_recusar.style.display = 'none';
                btn_assinar.style.display = 'inline';
            }

            if(tp_doc == 'same_pendente'){  
                btn_recusar.style.display = 'inline';
                btn_assinar.style.display = 'inline';
            }

            //var a = <?php echo $var_periodo_filtro; ?>;
            //alert (a);
			$("#visualizaModalAssinado .modal-body").load('exibi_pdf_guia_same.php?cd_atendimento=' + cd_atendimento);
        	}

    }); 



    ///////////
    //RECUSAR//
    ///////////
    document.getElementById("jv_btn_recusar").onclick = function() {acaoRecusar()};

    function acaoRecusar() {
        var cd_atendimento = document.getElementById('js_cd_atendimento').value;
        
        $.ajax({
                url: "recusar_assinatura.php",
                type: "POST",
                data: {
                    cd_atendimento: cd_atendimento
                    },
                cache: false,
                success: function(dataResult){
                        //alert("PASSOU");
                        //EXIBE A TABELA
                        window.setTimeout(function(){location.reload()},500);
                }
            });
    }


    ///////////
    //ASSINAR//
    ///////////
    document.getElementById("jv_btn_assinar").onclick = function() {acaoAssinar()};

    function acaoAssinar() {
        var cd_atendimento = document.getElementById('js_cd_atendimento').value;
        //alert (cd_atendimento);
        
        $.ajax({
                url: "salvar_assinatura.php",
                type: "POST",
                data: {
                    cd_atendimento: cd_atendimento
                    },
                cache: false,
                success: function(dataResult){
                        //alert("PASSOU");
                        //EXIBE A TABELA
                        window.setTimeout(function(){location.reload()},500);
                }
            });

    }


    

});

</script>
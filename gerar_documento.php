<?php 
    session_start();	

    //CABECALHO
    include 'cabecalho.php';
?>

<div class="div_br"> </div>

         <!--MENSAGENS-->
         <?php
            include 'js/mensagens.php';
            include 'js/mensagens_usuario.php';
        ?>
                
        <div class="div_br"> </div>        

        <h11><i class="fas fa-file-signature"></i> Gerar Documento</h11>
        <span class="espaco_pequeno" style="width: 6px;" ></span>
        <h27> <a href="home.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 


        <div class="div_br"> </div>


        <form method="post" autocomplete="off" action="gerar_documento.php">
            <div class="row">
                <div class="col-md-3 ">
                    Atendimento:
                    <div class="input-group">
                        <input class="form-control input-group" type="text"  name="cd_atendimento" required>
                        <button type="submit" class=" btn btn-primary" id="btn_pesquisar"> <i class="fa fa-search" aria-hidden="true"></i></button>	
                        <input type="hidden" id="valor" type="text" readonly />
                    </div>   
                </div>
            </div>
        </form>
            
<?php
    //RODAPE
    include 'rodape.php';
?>
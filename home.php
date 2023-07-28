<?php 
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

            <!--CLINICA ORIENTE -->
    
                <h11><i class="fa-solid fa-hospital"></i> Clinica Oriente</h11>

                <div class="div_br"> </div>

                <a href="clinica_oriente_termo_quimio.php" class="botao_home" type="submit"><i class="fas fa-file-signature"></i> Termo de Quimioterapia</a></td></tr>

                <span class="espaco_pequeno"></span>

                <a href="clinica_oriente_termo_consentimento.php" class="botao_home" type="submit"><i class="fas fa-file-signature"></i> Termo Anestésico</a></td></tr>

                <span class="espaco_pequeno"></span>

                <a href="clinica_oriente_termo_cirurgico.php" class="botao_home" type="submit"><i class="fas fa-file-signature"></i> Termo Cirúrgico</a></td></tr>

                <span class="espaco_pequeno"></span>


                <div class="div_br"> </div>

            <!--CLINICA ORIENTE -->

            <?php if(@$_SESSION['sn_usuario_comum'] == 'S' || @$_SESSION['sn_faturamento'] == 'S'){ ?>      
            <h11><i class="fas fa-signature"></i> Guia TISS</h11>

                <div class="div_br"> </div>

                <a href="gerar_documento.php" class="botao_home" type="submit"><i class="fas fa-file-signature"></i> Gerar Documento</a></td></tr>

                <span class="espaco_pequeno"></span>

                <a href="anexos.php" class="botao_home" type="submit"><i class="fas fa-camera"></i> Anexos</a></td></tr>
                <div class="div_br"> </div>


            <?php } ?>

            <div class="div_br"> </div>
            
            <?php if(@$_SESSION['sn_usuario_same_recepcao'] == 'S' || 
                    @$_SESSION['sn_usuario_same_diretor'] == 'S' ||
                    @$_SESSION['sn_usuario_same'] == 'S'){ 
            ?>   
                    <h11><i class="fa fa-address-book-o" aria-hidden="true"></i> SAME</h11>

                    <div class="div_br"> </div>                    

                    <?php if(@$_SESSION['sn_usuario_same_recepcao'] == 'S'){ ?>
                        <a href="gerar_documento_same_requisicao.php" class="botao_home" type="submit"><i class="fa-solid fa-file"></i> Documento</a></td></tr>
                        <span class="espaco_pequeno"></span>

                        <a href="gerar_documento_same_recepcao.php" class="botao_home" type="submit"><i class="fas fa-file-import"></i> Recepção</a></td></tr>
                        <span class="espaco_pequeno"></span>
                    <?php } ?>         
                    
                    
                    <?php if(@$_SESSION['sn_usuario_same_diretor'] == 'S'){ ?>
                        <a href="gerar_documento_same_diretor.php" class="botao_home" type="submit"><i class="fas fa-address-book"></i> Diretor</a></td></tr>
                        <span class="espaco_pequeno"></span>
                    <?php } ?>
                    
                    
                    <?php if(@$_SESSION['sn_usuario_same'] == 'S'){ ?>
                        <a href="gerar_documento_same.php" class="botao_home" type="submit"><i class="fas fa-file-alt"></i> SAME</a></td></tr>
                        <span class="espaco_pequeno"></span>
                    <?php } ?>
                    
                    
            <div class="div_br"> </div>
            <div class="div_br"> </div>
            <div class="div_br"> </div>  

            <?php } ?>

                        

            <?php if(@$_SESSION['sn_admin_coleta_assinatura'] == 'S'){ ?>   

                    <h11><i class="fa-solid fa-file-signature"></i> Coleta</h11>

                    <div class="div_br"> </div>
                   
                    <a href="cad_assinatura.php" class="botao_home_adm" type="submit"><i class="fas fa-user-nurse"></i> Cadastrar Assinatura</a></td></tr>

            <?php } ?>

            

            <!--

            <h11><i class="fas fa-signature"></i> Checagem Beira Leito</h11>

            <div class="div_br"> </div>

            <a href="check_gerar_documento.php" class="botao_home" type="submit"><i class="fas fa-file-signature"></i> Gerar Documento</a></td></tr>
            
            <span class="espaco_pequeno"></span>
            
            <a href="check_visualizar_documento.php" class="botao_home" type="submit"><i class="far fa-file-alt"></i> Visualizar Documento</a></td></tr>

            <div class="div_br"> </div>

            -->

        <?php if(@$_SESSION['sn_admin'] == 'S'){ ?>

            <!--TITULO
            <h11><i class="fa fa-cogs" aria-hidden="true"></i> Administrador</h11>
            
            <div class="div_br"> </div>

            <a href="permissoes.php" class="botao_home_adm" type="submit"><i class="fas fa-user-cog"></i> Permissões</a></td></tr>
            <span class="espaco_pequeno"></span>
            <a href="cad_assinatura.php" class="botao_home_adm" type="submit"><i class="fas fa-user-nurse"></i> Cadastrar Assinatura</a></td></tr>
            -->

        <?php } ?>
            
<?php
    //RODAPE
    include 'rodape.php';
?>
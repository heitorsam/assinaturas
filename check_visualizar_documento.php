<?php 

  //CABECALHO
  include 'cabecalho.php';

  //CONEXAO
  include 'conexao.php';
?>

<!DOCTYPE HTML>
<html>
    <body>
        <!-- Content -->
        <div class="container">

        <!--MENSAGENS-->
        <?php
        include 'js/mensagens.php';
        include 'js/mensagens_usuario.php';
        ?>  

        <h11><i class="far fa-file-alt"></i> Visualizar Documento</h11>
        <span class="espaco_pequeno" style="width: 6px;" ></span>
        <h27> <a href="home.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 


        <div class="div_br"> </div>
            <form method="post" autocomplete="off" action="check_exibe_pdf.php">
                <div class="row">
                    <div class="col-md-3 ">
                        Data: 
                        <div class="input-group">
                            <input type="text" placeholder="dd/mm/aaaa"
                                onkeyup="var v = this.value;
                                    if (v.match(/^\d{2}$/) !== null) {
                                        this.value = v + '/';
                                    } else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
                                        this.value = v + '/';
                                    }"
                                maxlength="10" class="form-control" id="id1" name="data1" required></input>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        Prestador:
                        <div class="input-group">                            
                            <select class="form-control" aria-label="Default select example" name="Prestador" required>
                                <option selected>Selecione o Prestador</option>
                                <?php
                                    $cons_nome_pres = "SELECT DISTINCT  pres.CD_PRESTADOR, pres.NM_PRESTADOR
                                                        FROM dbamv.PRESTADOR pres
                                                        JOIN dbasgu.usuarios usu ON pres.cd_prestador = usu.cd_prestador
                                                        WHERE pres.CD_TIP_PRESTA <> 8
                                                        AND usu.SN_ATIVO = 'S'
                                                        ORDER BY pres.NM_PRESTADOR ASC ";
                                    $result_nome_pres = oci_parse($conn_ora, $cons_nome_pres);
                                    @oci_execute($result_nome_pres);
                                    while($row_nome_pres = oci_fetch_array($result_nome_pres)){ ?>
                                        <option value="<?php echo $row_nome_pres['CD_PRESTADOR']; ?>"><?php echo $row_nome_pres['NM_PRESTADOR']; ?></option> <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        Atendimento:
                        <div class="input-group">
                            <input class="form-control input-Atend" type="text" placeholder="Atendimento" name="Atendimento" required>
                            <div style="width:30px;"></div><button type="submit" class=" btn btn-primary" id="btn_pesquisar"> <i class="far fa-eye"></i> </button>	
                            <input type="hidden" id="valor" type="text" readonly />
                        </div> 
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>

<script>
    //Remover "/" da data quando pressionar o delete

        var input = document.getElementById('id1');
        
        input.onkeydown = function() {
            var quant1 = input.value;
            var key = event.keyCode || event.charCode; 

            if( key == 8 || key == 46 ){
                if(quant1.slice(-1) == "/" ){
                input.value = quant1.substring(0, quant1.length - 1);
                }
            }
        };

        var input2 = document.getElementById('id2');
        
        input2.onkeydown = function() {
            var quant1 = input2.value;
            var key = event.keyCode || event.charCode; 

            if( key == 8 || key == 46 ){
                if(quant1.slice(-1) == "/" ){
                 input2.value = quant1.substring(0, quant1.length - 1);
                }
            }
        };
</script>

<?php
//INCLUDE RODAPÉ
    include 'rodape.php';
?>

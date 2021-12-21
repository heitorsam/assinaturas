<?php 
    session_start();	

    //CABECALHO
    include 'cabecalho.php';

    //CONEXAO
    include 'conexao.php';


     //RECEBENDO POST
     if(isset($_POST['cd_atendimento'])){

        @$var_cd_atendimento = $_POST['cd_atendimento'];

        $_SESSION['atdpdf'] = $_POST['cd_atendimento'];
               

    } else {
        
        @$var_cd_atendimento = 0;   
    }


    ////////////
    //PACIENTE//
    ///////////
    $cons_atend="SELECT ate.CD_ATENDIMENTO, pac.NM_PACIENTE, ate.DT_ATENDIMENTO, con.NM_CONVENIO
                FROM ATENDIME ate
                INNER JOIN paciente  pac ON pac.cd_paciente = ate.cd_paciente
                INNER JOIN CONVENIO  con ON con.cd_convenio = ate.cd_convenio
                WHERE ate.cd_atendimento = '$var_cd_atendimento'";

    $result_atendimento = oci_parse($conn_ora, $cons_atend);
    @oci_execute($result_atendimento);
    $row_aten = oci_fetch_array($result_atendimento);
    if(!isset( $row_aten['CD_ATENDIMENTO']) && isset($_POST['cd_atendimento'])){
        $_SESSION['msgerro'] = "Número de atendimento não encontrado."; 
    }
    
    @$var_cd_atendimento = $row_aten['CD_ATENDIMENTO'];
    @$var_nm_paciente = $row_aten['NM_PACIENTE'];
    @$var_dt_aten = $row_aten['DT_ATENDIMENTO'];
    @$var_nm_conv = $row_aten['NM_CONVENIO'];


    ///////////////////////////
    //Verifica se existe pdf///
    //para aquele atendimento//
    ///////////////////////////
    if(isset($_POST['cd_atendimento'])){
    $cons_pdf ="SELECT *
    FROM dbamv.teste_assinaturas ass
    WHERE ass.cd_atendimento = $var_cd_atendimento
    ";

    $result_pdf_exis = oci_parse($conn_ora, $cons_pdf);
    @oci_execute($result_pdf_exis);
    $row_pdf_exis = oci_fetch_array($result_pdf_exis);
    @$var_pdf_existe = $row_pdf_exis['BLOB_ANEXO'];
    }
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
        <h27> <a href="index.php" style="color: #444444; text-decoration: none;"> <i class="fa fa-reply" aria-hidden="true"></i> Voltar </a> </h27> 


        <div class="div_br"> </div>
        <form method="post" autocomplete="off" action="gerar_documento.php">
            <div class="row">
                <div class="col-md-3 ">
                    Atendimento:
                    <div class="input-group">

                    <?php if(isset($_POST['cd_atendimento'])){ ?>
                        <input class="form-control input-group" type="text" value="<?php echo @$var_cd_atendimento;?>" name="cd_atendimento" required>
                    <?php } else { ?>
                        <input class="form-control input-group" type="text"  name="cd_atendimento" required>
                    <?php }?>

                        <button type="submit" class=" btn btn-primary" id="btn_pesquisar"> <i class="fa fa-search" aria-hidden="true"></i></button>	
                        <input type="hidden" id="valor" type="text" readonly />
                    </div> 
                </div>
            </div>
        </form>
        </br>


        
       <!---RESULTADO DA PESQUISA-->

       <?php if(strlen($var_nm_paciente) > 1){ ?>
       <form method="post" autocomplete="off" id="assinatura" action="gerar_documento_pdf.php">
            <div class="row">
            <div class="col-md-3" id="div_sn_exame_mv">
                        <label>Atendimento:</label>
                        <input type="text"  class="form-control" value="<?php echo @$var_cd_atendimento?>" name="cd_atendimento" readonly></input>
                </div>
            <div class="col-md-3" id="div_sn_exame_mv">
                        <label>Paciente:</label>
                        <input type="text"  class="form-control" value="<?php echo @$var_nm_paciente?>" name="nm_paciente" readonly></input>
                </div>
                <div class="col-md-3" id="div_sn_exame_mv">
                        <label>Data Atendimento:</label>
                        <input type="text" value="<?php echo @$var_dt_aten ?>" class="form-control" name="dt_aten" readonly></input>
                </div>
                <div class="col-md-3" id="div_sn_exame_mv">
                        <label>Nome Convenio:</label>
                        <input type="text" value="<?php echo @$var_nm_conv;?>" class="form-control" name="nm_conv" readonly></input>
                </div>
                <?php if(isset($var_pdf_existe)){ ?>
                    <div class="col-md-3" style="margin-top: 10px;">
                    <a  class="btn btn-primary" href="exibi_pdf.php"><i  style="font-size: 30px" class="fas fa-file-pdf"></i></a>
                </div>
                <?php }else{?>
                <canvas id="canvas" name="canvas" style="border: solid 1px black; 
                margin-top: 20px;
                width: 600px; height: 150px;">
                <input type="hidden" name="escondidinho" id="escondidinho"></input>
                </canvas> 
            </div>
            <spam><spam>
            <div style="margin-top: 10px;">
                <button type="submit" class=" btn btn-primary"  id="botao_submit_assinatura">Enviar </button>
                <button type="button" class=" btn btn-primary" onClick="redraw()">Limpar</button>   
                <?php }	?>
            </div>
        </form>
       <?php }?>


          
<?php

    //RODAPE
    include 'rodape.php';
?>

<script>

    var form = document.getElementById("assinatura");
    

    document.getElementById("botao_submit_assinatura").addEventListener("click", function () {

    var canvas = document.getElementById("canvas");

    document.getElementById('escondidinho').value = canvas.toDataURL('image/png');
    document.forms["assinatura"].submit();

});


//ESPERA A PAGINA CARREGAR
window.addEventListener('load', ()=>{        
        
        //REDIMENSIONA CANVAS
        resize();
        document.addEventListener('mousedown', startPainting);
        document.addEventListener('mouseup', stopPainting);
        document.addEventListener('mousemove', sketch);
        window.addEventListener('resize', resize);
    });
        
    const canvas = document.querySelector('#canvas');
       
    //HABILITA OPCAO 2D
    const ctx = canvas.getContext('2d');
        
    //DEFINE O TAMANHO DO CANVAS
    function resize(){
      ctx.canvas.width = 600;
      ctx.canvas.height = 200;
    }
        
    //PEGA VALOR INICIAL DO CURSOR
    let coord = {x:0 , y:0}; 
       
    //LIBERA A FUNCAO PAINT
    let paint = false;
        
    //PEGA A POSICAO DO DESENHO
    function getPosition(event){
      coord.x = event.clientX - canvas.offsetLeft;
      coord.y = event.clientY - canvas.offsetTop;
    }
      
    //COLETA O INICIO E FIM DO DESENHO
    function startPainting(event){
      paint = true;
      getPosition(event);
      
    }
    function stopPainting(){
      paint = false;
    }
        
    function sketch(event){
      if (!paint) return;
      ctx.beginPath();
        
      //DEFINE A LARGURA DA LINHA
      ctx.lineWidth = 3;
       
      //DEFINE O TIPO DE LINHA
      ctx.lineCap = 'round';
        
      //DEFINE A COR DA LINHA
      ctx.strokeStyle = 'black';
          
      //ACOMPANHA A COORDENADA DO DESENHO
      ctx.moveTo(coord.x, coord.y);
       
      //COLETA A POSICAO DO EVENTO
      getPosition(event);
       
      //TRACA A COORDENADA CONFORME O DESENHO FOR FEITO
      ctx.lineTo(coord.x , coord.y);
        
      //REALIZA O DESENHO
      ctx.stroke();
    }

    //LIMPA O CANVAS
    function redraw(){
        const context = canvas.getContext('2d');
        context.clearRect(0, 0, canvas.width, canvas.height);

    }

</script>
<!-- Modal -->
<div class="modal fade" data-backdrop="static" id="modalanexomv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 800px !important; margin: 0 auto;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-camera"></i> Anexar Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

        <div class="modal-body">

        <form action="assinatura_SAME/Recepção/enviar_anexo_mv.php?cd_paciente=<?php echo $var_cd_paciente ?>" method="post" id="form_anexo" enctype="multipart/form-data">
              
              <div class="row">
                  <div class="form-group col-md-6">
                      <label for="frm_ds_doc">Descrição Documento:</label>
                      <input type="text" class="form-control" name="frm_ds_doc"
                      style="font-size: 14px !important;"
                      value="" required>
                  </div>

                  <div class="form-group col-md-6">
                      <label for="frm_tp_doc">Tipo do documento:</label>
                      <select class="form-control" name="frm_tp_doc" required>
                          <option value="IMAGEM">Imagem</option>
                      </select>
                  </div>
              </div>

              <div class="row">
                  <div class="form-group col-md-12">
                      <label for="frm_doc">Arquivo:</label>
                      <br>
                      <input type="file" id='file' name='file' required>
                  </div>
              </div>

              <div class="div_br"> </div>
              
              <!-- BOTOES -->
              <div class="row">
                <div class="form-group col-md-12">
                  <!-- <button type="submit" class=" btn btn-primary" id="btn_pesquisar"></button>	-->
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-times"></i> Fechar</button>
                  <button type="submit"  id="jv_cadastrar" class="btn btn-primary"><i class="fas fa-plus"></i> Cadastrar</button>
                </div>
              </div>

              <div class="div_br"> </div>

              <!-- ROW TABELA -->
              <div class="row">
                <div class="col-md-12">
                    <div id="jv_cadastrar_listar"></div>
                </div>
              </div>

          </form>
        </div>
    </div>
  </div>
</div>

<script>
    /////////////////
    //BUSCAR TABELA//
    /////////////////
    function AnexoFotoTabela() {
      //alert("PASSOU");    
      $('#jv_cadastrar_listar').load('assinatura_SAME/Recepção/funcoes/ajax_anexo_foto/ajax_anexo_foto_tabela.php?cd_paciente=' + <?php echo $var_cd_paciente ?>)
    }

    /////////////
    //CADASTRAR//
    /////////////

    //document.getElementById("jv_cadastrar").submit = function() {cadastrarAnexoFoto()};
    /*
      function cadastrarAnexoFoto() {
        //alert("PASSOU");    

        //AnexoFotoTabela();

        var jv_ds_doc =   document.getElementById("jv_ds_doc").value;
        var jv_tp_doc =  document.getElementById("jv_tp_doc").value;
        var file =  document.getElementById("jv_file").value;
        var cd_paciente = <?php echo $var_cd_paciente ?>;

        //alert ('jv_ds_doc:' + jv_ds_doc);
        //alert ('jv_tp_doc:' + jv_tp_doc);
        //alert ('jv_file:' + jv_file);
        //alert ('cd_paciente:' + cd_paciente);
      
        $.ajax({
            url: "assinatura_SAME/Recepção/enviar_anexo_mv.php",
            type: "POST",
            data: {
              jv_ds_doc: jv_ds_doc,
              jv_tp_doc: jv_tp_doc,
              file: file,
              cd_paciente: cd_paciente		
                },
            cache: false,
            success: function(dataResult){
              alert(dataResult);
              
            }
        });

      }
    */



    ///////////
    //EXCLUIR//
    ///////////
    function excluir_bras($var_cd_arquivo_documento){
        //alert("PASSOU");
        var cd_arquivo_documento = $var_cd_arquivo_documento;
        
        $.ajax({
            url: "assinatura_SAME/Recepção/funcoes/ajax_anexo_foto/ajax_excluir_anexo_foto.php",
            type: "POST",
            data: {
                cd_arquivo_documento: cd_arquivo_documento
                },
            cache: false,
            success: function(dataResult){
                    //alert("PASSOU");
                    AnexoFotoTabela();
            }
        });
    }



    ///////////////////////////
    //TRAZER TABELA CARREGADA//
    ///////////////////////////
    document.getElementById("jv_Abrir_Modal").onclick = function() {trazerTabela()};
    function trazerTabela() {
      //alert("PASSOU");
      AnexoFotoTabela();
    }


    //////////////////////////////////////////
    //REGARREGAR A PAGINA COM A MODAL ABERTA//
    //////////////////////////////////////////
    /*$(window).load(function() {

      var aa = '<?php $_SESSION['modalconfig'] ?>';
      alert('modalconfig:' + aa);

      $('#modalanexomv').modal('show');
      AnexoFotoTabela();
    });
    */

</script>
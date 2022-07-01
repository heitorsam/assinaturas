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

              <div class="row">
                  <div class="form-group col-md-6">
                      Descrição Documento:
                      <input type="text" class="form-control" id="frm_ds_doc" style="font-size: 14px !important;" required>
                  </div>

                  <div class="form-group col-md-6">
                      Tipo do documento:
                      <select class="form-control" id="frm_tp_doc" required>
                          <option value="IMAGEM">Imagem</option>
                      </select>
                  </div>
              </div>

              <div class="row">
                  <div class="form-group col-md-12">
                      Arquivo:
                      <br>
                      <input type="file" id='file' required>
                  </div>
              </div>

              <div class="div_br"> </div>
              
              <!-- BOTOES -->
              <div class="row">
                <div class="form-group col-md-12">
                  <!-- <button type="submit" class=" btn btn-primary" id="btn_pesquisar"></button>	-->
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-times"></i> Fechar</button>
                  <button type="button" class="btn btn-primary"  id="jv_cadastrar"><i class="fas fa-plus"></i> Cadastrar</button>
                </div>
              </div>

              <div class="div_br"> </div>

              <!-- ROW TABELA -->
              <div class="row">
                <div class="col-md-12">
                    <div id="jv_cadastrar_listar"></div>
                </div>
              </div>
        </div>
    </div>
  </div>
</div>

<script>
    /////////////
    //CADASTRAR//
    /////////////

    document.getElementById("jv_cadastrar").onclick = function() {cadastrarAnexoFoto()};
    
      function cadastrarAnexoFoto() {
        //var jv_ds_doc =   document.getElementById("frm_ds_doc").value;
        //var jv_tp_doc =  document.getElementById("frm_tp_doc").value;
        //var cd_paciente = <?php //echo $var_cd_paciente ?>;

        var file_data = $('#file').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('file', file_data);
        alert(form_data);
        //alert ('jv_ds_doc:' + jv_ds_doc);
        //alert ('jv_tp_doc:' + jv_tp_doc);
        //alert ('form_data:' + form_data);
        //alert ('cd_paciente:' + cd_paciente);

        $.ajax({
          url: 'assinatura_SAME/Recepção/enviar_anexo_mv.php', // <-- point to server-side PHP script 
          cache: false,
          contentType: false,
          processData: false,
          data: form_data: form_data,
          
          type: 'POST',
          success: function(dataResult){
              alert(dataResult);
          }
        });

      /*
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
      */
      }

    /////////////////
    //BUSCAR TABELA//
    /////////////////
    function AnexoFotoTabela() {
      //alert("PASSOU");    
      $('#jv_cadastrar_listar').load('assinatura_SAME/Recepção/funcoes/ajax_anexo_foto/ajax_anexo_foto_tabela.php?cd_paciente=' + <?php echo $var_cd_paciente ?>)
    }
    
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
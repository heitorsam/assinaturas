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
          <form id="formAjax" action="modal_anexo_mv.php" method="POST">

              <div class="row">
                  <div class="form-group col-md-6">
                      Descrição Documento:
                      <input type="text" class="form-control" id="frm_ds_doc" style="font-size: 14px !important;" >
                  </div>

                  <div class="form-group col-md-6">
                      Tipo do documento:
                      <select class="form-control" id="frm_tp_doc" >
                          <option value="DOC_RG_FV">RG - Frente/Verso</option>
                          <option value="DOC_RG_F">RG - Frente</option>
                          <option value="DOC_RG_V">RG - Verso</option>
                          <option value="DOC_CNH">CNH</option>
                          <option value="DOC_NASCIMENTO">Certidão de Nascimento</option>
                          <option value="DOC_CASAMENTO">Certidão de Casamento</option>
                      </select>
                  </div>
              </div>

              <div class="row">
                  <div class="form-group col-md-12">
                      Arquivo:
                      <br>
                      <input type="file" id="fileAjax" name="fileAjax" >
                  </div>
              </div>

              <div class="div_br"> </div>
              
              <!-- BOTOES -->
              <div class="row">
                <div class="form-group col-md-12">
                  <input class=" btn btn-primary" type="submit" id="submit" name="submit"></div>
              </div>

              <div class="div_br"> </div>

              <!-- ROW TABELA -->
              <div class="row">
                <div class="col-md-12">
                    <div id="jv_cadastrar_listar"></div>
                </div>
              </div>
          </form>
          <p id="status"></p>
        </div>
    </div>
  </div>
</div>

<script>

  var myForm = document.getElementById('formAjax');  // Our HTML form's ID
  var myFile = document.getElementById('fileAjax');  // Our HTML files' ID
  var statusP = document.getElementById('status');
  var frm_ds_doc = document.getElementById('frm_ds_doc');
  var frm_tp_doc = document.getElementById('frm_tp_doc');

    /////////////
    //CADASTRAR//
    /////////////
      myForm.onsubmit = function(event) {
        event.preventDefault();

        //statusP.innerHTML = 'Uploading...';

        // Get the files from the form input
        var files = myFile.files;
        var ds_doc = frm_ds_doc.value;
        var tp_doc = frm_tp_doc.value;
        var cd_paciente = <?php echo $var_cd_paciente ?>;

        // Create a FormData object
        var formData = new FormData();

        // Select only the first file from the input array
        var file = files[0];

        // Check the file type
        if (!file.type.match('image.*')) {
            statusP.innerHTML = 'o arquivo selecionado não é uma imagem.';
            return;
        }

        // Add the file to the AJAX request
        formData.append('fileAjax', file, file.name);
        formData.append('ds_doc', ds_doc);
        formData.append('tp_doc', tp_doc);
        formData.append('cd_paciente', cd_paciente);

        // Set up the request
        var xhr = new XMLHttpRequest();
        // Open the connection
        xhr.open('POST', 'assinatura_SAME/Recepção/enviar_anexo_mv.php', true);

        // Set up a handler for when the task for the request is complete
        xhr.onload = function () {
          if (xhr.status == 200) {
            //statusP.innerHTML = 'Upload complete!';
            AnexoFotoTabela();
          } else {
            //statusP.innerHTML = 'Upload error. Try again.';
            AnexoFotoTabela();
          }
        };

        // Send the data.
        xhr.send(formData);
              
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
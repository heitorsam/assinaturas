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
                      <input type="text" class="form-control" id="frm_ds_doc" style="font-size: 14px !important;" required>
                  </div>

                  <div class="form-group col-md-6">
                      Tipo do documento:
                      <select class="form-control" id="frm_tp_doc" required>
                          <option value="RG">RG</option>
                          <option value="CPF">CPF</option>
                          <option value="CNH">CNH</option>
                      </select>
                  </div>
              </div>

              <div class="row">
                  <div class="form-group col-md-12">
                      Arquivo:
                      <br>
                      <input type="file" id="fileAjax" name="fileAjax" required>
                  </div>
              </div>

              <div class="div_br"> </div>
              
              <!-- BOTOES -->
              <div class="row">
                <div class="form-group col-md-12">
                  <!-- <button type="submit" class=" btn btn-primary" id="btn_pesquisar"></button>	-->
                  <input type="submit" id="submit" name="submit" value="Upload" />
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
          <p id="status"></p>
        </div>
    </div>
  </div>
</div>

<script>

  var myForm = document.getElementById('formAjax');  // Our HTML form's ID
  var myFile = document.getElementById('fileAjax');  // Our HTML files' ID
  var frm_ds_doc = document.getElementById('frm_ds_doc').value;  // Our HTML files' ID
  
  var statusP = document.getElementById('status');

  myForm.onsubmit = function(event) {
    var frm_ds_doc = document.getElementById('frm_ds_doc').value;  // Our HTML files' ID
    alert(frm_ds_doc);
      event.preventDefault();
/*
      statusP.innerHTML = 'Uploading...';

      // Get the files from the form input
      var files = myFile.files;

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

      // Set up the request
      var xhr = new XMLHttpRequest();

      // Open the connection
      xhr.open('POST', 'assinatura_SAME/Recepção/enviar_anexo_mv.php?cd_paciente=' + <?php echo $var_cd_paciente ?>', true);

      // Set up a handler for when the task for the request is complete
      xhr.onload = function () {
        if (xhr.status == 200) {
          statusP.innerHTML = 'Upload complete!';
        } else {
          statusP.innerHTML = 'Upload error. Try again.';
        }
      };

      // Send the data.
      xhr.send(formData);
      */
  }
























































  /*
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
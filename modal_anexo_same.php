<!-- Modal -->
<div class="modal fade" data-backdrop="static" id="modalanexomv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width: 800px !important; margin: 0 auto;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-camera"></i> Anexar arquivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="enviar_anexo_mv.php?cd_atendimento=<?php echo $var_cd_atendimento ?>" method="post" id="form_anexo" enctype="multipart/form-data">
            <div class="row align-self-center" >
              
                <div class="form-group col-md-12">
                    <label for="frm_ds_doc">Descrição Documento:</label>
                    <input type="text" class="form-control" name="frm_ds_doc"
                    style="font-size: 14px !important;"
                    value="" required>
                </div>
                
                <div class="form-group col-md-12">
                    <label for="frm_tp_doc">Tipo do documento:</label>
                    <select class="form-control" id="frm_tp_doc" name="frm_tp_doc" required>
                        <option value="IMAGEM">Imagem</option>
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label for="frm_doc">Arquivo:</label>
                    <br>
                    <input type="file" id='file' name='file' required>
                </div>
                
                <div class="form-group col-md-12">
                    
                    <button style="margin: 0px !important" class='btn btn-primary' type='submit' form='form_anexo' value='Submit'>
                        <i class='fa fa-paper-plane-o' aria-hidden='true'></i> Enviar</button>
                </div>

                <div style="width: 90%; margin: 0 auto;">

                  <?php include 'tabela_baixar_anexo_mv.php'; ?>

                </div>

            </div>
        </form>
      </div>
    </div>
  </div>
</div>

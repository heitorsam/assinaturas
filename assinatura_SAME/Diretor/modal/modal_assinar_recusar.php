<!--MODAL-->
<div class="modal fade " id="visualizaModalAssinado" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Documento Assinado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <input type="hidden" id="js_cd_paciente" name="frm_cd_paciente"> </input>
                <div class="modal-body" id="body_result" style="margin-left: 10px; width: 100%">              
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-times"></i> Fechar</button>
                    <?php if(@$_SESSION['sn_usuario_same_diretor'] == 'S'){ ?>
                        <button type="button" id='jv_btn_recusar' class="btn btn-danger"> <i class="fas fa-times"></i> Recusar</button>
                        <button type="submit" id='jv_btn_assinar' class="btn btn-primary"><i class="fas fa-plus"></i> Assinar</button>
                    <?php } ?>

                </div>
        </div>
    </div>
</div>

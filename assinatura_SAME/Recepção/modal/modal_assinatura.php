<!--MODAL ASSINATURA-->
<div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Assinatura</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body" style="margin: 0 auto;">
            <canvas id="sig-canvas" width="620" height="160" style="border: solid 1px black; 
                    margin-top: 20px;
                    width: 600px; height: 150px;">
            </canvas>
            <input type="hidden" name="escondidinho" id="escondidinho"></input>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="sig-clearBtn" onClick="redraw()"><i class="fas fa-eraser"></i> Limpar</button>
            <button type="button" type="submit" class="btn btn-primary" id="sig-submitBtn"><i class="fas fa-paper-plane"></i> Enviar</button>
        </div>
        </div>
    </div>
</div>
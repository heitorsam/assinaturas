<?php

    session_start();

    //CONEXAO
    include 'conexao.php';

    @$_SESSION['atdconsulta'] = $_SESSION['atdpdf'];

    $var_cd_atendimento = $_SESSION['atdpdf'];

    ///////////////
    //PDF DOWLOAD//
    ///////////////
    $cons_dowload="SELECT *
    FROM ASSINATURAS.DOCUMENTOS_ASSINADOS ass
    WHERE ass.cd_atendimento = $var_cd_atendimento
    AND TP_DOCUMENTO LIKE 'cont_pa'";

    $result_dowload = oci_parse($conn_ora, $cons_dowload);
    @oci_execute($result_dowload);
    $result= oci_fetch_array($result_dowload);
    $image =$result['BLOB_ANEXO']->load();
    //$content= $result['BLOB_ANEXO']; 

?>
<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
<div>
<a class="btn btn-primary" href="gerar_documento.php"><i class="fas fa-file-excel"></i> <button>Voltar</button></a>
</div>
<canvas id="the-canvas"></canvas>
<!--<iframe src="data:application/pdf;base64,<?php echo base64_encode($image) ?>" type="application/pdf" style="height:100%;width:100%" title="Iframe Example">
</iframe>-->



<script>
    var pdfData = atob("<?php echo base64_encode($image); ?>");

// Loaded via <script> tag, create shortcut to access PDF.js exports.
var pdfjsLib = window['pdfjs-dist/build/pdf'];

// The workerSrc property shall be specified.
pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

// Using DocumentInitParameters object to load binary data.
var loadingTask = pdfjsLib.getDocument({data: pdfData});
loadingTask.promise.then(function(pdf) {
  console.log('PDF loaded');
  
  // Fetch the first page
  var pageNumber = 1;
  pdf.getPage(pageNumber).then(function(page) {
    console.log('Page loaded');
    
    var scale = 1.5;
    var viewport = page.getViewport({scale: scale});

    // Prepare canvas using PDF page dimensions
    var canvas = document.getElementById('the-canvas');
    var context = canvas.getContext('2d');
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    // Render PDF page into canvas context
    var renderContext = {
      canvasContext: context,
      viewport: viewport
    };
    var renderTask = page.render(renderContext);
    renderTask.promise.then(function () {
      console.log('Page rendered');
    });
  });
}, function (reason) {
  // PDF loading error
  console.error(reason);
});
</script>


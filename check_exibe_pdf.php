<?php

    session_start();

    //CONEXAO
    include 'conexao.php';

    $data_check = $_POST['data1'];
    $cd_prest = $_POST['Prestador'];
    $cd_atd = $_POST['Atendimento'];

    ///////////////
    //PDF DOWLOAD//
    ///////////////

    //echo '</br></br>';

    $cons_dowload= "SELECT da.*
    FROM assinaturas.DOC_ASSINATURA da
    WHERE da.CD_ATENDIMENTO = '$cd_atd'
    AND da.CD_PRESTADOR = '$cd_prest'
    AND da.DT_DOC_ASSINATURA = TO_DATE('$data_check','DD/MM/YYYY')";

    $result_dowload = oci_parse($conn_ora, $cons_dowload);
    @oci_execute($result_dowload);
    $result= oci_fetch_array($result_dowload);
    $image =$result['ANEXO_DOC_ASSINATURA']->load();
    //$content= $result['DOC']; 
?>
<script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>
<div>
<a class="btn btn-primary" href="check_visualizar_documento.php"><i class="fas fa-file-excel"></i> <button>Voltar</button></a>
</div>
<canvas id="the-canvas1"></canvas>
<canvas id="the-canvas2"></canvas>
<canvas id="the-canvas3"></canvas>
<canvas id="the-canvas4"></canvas>
<canvas id="the-canvas5"></canvas>

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
  var count = 1;
  while(pageNumber <= 5){
  pdf.getPage(pageNumber).then(function(page) {
    console.log('Page loaded');
    
    var scale = 1.5;
    
    var viewport = page.getViewport({scale: scale});

    // Prepare canvas using PDF page dimensions
    var id = 'the-canvas' + count;
    console.log(id);
    var canvas = document.getElementById(id);
    var context = canvas.getContext('2d');
    canvas.height = viewport.height;
    canvas.width = viewport.width;
    count = count +1;
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
  pageNumber = pageNumber + 1;
  };
}, function (reason) {
  // PDF loading error
  console.error(reason);
});
</script>


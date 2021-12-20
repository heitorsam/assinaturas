<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
    <title>
        Assinatura
    </title>
</head>
  
<body>
    
    <canvas id="canvas" style="border: solid 1px black; width: 600px; height: 200px;"></canvas>
    </br>
    <a id="download" download="image.png"><button type="button" onClick="download()">Download</button></a>
    <a><button type="button" onClick="redraw()">Limpar</button></a>


</body>
  
</html>

<script>

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

    //FUNCIONALIDADE PARA O DOWNLOAD
    function download(){
        var download = document.getElementById("download");
        var image = document.getElementById("canvas").toDataURL("image/png")
                    .replace("image/png", "image/octet-stream");
        download.setAttribute("href", image);

    }

    //LIMPA O CANVAS
    function redraw(){
        const context = canvas.getContext('2d');
        context.clearRect(0, 0, canvas.width, canvas.height);

    }

</script>
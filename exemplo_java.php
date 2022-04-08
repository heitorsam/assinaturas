<head>
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

</br>
<!-- 
<div id="caixa_aldrik" style="width: 100px; height: 50px; background-color: red; color: white;">

	Aldrik

</div>

</br>
-->




DOC 1 <input type="checkbox" id="Doc1"></br>
DOC 2 <input type="checkbox" id="Doc2"></br>
DOC 3 <input type="checkbox" id="Doc3"></br>

<button onclick="funcao_ocultar_exibir()";> Ocultar/Exibir </button></br></br>

 </br></br>




 <form onsubmit="myFunction()">
  Enter name: <input type="text" id="text">

  <button type="submit">enviar</button>

  <input type="submit">
</form>

event.preventDefault()

 


		<div class="row">
			<div class="col-md-12" id="">
				<input type="button" class="btn-danger" id="escdoc1" value="DOC 1" style="width: 100px; height: 30px; display: none;"></input>
			</div>

			<div class="col-md-12" id="">
				<input type="button" class="btn-warning" id="escdoc2" value="DOC 2" style="width: 100px; height: 30px; display: none;"></input>
			</div>

			<div class="col-md-12" id="">
				<input type="button" class="btn-success" id="escdoc3" value="DOC 3" style="width: 100px; height: 30px; display: none;"></input>
			</div>
		</div>

			

<script>

	var chkDoc1 = document.getElementById("Doc1");	
	var chkDoc2 = document.getElementById("Doc2");
	var chkDoc3 = document.getElementById("Doc3");


	function funcao_ocultar_exibir(){
		var text = document.getElementById("text");
	}


	//alert('ola mundo!');
	function funcao_ocultar_exibir(){
		if (chkDoc1.checked) {
        	escdoc1.style.display = 'inline';
		} else {
			escdoc1.style.display = 'none';
		}

		if (chkDoc2.checked) {
        	escdoc2.style.display = 'inline';
		} else {
			escdoc2.style.display = 'none';
		}

		if (chkDoc3.checked) {
        	escdoc3.style.display = 'inline';
		} else {
			escdoc3.style.display = 'none';
		}

		
		//alert('teste botao!');

		//INFORMANDO QUE A VARIAVEL CAIXA É A DIV CAIXA ALDRIK
			
		/*
		var valor_atual_doc1 = caixa1.style.display;
		var valor_atual_doc2 = caixa2.style.display;
		var valor_atual_doc3 = caixa3.style.display;
		
		//alert(valor_atual);

		if(valor_atual_doc1 == 'none'){

			escdoc1.style.display = 'block';

		}else{

			caixa.style.display = 'none';

		}*/

	}

</script>












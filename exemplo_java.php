
<button onclick="funcao_ocultar_exibir()";> Ocultar/Exibir </button>

</br></br>

<div id="caixa_aldrik" style="width: 100px; height: 50px; background-color: red; color: white;">

	Aldrik

</div>

</br>

Golpe <input type="checkbox" id="golpe">


<script>

	//alert('ola mundo!');

	function funcao_ocultar_exibir(){

		//alert('teste botao!');

		//INFORMANDO QUE A VARIAVEL CAIXA É A DIV CAIXA ALDRIK
		var caixa = document.getElementById("caixa_aldrik");		

		var valor_atual = caixa.style.display;

		//alert(valor_atual);

		if(valor_atual == 'none'){

			caixa.style.display = 'block';

		}else{

			caixa.style.display = 'none';

		}

	}

</script>
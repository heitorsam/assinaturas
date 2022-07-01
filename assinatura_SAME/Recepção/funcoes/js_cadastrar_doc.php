<script type="text/javascript">

	$(document).ready(function(){

		/*TODA VEZ QUE ABRIR O MODAL EXECUTAR ESSA FUNCAO*/

		$(document).on('shown.bs.modal','.modal', function (event) {
			// DO EVENTS
			var button = $(event.relatedTarget) //Button that triggered the modal
			var cd_paciente = button.data('cd_paciente') 
			var nm_paciente = button.data('nm_paciente')   
			var identificador = button.data('identificador') 
			//console.log(identificador);

			//PASSANDO VALOR DO CAMPO PESQUISA E EXECUTANDO AJAX

			//NÃO ASSINADOS
			if(identificador == 'same'){

				$.getJSON('visualizar_guia_same.php?search=',{cd_paciente: cd_paciente, nm_paciente: nm_paciente, ajax: 'true'}, 
					function(j){
					if(j){
						//alert("Certo");
						$("#visualizaModal .modal-body").html(j[0]);            
					} 
					else {
						alert("Erro");
					}
			});	

			
			//ASSINADOS
			}else if(identificador == 'guia_same_assinado'){

				$("#visualizaModalAssinado .modal-body").load('assinatura_SAME/exibi_pdf_guia_same.php');
		
				}
		});

		//AÇÃO APOS ASSINAR

		document.getElementById("sig-submitBtn").addEventListener("click", function () {
			//alert("Aqui");

			var canvas = document.getElementById("sig-canvas");

			var cd_paciente = document.getElementById("cd_paciente").value;
			console.log(cd_paciente);

			var nm_paciente = document.getElementById("paciente").value;
			console.log(nm_paciente);

			var escondidinho = document.getElementById('escondidinho').value = canvas.toDataURL('image/png');
			console.log(escondidinho);

			//alert(cd_paciente);
			//alert(nm_paciente);
			//alert(escondidinho);
			
			//ASSINA O DOCUMENTO
			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: 'assinatura_SAME/Recepção/funcoes/ajax_gerar_pdf.php',
				data: {cd_paciente: cd_paciente,
						nm_paciente: nm_paciente,
						escondidinho:escondidinho},
				success: function (msg){
					//alert(msg);
				},

				error: function (msg){
					alert("Erro");
				}
							
			});
			
			//CADASTRA A ASSINATURA 
			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: 'cad_assinaturas_requerente.php',
				data: {cd_paciente: cd_paciente,
					escondidinho:escondidinho},

						success: function (msg){
							//alert(msg);
						},

						error: function (msg){
							//alert("Erro");
					}
							
			});

			window.setTimeout(function(){location.reload()},1000)
			
		});

	});

</script>
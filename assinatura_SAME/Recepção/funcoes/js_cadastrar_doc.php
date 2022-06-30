<script type="text/javascript">

	$(document).ready(function(){

		/*TODA VEZ QUE ABRIR O MODAL EXECUTAR ESSA FUNCAO*/

		$(document).on('shown.bs.modal','.modal', function (event) {

			// DO EVENTS
			var button = $(event.relatedTarget) //Button that triggered the modal
			var cd_atendimento = button.data('cd_atendimento')   
			var cd_paciente = button.data('cd_paciente') 
			var nm_paciente = button.data('nm_paciente')   
			var dt_aten = button.data('dt_aten')       
			var nm_conv = button.data('nm_conv') 
			var tp_doc = button.data('tp_doc')     
			var identificador = button.data('identificador') 
			//console.log(identificador);


			//PASSANDO VALOR DO CAMPO PESQUISA E EXECUTANDO AJAX

			//NÃO ASSINADOS

			if(identificador == 'same'){

				$.getJSON('visualizar_guia_same.php?search=',{cd_atendimento: cd_atendimento, cd_paciente: cd_paciente,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv, ajax: 'true'}, function(j){

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

				$("#visualizaModalAssinado .modal-body").load('exibi_pdf_guia_same.php');
		
			}


		});

		//AÇÃO APOS ASSINAR

		document.getElementById("sig-submitBtn").addEventListener("click", function () {
			//alert("Aqui");

			var canvas = document.getElementById("sig-canvas");
		
			var cd_atendimento = document.getElementById("atendimento").value;
			console.log(cd_atendimento);

			var cd_paciente = document.getElementById("cd_paciente").value;
			console.log(cd_paciente);

			var nm_paciente = document.getElementById("paciente").value;
			console.log(nm_paciente);

			var dt_aten = document.getElementById("dt_atendimento").value;
			console.log(dt_aten);

			var nm_conv = document.getElementById("nm_convenio").value;
			console.log(nm_conv);

			var escondidinho = document.getElementById('escondidinho').value = canvas.toDataURL('image/png');
			console.log(escondidinho);

			//CONVENIO 
			var cd_conv = document.getElementById("cd_convenio").value;
			console.log(cd_conv);
			
			//TIPO ATENDIMENTO 
			var tb_atd = document.getElementById("tipoatendimento").value;
			console.log(tb_atd);
		
			//ASSINA O DOCUMENTO
			$.ajax({
				//Configurações
				type: 'POST',//Método que está sendo utilizado.
				dataType: 'html',//É o tipo de dado que a página vai retornar.
				url: 'gerar_documento_pdf_guia_same.php',//Indica a página que está sendo solicitada.
				//função que vai ser executada assim que a requisição for enviada
				data: {cd_atendimento: cd_atendimento, cd_paciente: cd_paciente,nm_paciente: nm_paciente,dt_aten: dt_aten,nm_conv: nm_conv,escondidinho:escondidinho},//Dados para consulta
				//função que será executada quando a solicitação for finalizada.
				
					success: function (msg){
						//alert("Sucesso");
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
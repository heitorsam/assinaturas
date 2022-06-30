<script type="text/javascript">

    $(document).ready(function(){

        ////////////////////////
        //VISUALIZAR DOCUMENTO//
        ////////////////////////
        /*TODA VEZ QUE ABRIR O MODAL EXECUTAR ESSA FUNCAO*/
        $(document).on('shown.bs.modal','.modal', function (event) {
            //alert("Aqui");
            var button = $(event.relatedTarget) //Button that triggered the modal    
            var identificador = button.data('identificador') 
            var cd_paciente = button.data('cd_paciente') 
            var tp_doc = button.data('tp_doc') 
            
            //alert(tp_doc);

            
            document.getElementById('js_cd_paciente').value = cd_paciente; 

            //PASSANDO VALOR DO CAMPO PESQUISA E EXECUTANDO AJAX
            if(identificador == 'guia_same_assinado'){

                var btn_recusar = document.getElementById('jv_btn_recusar');
                var btn_assinar = document.getElementById('jv_btn_assinar');
                if(tp_doc == 'same_concluido'){  
                        btn_recusar.style.display = 'inline';
                        btn_assinar.style.display = 'none';
                    }

                if(tp_doc == 'same_recusado'){  
                    btn_recusar.style.display = 'none';
                    btn_assinar.style.display = 'inline';
                }

                if(tp_doc == 'same_pendente'){  
                    btn_recusar.style.display = 'inline';
                    btn_assinar.style.display = 'inline';
                }

                $("#visualizaModalAssinado .modal-body").load('assinatura_SAME/exibi_pdf_guia_same.php?cd_paciente=' + cd_paciente);
                }
        }); 

        ///////////
        //RECUSAR//
        ///////////
        document.getElementById("jv_btn_recusar").onclick = function() {acaoRecusar()};

        function acaoRecusar() {

            var cd_paciente = document.getElementById('js_cd_paciente').value;
            $.ajax({
                    url: "assinatura_SAME/Diretor/funcoes/recusar_assinatura.php",
                    type: "POST",
                    data: {
                        cd_paciente: cd_paciente
                        },
                    cache: false,
                    success: function(dataResult){
                            //alert(dataResult);
                            //EXIBE A TABELA
                            window.setTimeout(function(){location.reload()},500);
                    }
                });
        }

        ///////////
        //ASSINAR//
        ///////////
        document.getElementById("jv_btn_assinar").onclick = function() {acaoAssinar()};

        function acaoAssinar() {
            var cd_paciente = document.getElementById('js_cd_paciente').value;
            //alert (cd_paciente);
            
            $.ajax({
                    url: "assinatura_SAME/Diretor/funcoes/salvar_assinatura.php",
                    type: "POST",
                    data: {
                        cd_paciente: cd_paciente
                        },
                    cache: false,
                    success: function(dataResult){
                            //alert(dataResult);
                            //EXIBE A TABELA
                            window.setTimeout(function(){location.reload()},500);
                    }
                });
                

        }
    });

</script>
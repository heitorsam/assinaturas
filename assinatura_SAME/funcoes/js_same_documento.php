<!-- JAVASCRIPT -->
<script>

    var radio_paciente = document.getElementById("flexRadio_Paciente");
    var radio_representanteLegal = document.getElementById("flexRadio_RepresentanteLegal");
    var radio_tutor = document.getElementById("flexRadio_Tutor");
    var radio_parente = document.getElementById("flexRadio_Parente");



    var filtro_parente =  document.getElementById("js_filtro_parente");

    ///////////////////
    ///RADIO PACIENTE//
    ///////////////////
    if(radio_paciente.checked){radioPaciente();}
    document.getElementById("flexRadio_Paciente").onclick = function() {radioPaciente()};

    function radioPaciente() {
        //alert("radioPaciente");

        filtro_parente.style.display = 'none';
        document.getElementById("js_frm_nome").value = '<?php echo $var_nm_paciente?>';
        document.getElementById("js_frm_rg").value = '<?php echo $var_rg ?>';
        document.getElementById("js_frm_cpf").value = '<?php echo $var_cpf ?>';
        document.getElementById("js_frm_estado_civil").value = '<?php echo $var_estado_civil ?>';
        document.getElementById("cep").value = '<?php echo $var_cep ?>';
        document.getElementById("js_frm_nascimento").value = '<?php echo $var_dt_requerente ?>';

        document.getElementById("js_frm_nome").readOnly = true;
        document.getElementById("js_frm_rg").readOnly = true;
        document.getElementById("js_frm_cpf").readOnly = true;
        document.getElementById("js_frm_estado_civil").readOnly = true;
        document.getElementById("cep").readOnly = true;
        document.getElementById("js_frm_nascimento").readOnly = true;
        document.getElementById("endereco").readOnly = true;
        document.getElementById("bairro").readOnly = true;
        document.getElementById("cidade").readOnly = true;
        document.getElementById("uf").readOnly = true;

        document.getElementById("js_filtro_parente").required = false;

        var var_cep = 0;
        var_cep = document.getElementById("cep").value;
        alimentaCEP(var_cep);

        document.getElementById("js_radio_escolha").value = 'Paciente';
    }

    //////////////////
    ///RADIO PARENTE//
    //////////////////
    document.getElementById("flexRadio_Parente").onclick = function() {radioParente()};

    function radioParente() {
        //alert("radioParente");
        limparCampos();
        filtro_parente.style.display = 'inline';
        document.getElementById("js_radio_escolha").value = 'Parente';
    }


    //////////////////////////////
    ///RADIO REPRESENTANTE LEGAL//
    //////////////////////////////
    document.getElementById("flexRadio_RepresentanteLegal").onclick = function() {radioRepLegal()};
    function radioRepLegal() {
        //alert("radioRepLegal");
        limparCampos();
        document.getElementById("js_radio_escolha").value = 'Representante Legal';
        document.getElementById("js_filtro_parente").required = false;
    }

    ////////////////
    ///RADIO TUTOR//
    ////////////////
    document.getElementById("flexRadio_Tutor").onclick = function() {radioTutor()};
    function radioTutor() {
        //alert("radioTutor");
        limparCampos();
        document.getElementById("js_radio_escolha").value = 'Tutor ou Curador';
        document.getElementById("js_filtro_parente").required = false;


    }

    /////////////////////////
    ///FUNÇÃO LIMPAR CAMPOS//
    /////////////////////////
    function limparCampos() {
        filtro_parente.style.display = 'none';

        document.getElementById("js_frm_nome").value = '';
        document.getElementById("js_frm_rg").value = '';
        document.getElementById("js_frm_cpf").value = '';
        document.getElementById("js_frm_estado_civil").value = '';
        document.getElementById("cep").value = ' ';
        document.getElementById("js_frm_nascimento").value = '';
        document.getElementById("endereco").value = '';
        document.getElementById("bairro").value = '';
        document.getElementById("cidade").value = '';
        document.getElementById("uf").value = '';

        document.getElementById("js_frm_nome").readOnly = false;
        document.getElementById("js_frm_rg").readOnly = false;
        document.getElementById("js_frm_cpf").readOnly = false;
        document.getElementById("js_frm_estado_civil").readOnly = false;
        document.getElementById("cep").readOnly = false;
        document.getElementById("js_frm_nascimento").readOnly = false;
        document.getElementById("endereco").readOnly = false;
        document.getElementById("bairro").readOnly = false;
        document.getElementById("cidade").readOnly = false;
        document.getElementById("uf").readOnly = false;
    
    }


    ///////////////
    ///FUNÇÃO CEP//
    ///////////////
    function alimentaCEP() {     

        // Remove tudo o que não é número para fazer a pesquisa

        var_cep = document.getElementById("cep").value;

        var cep = var_cep.replace(/[^0-9]/, "");

        // Validação do CEP; caso o CEP não possua 8 números, então cancela
        // a consulta
        if(cep.length != 8){
        return false;
        }

        // A url de pesquisa consiste no endereço do webservice + o cep que
        // o usuário informou + o tipo de retorno desejado (entre "json",
        // "jsonp", "xml", "piped" ou "querty")
        var url = "https://viacep.com.br/ws/"+cep+"/json/";

        // Faz a pesquisa do CEP, tratando o retorno com try/catch para que
        // caso ocorra algum erro (o cep pode não existir, por exemplo) a
        // usabilidade não seja afetada, assim o usuário pode continuar//
        // preenchendo os campos normalmente
        $.getJSON(url, function(dadosRetorno){
        try{
            // Preenche os campos de acordo com o retorno da pesquisa
            $("#endereco").val(dadosRetorno.logradouro);
            $("#bairro").val(dadosRetorno.bairro);
            $("#cidade").val(dadosRetorno.localidade);
            $("#uf").val(dadosRetorno.uf);
        }catch(ex){}
        });       

    }

    $("#cep").blur(function(){
        var var_cep = 0;
        var_cep = document.getElementById("cep").value;
        alimentaCEP(var_cep);
    });

        
</script>
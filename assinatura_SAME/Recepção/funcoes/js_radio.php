<script>

    var radio_presencial = document.getElementById("flexRadio_presencial");
    var radio_distancia = document.getElementById("flexRadio_distancia");

	var requerente_presencial = document.getElementById('requerente_presencial');
	var btnAssinar = document.getElementById('btnAssinar');
	var requetente_documento = document.getElementById('requetente_documento');
	var requetente_distancia = document.getElementById('requetente_distancia');


	/////////////////////
    ///RADIO PRESENCIAL//
    /////////////////////
    if(radio_presencial.checked){radioPresencial();}
    	document.getElementById("flexRadio_presencial").onclick = function() {radioPresencial()};
		function radioPresencial() {
		//alert("radioPresencial");

		requerente_presencial.style.display = 'inline';
		btnAssinar.style.display = 'inline';
		requetente_documento.style.display = 'inline';
		requetente_distancia.style.display = 'none';


    }

	////////////////////
    ///RADIO DISTANCIA//
    ////////////////////
    if(radio_distancia.checked){radioDistancia();}
    document.getElementById("flexRadio_distancia").onclick = function() {radioDistancia()};

    function radioDistancia() {
    //alert("radioDistancia");

	requerente_presencial.style.display = 'none';
	btnAssinar.style.display = 'none';
	requetente_documento.style.display = 'inline';
	requetente_distancia.style.display = 'inline';

    }



        
</script>
<?php

session_start();

//Conslta SQL
include 'sql_check_consulta_prest.php';

$nm_documneto = 'pdf_assinatura_'.$cd_atd.'.pdf';

//CONTADOR

$count_break = 0;


/* Preparação do documento final
 */
$documentTemplate = "<!doctype html> 
<html lang='en'> 
    <head> 
        <!-- Required meta tags --> 
        <meta charset='utf-8'> 
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'> 
    
    </head>
    <style>

    .col-hss-1,.col-hss-2,.col-hss-3,.col-hss-4, .col-hss-5, .col-hss-6, .col-hss-7, .col-hss-8, .col-hss-9, .col-hss-10, .col-hss-11, .col-hss-12 {
    
    height: 25px;
    font-size: 7px;
    background-color: #ffffff;
    margin: 1 1 1 1;
    border: solid 1px black !important;

}

.faixa-cinza{

    height: 10px !important;
    font-size: 8px; 
    background-color: #cccccc;
    line-height: 7px;
    clear:both;
}


.row{

    width: 100% !important;
    clear:both;

}
.col-hss-12{

    width: 99% !important;
    height: 20px;
    float: left;
}
.col-hss-11{

    width: 90.66% !important;
    height: 20px;
    float: left;
}
.col-hss-10{

    width: 82.33% !important;
    height: 20px;
    float: left;
}
.col-hss-9{

    width: 74% !important;
    height: 20px;
    float: left;
}
.col-hss-8{

    width: 65.66% !important;
    height: 20px;
    float: left;
}
.col-hss-7{

    width: 57.33% !important;
    height: 20px;
    float: left;
}
.col-hss-6{

    width: 49% !important;
    height: 20px;
    float: left;
}
.col-hss-5{

    width: 40.66% !important;
    height: 20px;
    float: left;
}
.col-hss-4{

    width: 32.33% !important;
    height: 20px;
    float: left;
}
.col-hss-3{

    width: 24% !important;
    height: 20px;
    float: left;
}

.col-hss-2{

    width: 15.66% !important;
    height: 20px;
    float: left;
    
}

.col-hss-1{

    width: 7.33% !important;
    height: 20px;
    float: left;
}

h2{
    font-size: 10px;
    line-height: 12px;
    margin-top: 0px;

    
}

h99{
    font-family: Andale Mono, monospace;
    display: inline-block;
    color: black;
    font-size: 12px;
    line-height: 10px;
    text-transform: uppercase;
    text-align: center;
    transform: rotate(-5deg);
    letter-spacing: -1px;
    font-weight: bold;
}

</style> 
    <body>
        <form style='height: 40px;'>
            <div class='container'>
                <div class='row'>
                    <div class='col-hss-12' style='color: black; border: none !important; background-color: #6498c8; text-align: center;'>
                    <h2 Style='font-size: 18px !important; line-height: 1 !important;'>Checagem por Prestador</h2>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-hss-4' style='border: none !important; line-height: 23 !important;'>
                        <img src='https://www.santacasasjc.com.br/wp-content/uploads/2018/06/logotipo-santa-casa-sjc-210x75.png' alt='Logo Santa Casa' width='150' height='75' >
                    </div>
                    <div class='col-hss-4' style='border: none !important; text-align: center;'>
                        <h1>Santa Casa de Misericórdia de São José dos Campos</h1>
                        <h2>Rua Dolzani Ricardo, 620 - Fone: (012) 3876-1999<br>CEP 12210-110 - São José dos Campos - SP<br>CNPJ 45.186.053/0001-87</h2>
                    </div>
                    <div class='col-hss-4' style='border: none !important;  text-align: right; line-height: 23 !important;'>
                        <img src='https://www.santacasasjc.com.br/wp-content/uploads/2018/06/logotipo-santa-casa-sjc-210x75.png' alt='Logo Santa Casa' width='150' height='75'>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <br>
        <br>
        <br>
        <form style='height: 40px;' >
            <div class='container'>
                <div class='row'>
                    <div class='col-hss-12' style='color: black; border: none !important; background-color: #6498c8; text-align: center;'>
                    <h2 Style='font-size: 18px !important;  line-height: 1 !important;'>Relatório de Checagem</h2>
                    </div>
                </div>
            </div>
        </form>
        <form style='height: 40px; border: solid 1px black !important;'>
            <div class='container'>
                <div class='row'>
                    <div class='col-hss-4' style='height: 30px;  border: none !important;'>
                       <h2 style='line-height: 2 !important;'>PRESTADOR: ".@$row_checagem_prest['CD_PRESTADOR']."</h2>
                    </div>
                    <div class='col-hss-4' style='height: 30px;  border: none !important;'>
                    <h2 style='line-height: 2 !important;'>".@$row_checagem_prest['NM_USUARIO']."</h2>
                 </div>
                 <div class='col-hss-4' style='height: 30px;  border: none !important;'>
                 <h2 style='line-height: 2 !important;'>CONSELHO: ".@$row_checagem_prest['DS_CODIGO_CONSELHO']."</h2>
              </div>
                </div>
            </div>
        </form>
        <br>
        <form style='height: 40px; border: solid 1px black !important;'>
            <div class='container'>
                <div class='row'>
                    <div class='col-hss-4' style='height: 30px;  border: none !important;'>
                       <h2 style='line-height: 2 !important;'>ATENDIMENTO: ".@$row_checagem_prest['CD_ATENDIMENTO']."</h2>
                    </div>
                    <div class='col-hss-4' style='height: 30px;  border: none !important;'>
                        <h2 style='line-height: 2 !important;'>SETOR: ".@$row_checagem_prest['NM_SETOR']."</h2>
                    </div>
                    <div class='col-hss-4' style='height: 30px;  border: none !important;'>
                        <h2 style='line-height: 2 !important;'>LEITO: ".@$row_checagem_prest['DS_LEITO']."</h2>
                    </div>
                </div>
            </div>
        </form>
        <form style='height: 40px; border: solid 1px black !important;'>
        <div class='container'>
            <div class='row'>
                <div class='col-hss-4' style='height: 30px;  border: none !important;'>
                   <h2 style='line-height: 2 !important;'>PACIENTE: ".@$row_checagem_prest['NM_PACIENTE']."</h2>
                </div>
                <div class='col-hss-2' style='height: 30px;  border: none !important;'>
                    <h2 style='line-height: 2 !important;'>IDADE: ".@$row_checagem_prest['DS_IDADE']."</h2>
                </div>
                <div class='col-hss-2' style='height: 30px;  border: none !important;'>
                    <h2 style='line-height: 2 !important;'>NASCIMENTO: ".@$row_checagem_prest['DT_NASCIMENTO']."</h2>
                </div> 
                <div class='col-hss-2' style='height: 30px;  border: none !important;'>
                    <h2 style='line-height: 2 !important;'>CONVENIO: ".@$row_checagem_prest['NM_CONVENIO']."</h2>
                </div> 
            </div>
        </div>
    </form>
    <br>

    <table class='table table-fixed' style='margin-left: auto;
    margin-right: auto; width:100%' border='1' cellspacing='0' cellpadding='0'>
        <tr>
            <!--Cabeçalho-->
            <th class='align-middle text-center' style='text-align: center !important; font-size: 0.750rem !important; background-color: #3185c1; color: #ffffff'><span>PERIODO </span></th>
            <th class='align-middle text-center' style='text-align: center !important; font-size: 0.750rem !important; background-color: #3185c1; color: #ffffff'><span>ESQUEMA </span></th>
            <th class='align-middle text-center' style='text-align: center !important; font-size: 0.750rem !important; background-color: #3185c1; color: #ffffff'><span>ITEM </span></th>
            <th class='align-middle text-center' style='text-align: center !important; font-size: 0.750rem !important; background-color: #3185c1; color: #ffffff'><span>NÃO PADRONIZADO  </span></th>
            <th class='align-middle text-center' style='text-align: center !important; font-size: 0.750rem !important; background-color: #3185c1; color: #ffffff'><span>DH CHECAGEM </span></th>
            <th class='align-middle text-center' style='text-align: center !important; font-size: 0.750rem !important; background-color: #3185c1; color: #ffffff'><span>APLICAÇÃO</span></th>
            <th class='align-middle text-center' style='text-align: center !important; font-size: 0.750rem !important; background-color: #3185c1; color: #ffffff'><span>FREQUÊNCIA </span></th>
            <th class='align-middle text-center' style='text-align: center !important; font-size: 0.750rem !important; background-color: #3185c1; color: #ffffff'><span>UNIDADE </span></th>
            <th class='align-middle text-center' style='text-align: center !important; font-size: 0.750rem !important; background-color: #3185c1; color: #ffffff'><span>QTD </span></th>
        </tr>";

        @oci_execute(@$result_checagem_prest);
            
        while($row_checagem_prest = oci_fetch_array($result_checagem_prest)){
            $documentTemplate.="
            <tr>
                <td class='align-middle text-center' style='font-size: 0.750rem !important; text-align: center;'><div><span>" . $row_checagem_prest['TP_PERIODO'] . "</span></div></td>
                <td class='align-middle text-center' style='font-size: 0.750rem !important; text-align: center;'><div><span>" . $row_checagem_prest['DS_TIP_ESQ'] . "</span></div></td>
                <td class='align-middle text-center' style='font-size: 0.750rem !important; text-align: center;'><div><span>" . $row_checagem_prest['DS_TIP_PRESC'] . "</span></div></td>
                <td class='align-middle text-center' style='font-size: 0.750rem !important; text-align: center;'><div><span>" . $row_checagem_prest['DS_NPADRONIZADO'] . "</span></div></td>
                <td class='align-middle text-center' style='font-size: 0.750rem !important; text-align: center;'><div><span>" . $row_checagem_prest['DH_CHECAGEM'] . "</span></div></td>
                <td class='align-middle text-center' style='font-size: 0.750rem !important; text-align: center;'><div><span>" . $row_checagem_prest['CD_FOR_APL'] . "</span></div></td>
                <td class='align-middle text-center' style='font-size: 0.750rem !important; text-align: center;'><div><span>" . $row_checagem_prest['DS_TIP_FRE_RESUMIDA'] . "</span></div></td>
                <td class='align-middle text-center' style='font-size: 0.750rem !important; text-align: center;'><div><span>" . $row_checagem_prest['DS_UNIDADE'] . "</span></div></td>
                <td class='align-middle text-center' style='font-size: 0.750rem !important; text-align: center;'><div><span>" . $row_checagem_prest['QTD_CHECAGEM'] . "</span></div></td>
            </tr>
            ";
        };
       
       
        @oci_execute(@$result_checagem_prest);
        @$row_checagem_prest = oci_fetch_array($result_checagem_prest);

        $partes = explode(' ', $row_checagem_prest['NM_USUARIO']);
        $primeiroNome = array_shift($partes);
        $ultimoNome = array_pop($partes);

        $documentTemplate.= "
        </table>
        <br>
        <br>
        <br>
        <form style='height: 120px; border: solid 1px black !important;'>
            <div class='container'>
                <div class='row'>
                    <div class='col-hss-3' style='height: 70px; margin-top: 20px !important; border: none !important; padding-left: 70%;'>
                        <img src='data:application/pdf;base64, ".base64_encode(@$assinatura)." type='application/pdf' style='width: 150px; height: 40px;'>
                        <br>
                    <h99>                        
                        ". $primeiroNome . " " . $ultimoNome ."
                        <br>".@$row_checagem_prest['NM_TIP_PRESTA']."
                        <br>COREN-SP ".@$row_checagem_prest['DS_CODIGO_CONSELHO']."
                    </h99>

                </div>
                </div>
                <div class='row' style='text-align: left; padding-right: 20%;'>
                    <div class='col-hss-3' style='border: none !important; border-top: solid 1px !important; float:right; margin-right: 100px;'>
                    <h2 style='line-height: 10px !important; font-size: 8px; !important;'>".@$row_checagem_prest['DS_CODIGO_CONSELHO']." 
                    ".@$row_checagem_prest['NM_USUARIO']."</h2> 
                    </div>                   
                                  
                </div>
            </div>
        </form>

   </body> 
</html>";

$documentTemplate;


// inclusão da biblioteca
include 'dompdf/autoload.inc.php';


// alguns ajustes devido a variações de servidor para servidor


use Dompdf\Dompdf;
use Dompdf\Options;

// abertura de novo documento
$dompdf = new DOMPDF();
$dompdf->set_option('isRemoteEnabled', TRUE);

// carregar o HTML
$dompdf->load_html($documentTemplate);

// dados do documento destino
$dompdf->set_paper("A4", "landscape");

// gerar documento destino
$dompdf->render();

$image = $dompdf->output();
?>


<?php


// enviar documento destino para download
//$dompdf->stream("dompdf_out.pdf");

//VERIFICA SE ARQUIVO JA NAO FOI ENVIADO
echo $cons_valida_qtd= "SELECT COUNT(*) AS QTD
FROM assinaturas.DOC_ASSINATURA da
WHERE da.CD_ATENDIMENTO = '$cd_atd'
AND da.CD_PRESTADOR = '$cd_prest'
AND da.DT_DOC_ASSINATURA = TO_DATE('$data_check','DD/MM/YYYY')";

$result_valida_qtd = oci_parse($conn_ora, $cons_valida_qtd);
@oci_execute($result_valida_qtd);
$row_qtd_env= oci_fetch_array($result_valida_qtd);
$var_qtd_env = $row_qtd_env['QTD'];

if($var_qtd_env >=1){
    
    $_SESSION['msgerro'] = "Esse arquivo já foi gerado."; 
    header('Location: check_gerar_documento.php');
    return 0;

}else{


    ///////////////////////
    // Inserindo no banco//
    ///////////////////////

    include_once("conexao.php");

    //DECLARANDO VARIAVEIS DO ARQUIVO PARA IMPORTACAO PARA O BANCO
    //$image = file_get_contents($dompdf);

    //echo '</br></br>';
    $consulta_insert = 
    "INSERT INTO assinaturas.DOC_ASSINATURA
    (CD_DOC_ASSINATURA, CD_TIP_DOC_ASSINATURA, 
    CD_ATENDIMENTO, CD_PRESTADOR, DT_DOC_ASSINATURA, 
    DS_DOC_ASSINATURA, ANEXO_DOC_ASSINATURA,
    CD_USUARIO_CADASTRO, HR_CADASTRO
    )
    VALUES 
    (SEQ_CD_DOC_ASSINATURA.nextval, 1,
    '$cd_atd', '$cd_prest', '$data_check',
    '$nm_documneto', empty_blob(),
    '$var_cd_usuario', SYSDATE
    ) RETURNING ANEXO_DOC_ASSINATURA INTO :image";

    //echo $consulta_insert;

    $insere_dados = oci_parse($conn_ora, $consulta_insert);
    $blob = oci_new_descriptor($conn_ora, OCI_D_LOB);
    oci_bind_by_name($insere_dados, ":image", $blob, -1, OCI_B_BLOB);

    oci_execute($insere_dados, OCI_DEFAULT);

    $linhas_afetadas = oci_num_rows($insere_dados);
    //echo "</br>Linhas Afetadas: " . $linhas_afetadas;


    if(!$blob->save($image)) {
        oci_rollback($conn_ora);
    }
    else {
        oci_commit($conn_ora);
    }

    oci_free_statement($insere_dados);
    $blob->free();

    if($insere_dados > 0){
        $_SESSION['msg'] = "Arquivo gerado com sucesso!"; 
        header('Location: check_gerar_documento.php');
        return 0;

    }else{
        $_SESSION['msgerro'] = "Ocorreu um erro ao gerar o arquivo."; 
        header('Location: check_gerar_documento.php');
        return 0;
    }

    //DECLARANDO VARIAVEIS DO ARQUIVO PARA IMPORTACAO PARA O BANCO
    //$image = file_get_contents($dompdf);

    }

?>

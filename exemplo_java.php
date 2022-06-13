<?php 
    //CONEXAO
     include 'conexao.php';



    $assinatura_paciente = "SELECT ASSINATURA_PACIENTE
    FROM assinaturas.ASSINATURA_PACIENTE
    WHERE CD_PACIENTE = (SELECT CD_PACIENTE
                        FROM dbamv.ATENDIME atd
                        WHERE CD_ATENDIMENTO = 4237234)";

    $result_assinatura_paciente = oci_parse($conn_ora, $assinatura_paciente);
    @oci_execute($result_assinatura_paciente);
    $row_assinatura_paciente = oci_fetch_array($result_assinatura_paciente);

    @$image64_paciente = $row_assinatura_paciente['ASSINATURA_PACIENTE']->load();
    $img_paciente = base64_encode(@$image64_paciente);

    echo '<img alt="pepita.png" src="data:image/png;base64,'.$img_paciente.'"/>';


    echo '<br>';    echo '<br>';    echo '<br>';
    

    $assinatura_prestador = "SELECT ASSINATURA_TISS
                                FROM dbamv.prestador_assinatura
                            WHERE CD_PRESTADOR =
                                    (SELECT CD_PRESTADOR
                                        FROM dbamv.PRESTADOR
                                    WHERE NM_PRESTADOR =
                                            (SELECT NM_USUARIO
                                                FROM dbasgu.USUARIOS
                                            WHERE CD_USUARIO = 'ACCSOUZA'))";

    $result_assinatura_prestador = oci_parse($conn_ora, $assinatura_prestador);
    @oci_execute($result_assinatura_prestador);
    $row_assinatura_prestador = oci_fetch_array($result_assinatura_prestador);

    @$image64_prestador = $row_assinatura_prestador['ASSINATURA_TISS']->load();
    $img_prestador = base64_encode(@$image64_prestador);

    echo '<img alt="pepita.png" src="data:image/png;base64,'.$img_prestador.'"/>';

?>
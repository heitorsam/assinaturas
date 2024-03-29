<?php

    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    //VARIAVEIS DE PESQUISA
    $ano = 2021;
    $mes = 4;
    $dia = 1;

    //DATA
    $data = $ano . '-' . $mes . '-' . $dia;

    //ULTIMO DIA
    $ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano));      
    //echo '</br>';

    //DIA DA SEMANA
    //echo $dia_semana = strftime('%A', strtotime($data));
    //echo '</br>';

    //MES
    echo '<div style="margin: 0 auto; text-align:center;">';

    echo $mes_desc = '<h11><i class="far fa-calendar"></i> ' . ucfirst(strftime('%B', strtotime($data))) . '</h11>';
    echo '</br>';
    echo '</br>';

    echo '</div>';

    echo '<table style="margin: 0 auto;">';

        //CONTADOR CONSTRUTOR
        $cont_estrut = 1;

        //CONTADOR AUXILIAR SEMANA
        $dia_aux_semana = 1;

        //LIBERA CONTADOR
        $libera_contador = 0;
        
        while($cont_estrut <= 49){

            if($cont_estrut <= 7){

                $data_aux_semana = 2020 . '-' . 11 . '-' . $dia_aux_semana; 

                echo '<td class="quadro_semana">';                    

                    echo utf8_encode(ucfirst(str_replace('-feira','',strftime('%A', strtotime($data_aux_semana)))));                   

                    $dia_aux_semana = $dia_aux_semana + 1;

                echo '</td>';

            }else{

                if($cont_estrut > 7 AND $cont_estrut <=14){

                    $data_aux_semana = 2020 . '-' . 11 . '-' . $dia_aux_semana; 
    
                    echo '<td class="quadro_calendario">';
                            
                        //DATA
                        $data = $ano . '-' . $mes . '-' . $dia;    

                        $semana_vdd = str_replace('-feira','',strftime('%A', strtotime($data_aux_semana)));

                        $semana_atual = str_replace('-feira','',strftime('%A', strtotime($data)));
    
                        //VALIDA INICIO DA CONTAGEM
                        if($semana_vdd == $semana_atual AND $libera_contador == 0){

                            $libera_contador = 1;
                            $dia = 1;

                        }

                        //INICIA A CONTAGEM
                        if($libera_contador == 1){

                            echo '<div class="detalhe_dia">';
                                
                                echo $dia; 
                                
                            echo '</div>';

                            echo '37 Pacientes';

                            $dia = $dia + 1;                                                  
                        
                        }
                        
                    $dia_aux_semana = $dia_aux_semana + 1;

                    echo '</td>';
    
                }else{

                    echo '<td class="quadro_calendario">';

                        //EXIBE ATE O ULTIMO DIA
                        if($dia <= $ultimo_dia){

                            echo '<div class="detalhe_dia">';
                                
                                echo $dia; 
                                
                            echo '</div>';

                            echo '37 Pacientes';

                            $dia = $dia + 1;  

                        }

                    echo '</td>';

                }

            }

            if($cont_estrut == 7 OR $cont_estrut == 14 OR $cont_estrut == 21 OR $cont_estrut == 28 OR $cont_estrut == 35 OR $cont_estrut == 42){

                echo '</tr>';

                echo '<tr>';

            }

            $cont_estrut = $cont_estrut + 1;

        }

    echo '</table>';

?>

<style>

    .quadro_calendario{

        width: 100px;
        height: 70px;
        text-align: center;
        border: solid 1px #d5d5d5;

    }

    .quadro_semana{

        border: solid 1px #d5d5d5;
        width: 100px;
        height: 10px;
        text-align: center;
        background-color: #efefef;
    }

    .detalhe_dia{

        font-size: 12px;
        text-align:center;
        background-color: rgba(70, 165, 212,0.15)

    }

    table{
        border-spacing: 0px;
    }

</style>

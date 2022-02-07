<?php 
    //CABECALHO
    include 'cabecalho.php';
?>

<div class="div_br"> </div>





<?php 

    $x = 1;

    while($x<=10){

?>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#piroca<?php echo $x; ?>">
        Modal <?php echo $x; ?>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="piroca<?php echo $x; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Meu Modal Favorito <?php echo $x; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Modal número <?php echo $x; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </div>
            </div>
        </div>
        </div>

<?php 

        $x = $x + 1;

    }

?>



            
<?php
    //RODAPE
    include 'rodape.php';
?>
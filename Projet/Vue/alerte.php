<?php
require_once '../Fonctions/Generique.php';
$listeAlert=listeAlert();
foreach ($listeAlert as $resultat) {
    echo'
        <div class="alert alertBox">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Attention '.$resultat['ip'].' !</strong> <br />
            '.$resultat['message'].'
        </div>
    ';
}
?>
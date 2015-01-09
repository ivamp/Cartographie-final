<div class="row">
    <div class="col-xs-4 cadreRubrique">
        <p class="titreRubrique">Client</p>
        <?php
        for ($x = 0; $x < count($listeMachine->getListeMachine()); $x++) {
            $machine = $listeMachine->getListeMachine()[$x];
            if ($machine->getType() == 2) {
                $adresseIP="'".$machine->getIp()."'";
                echo' 
                    <div class="col-xs-12 center">' . $machine->getNom() . ' ' . $machine->getIp() . ' <img src="Images/'.  afficherImage( $machine->getOs()).'" alt="" /> 
                        <button type="button" class="btn btn-default " onclick="detailMachine('. $adresseIP .')">
                            <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
                        </button> 
                    </div>
                ';
            }
        }
        ?>
    </div>
    <div class="col-xs-4 cadreRubrique">
        <p class="titreRubrique">Serveur</p>
        <?php
        for ($x = 0; $x < count($listeMachine->getListeMachine()); $x++) {
            $machine = $listeMachine->getListeMachine()[$x];
            if ($machine->getType() == 1) {
                $adresseIP="'".$machine->getIp()."'";
                echo' 
                    <div class="col-xs-12 center">' . $machine->getNom() . ' ' . $machine->getIp() . ' <img src="Images/'.  afficherImage( $machine->getOs()).'" alt="" />  
                        <button type="button" class="btn btn-default " onclick="detailMachine('. $adresseIP .')">
                            <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
                        </button> 
                    </div>
                ';
            }
        }
        ?>
    </div>
    <div class="col-xs-4 cadreRubrique">
        <p class="titreRubrique">Routeur</p>
        <?php
        for ($x = 0; $x < count($listeMachine->getListeMachine()); $x++) {
            $machine = $listeMachine->getListeMachine()[$x];
            if ($machine->getType() == 3) {
                $adresseIP="'".$machine->getIp()."'";
                echo' 
                    <div class="col-xs-12 center">' . $machine->getNom() . ' ' . $machine->getIp() . ' <img src="Images/'.  afficherImage( $machine->getOs()).'" alt="" /> 
                        <button type="button" class="btn btn-default " onclick="detailMachine('. $adresseIP .')">
                            <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
                        </button>  
                    </div>
                ';
            }
        }
        ?>
    </div>

</div>

<script type="text/javascript">
    function detailMachine(ip){
   	ipServeur="<?php echo"".$_SERVER['SERVER_ADDR']."";?>";
        window.location="http://"+ipServeur+"/Projet/index.php?page=5&ip="+ip;
    }
</script>

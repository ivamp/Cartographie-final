<div class="row cadreRubrique">
    <div class="col-xs-12">
        <div class="col-xs-2">
            <p class="titreRubrique"> <br /> </p>
        </div>      
        <div class="col-xs-2">
            <p class="titreRubrique">Serveurs</p>
        </div>
        <div class="col-xs-2">
            <p class="titreRubrique">Application(s)</p>
        </div>
        <div class="col-xs-2">
            <p class="titreRubrique">Version du service</p>
        </div>
        <div class="col-xs-2">
            <p class="titreRubrique">Port d'écoute</p>
        </div>

    </div>
    <?php
    for ($x = 0; $x < count($listeMachine->getListeServeur()); $x++) {
        $machine = $listeMachine->getListeServeur()[$x];
        for ($y = 0; $y < count($machine->getListePort()); $y++) {
            $port = $machine->getListePort()[$y];
            $adresseIP="'".$machine->getIp()."'";
            if ($y == 0) {

                echo '
                <div class="col-xs-12 ligneTop margeTop20 ">
                    <div class="col-xs-2 center margeTop20">
                        <button type="button" class="btn btn-default " onclick="detailMachine('. $adresseIP .')">
                            <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
                        </button> 
                    </div>
                    <div class="col-xs-2 margeTop20 alignLeft">
                        ' . $machine->getNom() . ' ' . $machine->getIp() . ' <img src="Images/' . afficherImage($machine->getOs()) . '" alt="" /> 
                    </div>
                    <div class="col-xs-2 center margeTop20">
                        <p class="">' . $port->getService() . '</p>
                        
                    </div>
                    <div class="col-xs-2 center margeTop20">
                        <p class="">' . $port->getVersion() . '</p>
                        
                    </div>
                    <div class="col-xs-2 center margeTop20">
                        <p class="">' . $port->getPort() . '</p>
                        
                    </div>
                </div>
            ';
            } else {
                echo'
                <div class="col-xs-12  margeTop20">
                    <div class="col-xs-2 center">
                         
                    </div>
                    <div class="col-xs-2 alignLeft">
                    </div>
                    <div class="col-xs-2 center">
                        <p class="">' . $port->getService() . '</p>
                        
                    </div>
                    <div class="col-xs-2 center">
                        <p class="">' . $port->getVersion() . '</p>
                        
                    </div>
                    <div class="col-xs-2 center">
                        <p class="">' . $port->getPort() . '</p>
                        
                    </div>
                </div>
                ';
            }
        }
    }
    ?>


</div>

<script type="text/javascript">
    function detailMachine(ip){
        ipServeur="<?php echo"".$_SERVER['SERVER_ADDR']."";?>";
        window.location="http://"+ipServeur+"/Projet/index.php?page=5&ip="+ip;
    }
</script>
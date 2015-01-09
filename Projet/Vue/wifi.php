<div class="row">
    <div class="col-xs-12 cadreRubrique">
        <p class="titreRubrique">Réseau WIFI</p>
        <div class="col-xs-1 center">
            <p class=""></p>
        </div>
        <div class="col-xs-3 center gras">
            <p class="">Adresse Mac</p>
        </div>
        <div class="col-xs-3 center gras">
            <p class="">SSID</p>
        </div>
        <div class="col-xs-2 center gras">
            <p class="">Securite</p>
        </div> 
        <div class="col-xs-3 center gras">
            <p class="">Adresse IP</p>
        </div> 
        <?php
        $listeWifi = listeReseauWifi();
        foreach ($listeWifi as $wifi) {
            $adresseIP = "'" . $wifi['ip'] . "'";
            if (!empty($wifi['ip'])) {
                echo'
                <div class = "col-xs-1 center">
                    <button type="button" class="btn btn-default " onclick="detailMachine(' . $adresseIP . ')">
                        <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>
                    </button>
                </div>   
                ';
            } else {

                echo'
                <div class = "col-xs-1 center">
                    &nbsp;
                </div>   
                ';
            }
            echo'
 
                <div class = "col-xs-3 center">
                <p class = "">' . $wifi['mac'] . '</p>
                </div>
                <div class = "col-xs-3 center">
                    <p class = "">' . $wifi['ssid'] . '</p>
                </div>
                <div class = "col-xs-2 center">
                    <p class = "">' . $wifi['securite'] . '</p>
                </div>
                <div class = "col-xs-3 center">
                    <p class = ""> &nbsp; ' . $wifi['ip'] . ' </p>
                </div>
            ';
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
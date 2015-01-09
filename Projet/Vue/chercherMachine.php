<?php
if (empty($_GET['ip'])) {
    echo'
            <div class="row cadreRubrique">
                <div class="col-sm-12 center margeTop10">  
                    Rechercher une machine: <input type="text" class="input-sm maxWidth100" placeholder="Adresse IP" id="ip"> <button id="target" type="button" class="btn btn-default btn-sm">Chercher</button>
                </div>
            </div>
        ';
} else {
    $adresseIP = $_GET['ip'];
    $machine = new Machine(NULL, $adresseIP, NULL, NULL, NULL, NULL, 2);
    $informationFTP = informationFTP($machine->getIp());
    $informationHTTP = informationHTTP($machine->getIp());
    echo'                

            <div class="row cadreRubrique">
                <div class="col-sm-5">
                    
                    <p class="titreRubrique">Information Général </p><br />
                        <div class="col-sm-6 alignRight">
                            <p>
                                Hostname:   <br />
                                Adresse IP: <br />
                                Système d\exploitation: <br />
                                Adresse Mac: <br />
                            </p>
                        </div>
                        <div class="col-sm-6 alignLeft">
                            <p>
                                ' . $machine->getNom() . '   <br />
                                ' . $machine->getIp() . ' <br />
                                ' . $machine->getOs() . ' <br />
                                ' . $machine->getMac() . ' <br />
                                <br /><br />
                            </p>
                        </div>
                        
                   <p class="titreRubrique">Effectuer une action </p><br />       
                    <div class="center">
                        <select class="selectpicker" id="actionValue">
        ';
    $optionSelect = listeMenu();
    foreach ($optionSelect as $option) {
        if ($machine->chercherPort(21) == true && $option['code_script'] == 4) {
            echo'
            <option value="' . $option['code_script'] . '">' . $option['nom'] . '</option> 
            ';
        }else if ($machine->chercherPort(53) == true && $option['code_script'] == 1) {
            echo'
            <option value="' . $option['code_script'] . '">' . $option['nom'] . '</option> 
            ';
        } else if ($option['code_script'] != 4 && $option['code_script'] != 1) {
            echo'
            <option value="' . $option['code_script'] . '">' . $option['nom'] . '</option> 
            ';
        }
    }


    echo'                        
                             
                        </select>
                        <button type="button" class="btn btn-default" id="action">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                        </button>
                        <br /><br />
                        <div id="resultat">
                        </div>
                    </div>    
                </div>
                
                <div class="col-sm-7 "> 
                    <p class="titreRubrique">Information sur les services </p><br />
                    <div class="col-xs-12">
                        <div class="col-xs-4 center gras">
                            <p class="">Application(s)</p>
                        </div>
                        <div class="col-xs-4 center gras">
                            <p class="">Version du services</p>
                        </div>
                        <div class="col-xs-4 center gras">
                            <p class="">Port d\'écoute</p>
                        </div>
                    </div>
                ';
    for ($y = 0; $y < count($machine->getListePort()); $y++) {
        $port = $machine->getListePort()[$y];
        echo'
                    <div class="col-xs-4 center">
                        <p class="">' . $port->getService() . '</p>
                        
                    </div>
                    <div class="col-xs-4 center">
                        <p class="">' . $port->getVersion() . '</p>
                        
                    </div>
                    <div class="col-xs-4 center">
                        <p class="">' . $port->getPort() . '</p>
                        
                    </div>
                    ';
    }

    echo'
                </div>
        ';

    if (!empty($informationFTP)) {
        echo '
            <div class="col-sm-7 "> 
                    <p class="titreRubrique">Information sur le FTP </p><br />
                    <div class="col-xs-12">
                        <div class="col-xs-3 center gras">
                            <p class="">Bannière</p>
                        </div>
                        <div class="col-xs-3 center gras">
                            <p class="">login</p>
                        </div>
                        <div class="col-xs-3 center gras">
                            <p class="">Mot de passe</p>
                        </div>
                        <div class="col-xs-3 center gras">
                            <p class="">Anonyme</p>
                        </div>                        
                    </div>
        ';
        foreach ($informationFTP as $ftp) {
            $anonyme = anonymeResultat($ftp['anonyme']);
            $fichierDownload = 'Script/' . $machine->getIp() . 'FTP.txt';
            echo'
                    <div class="col-xs-12">
                        <div class="col-xs-3 center">
                            <p class="">' . $ftp['banniere'] . '</p>
                        </div>
                        <div class="col-xs-3 center">
                            <p class="">' . $ftp['login'] . '</p>
                        </div>
                        <div class="col-xs-3 center">
                            <p class="">' . $ftp['password'] . '</p>
                        </div>
                        <div class="col-xs-3 center">
                            <p class="">' . $anonyme . '
                                <a href="' . $fichierDownload . '" target="blank"><span class="glyphicon glyphicon-download" aria-hidden="true"></span></a>                
                            </p>
                        </div>                        
                    </div>
            
        ';
        }
    }

    if (!empty($informationHTTP)) {
        echo '
            <div class="col-sm-7 "> 
                    <p class="titreRubrique center">Information sur le HTTP </p><br />
                    <div class="col-xs-12">
                        <div class="col-xs-4 center gras">
                            <p class="">Bannière</p>
                        </div>
                        <div class="col-xs-4 center gras">
                            <p class="">Date</p>
                        </div>
                        <div class="col-xs-4 center gras">
                            <p class="">Méthode</p>
                        </div>                 
                    </div>
        ';
        foreach ($informationHTTP as $http) {
            echo'
                    <div class="col-xs-12">
                        <div class="col-xs-4 center">
                            <p class="">' . $http['Banniere'] . '</p>
                        </div>
                        <div class="col-xs-4 center">
                            <p class="">' . $http['date'] . '</p>
                        </div>
                        <div class="col-xs-4 center">
                            <p class="">' . $http['methode'] . '</p>
                        </div>                  
                    </div>
            
        ';
        }
    }

    echo'
    	</div>
    </div>

    ';
}
?>


<script >

    $("#target").click(function () {
        ip = $("#ip").val();
        $(location).attr('href', "./index.php?page=5&ip=" + ip);
    });

    $("#action").click(function () {
        $("#resultat").html("Demande en cours de traitement ...");
        codeScript = $("#actionValue").val();
        adresseIP = "<?php echo '' . $_GET["ip"] . '' ?>";
        if (codeScript == 1) {
            var domaine = prompt("Entrer le nom de domaine ?", "<Entrez ici le domaine>");
        }
        jQuery.ajax({
            type: "GET",
            url: "Script/lancerScript.php?codeScript=" + codeScript + "&adresseIP=" + adresseIP + "&domaine=" + domaine,
            dataType: "html",
            cache: false,
            async: false,
            data: {},
            success: function (msg) {
                $("#resultat").html($("#resultat").html() + " Done <br />" + msg);
                location.reload();
            },
            error: function (msg) {
                $("#resultat").html(msg);
            }
        });
    });


</script>

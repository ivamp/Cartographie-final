<?php

function formulaires($string) {
    $string = mysql_real_escape_string($string);
    $string = addcslashes($string, '%_');
    return $string;
}

function afficherImage($nom) {
    if (preg_match("/Linux/", $nom)) {
        return 'linux.gif';
    } else if (preg_match("/Cisco/", $nom)) {
        return 'cisco.png';
    } else if (preg_match("/Windows/", $nom)) {
        return 'windows.png';
    } else if (preg_match("/Apple/", $nom)) {
        return 'apple.jpg';
    } else {
        return 'unknow';
    }
}

function listeMenu() {
    include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/connexionBdd.php");
    try {
        $reqInformationMenuAction = "
                    SELECT * FROM Action
		";
        $exec = $connexion->prepare($reqInformationMenuAction);
        $exec->execute();
        $resultat = $exec->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "Erreur: $ex";
    }
    include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/fermetureBdd.php");
    return $resultat;
}

function informationFTP($ip) {
    include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/connexionBdd.php");
    try {
        $reqInformationFTP = "
                    SELECT * 
                    FROM FTP 
                    WHERE ip = :adresseIP
		";
        $exec = $connexion->prepare($reqInformationFTP);
        $exec->bindParam(':adresseIP', $ip);
        $exec->execute();
        $resultat = $exec->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "Erreur: $ex";
    }
    include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/fermetureBdd.php");
    return $resultat;
}

function informationHTTP($ip) {
    include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/connexionBdd.php");
    try {
        $reqInformationFTP = "
                    SELECT * 
                    FROM HTTP 
                    WHERE ip = :adresseIP
		";
        $exec = $connexion->prepare($reqInformationFTP);
        $exec->bindParam(':adresseIP', $ip);
        $exec->execute();
        $resultat = $exec->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "Erreur: $ex";
    }
    include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/fermetureBdd.php");
    return $resultat;
}

function countAlert() {
    include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/connexionBdd.php");
    try {
        $reqInformationNbAlerte = "
                    SELECT COUNT(*) 
                    FROM Alerte
                    WHERE etat=0
		";
        $exec = $connexion->prepare($reqInformationNbAlerte);
        $exec->execute();
        $resultat = $exec->fetchColumn();
    } catch (Exception $ex) {
        echo "Erreur: $ex";
    }
    include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/fermetureBdd.php");
    return $resultat;
}

function listeAlert() {
    include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/connexionBdd.php");
    try {
        $reqInformationNbAlerte = "
                    SELECT *
                    FROM Alerte
                    WHERE etat=0
		";
        $exec = $connexion->prepare($reqInformationNbAlerte);
        $exec->execute();
        $resultat = $exec->fetchAll(PDO::FETCH_ASSOC);
        $reqUpdate = "
            UPDATE Alerte
            SET etat=1          
        ";
        $exec = $connexion->prepare($reqUpdate);
        $exec->execute();
    } catch (Exception $ex) {
        echo "Erreur: $ex";
    }
    include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/fermetureBdd.php");
    return $resultat;
}

function anonymeResultat($anonyme) {
    if ($anonyme == 0) {
        $res = "Oui";
    } else {
        $res = "Non";
    }
    return $res;
}

function listePortMachine($ip) {
    include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/connexionBdd.php");
    try {
        $reqListePort = "
                    SELECT port 
                    FROM Resultat_Scan
                    WHERE ip='$ip'
		";
        $exec = $connexion->prepare($reqListePort);
        $exec->execute();
        $resultat = $exec->fetchAll(PDO::FETCH_ASSOC);
        $x = 0;
        foreach ($resultat as $port) {
            if ($x == 0) {
                $listePort = $port['port'];
                $x++;
            } else {
                $listePort = $listePort . ',' . $port['port'];
            }
        }
    } catch (Exception $ex) {
        echo "Erreur: $ex";
    }
    include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/fermetureBdd.php");
    return $listePort;
}

function listeReseauWifi() {
    include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/connexionBdd.php");
    try {
        $reqListePort = "
        SELECT Wifi.mac, Wifi.ssid,Wifi.securite,Liste_Machine.ip,Liste_Machine.mac as mac2
        FROM Wifi
        LEFT OUTER JOIN Liste_Machine 
        ON Wifi.mac = Liste_Machine.mac
	";
        $exec = $connexion->prepare($reqListePort);
        $exec->execute();
        $resultat = $exec->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "Erreur: $ex";
    }
    include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/fermetureBdd.php");
    return $resultat;
}

function lancerScanService($commande) {
    system($commande, $retval);
}

function parseurXML($fichier) {
    if (file_exists('service.xml')) {
        include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/connexionBdd.php");
        $xml = simplexml_load_file('service.xml');
        $adresseIP = $xml->host->address ['addr'];
        foreach ($xml->host->ports->port as $valeur) {
            $port = $valeur['portid'];
            $version = $valeur->service['product'] . $valeur->service['version'];
            try {
                $reqUpdatePort = "
                    UPDATE Resultat_Scan
                    set version_service = :version
                    WHERE ip=:ip
                    AND port=:port
		";

                $exec = $connexion->prepare($reqUpdatePort);
                $exec->bindParam(':ip', $adresseIP);
                $exec->bindParam(':port', $port);
                $exec->bindParam(':version', $version);
                $exec->execute();
            } catch (Exception $ex) {
                echo "Erreur: $ex";
            }
        }
    } else {
        exit('Echec lors de l\'ouverture du fichier xml.');
    }
    include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/fermetureBdd.php");
}

?>
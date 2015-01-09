<?php

require_once '../Fonctions/Generique.php';
if (isset($_GET['codeScript']) && isset($_GET['adresseIP'])) {
    $codeScript = $_GET['codeScript'];
    $adresseIP = $_GET['adresseIP'];
    $domaine = $_GET['domaine'];
    if ($codeScript == 1) {
        $commande = 'bash transfertDNS.sh ' . $domaine;
        lancerScanService($commande);
    }
    else if ($codeScript == 2) {
        $commande = 'bash DetectOS.sh ' . $adresseIP;
        lancerScanService($commande);
    } else if ($codeScript == 3) {
        $pathScript = 'python script_http.py ' . $adresseIP;
        $lancerScript = system($pathScript, $retval);
    } else if ($codeScript == 4) {
        $pathScript = 'python ForceFTP.py ' . $adresseIP;
        $lancerScript = system($pathScript, $retval);
        $renommerFichier = system("mv result.txt " . $adresseIP . "FTP.txt", $retval);
    } else if ($codeScript == 5) {
        $liste = listePortMachine($adresseIP);
        $commande = 'nmap -sV -oX service.xml -p ' . $liste . ' ' . $adresseIP . ' 2>/dev/null';
        lancerScanService($commande);
        parseurXML('service.xml');
    }

} else {
    echo "Failed";
}
?>

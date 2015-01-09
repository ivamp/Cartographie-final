<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Machine
 *
 * @author malk
 */
include 'ListePort.php';

class Machine {

    private $id;
    private $nom;
    private $ip;
    private $os;
    private $mac;
    private $ListePort;
    private $type;

    public function __construct($id, $ip, $nom, $os, $mac, $type, $constructor) {
        if ($constructor == 1) {
            $this->id = $id;
            $this->nom = $nom;
            $this->os = $os;
            $this->ip = $ip;
            $this->type = $type;
            $this->mac = $mac;
            try {

                include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/connexionBdd.php");
                $reqInformationListeMachine = "
                    SELECT * 
                    FROM Resultat_Scan 
                    WHERE Resultat_Scan.ip = :ip
		";
                $exec = $connexion->prepare($reqInformationListeMachine);
                $exec->bindParam(':ip', $ip);
                $exec->execute();
                $resultat = $exec->fetchAll(PDO::FETCH_ASSOC);
                for ($x = 0; $x < count($resultat); $x++) {
                    $this->ListePort[$x] = new ListePort($resultat[$x]["ip"], $resultat[$x]["port"], $resultat[$x]["service"], $resultat[$x]["version_service"], $resultat[$x]["status"]);
                }
            } catch (Exception $ex) {
                echo "Erreur 1";
            }
        } elseif ($constructor == 2) {
            try {
                include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/connexionBdd.php");

                $reqCount = "SELECT COUNT(*) FROM Resultat_Scan WHERE ip = :ip";
                $exec = $connexion->prepare($reqCount);
                $exec->bindParam(':ip', $ip);
                $exec->execute();
                $resultat=$exec->fetchColumn();
                if($resultat == 0) {
                    $reqInformationListeMachine = "
                    SELECT * 
                    FROM Liste_Machine
                    WHERE ip=:ip
		";
                }else{
                    $reqInformationListeMachine = "
                    SELECT * 
                    FROM Liste_Machine
                    NATURAL JOIN Resultat_Scan 
                    WHERE Liste_Machine.ip=:ip
		";
                }


                $exec = $connexion->prepare($reqInformationListeMachine);
                $exec->bindParam(':ip', $ip);
                $exec->execute();
                $resultat = $exec->fetchAll(PDO::FETCH_ASSOC);
                $this->id = $resultat[0]["id"];
                $this->nom = $resultat[0]["nom_machine"];
                $this->os = $resultat[0]["os"];
                $this->ip = $ip;
                $this->type = $resultat[0]["id"];
                $this->mac = $resultat[0]["mac"];
                for ($x = 0; $x < count($resultat); $x++) {
                    $this->ListePort[$x] = new ListePort($resultat[$x]["ip"], $resultat[$x]["port"], $resultat[$x]["service"], $resultat[$x]["version_service"], $resultat[$x]["status"]);
                }
            } catch (Exception $ex) {
                echo "Erreur 2";
            }
        }
        include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/fermetureBdd.php");
    }

    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getIp() {
        return $this->ip;
    }

    function getOs() {
        return $this->os;
    }

    function getMac() {
        return $this->mac;
    }

    function getListePort() {
        return $this->ListePort;
    }

    function getType() {
        return $this->type;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setIp($ip) {
        $this->ip = $ip;
    }

    function setOs($os) {
        $this->os = $os;
    }

    function setListePort($ListePort) {
        $this->ListePort = $ListePort;
    }

    function setType($type) {
        $this->type = $type;
    }

    function chercherPort($port) {
        foreach ($this->ListePort as $lePort) {
            if ($port == $lePort->getPort()) {
                return true;
            }
        }
        return false;
    }

}

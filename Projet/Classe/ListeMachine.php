<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ListeMachine
 *
 * @author malk
 */
include 'Machine.php';

class ListeMachine {

    private $listeMachine;
    private $listeServeur;
    private $listeClient;
    private $listePeripherique;

    public function __construct() {
        include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/connexionBdd.php");
        try {
            $reqInformationListeMachine = "
                    SELECT * FROM Liste_Machine
		";
            $exec = $connexion->prepare($reqInformationListeMachine);
            $exec->execute();
            $resultat = $exec->fetchAll(PDO::FETCH_ASSOC);

            for ($x = 0; $x < count($resultat); $x++) {
                $this->listeMachine[$x] = new Machine($resultat[$x]["id"], $resultat[$x]["ip"], $resultat[$x]["nom_machine"], $resultat[$x]["os"], $resultat[$x]["mac"], $resultat[$x]["type"], 1);
            }
            $this->generateListeServeur();
            $this->generateListeClient();
            $this->generateListePeripherique();
        } catch (Exception $ex) {
            echo "Erreur: $ex";
        }
        include("" . $_SERVER['DOCUMENT_ROOT'] . "" . "/Projet/Bdd/fermetureBdd.php");
    }

    public function getListeMachine() {
        return $this->listeMachine;
    }

    public function getListeServeur() {
        return $this->listeServeur;
    }

    public function getListeClient() {
        return $this->listeClient;
    }

    public function getListePeripherique() {
        return $this->listePeripherique;
    }

    public function setListeMachine($listeMachine) {
        $this->listeMachine = $listeMachine;
    }

    public function setListeServeur($listeServeur) {
        $this->listeServeur = $listeServeur;
    }

    function generateListeServeur() {
        $y = 0;
        for ($x = 0; $x < count($this->getListeMachine()); $x++) {
            if ($this->getListeMachine()[$x]->getType() == 1) {
                $this->listeServeur[$y] = $this->getListeMachine()[$x];
                $y++;
            }
        }
    }

    function generateListeClient() {
        $y = 0;
        for ($x = 0; $x < count($this->getListeMachine()); $x++) {
            if ($this->getListeMachine()[$x]->getType() == 2) {
                $this->listeClient[$y] = $this->getListeMachine()[$x];
                $y++;
            }
        }
    }

    function generateListePeripherique() {
        $y = 0;
        for ($x = 0; $x < count($this->getListeMachine()); $x++) {
            if ($this->getListeMachine()[$x]->getType() == 3) {
                $this->listePeripherique[$y] = $this->getListeMachine()[$x];
                $y++;
            }
        }
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LstePort
 *
 * @author malk
 */
class ListePort {
    private $ipMachine;
    private $port;
    private $service;
    private $version;
    private $status;
    
     public function __construct($ip,$port,$service,$version,$status) {
         $this->ipMachine=$ip;
         $this->port=$port;
         $this->service=$service;
         $this->version=$version;
         $this->status=$status;
     }
     
     function getIpMachine() {
         return $this->ipMachine;
     }

     function getPort() {
         return $this->port;
     }

     function getService() {
         return $this->service;
     }

     function getVersion() {
         return $this->version;
     }

     function getStatus() {
         return $this->status;
     }

     function setIpMachine($ipMachine) {
         $this->ipMachine = $ipMachine;
     }

     function setPort($port) {
         $this->port = $port;
     }

     function setService($service) {
         $this->service = $service;
     }

     function setVersion($version) {
         $this->version = $version;
     }

     function setStatus($status) {
         $this->status = $status;
     }



}

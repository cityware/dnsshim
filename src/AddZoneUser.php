<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cityware\DnsShim;

use Cityware\DnsShim\Socket as DnsShimSocket;

/**
 * Description of AddZoneUser
 *
 * @author fabricio.xavier
 */
class AddZoneUser extends DnsShimSocket {

    private $schemaName = 'AddZoneUserRequest';
    private $schemaFolder;
    private $username;
    private $sessionId;
    private $zonename;

    public function setUsername($username) {
        $this->username = $username;
    }
    
    public function getUsername() {
        return $this->username;
    }
      
    public function getSessionId() {
        return $this->sessionId;
    }
    
    public function setSessionId($sessionId) {
        $this->sessionId = $sessionId;
    }

    public function getSchemaName() {
        return $this->schemaName;
    }

    public function getSchemaFolder() {
        return $this->schemaFolder;
    }

    public function setSchemaName($schemaName) {
        $this->schemaName = $schemaName;
    }

    public function setSchemaFolder($schemaFolder) {
        $this->schemaFolder = $schemaFolder;
    }
    
    public function getZonename() {
        return $this->zonename;
    }

    public function setZonename($zonename) {
        $this->zonename = $zonename;
    }
    
    public function __construct($hostIp = null, $hostPort = 9999, $hostProtocol = 'ssl') {
        if (empty($this->schemaFolder)) {
            $this->schemaFolder = Constants\SchemaFolder::getFolder();
        }
        parent::__construct($hostIp, $hostPort, $hostProtocol);
    }

    public function communicate() {

        if (empty($this->getXml())) {
            $this->setXml('<?xml version="1.0" encoding="utf-8"?>
                <dnsshim version="1.0">
                    <request>
                        <addZoneUser>
                            <sessionId>' . $this->sessionId . '</sessionId>
                            <zone>' . $this->zonename . '</zone>
                            <username>' . $this->username . '</username>
                        </addZoneUser>
                    </request>
                </dnsshim>');
        }

        $xmlFormat = new \Cityware\Format\Xml();
        $xsdSchemaFileSource = file_get_contents($this->schemaFolder . $this->schemaName . '.xsd');
        $isValid = $xmlFormat->xsdValidateBySource($this->getXml(), $xsdSchemaFileSource);

        if ($isValid) {
            $return = parent::communicate();
            $returnArray = json_decode(json_encode($return), true);
            return $returnArray['response'];
        }
    }

}

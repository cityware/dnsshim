<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cityware\DnsShim;

use Cityware\DnsShim\Socket as DnsShimSocket;

/**
 * Description of ZoneVersion
 *
 * @author fabricio.xavier
 */
class ZoneVersion extends DnsShimSocket {

    private $schemaName = 'ZoneVersionRequest';
    private $schemaFolder;
    private $sessionId;
    private $zone;

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

    public function getSessionId() {
        return $this->sessionId;
    }

    public function setSessionId($sessionId) {
        $this->sessionId = $sessionId;
    }

    public function getZone() {
        return $this->zone;
    }

    public function setZone($zone) {
        $this->zone = $zone;
    }

    public function __construct($hostIp = null, $hostPort = 9999, $hostProtocol = 'ssl') {
        if (empty($this->schemaFolder)) {
            $this->schemaFolder = Constants\SchemaFolder::getFolder();
        }
        parent::__construct($hostIp, $hostPort, $hostProtocol);
    }

    public function communicate() {

        if (empty($this->sessionId)) {
            throw new Exception('Nenhum sessionId foi definido', 500);
        }

        if (empty($this->zone)) {
            throw new Exception('Nenhuma zona de dominio foi definido', 500);
        }

        if (empty($this->getXml())) {
            $this->setXml('<?xml version="1.0" encoding="utf-8"?>
                <dnsshim version="1.0">
                    <request>
                        <zoneVersion>
                            <sessionId>' . $this->sessionId . '</sessionId>
                            <zone>' . $this->zone . '</zone>
                        </zoneVersion>
                    </request>
                </dnsshim>');
        }

        $xmlFormat = new \Cityware\Format\Xml();
        $xsdSchemaFileSource = file_get_contents($this->schemaFolder . $this->schemaName . '.xsd');
        $isValid = $xmlFormat->xsdValidateBySource($this->getXml(), $xsdSchemaFileSource);

        if ($isValid) {
            $return = parent::communicate();
            
            $returnArray = json_decode(json_encode($return), true);

            return ($returnArray['response']['status'] == 1) ? $returnArray['response']['zoneVersion'] : false;
        }
    }

}

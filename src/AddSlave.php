<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cityware\DnsShim;

use Cityware\DnsShim\Socket as DnsShimSocket;

/**
 * Description of AddSlaveGroup
 *
 * @author fabricio.xavier
 */
class AddSlave extends DnsShimSocket {

    private $schemaName = 'SlaveRequest';
    private $schemaFolder;
    private $sessionId;
    private $slaveGroup;
    private $slaveIp;
    private $slavePort = 53;

    public function getSchemaName() {
        return $this->schemaName;
    }

    public function getSchemaFolder() {
        return $this->schemaFolder;
    }

    public function getSessionId() {
        return $this->sessionId;
    }

    public function getSlaveGroup() {
        return $this->slaveGroup;
    }

    public function setSchemaName($schemaName) {
        $this->schemaName = $schemaName;
    }

    public function setSchemaFolder($schemaFolder) {
        $this->schemaFolder = $schemaFolder;
    }

    public function setSessionId($sessionId) {
        $this->sessionId = $sessionId;
    }

    public function setSlaveGroup($slaveGroup) {
        $this->slaveGroup = $slaveGroup;
    }

    public function getSlaveIp() {
        return $this->slaveIp;
    }

    public function getSlavePort() {
        return $this->slavePort;
    }

    public function setSlaveIp($slaveIp) {
        $this->slaveIp = $slaveIp;
    }

    public function setSlavePort($slavePort) {
        $this->slavePort = $slavePort;
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

        if (empty($this->slaveGroup)) {
            throw new Exception('Nenhum nome de SlaveGroup foi definido', 500);
        }
        
        if (empty($this->slaveIp)) {
            throw new Exception('Nenhum IP do servidor Slave foi definido', 500);
        }
        
        if (empty($this->slavePort)) {
            throw new Exception('Nenhuma porta do servidor foi definido', 500);
        }

        if (empty($this->getXml())) {
            $this->setXml('<?xml version="1.0" encoding="utf-8"?>
                <dnsshim version="1.0">
                    <request>
                        <addSlave>
                            <sessionId>' . $this->sessionId . '</sessionId>
                            <slaveGroup>' . $this->slaveGroup . '</slaveGroup>
                            <slave>' . $this->slaveIp . '</slave>
                            <port>' . $this->slavePort . '</port>
                        </addSlave>
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

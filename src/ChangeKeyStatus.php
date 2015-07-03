<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cityware\DnsShim;

use Cityware\DnsShim\Socket as DnsShimSocket;
use Cityware\DnsShim\Constants\DnskeyStatus;

/**
 * Description of NewKey
 *
 * @author fabricio.xavier
 */
class ChangeKeyStatus extends DnsShimSocket {

    private $schemaName = 'ChangeKeyStatusRequest';
    private $schemaFolder;
    private $sessionId;
    private $zonename;
    private $key;
    private $newKeyStatus = null;
    private $oldKeyStatus = null;
    
    public function getSchemaName() {
        return $this->schemaName;
    }

    public function getSchemaFolder() {
        return $this->schemaFolder;
    }

    public function getSessionId() {
        return $this->sessionId;
    }

    public function getZonename() {
        return $this->zonename;
    }

    public function getKey() {
        return $this->key;
    }

    public function getNewKeyStatus() {
        return $this->newKeyStatus;
    }

    public function getOldKeyStatus() {
        return $this->oldKeyStatus;
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

    public function setZonename($zonename) {
        $this->zonename = $zonename;
    }

    public function setKey($key) {
        $this->key = $key;
    }

    public function setNewKeyStatus($newKeyStatus) {
        $this->newKeyStatus = $newKeyStatus;
    }

    public function setOldKeyStatus($oldKeyStatus) {
        $this->oldKeyStatus = $oldKeyStatus;
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

        if (empty($this->zonename)) {
            throw new Exception('Nenhum dominio foi definido', 500);
        }

        if (empty($this->key)) {
            throw new Exception('Nenhuma chave foi definido', 500);
        }

        if (empty($this->newKeyStatus)) {
            $this->newKeyStatus = DnskeyStatus::getType('SIGN');
        }

        if (empty($this->oldKeyStatus)) {
            $this->oldKeyStatus = DnskeyStatus::getType('PUBLISH');
        }

        if (empty($this->getXml())) {
            $this->setXml('<?xml version="1.0" encoding="UTF-8"?>
                <dnsshim version="1.0">
                    <request>
                        <changeKeyStatus>
                            <sessionId>' . $this->sessionId . '</sessionId>
                            <zone>' . $this->zonename . '</zone>
                            <key>
                                <keyName>' . $this->key . '</keyName>
                                <oldStatus>' . $this->oldKeyStatus . '</oldStatus>
                                <newStatus>' . $this->newKeyStatus . '</newStatus>
                            </key>
                        </changeKeyStatus>
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

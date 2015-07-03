<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cityware\DnsShim;

use Cityware\DnsShim\Socket as DnsShimSocket;
use Cityware\DnsShim\Constants\DnskeyAlgorithm;
use Cityware\DnsShim\Constants\DnskeyFlags;
use Cityware\DnsShim\Constants\DnskeyProtocol;
use Cityware\DnsShim\Constants\DnskeyStatus;
use Cityware\DnsShim\Constants\DnskeyType;

/**
 * Description of NewKey
 *
 * @author fabricio.xavier
 */
class NewKey extends DnsShimSocket {

    private $schemaName = 'NewKeyRequest';
    private $schemaFolder;
    private $sessionId;
    private $zonename;
    private $keySize = 1024;
    private $algorithm = DnskeyAlgorithm::RSASHA1;
    private $flags = DnskeyFlags::SEP_ON;
    private $keyStatus = null;
    private $protocol = DnskeyProtocol::PROTOCOL;
    private $keyType = DnskeyType::ZSK;

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

    public function getKeySize() {
        return $this->keySize;
    }

    public function getAlgorithm() {
        return $this->algorithm;
    }

    public function getFlags() {
        return $this->flags;
    }

    public function getKeyStatus() {
        return $this->keyStatus;
    }

    public function getProtocol() {
        return $this->protocol;
    }

    public function getKeyType() {
        return $this->keyType;
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

    public function setKeySize($keySize) {
        $this->keySize = $keySize;
    }

    public function setAlgorithm($algorithm) {
        $this->algorithm = $algorithm;
    }

    public function setFlags($flags) {
        $this->flags = $flags;
    }

    public function setKeyStatus($keyStatus) {
        $this->keyStatus = $keyStatus;
    }

    public function setProtocol($protocol) {
        $this->protocol = $protocol;
    }

    public function setKeyType($keyType) {
        $this->keyType = $keyType;
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

        if (empty($this->keyStatus)) {
            $this->keyStatus = DnskeyStatus::getType('SIGN');
        }

        if (empty($this->getXml())) {
            $this->setXml('<?xml version="1.0" encoding="UTF-8"?>
                <dnsshim version="1.0">
                    <request>
                        <newKey>
                            <sessionId>' . $this->sessionId . '</sessionId>
                            <zone>' . $this->zonename . '</zone>
                            <size>' . $this->keySize . '</size>
                            <type>' . $this->keyType . '</type>
                            <flags>' . $this->flags . '</flags>
                            <status>' . $this->keyStatus . '</status>
                            <algorithm>' . $this->algorithm . '</algorithm>
                            <protocol>' . $this->protocol . '</protocol>
                        </newKey>
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
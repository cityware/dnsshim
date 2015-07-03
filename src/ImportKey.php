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
use Cityware\DnsShim\Constants\DnskeyStatus;
use Cityware\DnsShim\Constants\DnskeyType;

/**
 * Description of NewKey
 *
 * @author fabricio.xavier
 */
class ImportKey extends DnsShimSocket {

    private $schemaName = 'ImportKeyRequest';
    private $schemaFolder;
    private $sessionId;
    private $zonename;
    private $algorithm = DnskeyAlgorithm::RSASHA1;
    private $flags = DnskeyFlags::SEP_ON;
    private $keyType = DnskeyType::ZSK;
    private $keyStatus = null;
    private $modulus;
    private $publicExponent;
    private $privateExponent;
    private $prime1;
    private $prime2;
    private $exponent1;
    private $exponent2;
    private $coefficient;
    
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

    public function getAlgorithm() {
        return $this->algorithm;
    }

    public function getFlags() {
        return $this->flags;
    }

    public function getKeyType() {
        return $this->keyType;
    }

    public function getKeyStatus() {
        return $this->keyStatus;
    }

    public function getModulus() {
        return $this->modulus;
    }

    public function getPublicExponent() {
        return $this->publicExponent;
    }

    public function getPrivateExponent() {
        return $this->privateExponent;
    }

    public function getPrime1() {
        return $this->prime1;
    }

    public function getPrime2() {
        return $this->prime2;
    }

    public function getExponent1() {
        return $this->exponent1;
    }

    public function getExponent2() {
        return $this->exponent2;
    }

    public function getCoefficient() {
        return $this->coefficient;
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

    public function setAlgorithm($algorithm) {
        $this->algorithm = $algorithm;
    }

    public function setFlags($flags) {
        $this->flags = $flags;
    }

    public function setKeyType($keyType) {
        $this->keyType = $keyType;
    }

    public function setKeyStatus($keyStatus) {
        $this->keyStatus = $keyStatus;
    }

    public function setModulus($modulus) {
        $this->modulus = $modulus;
    }

    public function setPublicExponent($publicExponent) {
        $this->publicExponent = $publicExponent;
    }

    public function setPrivateExponent($privateExponent) {
        $this->privateExponent = $privateExponent;
    }

    public function setPrime1($prime1) {
        $this->prime1 = $prime1;
    }

    public function setPrime2($prime2) {
        $this->prime2 = $prime2;
    }

    public function setExponent1($exponent1) {
        $this->exponent1 = $exponent1;
    }

    public function setExponent2($exponent2) {
        $this->exponent2 = $exponent2;
    }

    public function setCoefficient($coefficient) {
        $this->coefficient = $coefficient;
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
                        <importKey>
                            <sessionId>' . $this->sessionId . '</sessionId>
                            <zone>' . $this->zonename . '</zone>
                            <flags>' . $this->flags . '</flags>
                            <type>' . $this->keyType . '</type>
                            <status>' . $this->keyStatus . '</status>
                            <algorithm>' . $this->algorithm . '</algorithm>
                            <modulus>' . $this->modulus . '</modulus>
                            <publicExponent>' . $this->publicExponent . '</publicExponent>
                            <privateExponent>' . $this->privateExponent . '</privateExponent>
                            <prime1>' . $this->prime1 . '</prime1>
                            <prime2>' . $this->prime2 . '</prime2>
                            <exponent1>' . $this->exponent1 . '</exponent1>
                            <exponent2>' . $this->exponent2 . '</exponent2>
                            <coefficient>' . $this->coefficient . '</coefficient>
                        </importKey>
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
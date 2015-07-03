<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cityware\DnsShim;

use Cityware\DnsShim\Socket as DnsShimSocket;
use Cityware\DnsShim\Constants\RrType;
use Cityware\DnsShim\Constants\DnsClass;
/**
 * Description of AddRecord
 *
 * @author fabricio.xavier
 */
class RemoveRecord extends DnsShimSocket {
    
    private $schemaName = 'RrRequest';
    private $schemaFolder;
    private $sessionId;
    private $zonename;
    private $ttl = 86400;
    private $ownername;
    private $type;
    private $dnsClass;
    private $rdata;
    
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

    public function getTtl() {
        return $this->ttl;
    }

    public function getOwnername() {
        return $this->ownername;
    }

    public function getType() {
        return $this->type;
    }

    public function getDnsClass() {
        return $this->dnsClass;
    }

    public function getRdata() {
        return $this->rdata;
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

    public function setTtl($ttl) {
        $this->ttl = $ttl;
    }

    public function setOwnername($ownername) {
        $this->ownername = $ownername;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setDnsClass($dnsClass) {
        $this->dnsClass = $dnsClass;
    }

    public function setRdata($rdata) {
        $this->rdata = $rdata;
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
        
        if (empty($this->rdata)) {
            throw new Exception('Nenhum dado foi definido', 500);
        }
        
        $typeRecord = (empty($this->type)) ? RrType::getType('NS') : RrType::getType($this->type) ;
        
        if (empty($this->dnsClass)) {
            $this->dnsClass = DnsClass::IN;
        }
        
        if (empty($this->getXml())) {
            $this->setXml('<?xml version="1.0" encoding="utf-8"?>
                    <dnsshim version="1.0">
                        <request>
                            <removeRr>
                                <sessionId>' . $this->sessionId . '</sessionId>
                                <zone>' . $this->zonename . '</zone>
                                <rr>
                                    <ownername>' . $this->ownername . '</ownername>
                                    <ttl>' . $this->ttl . '</ttl>
                                    <type>' .  $typeRecord . '</type>
                                    <dnsClass>' . $this->dnsClass . '</dnsClass>
                                    <rdata>' . $this->rdata . '</rdata>
                                </rr>
                            </removeRr>
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

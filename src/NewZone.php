<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cityware\DnsShim;

use Cityware\DnsShim\Socket as DnsShimSocket;
use Cityware\DnsShim\Constants\DnskeyAlgorithm;

/**
 * Description of Login
 *
 * @author fabricio.xavier
 */
class NewZone extends DnsShimSocket {

    private $schemaName = 'NewZoneRequest';
    private $schemaFolder;
    private $sessionId;
    private $zonename;
    private $ttl = 86400;
    private $mname = null;
    private $rname = null;
    private $serial = 1;
    private $refresh = 86400;
    private $retry = 900;
    private $expire = 604800;
    private $minimum = 900;
    private $signed = true;
    private $keySize = 1024;
    private $algorithm = DnskeyAlgorithm::RSASHA1;
    private $expirationPeriod = 2592000; #1 mês;
    private $slaveGroup = "";
    private $autoBalance = false;

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

    public function getMname() {
        return $this->mname;
    }

    public function getRname() {
        return $this->rname;
    }

    public function getSerial() {
        return $this->serial;
    }

    public function getRefresh() {
        return $this->refresh;
    }

    public function getRetry() {
        return $this->retry;
    }

    public function getExpire() {
        return $this->expire;
    }

    public function getMinimum() {
        return $this->minimum;
    }

    public function getSigned() {
        return $this->signed;
    }

    public function getKeySize() {
        return $this->keySize;
    }

    public function getAlgorithm() {
        return $this->algorithm;
    }

    public function getExpirationPeriod() {
        return $this->expirationPeriod;
    }

    public function getSlaveGroup() {
        return $this->slaveGroup;
    }

    public function getAutoBalance() {
        return $this->autoBalance;
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

    public function setMname($mname) {
        $this->mname = $mname;
    }

    public function setRname($rname) {
        $this->rname = $rname;
    }

    public function setSerial($serial) {
        $this->serial = $serial;
    }

    public function setRefresh($refresh) {
        $this->refresh = $refresh;
    }

    public function setRetry($retry) {
        $this->retry = $retry;
    }

    public function setExpire($expire) {
        $this->expire = $expire;
    }

    public function setMinimum($minimum) {
        $this->minimum = $minimum;
    }

    public function setSigned($signed) {
        $this->signed = $signed;
    }

    public function setKeySize($keySize) {
        $this->keySize = $keySize;
    }

    public function setAlgorithm($algorithm) {
        $this->algorithm = $algorithm;
    }

    public function setExpirationPeriod($expirationPeriod) {
        $this->expirationPeriod = $expirationPeriod;
    }

    public function setSlaveGroup($slaveGroup) {
        $this->slaveGroup = $slaveGroup;
    }

    public function setAutoBalance($autoBalance) {
        $this->autoBalance = $autoBalance;
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

        if (empty($this->mname)) {
            $this->setMname('ns1.' . $this->zonename);
        }

        if (empty($this->rname)) {
            $this->setRname('hostmaster.' . $this->zonename);
        }
        
        $xmlPartSlaveGroup = "";
        if($this->slaveGroup != ""){
            $xmlPartSlaveGroup = '<slaveGroup>' . $this->slaveGroup . '</slaveGroup>';
        }
        
        $xmlPartAutoBalance = "";
        if($this->autoBalance){
            $xmlPartAutoBalance = '<autoBalance>' . $this->autoBalance . '</autoBalance>';
        }
        
        $xmlPartKey = "";
        if($this->signed){
            $xmlPartKey .= '<key>';
            $xmlPartKey .= '<size>' . $this->keySize . '</size>';
            $xmlPartKey .= '<algorithm>' . $this->algorithm . '</algorithm>';
            $xmlPartKey .= '<expirationPeriod>' . $this->expirationPeriod . '</expirationPeriod>';
            $xmlPartKey .= '</key>';
        }

        if (empty($this->getXml())) {
            $this->setXml('<?xml version="1.0" encoding="UTF-8"?>
                <dnsshim version="1.0">
                    <request>
                        <newZone>
                            <sessionId>' . $this->sessionId . '</sessionId>
                            <zone>' . $this->zonename . '</zone>
                            <dnssec>' . $this->signed . '</dnssec>
                            '.$xmlPartSlaveGroup.'
                            '.$xmlPartAutoBalance.'
                            <soa>
                                <ttl>' . $this->ttl . '</ttl>
                                <mname>' . $this->mname . '</mname>
                                <rname>' . $this->rname . '</rname>
                                <serial>' . $this->serial . '</serial>
                                <refresh>' . $this->refresh . '</refresh>
                                <retry>' . $this->retry . '</retry>
                                <expire>' . $this->expire . '</expire>
                                <minimum>' . $this->minimum . '</minimum>
                            </soa>
                            '.$xmlPartKey.'
                        </newZone>
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

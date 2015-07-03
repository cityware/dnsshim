<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cityware\DnsShim;

use Cityware\DnsShim\Socket as DnsShimSocket;

/**
 * Description of Login
 *
 * @author fabricio.xavier
 */
class Login extends DnsShimSocket {

    private $schemaName = 'LoginRequest';
    private $schemaFolder;
    private $username;
    private $password;

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password, $type = null) {
        
        if(!empty($type)){
            $passwordDecrypt = \Cityware\Security\Criptography::decrypt2($password, 'rijndael-256');
            $this->password = $passwordDecrypt;
        } else {
            $this->password = $password;
        }
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

    public function __construct($hostIp = null, $hostPort = 9999, $hostProtocol = 'ssl') {
        if (empty($this->schemaFolder)) {
            $this->schemaFolder = Constants\SchemaFolder::getFolder();
        }
        parent::__construct($hostIp, $hostPort, $hostProtocol);
    }

    public function getHashPasswordLogin() {
        return sha1($this->username . $this->password);
    }

    public function communicate() {

        if (empty($this->getXml())) {
            $this->setXml('<?xml version="1.0" encoding="UTF-8"?>
                <dnsshim version="1.0">
                    <request>
                        <login>
                            <username>' . $this->username . '</username>
                            <password>' . $this->getHashPasswordLogin() . '</password>
                        </login>
                    </request>
                </dnsshim>');
        }

        $xmlFormat = new \Cityware\Format\Xml();
        $xsdSchemaFileSource = file_get_contents($this->schemaFolder . $this->schemaName . '.xsd');
        $isValid = $xmlFormat->xsdValidateBySource($this->getXml(), $xsdSchemaFileSource);

        if ($isValid) {
            $return = parent::communicate();
            $returnArray = json_decode(json_encode($return), true);
            return $returnArray['response']['login']['sessionId'];
        }
    }

}

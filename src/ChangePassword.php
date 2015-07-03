<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cityware\DnsShim;

use Cityware\DnsShim\Socket as DnsShimSocket;

/**
 * Description of ChangePassword
 *
 * @author fabricio.xavier
 */
class ChangePassword extends DnsShimSocket {

    private $schemaName = 'ChangePasswordRequest';
    private $schemaFolder;
    private $sessionId;
    private $username;
    private $oldPassword;
    private $newPassword;

    public function setUsername($username) {
        $this->username = $username;
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

    public function getSessionId() {
        return $this->sessionId;
    }

    public function setSessionId($sessionId) {
        $this->sessionId = $sessionId;
    }

    public function getOldPassword() {
        return $this->oldPassword;
    }

    public function getNewPassword() {
        return $this->newPassword;
    }

    public function setOldPassword($oldPassword) {
        $this->oldPassword = $oldPassword;
    }

    public function setNewPassword($newPassword) {
        $this->newPassword = $newPassword;
    }

    public function __construct($hostIp = null, $hostPort = 9999, $hostProtocol = 'ssl') {
        if (empty($this->schemaFolder)) {
            $this->schemaFolder = Constants\SchemaFolder::getFolder();
        }
        parent::__construct($hostIp, $hostPort, $hostProtocol);
    }

    public function getHashPasswordLogin($password) {
        return sha1($this->username . $password);
    }

    public function communicate() {

        if (empty($this->getXml())) {
            $this->setXml('<?xml version="1.0" encoding="utf-8"?>
                <dnsshim version="1.0">
                    <request>
                        <changePassword>
                            <sessionId>' . $this->sessionId . '</sessionId>
                            <username>' . $this->username . '</username>
                            <oldPassword>' . $this->getHashPasswordLogin($this->oldPassword) . '</oldPassword>
                            <newPassword>' . $this->getHashPasswordLogin($this->newPassword) . '</newPassword>
                        </changePassword>
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

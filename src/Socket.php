<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cityware\DnsShim;

/**
 * Description of Socket
 *
 * @author fabricio.xavier
 */
class Socket {

    private $hostProtocol;
    private $hostIp;
    private $hostPort;
    private $xml;
    private $socketSource;
    private $debug;

    public function getHostIp() {
        return $this->hostIp;
    }

    public function getHostPort() {
        return $this->hostPort;
    }

    public function setHostIp($hostIp) {
        $this->hostIp = $hostIp;
    }

    public function setHostPort($hostPort) {
        $this->hostPort = $hostPort;
    }

    public function getXml() {
        return $this->xml;
    }

    public function setXml($xml) {
        $this->xml = $xml;
    }

    public function getSocketSource() {
        return $this->socketSource;
    }

    public function setSocketSource($socketSource) {
        $this->socketSource = $socketSource;
    }

    public function getHostProtocol() {
        return $this->hostProtocol;
    }

    public function setHostProtocol($hostProtocol) {
        $this->hostProtocol = $hostProtocol;
    }
    
    public function getDebug() {
        return $this->debug;
    }

    public function setDebug($debug) {
        $this->debug = $debug;
    }

    
    public function __construct($hostIp = null, $hostPort = 9999, $hostProtocol = 'ssl') {
        $this->setHostIp($hostIp);
        $this->setHostPort($hostPort);
        $this->setHostProtocol($hostProtocol);
    }

    /**
     * Create binary header to sendo XML
     * @param string $xml
     * @return binary
     */
    private function binPack($xml) {
        return pack('N', strlen($xml));
    }

    public function communicate() {
        
        if($this->debug == true){
            echo '<pre>';
            print_r($this->getXml());
            exit;
        }

        $this->connectSource();
        $returnProcess = $this->processSocketXml();
        $this->closeSource();
        return simplexml_load_string($returnProcess);
    }

    private function connectSource() {
        $socketSource = pfsockopen($this->hostProtocol . "://" . $this->hostIp, $this->hostPort);
        if ($socketSource === false) {
            echo "socket_create() failed: reason: " .
            socket_strerror(socket_last_error()) . "\n";
        } else {
            $this->setSocketSource($socketSource);
        }
    }

    private function processSocketXml() {

        $binPack = $this->binPack($this->xml);

        fwrite($this->socketSource, $binPack . $this->xml, strlen($binPack . $this->xml));

        $outHeader = fread($this->socketSource, 4);
        $arrayLeng = unpack('N', $outHeader);
        $remaining = $arrayLeng[1];

        $returnSocket = $outReader = null;

        while ($remaining > 0) {
            $outReader = fread($this->socketSource, $remaining);
            $returnSocket .= $outReader;
            $remaining -= strlen($outReader);
        }

        return $returnSocket;
    }

    private function closeSource() {
        fclose($this->socketSource);
    }

}

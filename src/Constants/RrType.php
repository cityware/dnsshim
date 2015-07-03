<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cityware\DnsShim\Constants;

/**
 * Description of RrType
 *
 * @author fabricio.xavier
 */
class RrType {

    private static $classVars;
    private $A = 'A';
    private $NS = 'NS';
    private $CNAME = 'CNAME';
    private $SOA = 'SOA';
    private $PTR = 'PTR';
    private $HINFO = 'HINFO';
    private $MINFO = 'MINFO';
    private $MX = 'MX';
    private $TXT = 'TXT';
    private $AAAA = 'AAAA';
    private $LOC = 'LOC';
    private $SRV = 'SRV';
    private $NAPTR = 'NAPTR';
    private $CERT = 'CERT';
    private $DNAME = 'DNAME';
    private $OPT = 'OPT';
    private $DS = 'DS';
    private $SSHFP = 'SSHFP';
    private $IPSECKEY = 'IPSECKEY';
    private $RRSIG = 'RRSIG';
    private $NSEC = 'NSEC';
    private $DNSKEY = 'DNSKEY';
    private $NSEC3 = 'NSEC3';
    private $NSEC3PARAM = 'NSEC3PARAM';
    private $TLSA = 'TLSA';
    private $TSIG = 'TSIG';
    
    public static function getType($rrType) {
        self::$classVars = get_class_vars(get_class());
        return self::$classVars[strtoupper($rrType)];
    }

}

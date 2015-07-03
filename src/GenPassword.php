<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Cityware\DnsShim;
/**
 * Description of GenPassword
 *
 * @author fabricio.xavier
 */
class GenPassword {
    //put your code here
    
    public static function generator($completePass) {
        $password = Array();
        $password['uncrypted'] = 'HIMDNS_'.$completePass.'_PASSPHASE';
        $password['crypted'] = \Cityware\Security\Criptography::encrypt2($password['uncrypted'], 'rijndael-256');
        return $password;
    }
}

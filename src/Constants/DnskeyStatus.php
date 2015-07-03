<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cityware\DnsShim\Constants;

/**
 * Description of DnskeyStatus
 *
 * @author fabricio.xavier
 */
class DnskeyStatus {
    
    private $classVars;
    private $SIGN = 1;
    private $PUBLISH = 2;
    private $NONE = 3;

    public static function getType($keyStatus) {
        self::$classVars = get_class_vars(get_class());
        return self::$classVars[strtoupper($keyStatus)];
    }
}

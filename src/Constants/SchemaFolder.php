<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Cityware\DnsShim\Constants;

/**
 * Description of SchemaFolder
 *
 * @author fabricio.xavier
 */
class SchemaFolder {
        
    public static function getFolder() {
        return DATA_PATH . 'dnsshim'  . DS . 'Schemas' . DS;
    }
}

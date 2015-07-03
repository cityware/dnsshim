<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cityware\DnsShim\Constants;

/**
 * Description of ResponseStatus
 *
 * @author fabricio.xavier
 */
class ResponseStatus {

    private static $status = Array(
        1 => 'Ok',
        2 => 'Bad User Interface Clien Request',
        3 => 'Invalid Signer Operation',
        4 => 'Empty Rrset',
        5 => 'Invalid Algorithm',
        6 => 'Invalid Key',
        7 => 'Signature Error',
        8 => 'No Soa',
        9 => 'Transfer Not Allowed',
        10 => 'Not Authoritative',
        11 => 'Dns Message Formerr',
        12 => 'Bad Tsig',
        13 => 'Invalid Dns Message',
        14 => 'Refused Operation',
        15 => 'Dns Server Failure',
        16 => 'Zone Not Found',
        17 => 'Publication Error',
        18 => 'Invalid Soa Version',
        19 => 'Signer Server Failure',
        20 => 'Zone Already Exists',
        21 => 'Resource Record Not Found',
        22 => 'Slave Already Exists',
        23 => 'Slave Not Found',
        24 => 'Invalid Key Status',
        25 => 'Connection Refused',
        27 => 'Ui Server Error',
        28 => 'Invalid Resource Record',
        29 => 'Resource Record Already Exists',
        30 => 'Slave Group Not Found',
        31 => 'Slave Group Already Exists',
        32 => 'Forbidden',
        50 => 'User Not Found',
        51 => 'Invalid User',
        52 => 'User Already Exists',
        53 => 'Invalid Password'
    );

    public function getStatus($statusCode) {
        if (is_numeric($statusCode) and is_int($statusCode)) {
            return self::$status[$statusCode];
        } else {
            throw new Exception('Favor informar o código do status em formato numerico e inteiro!', 500);
        }
    }

}

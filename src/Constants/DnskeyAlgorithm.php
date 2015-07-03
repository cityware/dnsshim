<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Cityware\DnsShim\Constants;

/**
 * Description of DnskeyAlgorithm
 *
 * @author fabricio.xavier
 */
class DnskeyAlgorithm {
    
    const UNKNOWN = 0;
    const RSASHA1 = 5;
    const RSASHA1_NSEC3 = 7;
    const DSA = 3;
    const DSA_NSEC3 = 6;
}

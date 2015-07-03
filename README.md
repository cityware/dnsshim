# dnsshim
Biblioteca PHP para a plataforma DNSSEC da registro.br


Utilização

/* Efetua login de usuário */
echo 'Efetua login de usuário';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$loginDnsShim = new \Cityware\DnsShim\Login();
$loginDnsShim->setHostIp('IP_DOSERVIDOR');
$loginDnsShim->setUsername('username');
$loginDnsShim->setPassword('senha');
$sessionId = $loginDnsShim->communicate();
print_r($sessionId);
echo '<br>';
echo '<br>';

/* Printa a Zona */
echo 'Printa a Versão da Zona';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$versionZoneDnsShim = new \Cityware\DnsShim\ZoneVersion();
$versionZoneDnsShim->setHostIp('IP_DOSERVIDOR');
$versionZoneDnsShim->setSessionId($sessionId);
$versionZoneDnsShim->setZone('dominio.com.br');
print_r($versionZoneDnsShim->communicate());
echo '<br>';
echo '<br>';


/* Printa a Zona */
echo 'Printa a Zona';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$printZoneDnsShim = new \Cityware\DnsShim\PrintZone();
$printZoneDnsShim->setHostIp('IP_DOSERVIDOR');
$printZoneDnsShim->setSessionId($sessionId);
$printZoneDnsShim->setZonename('dominio.com.br');
print_r($printZoneDnsShim->communicate());
echo '<br>';
echo '<br>';

exit;




/* Adiciona usuário */
echo 'Adiciona usuário';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$addUserDnsShim = new \Cityware\DnsShim\AddUser();
$addUserDnsShim->setHostIp('IP_DOSERVIDOR');
$addUserDnsShim->setUsername('username');
$addUserDnsShim->setPassword('senha');
print_r($addUserDnsShim->communicate());
echo '<br>';
echo '<br>';

/* Efetua login de usuário */
echo 'Efetua login de usuário';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$loginDnsShim = new \Cityware\DnsShim\Login();
$loginDnsShim->setHostIp('IP_DOSERVIDOR');
$loginDnsShim->setUsername('username');
$loginDnsShim->setPassword('senha');
$sessionId = $loginDnsShim->communicate();
print_r($sessionId);
echo '<br>';
echo '<br>';

//sleep(5);

exit;

/* Adiciona usuário ao dominio */
echo 'Adiciona usuário ao dominio';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$addZoneUserDnsShim = new \Cityware\DnsShim\AddZoneUser();
$addZoneUserDnsShim->setHostIp('IP_DOSERVIDOR');
$addZoneUserDnsShim->setSessionId($sessionId);
$addZoneUserDnsShim->setZonename('dominio.com.br');
$addZoneUserDnsShim->setUsername('username');
print_r($addZoneUserDnsShim->communicate());
echo '<br>';
echo '<br>';

/* Printa a Zona */
echo 'Printa a Zona';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$printZoneDnsShim = new \Cityware\DnsShim\PrintZone();
$printZoneDnsShim->setHostIp('IP_DOSERVIDOR');
$printZoneDnsShim->setSessionId($sessionId);
$printZoneDnsShim->setZonename('dominio.com.br');
print_r($printZoneDnsShim->communicate());
echo '<br>';
echo '<br>';



exit;

/* Cria Slave Group */
echo 'Cria Slave Group';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$AddSlaveGroupDnsShim = new \Cityware\DnsShim\AddSlaveGroup();
$AddSlaveGroupDnsShim->setHostIp('IP_DOSERVIDOR');
$AddSlaveGroupDnsShim->setSessionId($sessionId);
$AddSlaveGroupDnsShim->setSlaveGroup('dominio.com.br');
print_r($AddSlaveGroupDnsShim->communicate());
echo '<br>';
echo '<br>';

/* Cria Servidor Slave */
echo 'Cria Servidor Slave';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$AddSlaveDnsShim = new \Cityware\DnsShim\AddSlave();
$AddSlaveDnsShim->setHostIp('IP_DOSERVIDOR');
$AddSlaveDnsShim->setSessionId($sessionId);
$AddSlaveDnsShim->setSlaveGroup('dominio.com.br');
$AddSlaveDnsShim->setSlaveIp('IP_DOSERVIDOR');
$AddSlaveDnsShim->setSlavePort('PORTA_DOSERVIDOR');
print_r($AddSlaveDnsShim->communicate());
echo '<br>';
echo '<br>';



/* Cria Slave Group */
echo 'Cria Slave Group';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$RemoveSlaveDnsShim = new \Cityware\DnsShim\RemoveSlave();
$RemoveSlaveDnsShim->setHostIp('IP_DOSERVIDOR');
$RemoveSlaveDnsShim->setSessionId($sessionId);
$RemoveSlaveDnsShim->setSlaveGroup('dominio.com.br');
$RemoveSlaveDnsShim->setSlaveIp('IP_DOSERVIDOR');
$RemoveSlaveDnsShim->setSlavePort('PORTA_DOSERVIDOR');
print_r($RemoveSlaveDnsShim->communicate());
echo '<br>';
echo '<br>';

/* Cria Servidor Slave */
echo 'Cria Servidor Slave';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$RemoveSlaveGroupDnsShim = new \Cityware\DnsShim\RemoveSlaveGroup();
$RemoveSlaveGroupDnsShim->setHostIp('IP_DOSERVIDOR');
$RemoveSlaveGroupDnsShim->setSessionId($sessionId);
$RemoveSlaveGroupDnsShim->setSlaveGroup('dominio.com.br');
print_r($RemoveSlaveGroupDnsShim->communicate());
echo '<br>';
echo '<br>';

/* Efetua logout de usuário */
echo 'Efetua logout de usuário';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$logoutDnsShim = new \Cityware\DnsShim\Logout();
$logoutDnsShim->setHostIp('IP_DOSERVIDOR');
$logoutDnsShim->setSessionId($sessionId);
print_r($logoutDnsShim->communicate());
echo '<br>';
echo '<br>';


exit;

/* Printa a Zona */
echo 'Printa a Zona';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$printZoneDnsShim = new \Cityware\DnsShim\PrintZone();
$printZoneDnsShim->setHostIp('IP_DOSERVIDOR');
$printZoneDnsShim->setSessionId($sessionId);
$printZoneDnsShim->setZonename('dominio.com.br');
print_r($printZoneDnsShim->communicate());
echo '<br>';
echo '<br>';


/* Verifica se existe dominio */
echo 'Verifica se existe dominio';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$zoneExisitsDnsShim = new \Cityware\DnsShim\ZoneExists();
$zoneExisitsDnsShim->setHostIp('IP_DOSERVIDOR');
$zoneExisitsDnsShim->setSessionId($sessionId);
$zoneExisitsDnsShim->setZone('dominio.com.br');
var_dump($zoneExisitsDnsShim->communicate());
echo '<br>';
echo '<br>';

if (!$zoneExisitsDnsShim->communicate()) {

	/* Cria dominio */
	echo 'Cria dominio';
	echo '<br>';
	echo '-----------------------------------------------------------------';
	echo '<br>';
	echo '<br>';
	$newZoneDnsShim = new \Cityware\DnsShim\NewZone();
	$newZoneDnsShim->setHostIp('IP_DOSERVIDOR');
	$newZoneDnsShim->setSessionId($sessionId);
	$newZoneDnsShim->setZonename('dominio.com.br');
	print_r($newZoneDnsShim->communicate());
	echo '<br>';
	echo '<br>';

	//sleep(5);

	/* Cria Record */
	echo 'Cria Record';
	echo '<br>';
	echo '-----------------------------------------------------------------';
	echo '<br>';
	echo '<br>';
	$addRecordDnsShim = new \Cityware\DnsShim\AddRecord();
	$addRecordDnsShim->setHostIp('IP_DOSERVIDOR');
	$addRecordDnsShim->setSessionId($sessionId);
	$addRecordDnsShim->setZonename('dominio.com.br');
	$addRecordDnsShim->setTtl(86400);
	$addRecordDnsShim->setType('NS');
	$addRecordDnsShim->setRdata('ns1.dominio.com.br.');
	print_r($addRecordDnsShim->communicate());
	echo '<br>';
	echo '<br>';

	//sleep(5);

	/* Cria Record */
	echo 'Cria Record';
	echo '<br>';
	echo '-----------------------------------------------------------------';
	echo '<br>';
	echo '<br>';
	$addRecordDnsShim = new \Cityware\DnsShim\AddRecord();
	$addRecordDnsShim->setHostIp('IP_DOSERVIDOR');
	$addRecordDnsShim->setSessionId($sessionId);
	$addRecordDnsShim->setZonename('dominio.com.br');
	$addRecordDnsShim->setTtl(86400);
	$addRecordDnsShim->setType('NS');
	$addRecordDnsShim->setRdata('ns2.dominio.com.br.');
	print_r($addRecordDnsShim->communicate());
	echo '<br>';
	echo '<br>';

	//sleep(5);


	/* Cria Record */
	echo 'Cria Record';
	echo '<br>';
	echo '-----------------------------------------------------------------';
	echo '<br>';
	echo '<br>';
	$addRecordDnsShim = new \Cityware\DnsShim\AddRecord();
	$addRecordDnsShim->setHostIp('IP_DOSERVIDOR');
	$addRecordDnsShim->setSessionId($sessionId);
	$addRecordDnsShim->setZonename('dominio.com.br');
	$addRecordDnsShim->setTtl(86400);
	$addRecordDnsShim->setType('A');
	$addRecordDnsShim->setOwnername('www');
	$addRecordDnsShim->setRdata('IP_DOSERVIDOR');
	print_r($addRecordDnsShim->communicate());
	echo '<br>';
	echo '<br>';

	//sleep(5);
} else {

	/* Cria Record */
	echo 'Cria Record';
	echo '<br>';
	echo '-----------------------------------------------------------------';
	echo '<br>';
	echo '<br>';
	$addRecordDnsShim = new \Cityware\DnsShim\AddRecord();
	$addRecordDnsShim->setHostIp('IP_DOSERVIDOR');
	$addRecordDnsShim->setSessionId($sessionId);
	$addRecordDnsShim->setZonename('dominio.com.br');
	$addRecordDnsShim->setTtl(86400);
	$addRecordDnsShim->setType('A');
	$addRecordDnsShim->setOwnername('www');
	$addRecordDnsShim->setRdata('IP_DOSERVIDOR');
	print_r($addRecordDnsShim->communicate());
	echo '<br>';
	echo '<br>';

	//sleep(5);
}

/* Adiciona usuário */
echo 'Adiciona usuário';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$addUserDnsShim = new \Cityware\DnsShim\AddUser();
$addUserDnsShim->setHostIp('IP_DOSERVIDOR');
$addUserDnsShim->setUsername('username');
$addUserDnsShim->setPassword('senha');
print_r($addUserDnsShim->communicate());
echo '<br>';
echo '<br>';

//sleep(5);

/* Altera senha do usuário */
echo 'Altera senha do usuário';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$changePasswordDnsShim = new \Cityware\DnsShim\ChangePassword();
$changePasswordDnsShim->setHostIp('IP_DOSERVIDOR');
$changePasswordDnsShim->setSessionId($sessionId);
$changePasswordDnsShim->setUsername('desenv@dominio.com.br');
$changePasswordDnsShim->setOldPassword('senha');
$changePasswordDnsShim->setNewPassword('senha');
print_r($changePasswordDnsShim->communicate());
echo '<br>';
echo '<br>';



/* Adiciona usuário ao dominio */
echo 'Adiciona usuário ao dominio';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$addZoneUserDnsShim = new \Cityware\DnsShim\AddZoneUser();
$addZoneUserDnsShim->setHostIp('IP_DOSERVIDOR');
$addZoneUserDnsShim->setSessionId($sessionId);
$addZoneUserDnsShim->setZonename('dominio.com.br');
$addZoneUserDnsShim->setUsername('username');
print_r($addZoneUserDnsShim->communicate());
echo '<br>';
echo '<br>';

//sleep(5);


/* Printa o Slave Group */
echo 'Printa o Slave Group';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$printSlaveGroupDnsShim = new \Cityware\DnsShim\PrintSlaveGroup();
$printSlaveGroupDnsShim->setHostIp('IP_DOSERVIDOR');
$printSlaveGroupDnsShim->setSessionId($sessionId);
$printSlaveGroupDnsShim->setSlaveGroup('slave_grp_01');
print_r($printSlaveGroupDnsShim->communicate());
echo '<br>';
echo '<br>';

//sleep(5);


/* Assina um Slave Group */
echo 'Assina um Slave Group';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$assignSlaveGroupDnsShim = new \Cityware\DnsShim\AssignSlaveGroup();
$assignSlaveGroupDnsShim->setHostIp('IP_DOSERVIDOR');
$assignSlaveGroupDnsShim->setSessionId($sessionId);
$assignSlaveGroupDnsShim->setZonename('dominio.com.br');
$assignSlaveGroupDnsShim->setSlaveGroup('slave_grp_01');
print_r($assignSlaveGroupDnsShim->communicate());
echo '<br>';
echo '<br>';

//sleep(5);


/* Lista Zonas por Slave Group */
echo 'Lista Zonas por Slave Group';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$listZonesBySlaveGroupDnsShim = new \Cityware\DnsShim\ListZonesBySlaveGroup();
$listZonesBySlaveGroupDnsShim->setHostIp('IP_DOSERVIDOR');
$listZonesBySlaveGroupDnsShim->setSessionId($sessionId);
$listZonesBySlaveGroupDnsShim->setSlaveGroup('slave_grp_01');
print_r($listZonesBySlaveGroupDnsShim->communicate());
echo '<br>';
echo '<br>';

//sleep(5);


/* Lista Slave por Zonas */
echo 'Lista Slave por Zonas';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$listSlavesDnsShim = new \Cityware\DnsShim\ListSlaves();
$listSlavesDnsShim->setHostIp('IP_DOSERVIDOR');
$listSlavesDnsShim->setSessionId($sessionId);
$listSlavesDnsShim->setZonename('dominio.com.br');
print_r($listSlavesDnsShim->communicate());
echo '<br>';
echo '<br>';

//sleep(5);


/* Printa a Zona */
echo 'Printa a Zona';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$printZoneDnsShim = new \Cityware\DnsShim\PrintZone();
$printZoneDnsShim->setHostIp('IP_DOSERVIDOR');
$printZoneDnsShim->setSessionId($sessionId);
$printZoneDnsShim->setZonename('dominio.com.br');
print_r($printZoneDnsShim->communicate());
echo '<br>';
echo '<br>';

//sleep(5);


/* Remove Record */
echo 'Remove Record';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$RemoveRecordDnsShim = new \Cityware\DnsShim\RemoveRecord();
$RemoveRecordDnsShim->setHostIp('IP_DOSERVIDOR');
$RemoveRecordDnsShim->setSessionId($sessionId);
$RemoveRecordDnsShim->setZonename('dominio.com.br');
$RemoveRecordDnsShim->setTtl(86400);
$RemoveRecordDnsShim->setType('A');
$RemoveRecordDnsShim->setOwnername('www');
$RemoveRecordDnsShim->setRdata('IP_DOSERVIDOR');
print_r($RemoveRecordDnsShim->communicate());
echo '<br>';
echo '<br>';

//sleep(5);


/* Desassina um Slave Group */
echo 'Desassina um Slave Group';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$unassignSlaveGroupDnsShim = new \Cityware\DnsShim\UnassignSlaveGroup();
$unassignSlaveGroupDnsShim->setHostIp('IP_DOSERVIDOR');
$unassignSlaveGroupDnsShim->setSessionId($sessionId);
$unassignSlaveGroupDnsShim->setZonename('dominio.com.br');
$unassignSlaveGroupDnsShim->setSlaveGroup('slave_grp_01');
print_r($unassignSlaveGroupDnsShim->communicate());
echo '<br>';
echo '<br>';

//sleep(5);


/* Remove usuário do dominio */
echo 'Remove usuário do dominio';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$removeZoneUserDnsShim = new \Cityware\DnsShim\RemoveZoneUser();
$removeZoneUserDnsShim->setHostIp('IP_DOSERVIDOR');
$removeZoneUserDnsShim->setSessionId($sessionId);
$removeZoneUserDnsShim->setZonename('dominio.com.br');
$removeZoneUserDnsShim->setUsername('username');
print_r($removeZoneUserDnsShim->communicate());
echo '<br>';
echo '<br>';

//sleep(5);


/* Remove dominio */
echo 'Remove dominio';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$removeZoneDnsShim = new \Cityware\DnsShim\RemoveZone();
$removeZoneDnsShim->setHostIp('IP_DOSERVIDOR');
$removeZoneDnsShim->setSessionId($sessionId);
$removeZoneDnsShim->setZonename('dominio.com.br');
print_r($removeZoneDnsShim->communicate());
echo '<br>';
echo '<br>';

//sleep(5);


/* Efetua logout de usuário */
echo 'Efetua logout de usuário';
echo '<br>';
echo '-----------------------------------------------------------------';
echo '<br>';
echo '<br>';
$logoutDnsShim = new \Cityware\DnsShim\Logout();
$logoutDnsShim->setHostIp('IP_DOSERVIDOR');
$logoutDnsShim->setSessionId($sessionId);
print_r($logoutDnsShim->communicate());
echo '<br>';
echo '<br>';

//sleep(5);

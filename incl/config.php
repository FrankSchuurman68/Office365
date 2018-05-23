<?php



require_once(__DIR__ .'/class.functions.php');
require_once(__DIR__ .'/FormValidator.php');

$mimksite = new MimkSite();

//Geef de site naam hier. Zonder http/https maar met // zodat het protocol onafhankelijk is
$mimksite->SetWebsiteName('//localhost:54808/');

// Geef het e-mail adres waar de beheerder de meldingen ontvangt.
$mimksite->SetAdminEmail('servicedesk@WilroffReitsma.nl');

// Geef het e-mail adres waar de beheerder de mail vandaan verstuurd.
$mimksite->SetServiceDeskEmail('servicedesk@WilroffReitsma.nl');

$connectstr_dbhost = 'localhost';
$connectstr_dbname = 'portall';
$connectstr_dbusername = 'frank';
$connectstr_dbpassword = 'p0mppm';

	foreach ($_SERVER as $key => $value) {
		if (strpos($key, "MYSQLCONNSTR_") !== 0) {
			continue;
		}
			$connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
			$connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
			$connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
			$connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);



	}

//Geef de database informatie hier weer
//hostname, gebruikersnaam, wachtwoord, database naam en de gebruikte tabellen

$mimksite->InitDB(/*hostname*/$connectstr_dbhost,
                      /*username*/$connectstr_dbusername,
                      /*password*/$connectstr_dbpassword,
                      /*database name*/$connectstr_dbname,
                      /*gebruikerstabel name*/'users',
                      /*righstabel name*/'rights',
                      /*praktijkentabel name*/'praktijken',
                      /*relatietabel name*/'relatie',
                      /*meldingtabel name*/ 'melding');

// Op deze link http://tinyurl.com/randstr kan een salt-key worden gegenereerd.
$mimksite->SetRandomKey('qSRcVS6DrTzrPvr');
?>


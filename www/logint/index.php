<?php

// Session Login Handling Start
// Erzwingen das Session-Cookies benutzt werden und die SID nicht per URL transportiert wird
ini_set( 'session.use_only_cookies', '1' );
ini_set( 'session.use_trans_sid', '0' );

session_start();
include( 'login.inc.php' );
$conid = db_connect();

if (!checkUser( $conid )) { resetUser(); }
if ($_GET['benutzer'] == 'abmelden') { resetUser(); }
// Session Login Handling Ende


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>phpBuddy.eu - Geheime Seite</title>
</head>

<body>

<h3>Willkommen im geschützten Bereich! ;-)</h3>
<p><a href="<?php echo $_SERVER['PHP_SELF']. "?benutzer=abmelden"; ?>">Benutzer abmelden</a></p>

</body>
</html>
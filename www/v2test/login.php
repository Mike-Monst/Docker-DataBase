<?php


// Fehlermeldungen unterdrücken
error_reporting( 0 );

// Erzwingen das Session-Cookies benutzt werden und die SID nicht per URL transportiert wird
ini_set( 'session.use_only_cookies', '1' );
ini_set( 'session.use_trans_sid', '0' );

// Session starten
session_start();

// Sicherstellen das die SID durch den Server vergeben wurde
// um einen möglichen Session Fixation Angriff unwirksam zu machen
if (!isset( $_SESSION['server_SID'] ))
{
	// Möglichen Session Inhalt löschen
	session_unset();
	// Ganz sicher gehen das alle Inhalte der Session gelöscht sind
	$_SESSION = array();
	// Session zerstören
	session_destroy();
	// Session neu starten
	session_start();
	// Neue Server-generierte Session ID vergeben
	session_regenerate_id();
	// Status festhalten
	$_SESSION['server_SID'] = true;
}

// Funktionen einbinden
include( 'login.inc.php' );

// Variablen deklarieren
$_SESSION['angemeldet'] = false;
$conid                  = '';
$eingabe                = array();
$anmeldung              = false;
$update                 = false;
$fehlermeldung          = '';

// Datenbankverbindung öffnen
$conid = db_connect();

// Wenn das Formular abgeschickt wurde
if (isset( $_POST['login'] ))
{
	// Benutzereingabe bereinigen
	$eingabe = cleanInput();
	// Benutzer anmelden
	$anmeldung = loginUser( $eingabe['benutzername'], $eingabe['passwort'], $conid );
	$isp=$eingabe['isp'];
	$loggedinuser=$eingabe['benutzername'];
	// Anmeldung war korrekt
	if ($anmeldung)
	{
		// Benutzer Identifikationsmerkmale in DB speichern
		$update = updateUser( $eingabe['benutzername'], $conid );
		// Bei erfolgreicher Speicherung
		if ($update)
		{
			// Auf geheime Seite weiterleiten
                        $_SESSION['isp'] = "$isp";
                        $_SESSION['loggedinuser'] = "$loggedinuser";
			header( 'location: index.php' );
			exit;
		}
		else
		{
			$fehlermeldung = '<h3>Bei der Anmeldung ist ein Problem aufgetreten!</h3>';
		}
	}
	else
	{
		$fehlermeldung = '<h3>Die Anmeldung war fehlerhaft!</h3>';
	}
}
?>

<html>
<head>
<link rel="shortcut icon" href="http://www.gustavinternet.de/bilder/favicon.ico" type="image/x-icon">
<link rel="icon" href="http://www.gustavinternet.de/bilder/favicon.ico" type="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>bbmp CRM</title>
<link href="index.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor=#ffffff>
<center>
<table border=0 cellspacing=0 cellpadding=0>
<tr>
<td colspan=2>&nbsp;</td>
</tr>
</table>
<center><h3>bbmp Suite 0.9 - broadband management & provisioning (development version)</h3></center>
                                   
<?php
// Falls die Fehlermeldung gesetzt ist
if ($fehlermeldung) echo $fehlermeldung;
?>

<form id="loginform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<table border=0>
<tr><td>    <label for="benutzer">Benutzer: </label></td><td><input type="text" name="benutzer" id="benutzer" value="" /><br /></td></tr>
<tr><td>    <label for="passwort">Passwort: </label></td><td><input type="password" name="passwort" id="passwort" value="" /><br /></td></tr>
<tr><td>    <label for="passwort">Dienst: </label></td><td><select name="isp" id="isp" value="" />
<option value=gustav>gustav internet (Glasfaser Endkunden)</option><option value=hugo selected>hugo internet (VDSL Endkunden)</option><option value=werknetz>werknetz internet (Glasfaser Business)</option></select><br /></td></tr>
<tr><td colspan=2 align=center>    <input type="submit" name="login" id="login" value="Anmelden" /></td></tr>
</table>
</form>
<center><table border=0>
<tr><td align=center>
<img src=images/gustav75.png>
<img src=images/hugo75.png>
<img src=images/werknetz75.png>
</td></tr>
</table>
</center>
</body>
</html>

<?php
include("templates/footer.php");
?>
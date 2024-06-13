<?php

/* *************************** */
/* *** Datenbankverbindung *** */
/* *************************** */
function db_connect()
{
	// Zugangsdaten für die DB
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'testlogin';
//$dbhost= "dbm1.mwerk.net";                // Adresse des Datenbankservers
//$dbhost="10.1.1.51";

$dbhost="localhost";
$dbuser= "crmweb1";                 // Benutzername
$dbpass= "7vfvg4XrVacf";
$dbname= "crmlogin";

	// Verbindung herstellen und Verbindungskennung zurück geben
	$conid = mysql_connect( $dbhost, $dbuser, $dbpass ) or die( 'Verbindungsfehler!' );
	if (is_resource( $conid ))
	{
		mysql_select_db( $dbname, $conid ) or die( 'Datenbankfehler!' );
	}
	return $conid;
}

/* ********************************** */
/* *** Benutzereingabe bereinigen *** */
/* ********************************** */
function cleanInput()
{
	// Maskierende Slashes aus POST Array entfernen
	if (get_magic_quotes_gpc())
	{
		$eingabe['benutzername'] = stripslashes( $_POST['benutzer'] );
		$eingabe['passwort']     = stripslashes( $_POST['passwort'] );
		$eingabe['isp']     = stripslashes( $_POST['isp'] );

	}
	else
	{
		$eingabe['benutzername'] = $_POST['benutzer'];
		$eingabe['passwort']     = $_POST['passwort'];
		$eingabe['isp']     = $_POST['isp'];
	}
	// Trimmen
	$eingabe['benutzername'] = trim( $eingabe['benutzername'] );
	$eingabe['passwort']     = trim( $eingabe['passwort'] );
	$eingabe['isp']     = trim( $eingabe['isp'] );
	// In Kleinschrift umwandeln
	$eingabe['benutzername'] = strtolower( $eingabe['benutzername'] );
	// Eingabe zurückgeben
	return $eingabe;
}

/* ************************* */
/* *** Benutzer anmelden *** */
/* ************************* */
function loginUser( $benutzer, $passwort, $conid )
{
	// Anweisung zusammenstellen
	$sql = "SELECT
				`passwort_zusatz`
			FROM
				`login_profi`
			WHERE
				LOWER(`benutzername`) = '" .mysql_real_escape_string( $benutzer ). "' AND
				`aktiviert` = 1";
	// Anweisung an DB schicken
	$ergebnis = mysql_query( $sql, $conid );
	// Wurde ein Datensatz gefunden, existiert dieser Benutzername, also
	// prüfen wir ob die Anmeldedaten korrekt ist
	if (mysql_num_rows($ergebnis) == 1)
	{
		$datensatz = mysql_fetch_array( $ergebnis );
		// Resourcen freigeben
		mysql_free_result( $ergebnis );
		// Anmeldepasswort vorbereiten
		$zusatz    = $datensatz['passwort_zusatz'];
		$anmeldepw = md5( $passwort.$zusatz );
		// Anweisung zusammenstellen
		$sql = "SELECT
					`id`, `fehlversuche`
				FROM
					`login_profi`
				WHERE
					LOWER(`benutzername`) = '" .mysql_real_escape_string( $benutzer ). "' AND
					`passwort` = '" .mysql_real_escape_string( $anmeldepw ). "' AND
					`aktiviert` = 1";
		// Anweisung an DB schicken
		$ergebnis = mysql_query( $sql, $conid );
		// Prüfen ob ein Datensatz gefunden wurde. In dem Fall stimmen die Anmeldedaten
		if (mysql_num_rows( $ergebnis ) == 1)
		{
			// Counter für Fehlversuche resetten
			$angriff = mysql_fetch_array( $ergebnis );
			if ($angriff['fehlversuche'] != 0)
			{
				$sql = "UPDATE
							`login_profi`
						SET
							`fehlversuche` = 0
						WHERE
							LOWER(`benutzername`) = '" .mysql_real_escape_string( $benutzer ). "'
						LIMIT
							1";
				mysql_query( $sql, $conid );
			}
			// Resourcen freigeben
			mysql_free_result( $ergebnis );
			// Korrekte Anmeldung zurückgeben
			return true;
		}
		else
		{
			// Das angegebene Passwort war nicht korrekt, also gehen wir von einem Angriffsversuch aus
			// und erhöhen den Counter der fehlerhaften Anmeldeversuche
			$sql = "UPDATE
						`login_profi`
					SET
						`fehlversuche` = `fehlversuche` + 1
					WHERE
						LOWER(`benutzername`) = '" .mysql_real_escape_string( $benutzer ). "'
					LIMIT
						1";
			mysql_query( $sql, $conid );
			// Abfragen ob das Limit von 10 Fehlversuche erreicht wurde und in diesem Fall ...
			$sql = "SELECT
						`fehlversuche`
					FROM
						`login_profi`
					WHERE
						LOWER(`benutzername`) = '" .mysql_real_escape_string( $benutzer ). "'";
			$ergebnis = mysql_query( $sql, $conid );
			$anzahl = mysql_fetch_array( $ergebnis );
			mysql_free_result( $ergebnis );
			// ... das Konto deaktivieren
			if ($anzahl['fehlversuche'] > 9)
			{
				$sql = "UPDATE
							`login_profi`
						SET
							`fehlversuche` = 0,
							`aktiviert` = 0
						WHERE
							LOWER(`benutzername`) = '" .mysql_real_escape_string( $benutzer ). "'
						LIMIT
							1";
				mysql_query( $sql, $conid );
			}
		}
	}
}

/* **************************************** */
/* *** Benutzer Datensatz aktualisieren *** */
/* **************************************** */
function updateUser( $benutzer, $conid )
{
	// Benutzer-Datensatz aktualisieren
	$sql = "UPDATE
				`login_profi`
			SET
				`ip` = '" .mysql_real_escape_string( $_SERVER['REMOTE_ADDR'] ). "',
				`benutzerinfo` = '" .mysql_real_escape_string( $_SERVER['HTTP_USER_AGENT'] ). "',
				`anmeldung` = '" .mysql_real_escape_string( md5( $_SERVER['REQUEST_TIME'] ) ). "',
				`zuletzt_aktiv` = NOW()
			WHERE
				LOWER(`benutzername`) = '" .mysql_real_escape_string( $benutzer ). "'
			LIMIT
				1";
	mysql_query( $sql, $conid );
	// Prüfen ob der datensatz aktualisiert wurde
	if (mysql_affected_rows( $conid ) == 1)
	{
		// Session Variablen setzen
		$_SESSION['angemeldet']   = true;
		$_SESSION['benutzername'] = $benutzer;
		$_SESSION['anmeldung']    = md5( $_SERVER['REQUEST_TIME'] );
		return true;
	}
}

/* *********************************** */
/* *** Status des Benutzers prüfen *** */
/* *********************************** */
function checkUser( $conid )
{
	// Alte Session löschen und Sessiondaten in neue Session transferieren
	session_regenerate_id( true );
	if ($_SESSION['angemeldet'] !== true) return false;
	// Benutzerdaten aus DB laden
	$sql = "SELECT
				`ip`, `benutzerinfo`, `anmeldung`, UNIX_TIMESTAMP(`zuletzt_aktiv`) as zuletzt_aktiv
			FROM
				`login_profi`
			WHERE
				`benutzername` = '" .mysql_real_escape_string( $_SESSION['benutzername'] ). "' AND
				`aktiviert` = 1";
	$ergebnis = mysql_query( $sql, $conid );
	if (mysql_num_rows( $ergebnis ) == 1)
	{
		$benutzerdaten = mysql_fetch_array( $ergebnis );
		// Resourcen freigeben
		mysql_free_result( $ergebnis );
		// Daten aus der DB mit den Benutzerdaten vergleichen
		if ($benutzerdaten['ip'] != $_SERVER['REMOTE_ADDR']) return false;
		if ($benutzerdaten['benutzerinfo'] != $_SERVER['HTTP_USER_AGENT']) return false;
		if ($benutzerdaten['anmeldung'] != $_SESSION['anmeldung']) return false;
		if (($benutzerdaten['zuletzt_aktiv'] + 3600) <= $_SERVER['REQUEST_TIME']) return false;
	}
	else
	{
		return false;
	}
	// Wenn die Benutzerdaten okay sind
	// Letzte Aktivität aktualisieren
	$sql = "UPDATE
				`login_profi`
			SET
				`zuletzt_aktiv` = NOW()
			WHERE
				LOWER(`benutzername`) = '" .mysql_real_escape_string( $_SESSION['benutzername'] ). "'
			LIMIT
				1";
	mysql_query( $sql, $conid );
	// Status zurückgeben
	return true;
}

/* ************************* */
/* *** Benutzer abmelden *** */
/* ************************* */
function resetUser()
{
	session_destroy();
	header( 'location: login.php' );
	exit;
}

?>
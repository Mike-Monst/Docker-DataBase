<?php
if (isset( $_POST['adduser'] ))
{
    // Datenbankverbindung
$server="localhost";
$user= "crmweb1";                 // Benutzername
$passwort= "7vfvg4XrVacf";
$dbname= "crmlogin";



$db = @new MySQLi( 'localhost', 'crmweb1', '7vfvg4XrVacf', 'crmlogin' );
if (mysqli_connect_errno() == 0)
   {
   if (get_magic_quotes_gpc()) $_POST = array_map( 'stripslashes', array_map( 'trim', $_POST ) );
   $salt          = substr( md5( microtime() ), 0, 10 );
   $pw_mit_salt   = md5( $_POST['passwort'] . $salt );
   $zuletzt_aktiv = '0000-00-00 00:00:00';
   $fehlversuche  = 0;
   $aktiviert     = 1;
                                                                        
                                                                                // Benutzer in DB schreiben
                                                                                
  $sql = "INSERT INTO `login_profi` (`benutzername`, `passwort`, `passwort_zusatz`, `ip`, `benutzerinfo`, `anmeldung`, `zuletzt_aktiv`, `fehlversuche`, `aktiviert`,`allowedservices`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $insert = $db->prepare( $sql );
            $insert->bind_param( 'sssssssii',
                                                                                                                                                                 $_POST['benutzer'],
                                                                                                                                                                                                                          $pw_mit_salt,
                                                                                                                                                                                                                                                       $salt,
                                                                                                                                                                                                                                                                                    $_SERVER['REMOTE_ADDR'],
                                                                                                                                                                                                                                                                                                                 $_SERVER['HTTP_USER_AGENT'],
                                                                                                                                                                                                                                                                                                                                              md5( $_SERVER['REQUEST_TIME'] ),
                                                                                                                                                                                                                                                                                                                                                                           $zuletzt_aktiv,
                                                                                                                                                                                                                                                                                                                                                                                                        $fehlversuche,
                                                                                                                                                                                                                                                                                                                                                                                                                                     $aktiviert, '');
                                                                                                                                                                                                                                                                                                                                                                                                                                             $insert->execute();
                                                                                                                                                                                                                                                                                                                                                                                                                                                     if ($insert->affected_rows == 1)
                                                                                                                                                                                                                                                                                                                                                                                                                                                             {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                         echo 'Benutzer wurde angelegt.';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         else
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             echo 'Benutzer konnte nicht angelegt werden!';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             else
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         echo 'Die Datenbank konnte nicht erreicht werden. Folgender Fehler trat auf: <span class="hinweis">' .mysqli_connect_errno(). ' : ' .mysqli_connect_error(). '</span>';
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             ?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <head>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <title>phpBuddy.eu - Login Script - Neuer Benutzer</title>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             </head>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <body>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <form id="adduserform" method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <label for="benutzer">Benutzer: </label><input type="text" name="benutzer" id="benutzer" value="" /><br />
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <label for="passwort">Passwort: </label><input type="password" name="passwort" id="passwort" value="" /><br />
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <input type="submit" name="adduser" id="adduser" value="Benutzer hinzufen" />
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         </form>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         </body>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         </html>
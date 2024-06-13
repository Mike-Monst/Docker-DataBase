<?php
/* $Id: user_details.php3,v 1.36 2001/10/21 16:01:44 loic1 Exp $*/


/**
 * Gets some core libraries
 */
require('./libraries/grab_globals.lib.php3');
require('./libraries/common.lib.php3');


/**
 * Defines the url to return to in case of error in a sql statement
 */
$err_url = 'user_details.php3'
         . '?lang=' . $lang
         . '&amp;server=' . $server
         . '&amp;db=mysql'
         . '&amp;table=user';


/**
 * Displays the table of grants for an user
 *
 * @param   mixed    the id of the query used to get hosts and databases lists
 *                   or an arry containing host and user informations
 * @param   mixed    the database to check garnts for, FALSE for all databases
 *
 * @return  boolean  always true
 *
 * @global  string   the current language
 * @global  integer  the server to use (refers to the number in the
 *                   configuration file)
 *
 * @see     check_db()
 *
 * @TODO    "SHOW GRANTS" statements is available and buggyless since
 *          MySQL 3.23.4 and it seems not to return privileges of the anonymous
 *          user while these privileges applies to all users.
 */
function table_grants(&$host_db_result, $dbcheck = FALSE) {
    global $lang, $server;
    ?>

<!-- Table of grants -->
<table border="<?php echo $GLOBALS['cfgBorder']; ?>">
<tr>
    <?php
    // 1. Table headers
    if ($dbcheck) {
        echo "\n";
        echo '    <th>' . $GLOBALS['strAction'] . '</th>' . "\n";
        echo '    <th>' . $GLOBALS['strHost'] . '</th>' . "\n";
        echo '    <th>' . $GLOBALS['strUser'] . '</th>';
    } else {
        echo "\n";
        echo '    <th colspan="2">' . $GLOBALS['strAction'] . '</th>';
    }
    echo "\n";
    echo '    <th>' . $GLOBALS['strDatabase'] . '</th>' . "\n";
    echo '    <th>' . UCFirst($GLOBALS['strTable']) . '</th>' . "\n";
    echo '    <th>' . $GLOBALS['strPrivileges'] . '</th>' . "\n";
    if (!$dbcheck) {
        echo '    <th>Grant Option</th>' . "\n";
    }
    ?>
</tr>
    <?php
    echo "\n";

    // 2. Table body
    $url_query  = 'lang=' . $lang . '&amp;server=' . $server . '&amp;db=mysql&amp;table=user';

    while ($row = (is_array($host_db_result) ? $host_db_result : mysql_fetch_array($host_db_result))) {
        $local_query = 'SHOW GRANTS FOR \'' . $row['User'] . '\'@\'' . $row['Host'] . '\'';
        $result      = mysql_query($local_query);
        $grants_cnt  = @mysql_num_rows($result);

        if ($grants_cnt) {
            $i = 0;
            while ($usr_row = mysql_fetch_row($result)) {
                if (eregi('GRANT (.*) ON ([^\.]+).([^\.]+) TO .*$', $usr_row[0], $parts)) {
                    $priv     = ($parts[1] != 'USAGE') ? trim($parts[1]) : '';
                    $db       = $parts[2];
                    $table    = trim($parts[3]);
                    $grantopt = eregi('WITH GRANT OPTION$', $usr_row[0]);
                } else {
                    $priv     = '';
                    $db       = '&nbsp';
                    $table    = '&nbsp';
                    $column   = '&nbsp';
                    $grantopt = FALSE;
                } // end if...else

                // Password Line
                if ($priv == '' && !$grantopt) {
                    continue;
                }

                // Checking the database (take into account wildcards)
                if ($dbcheck
                    && ($db != '*' && $db != $dbcheck)) {
                    // TODO: db names may contain characters that are regexp
                    //       instructions
                    $re        = '(^|(\\\\\\\\)+|[^\])';
                    $db_regex  = ereg_replace($re . '%', '\\1.*', ereg_replace($re . '_', '\\1.{1}', $db));
                    if (!eregi('^' . $db_regex . '$', $dbcheck)) {
                        continue;
                    }
                } // end if

                $bgcolor    = ($i % 2) ? $GLOBALS['cfgBgcolorOne'] : $GLOBALS['cfgBgcolorTwo'];
                $revoke_url = 'sql.php3'
                            . '?' . $url_query
                            . '&amp;sql_query=' . urlencode('REVOKE ' . $priv . ' ON ' . backquote($db) . '.' . backquote($table) . ' FROM \'' . $row['User'] . '\'@\'' . $row['Host'] . '\'')
                            . '&amp;zero_rows=' . urlencode($GLOBALS['strRevokeMessage'] . ' <span style="color: #002E80">' . $row['User'] . '@' . $row['Host'] . '</span>')
                            . '&amp;goto=user_details.php3';
                if ($grantopt) {
                    $revoke_grant_url = 'sql.php3'
                                      . '?' . $url_query
                                      . '&amp;sql_query=' . urlencode('REVOKE GRANT OPTION ON ' . backquote($db) . '.' . backquote($table) . ' FROM \'' . $row['User'] . '\'@\'' . $row['Host'] . '\'')
                                      . '&amp;zero_rows=' . urlencode($GLOBALS['strRevokeGrantMessage'] . ' <span style="color: #002E80">' . $row['User'] . '@' . $row['Host'] . '</span>')
                                      . '&amp;goto=user_details.php3';
                }
                ?>
<tr bgcolor="<?php echo $bgcolor; ?>">
                <?php
                if (!$dbcheck) {
                    if ($priv) {
                        echo "\n";
                        ?>
    <td<?php if (!$grantopt) echo ' colspan="2"'; ?>>
        <a href="<?php echo $revoke_url; ?>">
            <?php echo $GLOBALS['strRevokePriv']; ?></a>
    </td>
                        <?php
                    }
                    if ($grantopt) {
                        echo "\n";
                        ?>
    <td<?php if (!$priv) echo ' colspan="2"'; ?>>
        <a href="<?php echo $revoke_grant_url; ?>">
            <?php echo $GLOBALS['strRevokeGrant']; ?></a>
    </td>
                        <?php
                    }
                } else {
                    if ($priv) {
                        echo "\n";
                        ?>
    <td>
        <a href="<?php echo $revoke_url; ?>">
            <?php echo $GLOBALS['strRevoke']; ?></a>
    </td>
                        <?php
                    } else {
                        echo "\n";
                        ?>
    <td>&nbsp;</td>
                        <?php
                    }
                    echo "\n";
                    ?>
    <td><?php echo $row['Host']; ?></td>
    <td><?php echo ($row['User']) ? $row['User'] : '<span style="color: #FF0000">' . $GLOBALS['strAny'] . '</span>'; ?></td>
                    <?php
                }
                echo "\n";
                ?>
    <td><?php echo ($db == '*') ? '<span style="color: #002E80">' . $GLOBALS['strAll'] . '</span>' : $db; ?></td>
    <td><?php echo ($table == '*') ? '<span style="color: #002E80">' . $GLOBALS['strAll'] . '</span>' : $table; ?></td>
    <td><?php echo ($priv != '') ? $priv : '<span style="color: #002E80">' . $GLOBALS['strNoPrivileges'] . '</span>'; ?></td>
                <?php
                if (!$dbcheck) {
                    echo "\n";
                    ?>
    <td><?php echo ($grantopt) ? $GLOBALS['strYes'] : $GLOBALS['strNo']; ?></td>
                    <?php
                }
                echo "\n";
                ?>
    <!-- Debug <td><?php echo $usr_row[0] ?></td> Debug -->
</tr>
                <?php
                $i++;
                echo "\n";
            } // end while $usr_row
        } // end if $grants_cnt >0
        // $host_db_result is an array containing related to only one user
        // -> exit the loop
        if (is_array($host_db_result)) {
            break;
        }
    } // end while $row
    ?>
</table>
<hr />

    <?php
    echo "\n";

    return TRUE;
} // end of the 'table_grants()' function


/**
 * Displays the list of grants for a/all database/s
 *
 * @param   mixed    the database to check garnts for, FALSE for all databases
 *
 * @return  boolean  true/false in case of success/failure
 *
 * @see table_grants()
 */
function check_db($dbcheck)
{
    $local_query  = 'SELECT Host, User FROM mysql.user ORDER BY Host, User';
    $result       = mysql_query($local_query);
    $host_usr_cnt = @mysql_num_rows($result);

    if (!$host_usr_cnt) {
        return FALSE;
    }
    table_grants($result, $dbcheck);

    return TRUE;
} // end of the 'check_db()' function


/**
 * Displays the privileges part of a page
 *
 * @param   string   the name of the form for js validation
 * @param   array    the list of the privileges of the user
 *
 * @return  boolean  always true
 *
 * @see normal_operations()
 */
function table_privileges($form, $row = FALSE)
{
    ?>

            <table>
    <?php
    echo "\n";
    $list_priv = array('Select', 'Insert', 'Update', 'Delete', 'Create', 'Drop', 'Reload',
                       'Shutdown', 'Process', 'File', 'Grant', 'References', 'Index', 'Alter');
    $item      = 0;
    while ((list(,$priv) = each($list_priv)) && ++$item) {
        $priv_priv = $priv . '_priv';
        $checked   = ($row && $row[$priv_priv] == 'Y') ?  ' checked="checked"' : '';
        if ($item % 2 == 1) {
            echo '            <tr>' . "\n";
        } else {
            echo '                <td>&nbsp;</td>' . "\n";
        }
        echo '                <td>' . "\n";
        echo '                    <input type="checkbox" name="' . $priv . '_priv"' . $checked . ' />' . "\n";
        echo '                </td>' . "\n";
        echo '                <td>' . $priv . '</td>' . "\n";
        if ($item % 2 == 0) {
            echo '            </tr>' . "\n";
        }
    } // end while
    if ($item % 2 == 1) {
        echo '                <td colspan="2">&nbsp;<td>' . "\n";
        echo '            </tr>' . "\n";
    } // end if
    ?>
            </table>
            <table>
            <tr>
                <td>
                    <a href="#" onclick="checkForm('<?php echo $form; ?>', true); return false">
                        <?php echo $GLOBALS['strCheckAll']; ?></a>
                </td>
                <td>&nbsp;</td>
                <td>
                    <a href="#" onclick="checkForm('<?php echo $form; ?>', false); return false">
                        <?php echo $GLOBALS['strUncheckAll']; ?></a>
                </td>
            </tr>
            </table>
    <?php
    echo "\n";

    return TRUE;
} // end of the 'table_privileges()' function


/**
 * Displays the page for "normal" operations
 *
 * @return  boolean  always true
 *
 * @global  string   the current language
 * @global  integer  the server to use (refers to the number in the
 *                   configuration file)
 *
 * @see table_privileges()
 */
function normal_operations()
{
    global $lang, $server;
    ?>

<ul>

    <li>
        <div style="margin-bottom: 10px">
        <a href="user_details.php3?lang=<?php echo $lang; ?>&amp;server=<?php echo $server; ?>&amp;db=mysql&amp;table=user&amp;mode=reload">
            <?php echo $GLOBALS['strReloadMySQL']; ?></a>&nbsp;
        <?php print show_docu('manual_Reference.html#FLUSH'); ?>
        </div>
    </li>

    <li>
        <form name="dbPrivForm" action="user_details.php3" method="post">
            <?php echo $GLOBALS['strCheckDbPriv'] . "\n"; ?>
            <table>
            <tr>
                <td>
                    <?php echo $GLOBALS['strDatabase']; ?>&nbsp;:&nbsp;
                    <select name="db">
    <?php
    echo "\n";
    $result = mysql_query('SHOW DATABASES');
    if (@mysql_num_rows($result)) {
        while ($row = mysql_fetch_row($result)) {
            echo '                        ';
            echo '<option value="' . str_replace('"', '&quot;', $row[0]) . '">' . htmlspecialchars($row[0]) . '</option>' . "\n";
        } // end while
    } // end if
    ?>
                    </select>
                    <input type="hidden" name="lang" value="<?php echo $lang; ?>" />
                    <input type="hidden" name="server" value="<?php echo $server; ?>" />
                    <input type="hidden" name="check" value="1" />
                    <input type="submit" value="<?php echo $GLOBALS['strGo']; ?>" />
                </td>
            </tr>
            </table>
        </form>
    </li>

    <li>
        <form action="user_details.php3" method="post" name="addUserForm" onsubmit="return checkAddUser()">
            <?php echo $GLOBALS['strAddUser'] . "\n"; ?>
            <table>
            <tr>
                <td>
                    <input type="radio" name="anyhost" checked="checked" />
                    <?php echo $GLOBALS['strAnyHost'] . "\n"; ?>
                </td>
                <td>&nbsp;</td>
                <td>
                    <input type="radio" name="anyhost" />
                    <?php echo $GLOBALS['strHost']; ?>&nbsp;:&nbsp;
                </td>
                <td>
                    <input type="text" name="host" size="10" onchange="this.form.anyhost[1].checked = true" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="anyuser" />
                    <?php echo $GLOBALS['strAnyUser']; ?>
                </td>
                <td>&nbsp;</td>
                <td>
                    <input type="radio" name="anyuser" checked="checked" />
                    <?php echo $GLOBALS['strUserName']; ?>&nbsp;:&nbsp;
                </td>
                <td>
                    <input type="text" name="pma_user" size="10" onchange="this.form.anyuser[1].checked = true" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="nopass" value="1" onclick="pma_pw.value = ''; pma_pw2.value = ''" />
                    <?php echo $GLOBALS['strNoPassword'] . "\n"; ?>
                </td>
                <td>&nbsp;</td>
                <td>
                    <input type="radio" name="nopass" value="0" checked="checked" />
                    <?php echo $GLOBALS['strPassword']; ?>&nbsp;:&nbsp;
                </td>
                <td>
                    <input type="password" name="pma_pw" size="10" onchange="nopass[1].checked = true" />
                    &nbsp;&nbsp;
                    <?php echo $GLOBALS['strReType']; ?>&nbsp;:&nbsp;
                    <input type="password" name="pma_pw2" size="10" onchange="nopass[1].checked = true" />
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <br />
                    <?php echo $GLOBALS['strPrivileges']; ?>&nbsp;:
                    <br />
                </td>
            </tr>
            </table>
    <?php
    echo "\n";
    table_privileges('addUserForm');
    ?>
            <input type="hidden" name="lang" value="<?php echo $lang; ?>" />
            <input type="hidden" name="server" value="<?php echo $server; ?>" />
            <input type="submit" name="submit_addUser" value="<?php echo $GLOBALS['strGo']; ?>" />
        </form>
    </li>

</ul>
    <?php

    return TRUE;
} // end of the 'normal_operations()' function


/**
 * Displays the grant operations part of an user properties page
 *
 * @param   array    grants of the current user
 *
 * @return  boolean  always true
 *
 * @global  string   the current language
 * @global  integer  the server to use (refers to the number in the
 *                   configuration file)
 * @global  string   the host name to check grants for
 * @global  string   the username to check grants for
 * @global  string   the database to check grants for
 * @global  string   the table to check grants for
 *
 * @see table_privileges()
 */
function grant_operations($grants)
{
    global $lang, $server, $host, $pma_user;
    global $dbgrant, $tablegrant;
    ?>

<ul>

    <li>
        <div style="margin-bottom: 10px">
        <a href="user_details.php3?lang=<?php echo $lang; ?>&amp;server=<?php echo $server; ?>&amp;db=mysql&amp;table=user">
            <?php echo $GLOBALS['strBack']; ?></a>
        </div>
    </li>

    <li>
        <form action="user_details.php3" method="post" name="userGrants">
            <input type="hidden" name="lang" value="<?php echo $lang; ?>" />
            <input type="hidden" name="server" value="<?php echo $server; ?>" />
            <input type="hidden" name="grants" value="1" />
            <input type="hidden" name="host" value="<?php echo str_replace('"', '&quot;', $host); ?>" />
            <input type="hidden" name="pma_user" value="<?php echo str_replace('"', '&quot;', $pma_user); ?>" />

            <?php echo $GLOBALS['strAddPriv'] . "\n"; ?>
            <table>
            <tr>
                <td>
                    <input type="radio" name="anydb" value="1"<?php echo ($dbgrant) ? '' : ' checked="checked"'; ?> />
                    <?php echo $GLOBALS['strAnyDatabase'] . "\n"; ?>
                </td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td>
                    <input type="radio" name="anydb" value="0"<?php echo ($dbgrant) ? ' checked="checked"' : ''; ?> />
                    <?php echo $GLOBALS['strDatabase']; ?>&nbsp;:&nbsp;
                </td>
                <td>
                    <select name="dbgrant" onchange="change(this)">
                        <option></option>
    <?php
    echo "\n";
//    if (!isset($dbgrant)) {
//        echo '                        ';
//        echo '<option></option>' . "\n";
//    }
    $result = mysql_query('SHOW DATABASES');
    if (@mysql_num_rows($result)) {
        while ($row = mysql_fetch_row($result)) {
            $selected = (($row[0] == $dbgrant) ? ' selected="selected"' : '');
            echo '                        ';
            echo '<option' . $selected . '>' . $row[0] . '</option>' . "\n";
        } // end while
    } // end if
    ?>
                    </select>
                </td>
                <td>
                    &nbsp;
                    <input type="submit" value="<?php echo $GLOBALS['strShowTables']; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="anytable" value="1"<?php echo ($tablegrant) ? '' : ' checked="checked"'; ?> />
                    <?php echo $GLOBALS['strAnyTable'] . "\n"; ?>
                </td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td>
                    <input type="radio" name="anytable" value="0"<?php echo ($tablegrant) ? ' checked="checked"' : ''; ?> />
                    <?php echo $GLOBALS['strTable']; ?>&nbsp;:&nbsp;
                </td>
                <td>
                    <select name="tablegrant" onchange="change(this)">
                        <option></option>
    <?php
    echo "\n";
//    if (!isset($tablegrant)) {
//        echo '                        ';
//        echo '<option></option>' . "\n";
//    }
    if (isset($dbgrant)) {
        $result = mysql_query('SHOW TABLES FROM ' . backquote($dbgrant));
        if (@mysql_num_rows($result)) {
            while ($row = mysql_fetch_row($result)) {
                $selected = ((isset($tablegrant) && $row[0] == $tablegrant) ? ' selected="selected"' : '');
                echo '                        ';
                echo '<option' . $selected . '>' . $row[0] . '</option>' . "\n";
            } // end while
        } // end if
    } // end if
    ?>
                    </select>
                </td>
                <td>
                    &nbsp;
                    <input type="submit" value="<?php echo $GLOBALS['strShowCols']; ?>" />
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <input type="radio" name="anycolumn" value="1" checked="checked" />
                    <?php echo $GLOBALS['strAnyColumn'] . "\n"; ?>
                </td>
                <td>&nbsp;&nbsp;&nbsp;</td>
                <td valign="top">
                    <input type="radio" name="anycolumn" value="0" />
                    <?php echo $GLOBALS['strColumn']; ?>&nbsp;:&nbsp;
                </td>
                <td>
    <?php
    echo "\n";
    if (!isset($dbgrant) || !isset($tablegrant)) {
        echo '                    ' . '<select name="colgrant[]">' . "\n";
        echo '                        ' . '<option></option>' . "\n";
        echo '                    ' . '</select>' . "\n";
    }
    else {
        $result = mysql_query('SHOW COLUMNS FROM ' . backquote($dbgrant) . '.' . backquote($tablegrant));
        if (@mysql_num_rows($result)) {
            echo '                    '
                 . '<select name="colgrant[]" multiple="multiple" onchange="anycolumn[1].checked = true">' . "\n";
            while ($row = mysql_fetch_row($result)) {
                echo '                        ';
                echo '<option value="' . str_replace('"', '&quot;', $row[0]) . '">' . $row[0] . '</option>' . "\n";
            } // end while
        } else {
            echo '                    ' . '<select name="colgrant[]">' . "\n";
            echo '                        ' . '<option></option>' . "\n";
        } // end if... else...
        echo '                    '
             . '</select>' . "\n";
    } // end if... else
    ?>
                </td>
                <td></td>
            </tr>
            </table>

            <table>
            <tr>
                <td>
                    <br />
                    <?php echo $GLOBALS['strPrivileges']; ?>&nbsp;:&nbsp;
                    <br />
                </td>
            </tr>
            </table>
    <?php
    echo "\n";
    table_privileges('userGrants', $grants);
    ?>
            <input type="submit" name="upd_grants" value="<?php echo $GLOBALS['strGo']; ?>" />
        </form>
    </li>

</ul>
    <?php
    echo "\n";

    return TRUE;
} // end of the 'grant_operations()' function


/**
 * Displays the page to edit operations
 *
 * @param   string   the host name
 * @param   string   the user name
 *
 * @return  boolean  always true
 *
 * @global  string   the current language
 * @global  integer  the server to use (refers to the number in the
 *                   configuration file)
 * @global  string   the host name to check grants for
 * @global  string   the username to check grants for
 *
 * @see table_privileges()
 */
function edit_operations($host, $user)
{
    global $lang, $server;
    global $host, $pma_user;

    $result = mysql_query('SELECT * FROM mysql.user WHERE User = \'' . sql_addslashes($user) . '\' AND Host = \'' . sql_addslashes($host) . '\'');
    $rows   = @mysql_num_rows($result);

    if (!$rows) {
        return FALSE;
    }

    $row = mysql_fetch_array($result);
    ?>

<ul>

    <li>
        <div style="margin-bottom: 10px">
        <a href="user_details.php3?lang=<?php echo $lang; ?>&amp;server=<?php echo $server; ?>&amp;db=mysql&amp;table=user">
            <?php echo $GLOBALS['strBack']; ?></a>
        </div>
    </li>

    <li>
        <form action="user_details.php3" method="post" name="updUserForm" onsubmit="return checkUpdProfile()">
            <?php echo $GLOBALS['strUpdateProfile'] . "\n"; ?>
            <table>
            <tr>
                <td>
                    <input type="radio" value="1" name="anyhost"<?php if ($host == '' || $host == '%') echo ' checked="checked"'; ?> />
                    <?php echo $GLOBALS['strAnyHost'] . "\n"; ?>
                </td>
                <td>&nbsp;</td>
                <td>
                    <input type="radio" value="0" name="anyhost"<?php if ($host != '' && $host != '%') echo ' checked="checked"'; ?> />
                    <?php echo $GLOBALS['strHost']; ?>&nbsp;:&nbsp;
                </td>
                <td>
                    <input type="text" name="new_server" size="10" value="<?php echo str_replace('"', '&quot;', $host); ?>" onchange="this.form.anyhost[1].checked = true" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" value="1" name="anyuser"<?php if ($pma_user == '' || $pma_user == '%') echo ' checked="checked"'; ?> />
                    <?php echo $GLOBALS['strAnyUser']; ?>
                </td>
                <td>&nbsp;</td>
                <td>
                    <input type="radio" value="0" name="anyuser" checked="checked"<?php if ($pma_user != '' && $pma_user != '%') echo ' checked="checked"'; ?> 
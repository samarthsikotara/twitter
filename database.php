<?php
require_once 'config.php';

$dbConn = mysql_connect ($dbHost, $dbUser, $dbPass) or die ('MySQL connect failed. ' . mysql_error());
mysql_select_db($dbName) or die('Cannot select database. ' . mysql_error());

define('SALT_LENGTH',9);

function generateHash($plainText, $salt = null){
    if ($salt === null) {
        $salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH); }
    else {
        $salt = substr($salt, 0, SALT_LENGTH);
    }
    return $salt . sha1($salt . $plainText);
}

function check_ip_behind_proxy() {

    if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        $user_ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
        $user_ip = $_SERVER["HTTP_CLIENT_IP"];
    } else {
        return $_SERVER["REMOTE_ADDR"];
    }

    $ips = preg_split('/[, ]/', $user_ip);
    foreach ($ips as $ip) {
        if (preg_match('/^(\d{1,3}\.){3}\d{1,3}$/s', $ip)
            && !isPrivateIP($ip) ) {
            return $ip;
        }
    }

    return $_SERVER["REMOTE_ADDR"];
}

function sanitize($var, $santype = 1, $allowable_tags = ''){
    if ($santype == 1) {return strip_tags($var, $allowable_tags = '');}
    //elseif ($santype == 2) {return htmlentities(strip_tags($var, $allowable_tags),ENT_QUOTES,'UTF-8');}
    elseif ($santype == 2) {return htmlentities(strip_tags($var, $allowable_tags),ENT_COMPAT,'UTF-8', false) ;}
    elseif ($santype == 3) {
        return addslashes(strip_tags($var, $allowable_tags));
    }
    elseif ($santype == 4) {
        return stripslashes(preg_replace('/<([^>]+)>/es', "'<'.sanitize('\\1',5).'>'",strip_tags($var, $allowable_tags)));
    }
    elseif ($santype == 5) {
        return preg_replace('/\son\w+\s*=/is','',$var);
    }
}

function user_exists($username) {
    // checks to see if user already exists in database
 //   global $db;
    //echo "okok";
    $username = escape($username);
    $sql = "SELECT count(*) FROM `tw_user` WHERE screen_name ='".$username."'";
    //echo $sql;
    $res = dbQuery($sql);
    $res = dbFetchAssoc($res);
    //print_r($res);
    if($res>0) return true;
    return false;
}

function dbQuery($sql)
{
	$result = mysql_query($sql) or die(mysql_error());
	
	return $result;
}

function dbAffectedRows()
{
	global $dbConn;
	
	return mysql_affected_rows($dbConn);
}

function dbFetchArray($result, $resultType = MYSQL_NUM) {
	return mysql_fetch_array($result, $resultType);
}

function dbFetchAssoc($result)
{
	return mysql_fetch_assoc($result);
}

function dbFetchRow($result) 
{
	return mysql_fetch_row($result);
}

function dbFreeResult($result)
{
	return mysql_free_result($result);
}

function dbNumRows($result)
{
	return mysql_num_rows($result);
}

function dbSelect($dbName)
{
	return mysql_select_db($dbName);
}

function dbInsertId()
{
	return mysql_insert_id();
}
function escape($str){
    return mysql_escape_string($str);

}
?>
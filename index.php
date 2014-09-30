<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

/* Load required lib files. */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');
require_once('user.php');

/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    //echo $_SESSION['access_token'];
    header('Location: ./clearsessions.php');
}
/* Get user access tokens out of the session. */
$access_token = $_SESSION['access_token'];
//echo $access_token['oauth_token'];
/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
//print_r($connection);
/* If method is set change API call made. Test is called by default. */
$content = $connection->get('account/verify_credentials');
$followers = $connection->get('followers/list');
print_r(json_encode($content));
//$userip = check_ip_behind_proxy();
//echo substr(md5(uniqid(rand(),true)),0,5);
//echo $userip;


/*
$user = new user();
$user->access_token = $access_token['oauth_token'];
$user->id_str = $content->id;
$user->name = sanitize($content->name,3);
$user->screen_name = sanitize($content->screen_name,3);
$user->location = sanitize($content->location,3);
$user->description = sanitize($content->description,3);
$user->followers_count = sanitize($content->followers_count,3);
$user->friends_count = sanitize($content->friends_count,3);
$user->listed_count = sanitize($content->listed_count,3);
$user->created_at = sanitize($content->created_at,3);
$user->favourites_count = sanitize($content->favourites_count,3);
$user->verified = $content->verified;
$user->geo_enabled = $content->geo_enabled;
$user->statuses_count = $content->statuses_count;
$user->lang = $content->lang;
//user Methods
$user->Create();
$user->read();
//print_r(count($content->users));

/* Some example calls */
//$connection->get('users/show', array('screen_name' => 'abraham'));
//$connection->post('statuses/update', array('status' => date(DATE_RFC822)));
//$connection->post('statuses/destroy', array('id' => 5437877770));
//$connection->post('friendships/create', array('id' => 9436992));
//$connection->post('friendships/destroy', array('id' => 9436992));

/* Include HTML to display on the page */
include('html.inc');

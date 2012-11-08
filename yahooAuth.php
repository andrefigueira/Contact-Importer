<?php

require_once('yos-social-php/lib/Yahoo.inc');
require_once('config.php');

session_start();

$session = YahooSession::requireSession(YAHOO_KEY, YAHOO_SECRET, YAHOO_APP_ID);

if(isset($_GET['oauth_token']))
{

	header('Location: '.PAGE_URL.''.(!empty($_SERVER['QUERY_STRING'])?'?'.$_SERVER['QUERY_STRING']:''), true, '301');

}
elseif(isset($session->guid))
{

	header('Location: '.PAGE_URL.'?yahoo=true');

}

?>


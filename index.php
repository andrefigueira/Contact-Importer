<?php

//Include configs libraries and import class
require_once('config.php');
require_once('google-api-php-client/src/Google_Client.php');
require_once('yos-social-php/lib/Yahoo.inc');
require_once('importer.class.php');

//Start the session
session_start();

//Create the authentication link for getting the Google Auth
$contactsImporter = new ContactsImporter();

//Set the service to Google
$contactsImporter->service = 'google';

//Set the API details
$contactsImporter->googleClientID = GOOGLE_ID;
$contactsImporter->googleClientSecret = GOOGLE_SECRET;

//Set the callback URL
$contactsImporter->callback = CALLBACK_URL; 

echo $contactsImporter->googleAuthButton();

//Get the emails from the authed user on Google
$contactsImporter->fetchGoogleContacts();

//Create the authentication link for getting the Yahoo Auth
$yahooImport = new ContactsImporter();

//Set the service to Yahoo
$yahooImport->service = 'yahoo';

//Set the API details
$yahooImport->yahooAppID = YAHOO_APP_ID;
$yahooImport->yahooConsumerKey = YAHOO_KEY;
$yahooImport->yahooConsumerSecret = YAHOO_SECRET;

//Set the callback URL
$yahooImport->callback = CALLBACK_URL;

echo $yahooImport->yahooAuthButton();

//Get the emails from the authed user on Yahoo
$yahooImport->fetchYahooContacts();
         
?>
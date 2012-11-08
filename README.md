Contact-Importer
================

A wrapper for connecting to Yahoo &amp; Gmail and exporting emails after authenticating using oAuth 2.0 Uses Google PHP SDK and Yahoo PHP SDK

###Usage

Copy the files to your server, make sure you get Credentials for the Yahoo and Google API.

Edit the config.php file and add in all your details, the example of this working is all in index.php

This is dependant on the Yahoo and Google PHP SDK, see includes to see how you should put the files into the directory.

* Google PHP SDK Location: 'google-api-php-client/src/Google_Client.php'

* Yahoo PHP SDK Location: 'yos-social-php/lib/Yahoo.inc'

###Dependancies

Yahoo PHP SDK - https://github.com/yahoo/yos-social-php5

Google PHP SDK - https://code.google.com/p/google-api-php-client/
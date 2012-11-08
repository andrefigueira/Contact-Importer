Contact Importer
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

###Release Notes

I am just putting this out as an original release, I won't be doing too much more developoment on this. I released it as I 
found it rather difficult to get something which connects and gets contacts according to site terms and conditions, as a lot 
of the existing ones just scrape the data which is less than ideal and not scalable at all and prone to error.

###FAQ

####Why is there no Hotmail, LIVE, Outlook.com or AOL?

I did not include any of these services as there is no way using official techniques to get email addresses from these services

####But I've seen things like openinviter and facebook with imports for those services?

First off, sites like Facebook, Twitter, etc.. the big guys, have special deals with these providers to get official access.

Secondly any other service, uses what's called data scaping, however this is not allowed according to the terms of service of these services,
and that's the reason it's not included here, you can fork and add some scraping for other services, but I opted not to add as the reason
for creating this was to use official APIs and not break any terms.
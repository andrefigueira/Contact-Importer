<?php

class ContactsImporter {
	
	public $googleClientID;
	public $googleClientSecret;
	public $yahooConsumerKey;
	public $yahooConsumerSecret;
	public $yahooAppID;
	public $callback;
	public $emailCount = 1000;
	public $format = 'json';
	public $service;
	
	/*
	* Get the content from the contacts API URL with the access token
	* @access public
	* @return array
	*/
	public function googleImportContacts()
	{
	
		if(isset($_SESSION['access_token']))
		{
		
			$accessToken = json_decode($_SESSION['access_token']);
		
			$url = 'https://www.google.com/m8/feeds/contacts/default/full?
			alt='.$this->format.'
			&max-results='.$this->emailCount.'
			&oauth_token='.$accessToken->access_token;
			
			$response = file_get_contents($url);
			
			return json_decode($response, true);
			
		}
			
	}
	
	/*
	* Connect to the Google API and get the authentication code and create the authentication URL
	* @access public
	* @return string
	*/
	public function googleAuthButton()
	{

		$client = new Google_Client();
		$client->setApplicationName(GOOGLE_APP_NAME);
		$client->setClientId(GOOGLE_ID);
		$client->setClientSecret(GOOGLE_SECRET);
		$client->setRedirectUri(CALLBACK_URL);
		$client->setScopes(array('https://www.google.com/m8/feeds'));
		
		$authUrl = '';
		
		if(isset($_GET['code'])) 
		{
		
			$client->authenticate($_GET['code']);
			$_SESSION['access_token'] = $client->getAccessToken();
			header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
		  
		}
		
		if(isset($_SESSION['access_token'])) 
		{
		
			$client->setAccessToken($_SESSION['access_token']);
		  
		}
		
		if($client->getAccessToken()) 
		{
		
		  	// The access token may have been updated lazily.
		  	$_SESSION['access_token'] = $client->getAccessToken();
		  
		} 
		else 
		{
		
		  $authUrl = $client->createAuthUrl();
		  
		}
		
		return '<a href="'.$authUrl.'">Gmail</a>';
		
	}
	
	/*
	* Fetch the results from the return of the google import and loop through them
	* @access public
	* @return array
	*/
	public function fetchGoogleContacts()
	{
	
		$import = $this->googleImportContacts();
	
		if($import != null)
		{
		
			$emailArray = array();
		
			foreach($import['feed']['entry'] as $contact) 
			{
			
				array_push($emailArray, $contact['gd$email']['0']['address']);
				
			}
			
			return $emailArray;
		
		}	
		
	}
	
	/*
	* Create the a tag for the Yahoo authentication button
	* @access public
	* @return string
	*/
	public function yahooAuthButton()
	{
		
		$authUrl = 'yahooAuth.php';
		
		return '<a href="'.$authUrl.'">Yahoo</a>';		
		
	}	
	
	/*
	* Connect to the Yahoo API and send the YQL query to get the contacts from the authed user
	* @access public
	* @return array
	*/
	public function fetchYahooContacts()
	{
	
		if(isset($_GET['oauth_token']) || isset($_GET['yahoo']))
		{
		
			$session = YahooSession::requireSession($this->yahooConsumerKey, $this->yahooConsumerSecret, $this->yahooAppID);
			
			$query = sprintf("select * from social.contacts where guid=me;");  
			$response = $session->query($query); 
			
			if(isset($response))
			{
			
				$emailArray = array();
			
			   foreach($response->query->results->contact as $id)
			   {
			
			       foreach($id->fields as $subid)
			       {
			
		               if($subid->type == 'email')
		               {
		               
		               		array_push($emailArray, $subid->value);
		               
		               }
			      
			       }
			       
			   }
			   
			   return $emailArray;
			   
			}
		
		}
		
	}
	
}

?>
<?php

function createClient() {
	// Connect to Google Account
	$client = new Google_Client();
	$client->setApplicationName("Google Calendar PHP Starter Application");

	// Go to https://console.cloud.google.com/apis/credentials?project=YOUR-PROJECT-NAME-HERE to create client id, client secret, and to register your redirect uri.
	$client->setClientId('756199107576-g14dlo2cq5h3gnq9sh7u0hfj783dkvm5.apps.googleusercontent.com');
	$client->setClientSecret('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');
	$client->setRedirectUri('http://localhost/google-calendar-api/index.php');
	$client->setDeveloperKey('AIzaSyDaV2CdTAMmvJVkTvRcf25fAmIW4LSW5kA');
	$client->addScope("https://www.googleapis.com/auth/calendar");
	
	return $client;
}

?>

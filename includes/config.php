<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
// Google API configuration
define('GOOGLE_CLIENT_ID', '68565884830-lb0slv6toaj5jouscjs3l1hdaglgqpk5.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
define('GOOGLE_REDIRECT_URL', 'http://localhost/glassBuy/shop.php');

// Start session
if(!session_id()){
    session_start();
}

// Include Google API client library
require_once 'google-api-php-client/Google_Client.php';
require_once 'google-api-php-client/contrib/Google_Oauth2Service.php';

// Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId(GOOGLE_CLIENT_ID);
$gClient->setClientSecret(GOOGLE_CLIENT_SECRET);
$gClient->setRedirectUri(GOOGLE_REDIRECT_URL);

$google_oauthV2 = new Google_Oauth2Service($gClient);


?>
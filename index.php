<?php
require_once './vendor/autoload.php';
require_once './apiAccess.php';
require_once './functions_google_api.php';
require_once './router.php';
require_once './logic.php';
require_once './presenter.php';

session_start();

$client = createClient();
if(!authenticate($client)) return;

$logic = new Logic($client);
$presenter = new Presenter($logic); 
(new Router($presenter))->doUserAction();

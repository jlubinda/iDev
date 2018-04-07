<?php
// API group
$app->group('/accounts', function () use ($app) {
	
	$app->get('/', function ($request, @$response, $args) {
		
		@$response->write("Welcome to UAgro accounts Management!");
		return @$response;
	});
	
	$app->get('/index.php', function ($request, @$response, $args) {
		
		@$response->write("Welcome to UAgro accounts Management!");
		return @$response;
	});

	include "newAccount.php";
	include "authenticateAccount.php";
	include "verifyAccount.php";
	include "deleteAccount.php";
	include "resolveAccount.php";
	include "recoverAccount.php";
	include "accountImages.php";
});
?>
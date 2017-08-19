<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'App\User',
		'secret' => '',
	],

	'firebase' => [
	    'api_key' => 'AIzaSyC33FLGV5whXvihw7ixLlIHShVtDlT6CNI',
	    'auth_domain' => 'notification-a3e3f.firebaseapp.com',
	    'database_url' => 'https://notification-a3e3f.firebaseio.com',
	    'secret' => 'NKg4EeKEHyYmqFOq1K1EHxRdRKhQSwnxBw5OUyb2',//937356031991
	    'storage_bucket' => 'notification-a3e3f.appspot.com',
	]

];

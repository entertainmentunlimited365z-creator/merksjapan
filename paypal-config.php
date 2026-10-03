<?php
// Keep the Client Secret on the server. Set these variables in the web server,
// never in JavaScript or a committed configuration file.
$environment = getenv('PAYPAL_ENVIRONMENT') ?: 'sandbox';
$clientId = getenv('PAYPAL_CLIENT_ID') ?: 'AW5eVlxUY4QuSwL1rq28LQCTLEwDgbKABwKeyCyMNbHZdC-cqGjrvt1B2Gpp-76E0KeRxHp-Dg_Ym6T4';
$credentialsPath = __DIR__ . '/app_data/paypal-credentials.php';
$storedCredentials = is_file($credentialsPath) ? require $credentialsPath : [];
$clientSecret = getenv('PAYPAL_CLIENT_SECRET') ?: ($storedCredentials['client_secret'] ?? '');

return [
  'environment' => $environment === 'live' ? 'live' : 'sandbox',
  'client_id' => $clientId,
  'client_secret' => $clientSecret,
  'configured' => $clientId !== '' && $clientSecret !== '',
];

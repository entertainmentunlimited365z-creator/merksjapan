<?php
declare(strict_types=1);

require 'data.php';
$config = require 'paypal-config.php';
header('Content-Type: application/json');

function respond(int $status, array $payload): never {
  http_response_code($status);
  echo json_encode($payload);
  exit;
}

function paypal_request(string $url, array $config, ?array $payload = null, ?string $accessToken = null): array {
  $curl = curl_init($url);
  $headers = ['Accept: application/json'];
  if ($payload !== null) $headers[] = 'Content-Type: application/json';
  if ($accessToken) $headers[] = 'Authorization: Bearer ' . $accessToken;
  $options = [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $payload === null ? 'grant_type=client_credentials' : json_encode($payload)
  ];
  if (!$accessToken) $options[CURLOPT_USERPWD] = $config['client_id'] . ':' . $config['client_secret'];
  curl_setopt_array($curl, $options);
  $response = curl_exec($curl);
  $status = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
  return [$status, json_decode($response ?: '', true) ?: []];
}

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') respond(405, ['error' => 'この操作は許可されていません。']);
if (!$config['configured']) respond(503, ['error' => 'PayPal決済は一時的にご利用いただけません。店舗までお問い合わせください。']);

$request = json_decode(file_get_contents('php://input'), true) ?: [];
$endpoint = $config['environment'] === 'live' ? 'https://api-m.paypal.com' : 'https://api-m.sandbox.paypal.com';
[$tokenStatus, $tokenResponse] = paypal_request($endpoint . '/v1/oauth2/token', $config);
if ($tokenStatus !== 200 || empty($tokenResponse['access_token'])) respond(502, ['error' => 'PayPalに接続できませんでした。']);

if (($request['action'] ?? '') === 'create') {
  $items = [];
  $total = 0;
  foreach (($request['cart'] ?? []) as $entry) {
    $slug = $entry['slug'] ?? '';
    $quantity = max(1, min(10, (int) ($entry['qty'] ?? 1)));
    if (!isset($products[$slug])) continue;
    $product = $products[$slug];
    $items[] = ['name' => $product['name'], 'sku' => $slug, 'unit_amount' => ['currency_code' => 'JPY', 'value' => (string) $product['sale_price']], 'quantity' => (string) $quantity];
    $total += $product['sale_price'] * $quantity;
  }
  if (!$items) respond(400, ['error' => 'カートに商品がありません。']);
  $order = ['intent' => 'CAPTURE', 'purchase_units' => [['amount' => ['currency_code' => 'JPY', 'value' => (string) $total, 'breakdown' => ['item_total' => ['currency_code' => 'JPY', 'value' => (string) $total]], 'shipping' => ['currency_code' => 'JPY', 'value' => '0']], 'items' => $items]]];
  [$status, $response] = paypal_request($endpoint . '/v2/checkout/orders', $config, $order, $tokenResponse['access_token']);
  if ($status < 200 || $status >= 300 || empty($response['id'])) respond(502, ['error' => '注文を作成できませんでした。時間をおいて再度お試しください。']);
  respond(200, ['id' => $response['id']]);
}

if (($request['action'] ?? '') === 'capture') {
  $orderId = $request['orderID'] ?? '';
  if (!preg_match('/^[A-Z0-9]{10,30}$/', $orderId)) respond(400, ['error' => '注文情報が正しくありません。']);
  [$status, $response] = paypal_request($endpoint . '/v2/checkout/orders/' . rawurlencode($orderId) . '/capture', $config, [], $tokenResponse['access_token']);
  if ($status < 200 || $status >= 300 || ($response['status'] ?? '') !== 'COMPLETED') respond(502, ['error' => 'お支払いを完了できませんでした。']);
  respond(200, ['success' => true]);
}

respond(400, ['error' => 'リクエストを処理できませんでした。']);

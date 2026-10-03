<?php require 'data.php'; $paypalConfig = require 'paypal-config.php'; $pageTitle = 'ショッピングカート｜Merks'; require 'header.php'; ?>
<main class="cart-page"><h1>ショッピングカート</h1><p class="shipping-label">全商品30% OFF・全国送料無料</p><div id="cart-items"></div><div id="cart-total" class="cart-total"></div><div id="paypal-button-container"></div><p id="paypal-message" class="notice" role="alert"></p><p class="notice">お支払いはPayPalで安全に行えます。表示価格は税込です。</p></main>
<?php if ($paypalConfig['configured']): ?>
<script src="https://www.<?= $paypalConfig['environment'] === 'live' ? 'paypal' : 'sandbox.paypal' ?>.com/sdk/js?client-id=<?= urlencode($paypalConfig['client_id']) ?>&currency=JPY&intent=capture" onerror="window.MerksPayPalLoadError = true"></script>
<?php endif; ?>
<script>window.MerksPayPalConfigurationError = <?= $paypalConfig['configured'] ? 'false' : 'true' ?>;</script><script src="paypal-checkout.js"></script>
<?php require 'footer.php'; ?>

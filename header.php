<?php
require_once __DIR__ . '/auth.php';
if (!isset($pageTitle)) $pageTitle = 'Merks｜日本のファッション通販';
$pageDescription = $pageDescription ?? 'レディース・メンズウェアを30% OFFで。全国送料無料のオンラインストア、Merks。';
$pageClass = $pageClass ?? '';
$signedInUser = current_user();
$flash = flash_message();
$business = require __DIR__ . '/business-info.php';
?>
<!doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
  <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>"><meta property="og:description" content="<?= htmlspecialchars($pageDescription) ?>"><meta property="og:locale" content="ja_JP">
  <link rel="icon" type="image/svg+xml" href="favicon.svg"><link rel="preconnect" href="https://images.unsplash.com"><link rel="stylesheet" href="styles.css"><link rel="stylesheet" href="auth.css">
</head>
<body class="<?= htmlspecialchars($pageClass) ?>">
  <div class="announcement">期間限定｜全商品30% OFF・全国送料無料</div>
  <header class="site-header"><a class="brand" href="index.php">MERKS<span>®</span></a><nav><a href="index.php#shop">すべての商品</a><a href="index.php#new">新着商品</a><a href="about.php">私たちについて</a><a href="contact.php">お問い合わせ</a></nav><div class="account-nav"><?php if ($signedInUser): ?><span><?= htmlspecialchars($signedInUser['name']) ?> さん</span><form action="logout.php" method="post"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>"><button type="submit">ログアウト</button></form><?php else: ?><a href="login.php">ログイン</a><a class="account-create" href="register.php">新規登録</a><?php endif; ?></div><a class="cart-link" href="cart.php">カート <b id="cart-count">0</b></a></header>
  <?php if ($flash): ?><p class="flash-message" role="status"><?= htmlspecialchars($flash) ?></p><?php endif; ?>

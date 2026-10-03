<?php require 'data.php'; $pageTitle = 'ご注文ありがとうございます｜Merks'; require 'header.php'; ?>
<main class="auth-page"><div class="auth-card"><div class="eyebrow">お支払い完了</div><h1>ご注文ありがとうございます。</h1><p>PayPalでのお支払いが完了しました。PayPalの確認メールを保管してください。ご注文については<a href="<?= htmlspecialchars($business['support_phone_href']) ?>"><?= htmlspecialchars($business['support_phone_display']) ?></a>までお問い合わせください。</p><a class="button" href="index.php">お買い物を続ける</a></div></main>
<?php require 'footer.php'; ?>

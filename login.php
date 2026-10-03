<?php
require 'data.php';
require 'auth.php';
require_guest();

$error = '';
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
  verify_csrf();
  $email = strtolower(trim($_POST['email'] ?? ''));
  $statement = database()->prepare('SELECT id, name, email, password_hash FROM users WHERE email = :email LIMIT 1');
  $statement->execute(['email' => $email]);
  $user = $statement->fetch(PDO::FETCH_ASSOC);
  if (!$user || !password_verify($_POST['password'] ?? '', $user['password_hash'])) {
    $error = 'メールアドレスまたはパスワードが正しくありません。';
  } else {
    session_regenerate_id(true);
    $_SESSION['user'] = ['id' => (int) $user['id'], 'name' => $user['name'], 'email' => $user['email']];
    redirect_with_message('index.php', 'おかえりなさい、' . $user['name'] . 'さん。');
  }
}
$pageTitle = 'ログイン｜Merks';
require 'header.php';
?>
<main class="auth-page"><div class="auth-card"><div class="eyebrow">MERKS アカウント</div><h1>ログイン</h1><p>アカウントにログインしてください。</p><?php if ($error): ?><p class="form-error" role="alert"><?= htmlspecialchars($error) ?></p><?php endif; ?><form method="post" class="account-form"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>"><label>メールアドレス<input type="email" name="email" autocomplete="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"></label><label>パスワード<input type="password" name="password" autocomplete="current-password" required></label><button type="submit">ログイン</button></form><p>初めてご利用の方は<a href="register.php">新規アカウント登録</a>へ。</p></div></main>
<?php require 'footer.php'; ?>

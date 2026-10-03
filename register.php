<?php
require 'data.php';
require 'auth.php';
require_guest();

$error = '';
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
  verify_csrf();
  $name = trim($_POST['name'] ?? '');
  $email = strtolower(trim($_POST['email'] ?? ''));
  $password = $_POST['password'] ?? '';
  if (mb_strlen($name) < 2 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) {
    $error = 'お名前、正しいメールアドレス、8文字以上のパスワードを入力してください。';
  } else {
    try {
      $statement = database()->prepare('INSERT INTO users (name, email, password_hash) VALUES (:name, :email, :password_hash)');
      $statement->execute(['name' => $name, 'email' => $email, 'password_hash' => password_hash($password, PASSWORD_DEFAULT)]);
      session_regenerate_id(true);
      $_SESSION['user'] = ['id' => (int) database()->lastInsertId(), 'name' => $name, 'email' => $email];
      redirect_with_message('index.php', 'Merksへようこそ、' . $name . 'さん。');
    } catch (PDOException $exception) {
      $error = 'このメールアドレスはすでに登録されています。';
    }
  }
}
$pageTitle = '新規アカウント登録｜Merks';
require 'header.php';
?>
<main class="auth-page"><div class="auth-card"><div class="eyebrow">MERKS アカウント</div><h1>新規登録</h1><p>アカウントを作成して、スムーズにお買い物。</p><?php if ($error): ?><p class="form-error" role="alert"><?= htmlspecialchars($error) ?></p><?php endif; ?><form method="post" class="account-form"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>"><label>お名前<input name="name" autocomplete="name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"></label><label>メールアドレス<input type="email" name="email" autocomplete="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"></label><label>パスワード（8文字以上）<input type="password" name="password" autocomplete="new-password" minlength="8" required></label><button type="submit">アカウントを作成</button></form><p>アカウントをお持ちの方は<a href="login.php">ログイン</a>してください。</p></div></main>
<?php require 'footer.php'; ?>

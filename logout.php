<?php
require 'auth.php';
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') { http_response_code(405); exit('この操作は許可されていません。'); }
verify_csrf();
$_SESSION = [];
session_destroy();
session_start();
redirect_with_message('index.php', 'ログアウトしました。');

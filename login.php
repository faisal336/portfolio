<?php
require_once __DIR__ . '/config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? '');
    $pass = $_POST['password'] ?? '';

    // Brute-force protection
    if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 5) {
        $lockout_time = $_SESSION['lockout_until'] ?? 0;
        if (time() < $lockout_time) {
            $error = 'Too many attempts. Try again later.';
        } else {
            $_SESSION['login_attempts'] = 0;
        }
    }

    if (empty($error)) {
        if ($user === ADMIN_USER && password_verify($pass, ADMIN_PASS_HASH)) {
            session_regenerate_id(true);
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['login_attempts'] = 0;
            header('Location: admin.php');
            exit;
        } else {
            $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
            if ($_SESSION['login_attempts'] >= 5) {
                $_SESSION['lockout_until'] = time() + 300; // 5 min lockout
            }
            $error = 'Invalid username or password.';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Login — Faisal Akhtar</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <style>
    :root {
      --bg: #0a0f1a; --card: #131c31; --border: rgba(255,255,255,0.06);
      --muted: #7c8db5; --text: #c9d6ef; --white: #eaf0ff;
      --accent: #3b82f6; --accent2: #8b5cf6;
      --gradient: linear-gradient(135deg, var(--accent2), var(--accent));
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text);
      min-height: 100vh; display: grid; place-items: center;
      background-image:
        radial-gradient(ellipse 600px 400px at 30% 20%, rgba(139,92,246,0.06), transparent),
        radial-gradient(ellipse 400px 300px at 70% 70%, rgba(59,130,246,0.05), transparent);
    }
    .login-card {
      background: var(--card); border: 1px solid var(--border);
      border-radius: 20px; padding: 40px; width: 100%; max-width: 400px;
      box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    }
    .login-card::before {
      content: ''; display: block; height: 3px; border-radius: 20px 20px 0 0;
      background: var(--gradient); margin: -40px -40px 30px; border-radius: 20px 20px 0 0;
    }
    .login-logo {
      width: 56px; height: 56px; border-radius: 14px;
      background: var(--gradient); display: grid; place-items: center;
      font-weight: 800; font-size: 22px; color: #fff;
      margin: 0 auto 20px;
      box-shadow: 0 4px 20px rgba(139,92,246,0.3);
    }
    .login-card h1 { text-align: center; font-size: 22px; font-weight: 700; color: var(--white); margin-bottom: 6px; }
    .login-card .subtitle { text-align: center; font-size: 14px; color: var(--muted); margin-bottom: 28px; }
    .form-group { margin-bottom: 18px; }
    .form-group label { display: block; font-size: 13px; font-weight: 500; color: var(--muted); margin-bottom: 6px; }
    .input-wrap {
      position: relative; display: flex; align-items: center;
      background: rgba(255,255,255,0.03); border: 1px solid var(--border);
      border-radius: 10px; transition: border-color 0.2s;
    }
    .input-wrap:focus-within { border-color: var(--accent); }
    .input-wrap i { position: absolute; left: 14px; color: var(--muted); font-size: 14px; }
    .input-wrap input {
      width: 100%; padding: 12px 14px 12px 42px; border: none; background: none;
      color: var(--white); font-family: inherit; font-size: 14px; outline: none;
    }
    .btn-login {
      width: 100%; padding: 13px; border: none; border-radius: 12px;
      background: var(--gradient); color: #fff; font-family: inherit;
      font-size: 15px; font-weight: 600; cursor: pointer;
      display: flex; align-items: center; justify-content: center; gap: 8px;
      transition: transform 0.2s, box-shadow 0.2s;
      box-shadow: 0 4px 16px rgba(59,130,246,0.25);
    }
    .btn-login:hover { transform: translateY(-2px); box-shadow: 0 6px 24px rgba(59,130,246,0.35); }
    .error {
      background: rgba(244,63,94,0.1); border: 1px solid rgba(244,63,94,0.2);
      color: #f87171; padding: 10px 14px; border-radius: 10px;
      font-size: 13px; margin-bottom: 18px; text-align: center;
    }
    .back-link { display: block; text-align: center; margin-top: 20px; color: var(--muted); font-size: 13px; text-decoration: none; }
    .back-link:hover { color: var(--white); }
  </style>
</head>
<body>
  <div class="login-card">
    <div class="login-logo">F</div>
    <h1>Admin Panel</h1>
    <p class="subtitle">Sign in to manage your portfolio</p>

    <?php if ($error): ?>
      <div class="error"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="form-group">
        <label>Username</label>
        <div class="input-wrap">
          <i class="fas fa-user"></i>
          <input type="text" name="username" required autocomplete="username" />
        </div>
      </div>
      <div class="form-group">
        <label>Password</label>
        <div class="input-wrap">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" required autocomplete="current-password" />
        </div>
      </div>
      <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt"></i> Sign In</button>
    </form>
    <a href="index.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to Portfolio</a>
  </div>
</body>
</html>

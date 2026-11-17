<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$error = "";

if (isset($_POST['submit'])) {
    $nim = $_POST['nim'];
    $password = $_POST['password'];

    if ($nim === "admin" && $password === "123") {
        $_SESSION['login'] = true;
        $_SESSION['nim'] = $nim;
        header("Location: index.php");
        exit;
    } else {
        $error = "NIM atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Portal Mahasiswa</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: #ffffff;
            padding: 32px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 380px;
        }
        .login-box h2 {
            text-align: center;
            color: #1e293b;
            margin-bottom: 8px;
        }
        .login-box p.subtitle {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 24px;
        }
        .form-group {
            margin-bottom: 16px;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: #334155;
            font-size: 14px;
            font-weight: 600;
        }
        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
        }
        .form-group input:focus {
            outline: none;
            border-color: #2563eb;
        }
        .btn-login {
            width: 100%;
            padding: 10px;
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
        }
        .btn-login:hover {
            background-color: #1d4ed8;
        }
        .error-msg {
            background-color: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 16px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Portal Mahasiswa</h2>
        <p class="subtitle">Silakan masuk ke akun kamu</p>

        <?php if ($error !== "") : ?>
            <div class="error-msg"><?= $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="nim">NIM / Username</label>
                <input type="text" id="nim" name="nim" placeholder="Masukkan admin" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan 123" required>
            </div>
            <button type="submit" name="submit" class="btn-login">Masuk</button>
        </form>
    </div>
</body>
</html>
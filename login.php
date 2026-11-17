<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $akun_valid = [
        "admin" => "12345",
        "mahasiswa" => "12345"
    ];

    if (isset($akun_valid[$username]) && $akun_valid[$username] === $password) {

        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;

        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Portal Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card shadow-sm border-0 rounded-4" style="max-width: 400px; width: 100%;">
            <div class="card-body p-4 p-md-5">
                
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary mb-1">Portal Mahasiswa</h3>
                    <p class="text-muted small">Silakan masuk untuk melanjutkan</p>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger py-2 small text-center" role="alert">
                        <?= $error; ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['pesan']) && $_GET['pesan'] === 'logout'): ?>
                    <div class="alert alert-success py-2 small text-center" role="alert">
                        Kamu berhasil keluar dari sistem.
                    </div>
                <?php endif; ?>

                <form method="POST" action="">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required autofocus>
                        <label for="username">Username</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="lihatPassword" onclick="togglePassword()">
                        <label class="form-check-label small text-muted" for="lihatPassword">
                            Tampilkan password
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold rounded-3">
                        Masuk
                    </button>
                </form>

                <div class="mt-4 pt-3 border-top text-center">
                    <small class="text-muted">Akun demo: <b>admin</b> / <b>12345</b></small>
                </div>

            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const inputPass = document.getElementById("password");
            inputPass.type = (inputPass.type === "password") ? "text" : "password";
        }
    </script>

</body>
</html>
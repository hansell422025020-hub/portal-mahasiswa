<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

require_once "function.php";
require_once "data.php";
include_once "assets/header.php";

$nimDipilih = $_GET['nim'] ?? null;

$dataDipilih = null;
foreach ($mahasiswa as $username => $data) {
    if ($data["mahasiswa"]->nim === $nimDipilih) {
        $dataDipilih = $data;
        break;
    }
}

if ($dataDipilih === null) {
    $usernameLogin = $_SESSION['username'] ?? '';
    if (!isset($mahasiswa[$usernameLogin])) {
        header("Location: login.php");
        exit;
    }
    $dataDipilih = $mahasiswa[$usernameLogin];
}

$mhs         = $dataDipilih["mahasiswa"];
$daftarNilai = $dataDipilih["nilai"];
?>

<div class="container py-4">
    <header class="app-header p-4 mb-3 text-center">
        <h1 class="mb-1">Portal Mahasiswa</h1>
        <p class="text-muted small mb-0">Selamat Datang di Portal Mahasiswa</p>
    </header>

    <main>
        <section class="app-section mb-4">
            <h2>Nilai <?= $mhs->namaMahasiswa; ?></h2>
            <p class="text-muted small">
                NIM: <?= $mhs->nim; ?> &middot;
                Jurusan: <?= $mhs->jurusan; ?> &middot;
                Semester: <?= $mhs->semester; ?>
            </p>

            <?php if (empty($daftarNilai)): ?>
                <div class="alert alert-warning">Belum ada nilai untuk mahasiswa ini.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle bg-white">
                        <thead class="table-light">
                            <tr>
                                <th>Kode</th>
                                <th>Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Tugas</th>
                                <th>UTS</th>
                                <th>UAS</th>
                                <th>Rata-rata</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($daftarNilai as $kode => $nl):
                                $mk   = $daftarMatkul[$kode];
                                $rata = ($nl->nilaiTugas + $nl->nilaiUTS + $nl->nilaiUAS) / 3;
                            ?>
                                <tr>
                                    <td><?= $mk->kodeMatkul; ?></td>
                                    <td><?= $mk->namaMatkul; ?></td>
                                    <td><?= $mk->sks; ?></td>
                                    <td><?= $nl->nilaiTugas; ?></td>
                                    <td><?= $nl->nilaiUTS; ?></td>
                                    <td><?= $nl->nilaiUAS; ?></td>
                                    <td><?= number_format($rata, 2); ?></td>
                                    <td>
                                        <a href="detail_matkul.php?kode=<?= urlencode($kode); ?>"
                                           class="btn btn-outline-primary btn-sm rounded-3">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <a href="index.php" class="btn btn-secondary btn-sm rounded-3 mt-3">&larr; Kembali</a>
        </section>
    </main>

    <footer class="text-center mt-4 pt-3 border-top">
        <p class="mb-0">&copy; 2026 Portal Mahasiswa Kelompok 5</p>
    </footer>
</div>
</body>
</html>
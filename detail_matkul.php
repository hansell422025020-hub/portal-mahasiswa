<?php
session_start();
require_once "data.php";

// Proteksi halaman: wajib login terlebih dahulu
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

$usernameLogin = $_SESSION['username'] ?? 'mahasiswa';

// Tangkap Mahasiswa yang dipilih (?nim=422026001), default ke Hansell
$nimDipilih = $_GET['nim'] ?? '422026001';
if (!isset($mapMahasiswa[$nimDipilih])) {
    $nimDipilih = '422026001';
}
$mhsAktif = $mapMahasiswa[$nimDipilih];

// Tangkap Mata Kuliah yang dipilih (?kode=IF101), default ke IF101
$kodeDipilih = $_GET['kode'] ?? 'IF101';
if (!isset($mapMatkul[$kodeDipilih])) {
    $kodeDipilih = 'IF101';
}

$matkulTerpilih = $mapMatkul[$kodeDipilih];
$nilaiTerpilih  = $dataNilaiPerMhs[$mhsAktif->nim][$kodeDipilih] ?? null;

// Fungsi menentukan predikat & status kelulusan
function getPredikat($rataRata) {
    if ($rataRata >= 85) {
        return ['predikat' => 'A', 'badge' => 'bg-success', 'keterangan' => 'Sangat Baik (Lulus)'];
    } elseif ($rataRata >= 75) {
        return ['predikat' => 'B', 'badge' => 'bg-primary', 'keterangan' => 'Baik (Lulus)'];
    } elseif ($rataRata >= 65) {
        return ['predikat' => 'C', 'badge' => 'bg-warning text-dark', 'keterangan' => 'Cukup (Lulus)'];
    } elseif ($rataRata >= 50) {
        return ['predikat' => 'D', 'badge' => 'bg-danger', 'keterangan' => 'Kurang (Tidak Lulus)'];
    } else {
        return ['predikat' => 'E', 'badge' => 'bg-dark', 'keterangan' => 'Gagal (Tidak Lulus)'];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Mata Kuliah - <?= $matkulTerpilih->namaMatkul; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Portal Mahasiswa</a>
            <div class="navbar-nav ms-auto flex-row gap-3">
                <a class="nav-link" href="index.php">Beranda</a>
                <a class="nav-link" href="mahasiswa.php">Mahasiswa</a>
                <a class="nav-link active fw-semibold" href="detail_matkul.php">Detail Matkul</a>
                <a class="nav-link text-warning" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <main class="container mb-5" style="max-width: 780px;">
        
        <!-- Filter Mahasiswa & Mata Kuliah -->
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body p-4">
                <div class="row g-3 align-items-center">
                    <div class="col-md-6">
                        <span class="badge bg-primary-subtle text-primary mb-1">Akun Login: <?= htmlspecialchars($usernameLogin); ?></span>
                        <h4 class="fw-bold mb-0"><?= $mhsAktif->namaMahasiswa; ?></h4>
                        <small class="text-muted">NIM: <?= $mhsAktif->nim; ?> | <?= $mhsAktif->jurusan; ?> (Sem. <?= $mhsAktif->semester; ?>)</small>
                    </div>
                    <div class="col-md-6">
                        <form method="GET" action="detail_matkul.php" class="row g-2">
                            <div class="col-6">
                                <label class="form-label small text-muted mb-1">Pilih Mahasiswa:</label>
                                <select name="nim" class="form-select form-select-sm fw-semibold" onchange="this.form.submit()">
                                    <?php foreach ($mapMahasiswa as $nim => $mhs): ?>
                                        <option value="<?= $nim; ?>" <?= ($nim === $nimDipilih) ? 'selected' : ''; ?>>
                                            <?= $mhs->namaMahasiswa; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted mb-1">Pilih Mata Kuliah:</label>
                                <select name="kode" class="form-select form-select-sm fw-semibold" onchange="this.form.submit()">
                                    <?php foreach ($mapMatkul as $kode => $mk): ?>
                                        <option value="<?= $kode; ?>" <?= ($kode === $kodeDipilih) ? 'selected' : ''; ?>>
                                            <?= $mk->kodeMatkul; ?> - <?= $mk->namaMatkul; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Nilai & Predikat Khusus Mahasiswa & Matkul yang Dipilih -->
        <?php if ($nilaiTerpilih): ?>
            <?php
                $rataRata = $nilaiTerpilih->hitungRataRata(
                    $nilaiTerpilih->nilai_tugas,
                    $nilaiTerpilih->nilai_UTS,
                    $nilaiTerpilih->nilai_UAS
                );
                $hasilPredikat = getPredikat($rataRata);
            ?>
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex justify-content-between align-items-start border-bottom pb-3 mb-4">
                        <div>
                            <small class="text-uppercase text-muted fw-semibold">Detail Nilai Mata Kuliah</small>
                            <h3 class="fw-bold text-primary mb-1"><?= $matkulTerpilih->namaMatkul; ?></h3>
                            <span class="text-muted small">Kode: <b><?= $matkulTerpilih->kodeMatkul; ?></b> | Bobot: <b><?= $matkulTerpilih->sks; ?> SKS</b></span>
                        </div>
                        <div class="text-end">
                            <span class="badge <?= $hasilPredikat['badge']; ?> fs-5 px-3 py-2 rounded-3">
                                Predikat <?= $hasilPredikat['predikat']; ?>
                            </span>
                        </div>
                    </div>

                    <div class="row text-center g-3 mb-4">
                        <div class="col-4">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block">Nilai Tugas</small>
                                <span class="fs-4 fw-bold text-dark"><?= $nilaiTerpilih->nilai_tugas; ?></span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block">Nilai UTS</small>
                                <span class="fs-4 fw-bold text-dark"><?= $nilaiTerpilih->nilai_UTS; ?></span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 bg-light rounded-3">
                                <small class="text-muted d-block">Nilai UAS</small>
                                <span class="fs-4 fw-bold text-dark"><?= $nilaiTerpilih->nilai_UAS; ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-primary-subtle rounded-3 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-primary fw-semibold d-block">Nilai Akhir (Rata-rata)</small>
                            <span class="fs-3 fw-bold text-primary"><?= number_format($rataRata, 2); ?></span>
                        </div>
                        <div class="text-end">
                            <small class="text-muted d-block">Status Kelulusan</small>
                            <span class="fw-bold text-dark"><?= $hasilPredikat['keterangan']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </main>

    <footer class="text-center text-muted py-4 border-top">
        <small>&copy; 2026 Portal Mahasiswa Kelompok 5</small>
    </footer>

</body>
</html>

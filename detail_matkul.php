<?php
session_start();
require_once "function.php";

// Proteksi halaman: wajib login terlebih dahulu
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

$usernameLogin = $_SESSION['username'] ?? 'mahasiswa';

// 1. Data Mahasiswa (dihubungkan dengan username login)
$dataMahasiswa = [
    'mahasiswa' => new Mahasiswa("422026101", "Raka Pratama", "Sistem Informasi", 3),
    'nadia'     => new Mahasiswa("422026102", "Nadia Putri", "Informatika", 3),
    'admin'     => new Mahasiswa("422026101", "Raka Pratama", "Sistem Informasi", 3) // Default preview untuk admin
];

// Ambil objek mahasiswa sesuai akun yang sedang login
$mhsAktif = $dataMahasiswa[$usernameLogin] ?? $dataMahasiswa['mahasiswa'];

// 2. Data Mata Kuliah yang tersedia
$daftarMatkul = [
    'IF101' => new MataKuliah("IF101", "Pemrograman Web", 3),
    'IF102' => new MataKuliah("IF102", "Basis Data", 3),
    'SI201' => new MataKuliah("SI201", "Analisis & Perancangan Sistem", 4)
];

// 3. Database Nilai per Mahasiswa (NIM) & per Mata Kuliah (Kode MK)
$nRakaWeb = new nilai(); $nRakaWeb->nilai_tugas = 88; $nRakaWeb->nilai_UTS = 90; $nRakaWeb->nilai_UAS = 86;
$nRakaDb  = new nilai(); $nRakaDb->nilai_tugas  = 78; $nRakaDb->nilai_UTS  = 82; $nRakaDb->nilai_UAS  = 80;
$nRakaAps = new nilai(); $nRakaAps->nilai_tugas = 92; $nRakaAps->nilai_UTS = 89; $nRakaAps->nilai_UAS = 94;

$nNadiaWeb = new nilai(); $nNadiaWeb->nilai_tugas = 75; $nNadiaWeb->nilai_UTS = 72; $nNadiaWeb->nilai_UAS = 76;
$nNadiaDb  = new nilai(); $nNadiaDb->nilai_tugas  = 85; $nNadiaDb->nilai_UTS  = 88; $nNadiaDb->nilai_UAS  = 84;
$nNadiaAps = new nilai(); $nNadiaAps->nilai_tugas = 68; $nNadiaAps->nilai_UTS = 70; $nNadiaAps->nilai_UAS = 66;

$dataNilaiPerMhs = [
    '422026101' => [
        'IF101' => $nRakaWeb,
        'IF102' => $nRakaDb,
        'SI201' => $nRakaAps,
    ],
    '422026102' => [
        'IF101' => $nNadiaWeb,
        'IF102' => $nNadiaDb,
        'SI201' => $nNadiaAps,
    ]
];

// 4. Tangkap Mata Kuliah yang dipilih user dari URL (?kode=IF101), default ke IF101
$kodeDipilih = $_GET['kode'] ?? 'IF101';
if (!isset($daftarMatkul[$kodeDipilih])) {
    $kodeDipilih = 'IF101';
}

// Ambil detail Matkul A & Nilai milik Murid A saja
$matkulTerpilih = $daftarMatkul[$kodeDipilih];
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
        
        <!-- Identitas Mahasiswa yang Sedang Login -->
        <div class="card shadow-sm border-0 rounded-4 mb-4">
            <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <span class="badge bg-primary-subtle text-primary mb-1">Akun Aktif: <?= htmlspecialchars($usernameLogin); ?></span>
                    <h4 class="fw-bold mb-0"><?= $mhsAktif->namaMahasiswa; ?></h4>
                    <small class="text-muted">NIM: <?= $mhsAktif->nim; ?> | <?= $mhsAktif->jurusan; ?> (Semester <?= $mhsAktif->semester; ?>)</small>
                </div>
                <div class="text-md-end">
                    <small class="text-muted d-block">Pilih Mata Kuliah:</small>
                    <form method="GET" action="detail_matkul.php" class="mt-1">
                        <select name="kode" class="form-select form-select-sm fw-semibold" onchange="this.form.submit()">
                            <?php foreach ($daftarMatkul as $kode => $mk): ?>
                                <option value="<?= $kode; ?>" <?= ($kode === $kodeDipilih) ? 'selected' : ''; ?>>
                                    <?= $mk->kodeMatkul; ?> - <?= $mk->namaMatkul; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <!-- Detail Nilai & Predikat Khusus Murid A pada Matkul A -->
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
        <?php else: ?>
            <div class="alert alert-warning rounded-4">
                Data nilai untuk mata kuliah <b><?= $matkulTerpilih->namaMatkul; ?></b> belum tersedia.
            </div>
        <?php endif; ?>

    </main>

    <footer class="text-center text-muted py-4 border-top">
        <small>&copy; 2026 Portal Mahasiswa Kelompok 5</small>
    </footer>

</body>
</html>

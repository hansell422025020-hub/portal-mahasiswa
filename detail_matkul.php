<?php
session_start();
require_once "data.php";
include_once "assets/header.php";

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

$usernameLogin = $_SESSION['username'] ?? '';
if (!isset($mahasiswa[$usernameLogin])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

$kodeDipilih = $_GET['kode'] ?? '';

$dataMhs = $mahasiswa[$usernameLogin];

if ($dataMhs === null || !isset($daftarMatkul[$kodeDipilih])) {
    header("Location: mahasiswa.php");
    exit;
}

$mhs = $dataMhs["mahasiswa"];    

$matkulTerpilih = $daftarMatkul[$kodeDipilih];
$nilaiTerpilih  = $dataMhs["nilai"][$kodeDipilih] ?? null;

function getPredikat($rataRata) {
    if ($rataRata >= 85) {
        return ['predikat' => 'A', 'badge' => 'bg-success', 'kelulusan' => 'LULUS', 'keterangan' => 'Sangat Baik'];
    } elseif ($rataRata >= 75) {
        return ['predikat' => 'B', 'badge' => 'bg-success', 'kelulusan' => 'LULUS', 'keterangan' => 'Baik'];
    } elseif ($rataRata >= 65) {
        return ['predikat' => 'C', 'badge' => 'bg-success', 'kelulusan' => 'LULUS', 'keterangan' => 'Cukup'];
    } elseif ($rataRata >= 50) {
        return ['predikat' => 'D', 'badge' => 'bg-danger', 'kelulusan' => 'TIDAKLULUS', 'keterangan' => 'Kurang'];
    } else {
        return ['predikat' => 'E', 'badge' => 'bg-dnger', 'kelulusan' => 'TIDAK LULUS', 'keterangan' => 'Gagal'];
    }
}

$rataRata = $nilaiTerpilih->hitungRataRata($nilaiTerpilih->nilaiTugas, $nilaiTerpilih->nilaiUTS, $nilaiTerpilih->nilaiUAS);
$hasilPredikat = getPredikat($rataRata);

?>

    <main class="container mb-5" style="max-width: 780px;">

    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-body p-4">
            <span class="badge bg-primary-subtle text-primary mb-1">Akun Login: <?= htmlspecialchars($_SESSION['username']); ?></span>
            <h4 class="fw-bold primary-text mb-0"><?= $mhs->namaMahasiswa; ?></h4>
            <small class="text-muted">NIM: <?= $mhs->nim; ?> | <?= $mhs->jurusan; ?> (Sem. <?= $mhs->semester; ?>)</small>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-start border-bottom pb-3 mb-4">
                <div>
                    <small class="text-uppercase text-muted fw-semibold">Detail Nilai Mata Kuliah</small>
                    <h3 class="fw-bold primary-text mb-1"><?= $matkulTerpilih->namaMatkul; ?></h3>
                    <span class="text-muted small">Kode: <b><?= $matkulTerpilih->kodeMatkul; ?></b> | Bobot: <b><?= $matkulTerpilih->sks; ?> SKS</b></span>
                </div>
                <div class="text-end">
                    <span class="badge <?= $hasilPredikat['badge']; ?> fs-5 px-3 py-2 rounded-3">
                        <?= $hasilPredikat['kelulusan']; ?>
                    </span>
                </div>
            </div>

            <div class="row text-center g-3 mb-4">
                <div class="col-4">
                    <div class="p-3 bg-light rounded-3">
                        <small class="text-muted d-block">Nilai Tugas</small>
                        <span class="fs-4 fw-bold text-dark"><?= $nilaiTerpilih->nilaiTugas ?? "-"; ?></span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-3 bg-light rounded-3">
                        <small class="text-muted d-block">Nilai UTS</small>
                        <span class="fs-4 fw-bold text-dark"><?= $nilaiTerpilih->nilaiUTS ?? "-"; ?></span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-3 bg-light rounded-3">
                        <small class="text-muted d-block">Nilai UAS</small>
                        <span class="fs-4 fw-bold text-dark"><?= $nilaiTerpilih->nilaiUAS ?? "-"; ?></span>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-primary-subtle rounded-3 d-flex justify-content-between align-items-center">
                <div class="text-center">
                    <small class="fw-semibold d-block">Nilai Akhir (Rata-rata)</small>
                    <span class="fs-3 fw-bold"><?= number_format($rataRata, 2) ?? "-"; ?></span>
                </div>
                <div class="text-center">
                    <small class="d-block">Predikat</small>
                    <span class="fs-3 fw-bold"><?= $hasilPredikat['predikat'] ?? "-"; ?></span>
                </div>
                <div class="text-center">
                    <small class="d-block">Keterangan</small>
                    <span class="fs-3 fw-bold"><?= $hasilPredikat['keterangan'] ?? "-"; ?></span>
                </div>
            </div>

            <a href="mahasiswa.php" class="btn btn-secondary btn-sm rounded-3 mt-4">&larr; Kembali ke Daftar Nilai</a>
        </div>
</div>

    </main>

    <footer class="text-center text-muted py-4 border-top">
        <small>&copy; 2026 Portal Mahasiswa Kelompok 5</small>
    </footer>

</body>
</html>

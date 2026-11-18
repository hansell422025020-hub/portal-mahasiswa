<?php
require_once "function.php";

// Data Mata Kuliah
$matkul1 = new MataKuliah("IF101", "Pemrograman Web", 3);
$matkul2 = new MataKuliah("IF102", "Basis Data", 3);

// Data Dosen
$dosen1 = new Dosen("0123456789", "Budi Santoso, M.Kom.", "Web Development");
$dosen2 = new Dosen("0987654321", "Siti Aminah, M.T.", "Data Science");

// Data Nilai
$nilai1 = new nilai();
$nilai1->nilai_tugas = 85;
$nilai1->nilai_UTS = 90;
$nilai1->nilai_UAS = 88;

$nilai2 = new nilai();
$nilai2->nilai_tugas = 75;
$nilai2->nilai_UTS = 80;
$nilai2->nilai_UAS = 78;

// Data Mahasiswa
$mahasiswa1 = new Mahasiswa("422026001", "Hansell Sarwaguna", "Sistem Informasi", 3);
$mahasiswa2 = new Mahasiswa("422026002", "Adib Dhammika", "Informatika", 3);

// Array Kumpulan Data (untuk dipakai di index.php)
$daftarMatkul    = [$matkul1, $matkul2];
$daftarDosen     = [$dosen1, $dosen2];
$daftarNilai     = [$nilai1, $nilai2];
$daftarMahasiswa = [$mahasiswa1, $mahasiswa2];

// Pemetaan Data per Kode / NIM (untuk dipakai di detail_matkul.php)
$mapMahasiswa = [
    '422026001' => $mahasiswa1,
    '422026002' => $mahasiswa2
];

$mapMatkul = [
    'IF101' => $matkul1,
    'IF102' => $matkul2
];

$dataNilaiPerMhs = [
    '422026001' => [
        'IF101' => $nilai1,
        'IF102' => $nilai2
    ],
    '422026002' => [
        'IF101' => $nilai2,
        'IF102' => $nilai1
    ]
];
?>

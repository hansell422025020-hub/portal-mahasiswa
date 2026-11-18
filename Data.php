<?php
require_once "function.php";

$daftarMatkul = ["SI101" => new MataKuliah("SI101", "Pemrograman Web", 3), "SI102" => new MataKuliah("SI102", "Basis Data", 6)];

$daftarDosen = [new Dosen("0123456789", "Budi Santoso, M.Kom.", "Web Development"), new Dosen("0987654321", "Saki Tenma, M.T.", "Data Science")];

$daftarProdi = [new ProgramStudi("42", "Sistem Informasi", "Fakultas Teknologi Cerdas"), new ProgramStudi("41", "Informatika", "Fakultas Teknologi Cerdas")];

$mahasiswa = [
    "hansell" => [
        "password" => "12345",
        "mahasiswa" => new Mahasiswa("422026001", "Hansell Sarwaguna", "Sistem Informasi", 3),
        "nilai" => ["SI101" => new Nilai(85, 88, 90), "SI102" => new Nilai(78, 80, 82),],
    ],
    "adib" => [
        "password" => "12345",
        "mahasiswa" => new Mahasiswa("422026002", "Adib Dhammika", "Informatika", 3),
        "nilai" => ["SI101" => new Nilai(75, 78, 80), "SI102" => new Nilai(90, 92, 95),],
    ],
];

    $daftarMahasiswa = array_map(fn($u) => $u["mahasiswa"], $mahasiswa);

    $daftarNilai     = array_values($mahasiswa["hansell"]["nilai"]);
?>

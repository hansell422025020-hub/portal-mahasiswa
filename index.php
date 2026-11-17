<?php
    require_once "function.php";

    $matkul1 = new MataKuliah("IF101", "Pemrograman Web", 3);
    $matkul2 = new MataKuliah("IF102", "Basis Data", 3);

    $dosen1 = new Dosen("0123456789", "Budi Santoso, M.Kom.", "Web Development");
    $dosen2 = new Dosen("0987654321", "Siti Aminah, M.T.", "Data Science");

    $nilai1 = new Nilai(85, 90, 88);
    $nilai2 = new Nilai(75, 80, 78); 
    
    $mahasiswa1 = new Mahasiswa("422026001", "Hansell Sarwaguna", "Sistem Informasi", 3);
    $mahasiswa2 = new Mahasiswa("422026002", "Adib Dhammika", "Informatika", 3);

    $daftarMatkul = [$matkul1, $matkul2];
    $daftarDosen = [$dosen1, $dosen2];
    $daftarNilai = [$nilai1, $nilai2];
    $daftarMahasiswa = [$mahasiswa1];
?>

<!DOCTYPE html>
    <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Portal Mahasiswa</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="css/styles.css">
        </head>
        <body>
            
            <header>
                <h1>Portal Mahasiswa</h1>
                <p>Selamat Datang di Portal Mahasiswa</p>
            </header>

            <nav>
                <a href="index.php">Beranda</a>
                <a href="mahasiswa.php">Mahasiswa</a>
            </nav>

            <main>

                <section>
                    <h2>Data Mata Kuliah</h2>

                    <?php foreach ($daftarMatkul as $matkul): ?>
                        <article>
                            <h3><?= $matkul->namaMatkul; ?></h3>
                            <p>Kode Mata Kuliah: <?= $matkul->kodeMatkul; ?></p>
                            <p>SKS: <?= $matkul->sks; ?></p>
                        </article>
                    <?php endforeach; ?>

                </section>


                <section>
                    <h2>Data Dosen</h2>

                    <?php foreach ($daftarDosen as $dosen): ?>
                        <article>
                            <h3><?= $dosen->namaDosen; ?></h3>
                            <p>NIDN: <?= $dosen->nidn; ?></p>
                            <p>Bidang Keahlian: <?= $dosen->bidangKeahlian; ?></p>
                        </article>
                    <?php endforeach; ?>

                </section>


                <section>
                    <h2>Data Nilai</h2>

                    <?php foreach ($daftarNilai as $index => $nilai): ?>
                        <article>
                            <h3>Nilai Mahasiswa <?= $index + 1; ?></h3>
                            <p>Nilai Tugas: <?= $nilai->nilai_tugas; ?></p>
                            <p>Nilai UTS: <?= $nilai->nilai_UTS; ?></p>
                            <p>Nilai UAS: <?= $nilai->nilai_UAS; ?></p>
                        </article>
                    <?php endforeach; ?>

                </section>

                <section>
                    <h2>Data Mahasiswa</h2>

                    <?php foreach ($daftarMahasiswa as $mahasiswa): ?>
                        <article>
                            <h3><?= $mahasiswa->namaMahasiswa; ?></h3>
                            <p>NIM: <?= $mahasiswa->nim; ?></p>
                            <p>Jurusan: <?= $mahasiswa->jurusan; ?></p>
                            <p>Semester: <?= $mahasiswa->semester; ?></p>
                        </article>
                    <?php endforeach; ?>

                </section>

            </main>

            <footer>
                <p>&copy; 2026 Portal Mahasiswa Kelompok 5</p>
            </footer>
        </body>
    </html>
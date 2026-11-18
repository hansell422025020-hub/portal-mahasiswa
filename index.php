<?php
session_start();

    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        header("Location: login.php");
        exit;
    }

    require_once "function.php";
    require_once "data.php";
    include_once "assets/header.php";

?>
        
        <div class="container py-4">
            <header class="app-header p-4 mb-3 text-center">
                <h1 class="mb-1">Portal Mahasiswa</h1>
                <p class="text-muted small mb-0">Selamat Datang di Portal Mahasiswa</p>
            </header>

            <main>

                <section class="app-section mb-4">
                    <h2>Data Mata Kuliah</h2>

                    <?php foreach ($daftarMatkul as $matkul): ?>
                        <article>
                            <h3><?= $matkul->namaMatkul; ?></h3>
                            <p>Kode Mata Kuliah: <?= $matkul->kodeMatkul; ?></p>
                            <p>SKS: <?= $matkul->sks; ?></p>
                        </article>
                    <?php endforeach; ?>

                </section>


                <section class="app-section mb-4">
                    <h2>Data Dosen</h2>

                    <?php foreach ($daftarDosen as $dosen): ?>
                        <article>
                            <h3><?= $dosen->namaDosen; ?></h3>
                            <p>NIDN: <?= $dosen->nidn; ?></p>
                            <p>Bidang Keahlian: <?= $dosen->bidangKeahlian; ?></p>
                        </article>
                    <?php endforeach; ?>

                </section>


                <section class="app-section mb-4">
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

            <footer class="text-center mt-4 pt-3 border-top">
                <p class="mb-0" >&copy; 2026 Portal Mahasiswa Kelompok 5</p>
            </footer>
            </div>
        </body>
    </html>
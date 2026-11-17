<?php
    require_once "function.php"

    $matkul1 = new MataKuliah("IF101", "Pemrograman Web", 3);
    $matkul2 = new MataKuliah("IF102", "Basis Data", 3);

    $dosen1 = new Dosen("0123456789", "Budi Santoso, M.Kom.", "Web Development");
    $dosen2 = new Dosen("0987654321", "Siti Aminah, M.T.", "Data Science");

    $nilai1 = new Nilai(85, 90, 88);
    $nilai2 = new Nilai(75, 80, 78);    
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

        </body>
    </html>
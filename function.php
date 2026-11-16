<?php
 class nilai {
    public float $nilai_tugas;
    public float $nilai_UAS;
    public float $nilai_UTS;

    public  function hitungRataRata($nilai_tugas, $nilai_UTS, $nilai_UAS) {
    foreach ([$nilai_tugas, $nilai_UTS, $nilai_UAS] as $nilai) {
        if (!is_numeric($nilai) || $nilai < 0 || $nilai > 100) {
            throw new InvalidArgumentException("Nilai harus angka antara 0 dan 100.");
        }
    }
    $rata_rata = ($nilai_tugas + $nilai_UTS + $nilai_UAS) / 3;
    return $rata_rata;
}

}
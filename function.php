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
class MataKuliah {
    public $kodeMatkul;
    public $namaMatkul;
    public $sks;

    public function __construct($kodeMatkul, $namaMatkul, $sks) {
        $this->kodeMatkul = $kodeMatkul;
        $this->namaMatkul = $namaMatkul;
        $this->sks = $sks;
    }

    public function getInfoMatkul() {
        return "{$this->kodeMatkul} - {$this->namaMatkul} ({$this->sks} SKS)";
    }
}

class Dosen {
    public $nidn;
    public $namaDosen;
    public $bidangKeahlian;

    public function __construct($nidn, $namaDosen, $bidangKeahlian) {
        $this->nidn = $nidn;
        $this->namaDosen = $namaDosen;
        $this->bidangKeahlian = $bidangKeahlian;
    }

    public function getInfoDosen() {
        return "{$this->namaDosen} (NIDN: {$this->nidn}) - Bidang: {$this->bidangKeahlian}";
    }
}

class JadwalKuliah {
    public $hari;
    public $jam;
    public $ruangan;

    public function __construct($hari, $jam, $ruangan) {
        $this->hari = $hari;
        $this->jam = $jam;
        $this->ruangan = $ruangan;
    }

    public function getInfoJadwal() {
        return "Hari {$this->hari}, Pukul {$this->jam} - Ruang {$this->ruangan}";
    }
}

?>


<?php
 class nilai {
    public float $nilaiTugas;
    public float $nilaiUAS;
    public float $nilaiUTS;


    public function __construct($nilaiTugas, $nilaiUAS, $nilaiUTS) {
        $this->nilaiTugas = $nilaiTugas;
        $this->nilaiUAS = $nilaiUAS;
        $this->nilaiUTS = $nilaiUTS;
    }

    public  function hitungRataRata($nilaiTugas, $nilaiUTS, $nilaiUAS) {
    foreach ([$nilaiTugas, $nilaiUTS, $nilaiUAS] as $nilai) {
        if (!is_numeric($nilai) || $nilai < 0 || $nilai > 100) {
            throw new InvalidArgumentException("Nilai harus angka antara 0 dan 100.");
        }
    }
    $rata_rata = ($nilaiTugas + $nilaiUTS + $nilaiUAS) / 3;
    return $rata_rata;
}

}
class MataKuliah {
    public string $kodeMatkul;
    public string $namaMatkul;
    public int $sks;

    public function __construct($kodeMatkul, $namaMatkul, $sks) {
        $this->kodeMatkul = $kodeMatkul;
        $this->namaMatkul = $namaMatkul;
        $this->sks = $sks;
    }

    public function getInfoMatkul() {
        return "{$this->kodeMatkul} - {$this->namaMatkul} ({$this->sks} SKS)";
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

class ProgramStudi {
    public $idProdi;
    public $namaProdi;
    public $fakultas;

    public function __construct($kdProdi, $namaProdi, $fakultas){
        $this->kdProdi = $kdProdi;
        $this->namaProdi = $namaProdi;
        $this->fakultas = $fakultas;
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

class Mahasiswa {
    public $nim;
    public $namaMahasiswa;
    public $jurusan;
    public $semester;

    public function __construct($nim, $namaMahasiswa, $jurusan, $semester) {
        $this->nim = $nim;
        $this->namaMahasiswa = $namaMahasiswa;
        $this->jurusan = $jurusan;
        $this->semester = $semester;
    }

    public function getInfoMahasiswa() {
        return "{$this->namaMahasiswa} - {$this->nim} - {$this->jurusan} - Semester {$this->semester}";
    }
}
?>


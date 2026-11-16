<?php

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

?>
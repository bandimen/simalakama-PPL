<?php

namespace App\Models;

use App\Models\PembimbingAkademik;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'nim',
        'nama',
        'alamat',
        'angkatan',
        'no_hp',
        'status',
        'foto',
        'pembimbing_akademik_id' // Ubah ini
    ];

    public function pembimbingAkademik()
    {
        return $this->belongsTo(PembimbingAkademik::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function irs()
    {
        return $this->hasMany(Irs::class, 'nim', 'nim');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function khs()
    {
        return $this->hasMany(Khs::class);
    }

    public function getIPK()
    {
        $totalSksXBobot = 0;
        $totalSks = 0;
        
        // Menyimpan bobot terbaik per mata kuliah
        $mataKuliahTerbaik = [];

        foreach ($this->irs as $irs) {
            foreach ($irs->khs->khsDetails as $detail) {
                $sks = $detail->irsDetail->mataKuliah->sks ?? 0;
                $nilai = $detail->nilai;

                // Tentukan bobot berdasarkan nilai
                $bobot = match ($nilai) {
                    'A' => 4,
                    'B' => 3,
                    'C' => 2,
                    'D' => 1,
                    'E' => 0,
                    default => 0,
                };

                // Simpan bobot terbaik per mata kuliah
                $kodeMk = $detail->irsDetail->kodemk;
                if (!isset($mataKuliahTerbaik[$kodeMk]) || $mataKuliahTerbaik[$kodeMk] < $bobot) {
                    $mataKuliahTerbaik[$kodeMk] = $bobot;
                    $totalSks += $sks;
                    $totalSksXBobot += $sks * $bobot;
                }
            }
        }

        return $totalSks > 0 ? number_format($totalSksXBobot / $totalSks, 2) : 'N/A';
    }

    public function getSKSK()
    {
        $totalSks = 0;

        foreach ($this->irs as $irs) {
            foreach ($irs->khs->khsDetails as $detail) {
                $sks =  $detail->irsDetail->status == 'Baru' ? $detail->irsDetail->mataKuliah->sks : 0;
                $totalSks += $sks;
            }
        }

        return $totalSks;
    }

    public function getBobotTerbaik()
    {
        $totalBobot = 0;
        $mataKuliahTerbaik = []; // Menyimpan bobot terbaik per mata kuliah

        foreach ($this->irs as $irs) {
            foreach ($irs->khs->khsDetails as $detail) {
                $nilai = $detail->nilai;
                $sks = $detail->irsDetail->mataKuliah->sks ?? 0;

                // Tentukan bobot berdasarkan nilai
                $bobot = match ($nilai) {
                    'A' => 4,
                    'B' => 3,
                    'C' => 2,
                    'D' => 1,
                    'E' => 0,
                    default => 0,
                };

                // Dapatkan kode mata kuliah untuk memeriksa jika mata kuliah sudah ada
                $kodeMk = $detail->irsDetail->kodemk;

                // Tentukan apakah bobot baru lebih besar dari bobot yang sudah ada
                if (!isset($mataKuliahTerbaik[$kodeMk]) || $mataKuliahTerbaik[$kodeMk] < $bobot) {
                    $mataKuliahTerbaik[$kodeMk] = $bobot * $sks;
                }
            }
        }
        // Menghitung total bobot terbaik
        foreach ($mataKuliahTerbaik as $bobotTerbaik) {
            $totalBobot += $bobotTerbaik;
        }

        return $totalBobot;
    }

    public function getIPSemesterLalu()
    {
        $irsTerakhir = $this->irs()->latest('tahun_ajaran')->latest('jenis_semester')->skip(1)->first();

        if (!$irsTerakhir) {
            return 'N/A'; // Jika IRS tidak ditemukan
        }

        $totalSksXBobot = 0;
        $totalSks = 0;

        foreach ($irsTerakhir->khs->khsDetails as $detail) {
            $sks = $detail->irsDetail->mataKuliah->sks ?? 0;
            $nilai = $detail->nilai;

            // Tentukan bobot berdasarkan nilai
            $bobot = match ($nilai) {
                'A' => 4,
                'B' => 3,
                'C' => 2,
                'D' => 1,
                'E' => 0,
                default => 0,
            };

            $totalSks += $sks;
            $totalSksXBobot += $sks * $bobot;
        }

        return $totalSks > 0 ? number_format($totalSksXBobot / $totalSks, 2) : 'N/A';
    }

    public function getMaxBebanSks()
    {
        // Ambil IP semester lalu
        $ipSemesterLalu = $this->getIPSemesterLalu();

        if ($ipSemesterLalu === 'N/A') {
            return 21; // Default maksimal beban SKS jika tidak ada IP semester lalu
        }

        // Konversi IP menjadi float untuk perbandingan
        $ip = (float) $ipSemesterLalu;

        // Tentukan maksimal beban SKS berdasarkan IP
        if ($ip >= 3.00) {
            return 24;
        } elseif ($ip >= 2.50) {
            return 22;
        } elseif ($ip >= 2.00) {
            return 20;
        } else {
            return 18;
        }
    }
}

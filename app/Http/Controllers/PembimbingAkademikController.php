<?php

namespace App\Http\Controllers;

use App\Models\Khs;
use App\Models\IrsDetail;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PembimbingAkademikController extends Controller
{
    public function index()
    {
        $pa = Auth::user()->pembimbingAkademik;
        $infoPA = $pa->dosen;
        $totalMahasiswaPerwalian = $pa->getTotalMahasiswaPerwalian();
        $totalIrsDisetujui = $pa->getTotalIrsDisetujui();
        $totalIrsBelumDisetujui = $pa->getTotalIrsBelumDisetujui();
        $totalMhsBelumIrs = $pa->getTotalMhsBelumIrs();


        return view(
            'pa.dashboard',
            [
                'title' => 'Dashboard - PA',
                'pa' => $infoPA,
                'totalMahasiswaPerwalian' => $totalMahasiswaPerwalian,
                'totalIrsDisetujui' => $totalIrsDisetujui,
                'totalIrsBelumDisetujui' => $totalIrsBelumDisetujui,
                'totalMhsBelumIrs' => $totalMhsBelumIrs,
            ]
        );
    }
    public function perwalian()
    {
        $irsPeriodsController = new IrsPeriodsController();
        $currentPeriod = $irsPeriodsController->getCurrentPeriod();
        $currentDateTime = now();

        $activePeriodType = null;
        if ($currentDateTime->between($currentPeriod->periode_pengisian_start, $currentPeriod->periode_pengisian_end)) {
            $activePeriodType = 'pengisian';
        } elseif ($currentDateTime->between($currentPeriod->periode_perubahan_start, $currentPeriod->periode_perubahan_end)) {
            $activePeriodType = 'perubahan';
        } elseif ($currentDateTime->between($currentPeriod->periode_pembatalan_start, $currentPeriod->periode_pembatalan_end)) {
            $activePeriodType = 'pembatalan';
        }

        $pa = Auth::user()->pembimbingAkademik;

        $irsController = new IrsController();

        $mhs = $irsController->getAllMhsPerwalianWithIrsCurrentPeriod($pa);
        return view('pa.perwalian', [
            'title' => 'Perwalian - PA', 
            'mhs' => $mhs,
            'activePeriodType' => $activePeriodType,
            'currentPeriod' => $currentPeriod,
        ]);
    }


    public function rekapmhs()
    {
        $pa = Auth::user()->pembimbingAkademik;
        $mhs = $this->getMahasiswaPerwalian($pa->id);

        return view('pa.rekapmhs', ['title' => 'Rekap Mhs - PA', 'mhs' => $mhs->get()]);
    }

    public function getMahasiswaPerwalian($id)
    {
        $mhs = Mahasiswa::with('prodi')
            ->where('pembimbing_akademik_id', $id);
        return $mhs;
    }

    public function showIrsByNim($nim)
    {
        $irsByNim = DB::table('irs')
            ->where('nim', '=', $nim)
            ->get();
        $irsByNim->each(function ($item) {
            $item->irsDetails = IrsDetail::where('irs_id', $item->id)
                ->get()->each(function ($detail) {
                    $detail->dosenPengampuList = $detail->mataKuliah->dosenPengampu;
                });
        });
        $mhsByNim = Mahasiswa::with([
            'prodi',
        ])
            ->where('nim', '=', $nim)
            ->first();
        return view('pa.rekapmhs.irs', [
            'title' => 'IRS Mhs',
            'irs' => $irsByNim,
            'mhs' => $mhsByNim,
        ]);
    }

    public function showKhsByNim($nim)
    {
        $mhs = Mahasiswa::with([
            'irs',
            'irs.irsDetails',
            'irs.irsDetails.mataKuliah',
            'irs.khs',
            'irs.khs.khsDetails.irsDetail',
            'irs.khs.khsDetails.irsDetail.mataKuliah',
            'prodi',
        ])
            ->where('nim', '=', $nim)
            ->first();
        return view('pa.rekapmhs.khs', [
            'title' => 'KHS Mhs',
            'mhs' => $mhs,
        ]);
    }

    public function ajaxTabelPerwalian(Request $request)
    {
        if ($request->ajax()) {

            $pa = Auth::user()->pembimbingAkademik;
            $irsPeriodsController = new IrsPeriodsController();
            $currentPeriod = $irsPeriodsController->getCurrentPeriod();
            $currentDateTime = now();

            $activePeriodType = null;
            if ($currentDateTime->between($currentPeriod->periode_pengisian_start, $currentPeriod->periode_pengisian_end)) {
                $activePeriodType = 'pengisian';
            } elseif ($currentDateTime->between($currentPeriod->periode_perubahan_start, $currentPeriod->periode_perubahan_end)) {
                $activePeriodType = 'perubahan';
            } elseif ($currentDateTime->between($currentPeriod->periode_pembatalan_start, $currentPeriod->periode_pembatalan_end)) {
                $activePeriodType = 'pembatalan';
            }
            $data = Mahasiswa::with(['irs' => function ($query) use ($currentPeriod) {
                $query->where('jenis_semester', $currentPeriod->semester)
                    ->where('tahun_ajaran', $currentPeriod->tahun_ajaran);
            }, 'irs.irsDetails', 'irs.irsDetails.mataKuliah', 'prodi'])
                ->where('pembimbing_akademik_id', '=', $pa->id);

            // search
            if ($request->search) {
                $data->where(function ($query) use ($request) {
                    $query->where('nama', 'like', '%' . $request->search . '%')
                        ->orWhere('nim', 'like', '%' . $request->search . '%');
                });
            }

            // status
            if ($request->status == 'disetujui') {
                $data->whereHas('irs', function ($query) {
                    $query->where('status', '=', 'Disetujui');
                });
            } elseif ($request->status == 'belum_disetujui') {
                $data->whereHas('irs', function ($query) {
                    $query->where('status', '=', 'Belum disetujui');
                });
            } elseif ($request->status == 'belum_mengisi') {
                $data->whereDoesntHave('irs');
            }            

            $data = $data->get();

            return view('pa.perwalian.tabel-perwalian', [
                'data' => $data,
                'activePeriodType' => $activePeriodType,
                'currentPeriod' => $currentPeriod,
            ]);
        }
    }

    public function ajaxTabelRekapMhs(Request $request)
    {
        $pa = Auth::user()->pembimbingAkademik;
        $mhs = $this->getMahasiswaPerwalian($pa->id);

        // Filter pencarian jika ada
        if ($request->search) {
            $mhs = $mhs->where(function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('nim', 'like', '%' . $request->search . '%');
            });
        }

        // Ambil data mahasiswa setelah filter
        $mhs = $mhs->get(); // Eksekusi query

        return view('pa.rekapmhs.tabel-rekapmhs', ['mhs' => $mhs]);
    }



}

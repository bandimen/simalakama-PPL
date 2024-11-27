<?php

namespace App\Http\Controllers;

use App\Models\Khs;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreKhsRequest;
use App\Http\Requests\UpdateKhsRequest;
use App\Models\Mahasiswa;

class KhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKhsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Khs $khs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Khs $khs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKhsRequest $request, Khs $khs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Khs $khs)
    {
        //
    }
    
    public function lihatkhs(Request $request)
    {
        // Ambil data mahasiswa dari user yang login
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Ambil semester dari parameter URL atau gunakan semester terakhir secara default
        $selectedSemester = $request->query('semester', null);

        // Ambil data KHS mahasiswa berdasarkan semester yang dipilih
        $khs = Khs::whereHas('irs', function ($query) use ($mahasiswa, $selectedSemester) {
            $query->where('nim', $mahasiswa->nim);

            // Jika semester dipilih, tambahkan filter semester
            if ($selectedSemester) {
                $query->where('semester', $selectedSemester);
            }
        })
            ->with(['khsDetails.irsDetails.mataKuliah'])
            ->first();

        // Kirim data ke view
        return view('mhs.akademik.lihatkhs', [
            'title' => 'Kartu Hasil Studi',
            'khs' => $khs,
            'khsDetails' => $khs ? $khs->khsDetails : [],
            'mahasiswa' => $mahasiswa,
            'selectedSemester' => $selectedSemester,
        ]);
    }

    
}

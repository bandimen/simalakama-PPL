<?php

namespace App\Http\Controllers;

use App\Models\KhsDetails;
use App\Http\Requests\StoreKhsDetailsRequest;
use App\Http\Requests\UpdateKhsDetailsRequest;

class KhsDetailsController extends Controller
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
    public function store(StoreKhsDetailsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(KhsDetails $khsDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KhsDetails $khsDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKhsDetailsRequest $request, KhsDetails $khsDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KhsDetails $khsDetails)
    {
        //
    }

    public function konfersi($id)
    {
        // Cari data KhsDetail berdasarkan ID
        $khsDetail = KhsDetails::find($id);
    
        if ($khsDetail) {
            // Lakukan konversi nilai
            $nilaiHuruf = $khsDetail->nilai; // Ambil nilai huruf
            $nilaiAngka = $this->konversiNilai($nilaiHuruf); // Konversi ke nilai angka
            
            // Simpan nilai angka jika diperlukan, atau gunakan sesuai kebutuhan
            // Contoh: Menampilkan hasil atau menyimpannya di log
            // $khsDetail->nilai_angka = $nilaiAngka;
            // $khsDetail->save();
    
            return redirect()->back()->with('success', "Nilai $nilaiHuruf dikonversi menjadi $nilaiAngka.");
        }
    
        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }
    
    // Fungsi untuk mengonversi nilai huruf ke angka
    private function konversiNilai($nilaiHuruf)
    {
        $konversi = [
            'A' => 4,
            'B' => 3,
            'C' => 2,
            'D' => 1,
            'E' => 0,
        ];
    
        return $konversi[$nilaiHuruf] ?? null; // Mengembalikan null jika nilai huruf tidak valid
    }
}

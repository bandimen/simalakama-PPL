<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\TenagaPendidik;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTenagaPendidikRequest;
use App\Http\Requests\UpdateTenagaPendidikRequest;

class TenagaPendidikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            // data mahasiswa yg diambil di proses sessionController pas login dibawa ke view
        $user = Auth::user();
        $tenagaPendidik = $user->tenagaPendidik;
        return view('akademik.dashboard', ['title' => 'Dashboard Akademik', 'tenagaPendidik' => $tenagaPendidik]);
    }
    public function tambahruang() {
        $user = Auth::user();
        $tenagaPendidik= $user->tenagaPendidik;
        $prodi = Prodi::all(); // Ambil data prodi
        return view('akademik.tambahruang', ['title' => 'Tambah Ruang', 'tenagaPendidik' => $tenagaPendidik, 'prodi' => $prodi]);
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
    public function store(StoreTenagaPendidikRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TenagaPendidik $tenagaPendidik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TenagaPendidik $tenagaPendidik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTenagaPendidikRequest $request, TenagaPendidik $tenagaPendidik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TenagaPendidik $tenagaPendidik)
    {
        //
    }
}

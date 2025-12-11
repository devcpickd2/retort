<?php

namespace App\Http\Controllers;

use App\Models\Mincing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LookupController extends Controller
{
    public function getBatchByProduk($nama_produk)
    {
        $userPlant  = Auth::user()->plant;
        $batches = Mincing::where('nama_produk', $nama_produk)
            ->where('plant', $userPlant) 
            ->orderBy('id', 'desc')
            ->take(2)
            ->get();

        return response()->json($batches);
    }

    public function getAllBatchByProduk($nama_produk)
    {
        $userPlant  = Auth::user()->plant;
        $batches = Mincing::where('nama_produk', $nama_produk)
            ->where('plant', $userPlant) 
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($batches);
    }
}
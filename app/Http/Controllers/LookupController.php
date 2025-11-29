<?php

namespace App\Http\Controllers;

use App\Models\Mincing;
use Illuminate\Http\Request;

class LookupController extends Controller
{
    public function getBatchByProduk($nama_produk)
    {
        $batches = Mincing::where('nama_produk', $nama_produk)
            ->orderBy('id', 'desc')
            ->take(2)
            ->get();

        return response()->json($batches);
    }
}
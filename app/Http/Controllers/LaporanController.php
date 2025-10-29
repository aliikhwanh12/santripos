<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Sales;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function pembelian()
    {
        $user = Auth::user();
        $sales = Sales::where('CustomerCD', $user->id)
              ->orderBy('DateEncoded', 'desc')
              ->get();        
        return view('laporan.pembelian', compact('sales'));
    }

    public function topup()
    {
        $user = Auth::user();
        $deposit = Deposit::where('cust_ID', $user->id)
              ->orderBy('Dateencoded', 'desc')
              ->get();
        return view('laporan.topup', compact('deposit'));
    }
}

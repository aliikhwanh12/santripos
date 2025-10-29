<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bulanSekarang = Carbon::now()->locale('id')->translatedFormat('F Y');
        // Ambil tanggal awal dan akhir bulan ini
        $tanggal_awal = date('Y-07-01');
        $tanggal_akhir = date('Y-07-d');
        $sales = Sales::where('CustomerCD', $user->id)
              ->orderBy('DateEncoded', 'desc')->limit(5)
              ->get();     
        $deposit = Deposit::where('cust_ID', $user->id)
              ->orderBy('Dateencoded', 'desc')
              ->get();
        // 🔹 1. Ambil saldo terakhir
        $latestDeposit = Deposit::where('cust_ID', $user->id)
            ->orderBy('Dateencoded', 'desc')
            ->first();

        $saldo_akhir = $latestDeposit->Saldo_Akhir ?? 0;
        $topup_terakhir = $latestDeposit->Top_Up ?? 0;
        $tanggal_topup = $latestDeposit->Dateencoded ?? null;

        // 🔹 2. Hitung total pembelian selama bulan ini
        $totalPembelian = Sales::where('CustomerCD', $user->id)
            ->whereBetween('DateEncoded', [$tanggal_awal, $tanggal_akhir])
            ->sum('Subtotal');

        // 🔹 3. Hitung total pengeluaran sejak topup terakhir
        $pengeluaran_sejak_topup = Sales::where('CustomerCD', $user->id)
            ->where('DateEncoded', '>=', $tanggal_topup)
            ->sum('Subtotal');

        $sisa_saldo = $saldo_akhir - $pengeluaran_sejak_topup;

        // 🔹 4. Siapkan data grafik harian (pengeluaran per tanggal bulan ini)
        $data_tanggal = [];
        $data_pengeluaran = [];

        $tanggal = $tanggal_awal;
        while (strtotime($tanggal) <= strtotime($tanggal_akhir)) {
            $data_tanggal[] = (int) substr($tanggal, 8, 2);
            $total_harian = Sales::where('CustomerCD', $user->id)
                ->where('DateEncoded', 'LIKE', "%$tanggal%")
                ->sum('Subtotal');
            $data_pengeluaran[] = $total_harian;
            $tanggal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal)));
        }

        // 🔹 5. Pie chart: bandingkan topup terakhir vs pengeluaran sejak topup
        $data_piechart = [
            (float)$sisa_saldo,
            (float)$pengeluaran_sejak_topup,
        ];

        // 🔹 6. Kirim semua data ke view
        return view('dashboard', compact(
            'sisa_saldo',
            'totalPembelian',
            'data_tanggal',
            'data_pengeluaran',
            'data_piechart',
            'pengeluaran_sejak_topup',
            'bulanSekarang',
            'sales',
            'deposit'
        ));
    }
}

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

        // 🔹 Tanggal awal & akhir bulan ini
        $tanggal_awal = date('Y-m-01');
        $tanggal_akhir = date('Y-m-d');

        // 🔹 Ambil 5 transaksi terakhir
        $sales = Sales::where('CustomerCD', $user->id)
            ->orderBy('DateEncoded', 'desc')
            ->limit(5)
            ->get();

        // 🔹 Ambil semua riwayat deposit user
        $deposit = Deposit::where('cust_ID', $user->id)
            ->orderBy('Dateencoded', 'desc')
            ->get();

        // 🔹 Ambil deposit terakhir (kalau ada)
        $latestDeposit = Deposit::where('cust_ID', $user->id)
            ->orderBy('Dateencoded', 'desc')
            ->first();

        // 🔹 Jika belum pernah top up, set nilai default
        $saldo_akhir = $latestDeposit->Saldo_Akhir ?? 0;
        $topup_terakhir = $latestDeposit->Top_Up ?? 0;
        $tanggal_topup = $latestDeposit->Dateencoded ?? null;

        // 🔹 Hitung total pembelian bulan ini
        $totalPembelian = Sales::where('CustomerCD', $user->id)
            ->whereBetween('DateEncoded', [$tanggal_awal, $tanggal_akhir])
            ->sum('Subtotal');

        // 🔹 Hitung pengeluaran sejak topup terakhir (cek null dulu)
        if ($tanggal_topup) {
            $pengeluaran_sejak_topup = Sales::where('CustomerCD', $user->id)
                ->where('DateEncoded', '>=', $tanggal_topup)
                ->sum('Subtotal');
        } else {
            $pengeluaran_sejak_topup = 0;
        }

        // 🔹 Hitung sisa saldo (kalau belum ada topup, tetap 0)
        $sisa_saldo = max(0, $saldo_akhir - $pengeluaran_sejak_topup);

        // 🔹 Siapkan data grafik harian
        $data_tanggal = [];
        $data_pengeluaran = [];
        $tanggal = $tanggal_awal;

        while (strtotime($tanggal) <= strtotime($tanggal_akhir)) {
            $data_tanggal[] = (int) substr($tanggal, 8, 2);
            $total_harian = Sales::where('CustomerCD', $user->id)
                ->whereDate('DateEncoded', $tanggal)
                ->sum('Subtotal');
            $data_pengeluaran[] = $total_harian;
            $tanggal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal)));
        }

        // 🔹 Pie chart: sisa saldo vs pengeluaran
        $data_piechart = [
            (float) $sisa_saldo,
            (float) $pengeluaran_sejak_topup,
        ];

        // 🔹 Kirim semua data ke view
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

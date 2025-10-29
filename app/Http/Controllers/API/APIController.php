<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class APIController extends Controller
{
    public function deposit(Request $request)
    {
        // ✅ Ambil token dari .env dan bandingkan dengan header
        $token = env('SECRET_TOKEN');
        $authHeader = $request->header('Authorization');

        if ($authHeader !== 'Bearer ' . $token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // ✅ Validasi data input
        $data = $request->input('data');

        if (!$data || !is_array($data)) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        // ✅ Simpan / update data transaksi
        foreach ($data as $trx) {
            Deposit::updateOrCreate(
                [
                    'cust_ID' => $trx['cust_ID'],
                    'Dateencoded' => $trx['Dateencoded'], // kunci unik tambahan
                    'Nama' => $trx['Nama'],
                    'Receiver' => $trx['Receiver'],
                    'Saldo_Awal' => $trx['Saldo_Awal'],
                    'Top_Up' => $trx['Top_Up'],
                    'Saldo_Akhir' => $trx['Saldo_Akhir'],
                ]
            );
        }

        return response()->json(['message' => 'Data transaksi berhasil disimpan']);
    }

    public function user(Request $request)
    {
        // ✅ Ambil token dari .env dan bandingkan dengan header
        $token = env('SECRET_TOKEN');
        $authHeader = $request->header('Authorization');

        if ($authHeader !== 'Bearer ' . $token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // ✅ Validasi data input
        $data = $request->input('data');

        if (!$data || !is_array($data)) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        // ✅ Simpan / update data transaksi
        foreach ($data as $row) {
            User::updateOrCreate(
                ['id' => $row['CustomerCD']],
                [
                    'name' => $row['Description'],
                    'email' => $row['CustomerCD'], // username = CustomerCD
                    'password' => Hash::make($row['CustomerCD']), // password = hash dari CustomerCD
                    'role' => 'anggota'
                ]
            );
        }

        return response()->json(['message' => 'Data transaksi berhasil disimpan']);
    }

        public function sales(Request $request)
    {
        // ✅ Ambil token dari .env dan bandingkan dengan header
        $token = env('SECRET_TOKEN');
        $authHeader = $request->header('Authorization');

        if ($authHeader !== 'Bearer ' . $token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // ✅ Validasi data input
        $data = $request->input('data');

        if (!$data || !is_array($data)) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        // ✅ Simpan / update data transaksi
        foreach ($data as $row) {
            $user = User::where('name', $row['Nama'] ?? '')->first();
            Sales::updateOrCreate(
                ['InvoiceNo' => $row['InvoiceNo']],
                [
                    'Description' => $row['Description'] ?? null,
                    'NetPrice' => $row['NetPrice'] ?? 0,
                    'UnitPrice' => $row['UnitPrice'] ?? 0,
                    'Quantity' => $row['Quantity'] ?? 0,
                    'Subtotal' => $row['Subtotal'] ?? 0,
                    'DateEncoded' => $row['DateEncoded'] ?? null,
                    'EncodedBy' => $row['EncodedBy'] ?? null,
                    // Ganti Nama → CustomerCD dari users
                    'CustomerCD' => $user->id,
                ]
            );
        }

        return response()->json(['message' => 'Data transaksi berhasil disimpan']);
    }
}

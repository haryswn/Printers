<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class TransaksiCon extends Controller
{
    public function index()
    {
        if (Auth::user()->role != 'Guest') {
            $transaksi = DB::table('transaksi')->get();
            return view('transaksi', ['transaksi' => $pembelian]);
        } else {
            $transaksi = DB::table('transaksi')->where('id_transaksi', Auth::user()->id)->get();
            return view('transaksi', ['transaksi' => $transaksi]);
        }
    }

    public function input()
    {
        return view('tambahtransaksi');
    }

    public function storeinput(Request $request)
    {
        // insert data ke table tbpembelian
        DB::table('transaksi')->insert([
            'id_printer' => $request->id_printer,
            'jumlah' => $request->jumlah,
            'harga' => $request-> harga,
            'id_transaksi' => Auth::user()->id,
            'status' => 'verifikasi'
        ]);
        // alihkan halaman ke route pembelian
        Session::flash('message', 'Input Berhasil.');
        return redirect('/transaksi/tampil');
    }

    public function update($id)
    {
        // mengambil data pembelian berdasarkan id yang dipilih
        $pembelian = DB::table('transaksi')->where('id_transaksi', $id)->get();
        // passing data pembelian yang didapat ke view edit.blade.php
        return redirect('/transaksi/tampil');
    }

    public function storeupdate(Request $request)
    {
        // update data pembelian

        DB::table('transaksi')->where('id_transaksi', $request->id_transaksi)->update([
            'status' => $request->status
        ]);

        // alihkan halaman ke halaman pembelian
        return redirect('/transaksi/tampil');
    }

    public function delete($id)
    {
        // mengambil data pembelian berdasarkan id yang dipilih
        DB::table('transaksi')->where('id_transaksi', $id)->delete();
        // passing data pembelian yang didapat ke view edit.blade.php
        return redirect('/transaksi/tampil');
    }
}


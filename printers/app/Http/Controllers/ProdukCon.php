<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class ProdukCon extends Controller
{
    public function home()
    {
        $printer = DB::table('printer')->get();
        return view('utama', ['produk' => $printer]);
    }

    public function index()
    {
        $printer = DB::table('printer')->get();
        return view('produk', ['produk' => $printer]);
    }

    public function input()
    {
        return view('tambahproduk');
    }

    public function storeinput(Request $request)
    {
        // insert data ke table tbproduk
        $file = $request->file('gambar');
        $filename = $request->kode . "." . $file->getClientOriginalExtension();
        $file->move(public_path('assets/img'), $filename);
        DB::table('printer')->insert([
            'id_printer' => $request->id_printer,
            'nama' => $request->nama,
            'spesifikasi' => $request->tipe,
            'harga' => $request->harga,
            'gambar' => $filename
        ]);
        // alihkan halaman ke route produk
        Session::flash('message', 'Input Berhasil.');
        return redirect('/produk/tampil');
    }

    public function update($id)
    {
        // mengambil data produk berdasarkan id yang dipilih
        $produk = DB::table('printer')->where('id_printer', $id)->get();
        // passing data produk yang didapat ke view edit.blade.php
        return redirect('/produk/tampil');
    }

    public function storeupdate(Request $request)
    {
        // update data produk

        DB::table('printer')->where('id_printer', $request->id)->update([
            'nama' => $request->nama,
            'spesifikasi' => $request->spesifikasi,
            'harga' => $request->harga,
            'gambar' => $filename
            
        ]);

        // alihkan halaman ke halaman produk
        return redirect('/produk/tampil');
    }

    public function delete($id)
    {
        // mengambil data produk berdasarkan id yang dipilih
        DB::table('produk')->where('kode', $id)->delete();
        // passing data produk yang didapat ke view edit.blade.php
        return redirect('/produk/tampil');
    }
}

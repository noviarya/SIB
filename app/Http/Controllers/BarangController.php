<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;

date_default_timezone_set('Asia/Jakarta');
class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::join('kategori', "kategori.id", "=", "barang.id_kategori" )
                ->select('barang.*','kategori.nama_kategori')
                ->get();
        $kategori= Kategori::all();

        return view('admin.master.barang.barang', compact('barang','kategori'));
    }
    
    public function store(Request $request)
    {
        Barang::create([
            'id_kategori'      => $request->id_kategori,
            'nama_barang'      => $request->nama_barang,
            'harga'            => $request->harga,
            'stok'             => $request->stok,
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
        ]);

        return redirect('/barang')->width('success', 'Data Berhasil Disimpan');
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);
        
        $barang->id_kategori    = $request->id_kategori;
        $barang->nama_barang    = $request->nama_barang;
        $barang->harga          = $request->harga;
        $barang->stok           = $request->stok;
        $barang->updated_at     = date('Y-m-d H:i:s');
 
        $barang->save();

        return redirect('/barang')->width('success', 'Data Berhasi Diubah');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);
 
        $barang->delete();

        return redirect('/barang')->width('success', 'Data Berhasil Dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\List_;

class HPController extends Controller
{
    public function list()
    {
        $hasil = DB::select('select * from hp');
        return view('list-hp', ['data' => $hasil]);
    }
    
    public function simpan(Request $req)
    {
        DB::insert(
            'insert into hp (merk, tipe, tahun) values (?, ?, ?)',
            [$req->merk, $req->tipe, $req->tahun]
        );
        $hasil = DB::select('select * from hp');
        return view('list-hp', ['data' => $hasil]);
    }
    
    public function hapus($req)
    {
        Log::info('proses hapus dengan id=' . $req);
        DB::delete('delete from hp where id = ?', [$req]);

        $hasil = DB::select('select * from hp');
        return view('list-hp', ['data' => $hasil]);
    }
    
    public function ubah($req)
    {
        $hasil = DB::select('select * from hp where id = ?', [$req]);
        return view('form-ubah', ['data' => $hasil]);
    }
    
    public function rubah(Request $req)
    {
        Log::info('Hallo');
        Log::info($req);
        DB::update(
            'update hp set ' .
                'merk=?, ' .
                'tipe=?, ' .
                'tahun=? where id=? ',
            [
                $req->merk,
                $req->tipe,
                $req->tahun,
                $req->id
            ]
        );
        $hasil = DB::select('select * from hp');
        return view('list-hp', ['data' => $hasil]);
    }
}

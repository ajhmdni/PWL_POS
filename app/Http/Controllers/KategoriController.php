<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\KategoriDataTable;
use App\Http\Requests\StorePostRequest;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable) 
    {
         return $dataTable->render('kategori.index');
    }

    public function create() 
    {
        return view('kategori.create');
    }

    public function store(StorePostRequest $request): RedirectResponse
    { 
$validated = $request->validated();

$returnedOnly = $request->safe()->only(['kodeKategori', 'namaKategori']);
$returnedExcept = $request->safe()->except(['kodeKategori', 'namaKategori']);
dd($returnedOnly, $returnedExcept);
        
        if ($validated) {
            KategoriModel::create([
                'kategori_kode' => $request->kodeKategori,
                'kategori_nama' => $request->namaKategori
            ]);
        }

        return redirect('/kategori');
    }

    public function edit($id) 
    {
        $kategori = KategoriModel::find($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update($id, Request $request)
    {
        $kategori = KategoriModel::find($id);

        $kategori->kategori_kode = $request->kodeKategori;
        $kategori->kategori_nama = $request->namaKategori;

        $kategori->save();

        return redirect('/kategori');
    }

    public function delete($id)
    {
        $kategori = KategoriModel::find($id);

        $kategori->delete();

        return redirect('/kategori');
    }
}

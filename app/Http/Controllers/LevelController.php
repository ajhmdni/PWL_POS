<?php

namespace App\Http\Controllers;

use App\DataTables\LevelDataTable;
use App\Http\Requests\StoreLevelRequest;
use App\Models\LevelModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index(LevelDataTable $dataTable) {
        /*
         | INSERT DATA
         | 
         | DB::insert(
         |   "INSERT INTO m_level(level_kode, level_nama, created_at) VALUES (?, ?, ?)",
         |   ['CUS', 'Pelanggan', now()]
         | );
         */
        
         /*
         | UPDATE DATA
         | 
         | $row = DB::update(
         |  "UPDATE m_level SET level_nama = ? WHERE level_kode = ?",
         |  ['Customer', 'CUS'],
         | );
         */

        /*
         | DELETE DATA
         | 
         | $row = DB::update("DELETE FROM m_level WHERE level_kode = ?", ['CUS']);
         | return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row . ' baris';
         */

        return $dataTable->render('level.index');
    }

    public function create() 
    {
        return view('level.create');
    }

    public function store(StoreLevelRequest $request): RedirectResponse
    {
        $validated_level = $request->validated();

        LevelModel::create([
            'level_kode' => $validated_level['kodeLevel'],
            'level_nama' => $validated_level['namaLevel'],
        ]);

        return redirect('/level');
    }
}

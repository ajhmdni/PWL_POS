<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar Penjualan yang terjadi pada sistem'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'activeMenu' => $activeMenu
        ]);
    }

    public function list()
    {
        $sales = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')
            ->with('user')->get();


        return DataTables::of($sales)
            ->addIndexColumn()
            ->addColumn('aksi', function ($sale) {
                $btn = '<a href="'.url('/penjualan/' . $sale->penjualan_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/penjualan/' . $sale->penjualan_id . '/edit').'"class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.
                url('/penjualan/'.$sale->penjualan_id).'">' . csrf_field() . method_field('DELETE') .
                    '<button 
                        type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus
                    </button>
                </form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $users = UserModel::all();
        $products = BarangModel::all();

        $breadcrumb = (object) [
            'title' => 'Tambah Penjualan',
            'list' => ['Home', 'Penjualan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Data Penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.create', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'users' => $users,
            'products' => $products,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:m_user,user_id',
            'pembeli' => 'required|string|max:50',
            'penjualan_kode' => 'required|string|max:20|unique:t_penjualan,penjualan_kode',
            'penjualan_tanggal' => 'required|date',
            'barang_id.*' => 'required|integer|exists:m_barang,barang_id',
            'harga.*' => 'required|integer',
            'jumlah.*' => 'required|integer'
        ]);

        $penjualan = PenjualanModel::make([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_kode' => $request->penjualan_kode,
            'penjualan_tanggal' => $request->penjualan_tanggal,
        ]);

        $penjualan->save();

        if ($request->barang_id) {
            for($i = 0; $i < count($request->barang_id); $i++) {
                PenjualanDetailModel::create([
                    'penjualan_id' => $penjualan->penjualan_id,
                    'barang_id' => $request->barang_id[$i],
                    'harga' => $request->harga[$i],
                    'jumlah' => $request->jumlah[$i]
                ]);
            }
        }

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil ditambah');
    }

    public function show(string $id)
    {
        $penjualan = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')
            ->with('user')
            ->with('penjualan_detail')
            ->find($id);

        $penjualan_detail = function () use ($penjualan) {
            $indexs = [];
            foreach ($penjualan->penjualan_detail as $sale) {
                $indexs[] = $sale->detail_id;
            }

            return PenjualanDetailModel::with('barang')->findMany($indexs);
        };

        $breadcrumb = (object) [
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.show', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'penjualan' => $penjualan,
            'penjualan_details' => $penjualan_detail(),
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit(string $id)
    {
        $penjualan = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')
            ->with('user')
            ->with('penjualan_detail')
            ->find($id);

        $penjualan_detail = function () use ($penjualan) {
            $indexs = [];
            foreach ($penjualan->penjualan_detail as $sale) {
                $indexs[] = $sale->detail_id;
            }

            return PenjualanDetailModel::with('barang')->findMany($indexs);
        };

        $users = UserModel::all();
        $products = BarangModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Penjualan',
            'list' => ['Home', 'Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.edit', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'users' => $users,
            'products' => $products,
            'penjualan' => $penjualan,
            'penjualan_details' => $penjualan_detail(),
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:m_user,user_id',
            'pembeli' => 'required|string|max:50',
            'penjualan_kode' => 'required|string|max:20|unique:t_penjualan,penjualan_kode,' . $id . ',penjualan_id',
            'penjualan_tanggal' => 'required|date',
            'detail_id.*' => 'required|integer|exists:t_penjualan_detail,detail_id',
            'barang_id.*' => 'required|integer|exists:m_barang,barang_id',
            'harga.*' => 'required|integer',
            'jumlah.*' => 'required|integer'
        ]);

        PenjualanModel::find($id)->update([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_kode' => $request->penjualan_kode,
            'penjualan_tanggal' => $request->penjualan_tanggal,
        ]);

        if ($request->detail_id) {
            for ($i = 0; $i < count($request->detail_id); $i++) {
                PenjualanDetailModel::find($request->detail_id[$i])
                    ->update([
                        'barang_id' => $request->barang_id[$i],
                        'harga' => $request->harga[$i],
                        'jumlah' => $request->jumlah[$i]
                    ]);
            }
        }

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil diubah');
    }

    public function destroy(string $id)
    {
        $penjualan = PenjualanModel::find($id);

        if (!$penjualan) {
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }
        
        try {
            PenjualanModel::destroy($id);

            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/penjualan')->with('error', 'Data penjualan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}

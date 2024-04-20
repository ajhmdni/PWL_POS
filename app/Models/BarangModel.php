<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'm_barang';
    protected $primaryKey = 'barang_id';

    protected $fillable = [
        'barang_kode',
        'kategori_id',
        'barang_nama',
        'harga_beli',
        'harga_jual'
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }

    public function stok(): BelongsTo
    {
        return $this->belongsTo(StokModel::class, 'stok_id', 'stok_id');
    }

    public function penjualan_detail(): BelongsToMany
    {
        return $this->belongsToMany(PenjualanDetailModel::class, 'barang_id', 'barang_id');
    }
}

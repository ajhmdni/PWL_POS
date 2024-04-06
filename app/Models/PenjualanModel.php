<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PenjualanModel extends Model
{
    use HasFactory;

    protected $primaryKey = 'penjualan_id';
    protected $table = 't_penjualan';
    protected $fillable = [
        'user_id',
        'pembeli',
        'penjualan_kode',
        'penjualan_tanggal',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(UserModel::class, 'user_id', 'user_id');
    }

    public function penjualan_detail(): HasMany
    {
        return $this->hasMany(PenjualanDetailModel::class, 'penjualan_id', 'penjualan_id');
    }
}

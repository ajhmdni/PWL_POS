<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserModel extends Authenticable implements JWTSubject
{
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'username',
        'nama',
        'password',
        'level_id',
    ];

    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier(): string
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function level(): BelongsTo {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    public function stok(): BelongsTo
    {
        return $this->belongsTo(StokModel::class, 'stok_id', 'stok_id');
    }

    public function penjualan(): BelongsTo
    {
        return $this->belongsTo(PenjualanModel::class, 'user_id', 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPermintaan extends Model
{
    protected $table = 'detail_permintaans';
    protected $guarded = ['id'];

    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class);
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}

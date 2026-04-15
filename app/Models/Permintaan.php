<?php

namespace App\Models;

use App\Models\DetailPermintaan;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    protected $table = 'permintaans';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function details()
    {
        return $this->hasMany(DetailPermintaan::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}

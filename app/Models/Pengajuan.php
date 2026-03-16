<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_nasabah',
        'tipe_pengajuan',
        'nominal_pengajuan',
        'tenor',
        'pendapatan_bulanan',
        'catatan',
        'status',
    ];

    public function getTagihanPerBulanAttribute()
    {
        // Simple calculation: total nominal / tenor
        if ($this->tenor > 0) {
            return $this->nominal_pengajuan / $this->tenor;
        }
        return 0;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Project extends Model
{
    use HasFactory;
    use LogsActivity;

    protected static $logName = 'Project';
    protected static $logAttributes = ['nama_project','estimasi_rab','mitra_id','tikor_lop','lokasi_lop','keterangan'];
    // protected static $logOnlyDirty = true;

    protected $table    = 'tb_project';
    protected $fillable = [
        'permintaan_id',
        'tematik_id',
        'sto_id',
        'mitra_id',
        'progress_id',
        'nama_project',
        'estimasi_rab',
        'tikor_lop',
        'lokasi_lop',
        'keterangan',
        'add_by',
        'edit_by',
        'status',
    ];

    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class);
    }

    public function sto()
    {
        return $this->belongsTo(Sto::class);
    }

}

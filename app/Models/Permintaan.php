<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Permintaan extends Model
{
    use HasFactory, LogsActivity;

    protected static $logName = 'Permintaan';
    protected static $logAttributes = ['nama_permintaan','pic_permintaan','keterangan','reff_permintaan'];
    protected static $logOnlyDirty = true;

    protected $table    = 'tb_permintaan';
    protected $fillable = [
        'tematik_id',
        'tanggal_permintaan',
        'reff_permintaan',
        'nama_permintaan',
        'pic_permintaan',
        'keterangan',
        'add_by',
        'edit_by',
        'status',
        'status_nodin'
    ];

    public function tematik()
    {
        return $this->belongsTo(Tematik::class);
    }

    public function project()
    {
        return $this->hasMany(Project::class, Permintaan::class);
    }
}

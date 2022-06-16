<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Sto extends Model
{
    use HasFactory;
    use LogsActivity;

    protected static $logName = 'STO';
    protected static $logAttributes = ['kode_sto','nama_sto'];
    protected static $logOnlyDirty = true;

    protected $table = 'tb_sto';

    protected $fillable = ['kode_sto', 'nama_sto'];

    public function project()
    {
        return $this->hasMany(Project::class, Sto::class);
    }
}

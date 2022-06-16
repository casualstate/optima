<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Rab extends Model
{
    use LogsActivity;

    protected static $logName = 'RAB';
    protected static $logAttributes = ['biaya'];
    protected static $logOnlyDirty = true;

    protected $table    = 'tb_rab';
    protected $fillable = [
        'project_id',
        'biaya',
        'document',
        'dt_target',
        'add_by',
        'edit_by',
        'status',
        'keterangan',
    ];

}

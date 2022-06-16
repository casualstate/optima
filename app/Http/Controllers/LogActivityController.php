<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogActivityController extends Controller
{
    //
    public function logActivity()
    {
        # code...
        $activity = Activity::orderBy('id','DESC')->paginate(10);
        return view('activity.index')->withActivity($activity);
    }
}

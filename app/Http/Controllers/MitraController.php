<?php

namespace App\Http\Controllers;

use App\Models\Rab;
use App\Models\Project;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class MitraController extends Controller
{
    public function pageMitra()
    {
        // $permintaan = Permintaan::where('id', $request->id_permintaan)->first();

        $lop = Project::where('mitra_id', Auth::id())->get();
        $progress = DB::table('tb_progress')->get();

        return view('mitra.page_mitra', compact('lop', 'progress'));
    }

    public function updateProgress(Request $request)
    {
        $statusLop = ($request->progress_id == 4 ? 'Selesai' : 'Dikerjakan');
        $project = Project::where('id', $request->id_project)->update([
            // 'permintaan_id' => $request->permintaan_id,
            // 'tematik_id' => $request->tematik_lop,
            // 'sto_id' => $request->sto_id,
            // 'nama_project' => $request->nama_project,
            // 'estimasi_rab' => $request->estimasi_rab,
            // 'tikor_lop' => $request->tikor_lop,
            // 'lokasi_lop' => $request->lokasi_lop,
            // 'keterangan' => $request->keterangan,
            'progress_id' => $request->progress_id,
            'edit_by' => Auth::id(),
            'status' => $statusLop, // Belum Diserahkan, Dikerjakan, Selesai
        ]);

        $permintaan = Permintaan::where('id', $request->id_permintaan)->update([
            'edit_by' => Auth::id(),
            'status' => $statusLop, // Order, In Progress, Selesai
        ]);

        $proj = Project::where('id', $request->id_project)->first();

        $activity = Activity::create([
            'log_name' => 'Project',
            'description' => 'update progress',
            'causer_id' => Auth::id(),
            'properties' => array (
                'attributes' =>
                array (
                  'nama_project' => $proj->nama_project
                )
              ),

        ]);

        return redirect('/mitra')->with('success', 'Progress berhasil diupdate');
    }
}

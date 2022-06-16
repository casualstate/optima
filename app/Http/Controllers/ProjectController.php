<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rab;
use App\Models\Sto;
use App\Models\User;
use App\Models\Project;
use App\Models\Tematik;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class ProjectController extends Controller
{
    public function inputProject()
    {
        $permintaan = Permintaan::get();
        $tematik = Tematik::all();
        $sto = Sto::get();

        $lop = Project::with(['permintaan'])->get();

        $progress = DB::table('tb_progress')->get();

        $mitra = User::whereHas(
            'roles', function($q){
                $q->where('name', 'Mitra');
            }
        )->get();

        return view('project.form_project', compact('permintaan', 'sto', 'tematik', 'lop', 'mitra', 'progress'));
    }

    public function simpanProject(Request $request)
    {
        $project = Project::create([
            'permintaan_id' => $request->permintaan_id,
            'tematik_id' => $request->tematik_lop,
            'sto_id' => $request->sto_id,
            'nama_project' => $request->nama_project,
            'estimasi_rab' => $request->estimasi_rab,
            'tikor_lop' => $request->tikor_lop,
            'lokasi_lop' => $request->lokasi_lop,
            'keterangan' => $request->keterangan,
            'add_by' => Auth::id(),
            'edit_by' => Auth::id(),
            'status' => 'Belum Diserahkan', // Belum Diserahkan, Dikerjakan, Selesai
        ]);

        return redirect('/project')->with('success', 'Project berhasil disimpan');
    }

    public function updateProject(Request $request)
    {
        $project = Project::where('id', $request->id_project)->update([
            // 'permintaan_id' => $request->permintaan_id,
            // 'tematik_id' => $request->tematik_lop,
            // 'sto_id' => $request->sto_id,
            // 'nama_project' => $request->nama_project,
            // 'estimasi_rab' => $request->estimasi_rab,
            // 'tikor_lop' => $request->tikor_lop,
            // 'lokasi_lop' => $request->lokasi_lop,
            // 'keterangan' => $request->keterangan,
            'mitra_id' => $request->mitra_id,
            'add_by' => Auth::id(),
            'edit_by' => Auth::id(),
            'status' => 'Diserahkan', // Belum Diserahkan, Dikerjakan, Selesai
        ]);

        $proj = Project::where('id', $request->id_project)->first();
        $mitra = User::whereHas(
            'roles', function($q){
                $q->where('name', 'Mitra');
            }
        )->where('id',$request->mitra_id)->first();

        $activity = Activity::create([
            'log_name' => 'Project',
            'description' => 'allocate',
            'causer_id' => Auth::id(),
            'properties' => array (
                'attributes' =>
                array (
                  'nama_project' => $proj->nama_project,
                  'nama_mitra' => $mitra->name,
                )
              ),

        ]);

        return redirect('/project')->with('success', 'Project berhasil diupdate');
    }

    public function getProject(Request $request)
    {
        $data = Project::with('permintaan', 'sto')->where('id', $request->id_project)->first();

        return response()->json(['project' => $data, 'permintaan' => $data->permintaan, 'sto' => $data->sto], 200);
    }

    public function simpanRab(Request $request)
    {
        $rab = Rab::create([
            'project_id' => $request->id_project,
            'biaya' => $request->rab_ondesk,
            'dt_target' => Carbon::now()->format('Y-m-d'),
            'add_by' => Auth::id(),
            'edit_by' => Auth::id(),
            'status' => 'RAB OnDesk', // Belum Diserahkan, Dikerjakan, Selesai
            'keterangan' => $request->ket_1,
        ]);

        $permintaan = Project::where('id', $request->id_project)->first();

        $project = Project::where('id', $request->id_project)->update([
            'status' => 'Dikerjakan', // Belum Diserahkan, Dikerjakan, Selesai
        ]);

        $permintaan = Permintaan::where('id', $permintaan->permintaan_id)->update([
            'status' => 'In Progress', // Order, In Progress, Close
        ]);

        return redirect('/project')->with('success', 'RAB Berhasil Diinput');
    }

    public function getRab(Request $request)
    {
        $rab = Rab::where('id', $request->id_rab)->first();

        return response()->json(['rab' => $rab], 200);
    }

}

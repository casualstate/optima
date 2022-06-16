<?php

namespace App\Http\Controllers;

use App\Models\Rab;
use App\Models\User;
use App\Models\Project;
use App\Models\Tematik;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
{
    public function pagePermintaan()
    {
        $permintaan = Permintaan::with(['tematik'])->paginate(10);
        $lop = Project::with(['permintaan'])->get();

        return view('permintaan.page_permintaan', compact('permintaan', 'lop'));
    }

    public function inputPermintaan()
    {
        $tematik = Tematik::all();

        return view('permintaan.form_permintaan', compact('tematik'));
    }

    public function simpanPermintaan(Request $request)
    {
        // dd($request->all());
        // $validatedData = $request->validate([
        //     'name' => 'required|max:255',
        //     'price' => 'required',
        // ]);

        $permintaan = Permintaan::create([
            'tanggal_permintaan' => $request->tgl_perm,
            'tematik_id' => $request->tematik_perm,
            'reff_permintaan' => $request->reff_perm,
            'nama_permintaan' => $request->nama_perm,
            'pic_permintaan' => $request->pic_perm,
            'keterangan' => $request->ket,
            'add_by' => Auth::id(), // diisi setelah ada role
            'edit_by' => Auth::id(), // diisi setelah ada role
            'status' => 'Order', // Order, Inprogress, Close
            'status_nodin' => $request->nodin, // Nodin, Non-Nodin
        ]);

        return redirect('/')->with('success', 'Permintaan berhasil disimpan');
    }

    public function getDataPermintaan(Request $request)
    {
        $permintaan = Permintaan::where('id', $request->id_permintaan)->first();

        $lop = Project::where('permintaan_id', $request->id_permintaan)->get();

        $component_lop = '';

        if (count($lop) > 0) {
            foreach ($lop as $key => $value) {
                $rab = Rab::where('project_id', $value->id)->first();

                $component_lop .= '<div class="card shadow-none bg-transparent border border-info mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">'.$value->nama_project.'</h5>
                                    <p class="card-text">
                                        Status LOP : '.$value->status.'<br>
                                        Status RAB : '.($rab == null ? '<i>Belum Diinput</i>' : $rab->status).'
                                    </p>
                                    <div class="demo-inline mb-3">
                                        '.($value->mitra_id == 0 ? '<button type="button" data-id="'.$value->id.'" class="btn btn-sm btn-outline-info mt-1 update" data-bs-toggle="modal" data-bs-target=".updateModal">
                                        <i class="bx bx-edit"></i>&nbsp; Update
                                    </button>' : '').'

                                        '.($rab == null ? '<button type="button" data-id="'.$value->id.'" class="btn btn-sm btn-outline-success mt-1 rab" data-bs-toggle="modal" data-bs-target=".rabModal">
                                        <i class="bx bx-dollar-circle"></i>&nbsp; Rab
                                        </button>' : '<button type="button" data-id="'.$rab->id.'" class="btn btn-sm btn-outline-success mt-1 btnRab" data-bs-toggle="modal" data-bs-target=".rabDetailModal">
                                        <i class="bx bx-dollar-circle"></i>&nbsp; Rab
                                        </button>   ').'
                                        <button type="button" data-id="'.$value->id.'" class="btn btn-sm btn-outline-danger mt-1 btnProgress" data-bs-toggle="modal" data-bs-target=".progressModal">
                                            <i class="bx bx-timer"></i>&nbsp; Progress
                                        </button>
                                        <button type="button" data-id="'.$value->id.'" class="btn btn-sm btn-outline-info mt-1 btnDetail" data-bs-toggle="modal" data-bs-target=".detailModal">
                                            <i class="bx bx-dots-vertical"></i>&nbsp; Detail
                                        </button>
                                    </div>
                                    <h6 style="margin-bottom: 0;">'.$value->created_at.'</h6>
                                </div>
                            </div>';
            }
        } else {
            $component_lop .= '<div>Project LOP belum di input !</div>';
        }

        return response()->json(['permintaan' => $permintaan, 'component_lop' => $component_lop], 200);
    }

    public function detailPermintaan(Request $request)
    {
        $permintaan = Permintaan::where('id', $request->id_permintaan)->with('tematik')->first();
        return response()->json(['permintaan' => $permintaan], 200);
    }
}

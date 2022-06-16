@extends('layouts.master_mitra')
@section('title', 'Mitra')

@section('content')

<style>
    ul.timeline {
        list-style-type: none;
        position: relative;
    }
    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }
    ul.timeline > li {
        margin: 20px 0;
        padding-left: 20px;
    }
    ul.timeline > li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #d4d9df;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }
    ul.timeline > li.active:before {
        border: 3px solid #e6381a;
    }
</style>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header">
                List Of Project (LOP)
            </h5>
        </div>
        <div class="card-body">
            @if(session()->get('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (count($lop) > 0)
                @foreach ($lop as $value)
                    @php
                        $rab = App\Models\Rab::where('project_id', $value->id)->first();
                        $permintaan = App\Models\Permintaan::where('id', $value->permintaan_id)->first();
                    @endphp

                    <div class="card shadow-none bg-transparent border border-info mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $value->nama_project }}</h5>
                                    <p class="card-text">
                                        Status LOP : {{ $value->status }}<br>
                                        Status RAB : {{ ($rab == null ? 'Belum Diinput' : $rab->status) }}
                                    </p>
                                    <h6 style="margin-bottom: 0;">{{ $value->created_at }}</h6>
                                </div>
                                <div class="col-md-4">
                                    <div class="demo-inline mb-3">
                                        <button type="button" data-id="{{ $value->id }}" data-permintaan="{{ $value->permintaan_id }}" class="btn btn-sm btn-outline-info update" data-bs-toggle="modal" data-bs-target=".updateModal">
                                            <i class="bx bx-edit"></i>&nbsp; Update
                                        </button>
                                        <button type="button" data-id="{{ $rab->id }}" class="btn btn-sm btn-outline-success btnRab" data-bs-toggle="modal" data-bs-target=".rabModal">
                                            <i class="bx bx-dollar-circle"></i>&nbsp; RAB
                                        </button>
                                        <button type="button" data-id="{{ $value->id }}" class="btn btn-sm btn-outline-danger btnProgress" data-bs-toggle="modal" data-bs-target=".progressModal">
                                            <i class="bx bx-timer"></i>&nbsp; Progress
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div>Project LOP belum di alokasikan !</div>
            @endif
        </div>
    </div>

    <div class="modal fade updateModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('update_progress') }}" method="POST">
                @csrf
                <input type="hidden" name="id_project" id="id_project">
                <input type="hidden" name="id_permintaan" id="id_permintaan">
                <div class="modal-header">
                    <h5 class="modal-title">Update Progress LOP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Pilih Progress</label>
                            <select name="progress_id" class="form-select" id="progress_id">
                                <option value="" selected disabled>Pilih Progress</option>
                                @foreach ($progress as $item)
                                    <option value="{{ $item->id }}">{{ $item->level }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade progressModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" action="" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Progress LOP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="timeline">
                                @foreach ($progress as $item)
                                    <li id="level_{{ $item->id }}">
                                        <p>{{ $item->level }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary close-progress" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade rabModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form class="modal-content">
                @csrf
                <input type="hidden" name="id_rab" id="id_rab">
                <div class="modal-header">
                    <h5 class="modal-title">Detail RAB</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">Biaya</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="biaya" id="biaya" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">Status</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="status" id="status" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">Keterangan</label>
                        <div class="col-md-9">
                            <textarea class="form-control" rows="3" name="keterangan" id="keterangan" disabled></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function () {

            $(document).on('click', 'button.update', function () {
                $('#id_project').val($(this).attr('data-id'));
                $('#id_permintaan').val($(this).attr('data-permintaan'));
            });

            $(document).on('click', 'button.close-progress', function () {

                $("#level_1").removeClass('active');
                $("#level_2").removeClass('active');
                $("#level_3").removeClass('active');
                $("#level_4").removeClass('active');

            });

            $(document).on('click', 'button.btnProgress', function () {

                var project_id = $(this).attr('data-id');

                $('#id_project_2').val(project_id);

                axios.get('http://localhost:8001/get-project', {
                        params: {
                            id_project: project_id
                        }
                    })
                    .then(function (response) {
                        console.log(response.data)
                        if (response.data.project.progress_id == 1) {
                        $("#level_1").addClass('active');
                        }
                        if (response.data.project.progress_id == 2) {
                            $("#level_1").addClass('active');
                            $("#level_2").addClass('active');
                        }
                        if (response.data.project.progress_id == 3) {
                            $("#level_1").addClass('active');
                            $("#level_2").addClass('active');
                            $("#level_3").addClass('active');
                        }
                        if (response.data.project.progress_id == 4) {
                            $("#level_1").addClass('active');
                            $("#level_2").addClass('active');
                            $("#level_3").addClass('active');
                            $("#level_4").addClass('active');
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });

            });

            $(document).on('click', 'button.btnRab', function () {

            var rab_id = $(this).attr('data-id');

            $('#id_rab').val(rab_id);

            axios.get('http://localhost:8001/get-rab', {
                    params: {
                        id_rab: rab_id
                    }
                })
                .then(function (response) {
                    console.log(response.data);
                    document.getElementById('biaya').value = response.data.rab.biaya;
                    document.getElementById('status').value = response.data.rab.status;
                    document.getElementById('keterangan').value = response.data.rab.keterangan;

                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });

            });

        });
    </script>

@endsection



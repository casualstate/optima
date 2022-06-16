@extends('layouts.master')
@section('title', 'Project')
@section('project_active', 'active')

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

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <h5 class="card-header">Input Project (LOP)</h5>
                <div class="card-body">
                    @if(session()->get('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session()->get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('simpan_project') }}" method="post">
                        @csrf
                        <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-3 col-form-label">Nama Permintaan</label>
                            <div class="col-md-9">
                                <select name="permintaan_id" class="form-select" id="permintaan_id">
                                    <option value="" selected disabled>Pilih Permintaan</option>
                                    @foreach ($permintaan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_permintaan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="html5-date-input" class="col-md-3 col-form-label">Tanggal Permintaan</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="tanggal_permintaan" id="tanggal_permintaan" value="0000-00-00" readonly>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-3 col-form-label">Nama Project (LOP)</label>
                            <div class="col-md-9">
                              <input class="form-control" type="text" name="nama_project" placeholder="Nama Project">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-3 col-form-label">Tematik LOP</label>
                            <div class="col-md-9">
                                <select name="tematik_lop" class="form-select">
                                    <option selected disabled>Pilih Tematik LOP</option>
                                    @foreach ($tematik as $item)
                                        <option value="{{ $item->id }}">{{ $item->tematik }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-3 col-form-label">Estimasi RAB</label>
                            <div class="col-md-9">
                                <select name="estimasi_rab" class="form-select">
                                    <option selected disabled>Pilih Estimasi RAB</option>
                                    <option value="< 20 Jt">< 20 Jt</option>
                                    <option value="> 20 Jt">> 20 Jt</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-3 col-form-label">STO</label>
                            <div class="col-md-9">
                                <select name="sto_id" class="form-select">
                                    <option selected disabled>Pilih STO</option>
                                    @foreach ($sto as $item)
                                        <option value="{{ $item->id }}">{{ $item->kode_sto }} - {{ $item->nama_sto }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-3 col-form-label">Tikor LOP</label>
                            <div class="col-md-9">
                              <input class="form-control" type="text" name="tikor_lop" placeholder="Lat Long">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-3 col-form-label">Lokasi LOP</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="lokasi_lop" rows="3" placeholder="Deskripsi Lokasi LOP"></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-3 col-form-label">Keterangan</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="keterangan" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-3 col-form-label"></label>
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('page_permintaan') }}" class="btn btn-danger">Kembali</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <h5 class="card-header">List Of Project (LOP)</h5>
                <div class="card-body">

                    <div id="component_lop">

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade updateModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('update_project') }}" method="POST">
                @csrf
                <input type="hidden" name="id_project" id="id_project_1">
                <div class="modal-header">
                    <h5 class="modal-title">Update LOP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">Pilih Mitra</label>
                            <select name="mitra_id" class="form-select" id="permintaan_id">
                                <option value="" selected disabled>Pilih Mitra</option>
                                @foreach ($mitra as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
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

    <div class="modal fade rabModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form class="modal-content" action="{{ route('simpan_rab') }}" method="POST">
                @csrf
                <input type="hidden" name="id_project" id="id_project_2">
                <div class="modal-header">
                    <h5 class="modal-title">Input RAB</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">Tanggal Permintaan</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="tanggal_permintaan" id="tanggal_permintaan_1" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">Nama Permintaan</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="nama_permintaan" id="nama_permintaan_1" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">Nama Project</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="nama_project" id="nama_project_1" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">STO</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="sto" id="sto" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">Tikor LOP</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="tikor_lop" id="tikor_lop_1" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">Lokasi LOP</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="lokasi_lop_1" id="lokasi_lop_1" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">RAB Ondesk (Rp)</label>
                        <div class="col-md-9">
                            <input class="form-control" type="number" name="rab_ondesk" placeholder="2.000.000" id="rab_ondesk">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-text-input" class="col-md-3 col-form-label">Keterangan</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="ket_1" rows="3"></textarea>
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

    <div class="modal fade detailModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form class="modal-content">
                @csrf
                <input type="hidden" name="id_project" id="id_project">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">Nama Project</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="nama_project" id="nama_project" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">Estimasi RAB</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="estimasi_rab" id="estimasi_rab" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">TIKOR LOP</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="tikor_lop" id="tikor_lop" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">Lokasi LOP</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="lokasi_lop" id="lokasi_lop" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">Keterangan</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="keterangan" id="keterangan" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">Status</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="status" id="status" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">STO</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="nama_sto" id="nama_sto" disabled>
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

        $(document).ready(function(){

            var permintaan = document.getElementById('permintaan_id');
            var updateButton = document.getElementById('button');

            if (permintaan.value === '') {
                document.getElementById('component_lop').innerHTML = `<div class="text-left">Melihat LOP pilih permintaan terlebih dahulu !</div>`;
            }

            permintaan.addEventListener('change', () => {

                axios.get('http://localhost:8001/get-permintaan', {
                        params: {
                            id_permintaan: permintaan.value
                        }
                    })
                    .then(function (response) {
                        document.getElementById('tanggal_permintaan').value = response.data.permintaan.tanggal_permintaan;
                        document.getElementById('component_lop').innerHTML = response.data.component_lop;

                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });

            });

            $(document).on('click', 'button.update', function () {

                $('#id_project_1').val($(this).attr('data-id'));

            });

            $(document).on('click', 'button.rab', function () {

                var project_id = $(this).attr('data-id');

                $('#id_project_2').val(project_id);

                axios.get('http://localhost:8001/get-project', {
                        params: {
                            id_project: project_id
                        }
                    })
                    .then(function (response) {
                        console.log(response.data);
                        document.getElementById('tanggal_permintaan_1').value = response.data.permintaan.tanggal_permintaan;
                        document.getElementById('nama_permintaan_1').value = response.data.permintaan.nama_permintaan;
                        document.getElementById('nama_project_1').value = response.data.project.nama_project;
                        document.getElementById('sto').value = response.data.sto.nama_sto;
                        document.getElementById('tikor_lop_1').value = response.data.project.tikor_lop;
                        document.getElementById('lokasi_lop_1').value = response.data.project.lokasi_lop;

                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });

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

            $(document).on('click', 'button.btnDetail', function () {

                var project_id = $(this).attr('data-id');

                $('#id_project').val(project_id);

                axios.get('http://localhost:8001/get-project', {
                        params: {
                            id_project: project_id
                        }
                    })
                    .then(function (response) {
                        console.log(response.data);
                        document.getElementById('nama_project').value = response.data.project.nama_project;
                        document.getElementById('estimasi_rab').value = response.data.project.estimasi_rab;
                        document.getElementById('tikor_lop').value = response.data.project.tikor_lop;
                        document.getElementById('lokasi_lop').value = response.data.project.lokasi_lop;
                        document.getElementById('keterangan').value = response.data.project.keterangan;
                        document.getElementById('status').value = response.data.project.status;
                        document.getElementById('nama_sto').value = response.data.sto.nama_sto;

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

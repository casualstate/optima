@extends('layouts.master')
@section('title', 'Permintaan')
@section('permintaan_active', 'active')

@section('content')

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header">
                <a href="{{ route('input_permintaan') }}" class="btn btn-primary">Input Permintaan</a>
            </h5>
        </div>
        <div class="table-responsive text-nowrap">
            @if(session()->get('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>Tematik</th>
                        <th>Nama Permintaan</th>
                        <th>Tanggal Permintaan</th>
                        <th>Project (LOP)</th>
                        <th>Reff</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if (count($permintaan) > 0)
                        @foreach ($permintaan as $key => $item)
                            @php
                                $lop = App\Models\Project::where('permintaan_id', $item->id)->count();
                            @endphp
                            <tr>
                                <td>{{ $item->tematik->tematik }}</td>
                                <td>
                                    <a href="#" data-id="{{ $item->id }}" class="detail" data-bs-toggle="modal" data-bs-target=".detailModal">
                                    {{ $item->nama_permintaan }}
                                    <i class='bx bx-link-external'></i>
                                    </a> <br>
                                    Type : {{ $item->status_nodin }}
                                </td>
                                <td>{{ $item->tanggal_permintaan }}</td>
                                <td>{{ $lop }}</i></a></td>
                                <td>{{ $item->reff_permintaan }}</i></a></td>
                                <td>
                                    @php
                                        if ($item->status == 'In Progress') {
                                            $color = 'bg-danger'; // In Progress
                                        } else if($item->status == 'Selesai') {
                                            $color = 'bg-success'; // Selesai
                                        } else {
                                            $color = 'bg-warning'; // Order
                                        }
                                    @endphp
                                    <span class="badge {{ $color }}">{{ $item->status }}</span>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">Belum ada permintaan !</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <div class="d-inline text-center">
                {!! $permintaan->links('vendor.pagination.bootstrap-4') !!}
            </div>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->

    <div class="modal fade detailModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form class="modal-content">
                @csrf
                <input type="hidden" name="id_permintaan" id="id_permintaan_1">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Permintaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">Tanggal Permintaan</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="tanggal_permintaan" id="tanggal_permintaan" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">Nama Permintaan</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="nama_permintaan" id="nama_permintaan" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">Reff Permintaan</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="reff_permintaan" id="reff_permintaan" disabled>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="html5-date-input" class="col-md-3 col-form-label">PIC Permintaan</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="pic_permintaan" id="pic_permintaan" disabled>
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
                        <label for="html5-date-input" class="col-md-3 col-form-label">Status Nodin</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="status_nodin" id="status_nodin" disabled>
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

        $(document).on('click', 'a.detail', function () {

        var permintaan_id = $(this).attr('data-id');

        $('#id_permintaan_1').val(permintaan_id);

        axios.get('http://localhost:8001/detail-permintaan', {
                params: {
                    id_permintaan: permintaan_id
                }
            })
            .then(function (response) {
                console.log(response.data);
                document.getElementById('tanggal_permintaan').value = response.data.permintaan.tanggal_permintaan;
                document.getElementById('nama_permintaan').value = response.data.permintaan.nama_permintaan;
                document.getElementById('reff_permintaan').value = response.data.permintaan.reff_permintaan;
                document.getElementById('pic_permintaan').value = response.data.permintaan.pic_permintaan;
                document.getElementById('keterangan').value = response.data.permintaan.keterangan;
                document.getElementById('status').value = response.data.permintaan.status;
                document.getElementById('status_nodin').value = response.data.permintaan.status_nodin;
                console.log(response);

            })
            .catch(function (error) {
                console.log(error);
            })
            .then(function () {
                // always executed
            });

        });


    </script>

@endsection

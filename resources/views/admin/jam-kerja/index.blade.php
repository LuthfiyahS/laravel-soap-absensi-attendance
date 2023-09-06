@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Jam Kerja</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Jam Kerja</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Jam Kerja</h3>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class=" datatable table table-stripped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nama</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Pulang</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departemen as $x)
                                        <tr>
                                            <td>
                                                {{$loop->iteration}}
                                            </td>
                                            <td>{{ $x->name }}</td>
                                            <td>
                                                @if ($x->jam_masuk != null || $x->jam_masuk_mulai != null || $x->jam_masuk_selesai != null)
                                                    {{ $x->jam_masuk }} <br> 
                                                    <span class="badge badge-outline-primary">{{ $x->jam_masuk_mulai }} </span> s/d <span class="badge badge-outline-primary"> {{ $x->jam_masuk_selesai }}</span>
                                                @else
                                                    <span class="badge badge-outline-warning">Pengaturan waktu belum lengkap</span>
                                                @endif 
                                            </td>
                                            <td>
                                                @if ($x->jam_pulang != null || $x->jam_pulang_mulai != null || $x->jam_pulang_selesai != null)
                                                    {{ $x->jam_pulang }} <br>
                                                    <span class="badge badge-outline-primary">{{ $x->jam_pulang_mulai }}</span> s/d <span class="badge badge-outline-primary">{{ $x->jam_pulang_selesai }}</span>
                                                @else
                                                    <span class="badge badge-outline-warning">Pengaturan waktu belum lengkap</span>
                                                @endif 
                                            </td>
                                            <td>
                                               <div class="text-end">
                                                    <a href="#" class="btn btn-sm bg-danger-light"
                                                        data-bs-toggle="modal" data-bs-target="#edit-modal{{ $x->id }}">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                </div>    
                                            </td>
                                        </tr>
                                        <div id="edit-modal{{ $x->id }}" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <form action="{{ route('jam-kerja.update', $x->id) }}" method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">
                                                                Edit
                                                            </h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-4">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="mb-3">
                                                                        <label for="field{{ $x->id}}" class="form-label">Jam Masuk</label>
                                                                        <input type="time" class="form-control"
                                                                            name="jam_masuk" value="{{ $x->jam_masuk }}" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="mb-3">
                                                                        <label for="field{{ $x->id}}" class="form-label">Mulai</label>
                                                                        <input type="time" class="form-control"
                                                                            name="jam_masuk_mulai" value="{{ $x->jam_masuk_mulai }}" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="mb-3">
                                                                        <label for="field{{ $x->id}}" class="form-label">Selesai</label>
                                                                        <input type="time" class="form-control"
                                                                            name="jam_masuk_selesai" value="{{ $x->jam_masuk_selesai }}" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="mb-3">
                                                                        <label for="field{{ $x->id}}" class="form-label">Jam Pulang</label>
                                                                        <input type="time" class="form-control"
                                                                            name="jam_pulang" value="{{ $x->jam_pulang }}" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="mb-3">
                                                                        <label for="field{{ $x->id}}" class="form-label">Mulai</label>
                                                                        <input type="time" class="form-control"
                                                                            name="jam_pulang_mulai" value="{{ $x->jam_pulang_mulai }}" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="mb-3">
                                                                        <label for="field{{ $x->id}}" class="form-label">Selesai</label>
                                                                        <input type="time" class="form-control"
                                                                            name="jam_pulang_selesai" value="{{ $x->jam_pulang_selesai }}" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary-light waves-effect"
                                                                data-bs-dismiss="modal">
                                                                Tutup
                                                            </button>
                                                            <button type="submit"
                                                                class="btn btn-primary waves-effect waves-light">
                                                                Simpan Perubahan
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#data_tbl").DataTable({
                search: true,
            })

        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
@endsection

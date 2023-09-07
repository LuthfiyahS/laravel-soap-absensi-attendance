@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Mesin Fingerprint</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Mesin Fingerprint</li>
                    </ul>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-xl-4 col-sm-4 col-12">
                <div class="card inovices-card">
                    <div class="card-body">
                        <div class="inovices-widget-header">
                            <span class="inovices-widget-icon">
                                <span style="color: #e2e0e09a;">
                                    <i class="fas fa-sync fa-3x"></i>
                                  </span>
                            </span>
                            <div class="inovices-dash-count">
                                <div class="inovices-amount">
                                    {{$sync}}X
                                </div>
                            </div>
                        </div>
                        <p class="inovices-all">
                            Disinkronisasi
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-4 col-12">
                <div class="card inovices-card">
                    <div class="card-body">
                        <div class="inovices-widget-header">
                            <span class="inovices-widget-icon">
                                <span style="color: #e2e0e09a;">
                                    <i class="fas fa-calendar fa-3x"></i>
                                  </span>
                            </span>
                            <div class="inovices-dash-count">
                                <div class="inovices-amount">
                                    {{Carbon\Carbon::create($syncdate->datetime)->isoFormat('D MMMM Y')}}
                                </div>
                            </div>
                        </div>
                        <p class="inovices-all">
                            Terakhir Sinkroninasi
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-4 col-12">
                <div class="card inovices-card">
                    <div class="card-body">
                        <div class="inovices-widget-header">
                            <span class="inovices-widget-icon">
                                <span style="color: #e2e0e09a;">
                                    <i class="fas fa-file fa-3x"></i>
                                  </span>
                            </span>
                            <div class="inovices-dash-count">
                                <div class="inovices-amount">
                                    {{$log}}
                                </div>
                            </div>
                        </div>
                        <p class="inovices-all">
                            Log Tersimpan
                        </p>
                    </div>
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
                                    <h3 class="page-title">Mesin Fingerprint</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="{{route('mesin-fingerprint.sinkronisasi')}}" class="btn btn-outline-primary me-2"><i class="fas fa-sync"></i>
                                        Sinkronisasi</a>
                                    <a data-bs-toggle="modal" data-bs-target="#create-modal" class="btn btn-primary"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <table class="datatable table table-stripped" id='data_tbl'>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nama</th>
                                    <th>IP</th>
                                    <th>Comkey</th>
                                    <th>Status</th>
                                    <th>Konektivitas Mesin</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mesinfingerprint as $x)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $x->name }}</td>
                                        <td>{{ $x->ip }}</td>
                                        <td>{{ $x->comkey }}</td>
                                        <td>@if ($x->status == 0)
                                                <p class="badge badge-danger text-white">Tidak Aktif</p>
                                            @elseif($x->status == 1)
                                                <p class="badge badge-info text-white">Aktif</p>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('mesin-fingerprint.show', $x->id) }}" class="badge badge-soft-info" >
                                                    <i class="feather-edit"></i> Cek Koneksi Mesin Fingerprint
                                                </a> <br>
                                                <a href="#" class="badge badge-soft-danger"
                                                    data-bs-toggle="modal" data-bs-target="#deletelog-modal{{ $x->id }}">
                                                    <i class="feather-trash"></i> Hapus Log Mesin Fingerprint
                                                </a>
                                        </td>
                                        <td>
                                           <div class="text-end">
                                                <a href="#" class="btn btn-sm bg-danger-light"
                                                    data-bs-toggle="modal" data-bs-target="#edit-modal{{ $x->id }}">
                                                    <i class="feather-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm bg-danger-light"
                                                    data-bs-toggle="modal" data-bs-target="#delete-modal{{ $x->id }}">
                                                    <i class="feather-trash"></i>
                                                </a>
                                            </div> 
                                                
                                        </td>
                                    </tr>
                                    <div id="edit-modal{{ $x->id }}" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('mesin-fingerprint.update', $x->id) }}" method="POST">
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
                                                            <div class="col-md-12">
                                                                <div class="mb-3">
                                                                    <label for="field-1" class="form-label">Nama
                                                                        Divisi</label>
                                                                    <input type="text" class="form-control"
                                                                        name="name" placeholder="Nama Divisi"
                                                                        value="{{ $x->name }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label>IP</label>
                                                                <input type="text" name="ip" val-type="text" class="form-control" value="{{$x->ip}}"></input>
                                                            </div>
                                                        </div>
                                        
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label>Key</label>
                                                                <input type="text" name="comkey" val-type="text" class="form-control" value="{{$x->comkey}}"></input>
                                                            </div>
                                                        </div>
                                        
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label>Status</label>
                                                                <select name="status" id="status" class="form-control selectpicker">
                                                                    @if ($x->status == '1')
                                                                        <option value="1" selected>Aktif</option>
                                                                        <option value="0">Tidak Aktif</option>
                                                                    @else
                                                                    <option value="1">Aktif</option>
                                                                    <option value="0" selected>Tidak Aktif</option>
                                                                    @endif
                                                                </select>
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
                                    <div id="delete-modal{{ $x->id }}" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('mesin-fingerprint.destroy', $x->id) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="modal-body text-center">
                                                        <br>
                                                        <span style="color: #e84646;">
                                                            <i class="fa fa-exclamation fa-7x"></i>
                                                          </span>
                                                        
                                                        <br><br><br>
                                                        <h4>Apakah anda yakin menghapus data ini?</h4>
                                                        <br>
                                                        <button type="button" class="btn btn-secondary waves-effect"
                                                            data-bs-dismiss="modal">
                                                            Tutup
                                                        </button>
                                                        <button type="submit"
                                                            class="btn btn-danger waves-effect waves-light">
                                                            Ya, Hapus!
                                                        </button>
                                                        <br><br>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="deletelog-modal{{ $x->id }}" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('mesin-fingerprint.destroylog', $x->id) }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <div class="modal-body text-center">
                                                        <br>
                                                        <span style="color: #e84646;">
                                                            <i class="fa fa-exclamation fa-7x"></i>
                                                          </span>
                                                        
                                                        <br><br><br>
                                                        <h4>Apakah anda yakin menghapus data ini?</h4>
                                                        <br>
                                                        <button type="button" class="btn btn-secondary waves-effect"
                                                            data-bs-dismiss="modal">
                                                            Tutup
                                                        </button>
                                                        <button type="submit"
                                                            class="btn btn-danger waves-effect waves-light">
                                                            Ya, Hapus!
                                                        </button>
                                                        <br><br>
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


        <div id="create-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true" style="display: none">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('mesin-fingerprint.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">
                                Tambah Data Mesin
                            </h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="field-1" class="form-label">Nama Divisi</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Nama Mesin" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>IP</label>
                                    <input type="text" name="ip" val-type="text" class="form-control"></input>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Key</label>
                                    <input type="text" name="comkey" val-type="text" class="form-control"></input>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control selectpicker">
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary-light waves-effect" data-bs-dismiss="modal">
                                Tutup
                            </button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Tambah Data
                            </button>
                        </div>
                    </form>
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

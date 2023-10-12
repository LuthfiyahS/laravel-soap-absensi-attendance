@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Pengguna</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pengguna</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="student-group-form">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by ID ...">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Name ...">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Year ...">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="search-student-btn">
                        <button type="btn" class="btn btn-primary">Search</button>
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
                                    <h3 class="page-title">Pengguna</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i>
                                        Download</a>
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
                                    <th>Kontak</th>
                                    <th>Bagian</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengguna as $x)
                                    <tr>
                                        <td>
                                            <div class="avatar">
                                                @if ($x->foto != null )
                                                <img class="avatar-img rounded" alt="User Image" src="{{ url('storage/'.$x->foto) }}">    
                                                @else
                                                <img class="avatar-img rounded" alt="User Image" src="{{asset('theme')}}/assets/img/profiles/avatar-02.jpg">    
                                                @endif
                                                
                                                
                                            </div>
                                        </td>
                                        <td><h6 style="margin-bottom:0%">{{ $x->name }}</h6>
                                            <small>{{$x->username}}</small>
                                        </td>
                                        <td>
                                            <p> Email : {{$x->email}} <br>
                                                No HP : {{$x->no_hp}}</p>
                                        </td>
                                        <td>
                                            @if ($x->departemen_id %2 != 0)
                                                <span class="badge badge-outline-info">{{$x->departemen->name}}</span>
                                            @else
                                                <span class="badge badge-outline-success">{{$x->departemen->name}}</span>
                                            @endif
                                            
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
                                                <form action="{{ route('pengguna.update', $x->id) }}" method="POST" enctype="multipart/form-data">
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
                                                                <div class="mb-3">
                                                                    <label for="field-1" class="form-label">Email</label>
                                                                    <input type="email" class="form-control" name="email"
                                                                        placeholder="Email "value="{{ $x->email }}"  />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="field-1" class="form-label">No HP</label>
                                                                    <input type="text" class="form-control" name="no_hp"
                                                                        placeholder="no_hp " value="{{ $x->no_hp }}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="field-1" class="form-label">No HP</label>
                                                                    <input type="file" class="form-control" name="file">
                                                                    <input type="hidden"  name="path_file" value="{{ $x->foto }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="field-1" class="form-label">Peran pengguna</label>
                                                                    <select name="type" id="" class="form-control">
                                                                        <option value="" disabled selected>Pilih peran </option>
                                                                        @foreach ($role as $y)
                                                                            @if ($y->id!= 2)
                                                                            <option value="{{$y->id}}" @if ($y->id == $x->type) selected @endif>{{$y->name}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="field-1" class="form-label">Departemen/Divisi</label>
                                                                    <select name="departemen_id" id="" class="form-control">
                                                                        <option value="" disabled selected>Pilih peran </option>
                                                                        @foreach ($departemen as $y)
                                                                            <option value="{{$y->id}}" @if ($y->id == $x->departemen_id) selected @endif>{{$y->name}}</option>
                                                                        @endforeach
                                                                    </select>
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
                                    <div id="delete-modal{{ $x->id }}" class="modal fade" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('pengguna.destroy', $x->id) }}" method="post">
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
                    <form action="{{ route('pengguna.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">
                                Tambah Pengguna
                            </h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="field-1" class="form-label">NIP/NISN/Nomor identitas lainnya</label>
                                        <input type="text" class="form-control" name="username"
                                            placeholder="Nomor identitas " />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="field-1" class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Nama " />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="field-1" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Email " />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="field-1" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Password " />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="field-1" class="form-label">Peran pengguna</label>
                                        <select name="type" id="" class="form-control">
                                            <option value="" disabled selected>Pilih peran </option>
                                            @foreach ($role as $x)
                                                @if ($x->id!= 2)
                                                <option value="{{$x->id}}">{{$x->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="field-1" class="form-label">Departemen/Divisi</label>
                                        <select name="departemen_id" id="" class="form-control">
                                            <option value="" disabled selected>Pilih peran </option>
                                            @foreach ($departemen as $x)
                                                <option value="{{$x->id}}">{{$x->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                searching: true,
            })

        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
@endsection

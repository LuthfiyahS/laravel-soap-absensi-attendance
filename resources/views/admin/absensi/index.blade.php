@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Absensi</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Absensi</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card report-card">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="app-listing">
                            <li style="width: 40%;">
                                <div class="multipleSelection">
                                    <div class="selectBox">
                                        <p class="mb-0">
                                            <i class="fas fa-user-plus me-1 select-icon"></i>
                                            Pilih Pengguna
                                        </p>
                                        <span class="down-icon"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div id="checkBoxes">
                                        <form action="#">
                                            <p class="checkbox-title">
                                                Customer Search
                                            </p>
                                            <div class="form-custom">
                                                <input type="text" class="form-control bg-grey"
                                                    placeholder="Enter Customer Name" />
                                            </div>
                                            <div class="selectBox-cont">
                                                @foreach ($user as $x)
                                                    <label class="custom_check w-100">
                                                        <input type="checkbox" name="username" />
                                                        <span class="checkmark"></span>
                                                        {{ $x->name }}
                                                    </label>
                                                @endforeach
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="username" />
                                                    <span class="checkmark"></span>
                                                    Brian Johnson
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="username" />
                                                    <span class="checkmark"></span>
                                                    Russell Copeland
                                                </label>
                                            </div>
                                            <button type="submit" class="btn w-100 btn-primary">
                                                Apply
                                            </button>
                                            <button type="reset" class="btn w-100 btn-grey">
                                                Reset
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li style="width: 40%;">
                                <div class="multipleSelection">
                                    <div class="selectBox">
                                        <p class="mb-0">
                                            <i class="fas fa-calendar me-1 select-icon"></i>
                                            Pilih Tanggal
                                        </p>
                                        <span class="down-icon"><i class="fas fa-chevron-down"></i></span>
                                    </div>
                                    <div id="checkBoxes">
                                        <form action="#">
                                            <p class="checkbox-title">
                                                Filter Tanggal
                                            </p>
                                            <div class="selectBox-cont selectBox-cont-one h-auto">
                                                <div class="date-picker">
                                                    <div class="form-custom cal-icon">
                                                        <input class="form-control datetimepicker" type="text"
                                                            placeholder="Form" />
                                                    </div>
                                                </div>
                                                <div class="date-picker pe-0">
                                                    <div class="form-custom cal-icon">
                                                        <input class="form-control datetimepicker" type="text"
                                                            placeholder="To" />
                                                    </div>
                                                </div>
                                                <div class="date-list">
                                                    <ul>
                                                        <li>
                                                            <a href="#" class="btn date-btn">Hari Ini</a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="btn date-btn">Kemarin</a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="btn date-btn">
                                                                7
                                                                Hari Terakhir</a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="btn date-btn">Bulan Ini</a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="btn date-btn">Bulan Kemarin</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="report-btn">
                                    <a href="#" class="btn">
                                        <img src="{{ asset('theme') }}/assets/img/icons/invoices-icon5.png" alt=""
                                            class="me-2" />
                                        Generate report
                                    </a>
                                </div>
                            </li>
                        </ul>
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
                                    <h3 class="page-title">Absensi</h3>
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
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" value="something">
                                        </div>
                                    </th>
                                    <th>Nama</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensi as $x)
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </td>
                                        <td>{{ $x->name }}</td>
                                        <td>
                                            <div class="text-end">
                                                <a href="#" class="btn btn-sm bg-danger-light"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#edit-modal{{ $x->id }}">
                                                    <i class="feather-edit"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm bg-danger-light"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#delete-modal{{ $x->id }}">
                                                    <i class="feather-trash"></i>
                                                </a>
                                            </div>

                                        </td>
                                    </tr>
                                    <div id="edit-modal{{ $x->id }}" class="modal fade" tabindex="-1"
                                        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                        style="display: none">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('absensi.update', $x->id) }}" method="POST">
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
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                            class="btn btn-secondary-light waves-effect"
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
                                    <div id="delete-modal{{ $x->id }}" class="modal fade" tabindex="-1"
                                        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
                                        style="display: none">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('absensi.destroy', $x->id) }}" method="post">
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

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
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item"><a class="nav-link active" href="#bottom-justified-tab1"
                                    data-bs-toggle="tab">Semua</a></li>
                            <li class="nav-item"><a class="nav-link" href="#bottom-justified-tab2"
                                    data-bs-toggle="tab">Per Orang</a></li>
                            <li class="nav-item"><a class="nav-link" href="#bottom-justified-tab3"
                                    data-bs-toggle="tab">Per Bulan</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="bottom-justified-tab1">
                                <table class="datatable table table-stripped" id='data_tbl'>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Keluar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($absensi as $x)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{ $x->user->name }}</td>
                                                <td>{{ $x->tanggal }}</td>
                                                <td>{{ $x->jam_masuk }}</td>
                                                <td>{{ $x->jam_pulang }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="bottom-justified-tab2">
                                Tab content 2
                            </div>
                            <div class="tab-pane" id="bottom-justified-tab3">
                                Tab content 3
                            </div>
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

@extends('layouts.app')

@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-sub-header">
                <h3 class="page-title">
                    Selamat Datang {{auth()->user()->name}}!
                </h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/dashboard">Dashboard</a>
                    </li>
                    {{-- <li class="breadcrumb-item active">
                        Teacher
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-4 col-sm-12 col-12 d-flex">
        <div class="card bg-comman w-100">
            <div class="card-body">
                <div
                    class="db-widgets d-flex justify-content-between align-items-center"
                >
                    <div class="db-info">
                        <h6>Total Pengajar</h6>
                        <h3>40/60</h3>
                    </div>
                    <div class="db-icon">
                        <img
                            src="{{asset('theme')}}/assets/img/icons/dash-icon-01.svg"
                            alt="Dashboard Icon"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-12 col-12 d-flex">
        <div class="card bg-success w-100">
            <div class="card-body">
                <div
                    class="db-widgets d-flex justify-content-between align-items-center"
                >
                    <div class="db-info">
                        <h6 class="text-white">Total Tepat Waktu Hari Ini</h6>
                        <h3>{{$tepat}}/{{$tepat+$terlambat}}</h3>
                    </div>
                    <div class="db-icon">
                        <img
                            src="{{asset('theme')}}/assets/img/icons/teacher-icon-03.svg"
                            alt="Dashboard Icon"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-12 col-12 d-flex">
        <div class="card bg-danger w-100">
            <div class="card-body">
                <div
                    class="db-widgets d-flex justify-content-between align-items-center"
                >
                    <div class="db-info">
                        <h6 class="text-white">Total Terlambat Hari Ini</h6>
                        <h3>{{$terlambat}}/{{$tepat+$terlambat}}</h3>
                    </div>
                    <div class="db-icon">
                        <img
                            src="{{asset('theme')}}/assets/img/icons/teacher-icon-03.svg"
                            alt="Dashboard Icon"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6 d-flex">

        <div class="card flex-fill student-space comman-shadow">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title">Absensi Terbaru</h5>
                <ul class="chart-list-out student-ellips">
                    <li class="star-menus"><a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table
                        class="table star-student table-hover table-center table-borderless table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th class="text-center">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentabsen as $item)
                            <tr>
                                <td class="text-nowrap">
                                    <div>{{$loop->iteration}}</div>
                                </td>
                                <td class="text-nowrap">
                                    <a href="profile.html">
                                        <img class="rounded-circle"
                                            src="{{asset('theme')}}/assets/img/profiles/avatar-02.jpg" width="25"
                                            alt="Star Students">
                                        {{$item->user->name}}
                                    </a>
                                </td>
                                <td class="text-center">{{$item->status}}</td>
                            </tr>
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="col-xl-6 d-flex">

        <div class="card flex-fill comman-shadow">
            <div class="card-body">
                <div
                    id="calendar-doctor"
                    class="calendar-container"
                ></div>
                
            </div>
        </div>

    </div>
</div>
@endsection
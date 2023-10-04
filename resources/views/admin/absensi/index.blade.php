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
                        <form action="{{route('absensi.generate')}}" method="POST">
                            @csrf
                        <ul class="app-listing">
                            <li style="width: 25%;">
                                <div class="form-group">
                                    <select name="user_id" id="select-field" class="form-control" >
                                        <option value="" disabled selected>Pilih User</option>
                                        @foreach ($user as $x)
                                            <option value="{{$x->id}}" @if ($name !=null && $name == $x->id) selected @endif >{{$x->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li style="width: 25%;">
                                <div class="form-group">
                                    <div class="form-custom cal-icon">
                                        <input class="form-control" type="date"
                                            placeholder="Form" name="from" @if ($tgl_awal !=null) value="{{$tgl_awal}}" @endif />
                                    </div>
                                </div>
                            </li>
                            <li style="width: 25%;">
                                <div class="form-group">
                                    <div class="form-custom cal-icon">
                                        <input class="form-control" type="date"
                                            placeholder="To" name="to" @if ($tgl_akhir !=null) value="{{$tgl_akhir}}" @endif  />
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="report-btn">
                                    <button type="submit" class="btn"><img src="{{ asset('theme') }}/assets/img/icons/invoices-icon5.png" alt=""
                                        class="me-2" />
                                    Generate Report</button>
                                    {{-- <a href="#" class="btn">
                                        <img src="{{ asset('theme') }}/assets/img/icons/invoices-icon5.png" alt=""
                                            class="me-2" />
                                        Generate report
                                    </a> --}}
                                </div>
                            </li>
                        
                        </ul>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <table class="table table-stripped w-100" id='data_tbl'>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $( '#select-field' ).select2( {
            theme: 'bootstrap-5'
        } );
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#data_tbl').DataTable({

                serverSide: true,
                ajax: '{{ url()->current() }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'user.name',
                        name: 'user.name'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'jam_masuk',
                        name: 'jam_masuk'
                    },
                    {
                        data: 'jam_pulang',
                        name: 'jam_pulang'
                    },
                ]
            });

        })
    </script>
@endsection

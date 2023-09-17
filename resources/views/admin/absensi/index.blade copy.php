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
                                                    placeholder="Enter Customer Name" id="search" />
                                            </div>
                                            <div class="selectBox-cont input" id="inp">
                                                @foreach ($user as $x)
                                                    <label class="custom_check w-100" id="brow">
                                                        <input type="checkbox" name="username" id="data" value="{{ $x->id }}" />
                                                        <span class="checkmark"></span>
                                                        {{ $x->name }}
                                                    </label>
                                                @endforeach
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#data_tbl').DataTable({
              
              serverSide: true,
              ajax: '{{ url()->current() }}',
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'user.name', name: 'user.name'},
                  {data: 'tanggal', name: 'tanggal'},
                  {data: 'jam_masuk', name: 'jam_masuk'},
                  {data: 'jam_pulang', name: 'jam_pulang'},
              ]
          });

          $('#data*').change(function() {
                var jawaban = $(this).val();
                console.log('id = ' + jawaban);
          });

          $('#search').on('keydown', function(e){

                console.log(e.keyCode);
                var keyword = $(this).val();
                console.log('keyword = ' + keyword);
                $.ajax({ //create an ajax request to display.php
                    type: "GET",
                    url: "{{ url('/absensi/list') }}" + '/' + keyword,
                    success: function(data) {
                        console.log(data);
                        //$('#hide-notif-jawaban').remove();
                        document.getElementById("inp").innerHTML = null;
                        if (data != null) {
                            $.each(data, function (key, value) {
                                //$('.input').append("<option value='"+value.id+"'>"+value.materi+"</option>");
                                $('.input').append(`<label class="custom_check w-100"><input type="checkbox" name="username" id="data" value="${ value.id }" />
                                                        <span class="checkmark"></span>
                                                        ${ value.name }</label>`);
                                
                            })
                            
                        } else {
                            $('#jawaban').remove();
                            $('#jawaban_wrap').append(
                                '<input type="text" name="jawaban" id="jawaban" class="form-control">'
                                );
                        }

                       
                        if (data.length == 0) {
                            $('#jawaban').append("<option>jawaban belum tersedia</option>");
                        }
                    },
                    error: function(data) {
                        alert("Data Tidak Ditemukan")
                    }
                });
          });

        })
    </script>
      
@endsection

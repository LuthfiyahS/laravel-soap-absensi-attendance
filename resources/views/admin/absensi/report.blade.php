<!DOCTYPE html>

<html>

<head>
    <style type="text/css">
        * {
            font-size: 10pt;
        }

        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif
        }
        .page-break {
            page-break-after: always;
        }
    </style>
    <title>Laporan Absensi {{$user->name}}</title>

</head>

<body>

    {{-- <h1>{{ $title }}</h1>

    <p>{{ $date }}</p> --}}
    <style>
        table.customTable {
            width: 100vw;
            background-color: #FFFFFF;
            border-collapse: collapse;
            border-width: 1px;
            border-color: #DBD7D7;
            border-style: solid;
            color: #000000;
            margin-bottom: 20px;
        }

        table.customTable td,
        table.customTable th {
            vertical-align: top;
            text-align: left;
            border-width: 1px;
            border-color: #000000;
            border-style: solid;
            padding: 10px;
        }

        table.customTable thead {
            background-color: #DBD7D7;
        }
    </style>
    <table class="customTable" style="border: 0; border-bottom:2px; border-color:#000000">
        <tr>
            {{-- <th style="width:100px; text-align:center; border:0;"><img src="{{asset('theme/assets/img/logo-small.png')}}" width="100px" --}}
                    alt=""></th>
            <th colspan="8" style="border: 0;">
                <h1>
                    LAPORAN ABSENSI <br>
                    {{strtoupper($user->name)}} <br>
                    SMA FULLDAY AL-MUHAJIRIN {{$from}} <br>
                    {{Carbon\Carbon::create($from)->isoFormat('dddd, D MMMM Y');}} - {{Carbon\Carbon::create($to)->isoFormat('dddd, D MMMM Y');}} <br>
                    Purwakarta 41101, Jawa Barat 
                    Tel: +92-294-200311 Fax: +92-294-202318
                </h1>
            </th>
        </tr>
    </table>
    <table class='customTable'>
          
        <thead>
        <tr class="btn-secondary" style="vertical-align: middle;text-align:center;">
            <th rowspan="3" style="vertical-align: middle;text-align:center;">No</th>
            <th rowspan="3" style="vertical-align: middle;text-align:center;">Tanggal</th>
            <th rowspan="3" style="vertical-align: middle;text-align:center;">Jam Masuk</th>
            <th rowspan="3" style="vertical-align: middle;text-align:center;">Jam Pulang</th>
            <th rowspan="3" style="vertical-align: middle;text-align:center;">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($absen as $x)
        <tr  style="vertical-align: middle;text-align:center;">
            <td rowspan="3" style="vertical-align: middle;text-align:center;">{{$loop->iteration}}</td>
            <td rowspan="3" style="vertical-align: middle;text-align:center;">{{Carbon\Carbon::create($x->tanggal)->isoFormat('dddd, D MMMM Y');}} </td>
            <td rowspan="3" style="vertical-align: middle;text-align:center;">{{$x->jam_masuk}}</td>
            <td rowspan="3" style="vertical-align: middle;text-align:center;">{{$x->jam_pulang}}</td>
            <td rowspan="3" style="vertical-align: middle;text-align:center;">{{$x->kehadiran}} / {{$x->status}}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
    <center> 
        <b>
            {{-- KEPALA PROGRAM STUDI <br>
            {{strtoupper($matkul->prodi->nama_prodi)}} <br> <br> <br> <br> <br> 

            {{strtoupper($kaprodi->nama_dosen)}}  --}}
        </b>
    </center>

</body>

</html>

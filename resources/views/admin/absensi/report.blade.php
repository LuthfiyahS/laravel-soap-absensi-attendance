<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cetak Laporan Absensi</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
        }
    </style>
</head>

<body>
    <center>
        <table width="670px" cellspacing="0" cellpadding="0">
            <tr>
                <td><img src="{{ asset('theme')}}/assets/img/logo.png" width="140px" /></td>
                <td colspan="11">
                    <h3 style=" text-align: center; margin-top: 5px; font-family: Calibri, 'Trebuchet MS', sans-serif;">
                        ABSENSI APP</h3>
                    <p
                        style=" text-align: center; margin-top: -30px; font-size: 14px; font-family: Calibri, 'Trebuchet MS', sans-serif;">
                        <br />
                        JL. Raya Kasih Sayang,
                        Purwakarta, Jawa Barat, 41151 <br />
                        Telp : (0264) 1234567, Fax : (0264) 1234567 <br />
                        Email: pt.pos@gmail.com
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <hr />
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <p style="text-align: center; margin: 1px; font-family: Calibri, 'Trebuchet MS', sans-serif;"">
                        <b>LAPORAN DATA ABSENSI <br> {{$user->name}} <br> Periode  {{Carbon\Carbon::create($from)->isoFormat('dddd, D MMMM Y');}} - {{Carbon\Carbon::create($to)->isoFormat('dddd, D MMMM Y');}} </b></p>
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <hr />
                </td>
            </tr>
            <tr>
                <td colspan="12"><br /></td>
            </tr>
            <tr>
                <td colspan="12">
                    <center>
                        <table border="1px" width="660px" cellspacing="0" cellpadding="0"
                            style="font-family: calibri;">
                            <tr class="btn-secondary" style="vertical-align: middle;text-align:center;">
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Keterangan</th>
                            </tr>
                            @foreach ($absen as $x)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{Carbon\Carbon::create($x->tanggal)->isoFormat('dddd, D MMMM Y');}} </td>
            <td>{{$x->jam_masuk}}</td>
            <td>{{$x->jam_pulang}}</td>
            <td>{{$x->kehadiran}} {{$x->status}}</td>
        </tr>
        @endforeach
                            

        </table>
    </center>
    </td>
    </tr>
    </center>
    {{-- <script>
        window.print();
    </script> --}}
</body>

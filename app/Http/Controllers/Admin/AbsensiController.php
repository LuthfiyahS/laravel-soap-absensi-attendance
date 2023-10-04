<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\User;
use DataTables;
Use Alert;
use PDF;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($_GET['user_id']))
        {
            $name = $_GET['user_id'];
        }else {
            $name = null;
        }

        if(isset($_GET['tgl_awal']))
        {
            $tgl_awal = $_GET['tgl_awal'];
        }else {
            $tgl_awal = null;
        }

        if(isset($_GET['tgl_akhir']))
        {
            $tgl_akhir = $_GET['tgl_akhir'];
        }else {
            $tgl_akhir = null;
        }
        //echo $tgl_akhir;
        $absensi = Absensi::all();
        $user = User::all();
        $usergroup = Absensi::select('user_id')->groupBy('user_id')->get();
        if ($request->ajax()) {
            if(isset($_GET['user_id']))
            {
                $name = $_GET['user_id'];
            }else {
                $name = null;
            }

            if(isset($_GET['tgl_awal']))
            {
                $tgl_awal = $_GET['tgl_awal'];
            }else {
                $tgl_awal = null;
            }

            if(isset($_GET['tgl_akhir']))
            {
                $tgl_akhir = $_GET['tgl_akhir'];
            }else {
                $tgl_akhir = null;
            }
            
            if ($name != null && $tgl_awal  != null && $tgl_akhir != null) {
                $data = Absensi::with('user')->where('user_id',$name)->where('tanggal','>=',$tgl_awal)->where('tanggal','<=',$tgl_akhir)->latest()->get();
            } else if($name != null) {
                $data = Absensi::with('user')->where('user_id',$name)->latest()->get();
            } else if($tgl_awal  != null && $tgl_akhir != null) {
                $data = Absensi::with('user')->where('tanggal','>=',$tgl_awal)->where('tanggal','<=',$tgl_akhir)->latest()->get();
            } else {
                $data = Absensi::with('user')->latest()->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->make();
        }
        return view('admin.absensi.index',compact('absensi','user','usergroup','name','tgl_awal','tgl_akhir'));
    }

    public function getAbsensiData(Request $request)
    {
        if(isset($_GET['user_id']))
        {
            $name = $_GET['user_id'];
        }else {
            $name = null;
        }

        if(isset($_GET['tgl_awal']))
        {
            $tgl_awal = $_GET['tgl_awal'];
        }else {
            $tgl_awal = null;
        }

        if(isset($_GET['tgl_akhir']))
        {
            $tgl_akhir = $_GET['tgl_akhir'];
        }else {
            $tgl_akhir = null;
        }
        $absensi = Absensi::all();
        $user = User::all();
        $usergroup = Absensi::select('user_id')->groupBy('user_id')->get();
        if ($request->ajax()) {
            if ($name != null && $tgl_awal  != null && $tgl_akhir != null) {
                $data = Absensi::with('user')->where('user_id',$request->user_id)->where('tanggal','>=',$request->tgl_awal)->where('tanggal','<=',$request->tgl_akhir)->latest()->get();
            } else if($name != null) {
                $data = Absensi::with('user')->where('user_id',$request->user_id)->latest()->get();
            } else if($tgl_awal  != null && $tgl_akhir != null) {
                $data = Absensi::with('user')->where('tanggal','>=',$request->tgl_awal)->where('tanggal','<=',$request->tgl_akhir)->latest()->get();
            } else {
                $data = Absensi::with('user')->latest()->get();
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->make();
        }
        return view('admin.absensi.index',compact('absensi','user','usergroup','name','tgl_awal','tgl_akhir'));
        
    }

    public function getAbsensiUser(Request $request,$user_id)
    {
        if ($request->ajax()) {
                
            $data = Absensi::with('user')->where('user_id',$user_id)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make();
        
        // return response()->json($data);
        }
    }

    public function getAbsensiTgl(Request $request,$tgl_awal,$tgl_akhir)
    {
        if ($request->ajax()) {
                
            $data = Absensi::with('user')->where('tanggal','>=',$tgl_awal)->where('tanggal','<=',$tgl_akhir)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make();
        
        // return response()->json($data);
        }
    }

    public function getAbsensi(Request $request,$keyword)
    {
        // if ($request->ajax()) {
        //     $data = Absensi::latest()->get();
        //     return DataTables::of($data)
        //         ->make();
        // }
        if ($keyword != " " || $keyword != "") {
            $data = User::where('name','LIKE','%'.$keyword.'%')->get();
        }else{
            $data = User::all();
        }
        
        //dd($data);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->user_id;
        $tgl_awal = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $absensi = Absensi::all();
        $user = User::all();
        $usergroup = Absensi::select('user_id')->groupBy('user_id')->get();
        if ($request->ajax()) {
            // $data['semua'] = Absensi::with('user')->latest()->get();
            // $data['user'] = Absensi::select('user.*')->join('user','user.id','absensi.user_id')->groupBy('absensi.user_id')->get();
            $data = Absensi::with('user')->where('user_id',$request->user_id)->where('tanggal','>=',$request->tgl_awal)->where('tanggal','<=',$request->tgl_akhir)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make();
        }
        return view('admin.absensi.index',compact('absensi','user','usergroup','name','tgl_awal','tgl_akhir'));
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = [
                'name'  => $request->name,
            ];
            Absensi::where('id',$id)->update($data);
            Alert::success('Sukses', 'Data berhasil diperbaharui!');
            return redirect('/absensi');
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Data tidak berhasil diupdate');
            return redirect('/absensi');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = Absensi::find($id);
            $data->delete();
            Alert::success('Sukses', 'Data berhasil diperbaharui!');
            return redirect('/absensi');
        } catch (QueryException $e) {
            Alert::error('Gagal', 'Data tidak berhasil dihapus');
            return redirect('/absensi');
        }
    }

    public function generateReport(Request $request){
        $data = [
            'absen' => Absensi::where('user_id', $request->user_id)->whereBetween(DB::raw('DATE(tanggal)'), array($request->from, $request->to))->get(),
            'user' => User::find($request->user_id),
            'from' => $request->from,
            'to' => $request->to,
        ];
        //echo $request->from;
        $user = User::find($request->user_id);
        $pdf = PDF::loadView('admin.absensi.report', $data);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Laporan Presensi  ' . $user->name .'.pdf');
    }
}

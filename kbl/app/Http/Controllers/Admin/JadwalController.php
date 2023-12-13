<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $keywords = $request->keywords;
            $collection = Jadwal::where('rute','like','%'.$keywords.'%')->paginate(10);
            return view('pages.admin.jadwal.list',compact('collection'));
        }   
        return view('pages.admin.jadwal.main');
    }
  
    public function create()
    {
        return view('pages.admin.jadwal.input', ['data' => new Jadwal]);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_armada' => 'required',
            'rute' => 'required',
            'tgl_brgkt' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('id_armada')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('id_armada'),
                ]);
            }elseif ($errors->has('rute')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('rute'),
                ]);
            }elseif ($errors->has('tgl_brgkt')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('tgl_brgkt'),
                ]);
            }
        }

        $jadwal = new Jadwal;
        $jadwal->id_armada = $request->id_armada;
        $jadwal->rute = $request->rute;
        $jadwal->tgl_brgkt = $request->tgl_brgkt;
        $jadwal->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data '. $request->title . ' tersimpan',
        ]);
    }
    
    public function show(Jadwal $jadwal)
    {
        //
    }

    public function edit(Jadwal $jadwal)
    {
        return view('pages.admin.jadwal.input', ['data' => $jadwal]);
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $validator = Validator::make($request->all(), [
            'id_armada' => 'required',
            'rute' => 'required',
            'tgl_brgkt' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('id_armada')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('id_armada'),
                ]);
            }elseif ($errors->has('rute')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('rute'),
                ]);
            }elseif ($errors->has('tgl_brgkt')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('tgl_brgkt'),
                ]);
            }
        }

        $jadwal->id_armada = $request->id_armada;
        $jadwal->rute = $request->rute;
        $jadwal->tgl_brgkt = $request->tgl_brgkt;
        $jadwal->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data '. $request->title . ' tersimpan',
        ]);
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data Jadwal terhapus',
        ]);
    }
}

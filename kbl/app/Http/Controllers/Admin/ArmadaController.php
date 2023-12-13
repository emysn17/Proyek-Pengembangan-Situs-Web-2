<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supir;
use App\Models\Armada;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ArmadaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $keywords = $request->keywords;
            $collection = DB::table('armadas')
            ->join('supirs', 'armadas.id_supir', '=', 'supirs.id')
            ->select('armadas.*', 'supirs.nama_supir')
            ->where('supirs.nama_supir','like','%'.$keywords.'%')->paginate(10);
            return view('pages.admin.armada.list',compact('collection'));
        }   
        return view('pages.admin.armada.main');
    }

    public function create()
    {
        $supirs = Supir::get();
        return view('pages.admin.armada.input', ['data' => new Armada, 'supirs' => $supirs]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_supir' => 'required',
            'kapasitas' => 'required',
            'no_pintu' => 'required',
            'no_polisi' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('id_supir')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('id_supir'),
                ]);
            }elseif ($errors->has('kapasitas')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('kapasitas'),
                ]);
            }elseif ($errors->has('no_pintu')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('no_pintu'),
                ]);
            }elseif ($errors->has('no_polisi')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('no_polisi'),
                ]);
            }
        }

        $armada = new Armada;
        $armada->id_supir = $request->id_supir;
        $armada->kapasistas = $request->kapasistas;
        $armada->no_pintu = $request->no_pintu;
        $armada->no_polisi = $request->no_polisi;
        $armada->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data '. $request->title . ' tersimpan',
        ]);
    }

    public function show(Armada $armada)
    {
        //
    }

    public function edit(Armada $armada)
    {
        $supirs = Supir::get();
        return view('pages.admin.armada.input', ['data' => $armada, 'supirs' => $supirs]);
    }

    public function update(Request $request, Armada $armada)
    {
        $validator = Validator::make($request->all(), [
            'id_supir' => 'required',
            'kapasitas' => 'required',
            'no_pintu' => 'required',
            'no_polisi' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('id_supir')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('id_supir'),
                ]);
            }elseif ($errors->has('kapasitas')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('kapasitas'),
                ]);
            }elseif ($errors->has('no_pintu')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('no_pintu'),
                ]);
            }elseif ($errors->has('no_polisi')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('no_polisi'),
                ]);
            }
        }

        $armada->id_supir = $request->id_supir;
        $armada->kapasistas = $request->kapasistas;
        $armada->no_pintu = $request->no_pintu;
        $armada->no_polisi = $request->no_polisi;
        $armada->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data '. $request->title . ' tersimpan',
        ]);
    }

    public function destroy(Armada $armada)
    {
        $armada->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data Armada terhapus',
        ]);
    }
}

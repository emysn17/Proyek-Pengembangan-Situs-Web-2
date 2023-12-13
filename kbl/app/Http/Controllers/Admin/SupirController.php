<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SupirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $keywords = $request->keywords;
            $collection = Supir::where('nama_supir','like','%'.$keywords.'%')->paginate(10);
            return view('pages.admin.supir.list',compact('collection'));
        }   
        return view('pages.admin.supir.main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.supir.input', ['data' => new Supir]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_supir' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|',
            'alamat' => 'required',
            'no_hp' => 'required|max:12',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('nama_supir')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('nama_pasien'),
                ]);
            }elseif ($errors->has('alamat')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('alamat'),
                ]);
            }elseif ($errors->has('no_hp')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('no_hp'),
                ]);
            }
        }

        $supir = new Supir;
        if(request()->file('gambar')){
            $file = $request->file('gambar');
            $namafile = $file->getClientOriginalName();
            $tujuanFile = 'asset/gambar';
            $file->move($tujuanFile,$namafile);
        }
        $supir->nama_supir = $request->nama_supir;
        $supir->alamat = $request->alamat;
        $supir->province_id = $request->province_id;
        $supir->city_id = $request->city_id;
        $supir->subdistrict_id = $request->subdistrict_id;
        $supir->no_hp = $request->no_hp;
        $supir->gambar = $namafile;
        $supir->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data '. $request->title . ' tersimpan',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supir  $supir
     * @return \Illuminate\Http\Response
     */
    public function show(Supir $supir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supir  $supir
     * @return \Illuminate\Http\Response
     */
    public function edit(Supir $supir)
    {
        return view('pages.admin.supir.input', ['data' => $supir]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supir  $supir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supir $supir)
    {
        $validator = Validator::make($request->all(), [
            'nama_supir' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|',
            'alamat' => 'required',
            'no_hp' => 'required|max:12',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('nama_supir')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('nama_pasien'),
                ]);
            }elseif ($errors->has('alamat')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('alamat'),
                ]);
            }elseif ($errors->has('no_hp')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('no_hp'),
                ]);
            }
        }

        if(request()->file('gambar')){
            $file = $request->file('gambar');
            $namafile = $file->getClientOriginalName();
            $tujuanFile = 'asset/gambar';
            $file->move($tujuanFile,$namafile);
        }
        $supir->nama_supir = $request->nama_supir;
        $supir->alamat = $request->alamat;
        $supir->province_id = $request->province_id;
        $supir->city_id = $request->city_id;
        $supir->subdistrict_id = $request->subdistrict_id;
        $supir->no_hp = $request->no_hp;
        $supir->gambar = $namafile;
        $supir->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data '. $request->title . ' tersimpan',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supir  $supir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supir $supir)
    {
        $supir->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data Supir terhapus',
        ]);
    }
}

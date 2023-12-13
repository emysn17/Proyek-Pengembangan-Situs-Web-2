<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h6>
                        @if ($data->id)
                            Ubah
                        @else
                            Tambah
                        @endif
                        Jadwal
                    </h6>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end">
                        <button type="button" onclick="load_list(1);" class="btn btn-sm btn-primary">Kembali</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <form id="form_input">
                    <div class="row">
                        <select data-control="select2" data-placeholder="Pilih Rute" id="rute" name="rute" class="form-select form-select-solid">
                            <option SELECTED DISABLED >Pilih Supir</option>
                            <option value="ML" {{$item->rute=="ML"?"selected":""}}>Medan - Laguboti</option>
                            <option value="LM" {{$item->rute=="LM"?"selected":""}}>Laguboti - Medan</option>
                            <option value="LS" {{$item->rute=="LS"?"selected":""}}>Laguboti - Sibolga</option>
                            <option value="SL" {{$item->rute=="SL"?"selected":""}}>Sibolga - Laguboti</option>
                        </select>
                        <select data-control="select2" data-placeholder="Pilih Supir" id="id_armada" name="id_armada" class="form-select form-select-solid">
                            <option SELECTED DISABLED >Pilih Supir</option>
                            @foreach ($armada as $item)
                                <option value="{{ $item->id }}" {{$item->id==$data->id_armada?"selected":""}}>{{ $item->supir->nama_supir }}</option>
                            @endforeach
                        </select>
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">Waktu Berangkat</label>
                            <input type="date" class="form-control" id="tgl_brgkt" name="tgl_brgkt" value="{{ $data->tgl_brgkt }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="min-w-150px mt-10 text-end">
                            @if ($data->id)
                            <button id="tombol_simpan" onclick="handle_upload('#tombol_simpan','#form_input','{{route('admin.jadwal.update',$data->id)}}','PATCH');" class="btn btn-sm btn-primary">Simpan</button>
                            @else
                            <button id="tombol_simpan" onclick="handle_upload('#tombol_simpan','#form_input','{{route('admin.jadwal.store')}}','POST');" class="btn btn-sm btn-primary">Simpan</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    obj_select('province');
    obj_select('city');
    obj_select('subdistrict');
    obj_autosize('address');
    get_province();
    function get_province(){
        $.get('{{route('admin.regional.province')}}', {}, function(result) {
            $("#province").html(result);
        }, "html");
    }
    $("#province").change(function(){
        $.get('{{route('admin.regional.city')}}', {province : $("#province").val()}, function(result) {
            $("#city").html(result);
        }, "html");
    });
    $("#city").change(function(){
        $.get('{{route('admin.regional.subdistrict')}}', {city : $("#city").val()}, function(result) {
            $("#subdistrict").html(result);
        }, "html");
    });
</script>
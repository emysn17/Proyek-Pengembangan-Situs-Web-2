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
                        Data Supir
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
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">Nama</label>
                            <input type="text" class="form-control" id="nama_supir" name="nama_supir" placeholder="Masukkan Nama Supir..." value="{{ $data->nama_supir }}">
                        </div>
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">Foto</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" value="{{ $data->gambar }}">
                        </div>
                        <div class="col-lg-4 mb-5">
                            <label for="province" class="required form-label">Provinsi</label>
                            <select class="form-control" name="province_id" id="province" class="form-control"></select>                
                        </div>
                        <div class="col-lg-4 mb-5">
                            <label for="city" class="required form-label">Kota</label>
                            <select class="form-control" id="city" name="city_id"></select>
                        </div>
                        <div class="col-lg-4 mb-5">
                            <label for="subdistrict" class="required form-label">Kecamatan</label>
                            <select class="form-control" id="subdistrict" name="subdistrict_id"></select>
                        </div>
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat Supir..." value="{{ $data->alamat }}">
                        </div>
                        <div class="col-lg-12 mb-5">
                            <label for="condition" class="required form-label">No. Telepon</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan Nomor Telepon Supir..." value="{{ $data->no_hp }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="min-w-150px mt-10 text-end">
                            @if ($data->id)
                            <button id="tombol_simpan" onclick="handle_upload('#tombol_simpan','#form_input','{{route('admin.supir.update',$data->id)}}','PATCH');" class="btn btn-sm btn-primary">Simpan</button>
                            @else
                            <button id="tombol_simpan" onclick="handle_upload('#tombol_simpan','#form_input','{{route('admin.supir.store')}}','POST');" class="btn btn-sm btn-primary">Simpan</button>
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
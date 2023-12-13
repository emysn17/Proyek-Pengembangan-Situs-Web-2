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
                        Data Armada
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
                            <label for="condition" class="required form-label">Nama Supir</label>
                            <div class="input-group">
                                <select data-control="select2" data-placeholder="Pilih Supir" id="id_supir" name="id_supir" class="form-select form-select-solid">
                                    <option SELECTED DISABLED >Pilih Supir</option>
                                    @foreach ($supirs as $item)
                                        <option value="{{ $item->id }}" {{$item->id==$data->id_supir?"selected":""}}>{{ $item->nama_supir }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-5">
                            <label for="condition" class="required form-label">Kapasitas</label>
                            <input type="int" class="form-control" id="kapasistas" name="kapasistas" placeholder="Masukkan Kapasitas Armada..." value="{{ $data->kapasitas }}">
                        </div>
                        <div class="col-lg-4 mb-5">
                            <label for="condition" class="required form-label">No. Pintu</label>
                            <input type="int" class="form-control" id="no_pintu" name="no_pintu" placeholder="Masukkan No. Pintu..." value="{{ $data->no_pintu }}">
                        </div>
                        <div class="col-lg-4 mb-5">
                            <label for="condition" class="required form-label">No. Polisi</label>
                            <input type="text" class="form-control" id="no_polisi" name="no_polisi" placeholder="Masukkan No. Polisi..." value="{{ $data->no_hp }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="min-w-150px mt-10 text-end">
                            @if ($data->id)
                            <button id="tombol_simpan" onclick="handle_upload('#tombol_simpan','#form_input','{{route('admin.armada.update',$data->id)}}','PATCH');" class="btn btn-sm btn-primary">Simpan</button>
                            @else
                            <button id="tombol_simpan" onclick="handle_upload('#tombol_simpan','#form_input','{{route('admin.armada.store')}}','POST');" class="btn btn-sm btn-primary">Simpan</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    obj_select('nama_supir', 'Pilih Pasien');
</script>
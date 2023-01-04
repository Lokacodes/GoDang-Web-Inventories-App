@extends('index')

@section('content')
    <div class="row">
        <div class="col-md-8 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title"></p>
                    <form class="form-sample">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3">Kode Barang</label>:
                                    <div class="col-sm-8">
                                        {{ $det->kode_barang }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3">Nama Barang</label>:
                                    <div class="col-sm-8">
                                        {{ $det->nama_barang }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3">Kategori Barang</label>:
                                    <div class="col-sm-8">
                                        {{ $det->kode_kategori }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3">Brand</label>:
                                    <div class="col-sm-8">
                                        {{ $det->kode_brand }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3">Harga Beli</label>:
                                    <div class="col-sm-8">
                                        {{ $det->harga_beli }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3">Harga Jual</label>:
                                    <div class="col-sm-8">
                                        {{ $det->harga_jual }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3">Stok Barang</label>:
                                    <div class="col-sm-8">
                                        {{ $det->stok_barang }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Gambar</p>
                    <img src="{{ '../../../storage/app/images/($post->foto)' }}">
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="/barang/edit/{{ $det->kode_barang }}">
            <button type="button" class="btn btn-primary">EDIT</button>
        </a>
    </div>

    {{-- Button Action --}}
    {{-- <div class="col-md-12 d-grid gap-2 d-md-flex justify-content-md-end">
        <div class="btn-group">
            <a class="btn btn-primary">Action</a>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                id="dropdownMenuSplitButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton1">
                <button class="dropdown-item edit" type="button" id="modal">Edit</button>
                <div class="dropdown-divider"></div>
                <a onclick="javascript:void(0)" type="button" class="dropdown-item red del"
                    data-id="{{ $det->kode_alat }}">Hapus</a>
            </div>
        </div>
    </div> --}}

    {{-- Edit Modal --}}
    {{-- <div class="modal fade" id="addTodoModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Detail Barang</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="ver" id="ver" value="1">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                            <label for="kode_iot">Kode Alat</label>
                            <input type="text" class="form-control form-control-user" id="kode_alat" name="kode_alat"
                                value="{{ $det->kode_alat }}" placeholder="Kode Alat">
                        </div>
                        <div class="form-group">
                            <label for="id_kategori">Kategori</label>
                            <select class="form-control" name="id_kategori" id="id_kategori">
                                <option selected value="-">-</option>
                                @foreach ($kat as $k)
                                    <option value="{{ $k->id_kategori }}">{{ $k->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kode_iot">IoT</label>
                            <select class="form-control" name="kode_iot" id="kode_iot">
                                <option selected value="-">-</option>
                                @foreach ($iot as $i)
                                    <option value="{{ $i->kode_iot }}">{{ $i->nama_iot }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="data">Tempat</label>
                            <input type="text" class="form-control form-control-user" id="tempat" name="tempat"
                                value="{{ $det->tempat }}" placeholder="Tempat">
                        </div>
                        <span id="taskError" class="alert-message"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-user btn-block" id="tambah"
                    type="submit">Save</button>
                <button type="button" class="btn btn-google btn-user btn-block" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--JS Modal-->
@push('page-script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#modal').click(function() {
                $('#addTodoModal').modal('show');
                $('#ver').val("1");
            });
            $('#tambah').click(function() {
                let kode_alat = $('#kode_alat').val();
                let kode_iot = $('#kode_iot').val();
                let tempat = $('#tempat').val();
                let id_kategori = $('#id_kategori').val();
                var ver = $('#ver').val();

                // Edit Process
                if (kode_iot != "" && kode_alat != "" && tempat != "" && id_kategori != "" && ver ==
                    "1") {
                    $.ajax({
                        url: "/alat/edit",
                        type: "POST",
                        data: {
                            _token: $("#csrf").val(),
                            kode_iot: kode_iot,
                            kode_alat: kode_alat,
                            tempat: tempat,
                            id_kategori: id_kategori,
                        },
                        success: function(data) {
                            if (data)
                                alert(data.message);
                            window.location = "/alat";
                        },
                        error: function(response) {
                            let data = response.responseJSON.error;
                            $.each(data, function(key, value) {
                                alert(data);
                            });
                            alert(data);
                        }
                    });
                } else {
                    alert('Lengkapi isian data !');
                }
            });

        });
    </script>
@endpush --}}
@endsection

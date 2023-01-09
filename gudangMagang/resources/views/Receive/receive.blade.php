@extends('index')
@section('content')
    <form class="user" action="">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Receiving</h4>
                        <div class="form-group">
                            <label for="carisuppli">Input Nama Supplier</label>
                            <input type="text" class="form-control form-control-user" id="carisuppli" name="carisuppli"
                                placeholder="Masukkan Nama Supplier" aria-label="Search" aria-describedby="basic-addon2">
                            <input type="hidden" name="_token" id="csrf" value="{{ Session::token() }}">
                        </div>
                        <div class="form-group">
                            <label for="carisuppli">Daftar Nama Supplier</label>
                            <select class="js-example-basic-single w-100" name="carisuppli" id="carisuppli"
                                aria-label="Search" aria-describedby="basic-addon2">
                                <option selected value="-">-</option>
                                @foreach ($receive as $r)
                                    <option value="{{ $r->kode_supplier }}">{{ $r->nama_supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail Informasi Supplier</h4>
                        <div class="form-group row">
                            <div class="col">
                                <label>Kode Supplier</label>
                                <div class="form-group">
                                    <input class="typeahead" type="text" id="kode_supplier" name="kode_supplier"
                                        placeholder="Kode Supplier" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <label>Alamat Supplier</label>
                                <div class="form-group">
                                    <input class="typeahead" type="text" id="alamat" name="alamat"
                                        placeholder="Alamat Supplier" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-12 grid-margin " id="barang" >
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Masukkan Data Barang</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nama Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="caribarang" id="caribarang" value=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kode Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" value=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Harga Beli</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="harga_beli" id="harga_beli" value=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Harga Jual</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="harga_jual" id="harga_jual" value=""/>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            {{-- <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tanggal Terima</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="tanggal" id="tanggal" value="" />
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Stok Barang</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="stok_barang" id="stok_barang" value=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Supplier</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="kode_supplier"
                                            id="kode_supplier" value=""/>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('page-script')
        <script type="text/javascript">
            $(document).ready(function() {
                //Input Barang Receive
                let barang = document.getElementById('barang');
                barang.style.visibility = 'hidden';

                //Card Detail Supplier
                $("#carisuppli").autocomplete({
                    source: function(request, response) {
                        // Fetch data
                        $.ajax({
                            url: "/receiving/supply",
                            type: 'post',
                            dataType: "json",
                            data: {
                                _token: $("#csrf").val(),
                                search: request.term
                            },
                            success: function(data) {
                                response(data);

                            }
                        });
                    },
                    select: function(event, ui) {
                        $('#carisuppli').val(ui.item.value);
                        $('#kode_supplier').val(ui.item.kode);
                        $('#alamat').val(ui.item.alamat);
                        barang.style.visibility = 'visible';

                        return false;
                    }
                });

                //Card Input 
                $("#caribarang").autocomplete({
                    source: function(request, response) {
                        // Fetch data
                        $.ajax({
                            url: "{{ route('barang') }}",
                            type: 'post',
                            dataType: "json",
                            data: {
                                _token: $("#csrf").val(),
                                search: request.term
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                    },
                    select: function(event, ui) {
                        // Set selection
                        $('#caribarang').val(ui.item.value); // display the selected text
                        $('#kode_buku').val(ui.item.label1); // save selected id to input
                        $('#stok_barang').val(ui.item.label2); // save selected id to input
                        return false;
                    }
                });
                // $("#barang").autocomplete({
                //     source: function(request, response) {
                //         // Fetch data
                //         $.ajax({
                //             url: "{{ route('barang') }}",
                //             type: 'post',
                //             dataType: "json",
                //             data: {
                //                 _token: $("#csrf").val(),
                //                 search: request.term
                //             },
                //             success: function(data) {
                //                 response(data);

                //             }
                //         });
                //     },
                //     select: function(event, ui) {
                //         $('#barang').val(ui.item.value);
                //         $('#kode_barang').val(ui.item.kode);
                //         // $('#harga_beli').val(ui.item.beli);
                //         // $('#harga_jual').val(ui.item.jual);
                //         $('#stok_barang').val(ui.item.stok);
                //         // $('#kode_supplier').val(ui.item.supply);

                //         return false;
                //     }
                // });
            });
        </script>
    @endpush
@endsection

@extends('layout.layout')

@section('css')
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet"
        href="{{ asset('stisla/node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/codemirror/theme/duotone-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/node_modules/selectric/public/selectric.css') }}">
@endsection

@section('content')
    <!-- Main Content -->
    <div class="section-header">
        <h1>Produk Katalog</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="/products">Produk Katalog</a></div>
            <div class="breadcrumb-item">Tambah Data</div>
        </div>
    </div>

    <form action="/storeProduct" method="POST" enctype="multipart/form-data">
        <div class="section-body">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Produk</h4>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                @csrf
                                <label>Nama</label>
                                <input type="text" class="form-control {{ isset($invalid) ? 'is-invalid' : '' }}"
                                    required="" name="nama">
                                <div class="invalid-feedback">
                                    Field Ini Harus Diisi
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Harga per Unit</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp
                                        </div>
                                    </div>
                                    <input type="number" class="form-control {{ isset($invalid) ? 'is-invalid' : '' }}"
                                        id="harga" required="" name="harga">
                                    <div class="invalid-feedback">
                                        Field Ini Harus Diisi
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" class="form-control {{ isset($invalid) ? 'is-invalid' : '' }}"
                                    required="" name="stok">
                                <div class="invalid-feedback">
                                    Field Ini Harus Diisi
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" class="form-control {{ isset($invalid) ? 'is-invalid' : '' }}"
                                    required="" name="image">
                                <div class="invalid-feedback">
                                    Field Ini Harus Diisi
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Deskripsi Produk</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <div class="col-sm-12 col-md-12">
                                    <textarea class="summernote-simple form-control {{ isset($invalid) ? 'is-invalid' : '' }}" name="desc"
                                        required=""></textarea>
                                </div>
                                <div class="invalid-feedback">
                                    Field Ini Harus Diisi
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <div class="col-sm-12 col-md-7">
                                    <input class="btn btn-primary" type="submit" value="Tambahkan">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script src="{{ asset('stisla/node_modules/summernote/dist/summernote-bs4.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/codemirror/lib/codemirror.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/codemirror/mode/javascript/javascript.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/selectric/public/jquery.selectric.min.js') }}"></script>

    <script src="{{ asset('stisla/node_modules/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('stisla/node_modules/selectric/public/jquery.selectric.min.js') }}"></script>

    <script src="{{ asset('stisla/assets/js/page/forms-advanced-forms.js') }}"></script>
@endsection

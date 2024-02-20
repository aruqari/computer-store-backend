@extends('layout.layout')

@section('content')
    <!-- Main Content -->
    <div class="section-header">
        <h1>Produk Katalog</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Produk Katalog</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Produk</h4>
                    </div>

                    <div class="card-body">
                        <a href="/products/add" class="btn btn-primary mb-3">Tambah</a>
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered table-md">
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                                @foreach ($katalog as $item)
                                    <tr>
                                        <td>{{ $item->id_katalog }}</td>
                                        <td style="max-width: 50vh">{{ $item->nama }}</td>
                                        <td>{{ 'Rp ' . number_format($item->harga, 2, ',', '.') }}</td>
                                        <td>{{ $item->stok }}</td>
                                        <td style="min-width: 10vh">
                                            <form action="/destroyProduct" method="post">
                                                <a href="#" class="btn btn-sm btn-primary rounded-pill"
                                                    data-toggle="modal" data-target="#detailModal{{ $item->id_katalog }}"
                                                    id="detail{{ $item->id_katalog }}">Detail</a>
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <input type="hidden" name="id_katalog" value="{{ $item->id_katalog }}">
                                                <input type="submit" href="#"
                                                    class="btn btn-sm btn-danger rounded-pill" value="Hapus">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        {{ $katalog->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@foreach ($katalog as $item)
    <div class="modal fade" tabindex="-1" role="dialog" id="detailModal{{ $item->id_katalog }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail {{ $item->id_katalog }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body d-flex flex-column">
                    <div class="d-flex justify-content-center">

                        <img src="{{ asset('file_uploads/' . $item->image) }}" alt="{{ $item->id_katalog }}"
                            style="width: 30vh" class="">
                    </div>
                    <p style="white-space: pre-wrap">{!! $item->desc !!}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <a href="/products/edit/{{ $item->id_katalog }}" class="btn btn-primary">Edit</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

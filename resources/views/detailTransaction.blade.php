@extends('layout.layout')

@section('content')
    <!-- Main Content -->
    <div class="section-header">
        <h1>Transaksi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="/transaksi">Transaksi</a></div>
            <div class="breadcrumb-item">Detail Transaksi</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Transaksi</h4>
                    </div>

                    <div class="card-body">
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
                                    <th>Gambar</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>QTY</th>
                                    <th>Subtotal</th>
                                </tr>
                                @foreach ($detail as $item)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('file_uploads/' . $item->image) }}" alt=""
                                                width="30vh">
                                        </td>
                                        <td>{{ $item->id_katalog }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->harga }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td style="min-width: 30vh">
                                            {{ 'Rp ' . number_format($item->subtotal, 2, ',', '.') }}</td>

                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        Total Harga :{{ 'Rp ' . number_format($total_harga, 2, ',', '.') }}
                        {{-- {{ $katalog->links() }} --}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

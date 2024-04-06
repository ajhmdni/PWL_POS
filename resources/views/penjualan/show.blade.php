@extends('layouts.template')
@section('content')
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title">{{ $page->title }}</h3>
      <div class="card-tools"></div>
    </div>
    <div class="card-body">
      @empty($penjualan)
        <div class="alert alert-danger alert-dismissible">
          <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
          Data yang Anda cari tidak ditemukan.
        </div>
      @else
        <table class="table table-bordered table-striped table-hover table-sm">
          <tr>
            <th>ID</th>
            <td>{{ $penjualan->penjualan_id }}</td>
          </tr>
          <tr>
            <th>Nama User</th>
            <td>{{ $penjualan->user->nama }}</td>
          </tr>
          <tr>
            <th>Nama Pembeli</th>
            <td>{{ $penjualan->pembeli }}</td>
          </tr>
          <tr>
            <th>Kode Penjualan</th>
            <td>{{ $penjualan->penjualan_kode }}</td>
          </tr>
          <tr>
            <th>Tanggal Penjualan</th>
            <td>{{ $penjualan->penjualan_tanggal }}</td>
          </tr>
        </table>

        <div id="detail_penjualan" class="mt-3">
          <h6>Rician Penjualan</h6>
          @if ($penjualan->penjualan_detail)
          <table class="table table-bordered table-striped table-hover table-sm">
            <thead>
              <th>Nama Barang</th>
              <th>Harga</th>
              <th>Jumlah</th>
            </thead>
            <tbody>
              @foreach ($penjualan->penjualan_detail as $sale)
                <tr>
                  <td>{{ $sale->barang->barang_nama }}</td>
                  <td>{{ $sale->harga }}</td>
                  <td>{{ $sale->jumlah }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
          @endif
        </div>
      @endempty
      <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
  </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
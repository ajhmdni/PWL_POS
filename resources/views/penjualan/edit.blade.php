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
      <a href="{{ url('stok') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
      @else
        <form method="POST" action="{{ url('/penjualan/'.$penjualan->penjualan_id) }}" class="form-horizontal">
          @csrf
          {!! method_field('PUT') !!}
          <div class="form-group row">
            <label class="col-1 control-label col-form-label">User</label>
            <div class="col-11">
              <select class="form-control" id="user_id" name="user_id" required>
                <option value="">- Pilih User -</option>
                @foreach($users as $user)
                  <option value="{{ $user->user_id }}" @if (old('user_id', $penjualan->user_id) === $user->user_id) selected=true @endif >{{ $user->nama }}</option>
                @endforeach
              </select>
              @error('user_id')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-1 control-label col-form-label">Pembeli</label>
            <div class="col-11">
              <input type="text" class="form-control" id="pembeli" name="pembeli" value="{{ old('pembeli', $penjualan->pembeli) }}" required>
              @error('pembeli')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-1 control-label col-form-label">Penjualan Kode</label>
            <div class="col-11">
              <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode" value="{{ old('penjualan_kode', $penjualan->penjualan_kode) }}" required>
              @error('penjualan_kode')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label class="col-1 control-label col-form-label">Tanggal Penjualan</label>
            <div class="col-11">
              <input type="datetime-local" class="form-control" id="penjualan_tanggal" name="penjualan_tanggal" value="{{ old('penjualan_tanggal', $penjualan->penjualan_tanggal) }}" required>
              @error('penjualan_tanggal')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>
          
          @if ($penjualan_details)
            <div class="card mt-5 mb-3 card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Rincian Penjualan</h3>
                <div class="card-tools"></div><br/>
                <div id="detail_penjualan" class="d-flex flex-column">
                  @foreach ($penjualan_details as $detail)
                    <div><hr/>
                      <input type="hidden" value="{{ $detail->detail_id }}" name="detail_id[]">
                      <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Barang</label>
                        <div class="col-11">
                          <select class="form-control" id="barang_id" name="barang_id[]" required>
                            <option value="">- Pilih Barang -</option>
                            @foreach($products as $product)
                              <option value="{{ $product->barang_id }}" @if ( $detail->barang_id === $product->barang_id) selected=true @endif >{{ $product->barang_nama }}</option>
                            @endforeach
                          </select>
                          @error('barang_id')
                          <small class="form-text text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Harga</label>
                        <div class="col-11">
                          <input type="number" class="form-control" id="harga" name="harga[]" value="{{ $detail->harga }}" required>
                          @error('harga')
                          <small class="form-text text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Jumlah</label>
                        <div class="col-11">
                          <input type="number" class="form-control" id="jumlah" name="jumlah[]" value="{{ $detail->jumlah }}" required>
                          @error('jumlah')
                          <small class="form-text text-danger">{{ $message }}</small>
                          @enderror
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
          @endif

          <div class="form-group row">
            <div class="col-11">
              <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
              <a class="btn btn-sm btn-default ml-1" href="{{ url('penjualan') }}">Kembali</a>
            </div>
          </div>
        </form>
      @endempty
    </div>
  </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush
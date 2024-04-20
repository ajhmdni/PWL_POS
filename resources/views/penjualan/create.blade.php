@extends('layouts.template')
@section('content')
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title">{{ $page->title }}</h3>
      <div class="card-tools"></div>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ url('penjualan') }}" class="form-horizontal">
        @csrf
        <div class="form-group row">
          <label class="col-1 control-label col-form-label">User</label>
          <div class="col-11">
            <select class="form-control" id="user_id" name="user_id" required>
              <option value="">- Pilih User -</option>
              @foreach($users as $user)
                <option value="{{ $user->user_id }}" @if (old('user_id') === $user->user_id) selected=true @endif >{{ $user->nama }}</option>
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
            <input type="text" class="form-control" id="pembeli" name="pembeli" value="{{ old('pembeli') }}" required>
            @error('pembeli')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>
        <div class="form-group row">
          <label class="col-1 control-label col-form-label">Kode Penjualan</label>
          <div class="col-11">
            <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode" value="{{ old('penjualan_kode') }}" required>
            @error('penjualan_kode')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>
        <div class="form-group row">
          <label class="col-1 control-label col-form-label">Tanggal</label>
          <div class="col-11">
            <input type="datetime-local" class="form-control" id="penjualan_tanggal" name="penjualan_tanggal" value="{{ old('penjualan_tanggal') }}" required>
            @error('penjualan_tanggal')
            <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>
        <div class="card mt-5 mb-3 card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Detail Penjualan</h3>
            <div class="card-tools"></div><br/>
            <div id="detail_penjualan" class="d-flex flex-column">
              {{-- detail penjualan --}}
            </div>
          </div>
        </div>
        <button type="button" id="btn_detail_penjualan" class="btn btn-primary btn-sm mb-3">
          <i class="fas fa-plus"></i> Tambah Detail Penjualan
        </button>
        <div class="form-group row">
          <div class="col-11">
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            <a class="btn btn-sm btn-default ml-1" href="{{ url('stok') }}">Kembali</a>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('css')
@endpush

@push('js')
<script>
  $(document).ready(function() {
    let formInputAmount = 0;

    $('#btn_detail_penjualan').on('click', function() {
      createInputFormDetailPenjualan();
    });
    
    const createInputFormDetailPenjualan = () => {
      formInputAmount++;
      const formElement = $(`
        <div class="my-3">
          <h6>Detail penjualan ke-${formInputAmount}</h6>
          <div class="form-group row">
            <label class="col-1 control-label col-form-label">Barang</label>
            <div class="col-11">
              <select class="form-control" id="barang_id" name="barang_id[]" required>
                <option value="">- Pilih Barang -</option>
                @foreach($products as $product)
                  <option value="{{ $product->barang_id }}" >{{ $product->barang_nama }}</option>
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
              <input type="number" class="form-control" id="harga" name="harga[]" required>
              @error('harga')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>  
          <div class="form-group row">
            <label class="col-1 control-label col-form-label">Jumlah</label>
            <div class="col-11">
              <input type="number" class="form-control" id="jumlah" name="jumlah[]" required>
              @error('jumlah')
              <small class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>   
        </div>
      `);

      $('#detail_penjualan').append(formElement);
    }
  });
</script>
@endpush
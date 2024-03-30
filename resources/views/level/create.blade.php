@extends('layouts.app')

@section('subtitle', 'Level')
@section('content_header_title', 'Level')
@section('content_header_subtitle', 'Create')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Level</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="/level/store" method="POST"> 
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="kodeLevel">Kode Level</label>
                <input
                  type="text"
                  name="kodeLevel"
                  class="form-control @error('kodeLevel') is-invalid @enderror"
                  id="kodeLevel"
                  placeholder="Masukkan Kode Level">

                  @error('kodeLevel')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

              </div>
              <div class="form-group">
                <label for="namaLevel">Nama Level</label>
                <input 
                  type="text" 
                  name="namaLevel" 
                  class="form-control @error('namaLevel') is-invalid @enderror" 
                  id="namaLevel" 
                  placeholder="Masukkan Nama Level">

                  @error('namaLevel')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <!-- /.card -->
        </div>
      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-6">

      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection


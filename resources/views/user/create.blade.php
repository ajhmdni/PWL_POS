@extends('layouts.app')

@section('subtitle', 'User')
@section('content_header_title', 'User')
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
            <h3 class="card-title">Tambah User</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="/user/store" method="POST"> 
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="username">Username</label>
                <input
                  type="text"
                  name="username"
                  class="form-control @error('username') is-invalid @enderror"
                  id="username"
                  placeholder="Masukkan Username">

                  @error('username')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

              </div>
              <div class="form-group">
                <label for="nama">Nama</label>
                <input 
                  type="text" 
                  name="nama" 
                  class="form-control @error('nama') is-invalid @enderror" 
                  id="nama" 
                  placeholder="Masukkan Nama">

                  @error('nama')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input 
                  type="password" 
                  name="password" 
                  class="form-control @error('password') is-invalid @enderror" 
                  id="password" 
                  placeholder="Masukkan Password">

                  @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
              </div>
              <div class="input-group mb-3 d-flex flex-column">
                <label for="">Level</label>
                <select 
                  class="form-select w-100 @error('level') is-invalid @enderror" 
                  id="level" 
                  name="level">

                  @if (!empty($levels))
                    @foreach ($levels as $level)
                        <option value="{{ $level->level_id }}">{{ $level->level_nama }}</option>
                    @endforeach
                  @endif

                  @error('level')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror

                </select>
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


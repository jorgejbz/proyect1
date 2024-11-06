@extends('admin.layout.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Administracíon</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Actualizar Contraseña</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header --> 
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <!-- Centered column -->
      <div class="col-md-7">
        <!-- General form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Actualizar Contraseña jeje</h3>
          </div>
            <!-- /.card-header -->
            {{-- eror de inicio de sesion --}}
      @if(Session::has('error_message'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top: 5px">
        <strong>Error!</strong> {{Session::get('error_message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      @endif
      @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 5px">
        <strong>Success!</strong> {{Session::get('success_message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      @endif
            <!-- form start -->
            <form method="post" action="{{url('/admin/update-password')}}">@csrf
              <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Correo Electronico</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" value="{{Auth::guard('admin')->user()->email}}" readonly="">
                </div>
                <div class="form-group">
                    <label for="current_pwd">Actual Contraseña</label>
                    <input type="password" class="form-control" id="current_pwd" name="current_pwd" placeholder="Actual Contraseña"><span id="verifyCurrentPwd"></span>
                </div>
                    <label for="new_pwd">Nueva Contraseña</label>
                    <input type="password" class="form-control" id="new_pwd" name="new_pwd" placeholder="Nueva Contraseña">
                <div class="form-group">
                    <label for="confirm_pwd">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="confirm_pwd" name="confirm_pwd" placeholder="Confirmar Contraseña">
            </div>
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
@endsection
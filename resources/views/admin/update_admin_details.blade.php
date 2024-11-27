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
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}" style="color: #A9AC5D">Inicio</a></li>
              <li class="breadcrumb-item active">Actualizar Perfil de Administracíon</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header --> 
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Profile Image (Left Column) -->
          <div class="col-md-3">
            <div class="card card-primary card-outline" style="border: none">
              <!-- Título del card -->
              <div class="card-header">
                <h3 class="card-title" style="color">Perfil del Administrador</h3>
              </div>
              <div class="card-body box-profile">
                <div class="text-center">
                  @if(!empty(Auth::guard('admin')->user()->image))
                  <img src="{{ asset('admin/img/adminimg/'.Auth::guard('admin')->user()->image) }}" class="profile-user-img img-fluid img-circle" alt="User Image">
          @else
          <img src="{{ asset('admin/img/no-images.jpg') }}" class="profile-user-img img-fluid img-circle" alt="User Image">
          @endif
                </div>

                <!-- Nombre del usuario autenticado -->
            <h3 class="profile-username text-center">{{ Auth::guard('admin')->user()->name }}</h3>

            <!-- Título/rol -->
            <p class="text-muted text-center">Administrador/Ingeniero de Software</p>

            <!-- Información del administrador -->
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Email</b> 
                <a class="float-right">{{ Auth::guard('admin')->user()->email }}</a>
              </li>
              <li class="list-group-item">
                <b>Telefono</b> 
                <a class="float-right">{{ Auth::guard('admin')->user()->mobile }}</a>
              </li>
            </ul>
            </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <!-- Update Admin Details (Right Column) -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-header" style="background-color: #A9AC5D">
                <h3 class="card-title" style="color: #E8E1DB; font-weight: bold;">Actualizar Detalles del Admin</h3>
              </div>
              <!-- /.card-header -->
              
              {{-- Mensaje de error --}}
              @if(Session::has('error_message'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top: 5px">
                  <strong>Error!</strong> {{Session::get('error_message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif

              {{-- Mensaje de éxito --}}
              @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 5px">
                  <strong>Success!</strong> {{Session::get('success_message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
                
              @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 5px">
                <ul>
              @foreach ($errors->all() as $error)
              <li>{{$error}}</li>
              @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif

              <!-- Formulario -->
              <form method="post" action="{{url('/admin/update-admin-details')}}" enctype="multipart/form-data">@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="admin_email">Correo Electrónico</label>
                    <input class="form-control" id="admin_email" value="{{Auth::guard('admin')->user()->email}}" readonly style="">
                  </div>
                  <div class="form-group">
                    <label for="admin_name">Nombre</label>
                    <input type="text" class="form-control" name="admin_name" value="{{Auth::guard('admin')->user()->name}}">
                  </div>
                  <div class="form-group">
                    <label for="admin_mobile">Teléfono</label>
                    <input type="text" name="admin_mobile" class="form-control" value="{{Auth::guard('admin')->user()->mobile}}">
                  </div>
                  <div class="form-group">
                    <label for="admin_image">Imagen de Administrador</label>
                    <input name="admin_image" type="file" class="form-control">
                    @if(!empty(Auth::guard('admin')->user()->image))
                    <a target="_blank" href="{{url('admin/img/adminimg/'.Auth::guard('admin')->user()->image)}}" style="color:black">Ver Imagen</a>
                    <input type="hidden" name="current_image" value="{{Auth::guard('admin')->user()->image}}">
                    @endif
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" style="background-color: #A9AC5D; outline: none; border: none;">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
</div>
@endsection

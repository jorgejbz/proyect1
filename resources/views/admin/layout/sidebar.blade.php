 <!-- Main Sidebar Container -->
 <aside class="main-sidebar elevation-4">
  <link rel="stylesheet" href="{{ asset('public/admin/css/led-controler.css') }}">

    <!-- Brand Logo -->
    <a href="{{url('admin/dashboard')}}" class="brand-link">
      <img src="{{ asset('admin/img/EcoTrack.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"style="color:#A9AC5D">EcoTrack</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background-color: #362E23">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(!empty(Auth::guard('admin')->user()->image))
          <img src="{{ asset('admin/img/adminimg/'.Auth::guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="User Image">
          @else
          <img src="{{ asset('admin/img/no-images.jpg') }}" class="img-circle elevation2" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="{{url('admin/update-admin-details')}}" class="d-block" readonly style="color: #A9AC5D">{{ Auth::guard('admin')->user()->name }}</a>
        </div>
        
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            {{-- para hacer otra seccion copiar de aqui --}}

                  {{-- hace que se seleccione en color contrastante la seccion activa --}}
                  @if(Session::get('page')=="dashboard" ||
                  Session::get('page')=="update-admin-details" || Session::get('page')=="update-password" || Session::get('page')=="add-admin")
                  <?php $active = "active"; ?>
                  @else
                  <?php $active = ""; ?>
                  @endif
              <li class="nav-item menu-open">
            <a href="#" class="nav-link {{$active}}" ">
              <i class="nav-icon fas fa-user-alt"></i>
              <p style="color: #E8E1DB">
                Administracíon
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
                        {{-- hasta aqui --}}
            {{-- para agregar cosas en esa seccion copiar de aqui --}}
            <ul class="nav nav-treeview">
                  @if(Session::get('page')=="update-password")
                  <?php $active = "active"; ?>
                  @else
                  <?php $active = ""; ?>
                  @endif
              <li class="nav-item">
                <a href="{{url('admin/update-password')}}" class="nav-link {{$active}}" >
                  <i class="far fa-circle nav-icon"></i>
                  <p style="color: #E8E1DB">Actualizar Contraseña</p>
                </a>
              </li>
                      {{-- hasta aqui y pegar abajo dependiendo de cuantas quieras agregar si quieres mas repite el proceso como abajo --}}
                      {{-- inicio --}}
                  @if(Session::get('page')=="update-admin-details")
                  <?php $active = "active"; ?>
                  @else
                  <?php $active = ""; ?>
                  @endif              <li class="nav-item">
                <a href="{{url('admin/update-admin-details')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p style="color: #E8E1DB">Ver Perfil</p>
                </a>
              </li>
              {{-- fin --}}
                  @if(Session::get('page')=="add-admin")
                  <?php $active = "active"; ?>
                  @else
                  <?php $active = ""; ?>
                  @endif
              <li class="nav-item">
                <a href="{{url('admin/add-admin')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p style="color: #E8E1DB">Registrar Mas Admins</p>
                </a>
              </li>
            </ul>
          </li>
           {{-- para hacer otra seccion copiar de aqui --}}
          @if(Session::get('page') == "user-list" || Session::get('page')=="store" || Session::get('page') == "led.control" || Session::get('page') == "capacity.control")
          <?php $active = "active"; ?>
          @else
          <?php $active = ""; ?>
          @endif
          <li class="nav-item menu-open">
          <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-file"></i>
              <p style="color: #E8E1DB">App Movil
                  <i class="right fas fa-angle-left"></i>
              </p>
          </a>
{{-- hasta aqui --}}
            {{-- para agregar cosas en esa seccion copiar de aqui --}}
            <ul class="nav nav-treeview">
                @if(Session::get('page') == "user-list")
                    <?php $active = "active"; ?>
                @else
                    <?php $active = ""; ?>
                @endif
                <li class="nav-item">
                    <a href="{{url('admin/user-list')}}" class="nav-link {{$active}}">
                        <i class="far fa-circle nav-icon"></i>
                        <p style="color: #E8E1DB">Lista de Usuarios</p>
                    </a>
                </li>
                {{-- hasta aqui y pegar abajo dependiendo de cuantas quieras agregar --}}
                @if(Session::get('page') == "led.control")
                    <?php $active = "active"; ?>
                @else
                    <?php $active = ""; ?>
                @endif
                <li class="nav-item">
                    <a href="{{ url('admin/prueba') }}" class="nav-link {{ $active }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p style="color: #E8E1DB">ESP32 1</p>
                    </a>
                </li>
                {{-- hasta aqui y pegar abajo dependiendo de cuantas quieras agregar --}}
                @if(Session::get('page') == "capacity.control") {{--el capacity control viene desde el web.php--}}
                <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
                @endif
                <li class="nav-item">
                <a href="{{ url('admin/capacitycontrol') }}" class="nav-link {{ $active }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p style="color: #E8E1DB">ESP32 ULTRASONIDO</p>
                </a>
                </li>
            </ul>
            </li>
/*
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
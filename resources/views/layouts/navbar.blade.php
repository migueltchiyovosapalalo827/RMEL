 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>


    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

     <li class="nav-item dropdown has-treeview">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-fw fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="{{ route('user.show',Auth::user()->id) }}" class="dropdown-item">
              <i class="fa fa-user-plus" aria-hidden="true"></i>
         Perfil
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
              <i class="fas fa-exchange-alt "></i>
          Mudar Senha
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ url('/logout') }}"
                      onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();" class="dropdown-item">
           <i class="fas fa-sign-out-alt "></i>
            Sair
          </a>
          <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
        </div>
      </li>

  </nav>
  <!-- /.navbar -->


  @section('sidebar')
  @parent
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{asset('dist/img/logotipoMed.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">RMEL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
             {!! App\Uteis\Menu::build(Auth::user()) !!}
           <!--    @can('admin')
   <li  class="nav-item has-treeview ">
<a class="nav-link " href="" >
  <i class="fas fa-fw  fa-book  "></i>
<p> Administração
  <i class="fas fa-angle-left right"></i>

 </p>
</a>

<ul class="nav nav-treeview">
    <li  class="nav-item">
<a class="nav-link" href="{{route('user.index')}}"        >
 <i class="fas fa-fw   fa-users "></i>
<p> Usuarios </p></a></li>

<li  class="nav-item">
<a class="nav-link" href="{{route('user.create')}}"        >
 <i class="fas fa-user-plus"></i>
    <p>Casdastrar novo usuario </p>
</a>
</li>
</ul>

</li>
<li  class="nav-item">
<a class="nav-link" href="{{route('escola.index')}}"        >
 <i class="fas fa-fw  fa-university  "></i>
 <p> Escolas </p>
</a>
</li>
    <li  class="nav-item">
<a class="nav-link" href="{{route('docente.index')}}"        >
 <i class="fas fa-fw   s fa-user-secret    "></i>
 <p> funcionario das escolas</p>
</a>
</li>
<li  class="nav-item">
<a class="nav-link" href="{{route('disciplina.create')}}"        >
<i class="fas fa-book"></i>
    <p>desciplinas </p>
</a>

</li>

<li  class="nav-item">

    <a class="nav-link" href="{{route('ciclo.index')}}"        >
    <i class="fas fa-book"></i>
      <p>ciclo </p>
    </a>
</li>
<li  class="nav-item">

<a class="nav-link" href="{{route('classe.index')}}"        >
<i class="fas fa-book"></i>
  <p>classes </p>
</a></li>
<li  class="nav-item">
<a class="nav-link  "href="{{route('aproveitamento.index')}}"  >
    <i class="fas fa-chart-area"></i>
<p>aproveitamentos</p>
</a>
</li>
<li  class="nav-item">
<a class="nav-link"href="{{route('documento.index')}}" >
    <i class="yellow "></i>
    <i class="fas fa-folder    "></i>
    <p> documentos</p>
</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('relatorio')}}">
    <i class="fa fa-history" aria-hidden="true"></i>
    <p>Relatorios</p>
    </a>
    </li>
@endcan
@can('rh')
   <li  class="nav-item has-treeview ">
<a class="nav-link " href="" >
  <i class="fas fa-fw  fa-book  "></i>
<p> Administração
  <i class="fas fa-angle-left right"></i>

 </p>
</a>

<ul class="nav nav-treeview">
    <li  class="nav-item">
<a class="nav-link" href="{{route('user.index')}}"        >
 <i class="fas fa-fw   fa-users "></i>
<p> Usuarios </p></a></li>

<li  class="nav-item">
<a class="nav-link" href="{{route('user.create')}}"        >
 <i class="fas fa-user-plus"></i>
    <p>Casdastrar novo usuario </p>
</a>
</li>
</ul>

</li>

    <li  class="nav-item">
<a class="nav-link" href="{{route('docente.index')}}"        >
 <i class="fas fa-fw   s fa-user-secret    "></i>
 <p> funcionario das escolas</p>
</a>
</li>


<li  class="nav-item">
<a class="nav-link"href="{{route('documento.index')}}" >
    <i class="yellow "></i>
    <i class="fas fa-folder    "></i>
    <p> documentos</p>
</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('relatorio')}}">
    <i class="fa fa-history" aria-hidden="true"></i>
    <p>Relatorios</p>
    </a>
    </li>
@endcan

@can('SPE')
<li  class="nav-item">
  <a class="nav-link" href="{{route('docente.index')}}">
   <i class="fas fa-fw   s fa-user-secret    "></i>
   <p> funcionario das escolas</p>
  </a>
  </li>
<li  class="nav-item">

    <a class="nav-link" href="{{route('ciclo.index')}}">
    <i class="fas fa-book"></i>
      <p>ciclo </p>
    </a>
</li>

<li  class="nav-item">
<a class="nav-link" href="{{route('escola.index')}}">
 <i class="fas fa-fw  fa-university  "></i>
 <p> Escolas </p>
</a>
</li>

<li  class="nav-item">
<a class="nav-link" href="{{route('disciplina.create')}}">
<i class="fas fa-book"></i>
    <p>desciplinas </p>
</a>

</li>
<li  class="nav-item">

<a class="nav-link" href="{{route('classe.index')}}">
<i class="fas fa-book"></i>
  <p>classes </p>
</a></li>
<li  class="nav-item">
<a class="nav-link  "href="{{route('aproveitamento.index')}}">
    <i class="fas fa-chart-area"></i>
<p>aproveitamentos</p>
</a>
</li>
<li  class="nav-item">
<a class="nav-link"href="{{route('documento.index')}}">
    <i class="yellow "></i>
    <i class="fas fa-folder"></i>
    <p> documentos</p>
</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('relatorio')}}">
    <i class="fa fa-history" aria-hidden="true"></i>
    <p>Relatorios</p>
    </a>
    </li>
@endcan


@can('secretario')

    <li  class="nav-item">

        <a class="nav-link" href="{{route('ciclo.index')}}">
        <i class="fas fa-book"></i>
          <p>ciclo </p>
        </a>
    </li>
    <li  class="nav-item">
    <a class="nav-link" href="{{route('escola.index')}}">
     <i class="fas fa-fw  fa-university  "></i>
     <p> Escolas </p>
    </a>
    </li>
        <li  class="nav-item">
    <a class="nav-link" href="{{route('docente.index')}}">
     <i class="fas fa-fw   s fa-user-secret    "></i>
     <p> funcionario das escolas</p>
    </a>
    </li>
    <li  class="nav-item">
    <a class="nav-link" href="{{route('disciplina.create')}}">
    <i class="fas fa-book"></i>
        <p>desciplinas </p>
    </a>

    </li>
    <li  class="nav-item">

    <a class="nav-link" href="{{route('classe.index')}}">
    <i class="fas fa-book"></i>
      <p>classes </p>
    </a></li>
    <li  class="nav-item">
    <a class="nav-link  "href="{{route('aproveitamento.index')}}">
        <i class="fas fa-chart-area"></i>
    <p>aproveitamentos</p>
    </a>
    </li>
    <li  class="nav-item">
        <a class="nav-link  "href="{{route('matriculas.index')}}">
            <i class="fas fa-chart-area"></i>
        <p>matriculas</p>
        </a>
        </li>
    <li  class="nav-item">
    <a class="nav-link"href="{{route('documento.index')}}">
        <i class="yellow "></i>
        <i class="fas fa-folder"></i>
        <p> documentos</p>
    </a>
    </li>

    @endcan
-->
 </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  @endsection

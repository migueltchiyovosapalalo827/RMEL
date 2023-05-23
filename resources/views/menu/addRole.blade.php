@extends('layouts.starter')
@include ('layouts.sidebar')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menu</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Menu</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content">
<div class="row">
    <div class="col-md-12">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body ">
                <div class="text-center ">

                    <h4>lista de Funções </h4>
                </div>


                <div class="table-responsive">
                <table class="table table-striped custom-table  respon">
                    <thead>
                           <th>menu</th>
                            <th>icon</th>
                            <th> funcao</th>
                    </thead>
                    <tbody>
                        @foreach ($menu->roles as $funcao)
                        <tr>
                            <td>{{$menu->nome}}</td>
                            <td><i class="fas {{$menu->icon}}"></i></td>
                            <td>{{$funcao->name}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>

                <form action="<?= route('menu.sync') ?>" method="post" class="form-horizontal">
                    {{ csrf_field()}}
                    <input type="hidden" name="menu_id" value="{{$menu->id}}">
                     <div class="form-group row">
                         <label class="col-sm-3 col-form-label"> adcionar uma nova função ao menu</label>
                         <div class="col-sm-7">
                         <select class="form-control"  name="role_id">
                             <option value=""> seleciona uma função para menu</option>
                             @foreach($roles as $role)
                             <option value="{{$role->id}}">{{$role->name}}</option>

                             @endforeach

                         </select>
                         </div>
                         <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary btn-block">Adicionar</button>
                        </div>
                       </div>

</form>
                    </tfoot>
                </table>
                </div>


            </div>


            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->


</div>
</section>

@endsection

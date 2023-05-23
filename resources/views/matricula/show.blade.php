@extends('layouts.starter')
@section('title', 'Aproveitamento')

@include ('layouts.sidebar')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Levatamento de Alunos Matriculados  por classes </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Alunos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"> escola {{$escola->nomeescola}}   </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        @forelse ($escola->classes as $item)
        <div class="card-body">
            <div class="row">
              <div class="col-12 col-md-12  ">
                <div class="row">
                  <div class="col-12 col-sm-4">
                    <div class="info-box bg-success">
                      <div class="info-box-content">
                        <span class="info-box-text text-center">Classe</span>
                        <span class="info-box-number text-center mb-0">{{$item->nome}}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-4">
                    <div class="info-box bg-primary">
                      <div class="info-box-content">
                        <span class="info-box-text text-center">ano lectivo</span>
                        <span class="info-box-number text-center mb-0">{{$item->pivot->anolectivo}}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-4">
                    <div class="info-box bg-danger">
                      <div class="info-box-content">
                        <span class="info-box-text text-center">Quantidades de alunos matriculados</span>
                        <span class="info-box-number text-center mb-0"> {{$item->pivot->alunos}} <span>
                      </div>
                    </div>
                  </div>
                </div>
  
              </div>

            </div>
          </div>
        @empty

        @endforelse

        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
@endsection
@section('script')
@parent
<script>
      $( function() {

      $('#datetimepicker4').datetimepicker({
                    format: 'L'
                });
  } );
  $('.select').select2();

</script>
@endsection

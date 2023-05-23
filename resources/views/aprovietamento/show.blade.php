@extends('layouts.starter')
@section('title', 'Aproveitamento')

@include ('layouts.sidebar')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Levatamento de Aproveitamento</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Aproveitamento</li>
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
          <h3 class="card-title"> Detalhes do Aproveitamento  da {{$aproveitamento->classe->nome}} do {{$aproveitamento->trimestre}} Trimestre no ano lectivo {{$aproveitamento->anolectivo}}  da escola  {{ is_null($aproveitamento->escola_id) ? "" : $aproveitamento->escola->nomeescola }} </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-12  ">
              <div class="row">
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-success">
                    <div class="info-box-content">
                      <span class="info-box-text text-center">% De Aproveitamento</span>
                      <span class="info-box-number text-center mb-0">{{$aproveitamento->aproveitamento}}</span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-primary">
                    <div class="info-box-content">
                      <span class="info-box-text text-center">% de Rendimento</span>
                      <span class="info-box-number text-center mb-0">{{$aproveitamento->rendimento}}</span>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-sm-4">
                  <div class="info-box bg-danger">
                    <div class="info-box-content">
                      <span class="info-box-text text-center">% de Abandono</span>
                      <span class="info-box-number text-center mb-0"> {{$aproveitamento->abandono}} <span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <h4>Dados Processados</h4>
                  <dl class="row">
                  <dt class="col-sm-6">Numeros de Alunos matriculados</dt>
                  <dd class="col-sm-6 text-info">{{$aproveitamento->matriculados}}</dd>
                  <dt class="col-sm-6">Numeros de Alunos avaliados</dt>
                  <dd class="col-sm-6 text-primary">{{$aproveitamento->avaliados}}</dd>
                  <dt class="col-sm-6">Numeros de Alunos aprovados</dt>
                  <dd class="col-sm-6 text-success">{{$aproveitamento->aprovados}}</dd>
                  <dt class="col-sm-6">Numeros de Alunos reprovados</dt>
                  <dd class="col-sm-6 text-warning">{{$aproveitamento->reprovados}}</dd>
                  <dt class="col-sm-6 ">Numeros de Alunos desistidos</dt>
                  <dd class="col-sm-6 text-danger">{{$aproveitamento->desistidos}}</dd>
                </dl>
                </div>
              </div>
            </div>

          </div>
        </div>
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

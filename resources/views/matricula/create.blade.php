@extends('layouts.starter')
@section('title', 'matriculas')

@include ('layouts.sidebar')

@section('content')
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Alunos Matriculados por classes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"> Alunos Matriculados por classes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
<div class="row">

    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    <div class="btn-group">
                        <a href="{{ route('matriculas.index') }}" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
            <div class="col-md-12">
        <div class="card card-outline">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link  active " href="#funcionarios" data-toggle="tab">{{'Formulario de Alunos matriculados por classes'}}</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane  active" id="funcionarios">
                    <form action="<?= route('matriculas.store') ?>" method="post" class="form-horizontal">
                           {{ csrf_field()}}
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="nomeCompleto">Ano lectivo</label>
      <input type="text" class="form-control @error('anolectivo') is-invalid @enderror"  value="{{old('anolectivo')}}" id="" placeholder="anolectivo" name="anolectivo" autocomplete="off">

                               @error('anolectivo')
                                <div class="invalid-feedback">
                                    <h6>{{$message}}</h6>
                                </div>
                                @enderror
    </div>


  <div class="form-group  col-md-6">
  <label for="classe">Escola</label>
    <select id="escola" class="form-control select2 @error('escola') is-invalid @enderror"    name="escola">
    <option selected>Seleciona a escola...</option>
        @forelse ($escolas as $escola)

        <option value="{{ $escola->id }}"  {{  old("escola")==$escola->id ? 'selected' : ''}}  >{{ $escola->nomeescola }}</option>
@empty
<option selected>não exite escola cadastrada no momento...</option>
@endforelse
      </select>
    @error('escola')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror
  </div>
  </div>
  <div class="form-row">
    <div class="form-group  col-md-4">
        <label for="classe">Ciclo</label>
          <select id="ciclo" class="form-control select2 @error('classe') is-invalid @enderror" data-placeholder="seleciona o ciclo "    name="ciclo">
           </select>
          @error('classe')
               <div class="invalid-feedback">
                <h6>{{$message}}</h6>
               </div>
               @enderror
        </div>
    <div class="form-group  col-md-4">
        <label for="classe">classe</label>
          <select id="classe" class="form-control select2 @error('classe') is-invalid @enderror"   name="classe">
          <option selected>Seleciona a classe...</option>
              @forelse ($classes as $classe)

              <option value="{{ $classe->id }}"  {{  old("classe")==$classe->id ? 'selected' : ''}}  >{{ $classe->nome }}</option>
          <li></li>
      @empty
      <option selected>não exite classe cadastrada no momento...</option>
      @endforelse
            </select>
          @error('classe')
               <div class="invalid-feedback">
                <h6>{{$message}}</h6>
               </div>
               @enderror
        </div>
  <div class="form-group col-md-4">
      <label for="alunos">Quantidades de Alunos Matriculados</label>
      <input type="number" class="form-control @error('alunos') is-invalid @enderror"  value="{{old('alunos')}}" id="alunos" name="alunos" autocomplete="off">
      @error('alunos')
         <div class="invalid-feedback">
          <h6>{{$message}}</h6>
         </div>
         @enderror

    </div>


  </div>




  <div class="card-footer">
          <div class="form-group row">
                           <div class="col-sm-10">
                               <div class="float-right">
                                   <div class="btn-group">
                                       <button type="submit" class="btn btn-sm btn-block btn-primary">
                                       {{'salvar'}}
                                       </button>
                                   </div>
                               </div>
                           </div>
                       </div>
          </div>
        </div>
     </form>
  </div>

                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
            </div>
        </div>
    </div>
</div>
    </section>
@endsection

@section('script')
@parent
<script>
  $('#escola').change(function(e){
		var escola = $('#escola').val();

		$.getJSON("{{url('escola')}}/"+escola,
		function (dados){
		   if (dados.length > 0){
			  var option = '<option>Selecione o ciclo  </option>';
			  $.each(dados, function(i, obj){
				  option += '<option value="'+obj.id+'">'+obj.nome+'</option>';
			  })

		   }else{

              $('#ciclo').empty().append('<option>Não foram encontradas ciclo para esta escola!</option>');

		   }
		   $('#ciclo').html(option).show();
		})
	})

</script>

@endsection

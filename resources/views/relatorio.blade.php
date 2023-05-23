@extends('layouts.starter')
@section('title', 'Relatorios')

@include ('layouts.sidebar')

@section('content')
 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Relatorios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Relatorios</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="callout callout-info">
            <h5> Seleciona uma categoria para mostrar o seu historico:</h5>
             <!-- SEARCH FORM -->
    <form class="form-horizontal" id="form">
       <div class="row">
        <div class="col-md-8">
              <div class="form-group">
                <select class="form-control select2bs4" style="width: 100%;" name="prontuario" id="prontuario">
                  <option selected="selected">Seleciona uma categoria</option>
                  <option value="1">Número de Alunos Matriculados por subsistema de Ensino</option>
                  <option value="2">Grau de Aproveitamento </option>
                  <option value="3">Nº de professores por Subsistema de Ensino </option>
                  <option value="4">Número de Escolas por Subsistema de Ensino  </option>
                  <option value="5">Taxa de Abandono Escolar </option>

                </select>
              </div>
        </div>
        <div class="col-md-4">
        <button class="btn btn-success" id="buscar"><i class="fas fa-search"></i></button>
        </div>
            </div>
      </form>
          </div>


          <!-- Main content -->

          <div class="col-md-12" id="historico" >
            <div class="card">
              <div class="card-header p-2">
                <h4 id="tabela-texto"></h4>
              </div><!-- /.card-header -->
              <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="table-agenda" class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>subsistema de Ensino</th>
                                            <th>total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->

          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  @endsection
@section('script')
@include ('layouts.datatable')
@parent
<!-- Page script -->
<script>

    $(function () {
      //Initialize

    $('#historico').hide();
    })

    $("#buscar").on('click', function(e) {
        e.preventDefault();

        var valor = $('#prontuario option:selected').attr('value');

        var texto = $('#prontuario option:selected').text();
        $('#tabela-texto').text(texto);
        if(valor == 1)
        {
  var tableUser = $('#table-agenda').DataTable({
destroy: true,
dom: 'Bfrtip',
        buttons: [

            {
                extend: 'pdf',
                messageTop: texto,
                exportOptions: {
                    columns: [ 1,2]
                }
            }
            ,

            {
                extend: 'print',
                messageTop: texto,
                exportOptions: {
                    columns: [ 1,2]
                }
            }

        ],
processing: true,
serverSide: true,
autoWidth: false,
order: [[1, 'asc']],

ajax: {
    url: "{{ route('MatriculadosSubsistema') }}",
    method: 'GET'
},
columnDefs: [{
    orderable: false,
    targets: [0,2]
}],
columns: [{
        'data': null
    },
    {
        'data': 'ciclo'
    },
    {
        'data': 'total'
    },

]
});

tableUser.on('draw.dt', function() {
var PageInfo = $('#table-agenda').DataTable().page.info();
tableUser.column(0, {
    page: 'current'
}).nodes().each(function(cell, i) {
    cell.innerHTML = i + 1 + PageInfo.start;
});
});


tableUser.on('order.dt search.dt', () => {
tableUser.column(0, {
    search: 'applied',
    order: 'applied'
}).nodes().each(function(cell, i) {
    cell.innerHTML = i + 1;
});
}).draw();
$('#historico').show();

        } else if (valor == 2)

        {
  var tableUser = $('#table-agenda').DataTable({
destroy: true,
dom: 'Bfrtip',
        buttons: [

            {
                extend: 'pdf',
                messageTop: texto,
                exportOptions: {
                    columns: [ 1,2]
                }
            }
            ,

            {
                extend: 'print',
                messageTop: texto,
                exportOptions: {
                    columns: [ 1,2]
                }
            }

        ],
processing: true,
serverSide: true,
autoWidth: false,
order: [[1, 'asc']],

ajax: {
    url: "{{ route('GrauAproveitamento') }}",
    method: 'GET'
},
columnDefs: [{
    orderable: false,
    targets: [0,2]
}],
columns: [{
        'data': null
    },
    {
        'data': 'ciclo'
    },
    {
        'data': function (data) {
              var total = (data.totalaprovados * 100)/data.totalavaliados;
             return total.toFixed(2) + " %";
        }
    },

]
});

tableUser.on('draw.dt', function() {
var PageInfo = $('#table-agenda').DataTable().page.info();
tableUser.column(0, {
    page: 'current'
}).nodes().each(function(cell, i) {
    cell.innerHTML = i + 1 + PageInfo.start;
});
});


tableUser.on('order.dt search.dt', () => {
tableUser.column(0, {
    search: 'applied',
    order: 'applied'
}).nodes().each(function(cell, i) {
    cell.innerHTML = i + 1;
});
}).draw();
$('#historico').show();

} else if (valor == 3)
{

    var tableUser = $('#table-agenda').DataTable({
destroy: true,
dom: 'Bfrtip',
        buttons: [

            {
                extend: 'pdf',
                messageTop: texto,
                exportOptions: {
                    columns: [ 1,2]
                }
            }
            ,

            {
                extend: 'print',
                messageTop: texto,
                exportOptions: {
                    columns: [ 1,2]
                }
            }

        ],
processing: true,
serverSide: true,
autoWidth: false,
order: [[1, 'asc']],

ajax: {
    url: "{{ route('professores') }}",
    method: 'GET'
},
columnDefs: [{
    orderable: false,
    targets: [0,2]
}],
columns: [{
        'data': null
    },
    {
        'data': 'ciclo'
    },
    {
        'data': function (data) {
            console.log(data);
            return data.total;
        }
    },

]
});

tableUser.on('draw.dt', function() {
var PageInfo = $('#table-agenda').DataTable().page.info();
tableUser.column(0, {
    page: 'current'
}).nodes().each(function(cell, i) {
    cell.innerHTML = i + 1 + PageInfo.start;
});
});


tableUser.on('order.dt search.dt', () => {
tableUser.column(0, {
    search: 'applied',
    order: 'applied'
}).nodes().each(function(cell, i) {
    cell.innerHTML = i + 1;
});
}).draw();
$('#historico').show();

}else if (valor == 4)
 {

    var tableUser = $('#table-agenda').DataTable({
destroy: true,
dom: 'Bfrtip',
        buttons: [

            {
                extend: 'pdf',
                messageTop: texto,
                exportOptions: {
                    columns: [ 1,2]
                }
            }
            ,

            {
                extend: 'print',
                messageTop: texto,
                exportOptions: {
                    columns: [ 1,2]
                }
            }

        ],
processing: true,
serverSide: true,
autoWidth: false,
order: [[1, 'asc']],

ajax: {
    url: "{{ route('escolas') }}",
    method: 'GET'
},
columnDefs: [{
    orderable: false,
    targets: [0,2]
}],
columns: [{
        'data': null
    },
    {
        'data': 'ciclo'
    },
    {
        'data': function (data) {
            console.log(data);
            return data.total;
        }
    },

]
});

tableUser.on('draw.dt', function() {
var PageInfo = $('#table-agenda').DataTable().page.info();
tableUser.column(0, {
    page: 'current'
}).nodes().each(function(cell, i) {
    cell.innerHTML = i + 1 + PageInfo.start;
});
});


tableUser.on('order.dt search.dt', () => {
tableUser.column(0, {
    search: 'applied',
    order: 'applied'
}).nodes().each(function(cell, i) {
    cell.innerHTML = i + 1;
});
}).draw();
$('#historico').show();

}

    });


  </script>

@endsection

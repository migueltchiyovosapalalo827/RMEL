@extends('layouts.starter')
@section('title', 'Usuarios')

@include ('layouts.sidebar')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lista de Escolas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Escolas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card card-default">

          <div class="card-header">
          <h3 class="card-title">Lista de usuarios</h3>
        <div class="card-tools">
            <div class="btn-group">
                <a href="{{route('escola.create')}}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i>
                   Cadastrar escola
                </a>
            </div>

        </div>

        </div>

            <!-- /.card-header -->
            <div class="card-body">
            <div class="table-responsive">
                    <table id="table-escola" class="table table-striped table-hover va-middle">
                        <thead>
                        <tr>
                          <th>#</th>
                          <th>Nome</th>
                          <th>Numero</th>
                          <th>Ciclo</th>
                          <th>Acção</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>


@endsection
@include ('layouts.datatable')
@section('script')
@parent
<script>
    var tableUser = $('#table-escola').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        order: [[1, 'asc']],

        ajax: {
            url: "{{ route('escola.index') }}",
            method: 'GET'
        },
        columnDefs: [{
            orderable: false,
            targets: [0,4]
        }],
        columns: [{
                'data': null
            },
            {
              'data': 'nomeescola'
            },
            {
                'data': 'numeroescola'
            },
            {
                'data': function (data) {
                    var dados = "";
                      data.ciclos.forEach(function (elemento) {

                             dados +="  "+elemento.nome;
                    });
                    return dados;
                }
            },
           {"data": function(data) {
                    return `<td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                                <a href="{{url('escola/${data.id}/edit')}}" class="btn btn-primary btn-edit"><i class="fas fa-user-edit"></i></a>
                                <button class="btn btn-danger btn-delete" data-id="${data.id}"><i class="fas fa-trash"></i></button>
                            </div>
                            </td>`
                }
            }
        ]
    });

    $(document).on('click', '.btn-delete', function(e) {
        Swal.fire({
            title: 'Você tem certeza?',
                text: 'Você não poderá reverter isso!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, exclua!',
                cancelButtonText: 'Cancelar',
            })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url: `{{ url('escola')}}/${$(this).attr('data-id')}`,
                        method: 'DELETE',
                    }).done((data, textStatus, jqXHR) => {
                        Toast.fire({
                            icon: 'success',
                            title: jqXHR.responseJSON.message,
                        });
                        console.log(jqXHR);
                        tableUser.ajax.reload();
                    }).fail((error) => {
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.message,
                        });
                    })
                }
            })
    });

    tableUser.on('draw.dt', function() {
        var PageInfo = $('#table-escola').DataTable().page.info();
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
</script>

@endsection

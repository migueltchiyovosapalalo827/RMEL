@extends('layouts.starter')
@section('title', 'Usuarios')

@include ('layouts.sidebar')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Lista de Alunos matriculado por classes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">alunos por classes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <style>.fade.in{opacity: 1;}</style>
<div class="card card-default">
    <div class="card-header">
        <div class="card-tools">
            <div class="btn-group">
            <a href="{{route('matriculas.create')}}" class="btn btn-sm btn-block btn-rounded btn-primary"><i class="fa fa-plus"></i>
                Adicionar
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
            <div class="table-responsive">
                    <table id="table-user" class="table table-striped table-hover va-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Ano lectivo</th>
                                <th>Escola</th>
                                <th>Classes</th>
                                <th>Alunos</th>
								<th >Acção</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
    </section>

@endsection
@include ('layouts.datatable')
@section('script')
@parent
<script>
    var save_method;
    var tableUser = $('#table-user').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        order: [[1, 'asc']],

        ajax: {
            url: "{{ route('matriculas.index')}}",
            method: 'GET'
        },
        columnDefs: [{
            orderable: false,
            targets: [0,5]
        }],
        columns: [{
                'data': null
            },
            {
            'data':'anolectivo'
            },
            {
             'data': 'escola'

            },

            {
              'data': 'classe'
            },

            {
              'data': 'alunos'
            },
            {
                "data": function(data) {
                    return `<td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                                <a class="btn btn-primary" href="{{url('matriculas/${data.escola_id}')}}"> <i class="fas fa-id-card m-r-5"></i></a>
                                <a href="{{url('matricula/${data.escola_id}/${data.classe_id}')}}" class="btn btn-primary btn-edit"><i class="fas fa-user-edit"></i></a>
                                <button class="btn btn-danger btn-delete" data-escola_id="${data.escola_id}" data-classe_id="${data.classe_id}"><i class="fas fa-trash"></i></button>
                            </div>
                            </td>`
                }
            }
        ]
    });


    $(document).on('click', '.btn-delete', function(e) {
        Swal.fire({
                title: 'Você tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, exclua!',
                cancelButtonText: 'Cancelar'
            })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url: `{{url('matricula')}}/${$(this).attr('data-escola_id')}/${$(this).attr('data-classe_id')}`,
                        method: 'DELETE',
                    }).done((data, textStatus, jqXHR) => {
                        console.log(data);
                        Toast.fire({
                            icon: 'success',
                            title: jqXHR.responseJSON.message,
                        });
                        tableUser.ajax.reload();
                    }).fail((error) => {
                        console.log(error);
                        Toast.fire({
                            icon: 'error',
                            title: error.responseJSON.message,
                        });
                    })
                }
            })
    });


    tableUser.on('draw.dt', function() {
        var PageInfo = $('#table-user').DataTable().page.info();
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

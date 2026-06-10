@extends('layouts.sistema')

@section('title')
    Solicitações
@endsection
@section('meta_title')
    Solicitações
@endsection

@push('head')
@endpush

@section('content')
    <style>
        .text-lightgreen {
            color: #20c963;
        }

        .bg-lightgreen {
            color: black;
            background: #20c963;
        }

        .btn-lightgreen {
            background: #20c963;
        }

        .btn-lightgreen:hover {
            background: #19e76b;
        }
    </style>
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Solicitações de Alunos</h3>
                        <p>Gerencie as solicitações de documentos e serviços</p>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <br>
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <div class="app-content">
                        <div class="container-fluid">

                            <!-- Info Boxes -->
                            <div class="row g-4">
                                <!-- Disciplinas Cursando -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="dashboard-card border">
                                        <div class="card-content">
                                            <span class="card-title">Total</span>
                                            <span class="card-number">{{$total}}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Atividades Pendentes -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="dashboard-card border">
                                        <div class="card-content">
                                            <span class="card-title">Pendentes</span>
                                            <span class="card-number text-warning">{{$pendentes}}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Frequência Geral -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="dashboard-card border">
                                        <div class="card-content">
                                            <span class="card-title">Em Analise</span>
                                            <span class="card-number text-info">{{$emAnalise}}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Média Geral -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="dashboard-card border">
                                        <div class="card-content">
                                            <span class="card-title">Concluídas</span>
                                            <span class="card-number text-lightgreen">{{$concluidas}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!--end::Container-->
                </div>
                <br>
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title text-dark fw-bold">Lista de Disciplinas</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0 table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px"></th>
                                    <th>Data</th>
                                    <th>Aluno</th>
                                    <th>Tipo</th>
                                    <th>Descrição</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody> @foreach ($items as $item)
                                <tr class="align-middle">
                                    <td></td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->student }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->description }}</td>
                                    @if($item->status == 'Pendente')
                                        <td><span class="badge text-bg-danger badge-md">{{ $item->status }}</span></td>
                                    @elseif($item->status == 'Em Análise')
                                        <td><span class="badge text-bg-warning badge-md">{{ $item->status }}</span></td>
                                    @elseif($item->status == 'Concluído')
                                        <td><span class="badge text-bg-info badge-md">{{ $item->status }}</span></td>
                                    @endif
                                    <td>
                                        <a href="{{ route('secretaryrequests.edit', $item->id) }}">
                                            <button title="Adicionar Alunos" type="button" data-bs-toggle="modal"
                                                class="me-2 btn btn-outline-dark mb-2 btn-sm">Responder</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="modal fade" id="modalSolicitacao" tabindex="-1">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Responder Solicitação</h5><br>
                        </div>
                        <div class="modal-body bg-gray">
                            <label>Solicitação de: João Silva</label><br>
                            <label>Tipo: Atestado de Frequência</label><br>
                            <label>Data: 10/03/2023</label><br>
                            <label>Descrição: Atestado de frequência do semestre atual</label>
                        </div>
                        <div class="modal-body">
                            <label for="exampleInputPassword1" class="form-label">Resposta / Observações</label>
                            <input type="text" class="form-control" id="exampleInputPassword1" />
                        </div>
                        <div class="modal-body">
                            <label class="form-label" for="inputGroupFile02">Anexar Documento</label>
                            <input type="file" class="form-control" id="inputGroupFile02" />
                        </div>
                        <div class="modal-body">
                            <button class="btn btn-info me-4">
                                <i class="bi bi-clock"></i>
                                Marcar "Em Análise"
                            </button>
                            <button class="btn btn-lightgreen">
                                <i class="bi bi-check-circle"></i>
                                Marcar "Concluído"
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!--end::App Content Header-->
            <!--begin::App Content-->
            <!-- /.card -->

            <!--begin::JavaScript-->
            <script>
                // Example starter JavaScript for disabling form submissions if there are invalid fields
                (() => {
                    'use strict';

                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    const forms = document.querySelectorAll('.needs-validation');

                    // Loop over them and prevent submission
                    Array.from(forms).forEach((form) => {
                        form.addEventListener(
                            'submit',
                            (event) => {
                                if (!form.checkValidity()) {
                                    event.preventDefault();
                                    event.stopPropagation();
                                }

                                form.classList.add('was-validated');
                            },
                            false,
                        );
                    });
                })();

            </script>
            <!--end::JavaScript-->
        </div>
    </main>

@endsection
@extends('layouts.sistema')

@section('title')
    Login | Ministério Melhor Viver
@endsection
@section('meta_title')
    Login | Ministério Melhor Viver
@endsection

@push('head')
@endpush

@section('content')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Gerenciar Disciplinas</h3>
                        <p>Administre turmas, professores e alunos</p>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-end">
                            <div class="col-sm-6 d-flex justify-content-end align-items-center gap-2">
                                <a href="{{ route('courses.create') }}" class="btn btn-primary">
                                    <i class="bi bi-plus-lg"></i>
                                    <span>Novo</span>
                                </a>
                            </div>
                            <div class="collapse mt-3 w-100" id="novaTurma">
                                <div class="card card-body w-100">
                                    <div class="card card-dark card-outline mb-4">
                                        <!--begin::Header-->
                                        <div class="col-md-12">
                                            <div class="card w-100">
                                                <div class="card-header w-100">
                                                    <div class="card-title">Nova Disciplina</div> <br>
                                                    <small class="text-muted">Preencha os dados para criar uma nova
                                                        disciplina</small>
                                                </div>

                                                <!--end::Header-->
                                                <!--begin::Form-->
                                                <form>
                                                    <!--begin::Body-->
                                                    <div class="card-body">
                                                        <div class="mb-3 w-100">
                                                            <div class="mb-3">
                                                                <label for="exampleInputPassword1" class="form-label">Nome
                                                                    da Turma</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputPassword1" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleInputPassword1"
                                                                    class="form-label">Curso</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputPassword1" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleInputPassword1"
                                                                    class="form-label">Disciplina</label>
                                                                <input type="text" class="form-control"
                                                                    id="exampleInputPassword1" />
                                                            </div>
                                                            <label for="validationCustom04" class="form-label">Professor
                                                                Responsavel</label>
                                                            <select class="form-select" id="validationCustom04">
                                                                <option selected disabled value="">Escolha uma opção
                                                                </option>
                                                                <option>Prof. Maria Santos</option>
                                                                <option>Prof. João Oliveira</option>
                                                                <option>Prof. Ana Paula</option>
                                                                <option>Prof. Roberto Lima</option>
                                                            </select>
                                                            <div class="invalid-feedback">Por favor selecione uma
                                                                opção</div>
                                                        </div>
                                                    </div>
                                                    <!--end::Body-->
                                                    <!--begin::Footer-->
                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-dark">Criar
                                                            Disciplina</button>
                                                    </div>
                                                    <!--end::Footer-->
                                                </form>
                                                <!--end::Form-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </ol>
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
                                            <span class="card-title">Total de Turmas</span>
                                            <span class="card-number">6</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Atividades Pendentes -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="dashboard-card border">
                                        <div class="card-content">
                                            <span class="card-title">Total de Alunos</span>
                                            <span class="card-number text-primary">120</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Frequência Geral -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="dashboard-card border">
                                        <div class="card-content">
                                            <span class="card-title">Média Por Turma</span>
                                            <span class="card-number text-sucess">30</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Média Geral -->
                                <div class="col-12 col-sm-6 col-md-3">
                                    <div class="dashboard-card border">
                                        <div class="card-content">
                                            <span class="card-title">Total de Professores</span>
                                            <span class="card-number text-primary">15</span>
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
                                    <th>Turmas</th>
                                    <th>Curso</th>
                                    <th>Disciplina</th>
                                    <th>Professor</th>
                                    <th>Alunos</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr class="align-middle">
                                        <td></td>
                                        <td>ESFOT7S</td>
                                        <td>Engenharia de Software</td>
                                        <td>{{ $course->name }}</td>
                                        <td>Prof. Maria Santos</td>
                                        <td><span class="badge text-bg-primary bi-people-fill"> 36</span></td>
                                        <td>
                                            <button title="Adicionar Alunos" type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalAlunos"
                                                class="me-2 btn btn-outline-dark mb-2 btn-sm bi-people-fill"></button>
                                            <button title="Editar Turma" type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalEditar"
                                                class="me-2 btn btn-outline-dark mb-2 btn-sm bi-pencil-square"></button>
                                            <button title="Excluir Turma" type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalRemover"
                                                class="btn btn-outline-danger mb-2 btn-sm bi-trash"></button>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- MODAL -->
                                <div class="modal fade" id="modalEditar" tabindex="-1">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Disciplina</h5><br>
                                                <button title="." type="button" class="btn-close" data-bs-dismiss="modal">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="exampleInputPassword1" class="form-label">Turma</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" />
                                            </div>
                                            <div class="modal-body">
                                                <label for="exampleInputPassword1" class="form-label">Curso</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" />
                                            </div>
                                            <div class="modal-body">
                                                <label for="exampleInputPassword1" class="form-label">Disciplina</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" />
                                            </div>
                                            <div class="modal-body">
                                                <label for="exampleInputPassword1" class="form-label">Professor
                                                    Responsavel</label>
                                                <select class="form-select">
                                                    <option>Selecione um professor</option>
                                                    <option>João Silva</option>
                                                    <option>Maria Santos</option>
                                                </select>
                                                <br>
                                                <button class="btn btn-dark">
                                                    <i class="bi bi-pencil-square"></i>
                                                    Adicionar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="modal fade" id="modalAlunos" tabindex="-1">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Gerenciar Alunos</h5><br>
                            <button title="." type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">
                                Adicionar Aluno
                            </label>
                            <div class="d-flex gap-2">
                                <select class="form-select">
                                    <option>Selecione um aluno</option>
                                    <option>João Silva</option>
                                    <option>Maria Santos</option>
                                </select>
                                <button class="btn btn-dark">
                                    <i class="bi bi-person-plus"></i>
                                    Adicionar
                                </button>
                            </div>
                            <hr>
                            <h6>Alunos na Turma</h6>
                            <div class="border rounded p-3 mb-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>João Silva</strong><br>
                                    <small>Matrícula: 2021001</small>
                                </div>
                            </div>
                            <div class="border rounded p-3 mb-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Maria Santos</strong><br>
                                    <small>Matrícula: 2021002</small>
                                </div>
                            </div>
                            <div class="border rounded p-3 mb-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Pedro Oliveira</strong><br>
                                    <small>Matrícula: 2023001</small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalRemover" tabindex="-1">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Remover Aluno</h5><br>
                            <button title="." type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">
                                Remover Aluno
                            </label>
                            <div class="border rounded p-3 mb-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>João Silva</strong><br>
                                    <small>Matrícula: 2021001</small>
                                </div>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-person-dash"></i>
                                </button>
                            </div>
                            <div class="border rounded p-3 mb-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Maria Santos</strong><br>
                                    <small>Matrícula: 2021002</small>
                                </div>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-person-dash"></i>
                                </button>
                            </div>
                            <div class="border rounded p-3 mb-2 d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Pedro Oliveira</strong><br>
                                    <small>Matrícula: 2023001</small>
                                </div>
                                <button class="btn btn-outline-danger btn-sm">
                                    <i class="bi bi-person-dash"></i>
                                </button>
                            </div>
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
        <!--end::Form Validation-->
        <!--end::App Content-->
    </main>
@endsection
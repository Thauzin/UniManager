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
            <div class="mt-3 w-100" id="novaTurma">
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
                                <form action="{{ isset($course) ? route('courses.update', $course->id) : route('courses.store') }}"
                                method="POST">

                                @csrf

                                @if (isset($course))
                                    @method('PUT')
                                @endif
                                    <!--begin::Body-->
                                    <div class="card-body">
                                        <div class="mb-3 w-100">
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Nome
                                                    da Turma</label>
                                                <input type="text" name="name" class="form-control"
                                                value="{{ old('name', $course->name ?? '') }}" placeholder="Nome">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Disciplina</label>
                                                <input type="text" class="form-control" id="exampleInputPassword1" />
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